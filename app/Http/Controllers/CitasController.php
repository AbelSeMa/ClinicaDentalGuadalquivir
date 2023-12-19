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

        // Obtener las citas para la fecha especificada
        $citas = DB::table('appointments')->where('date', $fecha)->pluck('hour');

        // Definir el rango de horas disponibles
        $inicio = new DateTime('8:00:00');
        $fin = new DateTime('16:00:00');
        $intervalo = new DateInterval('PT30M');
        $dates = new DatePeriod($inicio, $intervalo, $fin);

        // Filtrar las horas disponibles
        $horas_disponibles = [];

        foreach ($dates as $fecha) {
            $hora = $fecha->format('H:i:s');

            if (!$citas->contains($hora)) {
                $horas_disponibles[] = $hora;
            }
        }

        // Devolver la respuesta JSON
        return response()->json([
            'horas' => $horas_disponibles
        ]);
    }


    public function formulario()
    {

        $doctores = Worker::all();

        return view('formularioCita', compact('doctores'));
    }

    public function diasSinCitas()
    {
        // Obtener todas las fechas con horas reservadas
        $fechas_con_citas = DB::table('appointments')->pluck('date')->unique();

        // Obtener todas las fechas en el rango deseado
        $inicio = new DateTime('2023-01-01'); // Reemplaza 'fecha_inicial' con tu fecha inicial
        $fin = new DateTime('2023-12-31');       // Reemplaza 'fecha_final' con tu fecha final
        $intervalo = new DateInterval('P1D');     // Intervalo de un día
        $dates = new DatePeriod($inicio, $intervalo, $fin);

        // Filtrar las fechas sin horas reservadas
        $fechas_sin_citas = [];

        foreach ($dates as $fecha) {
            $fecha_str = $fecha->format('Y-m-d');

            // Verificar si hay horas reservadas para esa fecha
            $horas_reservadas = DB::table('appointments')->where('date', $fecha_str)->count();

            if ($horas_reservadas === 16) {
                $fechas_sin_citas[] = $fecha_str;
            }
        }

        $doctores = Worker::all();

        return view('formularioCita', compact('doctores', 'fechas_sin_citas'));
    }
}
