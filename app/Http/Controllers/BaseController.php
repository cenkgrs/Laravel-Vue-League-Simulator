<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function prepareLeague()
    {
        return response()->json(['status' => true], 200);
    }

    public function simulateMatch()
    {

    }

    public function simulateLeague()
    {

    }
}
