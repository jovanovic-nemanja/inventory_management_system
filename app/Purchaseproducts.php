<?php

namespace App;

use App\Currency;
use App\Product;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Purchaseproducts extends Model
{
    public $fillable = ['supplier_id','purchase_order','purchase_reference'];

    public $table = "inventory_purchase_order";
}
