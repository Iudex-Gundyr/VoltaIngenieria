<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentroCosto extends Model
{
    use HasFactory;

    protected $table = 'centrocosto'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'ID'; // Nombre de la clave primaria

    public $timestamps = false; // Indica si el modelo debe registrar automáticamente la fecha de creación y actualización

    protected $fillable = ['CC', 'Descripcion']; // Columnas que se pueden asignar masivamente
}
