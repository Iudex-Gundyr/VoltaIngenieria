<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuario'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'ID'; // Nombre de la clave primaria

    public $timestamps = false; // Indica si el modelo debe registrar automáticamente la fecha de creación y actualización

    protected $fillable = [
        'Nombre', 'Rut', 'Departamento', 'Correo', 'Contrasena',
    ];

    protected $hidden = [
        'Contrasena',
    ];

    /**
     * Define la relación entre Usuario y PrivilegioUsuario.
     */
    public function PrivilegioUsuario()
    {
        return $this->hasMany(PrivilegioUsuario::class, 'ID_Usuario', 'ID');
    }
}
