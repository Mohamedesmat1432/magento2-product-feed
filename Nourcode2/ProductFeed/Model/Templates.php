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
namespace Nourcode2\ProductFeed\Model;

use Nourcode2\ProductFeed\Model\AbstractTemplate;

class Templates extends AbstractTemplate
{
    protected function _construct()
    {
        $this->_init(\Nourcode2\ProductFeed\Model\ResourceModel\Templates::class);
    }
}
