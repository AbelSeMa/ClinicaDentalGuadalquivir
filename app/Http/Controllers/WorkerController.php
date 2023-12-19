<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    //
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
}
