<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $casts = [
        'visible' => 'boolean',
        'tags_ru' => 'array',
        'tags_uk' => 'array',
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
    public function setTagsRuAttribute($value)
    {
        $this->attributes['tags_ru'] = $value != [] ? json_encode($value) : null;
    }
    public function setTagsUkAttribute($value)
    {
        $this->attributes['tags_uk'] = $value != []?  json_encode($value) : null;
    }
}
