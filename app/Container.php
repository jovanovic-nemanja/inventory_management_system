<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Container extends Model {

    public $fillable = ['name','customer_id','containerid','container_batch','shipper_info','notify_info','port_loading','container_number','bill_loading','consignee_info','vessel_no','port_discharge'];
    public $table = "inventory_container";

    public function scopeSearchId($query, $param) {
        $category = $query->where('slug', $param)
                ->orWhere('name', 'like', '%' . $param . '%')
                ->first();

        return $category ? $category->id : false;
    }

}
