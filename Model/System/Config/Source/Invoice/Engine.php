<?php
/**
 * Copyright © 2016 FireGento e.V. - All rights reserved.
 * See LICENSE.md bundled with this module for license details.
 */
namespace FireGento\Pdf\Model\System\Config\Source\Invoice;

class Engine implements \Magento\Framework\Option\ArrayInterface
{

    /**
     * To option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        // TODO get the available engines from the pdf.xml files
        return [
            ['value' => '', 'label' => __('Standard Magento')],
            [
                'value' => 'FireGento\Pdf\Model\Engine\Invoice\Standard',
                'label' => __('Standard FireGento')
            ]
        ];
    }

}
