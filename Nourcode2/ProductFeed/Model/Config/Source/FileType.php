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

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\App\RequestInterface;
use Nourcode2\ProductFeed\Helper\Data;

class FileType implements OptionSourceInterface
{
    const XML = 'xml';
    const CSV = 'csv';
    const TXT = 'txt';
    protected $request;
    protected $data;
    public function __construct(
        RequestInterface $request,
        Data $data
    ) {
        $this->request = $request;
        $this->data = $data;
    }

    /**
     * Get options in "key-value" format
     * @return array
     */
    public function toOptionArray()
    {
        $id = $this->request->getParams('id');
        $template = $this->data->getTemplate();
        if ($template=='facebook') {
            return [
                [
                    'value' => self::CSV,
                    'label' => __('CSV  ')
                ]
            ];
        } elseif ($template=='google') {
            return [
                [
                    'value' => self::XML,
                    'label' => __('XML')
                ]
            ];
        }
//        return [
//            [
//                'value' => self::XML,
//                'label' => __('XML')
//            ],
//            [
//                'value' => self::CSV,
//                'label' => __('CSV')
//            ],
//            [
//                'value' => self::TXT,
//                'label' => __('TXT')
//            ]
//        ];
    }
}
