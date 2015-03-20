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
            'images'        => $this->writeImages($writer),
            'title'         => $this->title,
            'description'   => $this->description
        ];

        $this->addLanguages($structure);

        $writer->write($structure);
    }

    private function writeImages()
    {
        $tmp = [];

        foreach($this->images as $image)
        {
            array_push($tmp, [
                'image' => $image
            ]);
        }

        return $tmp;
    }

    private function addLanguages($structure)
    {
        foreach($this->languages as $language)
        {
            array_push($structure, [
                "title-{$language->code}" => $language->title,
                "description-{$language->code}" => $language->description,
            ]);
        }
    }
}