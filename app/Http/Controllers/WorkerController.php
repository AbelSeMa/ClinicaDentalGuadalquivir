<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkerController extends Controller
{
    //
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
}
