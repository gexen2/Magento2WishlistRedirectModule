<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Crealevant\AddToWishlistNotRedirect\Model\Config\Source;

class Options implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('Redirect (STANDARD)')],
            ['value' => 1, 'label' => __('Activate')]
        ];
    }
}
