<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function postComments()
    {
        return $this->hasMany(PostComment::class);
    }

    public function getCommentCount(){

        $comment_count = $this->postComments()->count();       
        return $comment_count;
    }
}
