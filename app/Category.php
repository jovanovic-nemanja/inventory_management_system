<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    ///////////////////////////// sub category part ///////////////////////////////////
    // public $fillable = ['name', 'parent', 'slug', 'sign_date'];
    ///////////////////////////// sub category part ///////////////////////////////////

    public $fillable = ['name', 'meta_title', 'meta_keywords', 'meta_description', 'slug', 'sign_date'];

    public function scopeSearchId($query, $param) {
        $category = $query->where('slug', $param)
                ->orWhere('name', 'like', '%' . $param . '%')
                ->first();

        return $category ? $category->id : false;
    }

   
 public function parent() {
    return $this->belongsTo(self::class,'parent','id');
}

public function childs() {
    return $this->hasMany(self::class,'parent','id');
}

public function products() {
    return $this->hasMany(Product::class);
}
    public function childrenRecursive()
{
   return $this->childs()->with('childrenRecursive');
}


}
