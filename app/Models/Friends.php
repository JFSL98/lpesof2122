<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id1',
        'user_id2',
        'validate',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function getLikeCount()
    {
        return $this->user()->getQuery()->where('validate', '=', true)->count();
    }
}
