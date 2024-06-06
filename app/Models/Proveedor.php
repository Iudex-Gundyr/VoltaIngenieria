<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedor';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'Rut',
        'RazonSocial',
        'Giro',
        'Direccion',
        'Mail',
        'Telefono',
    ];

    // Relación que indica que un proveedor tiene muchos productos
    public function productos()
    {
        return $this->hasMany(Productos::class, 'ID_Proveedor', 'ID');
    }
}
