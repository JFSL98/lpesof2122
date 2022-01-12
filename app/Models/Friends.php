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

    function friendsOfMine()
    {
        return $this->belongsToMany('User', 'Friends', 'user_id1', 'user2')
            ->wherePivot('validate', '=', 1) // to filter only accepted
            ->withPivot('validate'); // or to fetch accepted value
    }

    // friendship that I was invited to
    function friendOf()
    {
        return $this->belongsToMany('User', 'Friends', 'user_id2', 'user_id1')
            ->wherePivot('validate', '=', 1)
            ->withPivot('validate');
    }

    // accessor allowing you call $user->friends
    public function getFriendsAttribute()
    {
        if (!array_key_exists('friends', $this->relations)) $this->loadFriends();

        return $this->getRelation('friends');
    }

    protected function loadFriends()
    {
        if (!array_key_exists('friends', $this->relations)) {
            $friends = $this->mergeFriends();

            $this->setRelation('friends', $friends);
        }
    }

    protected function mergeFriends()
    {
        return $this->friendsOfMine->merge($this->friendOf);
    }
}
