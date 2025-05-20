<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = \App\Models\City::all();
        return view('cities.index', ['cities' => $cities]);
    }
}
