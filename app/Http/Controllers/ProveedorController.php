<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public static function proveedor(){
        $proveedores = Proveedor::all();
        return view('Intranet/Herramientas/CRUD/Proveedor/Proveedor', ['proveedores' => $proveedores]);
    }
    public static function crearProveedor(Request $request){
        // Validar los datos del formulario
        $request->validate([
            'Rut' => 'required',
            'RazonSocial' => 'required',
            'Giro' => 'required',
            'Direccion' => 'required',
            'Mail' => 'required|email',
            'Telefono' => 'required',
        ]);

        // Crear un nuevo proveedor con los datos del formulario
        Proveedor::create([
            'Rut' => $request->input('Rut'),
            'RazonSocial' => $request->input('RazonSocial'),
            'Giro' => $request->input('Giro'),
            'Direccion' => $request->input('Direccion'),
            'Mail' => $request->input('Mail'),
            'Telefono' => $request->input('Telefono'),
        ]);

        // Redirigir a alguna página de éxito
        return redirect()->route('Proveedor')->with('success', 'Proveedor creado correctamente.');
    }

    public function examinarProveedor(Request $request, $id){
        $proveedor = Proveedor::findOrFail($id);
        return view('Intranet/Herramientas/CRUD/Proveedor/examinarProveedor', ['proveedor' => $proveedor]);
    }

    public static function actualizarProveedor(Request $request, $id){
        $request->validate([
            'Rut' => 'required|string',
            'RazonSocial' => 'required|string',
            'Giro' => 'required|string',
            'Direccion' => 'required|string',
            'Mail' => 'required|email',
            'Telefono' => 'required|string',
        ]);

        // Encuentra el proveedor por su ID
        $proveedor = Proveedor::find($id);

        // Actualiza los campos del proveedor
        $proveedor->Rut = $request->Rut;
        $proveedor->RazonSocial = $request->RazonSocial;
        $proveedor->Giro = $request->Giro;
        $proveedor->Direccion = $request->Direccion;
        $proveedor->Mail = $request->Mail;
        $proveedor->Telefono = $request->Telefono;

        // Guarda los cambios en la base de datos
        $proveedor->save();

        // Redirige a alguna página de éxito o muestra un mensaje
        return redirect()->route('Proveedor')->with('success', 'Proveedor actualizado exitosamente');
    }

    public function eliminarProveedor(Request $request, $id)
    {
        // Aquí pones la lógica para eliminar el proveedor con el ID dado
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            return redirect()->back()->with('error', 'Proveedor no encontrado');
        }

        $proveedor->delete();

        return redirect()->back()->with('success', 'Proveedor eliminado correctamente');
    }

}
