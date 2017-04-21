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
        'image'
    ];

    public function replies(){
        return $this->hasMany('App\CommentReply');
    }

    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function getIsActiveAttribute($status){
        if ($status === 0){
            return 'Hidden';
        } else {
            return 'Displayed';
        }
    }
}
