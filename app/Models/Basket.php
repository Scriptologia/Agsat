<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;

class Basket extends Model
{
    use HasFactory;
    protected $casts = [
        'products' => 'array',
        'price' => 'float',
        'person' => 'array',
        'is_closed' => 'boolean',
    ];
    protected $guarded = [];

    public function setProductsAttribute($value)
    {
        $this->attributes['products'] = $value != []?  json_encode($value) : null;
    }
    public function setPersonAttribute($value)
    {
        $this->attributes['person'] = $value != []?  json_encode($value) : null;
    }
    public function setIsClosedAttribute($value)
    {
        $this->attributes['is_closed'] = $value ? 1  : 0;
    }
}
