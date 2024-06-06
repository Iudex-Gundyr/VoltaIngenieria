<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificarPrivilegio
{
    public function handle(Request $request, Closure $next, ...$privilegios)
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            // Redirige al usuario a iniciar sesión si no está autenticado
            return redirect('/login');
        }

        // Verifica si el usuario tiene al menos uno de los privilegios requeridos
        $usuario = Auth::user();
        foreach ($privilegios as $privilegio) {
            if ($usuario->privilegioUsuario()->where('ID_Privilegio', $privilegio)->exists()) {
                // Si el usuario tiene el privilegio, permite el acceso
                return $next($request);
            }
        }

        // Redirige al usuario a una página de acceso denegado
        return redirect('/Intranet')->with('error', 'No tienes permiso para acceder a esta página.');
    }
}
