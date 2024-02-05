<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function edit()
    {
        $usuario = Auth::user()->paciente->id;
        $numCitas = Appointment::where('patient_id', $usuario)->count();

        return view('editarPerfil', compact('numCitas'));
    }

    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $usuario = User::findOrFail($id);


        $rules = [
            'first_name' => ['required', 'string', 'max:100', 'regex:/^[A-Za-zÑñÁáÉéÍíÓóÚúÜü]+$/'],
            'last_name' => ['required', 'string', 'max:100', 'regex:/^[A-Za-zÑñÁáÉéÍíÓóÚúÜü]+$/'],
            'address' => ['required', 'string', 'min:5', 'max:100', 'regex:/^[a-zA-ZzÑñÁáÉéÍíÓóÚúÜü0-9\s\º\-\/\.,]+$/'],
            'phone' => ['required', 'regex:/^(956\d{6}|[67]\d{8})$/'],
            'birthdate' => ['required', 'date', 'before:-18 years'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($id), 'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/'],
        ];
        $mensajes = [
            'birth_date.required' => 'La fecha de nacimiento es obligatorio.',
            'birth_date.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'birth_date.before' => 'Debes tener al menos 18 años.',
        ];

        $this->validate($request, $rules, $mensajes);
        try {
            $usuario->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'phone' => $request->phone,
                'birth_date' => $request->birthdate,
                'email' => $request->email,
            ]);

            return redirect()->route('user.dashboard')->with('success', 'Usuario actualizado exitosamente');
        } catch (\Throwable $th) {
            Log::error($th);    
            return redirect()->route('user.dashboard')->with('error', 'No se ha podido actualizar el usuario. Intentelo de nuevo.');
        }
    }

    public function updatePassword(Request $request)
    {
        $id = Auth::user()->id;
        $usuario = User::findOrFail($id);

        $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()],
            'password_confirmation' => ['required', 'min:8']
        ]);

        try {
            $usuario->update([
                'password' => bcrypt($request->password)
            ]);
            
            return redirect()->route('user.dashboard')->with('success', 'Contraseña actualizada con éxito.');
        } catch (\Throwable $th) {
            return redirect()->route('user.dashboard')->with('error', 'La contraseña no se ha podido actualizar.');

        }
    }
}
