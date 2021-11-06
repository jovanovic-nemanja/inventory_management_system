<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model {

    public $fillable = ['name'];
    public $table = "inventory_container_batch";


}
