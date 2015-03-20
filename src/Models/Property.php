<?php namespace Mabasic\CrozillaIntegration\Models;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

/**
 * Class Property
 * @package Mabasic\CrozillaIntegration\Models
 */
class Property implements XmlSerializable {

    /**
     * @var
     */
    public $propertyId;
    /**
     * @var
     */
    public $dateListed;
    /**
     * @var
     */
    public $propertyType;
    /**
     * @var
     */
    public $listingType;
    /**
     * @var
     */
    public $link;
    /**
     * @var
     */
    public $postalCode;
    /**
     * @var
     */
    public $city;
    /**
     * @var
     */
    public $rooms;
    /**
     * @var
     */
    public $bedrooms;
    /**
     * @var
     */
    public $bathrooms;
    /**
     * @var
     */
    public $propertySize;
    /**
     * @var
     */
    public $landSize;
    /**
     * @var
     */
    public $price;

    /**
     * Sample:
     * [ 'link1', 'link2', 'link3', ...]
     *
     * @var array
     */
    public $images = [];
    /**
     * @var
     */
    public $title;
    /**
     * @var
     */
    public $description;

    /**
     * Sample:
     * [[ 'code' => 'en',
     * 'title' => 'some title',
     * 'description' => 'some text' ], ...]
     *
     * @var array
     */
    public $languages = [];

    /**
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

    /**
     * @param Writer $writer
     */
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

    /**
     * @param Writer $writer
     */
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