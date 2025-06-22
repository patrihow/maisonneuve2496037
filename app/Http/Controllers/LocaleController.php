<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function index($locale){
        if (! in_array($locale, ['en', 'fr'])) {
            abort(400);
        }
        session()->put('locale', $locale);
        return back();
     }
}
