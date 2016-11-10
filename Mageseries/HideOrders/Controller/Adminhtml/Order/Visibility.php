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
namespace Mageseries\HideOrders\Controller\Adminhtml\Order;

use Magento\Backend\App\Action;
use Mageseries\HideOrders\Model\OrderFrontendVisibilityFactory as OrderVisibility;
use Mageseries\HideOrders\Model\ResourceModel\OrderFrontendVisibility\CollectionFactory as CollectionOrderVisibility;

class Visibility extends Action
{
  /**
     * @param Action\Context $context
     * @param OrderLoaderInterface $orderLoader
     * @param Registry $registry
     */
    public function __construct(
        Action\Context $context,
        OrderVisibility $orderVisibility,
        CollectionOrderVisibility $collectionOrderVisibility
    ) {
        $this->orderVisibility = $orderVisibility;
        $this->collectionOrderVisibility = $collectionOrderVisibility;
        parent::__construct($context);
    }
  /**
     * Action for reorder
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
      $orderId = $this->getRequest()->getParam('order');
      $resultRedirect = $this->resultRedirectFactory->create();

      if( $orderId ){
        $orderVisibility = $this->collectionOrderVisibility->create()
        ->addFieldToFilter('order_id', $orderId)
        ->getFirstItem();

        if($orderVisibility->getFrontendVisibility() === null) {
          $orderVisibility = $this->orderVisibility->create();
          $orderVisibility->setOrderId($orderId);
          $orderVisibility->save();
        }
        $orderVisibility->toggleVisibility();

        $this->messageManager->addSuccess(__('The order was successfully updated.'));
        return $resultRedirect->setPath($this->_redirect->getRefererUrl());
      }

      $this->messageManager->addError(__("We are sorry, something was wrong. You don't have enought permissions to perform this task."));
      return $resultRedirect->setPath($this->_redirect->getRefererUrl());
    }
}
