<?php

namespace FireGento\Pdf\Model\Config\Reader;

use Magento\Framework\Config\ConverterInterface;

class Converter implements ConverterInterface
{

    /**
     * Convert dom node tree to array
     *
     * @param \DOMDocument $source
     *
     * @return array
     */
    public function convert($source)
    {
        $result  = [];
        $engines = $source->getElementsByTagName('engine');
        foreach ($engines as $engine) {
            /** @var \DOMNode $engine */
            $type  = $engine->getAttribute('type');
            $items = $engine->childNodes;
            /** @var \DOMElement $item */
            foreach ($items as $item) {
                if ($item instanceof \DOMElement) {
                    $attributes = $this->_getAllAttributesFromDomElement($item);
                    $id         = $attributes['id'];
                    if ( ! isset($result[$type])) {
                        $result[$type] = [];
                    }
                    $result[$type][$id] = $attributes;
                }
            }
        }

        return $result;
    }

    /**
     * Extracts all attributes from the given element as an associative array.
     *
     * @param \DOMElement $element
     *
     * @return array
     */
    private function _getAllAttributesFromDomElement(\DOMElement $element)
    {
        $attributes = array();

        foreach ($element->attributes as $attributeName => $attributeNode) {
            /** @var  DOMNode $attributeNode */
            $attributes[$attributeName] = $attributeNode->nodeValue;
        }

        return $attributes;
    }

}
