<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curs extends Model
{
    use HasFactory;
    protected  $table = 'curs';
    protected $casts = [
        'curs' => 'float',
        'base' => 'integer',
    ];
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setBaseAttribute($value)
    {
        $this->attributes['base'] = $value ? 1  : 0;
    }
}
