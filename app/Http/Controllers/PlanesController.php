<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanesController extends Controller
{
    public function index()
    {
        return view('planes');
    }

    public function show($plan)
    {
        return view('mostrarPlanes', compact('plan'));
    }

}
