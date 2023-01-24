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

namespace Nourcode2\ProductFeed\Controller\Adminhtml\Index;

use Nourcode2\ProductFeed\Controller\Adminhtml\AbstractFeed;
use Nourcode2\ProductFeed\Helper\Data;
use Nourcode2\ProductFeed\Model\Generator\GenerateFeed;
use Nourcode2\ProductFeed\Model\ProductFeedFactory;
use Nourcode2\ProductFeed\Model\ResourceModel\ProductFeed;
use Nourcode2\ProductFeed\Model\TemplatesFactory;
use Magento\Backend\App\Action\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\CatalogRule\Model\RuleFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\Registry;
use Magento\Framework\Serialize\Serializer\Json;

class Generate extends AbstractFeed
{
    protected $helperData;

    protected $fileFactory;

    protected $_directory;

    protected $productFactory;

    protected $resultJsonFactory;
    protected $generator;
    /**
     * @var CollectionFactory
     */
    private $productCollectionFactory;
    protected $cron;

    public function __construct(
        ProductFeedFactory $modelFactory,
        TemplatesFactory $templateFactory,
        Registry $registry,
        Context $context,
        RuleFactory $ruleFactory,
        RedirectFactory $resultRedirectFactory,
        ProductFeed $resourceFeed,
        Json $jsonHelper,
        JsonFactory $resultJsonFactory,
        Filesystem\DirectoryList $_directory,
        FileFactory $fileFactory,
        CollectionFactory $productCollectionFactory,
        Data $helperData,
        GenerateFeed $generateFeed,
        Filesystem $filesystem,
        \Nourcode2\ProductFeed\Cron\GenerateFeed $cron
    ) {
        $this->cron = $cron;
        $this->generator = $generateFeed;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->helperData = $helperData;
        $this->_directory = $_directory;
        $this->fileFactory = $fileFactory;
        parent::__construct($modelFactory, $templateFactory, $registry, $context, $ruleFactory, $resultRedirectFactory, $resourceFeed, $jsonHelper);
    }
    // function is used to generate file
    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();
        $feed = $this->initFeed();
        $fileName = $feed->getFileName();
        $urlFile = $this->helperData->getUrlFile($fileName);
        $percent = $this->generator->generateSegment($feed);
        $resultJson->setData(
            [
                'percent' => $percent,
                'urlFile' => $urlFile
            ]
        );
        return $resultJson;
    }
}
