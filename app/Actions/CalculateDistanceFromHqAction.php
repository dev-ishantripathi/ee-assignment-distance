<?php

namespace App\Actions;

use App\Helpers\PositionStackHelper;
use Illuminate\Http\Client\RequestException;

class CalculateDistanceFromHqAction
{
    /**
     * @param string $hqAddress
     * @param array  $toLocationsAddress
     *
     * @return array
     * @throws RequestException
     */
    public function execute(string $hqAddress, array $toLocationsAddress): array
    {
        $geoLocations = $this->getGeoLocation(
            $toLocationsAddress,
            ['results.latitude', 'results.longitude', 'results.name']
        );

        //TODO: Calculate distance

        return [];
    }

    /**
     * @param array $addresses
     * @param array $fields
     *
     * @return array
     * @throws RequestException
     */
    private function getGeoLocation(array $addresses, array $fields = []): array
    {
        $geoLocations = [];
        foreach ($addresses as $address) {
            $location = (new PositionStackHelper())->forwardGeoLocation($address, $fields);
            $location['address'] = $address;
            $geoLocations[] = $location;
       }

        return $geoLocations;
    }
}
