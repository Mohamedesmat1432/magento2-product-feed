<?php
/**
 * Copyright © 2020 Nourcode2. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Nourcode2_productfeed extension
 * NOTICE OF LICENSE
 *
 * @category Nourcode2
 * @package Nourcode2_productfeed
 */

namespace Nourcode2\ProductFeed\Export\Resolver;

class Pool
{
    /**
     * List of registered resolvers
     *
     * @var []
     */
    protected $resolvers;

    /**
     * Constructor
     *
     * @param array $resolvers
     */
    public function __construct($resolvers = [])
    {
        $this->resolvers = $resolvers;
    }

    public function findResolver($object)
    {
        foreach ($this->resolvers as $resolver) {
            if ($object instanceof $resolver['for']) {
                if (!isset($resolver['type_id']) || $object->getData('type_id') == $resolver['type_id']) {
                    return $resolver['resolver'];
                }
            }
        }

        return false;
    }

    public function getResolvers()
    {
        $list = [];

        foreach ($this->resolvers as $resolver) {
            $list[] = $resolver['resolver'];
        }

        return $list;
    }
}
