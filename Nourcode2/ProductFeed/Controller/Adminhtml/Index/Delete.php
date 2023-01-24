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

use Exception;
use Nourcode2\ProductFeed\Controller\Adminhtml\AbstractFeed;
use Nourcode2\ProductFeed\Model\ProductFeed;

class Delete extends AbstractFeed
{
    const ADMIN_RESOURCE = "Nourcode2_ProductFeed::delete";
    public function execute()
    {
        /** @var ProductFeed $feed */
        $feed = $this->initFeed();
        if ($feed->getId()) {
            try {
                $feed->delete();
                $this->messageManager->addSuccessMessage(__('The Feed has been deleted.'));
                return $this->_redirect('*/*/');
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $this->_redirect('*/*/');
            }
        }
    }   
}
