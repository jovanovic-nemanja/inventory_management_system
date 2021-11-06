<?php

namespace App\Http\Controllers\Admin;

use App\Comments;
use App\Http\Controllers\Controller;
use App\Product;
use App\Purchaseorders;
use App\Quotes;
use App\Reviews;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PurchaseordersController extends Controller
{

    public function __construct()
    {

        $this->middleware(['auth', 'manager']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $quotes = Purchaseorders::Join('quotes', 'quotes.id', '=', 'purchase_orders.request_id')
            ->Join('requests', 'requests.id', '=', 'quotes.request_id')
            ->Join('users', 'users.id', '=', 'requests.sender')
            ->Join('currencies', 'currencies.id', '=', 'quotes.currency')
            ->select('quotes.*', 'purchase_orders.id as purchase_orders_id', 'requests.receiver as seller', 'purchase_orders.delivery_status as delivery_status', 'currencies.name as currency_name', 'quotes.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.buyer_payment_status', 'purchase_orders.buyer_delivery_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id', 'users.name as username', 'users.company_name as buyer_company_name')
            ->get();

        $products = Product::all();
        // echo '<pre>';
        // print_r($quotes);exit;

        return view('admin.purchaseorders.index', compact('products', 'quotes'));

    }
    public function details($id)
    {

        $records = Purchaseorders::Join('quotes', 'quotes.id', '=', 'purchase_orders.request_id')
            ->Join('requests', 'requests.id', '=', 'quotes.request_id')
            ->Join('products', 'products.id', '=', 'requests.product_id')
            ->Join('users', 'users.id', '=', 'requests.sender')
            ->Join('currencies', 'currencies.id', '=', 'users.currency')
            ->Join('unit', 'unit.id', '=', 'products.unit')
            ->where('quotes.status', 2)
            ->where('purchase_orders.id', $id)
            ->select('quotes.*', 'requests.sender as sender', 'requests.sign_date as request_date', 'unit.name as unitname', 'currencies.name as currency_name', 'purchase_orders.id as purchase_orders_id', 'products.price_from as price_from', 'products.price_to as price_to', 'products.price_fixed as price_fixed', 'products.price_show as price_show', 'products.MOQ as MOQ', 'products.image_url as product_image_url', 'products.slug as product_slug', 'requests.receiver as seller', 'purchase_orders.delivery_status as delivery_status', 'currencies.name as currency_name', 'quotes.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.buyer_payment_status', 'purchase_orders.buyer_delivery_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id', 'users.name as username', 'users.company_name as buyer_company_name')
            ->first();

        $comments = Comments::where('purchase_id', $id)->get();

        // echo '<pre>';
        // print_r($comments);exit;

        $seller_id = str_replace('[', ' ', $records->seller);
        $seller_id = str_replace(']', ' ', $seller_id);
        $buyer_detail = User::where('id', $records->sender)->first();

        $seller_detail = User::where('id', $seller_id)->first();

        $userid = auth()->id();
        $seller_review = Reviews::where('purchase_id', $id)->where('putter', $seller_id)->first();
        $buyer_review = Reviews::where('purchase_id', $id)->where('putter', $records->sender)->first();
        // echo '<pre>';
        // print_r($buyer_review);exit;
        if ($seller_detail === null) {
            // user doesn't exist
            $seller_detail = [];
        }

        return view('admin.purchaseorders.view', compact('records', 'buyer_detail', 'seller_detail', 'comments', 'seller_review', 'buyer_review'));
    }

    /**
     * Display a listing of the resource when payment status is 3.
     *
     * @return \Illuminate\Http\Response
     */
    public function completedorders()
    {
        $quotes = Purchaseorders::where('purchase_orders.payment_status', '=', 3)
            ->where('purchase_orders.delivery_status', '=', 3)
            ->Join('quotes', 'quotes.id', '=', 'purchase_orders.request_id')
            ->Join('requests', 'quotes.request_id', '=', 'requests.id')
            ->Join('users', 'users.id', '=', 'requests.sender')
            ->where('quotes.status', 2)
            ->select('quotes.*', 'purchase_orders.id as purchase_orders_id', 'purchase_orders.sign_date as purchase_date', 'requests.receiver as seller', 'requests.product_id as product_id', 'quotes.alternative_product as alternative_product_id', 'purchase_orders.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id', 'users.name as username', 'users.company_name as buyer_company_name', 'requests.sender as buyer_id')
            ->get();
        return view('admin.purchaseorders.completedorders', compact('quotes'));

    }

    public function completedordersdetails($id)
    {

        $records = Purchaseorders::Join('quotes', 'quotes.id', '=', 'purchase_orders.request_id')
            ->Join('requests', 'requests.id', '=', 'quotes.request_id')
            ->Join('products', 'products.id', '=', 'requests.product_id')
            ->Join('users', 'users.id', '=', 'requests.sender')
            ->Join('currencies', 'currencies.id', '=', 'users.currency')
            ->Join('unit', 'unit.id', '=', 'products.unit')
            ->where('quotes.status', 2)
            ->where('purchase_orders.id', $id)
            ->select('quotes.*', 'requests.sender as sender', 'requests.sign_date as request_date', 'unit.name as unitname', 'currencies.name as currency_name', 'purchase_orders.id as purchase_orders_id', 'products.price_from as price_from', 'products.price_to as price_to', 'products.price_fixed as price_fixed', 'products.price_show as price_show', 'products.MOQ as MOQ', 'products.image_url as product_image_url', 'products.slug as product_slug', 'requests.receiver as seller', 'purchase_orders.delivery_status as delivery_status', 'currencies.name as currency_name', 'quotes.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.buyer_payment_status', 'purchase_orders.buyer_delivery_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id', 'users.name as username', 'users.company_name as buyer_company_name')
            ->first();

        $comments = Comments::where('purchase_id', $id)->get();

        $seller_id = str_replace('[', ' ', $records->seller);
        $seller_id = str_replace(']', ' ', $seller_id);
        $buyer_detail = User::where('id', $records->sender)->first();

        $seller_detail = User::where('id', $seller_id)->first();

        $userid = auth()->id();
        $seller_review = Reviews::where('purchase_id', $id)->where('putter', $seller_id)->first();
        $buyer_review = Reviews::where('purchase_id', $id)->where('putter', $records->sender)->first();
        if ($seller_detail === null) {
            $seller_detail = [];
        }
        return view('admin.purchaseorders.completedorders_details', compact('records', 'buyer_detail', 'seller_detail', 'comments', 'seller_review', 'buyer_review'));
    }

    public function archievedorders()
    {
        $quotes = Quotes::where('quotes.status', 3)
            ->Join('achieved_quotes', 'achieved_quotes.request_id', '=', 'quotes.id')
            ->Join('requests', 'requests.id', '=', 'quotes.request_id')
            ->Join('currencies', 'currencies.id', '=', 'quotes.currency')
            ->Join('users', 'users.id', '=', 'requests.sender')
            ->whereNull('quotes.deleted_at')
            ->select('quotes.*', 'users.company_name as buyer', 'currencies.name as currency_name', 'requests.sign_date as re_sign_date', 'achieved_quotes.sign_date as sign_date', 'requests.status as re_status', 'quotes.status as status', 'quotes.id as main_id')
            ->get();
        $products = Product::all();

        return view('admin.purchaseorders.archievedorders', compact('quotes'));

    }
    public function archievedordersview($id)
    {
        $records = Quotes::where('quotes.id', $id)
            ->Join('requests', 'requests.id', '=', 'quotes.request_id')
            ->Join('achieved_quotes', 'achieved_quotes.request_id', '=', 'quotes.id')
            ->Join('products', 'products.id', '=', 'requests.product_id')
            ->Join('currencies', 'currencies.id', '=', 'products.currency_id')
            ->Join('unit', 'unit.id', '=', 'products.unit')
            ->select('quotes.*', 'achieved_quotes.sign_date as archive_date', 'requests.id as requests_id', 'requests.sign_date as request_date', 'requests.sender as requestsender', 'currencies.name as currency_name', 'unit.name as unitname', 'products.price_to as price_to', 'products.price_from as price_from', 'products.price_show as price_show', 'products.price_fixed as price_fixed', 'products.MOQ as MOQ', 'products.name as product_name', 'products.image_url as product_image_url', 'products.slug as product_slug')
            ->first();
        $seller_id = str_replace('[', ' ', $records->sender);
        $seller_id = str_replace(']', ' ', $seller_id);
        $buyer_detail = User::where('id', $records->requestsender)->first();

        if ($buyer_detail === null) {
            // user doesn't exist
            $buyer_detail = [];
        }

        $seller_detail = User::where('id', $seller_id)->first();

        if ($seller_detail === null) {
            // user doesn't exist
            $seller_detail = [];
        }

        //echo '<pre>';print_r($buyer_detail); exit;
        return view('admin.purchaseorders.archievedview', compact('records', 'buyer_detail', 'seller_detail'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * response ajax data comment
     *
     * @param int $id -> purchase orders table id
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
