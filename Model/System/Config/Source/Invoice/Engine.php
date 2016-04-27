<?php
/**
 * Copyright © 2016 FireGento e.V. - All rights reserved.
 * See LICENSE.md bundled with this module for license details.
 */
namespace FireGento\Pdf\Model\System\Config\Source\Invoice;

use FireGento\Pdf\Model\Config\Reader;
use FireGento\Pdf\Model\Pdf\Type;
use Magento\Framework\Option\ArrayInterface;

class Engine implements ArrayInterface
{

    /**
     * @var Reader
     */
    protected $_reader;

    public function __construct(Reader $reader)
    {
        $this->_reader = $reader;
    }

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        $result  = [
            ['value' => '', 'label' => __('Standard Magento')]
        ];
        $engines = $this->_reader->read()[Type::INVOICE];
        foreach ($engines as $engine) {
            $result[] = ['value' => $engine['type'], 'label' => $engine['label']];
        }

        return $result;
    }

}
