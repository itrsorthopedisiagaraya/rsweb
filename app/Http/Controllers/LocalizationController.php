<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($languange = 'en')
    {
        request()->session()->put('locale', $languange);
        return redirect()->back();
    }
}
