<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $trabajadores = Worker::with('usuario')->simplePaginate(10);
        $pacientes = Patient::with('usuario')->simplePaginate(5);

        return view('adminDashboard', [
            'trabajadores' => $trabajadores,
            'pacientes' => $pacientes,
        ]);
    }

    public function sinRoles()
    {
        $usuarios = array_merge(
            Patient::pluck('user_id')->toArray(),
            Worker::pluck('user_id')->toArray(),
        );

        $usuariosSinRol = User::whereNotIn('id', $usuarios)->get()->toArray();

        return response()->json(['users' => $usuariosSinRol]);
    }


    public function editarTrabajador()
    {
        $trabajadores = Worker::with('usuario')->get();

        return view('editarTrabajadores', compact('trabajadores'));
    }

    public function edit($id)
    {
        $trabajador = Worker::findOrFail($id);

        return view('editarTrabajador', compact('trabajador'));
    }

    public function update(Request $request, $id)
    {
        $trabajador = Worker::findOrFail($id);

        // Validación y lógica de actualización según tus necesidades

        $trabajador->update([
            'title' => $request->input('title'),
            'specialty' => $request->input('specialty'),
            // Otros campos según tus necesidades
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Trabajador actualizado exitosamente');
    }


    public function crearTrabajador()
    {
        return view('crearTrabajador');
    }

    public function storeWorker(Request $request)
    {
        $request->validate([
            'usuario' => 'required|exists:users,id',
            'titulacion' => 'required|string|min:5|max:100',
            'especializacion' => 'required|string|min:5|max:100'
        ]);

        try {
            DB::table('workers')->insert([
                'user_id' => $request->usuario,
                'title' => $request->titulacion,
                'specialty' => $request->especializacion
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Trabajador creado correctamente.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.dashboard')->with('error', 'Algo ha salido mal. Inténtelo de nuevo.');
        }
    }

    public function borrarTrabajador()
    {
        $trabajadores = Worker::with('usuario')->get();

        return view('borrarTrabajador', compact('trabajadores'));
    }

    public function destroy(Worker $worker)
    {
        try {
            //code...
            $worker->delete();
            return redirect('/admin/dashboard')->with('success', 'Trabajador eliminado con éxito.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/admin/dashboard')->with('error', 'No se ha podido eliminar el trabajador. Revisa que no tenga citas pendientes.');
        }
    }

    public function crearUsuario()
    {
        return view('crearUsuario');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100|regex:/^[A-Za-zÑñÁáÉéÍíÓóÚúÜü]+$/',
            'last_name' => 'required|string|max:100|regex:/^[A-Za-zÑñÁáÉéÍíÓóÚúÜü]+$/',
            'address' => 'required|string|min:5|max:100|regex:/^[a-zA-ZzÑñÁáÉéÍíÓóÚúÜü0-9\s\-\/\.,]+$/',
            'phone' => 'required|regex:/^(956\d{6}|[67]\d{8})$/',
            'birth_date' => 'required|date|before:-18 years',
            'dni' => ['required|regex:/^[0-9]{8}[A-Z]$/',  ]
        ]);

        try {
            DB::table('workers')->insert([
                'user_id' => $request->usuario,
                'title' => $request->titulacion,
                'specialty' => $request->especializacion
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Trabajador creado correctamente.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.dashboard')->with('error', 'Algo ha salido mal. Inténtelo de nuevo.');
        }
    }
}
