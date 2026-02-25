<?php

namespace App\Models;

use App\Enums\ImageRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /** @use HasFactory<\Database\Factories\ImageFactory> */
    use HasFactory;


    protected $casts = [
        'role' => ImageRole::class
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}
