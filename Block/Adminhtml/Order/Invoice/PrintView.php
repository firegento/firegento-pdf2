<?php

namespace FireGento\Pdf\Block\Adminhtml\Order\Invoice;

class PrintView extends \Magento\Backend\Block\Template
{
    protected $invoice;

    /**
     * @return mixed
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * @param mixed $invoice
     */
    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;
    }
}