<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Str;

class Model extends BaseModel
{
    
    public $incrementing = false;

    protected static function boot() {
        parent::boot();
        static::creating(static function($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}
