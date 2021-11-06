<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {

    public $fillable = ['name', 'email', 'phone','balance','current_balance'];
    public $table = "inventory_customer";

    public function scopeSearchId($query, $param) {
        $category = $query->where('slug', $param)
                ->orWhere('name', 'like', '%' . $param . '%')
                ->first();

        return $category ? $category->id : false;
    }


}
