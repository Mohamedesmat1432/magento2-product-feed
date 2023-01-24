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

namespace Nourcode2\ProductFeed\Model\Config\Source;

class FeedType extends AbstractSource
{
    const GOOGLE_FEED_FILE_TYPE = 'google';
    const FACEBOOK_FEED_FILE_TYPE = 'facebook';

    public static function getAllOptions()
    {
        return [
            self::GOOGLE_FEED_FILE_TYPE => "Google Shopping"
        ];
    }
}
