<?php
/**
 * Copyright © 2016 FireGento e.V. - All rights reserved.
 * See LICENSE.md bundled with this module for license details.
 */
namespace FireGento\Pdf\Plugin\Invoice;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\ObjectManagerInterface;
use Magento\Sales\Model\Order\Pdf\Invoice;

class AroundGetPdfPlugin
{

    /**
     * Core store config
     *
     * @var ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @var ObjectManagerInterface
     */
    protected $_objectManager;

    public function __construct(ScopeConfigInterface $scopeConfig, ObjectManagerInterface $objectManager)
    {
        $this->_scopeConfig   = $scopeConfig;
        $this->_objectManager = $objectManager;
    }

    /**
     * @param Invoice          $subject
     * @param \Closure         $proceed
     * @param array|Collection $invoices
     *
     * @return \Zend_Pdf
     */
    public function aroundGetPdf(
        Invoice $subject,
        \Closure $proceed,
        $invoices = []
    ) {
        $store      = $subject->getStore();
        $modelClass = $this->_scopeConfig->getValue('sales_pdf/invoice/engine',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $store);
        if ( ! empty($modelClass)) {
            $engine = $this->_objectManager->create($modelClass);
            if ($engine) {
                return $engine->getPdf($invoices);
            }
        }

        // use the normal engine
        return $proceed($invoices);
    }

}
