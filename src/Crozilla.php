<?php namespace Mabasic\CrozillaIntegration;

use Mabasic\CrozillaIntegration\Models\Property;
use Sabre\Xml\Writer;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Crozilla
 * @package Mabasic\CrozillaIntegration
 */
class Crozilla implements IntegrationInterface, CrozillaInterface {

    /**
     * @var Writer
     */
    protected $writer;

    /**
     * @param Writer $writer
     */
    public function __construct(Writer $writer)
    {
        $this->writer = $writer;
    }

    /**
     * @param $items
     * @return Response
     */
    public function integrate(array $items)
    {
        return $this->returnXML($this->generateXML($items));
    }

    /**
     * @param $xml
     * @return Response
     */
    public function returnXML($xml)
    {
        return new Response($xml, Response::HTTP_OK, ['Content-Type' => 'text/xml']);
    }

    /**
     * @param $items
     * @return string
     */
    public function generateXML($items)
    {
        $this->writer->openMemory();

        $this->writer->startElement('properties');

        foreach ($items['data'] as $data)
        {
            $property = new Property();
            $property->propertyId = $data['property-id'];
            $property->dateListed = $data['date-listed'];
            $property->propertyType = $data['property-type'];
            $property->listingType = $data['listing-type'];
            $property->link = $data['link'];
            $property->postalCode = $data['postal-code'];
            $property->city = $data['city'];
            $property->rooms = $data['rooms'];
            $property->bedrooms = $data['bedrooms'];
            $property->bathrooms = $data['bathrooms'];
            $property->propertySize = $data['property-size'];
            $property->landSize = $data['land-size'];
            $property->price = $data['price'];
            $property->images = $data['images'];
            $property->title = $data['title'];
            $property->description = $data['description'];
            $property->languages = $data['languages'];

            $this->writer->write([
                'property' => $property
            ]);
        }

        $this->writer->endElement();

        return $this->writer->outputMemory();
    }

}