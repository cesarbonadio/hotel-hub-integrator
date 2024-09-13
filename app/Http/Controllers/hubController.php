<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\commonHubRequest; 

use App\Services\hubService;

class hubController extends Controller
{
    // just a health check function
    public function getSearch(
        commonHubRequest $request, 
        hubService $hubService
    ) {
        $searchResult = $hubService->search($request);
        return response()->json($searchResult, 200);
    }
}