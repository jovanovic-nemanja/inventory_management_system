<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryTypes extends Model
{
    public $fillable = ['title', 'sign_date'];
    public $table = "inventory_container_types";
}
