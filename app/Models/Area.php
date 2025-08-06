<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends BaseModel
{
    public $timestamps = false;

    protected $table = 'areas';

    protected $fillable = ['nombre'];

    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }
}
