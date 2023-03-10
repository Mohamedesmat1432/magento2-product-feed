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

namespace Nourcode2\ProductFeed\Controller\Adminhtml;

use Nourcode2\ProductFeed\Helper\Data;
use Nourcode2\ProductFeed\Model\ProductFeedFactory;
use Nourcode2\ProductFeed\Model\RegistryConstant;
use Nourcode2\ProductFeed\Model\ResourceModel\ProductFeed;
use Nourcode2\ProductFeed\Model\TemplatesFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\CatalogRule\Model\RuleFactory;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Registry;
use Magento\Framework\Serialize\Serializer\Json;

/**
 * @SuppressWarnings(PHPMD)
 * @codingStandardsIgnoreFile
 */
abstract class AbstractFeed extends Action
{
    /** @var Json */
    protected $jsonHelper;

    /** @var Data */
    protected $helperData;

    /**
     * @var RedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * @var RuleFactory
     */
    protected $ruleFactory;

    /**
     * @var ProductFeedFactory
     */
    protected $modelFactory;

    /**
     * @var TemplatesFactory
     */
    protected $templateFactory;

    /** @var ProductFeed */
    protected $resourceFeed;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var Context
     */
    protected $context;

    /**
     * {@inheritdoc}
     * @param Registry $registry
     * @param Context $context
     */
    public function __construct(
        ProductFeedFactory $modelFactory,
        TemplatesFactory $templateFactory,
        Registry $registry,
        Context $context,
        RuleFactory $ruleFactory,
        RedirectFactory $resultRedirectFactory,
        ProductFeed $resourceFeed,
        Json $jsonHelper
    ) {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->ruleFactory = $ruleFactory;
        $this->templateFactory = $templateFactory;
        $this->modelFactory = $modelFactory;
        $this->registry = $registry;
        $this->context = $context;
        $this->resourceFeed = $resourceFeed;
        $this->jsonHelper = $jsonHelper;
        parent::__construct($context);
    }

    public function initConditions()
    {
        $model = $this->ruleFactory->create();
        if ($ruleId = $this->getRequest()->getParam('feed_id')) {
            $model->load($ruleId);
        }
        $this->registry->register(RegistryConstant::REGISTRY_CONDITION_RULE_MODEL, $model);

        return $model;
    }

    /**
     * {@inheritdoc}
     * @return |Nourcode2\ProductFeed\Model\ProductFeed
     */
    public function initFeed()
    {
        $feedModel = $this->modelFactory->create();
        if ($feedId = $this->getRequest()->getParam('id', false)) {
            $this->resourceFeed->load($feedModel, $feedId);
        }
        $this->registry->register(RegistryConstant::REGISTRY_FEED_MODEL, $feedModel);
        return $feedModel;
    }

    public function initTemplate()
    {
        $model = $this->templateFactory->create();

        if ($this->getRequest()->getParam('feed_id')) {
            $model->load($this->getRequest()->getParam('feed_id'));

        }
        $this->registry->register('templates', $model);

        return $model;
    }

    /**
     * {@inheritdoc}
     */
    protected function _initPage($resultPage)
    {
        $resultPage->setActiveMenu('Magento_Catalog::catalog');
        $resultPage->getConfig()->getTitle()->prepend(__('Advanced Product Feeds'));
        $resultPage->getConfig()->getTitle()->prepend(__('Category Mapping'));

        return $resultPage;
    }
}
