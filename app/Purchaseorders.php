<?php

namespace App;

use App\Currency;
use App\Product;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Purchaseorders extends Model
{
    public $fillable = ['request_id', 'payment_status', 'buyer_payment_status', 'delivery_status', 'buyer_delivery_status', 'payment_information', 'buyer_payment_information', 'delivery_information', 'buyer_delivery_information', 'payment_document', 'delivery_document', 'sign_date', 'updated_at', 'delivery_updated_at', 'buyer_delivery_updated_at', 'payment_updated_at', 'buyer_payment_updated_at'];

    public $table = "purchase_orders";

    public function getstatus($id)
    {
        $status = "Payment Pending";

        switch ($id) {
            case '1':
                $status = "Payment Pending";
                break;
            case '2':
                $status = "Delivered";
                break;
            case '3':
                $status = "Delivery Fine";
                break;
            default:
                break;
        }

        return $status;
    }

    public function getUsername($id)
    {
        if (@$id) {
            $record = User::where('id', $id)->first();
            return $record->name;
        } else {
            return "None";
        }
    }
    public static function getCurrencyNameByProductId($prodid)
    {
        if (@$prodid) {
            $product = Product::where('id', $prodid)->first();
            if (@$product) {
                $currency_id = $product->currency_id;
                if (@$sellerid) {
                    $seller = Currency::where('id', $currency_id)->first();
                    if (@$seller) {
                        $currency_name = $seller->name;
                    }
                }
            }
        } else {
            $currency_name = "None";
        }

        return $currency_name;
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
}