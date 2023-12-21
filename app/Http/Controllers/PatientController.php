<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        // Obtener el paciente actualmente autenticado
        $patientId = auth()->user()->id;
        $patient = auth()->user()->paciente;
        $citas = Appointment::where('patient_id', $patientId)
            ->with('patient', 'worker.usuario')
            ->get();
        // Pasar la variable $patient a la vista, incluso si es null
        return view('userDashboard', compact('patient', 'citas'));
    }
}
