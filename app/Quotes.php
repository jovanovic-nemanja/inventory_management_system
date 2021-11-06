<?php

namespace App;

use App\Quotes;
use App\Requests;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotes extends Model
{
    use SoftDeletes;

    public $fillable = ['request_id', 'status', 'shipping_price', 'product_price', 'sign_date', 'shipping_desc', 'shipping_weight', 'shipping_unit', 'vat', 'other_price', 'other_price_desc', 'alternative_product', 'alternative_product_price', 'unit', 'currency', 'volume', 'product_name', 'total_price', 'available', 'sender'];

    public $table = "quotes";

    public function getRequestinformation($request_id)
    {
        $results = [];

        if (@$request_id) {
            $requests = Requests::where('id', $request_id)->get();
            // $results['sender'] = $this->getUsername($requests[0]->receiver);
            $results['sign_date'] = $requests[0]->sign_date;
            $results['product_name'] = $requests[0]->product_name;
            $results['volume'] = $requests[0]->volume;
            $results['unit'] = $this->getunit($requests[0]->unit);
        }
        return $results;
    }
    public function sellerDetail($id)
    {
        $seller_id = str_replace('[', '', $id);
        $id = str_replace(']', '', $seller_id);

        if (@$id) {
            $results = User::where('id', $id)->get();
            if (@$results) {
                $result = $results[0]->company_name;
            } else {
                $result = "None";
            }
        } else {
            $result = "None";
        }

        return $result;
    }
    public function getUsername($id)
    {
        if (@$id) {
            $results = User::where('id', $id)->get();
            if (@$results) {
                $result = $results[0]->name;
            } else {
                $result = "None";
            }
        } else {
            $result = "None";
        }

        return $result;
    }

    public function getunit($unit_id)
    {
        if (@$unit_id) {
            $results = Unit::where('id', $unit_id)->get();
            if (@$results) {
                $result = $results[0]->name;
            } else {
                $result = "None";
            }
        } else {
            $result = "None";
        }

        return $result;
    }

    public function getstatuesname($id)
    {
        if (@$id) {
            if ($id == 1 || $id == null) {
                $name = "Pending";
            } else if ($id == 2) {
                $name = "Approved";
            } else {
                $name = "Canceled";
            }
        } else {
            $name = "None";
        }

        return $name;
    }

    public static function getRequestNumber($id)
    {
        if (@$id) {
            $request = Requests::where('id', $id)->first();
            if (!empty($request)) {
                $request_number = '000' . $request->id;

            } else {
                $request_number = '';
            }
        } else {
            $request_number = '';
        }
        return $request_number;
    }
}