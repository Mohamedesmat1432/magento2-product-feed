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

use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\ResourceModel\Category\Collection;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\Option\ArrayInterface;

class CategoryLevel implements ArrayInterface
{
    /** @var CollectionFactory */
    protected $collectionFactory;

    /**
     * @var array
     */
    private $_options;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function toOptionArray()
    {
        /** @var Collection $categoryCollection */
        $categoryCollection = $this->collectionFactory->create();
        $categoryCollection->addFieldToSelect('level');
        $categoryCollection->groupByAttribute('level');
        $isExisted = [];
        foreach ($categoryCollection as $cat) {
            /** @var Category $cat */
            if (!in_array($cat->getLevel(), $isExisted)) {
                $this->_options[] = [
                    'value' => $cat->getLevel(),
                    'label' => __("Level %1", $cat->getLevel())
                ];
                array_push($isExisted, $cat->getLevel());
            }
        }

        return $this->_options;
    }
}
