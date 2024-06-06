<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Privilegio extends Model
{
    protected $table = 'privilegio'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'ID'; // Nombre de la clave primaria

    public $incrementing = true; // Indica si los IDs son autoincrementales o no

    protected $keyType = 'int'; // Tipo de dato de la clave primaria

    public $timestamps = false; // Indica si el modelo debe registrar automáticamente la fecha de creación y actualización
    protected $fillable = ['NPrivilegio'];
    /**
     * Define la relación entre Privilegio y PrivilegioUsuario.
     */
    public function PrivilegioUsuario()
    {
        return $this->hasMany(PrivilegioUsuario::class, 'ID_Privilegio', 'ID');
    }
}
