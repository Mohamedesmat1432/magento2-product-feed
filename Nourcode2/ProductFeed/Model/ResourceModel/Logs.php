<?php

/**
 * Copyright © 2020 Nourcode2. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Nourcode2_ProductFeed extension
 * NOTICE OF LICENSE
 *
 * @category Nourcode2
 * @package Nourcode2_ProductFeed
 */

namespace Nourcode2\ProductFeed\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class   Logs extends AbstractDb
{
    const NOURCODE2_PRODUCT_FEED_LOGS_TABLE = "nourcode2_product_feed_logs";
    protected function _construct()
    {
        $this->_init('nourcode2_product_feed_logs', 'id');
    }
}
