<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\Patient;
use App\Models\User;

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
    

    
}