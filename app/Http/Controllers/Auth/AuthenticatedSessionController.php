<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        if (Auth::user()->banned) {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
            return redirect('/')->with('error', 'Está cuenta está bloqueada temporalmente. Ponte en contacto con la administración del sitio.');
        }

        if (Auth::user()->delete_at !== null) {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
            return redirect('/')->with('error', 'La cuenta está inactiva por petición del usuario. Ponte en contacto con la administración del sitio para volver a reactivarla.');
        }




        if (!Auth::user()->banned) {

            if (Auth::user()->paciente && Auth::user()->trabajador) {
                return redirect(RouteServiceProvider::OPCION);
            }

            if (Auth::user()->admin) {
                return redirect(RouteServiceProvider::DASHBOARD);
            }

            if (Auth::user()->paciente) {
                return redirect(RouteServiceProvider::USERDASHBOARD);
            }

            if (Auth::user()->trabajador) {
                return redirect(RouteServiceProvider::TRABAJADOR);
            }
        }
        
        $request->session()->regenerate();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
