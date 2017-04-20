<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    protected $fillable = [
        'post_id',
        'author',
        'email',
        'content',
        'is_active',
        'path'
    ];

    public function replies(){
        return $this->hasMany('App\CommentReply');
    }
}
