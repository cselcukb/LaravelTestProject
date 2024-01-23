<?php

namespace App\Classes;

class CoordsDistanceCalculator
{
    /**
     * Calculates the distance between two points, given their
     * latitude and longitude, and returns an array of values
     * of the most common distance units
     * Spherical law of cosines formula is used
     * cos c = cos a cos b + sin a sin b cos C
     *
     * @param float $lat1 Latitude of point 1
     * @param float $lon1 Longitude of point 1
     * @param float $lat2 Latitude of point 2
     * @param float $lon2 Longitude of point 2
     * @return float
    */
    public static function getDistanceBetweenTwoInKms($lat1, $lon1, $lat2, $lon2) {
        $theta                  = $lon1 - $lon2;
        $dist                   = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist                   = acos($dist);
        $dist                   = rad2deg($dist);
        $distanceInMiles        = $dist * 60 * 1.1515;
        $distanceInKilometers   = $distanceInMiles * 1.609344;

        return $distanceInKilometers;
    }
}
