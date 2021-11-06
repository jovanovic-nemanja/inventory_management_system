<?php

namespace App\Http\Controllers\Frontend;

use App\Achievedquotes;
use App\Http\Controllers\Controller;
use App\Image;
use App\Product;
use App\Purchaseorders;
use App\Quotes;
use App\Requests;
use App\User;
use Illuminate\Support\Facades\DB;

class AchievedquotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = "Achieved Quotes";
        $userid = auth()->id();
        if (auth()->user()->hasRole('seller')) {
            $quotes = DB::table('quotes')
                ->Join('achieved_quotes', 'achieved_quotes.request_id', '=', 'quotes.id')
                ->Join('requests', 'requests.id', '=', 'quotes.request_id')
                ->Join('users', 'users.id', '=', 'requests.sender')
                ->join('currencies', 'currencies.id', '=', 'quotes.currency')
                ->where('requests.receiver', '[' . $userid . ']')
                ->select('quotes.*', 'currencies.name as currency_name', 'users.company_name as company_name', 'requests.sign_date as re_sign_date', 'achieved_quotes.sign_date as sign_date', 'requests.status as re_status', 'quotes.status as status', 'quotes.id as main_id')
                ->get();
        }
        if (auth()->user()->hasRole('buyer')) {
            $quotes = DB::table('quotes')
                ->Join('achieved_quotes', 'achieved_quotes.request_id', '=', 'quotes.id')
                ->Join('requests', 'requests.id', '=', 'quotes.request_id')
                ->Join('users', 'users.id', '=', 'quotes.sender')
                ->join('currencies', 'currencies.id', '=', 'quotes.currency')
                ->where('requests.sender', $userid)
                ->select('quotes.*', 'currencies.name as currency_name', 'users.company_name as company_name', 'requests.sign_date as re_sign_date', 'achieved_quotes.sign_date as sign_date', 'requests.status as re_status', 'quotes.status as status', 'quotes.id as main_id')
                ->get();
        }
        // echo '<pre>';
        // print_r($quotes);exit;

        $products = Product::all();

        return view('frontend.achievedquotes.index', compact('products', 'quotes', 'page'));
    }

    public function downloadpdf($id)
    {
        $page = "Purchase Orders Status Change";
        $userid = auth()->id();

        if (@$id) {
            $requests = Quotes::where('id', $id)->get();
            $getid = Requests::where('id', $requests[0]->request_id)->get();
            $receiver = str_replace(']', '', str_replace('[', '', $getid[0]->receiver));
            $seller_detail = DB::table('users')
                ->leftJoin('countries', 'countries.id', 'users.country')
                ->where('users.id', $receiver)
                ->select('users.*', 'countries.name as sellercountry')
                ->get();
            $buyer_detail = DB::table('users')
                ->leftJoin('countries', 'countries.id', 'users.country')
                ->where('users.id', $getid[0]->sender)
                ->select('users.*', 'countries.name as sellercountry')
                ->get();
            if ($requests[0]->alternative_product == '' || $requests[0]->alternative_product == 0) {
                $quotes = DB::table('quotes')
                    ->leftJoin('requests', 'requests.id', 'quotes.request_id')
                    ->leftJoin('products', 'products.id', '=', 'requests.product_id')
                    ->leftJoin('currencies', 'currencies.id', '=', 'quotes.currency')
                    ->leftJoin('unit', 'unit.id', '=', 'products.unit')
                    ->where('quotes.id', $id)
                    ->select('quotes.*', 'products.*', 'unit.name as unitname', 'currencies.name as currency_name')
                    ->get();
            } else {
                $quotes = DB::table('quotes')
                    ->leftJoin('requests', 'requests.id', 'quotes.request_id')
                    ->leftJoin('products', 'products.id', '=', 'requests.product_id')
                    ->leftJoin('currencies', 'currencies.id', '=', 'quotes.currency')
                    ->leftJoin('unit', 'unit.id', '=', 'products.unit')
                    ->where('quotes.id', $id)
                    ->select('quotes.*', 'products.*', 'unit.name as unitname', 'currencies.name as currency_name')
                    ->get();
            }
            return view('frontend.achievedquotes.downloadpdf', compact('quotes', 'seller_detail', 'buyer_detail', 'page'));

        }
    }

    public function detailview($id)
    {
        $page = 'Detail';
        if (@$id) {
            $data = [];
            $records = Quotes::where('quotes.id', $id)
                ->Join('achieved_quotes', 'achieved_quotes.request_id', '=', 'quotes.id')
                ->select('quotes.*', 'achieved_quotes.sign_date as achieved_date')
                ->get();
            // echo '<pre>';
            // print_r($records);exit;
            $request_id = $records[0]['request_id'];
            $product = Requests::where('id', $request_id)->get();
            $req_quantity = $records[0]['volume'];
            $result = $records[0];
            if ($result['alternative_product'] != '' || $result['alternative_product'] != 0) {
                $product_detail = DB::table('products')
                    ->select('products.*', 'unit.name as product_unit_name', 'currencies.name as currency_name')
                    ->join('requests', 'requests.product_id', '=', 'products.id')
                    ->join('unit', 'unit.id', '=', 'products.unit')
                    ->join('currencies', 'currencies.id', '=', 'products.currency_id')
                    ->where('requests.id', $result['request_id'])->get();
            } else {
                $product_detail = DB::table('products')
                    ->select('products.*', 'unit.name as product_unit_name', 'currencies.name as currency_name')
                    ->join('requests', 'requests.product_id', '=', 'products.id')
                    ->join('currencies', 'currencies.id', '=', 'products.currency_id')
                    ->join('unit', 'unit.id', '=', 'products.unit')
                    ->where('requests.id', $result['request_id'])->get();
            }

            $imagesUrl = Image::where('product_id', $product_detail[0]->id)->first();
            $seller = User::where('id', $result->sender)->first();
            $result['product_name'] = $product[0]->product_name;
            $result['volume'] = $req_quantity;
            $result['unit'] = $product[0]->unit;
            $result['readonly'] = "readonly";
            $result['request_post_on'] = $product[0]->sign_date;

            $purchaseorders = Purchaseorders::where('request_id', $id)->get();
            if (@$purchaseorders[0]) {
                $result['purchase'] = $purchaseorders[0];
            } else {
                $achieves = Achievedquotes::where('request_id', $id)->get();
                if (@$achieves[0]) {
                    $result['purchase'] = $achieves[0];
                } else {
                    $result['purchase'] = "";
                }
            }

            return view('frontend.achievedquotes.detailview', compact('result', 'seller', 'product_detail', 'imagesUrl', 'page'));
        }
    }
}