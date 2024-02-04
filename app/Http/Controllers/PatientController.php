<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        // Obtener el paciente actualmente autenticado
        $patient = auth()->user()->paciente;
        $patientId = $patient->id;

        $citas = Appointment::where('patient_id', $patientId)
            ->with('patient', 'worker.usuario')
            ->orderBy('date')
            ->simplePaginate(5);

        $numCitas = Appointment::where('patient_id', $patientId)->count();

        return view('userDashboard', compact('patient', 'citas', 'numCitas'));
    }

    public function buscar(Request $request)
    {

        $patients = User::where('first_name', 'like', '%' . $request->get('term') . '%')->get();
        return response()->json($patients);
    }
}
