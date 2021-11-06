<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model {


    public $fillable = ['name', 'phone', 'trn_no'];
    public $table = "inventory_supplier";


}
