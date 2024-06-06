<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\privilegiousuario;
use Illuminate\Support\Facades\Validator;

class privilegioController extends Controller
{

    public static function agregarPrivilegio(Request $request){
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'ID_Usuario' => 'required|integer',
            'ID_Privilegio' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($request) {
                    // Verificar si ya existe un registro de PrivilegioUsuario con el mismo ID_Usuario e ID_Privilegio
                    $existingPrivilegioUsuario = privilegiousuario::where('ID_Usuario', $request->ID_Usuario)
                                                                  ->where('ID_Privilegio', $value)
                                                                  ->exists();
                    // Si ya existe, agregar un mensaje de error
                    if ($existingPrivilegioUsuario) {
                        $fail('El privilegio ya está asignado a este usuario.');
                    }
                }
            ],
        ]);

        // Si la validación falla, redirigir con los errores de validación
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Crear un nuevo registro de PrivilegioUsuario
        $privilegioUsuario = new PrivilegioUsuario();
        $privilegioUsuario->ID_Usuario = $request->ID_Usuario;
        $privilegioUsuario->ID_Privilegio = $request->ID_Privilegio;
        $privilegioUsuario->save();

        // Redirigir de vuelta a la página anterior con un mensaje de éxito
        return redirect()->back()->with('success', 'Privilegio agregado correctamente');
    }

    public static function eliminarPrivilegio(Request $request, $id){
        try {
            $privilegioUsuario = PrivilegioUsuario::findOrFail($id);

            $privilegioUsuario->delete();

            return redirect()->back()->with('success', 'Eliminaste el privilegio correctamente');
        } catch (\Exception $e) {
            // Manejar cualquier error que ocurra durante el proceso de eliminación
            return redirect()->back()->with('error', 'Ha sucedido un error, intentelo nuevamente, o contactese con el servicio de TI' . $e->getMessage());
        }
    }
}
