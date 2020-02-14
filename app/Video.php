<?php

namespace App;


class Video extends Model
{
    protected $guarded = [];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
