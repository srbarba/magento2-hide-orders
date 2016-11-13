<?php
/**
 * Mageseries
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the https://opensource.org/licenses/AGPL-3.0 license
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Sales Orders - Hide order utility
 * @package     Mageseries_HideOrders
 * @author      Juan Pedro Barba Soler || Magento Developer
 * @copyright   Copyright (c) 2016 Conbdebarba.com
 * @license     https://opensource.org/licenses/AGPL-3.0
**/

namespace Mageseries\HideOrders\Plugin\Block\Adminhtml\Order;

class ViewBeforeSetLayout
{

  public function __construct(
    \Magento\Backend\Block\Template\Context $context,
    \Mageseries\HideOrders\Model\ResourceModel\OrderFrontendVisibility\CollectionFactory $collectionOrderVisibility,
    \Magento\Framework\AuthorizationInterface $authorization
  ){
    $this->visibility = $collectionOrderVisibility;
    $this->urlBuilder = $context->getUrlBuilder();
    $this->_authorization = $authorization;
  }

  public function beforeSetLayout(
    \Magento\Sales\Block\Adminhtml\Order\View $view
  ){
    if($this->_authorization->isAllowed('Mageseries_HideOrders::hideo_order')){
      $orderId = $view->getOrderId();
      $orderVisibility = $this->visibility->create()->addFieldToFilter('order_id', $orderId)->getFirstItem();
      $visibility = $orderVisibility->getFrontendVisibility();
      $action = __('Hide Order');
      if(  $visibility === '0' )
      $action = __('Show Order');

      $message = __('Are you sure you want to %1?', strtolower($action));
      $url = $this->urlBuilder->getUrl('sales/order/visibility/order/'. $orderId );

      $view->addButton(
          'order_myaction',
          [
              'label' => $action,
              'class' => 'myclass',
              'onclick' => "confirmSetLocation('{$message}', '{$url}')"
          ]
      );
    }
  }
}
