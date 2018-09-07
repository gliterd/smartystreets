<?php

namespace SmartyStreets\Location;

class Lookup
{
    private $street;
    private $streetNumber;
    private $place;
    private $postcode;
    private $country = 'Switzerland';
    private $geocode = 'true';

    public function __construct($values)
    {
        $this->setStreet(isset($values['street']) ? $values['street'] : '');
        $this->setStreetNumber(isset($values['street_number']) ? $values['street_number'] : '');
        $this->setPlace(isset($values['place']) ? $values['place'] : '');
        $this->setPostcode(isset($values['postcode']) ? $values['postcode'] : '');
        $this->setCountry(isset($values['country']) ? $values['country'] : 'Switzerland');
        $this->setGeocode(isset($values['geocodes']) ? $values['geocodes'] : 'true');
    }

    public function setStreet($value)
    {
        $this->street = $value;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function setStreetNumber($value)
    {
        $this->streetNumber = $value;
    }

    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    public function setPlace($value)
    {
        $this->place = $value;
    }

    public function getPlace()
    {
        return $this->place;
    }

    public function setPostcode($value)
    {
        $this->postcode = $value;
    }

    public function getPostcode()
    {
        return $this->postcode;
    }

    public function setCountry($value)
    {
        $this->country = $value;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setGeocode($value)
    {
        $this->geocode = $value;
    }

    public function getGeocode()
    {
        return $this->geocode;
    }
}
