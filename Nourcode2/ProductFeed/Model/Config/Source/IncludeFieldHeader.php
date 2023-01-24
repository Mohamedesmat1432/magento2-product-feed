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

class IncludeFieldHeader implements \Magento\Framework\Option\ArrayInterface
{
    const YES = 0;
    const NO = 1;
    public function toOptionArray()
    {
        return[
            [
                'value'   =>  self::YES,
                'label'   =>  __('Yes')
            ],
            [
                'value'   =>  self::NO,
                'label'   =>  __("No")
            ]
        ];
    }
}
