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

namespace Nourcode2\ProductFeed\Block\Adminhtml\Menu\Edit\Tab;

use Nourcode2\ProductFeed\Helper\Data;
use Nourcode2\ProductFeed\Model\ProductFeed;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form;
use Magento\Framework\Registry;
use Magento\Framework\View\LayoutInterface;

class Mapping extends Form
{
    /**
     * @var LayoutInterface
     */
    protected $layout;

    /**
     * @var Registry
     */
    protected $registry;
    protected $helperData;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        Context $context,
        Data $helperData,
        Registry $registry,
        array $data = [],
        Form\Element\ElementCreator $creator = null
    ) {
        $this->helperData = $helperData;
        $this->_template = 'Nourcode2_ProductFeed::dynamic/category/edit/form.phtml';
        $this->registry = $registry;
        parent::__construct($context, $data, $creator);
    }

    /**
     * @return array
     */
    public function getJsConfig()
    {
        $template = $this->helperData->getTemplate();
        return [
            "*" => [
                'Magento_Ui/js/core/app' => [
                    'components' => [
                        'dynamic_category' => [
                            'component' => 'Nourcode2_ProductFeed/js/dynamic/category',
                            'config' => [
                                'mapping' => $this->getCategory()->getMapping(),
                                'templateType' => $template
                            ]
                        ],
                        'dynamic_category_search' => [
                            'component' => 'Nourcode2_ProductFeed/js/dynamic/category/search',
                            'config' => []
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * @return ProductFeed
     */
    public function getCategory()
    {
        return $this->registry->registry('information');
    }
}
