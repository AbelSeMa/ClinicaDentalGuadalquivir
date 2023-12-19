<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Worker;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CitasController extends Controller
{
    public function index(Request $request)
    {
        $filtroAnio = $request->input('filtro_anio');

        $fechaActual = Carbon::now()->toDateString();

        if ($filtroAnio) {
            $citas = Appointment::with(['patient.usuario', 'worker.usuario'])
                ->whereYear('date', $filtroAnio)
                ->paginate(25);
        } elseif ($request->has('ver_citas_hoy')) {
            $citas = Appointment::with(['patient.usuario', 'worker.usuario'])
                ->whereDate('date', $fechaActual)
                ->paginate(25);
        } else {
            $citas = Appointment::with(['patient.usuario', 'worker.usuario'])->paginate(25);
        }

        return view('adminDashboard', compact('citas'));
    }

    public function horasDisponibles(Request $request) 
    {
        $fecha = $request->input('fecha');

        $citas = DB::table('appoinntments')->where('date', $fecha)->pluck('hour');
        dd($citas);

        $inicio = new DateTime('8:00');
        $fin = new DateTime('16:00');

        $intervalo = new DateInterval('PT30M');

        $dates = new DatePeriod($inicio, $intervalo, $fin);

        $horas_disponible = [];

        foreach ($dates as $fecha) {
            $hora = $fecha->format('H:i');

            if (!$citas->contains($hora)) {
                $horas_disponible[] = $hora;
            }
        }

        return response()->json([
            'horas' => $horas_disponible
        ]);
    }

    public function formulario() {

        $doctores = Worker::all();

        return view('formularioCita', compact('doctores'));
    }
}

