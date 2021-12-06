<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $casts = [
        'visible' => 'boolean',
        'filters' => 'array',
        'tags_ru' => 'array',
        'tags_uk' => 'array',
        'skidka' => 'integer',
        'price' => 'integer',
        'count' => 'integer',
        'img' => 'array',
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
    public function setCategoryIdAttribute($value)
    {
        $this->attributes['category_id'] = $value ? $value  : null;
    }
    public function setCursAttribute($value)
    {
        $this->attributes['curs'] = $value ? $value  : null;
    }
    public function setTagsRuAttribute($value)
    {
        $this->attributes['tags_ru'] = $value != '[]' ?$value : null;
    }
    public function setTagsUkAttribute($value)
    {
        $this->attributes['tags_uk'] = $value != '[]'? $value : null;
    }
    public function setImgAttribute($value)
    {
        $this->attributes['img'] = $value != '[]'? $value : null;
    }
}
