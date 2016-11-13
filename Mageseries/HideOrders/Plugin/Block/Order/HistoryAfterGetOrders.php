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

namespace Mageseries\HideOrders\Plugin\Block\Order;

class HistoryAfterGetOrders
{

  public function afterGetOrders(
    \Magento\Sales\Block\Order\History $subject,
    $result
  ){
    $result->getSelect()->where('v.frontend_visibility = 1 OR v.frontend_visibility IS NULL');
    return $result;
  }

  public function afterGetTemplate(
    \Magento\Sales\Block\Order\History $subject,
    $template
  ){
    return 'Mageseries_HideOrders::'.$template;
  }
}
