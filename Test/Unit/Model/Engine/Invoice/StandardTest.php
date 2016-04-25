<?php
/**
 * Firegento Pdf
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3 (GPL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/GPL-3.0
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to
 * newer versions in the future.
 *
 * PHP version 5
 *
 * @category  Firegento
 * @package   Firegento_Pdf
 * @author    Christoph Aßmann <mam08ixo@googlemail.com>
 * @copyright 2016 FireGento e.V.
 * @license   https://opensource.org/licenses/GPL-3.0
 *            GNU General Public License v3 (GPL-3.0)
 * @link      https://firegento.com/
 */
namespace FireGento\Pdf\Test\Unit\Model\Engine\Invoice;

use FireGento\Pdf\Model\Engine\Invoice\Standard;
/**
 * StandardTest
 *
 * @category Firegento
 * @package  Firegento_Pdf
 * @author   Christoph Aßmann <mam08ixo@googlemail.com>
 * @license  https://opensource.org/licenses/GPL-3.0
 *           GNU General Public License v3 (GPL-3.0)
 * @link     https://firegento.com/
 */
class StandardTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Standard
     */
    protected $_model;

    public function setUp()
    {
        $paymentHelper = $this->getMock('Magento\Payment\Helper\Data', [], [], '', false);
        $string = $this->getMock('Magento\Framework\Stdlib\StringUtils', [], [], '', false);
        $scopeConfig = $this->getMock('Magento\Framework\App\Config\ScopeConfigInterface');
        $filesystem = $this->getMock('Magento\Framework\Filesystem', [], [], '', false);
        $pdfConfig = $this->getMock('Magento\Sales\Model\Order\Pdf\Config', [], [], '', false);
        $pdfTotalFactory = $this->getMock('Magento\Sales\Model\Order\Pdf\Total\Factory', [], [], '', false);
        $pdfItemsFactory = $this->getMock('Magento\Sales\Model\Order\Pdf\ItemsFactory', [], [], '', false);
        $localeMock = $this->getMock('Magento\Framework\Stdlib\DateTime\TimezoneInterface', [], [], '', false, false);
        $translate = $this->getMock('Magento\Framework\Translate\Inline\StateInterface', [], [], '', false);
        $addressRenderer = $this->getMock('Magento\Sales\Model\Order\Address\Renderer', [], [], '', false);

        $this->_model = new Standard(
            $paymentHelper,
            $string,
            $scopeConfig,
            $filesystem,
            $pdfConfig,
            $pdfTotalFactory,
            $pdfItemsFactory,
            $localeMock,
            $translate,
            $addressRenderer,
            []
        );
    }

    /**
     * @test
     */
    public function getPdf()
    {
        // TODO: provide invoice collection from fixtures
        $this->assertInstanceOf('Dompdf', $this->_model->getPdf([]));
    }
}