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

namespace Nourcode2\ProductFeed\Cron;

use Exception;
use Nourcode2\ProductFeed\Helper\Data;
use Nourcode2\ProductFeed\Model\Config\Source\FeedType;
use Nourcode2\ProductFeed\Model\ResourceModel\ProductFeed\Collection;
use Nourcode2\ProductFeed\Model\ResourceModel\ProductFeed\CollectionFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Psr\Log\LoggerInterface;

class GenerateFeed
{
    protected $generateFeed;

    protected $logger;

    protected $feedCollection;

    protected $helperData;

    protected $scopeConfig;

    /**
     * GenerateFeed constructor.
     *
     * @param \Nourcode2\ProductFeed\Model\Generator\GenerateFeed $generateFeed
     * @param LoggerInterface $logger
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        \Nourcode2\ProductFeed\Model\Generator\GenerateFeed $generateFeed,
        LoggerInterface $logger,
        CollectionFactory $collectionFactory,
        Data $helperData,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->helperData = $helperData;
        $this->feedCollection = $collectionFactory;
        $this->logger = $logger;
        $this->generateFeed = $generateFeed;
    }

    public function generate()
    {
        $generateCollection = $this->geeFeedGenerationCollection();
        $status = $this->scopeConfig->getValue('sendmail/mailsetting/status');
        $when = $this->scopeConfig->getValue('sendmail/mailsetting/when');
        foreach ($generateCollection as $feed) {
            try {
                if ($feed->getTypeTemplate() == 'facebook') {
                    $this->generateFeed->generateOnce(FeedType::FACEBOOK_FEED_FILE_TYPE, $feed);
                } else {
                    $this->generateFeed->generateOnce(FeedType::GOOGLE_FEED_FILE_TYPE, $feed);
                }
                $this->logger->critical("Feed Generation: Success");
                if($status==1 && in_array("1", explode(",",$when))) {
                    $this->helperData->sendMail("success");
                }
            } catch (Exception $e) {
                if($status==1 && in_array("0", explode(",",$when))) {
                    $this->helperData->sendMail("fail");
                }
                $this->logger->critical("Feed Generation: Error" . $e->getMessage());
            }
        }
        return true;
    }

    protected function geeFeedGenerationCollection()
    {
        /** @var Collection $collection */
        $collection = $this->feedCollection->create();
        $collection->addFieldToFilter('status', '1');

        return $collection;
    }
}
