<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        // Obtener el paciente actualmente autenticado
        $patient = auth()->user()->paciente;

        // Pasar la variable $patient a la vista, incluso si es null
        return view('userDashboard', compact('patient'));
    }
}