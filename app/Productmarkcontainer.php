<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productmarkcontainer extends Model {

    public $fillable = ['mark_id', 'mark_data','container_id'];
    public $table = "inventory_container_mark_add";



}
