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

namespace Nourcode2\ProductFeed\Helper\CategoryMapping;

interface FileInterface extends ReaderInterface
{
    /**
     * @param string $file
     * @return $this
     */
    public function setFile($file);

    /**
     * @return string
     */
    public function getFile();
}
