<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends BaseModel
{
    public $timestamps = false;

    protected $table = 'empleados';

    protected $fillable = [
        'nombre',
        'email',
        'sexo',
        'area_id',
        'boletin',
        'descripcion'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'empleado_rol', 'empleado_id', 'rol_id');
    }
}
