<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\PrivilegioUsuario;

class navbarController extends Controller
{
    public function tienePrivilegio()
    {
        return view('Intranet/Navbar');
    }
}
