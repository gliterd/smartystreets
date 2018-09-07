<?php

namespace SmartyStreets;

use SmartyStreets\Location\Location;
use SmartyStreets\Location\Lookup;
use GuzzleHttp\Client;

class Service
{
    protected $authId;

    protected $authToken;

    private $simulation = false;

    public function __construct($authId, $authToken, $simulation = false)
    {
        $this->authId = $authId;
        $this->authToken = $authToken;
        $this->setSimulation($simulation);
    }

    public function setSimulation($value)
    {
        $this->simulation = $value;
    }

    public function getSimulation()
    {
        return $this->simulation;
    }

    public function getInspectedLocation($location)
    {
        if ($this->getSimulation()) {
            return new Location($this->getSampleLocation());
        }

        return new Location($this->getRequest(new Lookup($location)));
    }

    public function getRequest(Lookup $location)
    {
        $client = new Client([
            'base_uri' => 'https://international-street.api.smartystreets.com/',
        ]);
        $response = $client->request('GET', 'verify', [
            'query' => [
                'auth-id'     => $this->authId,
                'auth-token'  => $this->authToken,
                'address1'    => $location->getStreet().' '.$location->getStreetNumber(),
                'locality'    => $location->getPlace(),
                'postal_code' => $location->getPostcode(),
                'country'     => $location->getCountry(),
                'geocode'     => $location->getGeocode(),
            ],
        ]);

        $body = json_decode($response->getBody(), true);

        return reset($body);
    }

    protected function getSampleLocation()
    {
        return [
            'address1'   => 'Birgistrasse 10',
            'address2'   => '8304 Wallisellen',
            'components' => [

                'administrative_area'     => 'ZH',
                'sub_administrative_area' => 'Bülach',
                'country_iso_3'           => 'CHE',
                'locality'                => 'Wallisellen',
                'postal_code'             => '8304',
                'postal_code_short'       => '8304',
                'premise'                 => '10',
                'premise_number'          => '10',
                'thoroughfare'            => 'Birgistrasse',

            ],
            'metadata' => [

                'latitude'              => 47.41603,
                'longitude'             => 8.57788,
                'geocode_precision'     => 'Premise',
                'max_geocode_precision' => 'DeliveryPoint',
                'address_format'        => 'thoroughfare premise|postal_code locality',
            ],
            'analysis' => [
                'verification_status'   => 'Verified',
                'address_precision'     => 'Premise',
                'max_address_precision' => 'Premise',
            ],
        ];
    }
}
