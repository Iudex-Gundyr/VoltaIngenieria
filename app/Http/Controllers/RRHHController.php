<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Proveedor;
use App\Models\CentroCosto;
use App\Models\Productos;
use App\Models\numeracionDocumento;
use Dompdf\Dompdf;

class RRHHController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public static function SolicitudCompra(){
        $proveedores = Proveedor::whereHas('Productos')->orderBy('RazonSocial')->get();
        $productos = Productos::orderBy('Descripcion')->get();
        $centrosCosto = CentroCosto::orderBy('CC')->get();
        return view('Intranet/RRHH/SolicitudCompra', compact('proveedores', 'productos', 'centrosCosto'));
    }

    public function obtenerProveedorInfo($id) {
        // Aquí obtén la información del proveedor según su ID
        $proveedor = Proveedor::find($id);

        if ($proveedor) {
            // Si se encuentra el proveedor, devolver su información en formato JSON
            return response()->json([
                'Giro' => $proveedor->Giro,
                'Direccion' => $proveedor->Direccion,
                'Rut' => $proveedor->Rut,
                'Telefono' => $proveedor->Telefono,
                'Mail' => $proveedor->Mail,
                // Agrega otras columnas según sea necesario
            ]);
        } else {
            // Si el proveedor no se encuentra, devolver un error
            return response()->json(['error' => 'Proveedor no encontrado'], 404);
        }
    }

    public function productosPorProveedor($proveedor){
        $productos = Productos::where('ID_Proveedor', $proveedor)->get();
        return response()->json($productos);
    }
    public function obtenerDetallesProducto($id){
        try {
            // Buscar el producto por su ID
            $producto = Productos::findOrFail($id);

            // Devolver los detalles del producto en formato JSON
            return response()->json([
                'ID' => $producto->ID,
                'Valor' => $producto->Valor
            ]);
        } catch (\Exception $e) {
            // Manejar el caso de que no se encuentre el producto
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
    }
    public function crearNDoc(){
        // Crear un nuevo registro sin datos
        $nuevoRegistro = new NumeracionDocumento();
        $nuevoRegistro->save();

        // Devolver el registro recién creado
        return response()->json($nuevoRegistro);
    }

}
