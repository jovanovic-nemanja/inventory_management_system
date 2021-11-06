<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prod extends Model {

    public $fillable = ['name', 'unit', 'category','stock','price','reason'];
    public $table = "inventory_product";

    public function scopeSearchId($query, $param) {
        $category = $query->where('slug', $param)
                ->orWhere('name', 'like', '%' . $param . '%')
                ->first();

        return $category ? $category->id : false;
    }


}
