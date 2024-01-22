<?php

namespace App\Http\Controllers\API;

use App\Classes\MarkersHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddMarkerRequest;
use App\Http\Requests\EditMarkerRequest;
use App\Models\Marker;
use Illuminate\Http\Request;
use App\Classes\CoordsDistanceCalculator;

class MarkerAPIController extends Controller
{
    public function add(AddMarkerRequest $addMarkerRequest)
    {
        if( $addMarkerRequest->validated() ){
            $marker         = new Marker();
            $marker->name   = $addMarkerRequest->input('name');
            $marker->lat    = $addMarkerRequest->input('lat');
            $marker->lng    = $addMarkerRequest->input('lng');
            $marker->color  = $addMarkerRequest->input('color');
            $marker->save();
            return json_encode(['marker' => $marker]);
        }else{
            return json_encode(['errors' => $addMarkerRequest->errors()]);
        }
    }
    public function edit(EditMarkerRequest $editMarkerRequest, $markerId)
    {
        $marker             = Marker::find($markerId);
        if( $editMarkerRequest->validated() ){
            $marker->name   = $editMarkerRequest->input('name');
            $marker->lat    = $editMarkerRequest->input('lat');
            $marker->lng    = $editMarkerRequest->input('lng');
            $marker->color  = $editMarkerRequest->input('color');
            $marker->save();
            return json_encode(['marker' => $marker]);
        }else{
            return json_encode(['errors' => $editMarkerRequest->errors()]);
        }
    }
    public function list()
    {
        $markers            = Marker::all();
        return json_encode(['markers' => $markers]);
    }
    public function show($markerId)
    {
        $marker             = Marker::find($markerId);
        return json_encode(['marker' => $marker]);
    }
    public function calculateRoute(Request $request)
    {
        $markers            = explode(';', $request->input('markers'));
        $markersOrdered     = MarkersHelper::orderMarkersWithShortestDistance($markers);

        return json_encode(['markersOrdered' => $markersOrdered]);
    }
}
