<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public $timestamps = false;

    protected $table = 'areas';

    protected $fillable = ['id', 'nombre'];

    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }
}
