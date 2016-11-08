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

namespace Mageseries\HideOrders\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class BeforeLoadOrderCollection implements ObserverInterface
{

    /**
     * Creating hide order valuer for new order
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $order
     */
    public function execute(Observer $observer)
    {
        /** @var \Magento\Sales\Model\ResourceModel\Order\Collection $collection */
        $orderCollection = $observer->getOrderCollection();
        $orderCollection->getSelect()->join(
          ['v' => 'sales_order_frontend_visibility'],
          'v.order_id = main_table.entity_id',
          ['v.frontend_visibility']);
        $orderCollection->getselect()->where('v.frontend_visibility = 1');

        return $orderCollection;
    }
}
