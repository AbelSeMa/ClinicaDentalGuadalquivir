<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Unique;

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

    public function editWorker($id)
    {
        $trabajador = Worker::findOrFail($id);

        return view('editarTrabajador', compact('trabajador'));
    }

    public function updateWorker(Request $request, $id)
    {
        $trabajador = Worker::findOrFail($id);

        $request->validate([
            'usuario' => 'required|exists:users,id',
            'titulacion' => 'required|string|min:5|max:100',
            'especializacion' => 'required|string|min:5|max:100'
        ]);

        try {
            $trabajador->update([
                'title' => $request->input('title'),
                'specialty' => $request->input('specialty'),
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Trabajador actualizado exitosamente');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.dashboard')->with('error', 'No se ha podido actualizar el trabajdor. Intentelo de nuevo.');
        }
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

    public function destroyWorker($id)
    {
        $worker = Worker::findOrFail($id);
        try {
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
            'first_name' => ['required', 'string', 'max:100', 'regex:/^[A-Za-zÑñÁáÉéÍíÓóÚúÜü]+$/'],
            'last_name' => ['required', 'string', 'max:100', 'regex:/^[A-Za-zÑñÁáÉéÍíÓóÚúÜü]+$/'],
            'address' => ['required', 'string', 'min:5', 'max:100', 'regex:/^[a-zA-ZzÑñÁáÉéÍíÓóÚúÜü0-9\s\º\-\/\.,]+$/'],
            'phone' => ['required', 'regex:/^(956\d{6}|[67]\d{8})$/'],
            'birth_date' => ['required', 'date', 'before:-18 years'],
            'dni' => ['required', 'Unique:users', 'regex:/^[0-9]{8}[A-Z]$/'],
            'email' => ['required', 'email', 'Unique:users', 'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/'],
            [
                'birth_date.required' => 'La fecha de nacimiento es obligatorio.',
                'birth_date.date' => 'La fecha de nacimiento debe ser una fecha válida.',
                'birth_date.before' => 'Debes tener al menos 18 años.',
            ]
        ]);

        try {
            $user = new User();

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->birth_date = $request->birth_date;
            $user->dni = $request->dni;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);

            $user->save();

            return redirect()->route('admin.dashboard')->with('success', 'El usuario se ha creado correctamente.');
        } catch (\Throwable $th) {
            return redirect()->route('admin.dashboard')->with('error', 'No se ha podido crear el usuario. Por favor intentelo de nuevo');
        }
    }


    public function borrarUsuario()
    {
        $usuarios = User::all();

        return view('borrarUsuario', compact('usuarios'));
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        try {
            $user->delete();
            return redirect('/admin/dashboard')->with('success', 'Usuario eliminado con éxito.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect('/admin/dashboard')->with('error', 'No se ha podido eliminar el Usuario. Revisa que no tenga citas pendientes o aún conserve algún rol.');
        }
    }

    public function editarUsuario()
    {
        $usuarios = User::all();

        return view('editarUsuarios', compact('usuarios'));
    }

    public function editUser($id)
    {
        $usuario = User::findOrFail($id);

        return view('editarUsuario', compact('usuario'));
    }

    public function updateUser(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            #TODO
        ]);

        try {
            $usuario->update([
                'title' => $request->input('title'),
                'specialty' => $request->input('specialty'),
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Usuario actualizado exitosamente');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('admin.dashboard')->with('error', 'No se ha podido actualizar el usuario. Intentelo de nuevo.');
        }
    }
}
