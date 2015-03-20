<?php namespace Mabasic\CrozillaIntegration;

use DOMCdataSection;
use DOMDocument;
use DOMElement;
use DOMNode;

/**
 * Class Bard
 * @package Mabasic\CrozillaIntegration
 *
 * Bard is a general term for a helper class that is very important
 * and does something that matters. Bard is also the name of LoL new
 * support character.
 */
class Bard implements BardInterface {

    /**
     * @var DOMDocument
     */
    protected $xmlDoc;

    public function __construct()
    {
        $this->xmlDoc = new DOMDocument('1.0', 'UTF-8');
        $this->xmlDoc->formatOutput = true;
    }

    /**
     * @param $name
     * @param null $value
     * @return DOMElement
     */
    public function createElement($name, $value = null)
    {
        return $this->xmlDoc->createElement($name, $value);
    }

    /**
     * @param DOMNode $child
     * @return DOMNode
     */
    public function appendChild(DOMNode $child)
    {
        return $this->xmlDoc->appendChild($child);
    }

    /**
     * @param $data
     * @return DOMCdataSection
     */
    public function createCDATASection($data)
    {
        return $this->xmlDoc->createCDATASection($data);
    }

    /**
     * @return string
     */
    public function getXML()
    {
        return $this->xmlDoc->saveXML();
    }

    /**
     * @param $name
     * @param null $value
     * @param DOMNode $destination
     * @return DOMNode
     */
    public function attachNode($name, $value = null, DOMNode $destination = null)
    {
        if (is_null($destination))
            return $this->appendChild($this->createElement($name, $value));

        return $destination->appendChild($this->createElement($name, $value));
    }

    /**
     * @param $name
     * @param array $names
     * @param array $data
     * @param null $destination
     * @return DOMNode
     */
    public function attachNodesByNames($name, array $names, array $data, $destination = null)
    {
        $master = $this->attachNode($name, null, $destination);

        foreach ($names as $name)
        {
            $this->attachNode($name, $data[ $name ], $master);
        }

        return $master;
    }

    /**
     * @param $name
     * @param $nodes
     * @param $alias
     * @param null $destination
     * @return DOMNode
     */
    public function attachNodes($name, $nodes, $alias, $destination = null)
    {
        $master = $this->attachNode($name, null, $destination);

        if (is_array($nodes))
        {
            foreach ($nodes as $node)
            {
                $this->attachNode($alias, $node, $master);
            }
        } else
        {
            $this->attachNode($alias, $nodes, $master);
        }

        return $master;
    }

}