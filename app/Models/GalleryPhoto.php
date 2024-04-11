<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryPhoto extends Model
{
    use HasFactory;

    protected $table = 'gallery_photos';

    protected $fillable = ['user_id', 'text', 'source'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
