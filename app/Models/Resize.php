<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resize extends Model
{
    use HasFactory;
    protected $casts = [
        'width' => 'integer',
        'height' => 'integer',
        'resizeMimeType' => 'string',
    ];
    protected $guarded = [];
}
