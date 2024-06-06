<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivilegioUsuario extends Model
{
    protected $table = 'privilegio_usuario'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'ID'; // Nombre de la clave primaria

    public $incrementing = true; // Indica si los IDs son autoincrementales o no

    protected $keyType = 'int'; // Tipo de dato de la clave primaria

    public $timestamps = false; // Indica si el modelo debe registrar automáticamente la fecha de creación y actualización

    /**
     * Define la relación entre PrivilegioUsuario y Usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'ID_Usuario', 'ID');
    }

    /**
     * Define la relación entre PrivilegioUsuario y Privilegio.
     */
    public function privilegio()
    {
        return $this->belongsTo(Privilegio::class, 'ID_Privilegio', 'ID');
    }
}
