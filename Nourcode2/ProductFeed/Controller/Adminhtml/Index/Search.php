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
use Nourcode2\ProductFeed\Helper\CategoryMapping\Multiplicity\FileReaderMultiplicity;
use Nourcode2\ProductFeed\Helper\CategoryMapping\ReaderMapper;
use Nourcode2\ProductFeed\Model\ProductFeedFactory;
use Nourcode2\ProductFeed\Model\ResourceModel\ProductFeed;
use Nourcode2\ProductFeed\Model\TemplatesFactory;
use Magento\Backend\App\Action\Context;
use Magento\CatalogRule\Model\RuleFactory;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Registry;

class Search extends AbstractFeed
{
    /** @var ReaderMapper */
    protected $readerMapper;

    /** @var FileReaderMultiplicity */
    protected $fileReaderMultiplicity;

    public function __construct(
        ProductFeedFactory $modelFactory,
        TemplatesFactory $templateFactory,
        Registry $registry,
        Context $context,
        RuleFactory $ruleFactory,
        RedirectFactory $resultRedirectFactory,
        ProductFeed $resourceFeed,
        Json $jsonHelper,
        ReaderMapper $readerMapper,
        FileReaderMultiplicity $fileReaderMultiplicity
    ) {
        parent::__construct($modelFactory, $templateFactory, $registry, $context, $ruleFactory, $resultRedirectFactory, $resourceFeed, $jsonHelper);
        $this->readerMapper = $readerMapper;
        $this->fileReaderMultiplicity = $fileReaderMultiplicity;
    }

    /**
     * Do search of category.
     *
     * @return Json
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_JSON);

        $search = $this->getRequest()->getParam('query');

        $this->fileReaderMultiplicity->findAll();
        if ($this->fileReaderMultiplicity->count()) {
            $this->readerMapper->addMultiplicity($this->fileReaderMultiplicity);
        }

        $resultPage->setData($this->readerMapper->getData($search));

        return $resultPage;
    }
}
