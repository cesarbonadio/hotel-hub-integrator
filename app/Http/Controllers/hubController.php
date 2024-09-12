<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\commonHubRequest; 

use App\Services\hubService;

class hubController extends Controller
{
    // just a health check function
    public function getSearch(commonHubRequest $request, hubService $hubService) {
        print_r($request->hotelId);
        print_r($request->checkIn);
        print_r($request->checkOut);
        print_r($request->numberOfGuests);
        print_r($request->numberOfRooms);
        print_r($request->currency);

        $searchResult = $hubService->search();

        return response()->json($searchResult, 200);
    }
}