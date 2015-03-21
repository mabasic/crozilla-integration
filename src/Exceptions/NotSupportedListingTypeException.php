<?php namespace Mabasic\CrozillaIntegration\Exceptions;

use Exception;

class NotSupportedListingTpeException extends Exception {

    /**
     * @param string $listingType
     */
    function __construct($listingType)
    {
        $message = "[{$listingType}] is not supported by Crozilla.";
        parent::__construct($message);
    }

}