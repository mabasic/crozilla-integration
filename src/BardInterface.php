<?php namespace Mabasic\CrozillaIntegration;

use DOMCdataSection;
use DOMNode;
use DOMElement;


/**
 * Class Bard
 * @package Mabasic\CrozillaIntegration
 *
 * Bard is a general term for a helper class that is very important
 * and does something that matters. Bard is also the name of LoL new
 * support character.
 */
interface BardInterface {

    /**
     * @param $name
     * @param null $value
     * @return DOMElement
     */
    public function createElement($name, $value = null);

    /**
     * @param DOMNode $child
     * @return DOMNode
     */
    public function appendChild(DOMNode $child);

    /**
     * @param $data
     * @return DOMCdataSection
     */
    public function createCDATASection($data);

    /**
     * @return string
     */
    public function getXML();

    /**
     * @param $name
     * @param null $value
     * @param DOMNode $destination
     * @return DOMNode
     */
    public function attachNode($name, $value = null, DOMNode $destination = null);

    /**
     * @param $name
     * @param array $names
     * @param array $data
     * @param null $destination
     * @return DOMNode
     */
    public function attachNodesByNames($name, array $names, array $data, $destination = null);

    /**
     * @param $name
     * @param $nodes
     * @param $alias
     * @param null $destination
     * @return DOMNode
     */
    public function attachNodes($name, $nodes, $alias, $destination = null);
}