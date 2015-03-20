<?php namespace Mabasic\CrozillaIntegration;

use Symfony\Component\HttpFoundation\Response;

interface CrozillaInterface {

    /**
     * @param $xml
     * @return Response
     */
    public function returnXML($xml);

    /**
     * @param $items
     * @param $languages
     * @return string
     */
    public function generateXML($items, $languages);
}