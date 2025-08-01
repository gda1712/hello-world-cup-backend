<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Publication extends Model
{

    protected $fillable = [
        'author_id',
        'name',
        'description',
        'image'
    ];

    protected $appends = [
        'image_url',
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::disk('publication_images')->url($this->image);
        }
    }
}
