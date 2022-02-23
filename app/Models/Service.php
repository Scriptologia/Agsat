<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $casts = [
        'visible' => 'boolean',
        'price' => 'float',
    ];
    protected $guarded = [];

    public function setVisibleAttribute($value)
    {
        $this->attributes['visible'] = $value ? 1  : 0;
    }
    public function setCursIdAttribute($value)
    {
        $this->attributes['curs_id'] = $value ? $value  : null;
    }
    public function curs()
    {
        return $this->belongsTo(Curs::class);
    }
}
