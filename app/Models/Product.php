<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $casts = [
        'visible' => 'boolean',
        'dop_products' => 'array',
        'tags_ru' => 'array',
        'tags_uk' => 'array',
        'count' => 'integer',
        'price' => 'float',
        'scidka' => 'float',
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
    public function setCursIdAttribute($value)
    {
        $this->attributes['curs_id'] = $value ? $value  : null;
    }
    public function setServiceIdAttribute($value)
    {
        $this->attributes['service_id'] = $value ? $value  : null;
    }
    public function setTagsRuAttribute($value)
    {
        $this->attributes['tags_ru'] = $value != [] ? json_encode($value) : null;
    }
    public function setTagsUkAttribute($value)
    {
        $this->attributes['tags_uk'] = $value != []?  json_encode($value) : null;
    }
    public function setDopProductsAttribute($value)
    {
        $this->attributes['dop_products'] = $value != []?  json_encode($value) : null;
    }
    public function setImgAttribute($value)
    {
        $this->attributes['img'] = $value != []? json_encode($value) : null;
    }
    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = 'product';
    }
    public function filters()
    {
        return $this->belongsToMany(Filter::class);
    }
    public function curs()
    {
        return $this->belongsTo(Curs::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
