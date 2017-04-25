<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    //
    protected $fillable = [
        'comment_id',
        'author',
        'email',
        'content',
        'is_active',
        'image'
    ];

    public function comment(){
        return $this->belongsTo('App\Comment');
    }

    public function getIsActiveAttribute($status){
        if ($status === 0){
            return 'Hidden';
        } else {
            return 'Displayed';
        }
    }
}
