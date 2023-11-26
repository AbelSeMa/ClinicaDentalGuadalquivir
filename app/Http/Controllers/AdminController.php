<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\Patient;

class AdminController extends Controller
{
    public function index()
    {
        $trabajadores = Worker::paginate(10);
        $pacientes = Patient::paginate(5);

        return view('adminDashboard', [
            'trabajadores' => $trabajadores,
            'pacientes' => $pacientes,
        ]);
    }
}