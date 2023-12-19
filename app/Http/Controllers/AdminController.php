<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\Patient;

class AdminController extends Controller
{
    public function index()
    {
            $trabajadores = Worker::with('usuario')->simplePaginate(10);
            $pacientes = Patient::with('usuario')->simplePaginate(5);
        
            return view('adminDashboard', [
                'trabajadores' => $trabajadores,
                'pacientes' => $pacientes,
            ]);
    }
}