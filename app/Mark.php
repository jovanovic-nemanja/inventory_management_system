<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    public $fillable = ['name', 'batch_id','container_id','customer_id','amount'];

    public $table = "inventory_mark";

}
