<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

    ///////////////////////////// sub category part ///////////////////////////////////

    // public $fillable = ['name', 'parent', 'slug', 'sign_date'];
    
    ///////////////////////////// sub category part ///////////////////////////////////
    
    public $fillable = ['name'];

    public function products(){
        return $this->hasMany('App\Product');
    }
 public function getcurrency($currency_id) {
        if(@$currency_id) {
            $results = Currency::where('id', $currency_id)->get();
            if(@$results) {
                $result = $results[0]->name;
            }else{
                $result = "None";    
            }
        }else {
            $result = "None";
        }

        return $result;
    }
 
}
