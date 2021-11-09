<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Containerdetail extends Model {

    public $fillable = ['shipper_info','notify_info','port_loading','bill_loading','consignee_info','vessel_no','port_discharge', 'type'];
    public $table = "inventory_container_detail";


}
