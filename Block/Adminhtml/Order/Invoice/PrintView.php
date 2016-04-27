<?php

namespace FireGento\Pdf\Block\Adminhtml\Order\Invoice;

class PrintView extends \Magento\Backend\Block\Template
{
    protected $invoice;

    /**
     * @return \Magento\Sales\Model\Order\Invoice
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * @param \Magento\Sales\Model\Order\Invoice $invoice
     */
    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;
    }
}