<?php

namespace FireGento\Pdf\Model\Config;

use Magento\Framework\Config\Reader\Filesystem;

class Reader extends Filesystem
{

    /**
     * List of identifier attributes for merging
     *
     * @var array
     */
    protected $_idAttributes = [
        '/config/engines/engine/item' => 'id'
    ];

}
