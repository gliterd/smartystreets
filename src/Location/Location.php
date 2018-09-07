<?php

namespace SmartyStreets\Location;

class Location
{
    private $street;
    private $streetNumber;
    private $locality;
    private $postcode;
    private $country = 'Switzerland';
    private $latitude;
    private $longitude;
    private $verified = false;

    public function __construct($locationArray)
    {
        $this->verified = (isset($locationArray['analysis']) && $locationArray['analysis']['verification_status'] && $locationArray['analysis']['verification_status'] == 'Verified') ? true : false;

        if (isset($locationArray['components']) && is_array($locationArray['components'])) {
            $this->street = isset($locationArray['components']['thoroughfare']) ? $locationArray['components']['thoroughfare'] : '';
            $this->streetNumber = isset($locationArray['components']['premise']) ? $locationArray['components']['premise'] : '';
            $this->locality = isset($locationArray['components']['locality']) ? $locationArray['components']['locality'] : '';
            $this->postcode = isset($locationArray['components']['postal_code']) ? $locationArray['components']['postal_code'] : '';
            $this->country = isset($locationArray['components']['country_iso_3']) ? $locationArray['components']['country_iso_3'] : '';
        }

        if (isset($locationArray['metadata']) && is_array($locationArray['metadata'])) {
            $this->latitude = isset($locationArray['metadata']['latitude']) ? $locationArray['metadata']['latitude'] : '';
            $this->longitude = isset($locationArray['metadata']['longitude']) ? $locationArray['metadata']['longitude'] : '';
        }
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    public function getLocality()
    {
        return $this->locality;
    }

    public function getPostalCode()
    {
        return $this->postcode;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function getIsVerified()
    {
        return $this->verified;
    }
}
