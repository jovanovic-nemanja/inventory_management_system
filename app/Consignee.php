<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consignee extends Model {


    public $fillable = ['name', 'email','phone','address'];
    public $table = "inventory_consignee";


}
