<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productdistribution extends Model {

    public $fillable = ['product_id', 'container_id','initial_stock','item', 'cost', 'price', 'after_stock', 'created_at', 'updated_at' ];
    public $table = "inventory_product_distribution";



}
