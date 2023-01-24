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

namespace Nourcode2\ProductFeed\Helper\CategoryMapping\Multiplicity;

use Nourcode2\ProductFeed\Helper\CategoryMapping\ReaderInterface;

abstract class ReaderMultiplicity implements ReaderMultiplicityInterface
{
    /**
     * @var array
     */
    protected $items = [];

    /**
     * {@inheritdoc}
     */
    public function addItem(ReaderInterface $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * {@inheritdoc}
     */
    abstract public function findAll();
}
