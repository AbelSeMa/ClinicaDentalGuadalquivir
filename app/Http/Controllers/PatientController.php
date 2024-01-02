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
            ->orderBy('date')
            ->simplePaginate(5);

        $numCitas = Appointment::where('patient_id', $patientId)->count();

        return view('userDashboard', compact('patient', 'citas', 'numCitas'));
    }
}
