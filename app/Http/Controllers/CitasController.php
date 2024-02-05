<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Report;
use App\Models\Worker;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use DateInterval;
use DatePeriod;
use DateTime;

class CitasController extends Controller
{
    public function index(Request $request)
    {
        $trabajadores = Worker::all();
        $citas = $this->getCitasFiltradas($request);

        return view('adminDashboard', compact('citas', 'trabajadores'));
    }

    public function workerDashboard(Request $request)
    {
        $trabajador = Auth::user()->trabajador;
        $citas = $this->getCitasFiltradas($request)->sortBy('date');

        return view('worker.dashboard', compact('citas'));
    }

    private function getCitasFiltradas(Request $request)
    {
        if (Auth::user()->admin) {
            $query = Appointment::with(['patient.usuario', 'worker.usuario']);
        }

        if (Auth::user()->trabajador) {
            $query = Appointment::where('worker_id', Auth::user()->trabajador->id)
                ->with(['patient.usuario', 'worker.usuario']);
        }

        if ($request->has('filtro_anio') && $request->input('filtro_anio') !== null) {
            $query->whereYear('date', $request->input('filtro_anio'));
        }

        if ($request->has('ver_citas_hoy') && $request->input('ver_citas_hoy') !== null) {
            $query->whereDate('date', Carbon::now()->toDateString());
        }

        if ($request->has('filtro_semana') && $request->input('filtro_semana') !== null) {
            $inicioSemana = Carbon::now()->startOfWeek()->toDateString();
            $finSemana = Carbon::now()->endOfWeek()->toDateString();
            $query->whereBetween('date', [$inicioSemana, $finSemana]);
        }

        if ($request->has('doctor') && $request->input('doctor') !== null) {
            $query->where('worker_id', $request->input('doctor'));
        }

        if ($request->has('paciente_id') && $request->input('paciente_id') !== null) {
            $query->whereHas('patient.usuario', function ($query) use ($request) {
                $query->where('id', $request->input('paciente_id'));
            });
        }
        return $query->paginate(25);
    }

    public function horasDisponibles(Request $request)
    {
        $fecha = $request->input('fecha');
        $doctor = $request->input('doctor');

        // Obtener las citas para la fecha especificada
        $citas = Appointment::where('date', $fecha)
            ->where('worker_id', $doctor)
            ->pluck('hour');

        // Definir el rango de horas disponibles
        $inicio = new DateTime('8:00:00');
        $fin = new DateTime('16:00:00');
        $intervalo = new DateInterval('PT30M');
        $dates = new DatePeriod($inicio, $intervalo, $fin);

        $horas_disponibles = [];
        $horaActual = now()->format('H:i:s');



        foreach ($dates as $date) {
            $hora = $date->format('H:i:s');

            if (strtotime($fecha) == strtotime(now()->format('Y-m-d'))) {
                if ($hora >= $horaActual && !$citas->contains($hora)) {
                    $horas_disponibles[] = $hora;
                }
                return response()->json([
                    'horas' => $horas_disponibles
                ]);
            }

            if (!$citas->contains($hora)) {
                $horas_disponibles[] = $hora;
            }
        }

        // Devolver la respuesta JSON
        return response()->json([
            'horas' => $horas_disponibles
        ]);
    }

    public function diasSinCitas(Request $request)
    {
        // Obtener todas las fechas con horas reservadas
        $fechas_con_citas = DB::table('appointments')->pluck('date')->unique();

        $anyoActual = date('Y');

        // Rango de fechas para el calendario
        $inicio = new DateTime("$anyoActual-01-01");
        $fin = new DateTime("$anyoActual-12-31");
        $intervalo = new DateInterval('P1D');
        $dates = new DatePeriod($inicio, $intervalo, $fin);

        // Filtrar las fechas sin horas disponibles
        $fechas_sin_citas = [];
        $doctorId = $request->input('doctor');

        foreach ($dates as $fecha) {
            $fecha_str = $fecha->format('Y-m-d');

            // Verificar si hay horas reservadas para esa fecha
            $horas_reservadas = DB::table('appointments')
                ->where('date', $fecha_str)
                ->where('worker_id', $doctorId)
                ->count();

            if ($horas_reservadas === 16) {
                $fechas_sin_citas[] = $fecha_str;
            }

            #TODO añadir una tabla para los días que el trabajador no podrá asistir
        }


        return response()->json([
            'dias' => $fechas_sin_citas
        ]);
    }

    public function formulario()
    {

        $doctores = Worker::all();
        $usuario = Auth::user()->paciente->id;
        $numCitas = Appointment::where('patient_id', $usuario   )
                                ->where('status', 'Pendiente')
                                ->count();

        return view('formularioCita', compact('doctores', 'numCitas'));
    }

    public function store(Request $request)
    {

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

        $usuario = Auth::user()->paciente->id;
        $numCitas = Appointment::where('patient_id', $usuario)->count();

        try {
            if ($numCitas >= 4) {
                return redirect('usuario/dashboard')->with('error', 'Has alcanzado el límite de citas reservadas');
            }
            DB::table('appointments')->insert([
                'patient_id' => $usuario,
                'worker_id' => $request->doctor,
                'date' => $request->fecha,
                'hour' => Carbon::createFromFormat('H:i:s', $request->hora)->format('H:i'),
                'notes' => $request->notas,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect('usuario/dashboard')->with('success', 'Su cita ha sido reservada correctamente.');
        } catch (QueryException $e) {
            // Manejar el error aquí
            return redirect()->back()->with('error', 'Error al almacenar la cita');
        }
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect('/usuario/dashboard');
    }

    public function update(Request $request, $id)
    {
        $cita = Appointment::find($id);
        $cita->hour = $request->input('hora');
        $cita->save();

        return redirect()->back()->with('success', 'La hora de la cita se ha actualizado correctamente.');
    }

    public function historial(Request $request)
    {
        $usuario = Auth::user()->paciente->id;
        $numCitas = Appointment::where('patient_id', $usuario   )
                                ->where('status', 'Pendiente')
                                ->count();

        $citas = $this->historialFiltrado($request);

        return view('historial', compact('citas', 'numCitas'));
    }

    private function historialFiltrado(Request $request)
    {
        $usuario = Auth::user()->paciente->id;

        $query = Appointment::where('patient_id', $usuario)
            ->with('worker', 'report')
            ->orderBy('date');

        if ($request->has('filtro_anyo') && $request->input('filtro_anyo') !== null) {
            $query->whereYear('date', $request->input('filtro_anyo'));
        }

        if ($request->has('filtro_mes') && $request->input('filtro_mes') !== null) {
            $query->whereMonth('date', $request->input('filtro_mes'));
        }

        return $query->paginate(25);
    }

    public function verInforme($id)
    {
        $report = Report::with('appointment', 'worker')->find($id);
        // Asegúrate de tener los datos necesarios para la vista
        $data = ['report' => $report];
        $pdf = FacadePdf::loadView('informe', $data);
        return $pdf->stream('nombre_del_archivo.pdf');
    }
}
