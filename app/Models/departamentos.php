<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class departamentos extends Model
{
    protected $table = 'departamentos';

    public function empleados()
    {
        return $this->hasMany(empleados::class, 'departamento_id');
    }
}