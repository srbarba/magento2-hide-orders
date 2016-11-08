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
namespace Mageseries\HideOrders\Model\ResourceModel\OrderFrontendVisibility;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
  /**
   * Name prefix of events that are dispatched by model
   *
   * @var string
   */
  protected $_eventPrefix = 'order_frontend_visibility';

  /**
   * Name of event parameter
   *
   * @var string
   */
  protected $_eventObject = 'collection';

  /**
   * Define model & resource model
   */
  protected function _construct()
  {
      $this->_init(
          'Mageseries\HideOrders\Model\OrderFrontendVisibility',
          'Mageseries\HideOrders\Model\ResourceModel\OrderFrontendVisibility'
      );
  }
}
