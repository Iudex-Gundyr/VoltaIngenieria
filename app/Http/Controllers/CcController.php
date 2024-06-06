<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\CentroCosto;
class CcController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public static function Cc(){
        $cc = CentroCosto::all();
        return view('Intranet/Herramientas/CRUD/CentroCosto/CentroCosto', compact('cc'));
    }
    public static function crearCC(Request $request){
        // Validar los datos del formulario
        $request->validate([
            'CC' => 'required|string|max:255',
            'Descripcion' => 'required|string|max:255',
        ]);

        // Crear un nuevo centro de costo
        $centroCosto = new CentroCosto();
        $centroCosto->CC = $request->CC;
        $centroCosto->Descripcion = $request->Descripcion;
        $centroCosto->save();

        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->back()->with('success', 'Centro de costo creado correctamente');
    }
    public static function eliminarCc(Request $request, $id){
        try {
            // Buscar el centro de costo por su ID
            $centroCosto = CentroCosto::findOrFail($id);

            // Eliminar el centro de costo
            $centroCosto->delete();

            // Redirigir de vuelta con un mensaje de éxito
            return redirect()->back()->with('success', 'Centro de costo eliminado correctamente');
        } catch (\Exception $e) {
            // Si ocurre algún error, redirigir de vuelta con un mensaje de error
            return redirect()->back()->with('error', 'Error al eliminar el centro de costo: ' . $e->getMessage());
        }
    }
    public static function examinarCc(Request $request, $id){
        try{
            $centroCosto = CentroCosto::findOrFail($id);
            // Aquí rediriges a la vista con los datos del CentroCosto
            return view('Intranet/Herramientas/CRUD/CentroCosto/ExaminarCc', compact('centroCosto'));
        } catch(Exception $e){
            // Manejo de errores: puedes registrar el error, redirigir al usuario a una página de error, etc.
            return redirect()->back()->with('error', 'Hubo un problema al examinar el Centro de Costo.');
        }
    }
    public static function modificarCC(Request $request, $id){
        try {
            // Buscar el Centro de Costo por su ID
            $centroCosto = CentroCosto::findOrFail($id);

            // Actualizar los campos del Centro de Costo con los datos del formulario
            $centroCosto->CC = $request->input('CC');
            $centroCosto->Descripcion = $request->input('Descripcion');

            // Guardar los cambios en la base de datos
            $centroCosto->save();

            // Redirigir al usuario a alguna página de éxito, por ejemplo, la página de detalles del Centro de Costo
            return redirect()->route('Cc')->with('success', 'Centro de costo modificado');
        } catch (\Exception $e) {
            // Manejo de errores: puedes registrar el error, redirigir al usuario a una página de error, etc.
            return redirect()->back()->with('error', 'Hubo un problema al actualizar el Centro de Costo.');
        }
    }
}
