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

    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }

    public function getCommentCount()
    {
        return $this->postComments()->count();
    }

    public function getLikeCount()
    {
        return $this->likes()->getQuery()->where('like_dislike', '=', true)->count();
    }

    public function getDislikeCount()
    {
        return $this->likes()->getQuery()->where('like_dislike', '=', false)->count();
    }
}
