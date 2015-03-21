<?php namespace Mabasic\CrozillaIntegration\Exceptions;

use Exception;

class NotSupportedPropertyTpeException extends Exception {

    /**
     * @param string $propertyType
     */
    function __construct($propertyType)
    {
        $message = "[{$propertyType}] is not supported by Crozilla.";
        parent::__construct($message);
    }

}