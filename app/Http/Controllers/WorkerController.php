<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Report;
use App\Models\User;
use App\Models\Worker;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WorkerController extends Controller
{
    //
    public function index()
    {
        // Obtener el paciente actualmente autenticado

        $worker = auth()->user()->trabajador->id;

        $citas = Appointment::where('worker_id', $worker)->get();

        return view('worker.dashboard', compact('worker', 'citas'));
    }

    public function atenderCita(Request $request)
    {
        $cita = Appointment::findOrFail($request->cita_id);
        $request->validate([
            'estado' => 'required|in:Presentado,No presentado', // Validar que el estado sea uno de los valores permitidos
            'informe' => 'required|string|min:10' // El informe debe ser requerido y tener al menos 10 caracteres
        ]);
    
        try {

            $cita->update([
                'status' => $request->estado
            ]);
            // Buscar el reporte asociado a la cita
            $report = Report::where('appointment_id', $request->cita_id)->first();
    
            if ($report) {
                $report->content = $request->informe;
                $report->save();
                return redirect('trabajador/dashboard')->with('success', 'La cita ha sido actualizada correctamente.');
            } else {
                $report = new Report();
                $report->appointment_id = $request->cita_id;
                $report->worker_id = $request->worker_id;
                $report->content = $request->informe;
                $report->save();
            }
    
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect('trabajador/dashboard')->with('error', 'No se ha podido atender la cita correctamente.');
        }
    
        return redirect('trabajador/dashboard')->with('success', 'La cita ha sido atendida correctamente.');
    }

    public function datosPaciente($id)
    {
        $paciente = Patient::with('usuario')->findOrFail($id);

        return response()->json([
            'paciente' => $paciente
        ]);
    }
}
