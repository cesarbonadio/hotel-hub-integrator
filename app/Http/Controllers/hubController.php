<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\commonHubRequest; 

class hubController extends Controller
{
    // just a health check function
    public function getSearch(commonHubRequest $request) {
        print_r($request->hotelId);
        print_r($request->checkIn);
        print_r($request->checkOut);
        print_r($request->numberOfGuests);
        print_r($request->numberOfRooms);
        print_r($request->currency);

        return response()->json(["message" => "ok"], 200);
    }
}