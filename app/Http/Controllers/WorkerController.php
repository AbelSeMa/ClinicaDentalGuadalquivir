<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Report;
use App\Models\User;
use App\Models\Worker;
use Carbon\Carbon;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

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
        $request->validate([
            'estado' => 'required|in:Presentado,No presentado', // Validar que el estado sea uno de los valores permitidos
            'informe' => 'required|string|min:10' // El informe debe ser requerido y tener al menos 10 caracteres
        ]);

        try {
            $cita = Appointment::findOrFail($request->cita_id);

            // Actualizar el estado de la cita
            $cita->status = $request->estado;
            $cita->save();

            // Buscar el reporte asociado a la cita
            $report = Report::where('appointment_id', $request->cita_id)->first();

            if ($report) {
                // Si existe, actualizar el contenido del informe
                $report->content = $request->informe;
                $report->save();
            } else {
                // Si no existe, crear un nuevo informe
                $report = new Report();
                $report->appointment_id = $request->cita_id;
                $report->worker_id = $request->worker_id;
                $report->content = $request->informe;
                $report->save();
            }

            return redirect('trabajador/dashboard')->with('success', 'La cita ha sido atendida correctamente.');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect('trabajador/dashboard')->with('error', 'No se ha podido atender la cita correctamente.');
        }
    }

    public function datosPaciente($id)
    {
        $cita = Appointment::with('report')->findOrFail($id);

        $paciente = Patient::with('usuario')->findOrFail($cita->patient_id);

        $reporte = $cita->report;

        return response()->json([
            'paciente' => $paciente,
            'reporte' => $reporte
        ]);
    }

    public function asignarCita()
    {
        return view('worker.citas');
    }

    public function almacenarCita(Request $request)
    {

        $pacienteId = $_COOKIE['paciente'];

        $horasValidas = [
            '08:00:00', '08:30:00', '09:00:00', '09:30:00', '10:00:00', '10:30:00', '11:00:00', '11:30:00',
            '12:00:00', '12:30:00', '13:00:00', '13:30:00', '14:00:00', '14:30:00', '15:00:00', '15:30:00'
        ];
        $request->validate(
            [
                'fecha' => 'required|date',
                'hora' => ['required', 'date_format:H:i:s', Rule::in($horasValidas)],
                'doctor' => 'required'
            ]
        );


        try {
            DB::table('appointments')->insert([
                'patient_id' => $pacienteId,
                'worker_id' => $request->doctor,
                'date' => $request->fecha,
                'hour' => Carbon::createFromFormat('H:i:s', $request->hora)->format('H:i'),
                'notes' => $request->notas,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $response = new Response('Su cita ha sido reservada correctamente.');
            $response->withCookie(Cookie::forget('paciente'));

            return redirect('trabajador/dashboard')->with('success', 'Su cita ha sido reservada correctamente.');
        } catch (QueryException $e) {
            // Manejar el error aquí
            return redirect()->back()->with('error', 'Error al almacenar la cita. Intentelo de nuevo');
        }
    }
}
