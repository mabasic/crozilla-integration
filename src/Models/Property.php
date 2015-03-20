<?php namespace Mabasic\CrozillaIntegration\Models;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Property implements XmlSerializable {

    public $propertyId;
    public $dateListed;
    public $propertyType;
    public $listingType;
    public $link;
    public $postalCode;
    public $city;
    public $rooms;
    public $bedrooms;
    public $bathrooms;
    public $propertySize;
    public $landSize;
    public $price;
    public $images = [];
    public $title;
    public $description;

    public $languages = [];
    /*'code' => 'en',
    'title' => 'some title',
    'description' => 'some text'*/

    /**
     * The xmlSerialize metod is called during xml writing.
     *
     * Use the $writer argument to write its own xml serialization.
     *
     * An important note: do _not_ create a parent element. Any element
     * implementing XmlSerializble should only ever write what's considered
     * its 'inner xml'.
     *
     * The parent of the current element is responsible for writing a
     * containing element.
     *
     * This allows serializers to be re-used for different element names.
     *
     * If you are opening new elements, you must also close them again.
     *
     * @param Writer $writer
     */
    function xmlSerialize(Writer $writer)
    {
        $structure = [
            'property-id'   => $this->propertyId,
            'date-listed'   => $this->dateListed,
            'property-type' => $this->propertyType,
            'listing-type'  => $this->listingType,
            'link'          => $this->link,
            'location'      => [
                'postal-code' => $this->postalCode,
                'city'        => $this->city
            ],
            'features'      => [
                'rooms'     => $this->rooms,
                'bedrooms'  => $this->bedrooms,
                'bathrooms' => $this->bathrooms
            ],
            'property-size' => [
                'number' => $this->propertySize
            ],
            'land-size'     => [
                'number' => $this->landSize
            ],
            'price'         => [
                'amount' => $this->price
            ],
            'title'         => $this->title,
            'description'   => $this->description
        ];

        $writer->write($structure);

        $this->addLanguages($writer);

        $this->addImages($writer);
    }

    private function addImages(Writer $writer)
    {
        $writer->startElement('images');

        foreach($this->images as $image)
        {
            $writer->startElement('image');
            $writer->write($image);
            $writer->endElement();
        }

        $writer->endElement();
    }

    private function addLanguages(Writer $writer)
    {
        foreach($this->languages as $language)
        {
            $code = strtoupper($language['code']);
            $writer->writeElement("title-{$code}", $language['title']);
            $writer->writeElement("description-{$code}", $language['description']);
        }
    }
}