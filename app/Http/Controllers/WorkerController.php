<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Worker;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkerController extends Controller
{
    //

    public function editarTrabajador()
    {
        $trabajadores = Worker::with('usuario')->get();

        return view('editarTrabajadores', compact('trabajadores'));
    }

    public function edit($id)
    {
        $trabajador =  DB::table('workers')
        ->join('users', 'workers.user_id', '=', 'users.id')
        ->where('workers.id', $id)
        ->select('workers.*', 'users.first_name', 'users.last_name')
        ->first();

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

    public function store(Request $request)
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
}
