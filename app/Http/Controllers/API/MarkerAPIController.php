<?php

namespace App\Http\Controllers\API;

use App\Classes\MarkersHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddMarkerRequest;
use App\Http\Requests\EditMarkerRequest;
use App\Models\Marker;
use Illuminate\Http\Request;

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
            return response()->json(['status' => true, 'marker' => $marker], 200);
        }else{
            return response()->json(['status' => false, 'errors' => $addMarkerRequest->errors()], 500);
        }
    }
    public function edit(EditMarkerRequest $editMarkerRequest, $markerId)
    {
        $marker             = Marker::find($markerId);
        if( $marker ){
            if( $editMarkerRequest->validated() ){
                $marker->name   = $editMarkerRequest->input('name');
                $marker->lat    = $editMarkerRequest->input('lat');
                $marker->lng    = $editMarkerRequest->input('lng');
                $marker->color  = $editMarkerRequest->input('color');
                $marker->save();
                return response()->json(['status' => true, 'marker' => $marker], 200);
            }else{
                return response()->json(['status' => false, 'errors' => $editMarkerRequest->errors()], 500);
            }
        }else{
            return response()->json(['status' => false, 'error' => 'Marker not found'], 404);
        }
    }
    public function list()
    {
        $markers            = Marker::all();
        return response()->json(['status' => true, 'markers' => $markers], 200);
    }
    public function show($markerId)
    {
        $marker             = Marker::find($markerId);
        if( $marker ){
            return response()->json(['status' => true, 'marker' => $marker], 200);
        }else{
            return response()->json(['status' => false, 'error' => 'Marker not found'], 404);
        }
    }
    public function calculateRoute(Request $request)
    {
        $markersArray       = json_decode($request->input('markers'), true);
        $markersValidated   = MarkersHelper::convertMarkersToLatLngArray( $markersArray );
        if( !$markersValidated['success'] ){
            return response()->json(['status' => false, 'error' => $markersValidated['message']], 500);
        }else{
            $markersOrdered     = MarkersHelper::orderMarkersWithShortestDistance( $markersValidated['data'] );
        }

        return response()->json(['status' => true, 'markersOrdered' => $markersOrdered], 200);
    }
}
