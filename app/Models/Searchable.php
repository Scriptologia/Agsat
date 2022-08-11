<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait Searchable
{
    public function scopeSearch(Builder $query, Request $request) {
        $fields = $this->searchFields;
        $value = $request->search;
        return $query->where( function ($query)  use($value, $fields) {
            foreach($fields as $field)
            {
                $query->orWhere($field, 'LIKE', "%{$value}%");
            }
         });
    }
}