<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productcontainer extends Model {

    public $fillable = ['product_id', 'category_id','initial_stock', 	'cost', 'price', 'vat', 'after_stock', 'container_id', 'mark_add_id', 'created_at', 'updated_at' ];
    public $table = "inventory_container_to_product";



}
