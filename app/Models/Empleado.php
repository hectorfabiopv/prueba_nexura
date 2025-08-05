<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    public $timestamps = false;

    protected $table = 'empleados';

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'sexo',
        'area_id',
        'boletin',
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
