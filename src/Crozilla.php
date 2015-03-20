<?php namespace Mabasic\CrozillaIntegration;

use Mabasic\CrozillaIntegration\Models\Property;
use Sabre\Xml\Writer;
use Symfony\Component\HttpFoundation\Response;

class Crozilla implements IntegrationInterface, CrozillaInterface {

    /**
     * @var Bard
     */
    protected $bard;

    protected $writer;

    /**
     * @param Bard $bard
     * @param Writer $writer
     */
    public function __construct(Bard $bard, Writer $writer)
    {
        $this->bard = $bard;
        $this->writer = $writer;
    }

    /**
     * @param $items
     * @param array $languages
     * @return Response
     */
    public function integrate(array $items, array $languages = [])
    {
        return $this->returnXML($this->generateXML($items, $languages));
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
     * @param $languages
     * @return string
     */
    public function generateXML($items, $languages)
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

        /*$root = $this->bard->attachNode('properties');

        foreach ($items['data'] as $data)
        {
            // Property
            $property = $this->bard->attachNodesByNames('property', ['property-id', 'date-listed', 'property-type', 'listing-type', 'link'], $data, $root);

            // Location
            $this->bard->attachNodesByNames('location', ['postal-code', 'city'], $data, $property);

            // Features
            $this->bard->attachNodesByNames('features', ['rooms', 'bedrooms', 'bathrooms'], $data, $property);

            // Property size
            $this->bard->attachNodes('property-size', $data['property-size'], 'number', $property);

            // Land size
            $this->bard->attachNodes('land-size', $data['land-size'], 'number', $property);

            // Price
            $this->bard->attachNodes('price', $data['price'], 'amount', $property);

            // Images
            $this->bard->attachNodes('images', $data['images'], 'image', $property);

            // HR
            $property->appendChild(
                $this->bard->createElement("title", $data['title']));

            $description = $property->appendChild(
                $this->bard->createElement("description"));

            $description->appendChild(
                $this->bard->createCDATASection($data['description']));

            // LANGUAGES
            foreach ($languages as $language)
            {
                $property->appendChild(
                    $this->bard->createElement("title-{$language}", $data["title-{$language}"]));

                $description = $property->appendChild(
                    $this->bard->createElement("description-{$language}"));

                $description->appendChild(
                    $this->bard->createCDATASection($data["description-{$language}"]));
            }

        }

        return $this->bard->getXML();*/
    }


}