<?php
/**
 * Copyright © 2016 FireGento e.V. - All rights reserved.
 * See LICENSE.md bundled with this module for license details.
 */
namespace FireGento\Pdf\Model\Engine\Invoice;

use FireGento\Pdf\Model\Engine\AbstractEngine;

class Standard extends AbstractEngine
{

    /**
     * Return PDF document
     *
     * @param array|Collection $invoices
     *
     * @return \Zend_Pdf
     */
    public function getPdf($invoices = [])
    {
        // TODO implement
        echo 'works';
        exit;
    }

}
