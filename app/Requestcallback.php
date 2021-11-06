<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Requestcallback extends Model
{
    public $fillable = ['customer_id', 'name', 'email_add', 'mobile', 'product_id', 'prod_name', 'message','sign_date'];

    public $table = "requestcallback";

    public static function getUsername($id) {
        if(@$id) {
            $result = User::where('id', $id)->first();
            if(@$result) {
                $str = $result->name;
            }else{
                $str = "None";
            }
        }else {
            $str = "None";
        }

        return $str;
    }
}
