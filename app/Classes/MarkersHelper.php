<?php

namespace App\Classes;

use App\Classes\CoordsDistanceCalculator;

class MarkersHelper
{
    public static function orderMarkersWithShortestDistance( $markers ) {
        if ( count( $markers ) === 0 ) {
            return [];
        }
        $startMarker        = $markers[0];
        $markersInOrder     = [];
        $markersInOrder[]   = $startMarker;
        unset( $markers[0] );

        while ( count($markers) > 0 ) {
            $closestMarker = null;
            $closestDistance = null;
            foreach ( $markers as $marker ) {
                $distance = CoordsDistanceCalculator::getDistanceBetweenTwoInKms(
                    $startMarker['lat'],
                    $startMarker['lng'],
                    $marker['lat'],
                    $marker['lng'],
                );
                if ( $closestDistance === null || $distance < $closestDistance ) {
                    $closestMarker = $marker;
                    $closestDistance = $distance;
                }
            }
            $markersInOrder[] = $closestMarker;
            unset( $markers[ array_search( $closestMarker, $markers ) ] );
            $startMarker = $closestMarker;
        }

        return $markersInOrder;
    }

    public static function convertMarkersToLatLngArray( $markers ) {
        $markersLatLng = [];
        foreach ( $markers as $marker ) {
            $markerLatLng = explode(',', trim( $marker ) );
            if( isset($markerLatLng[0]) && isset($markerLatLng[1] ) ){
                $markersLatLng[] = [
                    'lat' => $markerLatLng[0],
                    'lng' => $markerLatLng[1],
                ];
            }else{
                return AppHelper::returnErrorResponse('Invalid marker format' );
            }
        }
        return AppHelper::returnSuccessResponse( $markersLatLng );
    }
}
