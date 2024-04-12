<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatStory extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator_id',
        'path',
        'expiry_date',
    ];

    protected $dates = [
        'expiry_date',
    ];
}
