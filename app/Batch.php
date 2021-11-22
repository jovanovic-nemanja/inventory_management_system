<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model {

    public $fillable = ['name', 'status'];
    public $table = "inventory_container_batch";


}
