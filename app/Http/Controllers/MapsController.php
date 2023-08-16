<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class MapsController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        return view('index');
    }
}
