<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class empleados extends Model
{
    protected $table = 'empleados';

    protected $fillable = [
        'Nombre', // Agregar 'Nombre' aquí
        'Apellido',
        'Correo',
        'Telefono',
        'Foto',
        'departamento_id'
    ];

    public function departamento()
    {
        return $this->belongsTo(departamentos::class, 'departamento_id');
    }
}
