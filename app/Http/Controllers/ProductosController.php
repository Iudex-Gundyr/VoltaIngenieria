<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Productos;
use App\Models\Proveedor;
use Illuminate\Http\Request;
class ProductosController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public static function Productos(){
        try {
            // Obtener todos los productos con su tabla padre proveedor
            $productos = Productos::with(['Proveedor' => function($query) {
                $query->orderBy('RazonSocial', 'asc');
            }])->get();
            // Obtener todos los proveedores
            $proveedores = Proveedor::all();
            // Retornar la vista con los productos y los proveedores
            return view('Intranet/Herramientas/CRUD/Productos/Productos', compact('productos', 'proveedores'));
        } catch (\Exception $e) {
            // Manejar el caso de error
            return redirect()->back()->with('error', 'Error al obtener productos: ' . $e->getMessage());
        }
    }
    public static function crearProducto(Request $request){
        // Validar los datos del formulario
        $request->validate([
            'Descripcion' => 'required|string|max:255',
            'Valor' => 'required|numeric|min:0',
            'Laboratorio' => 'required|string|max:255',
            'ID_Proveedor' => 'required',
        ]);

        // Crear un nuevo producto
        $producto = new Productos();
        $producto->Descripcion = $request->Descripcion;
        $producto->Valor = $request->Valor;
        $producto->Laboratorio = $request->Laboratorio;
        $producto->ID_Proveedor = $request->ID_Proveedor;
        $producto->save();

        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->back()->with('success', 'Producto creado correctamente');
    }
    public static function examinarProducto(Request $request, $id){
        try {
            // Buscar el producto por su ID
            $producto = Productos::findOrFail($id);
            $proveedores = Proveedor::all();
            // Retornar la vista con el producto encontrado
            return view('Intranet/Herramientas/CRUD/Productos/ExaminarProducto', ['producto' => $producto],compact('proveedores'));
        } catch (\Exception $e) {
            // Manejar el caso de que no se encuentre el producto
            return redirect()->back()->with('error', 'Producto no encontrado');
        }
    }
    public static function actualizarProducto(Request $request, $id) {
        // Validar los datos del formulario
        $request->validate([
            'Descripcion' => 'required|string',
            'Valor' => 'required|numeric|min:0',
            'Laboratorio' => 'required|string',
        ]);

        try {
            // Buscar el producto por su ID
            $producto = Productos::findOrFail($id);

            // Actualizar los campos del producto
            $producto->Descripcion = $request->Descripcion;
            $producto->Valor = $request->Valor;
            $producto->Laboratorio = $request->Laboratorio;

            // Actualizar el proveedor solo si se proporcionó un valor válido
            if ($request->filled('ID_Proveedor')) {
                $producto->ID_Proveedor = $request->ID_Proveedor;
            }

            // Guardar los cambios en la base de datos
            $producto->save();

            // Redirigir de vuelta a la página anterior con un mensaje de éxito
            return redirect()->route('Productos')->with('success', 'Producto modificado correctamente');
        } catch (\Exception $e) {
            // Manejar cualquier error que ocurra durante el proceso de actualización
            return redirect()->back()->with('error', 'Error al modificar el producto: ' . $e->getMessage());
        }
    }
    public static function eliminarProducto(Request $request, $id){
        try {
            $producto = Productos::findOrFail($id);
            $producto->delete();
            return redirect()->back()->with('success', 'Producto eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el producto: ' . $e->getMessage());
        }
    }
}
