<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'region', 'UniqueId','age',
    ];

    public function initiatedFriendships()
    {
        return $this->hasMany(Friendship::class, 'user1_id');
    }

    public function receivedFriendships()
    {
        return $this->hasMany(Friendship::class, 'user2_id');
    }

    public function friendships()
    {
        return $this->initiatedFriendships->merge($this->receivedFriendships);
    }
}
