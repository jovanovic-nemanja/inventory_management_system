<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model {

    public $fillable = ['name','customer_id'];
    public $table = "inventory_lable";

    public function scopeSearchId($query, $param) {
        $category = $query->where('slug', $param)
                ->orWhere('name', 'like', '%' . $param . '%')
                ->first();

        return $category ? $category->id : false;
    }

}
