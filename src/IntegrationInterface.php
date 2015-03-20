<?php namespace Mabasic\CrozillaIntegration;

use Symfony\Component\HttpFoundation\Response;

/**
 * Interface IntegrationInterface
 * @package Mabasic\CrozillaIntegration
 */
interface IntegrationInterface {

    /**
     * @param $items
     * @return Response
     */
    public function integrate(array $items);

}