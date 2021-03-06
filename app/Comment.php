<?php

namespace App;


class Comment extends Model
{
    protected $guarded = [];
    protected $with = ['user', 'votes'];
    protected $appends = ['repliesCount'];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    // accessor
    public function getRepliesCountAttribute()
    {
        return $this->replies->count();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'comment_id')->whereNotNull('comment_id');
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }
}
