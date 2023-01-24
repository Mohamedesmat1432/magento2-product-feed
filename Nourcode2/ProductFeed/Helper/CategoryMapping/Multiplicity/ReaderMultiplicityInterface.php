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

interface ReaderMultiplicityInterface
{
    /**
     * @return $this
     */
    public function findAll();

    /**
     * @param ReaderInterface $item
     * @return $this
     */
    public function addItem(ReaderInterface $item);

    /**
     * @return array
     */
    public function getItems();
}
