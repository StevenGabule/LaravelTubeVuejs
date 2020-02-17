<?php

namespace App;


class Video extends Model
{
    protected $guarded = [];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function editable()
    {
        return auth()->check() && $this->channel->user_id === auth()->user()->id;
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }
}
