<?php
/**
 * Copyright © 2020 Nourcode2. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Nourcode2_SmartNet extension
 * NOTICE OF LICENSE
 *
 * @category Nourcode2
 * @package Nourcode2_SmartNet
 */

namespace Nourcode2\ProductFeed\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

abstract class AbstractSource implements OptionSourceInterface
{
    public function toOptionArray()
    {
        $allOptions = $this->getAllOptions();
        $result = [];
        foreach ($allOptions as $value => $label) {
            $result [] = [
                'value' => $value,
                'label' => $label
            ];
        }
        return $result;
    }

    public function getOptionText($value)
    {
        $options = $this->getAllOptions();
        foreach ($options as $key => $option) {
            if ($key == $value) {
                return $option;
            }
        }

        return "";
    }

    /**
     * @return array
     */
    abstract public static function getAllOptions();
}
