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

use Magento\Framework\App\Filesystem\DirectoryList;

class FileReaderMultiplicity extends ReaderMultiplicity
{
    /**
     * {@inheritdoc}
     */
    public function findAll()
    {
        $mappingPaths = $this->getMappingPaths();

        foreach ($mappingPaths as $mappingPath) {
            foreach (glob($mappingPath . "/*.txt") as $filename) {
                /** @var \Nourcode2\ProductFeed\Helper\CategoryMapping\FileInterface $fileReader */
                $fileReader = $this->getReader();
                $this->addItem($fileReader->setFile($filename));
            }
        }

        return $this;
    }

    /**
     * @return \Nourcode2\ProductFeed\Helper\CategoryMapping\FileInterface
     */
    protected function getReader()
    {
        $om = \Magento\Framework\App\ObjectManager::getInstance();

        return $om->create('Nourcode2\ProductFeed\Helper\CategoryMapping\FileReader');
    }

    /**
     * @return array
     */
    protected function getMappingPaths()
    {
        $paths = [];

        $om = \Magento\Framework\App\ObjectManager::getInstance();

        /** @var \Magento\Framework\Module\Dir\Reader $reader */
        $directoryReader = $om->get('Magento\Framework\Module\Dir\Reader');
        $paths[] = realpath($directoryReader->getModuleDir('etc', 'Nourcode2_ProductFeed') . '/../Setup/data/mapping/');

        /** @var \Magento\Framework\Filesystem $filesystem */
        $filesystem = $om->get('Magento\Framework\Filesystem');

        $paths[] = $filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath() . 'feed/mapping/';

        return $paths;
    }
}
