<?php

namespace App;


class Vote extends Model
{
    protected $guarded = [];
    
    public function votable()
    {
        return $this->morphTo();
    }
}
