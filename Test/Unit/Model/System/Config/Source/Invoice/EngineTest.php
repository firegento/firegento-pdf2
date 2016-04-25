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
namespace Firegento\Pdf\Test\Unit\Model\System\Config\Source\Invoice;

use FireGento\Pdf\Model\System\Config\Source\Invoice\Engine;
/**
 * EngineTest
 *
 * @category Firegento
 * @package  Firegento_Pdf
 * @author   Christoph Aßmann <mam08ixo@googlemail.com>
 * @license  https://opensource.org/licenses/GPL-3.0
 *           GNU General Public License v3 (GPL-3.0)
 * @link     https://firegento.com/
 */
class EngineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Engine
     */
    protected $_model;

    public function setUp()
    {
        $this->_model = new Engine();
    }

    /**
     * @test
     */
    public function toOptionArray()
    {
        $optionArray = $this->_model->toOptionArray();
        $this->assertInternalType('array', $optionArray);

        array_walk($optionArray, function ($option) {
            $this->assertInternalType('array', $option);

            $this->assertArrayHasKey('value', $option);
            $this->assertArrayHasKey('label', $option);

            $this->assertInternalType('string', $option['value']);
            $this->assertInstanceOf('Magento\Framework\Phrase', $option['label']);
        });
    }
}
