<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanesController extends Controller
{
    public function index()
    {
        $planes = Plan::all();
        return view('planes', compact('planes'));
    }

    public function show($plan)
    {
        Plan::findOrFail($plan);

        return view('mostrarPlan', compact('plan'));
    }

}
