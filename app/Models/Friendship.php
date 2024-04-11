<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    protected $table = 'friendships';

    protected $fillable = ['user1_id', 'user2_id'];

    public function initiator()
    {
        return $this->belongsTo(User::class, 'user1_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'user2_id');
    }
}
