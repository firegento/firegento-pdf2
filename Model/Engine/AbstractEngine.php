<?php
/**
 * Copyright © 2016 FireGento e.V. - All rights reserved.
 * See LICENSE.md bundled with this module for license details.
 */
namespace FireGento\Pdf\Model\Engine;

use Dompdf\Dompdf;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Filesystem;
use Magento\Framework\Locale\ResolverInterface;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Framework\Stdlib\StringUtils;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Payment\Helper\Data;
use Magento\Sales\Model\Order\Address\Renderer;
use Magento\Sales\Model\Order\Pdf\AbstractPdf;
use Magento\Sales\Model\Order\Pdf\Config;
use Magento\Sales\Model\Order\Pdf\ItemsFactory;
use Magento\Sales\Model\Order\Pdf\Total\Factory;
use Magento\Store\Model\StoreManagerInterface;

abstract class AbstractEngine extends AbstractPdf
{
    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var ResolverInterface
     */
    protected $_localeResolver;

    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @param Data $paymentData
     * @param StringUtils $string
     * @param ScopeConfigInterface $scopeConfig
     * @param Filesystem $filesystem
     * @param Config $pdfConfig
     * @param Factory $pdfTotalFactory
     * @param ItemsFactory $pdfItemsFactory
     * @param TimezoneInterface $localeDate
     * @param StateInterface $inlineTranslation
     * @param Renderer $addressRenderer
     * @param StoreManagerInterface $storeManager
     * @param ResolverInterface $localeResolver
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        Data $paymentData,
        StringUtils $string,
        ScopeConfigInterface $scopeConfig,
        Filesystem $filesystem,
        Config $pdfConfig,
        Factory $pdfTotalFactory,
        ItemsFactory $pdfItemsFactory,
        TimezoneInterface $localeDate,
        StateInterface $inlineTranslation,
        Renderer $addressRenderer,
        StoreManagerInterface $storeManager,
        ResolverInterface $localeResolver,
        PageFactory $resultPageFactory,
        array $data = []
    ) {
        $this->_storeManager = $storeManager;
        $this->_localeResolver = $localeResolver;
        $this->_resultPageFactory = $resultPageFactory;

        parent::__construct(
            $paymentData,
            $string,
            $scopeConfig,
            $filesystem,
            $pdfConfig,
            $pdfTotalFactory,
            $pdfItemsFactory,
            $localeDate,
            $inlineTranslation,
            $addressRenderer,
            $data
        );
    }

    /**
     * @return Dompdf
     */
    protected function getDomPdf()
    {
        $domPdf = new Dompdf();

        return $domPdf;
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
        $html = '';

        /** @var \Magento\Sales\Model\Order\Invoice $invoice */
        foreach ($invoices as $invoice) {
            if ($invoice->getStoreId()) {
                $this->_localeResolver->emulate($invoice->getStoreId());
                $this->_storeManager->setCurrentStore($invoice->getStoreId());
            }

            $html .= $this->renderInvoiceHtml($invoice);

            if ($invoice->getStoreId()) {
                $this->_localeResolver->revert();
            }
        }

        $domPdf = $this->getDomPdf();
        $domPdf->loadHtml($html);
        $domPdf->render();

        // Workaround - Create tempfile and load it with Zend_PDF to get Zend_PDF object

        $tmpfile = tempnam(sys_get_temp_dir(), 'pdf_');
        file_put_contents($tmpfile, $domPdf->output());

        $pdf = \Zend_Pdf::load($tmpfile);
        $this->_setPdf($pdf);

        return $pdf;
    }

    protected function renderInvoiceHtml($invoice)
    {
        $resultPage = $this->_resultPageFactory->create();

        /** @var \FireGento\Pdf\Block\Adminhtml\Order\Invoice\PrintView $block */
        $block = $resultPage->getLayout()->createBlock('FireGento\Pdf\Block\Adminhtml\Order\Invoice\PrintView', 'print.view.' . uniqid());
        $block->setInvoice($invoice);
        $block->setTemplate('FireGento_Pdf::order/invoice/printview.phtml');

        return $block->toHtml();
    }
}
