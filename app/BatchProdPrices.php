<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BatchProdPrices extends Model
{
    public $fillable = ['batch_prod_id', 'container_id', 'price', 'sign_date'];
    public $table = "batch_product_prices";
}
