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

    public function show($id)
    {
        $plan = Plan::findOrFail($id);
        $servicios = $plan->services;

        return view('mostrarPlan', compact('plan', 'servicios'));
    }

}
