<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(){
        return view('index');
    }

    public function contacto()
    {
        return view(('contacto'));    
    }

    public function politicas()
    {
        return view(('politicas'));    
    }
}
