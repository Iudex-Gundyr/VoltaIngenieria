<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\usuario;
use App\Models\privilegio;
use App\Models\privilegiousuario;

class UsuarioController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function iniciarSesion(Request $request, Redirector $redirect){
        // Validar los datos del formulario
        $request->validate([
            'Correo' => 'required|email',
            'Contrasena' => 'required|string',
        ]);

        // Obtener el usuario de la base de datos
        $user = Usuario::where('Correo', $request->Correo)->first();

        // Verificar si el usuario existe y si la contraseña coincide
        if ($user && Hash::check($request->Contrasena, $user->Contrasena)) {
            // Autenticar al usuario
            Auth::login($user);

            // Redireccionar al usuario a la página deseada después del inicio de sesión
            return redirect()->intended('/Intranet')->with('status', 'Sesión iniciada correctamente');
        }

        // Si las credenciales son incorrectas, redireccionar de vuelta con un mensaje de error
        return redirect('/Login')->withInput()->withErrors(['Correo' => 'Estas credenciales no coinciden con nuestros registros.']);
    }
    // Método de inicio de sesión
    public static function login(){
        return view('login');
    }
    public function Usuario(){
        // Obtener todos los usuarios
        $usuarios = Usuario::all();

        // Pasar los usuarios a la vista
        return view('Intranet/Herramientas/CRUD/Usuarios/Usuarios', compact('usuarios'));
    }
    public function crearUsuario(Request $request){
        try {
            // Valida los datos del formulario
            $request->validate([
                'nombre' => 'required|string|max:255',
                'rut' => 'required|string|max:255',
                'departamento' => 'required|string|max:255',
                'correo' => 'required|email|unique:usuario,correo',
                'contrasena' => 'required|string|min:8',
            ], [
                'correo.unique' => 'El correo electrónico ya está en uso.',
            ]);

            // Crea un nuevo usuario
            $usuario = new usuario();
            $usuario->nombre = $request->nombre;
            $usuario->rut = $request->rut;
            $usuario->departamento = $request->departamento;
            $usuario->correo = $request->correo;
            $usuario->contrasena = bcrypt($request->contrasena);
            $usuario->save();

            // Redirige a la página de inicio o a donde desees
            return redirect()->back();
        } catch (\Exception $e) {
            // Maneja la excepción (registra el error, muestra un mensaje de error, etc.)
            return redirect()->back()->withErrors(['error' => 'Error al guardar el usuario: ' . $e->getMessage()]);
        }
    }

    public function eliminarUsuario(Request $request, $id){
        try {
            // Buscar el usuario por su ID
            $usuario = Usuario::findOrFail($id);

            // Eliminar el usuario
            $usuario->delete();

            // Redireccionar a alguna página después de eliminar el usuario (por ejemplo, a la lista de usuarios)
            return redirect()->route('Usuarios')->with('success', 'Eliminaste el usuario correctamente');
        } catch (\Exception $e) {
            // Manejar cualquier error que ocurra durante el proceso de eliminación
            return redirect()->back()->with('error', 'Ha sucedido un error, intentelo nuevamente, o contactese con el servicio de TI' . $e->getMessage());
        }
    }
    public function examinarUsuario(Request $request, $id){
        try {
            $usuario = Usuario::findOrFail($id);
            $privilegio = Privilegio::orderBy('NPrivilegio')->get(); // Cambié el nombre de la variable a plural para reflejar que puede haber varios privilegios
            $privilegiosUsuario = PrivilegioUsuario::where('ID_Usuario', $id)->get();
            return view('Intranet/Herramientas/CRUD/Usuarios/ModificarUsuarios', ['usuario' => $usuario, 'privilegio' => $privilegio, 'privilegiosUsuario' => $privilegiosUsuario]);
        } catch (\Exception $e) {
            return redirect()->route('Usuarios')->with('error', 'Usuario no encontrado');
        }
    }
    public function actualizarUsuario(Request $request, $id){
        try {
            // Buscar el usuario por su ID
            $usuario = Usuario::findOrFail($id);

            // Verificar si la contraseña está presente
            if ($request->has('contrasena')) {
                // Si la contraseña está presente, actualiza todos los campos
                $usuario->nombre = $request->input('nombre');
                $usuario->rut = $request->input('rut');
                $usuario->departamento = $request->input('departamento');
                $usuario->correo = $request->input('correo');
                $usuario->contrasena = bcrypt($request->input('contrasena')); // Hashear la contraseña antes de guardarla en la base de datos
                $usuario->save();
            } else {
                // Si la contraseña no está presente, actualiza solo los demás campos
                $usuario->nombre = $request->input('nombre');
                $usuario->rut = $request->input('rut');
                $usuario->departamento = $request->input('departamento');
                $usuario->correo = $request->input('correo');
                $usuario->save();
            }

            // Redireccionar a alguna página después de actualizar el usuario (por ejemplo, a la lista de usuarios)
            return redirect()->route('Usuarios')->with('success', 'Usuario actualizado correctamente');
        } catch (\Exception $e) {
            // Manejar el error si ocurre un problema al actualizar el usuario
            return redirect()->back()->with('error', 'Error al actualizar el usuario: ' . $e->getMessage());
        }
    }
    public function logout(Request $request){
        Auth::logout();

        return redirect('/Login');
    }
}
