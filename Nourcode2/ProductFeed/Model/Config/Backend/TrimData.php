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

namespace Nourcode2\ProductFeed\Model\Config\Backend;

use Magento\Framework\App\Config\Value;

class TrimData extends Value
{
    public function beforeSave()
    {
        $value = $this->getValue();
        $trimmedValue = trim($value);
        $this->setValue($trimmedValue);

        return parent::beforeSave();
    }
}
