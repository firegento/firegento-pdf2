<?php
/**
 * Copyright © 2016 FireGento e.V. - All rights reserved.
 * See LICENSE.md bundled with this module for license details.
 */
namespace FireGento\Pdf\Model\Engine;

use Magento\Sales\Model\Order\Pdf\AbstractPdf;

abstract class AbstractEngine extends AbstractPdf
{

    protected function getDomPdf()
    {

    }

    /**
     * Return PDF document
     *
     * @param array|Collection $invoices
     *
     * @return \Zend_Pdf
     */
    public function getPdf($invoices = [])
    {
        $domPdf = $this->getDomPdf();

        // TODO implement
        echo 'works';
        exit;
    }
}
