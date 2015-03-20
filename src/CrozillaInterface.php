<?php namespace Mabasic\CrozillaIntegration;

use Symfony\Component\HttpFoundation\Response;

/**
 * Interface CrozillaInterface
 * @package Mabasic\CrozillaIntegration
 */
interface CrozillaInterface {

    /**
     * @param $xml
     * @return Response
     */
    public function returnXML($xml);

    /**
     * @param $items
     * @return string
     */
    public function generateXML($items);
}