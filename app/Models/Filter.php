<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;
    protected $casts = [
        'visible' => 'boolean',
    ];
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function setVisibleAttribute($value)
    {
        $this->attributes['visible'] = $value ? 1  : 0;
    }
    public function fields()
    {
        return $this->hasMany(Filter::class);
    }


}
