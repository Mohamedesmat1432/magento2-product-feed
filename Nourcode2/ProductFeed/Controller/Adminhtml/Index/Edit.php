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

use Magento\Backend\App\Action;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Nourcode2\ProductFeed\Model\TemplatesFactory;
use Nourcode2\ProductFeed\Model\ProductFeedFactory;

class Edit extends Action
{
    const ADMIN_RESOURCE = "Nourcode2_ProductFeed::addedit";

    protected $resultPageFactory;

    protected $productFeedFactory;

    protected $productFeedResource;

    protected $templatesFactory;

    protected $registry;

    /**
     * Edit constructor.
     *
     * @param Action\Context $context
     * @param PageFactory $resultpageFactory
     * @param ProductFeedFactory $productfeedFactory
     * @param TemplatesFactory $templatesFactory
     * @param \Nourcode2\ProductFeed\Model\ResourceModel\ProductFeed $productFeedResource
     * @param Registry $registry
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultpageFactory,
        ProductFeedFactory $productfeedFactory,
        TemplatesFactory $templatesFactory,
        \Nourcode2\ProductFeed\Model\ResourceModel\ProductFeed $productFeedResource,
        Registry $registry
    ) {
        $this->productFeedResource = $productFeedResource;
        $this->registry = $registry;
        $this->templatesFactory = $templatesFactory;
        $this->productFeedFactory = $productfeedFactory;
        $this->resultPageFactory = $resultpageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $model = $this->productFeedFactory->create();
        if ($id = $this->getRequest()->getParam('feed_id')) {
            $this->productFeedResource->load($model, $id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This model no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('feed/');
            }
        }
        $templateCol = $this->templatesFactory->create()->getCollection();
        foreach ($templateCol as $template) {
            $contentTemp = $template->getContent();
        }
        if ($sessionData = $this->_session->getFormData()) {
            $model->setData($sessionData);
        }
        $this->registry->register('information', $model);
        $this->registry->register('templates', $contentTemp);
        $title = $model->getFeedName() == "" ? __("New Feed") : $model->getFeedName();
        $this->_view->loadLayout();
        $this->_view->getPage()->getConfig()->getTitle()->prepend($title);

        return $resultPage;
    }
}
