<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseModel extends Model
{
    protected $attributes = ['alive' => true];

    protected static function booted(): void
    {
        static::addGlobalScope('alive', function (Builder $builder) {
            $builder->where('alive', true);
        });

        static::deleting(function ($model) {
            $model->alive = false;
            $model->save();
            return false; // evita el delete real
        });
    }

    public function delete()
    {
        $this->alive = false;
        $this->save();
        return true;
    }

    public function restore(): bool
    {
        $this->alive = true;
        return $this->save();
    }

    public function scopeWithDeleted(Builder $query): Builder
    {
        return $query->withoutGlobalScope('alive');
    }

    public function scopeOnlyDeleted(Builder $query): Builder
    {
        return $query->withoutGlobalScope('alive')->where('alive', false);
    }
}