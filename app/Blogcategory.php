<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogcategory extends Model
{

    public $fillable = ['title', 'meta_title', 'meta_keyword', 'meta_description', 'description', 'slug', 'parent', 'sort_order'];
    public function scopeSearchId($query, $param)
    {
        $category = $query->where('id', $param)
            ->orWhere('name', 'like', '%' . $param . '%')
            ->first();

        return $category ? $category->id : false;
    }
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent', 'id');
    }

    public function childs()
    {
        return $this->hasMany(self::class, 'parent', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function childrenRecursive()
    {
        return $this->childs()->with('childrenRecursive');
    }
}