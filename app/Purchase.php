<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model {


    public $fillable = ['purchase_order_id','supplier','category', 'product', 'old_stock','item','price','vat','total'];
    public $table = "inventory_purchase_product";


}
