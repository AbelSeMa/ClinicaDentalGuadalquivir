<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Worker;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Validation\Rule;

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

        return response()->json([
            'dias' => $fechas_sin_citas
        ]);
    }

    public function formulario()
    {

        $doctores = Worker::all();

        return view('formularioCita', compact('doctores'));
    }

    public function store(Request $request)
    {

        $horasValidas = [
            '08:00:00', '08:30:00', '09:00:00', '09:30:00', '10:00:00', '10:30:00', '11:00:00', '11:30:00',
            '12:00:00', '12:30:00', '13:00:00', '13:30:00', '14:00:00', '14:30:00', '15:00:00', '15:30:00'
         ];
        $request->validate([
            'fecha' => 'required|date',
            'hora' => ['required', 'date_format:H:i:s', Rule::in($horasValidas)],
            'doctor' => 'required'
            ]
        );


        try {
            DB::table('appointments')->insert([
                'patient_id' => Auth::user()->id,
                'worker_id' => $request->doctor,
                'date' => $request->fecha,
                'hour' => Carbon::createFromFormat('H:i:s', $request->hora)->format('H:i'),
                'notes' => $request->notas,
                'attended' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            return redirect('user/dashboard')->with('success', 'Su cita ha sido reservada correctamente.');
        } catch (QueryException $e) {
            // Manejar el error aquí
            return redirect()->back()->with('error', 'Error al almacenar la cita: ' . $e->getMessage());
        }
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        
        return redirect('/user/dashboard');
    }

    public function update(Request $request, $id)
{
    $cita = Appointment::find($id);
    $cita->hour = $request->input('hora');
    $cita->save();

    return redirect()->back()->with('success', 'La hora de la cita se ha actualizado correctamente.');
}
    

}
