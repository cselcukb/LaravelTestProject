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
                $startMarkerLatLng  = explode(',', trim( $startMarker ) );
                $markerLatLng       = explode(',', trim( $marker ) );
                $distance = CoordsDistanceCalculator::distance(
                    $startMarkerLatLng[0],
                    $startMarkerLatLng[1],
                    $markerLatLng[0],
                    $markerLatLng[1],
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
}
