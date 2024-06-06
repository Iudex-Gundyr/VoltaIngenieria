<?php

// Definir un middleware para verificar los privilegios
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerificarPrivilegios
{
    public function handle($request, Closure $next, ...$privilegiosRequeridos)
    {
        // Obtener el usuario autenticado
        $usuario = Auth::user();

        // Verificar si el usuario tiene al menos uno de los privilegios requeridos
        foreach ($privilegiosRequeridos as $privilegio) {
            if ($usuario->tienePrivilegio($privilegio)) {
                return $next($request);
            }
        }

        // Si el usuario no tiene ninguno de los privilegios requeridos, redirigirlo o devolver un error
        return redirect('/sin-acceso')->with('error', 'No tienes permiso para acceder a esta página.');
    }
}
