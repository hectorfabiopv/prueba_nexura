<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends BaseModel
{
    public $timestamps = false;

    protected $table = 'roles';

    protected $fillable = ['nombre'];

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'empleado_rol', 'rol_id', 'empleado_id');
    }
}
