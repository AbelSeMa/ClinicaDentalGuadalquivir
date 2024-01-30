<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:100', 'regex:/^[A-Za-zÑñÁáÉéÍíÓóÚúÜü]+$/'],
            'last_name' => ['required', 'string', 'max:100', 'regex:/^[A-Za-zÑñÁáÉéÍíÓóÚúÜü]+$/'],
            'address' => ['required', 'string', 'min:5', 'max:100', 'regex:/^[a-zA-ZzÑñÁáÉéÍíÓóÚúÜü0-9\s\º\-\/\.,]+$/'],
            'phone' => ['required', 'numeric', 'regex:/^(956\d{6}|[6789]\d{8})$/'],
            'birth_date' => ['required', 'date', 'before:-18 years'],
            'dni' => ['required', 'Unique:users', 'regex:/^[0-9]{8}[A-Z]$/'],
            'email' => ['required', 'email', 'Unique:users', 'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()],
            'password_confirmation' => ['required', 'min:8']
        ], [
            #campo.validacion
            'first_name.required' => 'El nombre es obligatorio',
            'first_name.max' => 'El nombre es muy largo',
            'first_name.regex' => 'El nombre debe estar compuesto sólo por letras',
            'last_name.required' => 'El apellido es obligatorio',
            'last_name.max' => 'El apellido es muy largo',
            'last_name.regex' => 'El apellido debe estar compuesto sólo por letras',
            'address.required' => 'El campo dirección es obligatorio',
            'address.min' => 'La dirección debe tener una longitud mínima de 5 caracteres',
            'address.max' => 'La dirección es demasido larga.',
            'phone.required' => 'El número de teléfono es obligatorio',
            'phone.regex' => 'El número de teléfono no es válido. Compruebe que comience por 6|7|8 o 9',
            'birth_date.required' => 'La fecha de nacimiento es obligatorio.',
            'birth_date.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'birth_date.before' => 'Debes tener al menos 18 años.',
            'dni.required' => 'El campo DNI es obligatorio.',
            'dni.unique' => 'El DNI ya está registrado.',
            'dni.regex' => 'El DNI no es correcto.',
            'email.required' => 'El campo Email es obligatorio.',
            'email.unique' => 'El Email ya está registrado.',
            'email.regex' => 'El Email no tiene un formato válido.',
            'password.min' => 'Contraseña demasiado corta.',
            'password.letters' => 'Debe contener al menos una letra',
            'password.mixedCase' => 'Debes utilizar al menos una letra minúscula y otra mayúscula.',
            'password.numbers' => 'Debes utilizar al menos un número.',
            'password.symbols' => 'Debes utilizar al menos un caracter especial.',



        ]);


        try {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'phone' => $request->phone,
                'birth_date' => $request->birth_date,
                'dni' => $request->dni,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $paciente = Patient::create([
                'user_id' => $user->id,
                'medical_history' => null,
            ]);

            event(new Registered($user));

            Auth::login($user);

            if (Auth::user()->admin) {

                return redirect(RouteServiceProvider::DASHBOARD);
            } else {
                return redirect(RouteServiceProvider::HOME);
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect('/register')->with('error', 'No se ha podido completar el registro. Por favor verifica los datos.');
        }
    }
}
