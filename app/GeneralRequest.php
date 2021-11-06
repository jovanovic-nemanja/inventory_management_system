<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Unit;
use App\Currency;
use App\Files;
use App\Quotes;
use Illuminate\Database\Eloquent\SoftDeletes;


class GeneralRequest extends Model
{
    use SoftDeletes;

    public $fillable = ['product_name', 'req_quantity', 'status', 'volume', 'unit', 'additional_information', 'sender', 'receiver', 'sign_date'];

    public $table = "general_requests";

    public function getunit($unit_id) {
        if(@$unit_id) {
            $results = Unit::where('id', $unit_id)->get();
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

    public function getstatuesname($id) {
        if(@$id) {
            if ($id == 1 || $id == NULL) {
                $name = "Pending";
            }else if ($id == 2) {
                $name = "Approved";
            }else{
                $name = "Canceled";
            }
        }else {
            $name = "None";
        }

        return $name;
    }

    public function getUsername($id) {
        if(@$id) {
            $results = User::where('id', $id)->get();
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

    public function is_quotes($id)
    {
        if (@$id) {
            $userid = auth()->id();
            $records = Quotes::where('request_id', $id)->where('sender', $userid)->first();

            if (@$records) {
                return 1;
            }else{
                return -1;
            }
        }
    }

    public function getfiles($id) {
        if (@$id) {
            $record = Files::where('request_id', $id)->first();
            if (@$record) {
                return asset('uploads/') . "/" . $record->name;
            }else{
                return false;
            }
        }
        return false;
    }
}
