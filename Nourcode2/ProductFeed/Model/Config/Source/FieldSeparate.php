<?php
/**
 * Copyright © 2020 Nourcode2. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Nourcode2_magento extension
 * NOTICE OF LICENSE
 *
 * @category Nourcode2
 * @package Nourcode2_magento
 */
namespace Nourcode2\ProductFeed\Model\Config\Source;

class FieldSeparate implements \Magento\Framework\Option\ArrayInterface
{
    const TAB = "\t";
    const COMMA = ",";
    const SEMI_COLON = ";";
    public function toOptionArray()
    {
        return[
            [
                'value'   =>  self::TAB,
                'label'   =>  __('Tab')
            ],
            [
                'value'   =>  self::COMMA,
                'label'   =>  __('Comma')
            ],
            [
                'value'   =>  self::SEMI_COLON,
                'label'   =>  __('Semi-Colon')
            ]
        ];
    }
}
