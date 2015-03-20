<?php namespace Mabasic\CrozillaIntegration;

use Symfony\Component\HttpFoundation\Response;

interface IntegrationInterface {

    /**
     * @param $items
     * @param array $languages
     * @return Response
     */
    public function integrate(array $items, array $languages = []);

}