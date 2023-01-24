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

namespace Nourcode2\ProductFeed\Model\Config\Source;

class StatusSendMail implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return[
            [
                'value'   =>  1,
                'label'   =>  __('Generated successfully')
            ],
            [
                'value'   =>  0,
                'label'   =>  __('Generated error')
            ],
        ];
    }
}
