<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{

    public $fillable = ['title', 'meta_title', 'meta_description', 'meta_keywords', 'slug', 'category_id', 'description', 'image', 'sort_order', 'status', 'created_at', 'updated_at'];
    public function scopeSearchId($query, $param)
    {
        $category = $query->where('id', $param)
            ->orWhere('name', 'like', '%' . $param . '%')
            ->first();

        return $category ? $category->id : false;
    }

}