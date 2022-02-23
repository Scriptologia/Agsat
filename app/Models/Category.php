<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
     protected $casts = [
         'visible' => 'boolean',
         'filters' => 'array',
         'tags_ru' => 'array',
         'tags_uk' => 'array',
         'skidka' => 'float',
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
    public function setPositionAttribute($value)
    {
        $this->attributes['position'] = $value ? $value  : 1;
    }
    public function setTagsRuAttribute($value)
    {
        $this->attributes['tags_ru'] = $value != [] ? json_encode($value) : null;
    }
    public function setTagsUkAttribute($value)
    {
        $this->attributes['tags_uk'] = $value != [] ? json_encode($value) : null;
    }
    public function setFiltersAttribute($value)
    {
        $this->attributes['filters'] = $value != [] ? json_encode($value) : null;
    }
    public function getFiltersAttribute($value)
    {
        return is_array($value)? Filter::whereBetween('id', $value)->get() ?? json_decode($value) : json_decode($value);//$this->hasMany(Filter::class);
    }


    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class)->with('childrenCategories');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function parentCategories()
    {
        return $this->belongsTo(Category::class,'category_id', 'id')->with('parentCategories');
    }

    public function products ()
    {
        return $this->belongsToMany(Product::class);
    }

}
