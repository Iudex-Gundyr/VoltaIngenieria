<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    protected $table = 'productos'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'ID'; // Nombre de la clave primaria

    public $timestamps = false; // Indica si el modelo debe registrar automáticamente la fecha de creación y actualización

    protected $fillable = ['Descripcion', 'Valor', 'Laboratorio', 'ID_Proveedor']; // Columnas que se pueden asignar masivamente

    // Relación que indica que un producto pertenece a un proveedor
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'ID_Proveedor', 'ID');
    }
}
