<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customerbalancelog extends Model {

    public $fillable = ['customer_id','current_balance','deposit_balance','remarks','deposit_date'];
    public $table = "inventory_customer_balance_log";


}
