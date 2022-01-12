<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'friend_id',
        'validate',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function friend()
    {
        return $this->hasMany(User::class);
    }
}
