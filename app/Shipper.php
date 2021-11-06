<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipper extends Model {


    public $fillable = ['name', 'email','phone','address'];
    public $table = "inventory_shipper";


}
