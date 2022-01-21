<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $casts = [
        'name' => 'string',
        'phones' => 'array',
        'socials' => 'array',
        'time' => 'object'
    ];
    protected $guarded = [];

    public function setPhonesAttribute($value)
    {
        $this->attributes['phones'] = $value != []?  json_encode($value) : null;
    }
    public function setSocialsAttribute($value)
    {
        $this->attributes['socials'] = $value != []?  json_encode($value) : null;
    }
}
