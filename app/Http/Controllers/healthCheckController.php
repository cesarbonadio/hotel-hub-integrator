<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class healthCheckController extends Controller
{
    // just a health check function
    public function index() {
        return response()->json(["message" => "ok"], 200);
    }
}