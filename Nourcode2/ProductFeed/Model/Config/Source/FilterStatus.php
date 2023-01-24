<?php
/**
 * Copyright © 2020 Nourcode2. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Nourcode2_magento233 extension
 * NOTICE OF LICENSE
 *
 * @category Nourcode2
 * @package Nourcode2_magento233
 */
namespace Nourcode2\ProductFeed\Model\Config\Source;

class FilterStatus implements \Magento\Framework\Option\ArrayInterface
{
    const DISABLE = "0";
    const ENABLE = "1";
    public function toOptionArray()
    {
        return[
            [
                'value'   =>  self::DISABLE,
                'label'   =>  __('Disable')
            ],
            [
                'value'   =>  self::ENABLE,
                'label'   =>  __('Enable')
            ]
        ];
    }
}