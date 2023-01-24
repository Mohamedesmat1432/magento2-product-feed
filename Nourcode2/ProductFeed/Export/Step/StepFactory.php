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

namespace Nourcode2\ProductFeed\Export\Step;

use Magento\Framework\ObjectManagerInterface;

class StepFactory
{
    /**
     * Object Manager
     *
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Construct
     *
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function create($className, array $data = [])
    {
        if (strpos($className, 'Nourcode2') === false) {
            $className = 'Nourcode2\ProductFeed\Export\Step\\' . $className;
        }

        $step = $this->objectManager->create($className, $data);

        return $step;
    }
}
