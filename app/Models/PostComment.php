<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'post_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function likes()
    {
        return $this->hasMany(CommentLike::class);
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
