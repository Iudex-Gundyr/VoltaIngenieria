<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class numeracionDocumento extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'numeracion_documento';
    // Opcional: si tienes campos de fecha "created_at" y "updated_at"
    public $timestamps = false;
}
