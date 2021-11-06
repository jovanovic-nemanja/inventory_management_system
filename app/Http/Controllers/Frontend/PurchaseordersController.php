<?php

namespace App\Http\Controllers\Frontend;

use App\Comments;
use App\Http\Controllers\Controller;
use App\Product;
use App\Purchaseorders;
use App\Quotes;
use App\Requests;
use App\Reviews;
use App\Unit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\EmailTemplates;

class PurchaseordersController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = "Purchase Orders";
        $userid = auth()->id();
        if (auth()->user()->hasRole('seller')) {
            $quotes = DB::table('quotes')
                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                ->Join('requests','requests.id','=','quotes.request_id')
                ->Join('products', 'products.id', '=', 'requests.product_id')
                ->Join('users', 'users.id', '=', 'quotes.sender')
                ->Join('currencies', 'currencies.id', '=', 'quotes.currency')
                ->where('quotes.sender', $userid)
                ->select('quotes.*', 'currencies.name as currency_name', 'purchase_orders.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.delivery_status', 'purchase_orders.buyer_payment_status', 'purchase_orders.buyer_delivery_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id')
                ->get();
        }
        if (auth()->user()->hasRole('buyer')) {
            $quotes = DB::table('quotes')
                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                ->Join('requests', 'requests.id', '=', 'quotes.request_id')
                ->Join('products', 'products.id', '=', 'requests.product_id')
                ->Join('users', 'users.id', '=', 'requests.sender')
                ->Join('currencies', 'currencies.id', '=', 'quotes.currency')
                ->where('quotes.status', 2)
                ->where('requests.sender', $userid)
                ->select('quotes.*', 'currencies.name as currency_name', 'quotes.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.buyer_payment_status', 'purchase_orders.buyer_delivery_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id', 'users.name as username', 'users.company_name')
                ->get();
        }

        $products = Product::all();

        return view('frontend.purchaseorders.index', compact('products', 'quotes', 'page'));
    }

    /**
     * Display a listing of the resource when payment status is 3.
     *
     * @return \Illuminate\Http\Response
     */
    public function completedorders()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = "Completed Orders";
        $userid = auth()->id();
        if (auth()->user()->hasRole('seller')) {
            $quotes = DB::table('quotes')
                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                ->Join('requests', 'quotes.request_id', '=', 'requests.id')
                ->Join('users', 'users.id', '=', 'requests.sender')
                ->where('quotes.sender', $userid)
                ->where('purchase_orders.payment_status', 3)
                ->whereNull('quotes.deleted_at')
                ->select('quotes.*', 'requests.product_id as product_id', 'quotes.alternative_product as alternative_product_id', 'purchase_orders.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id', 'users.name as username', 'users.company_name', 'requests.sender as buyer_id')
                ->get();
        }
        if (auth()->user()->hasRole('buyer')) {
            $quotes = DB::table('quotes')
                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                ->Join('requests', 'quotes.request_id', '=', 'requests.id')
                ->Join('users', 'users.id', '=', 'quotes.sender')
                ->where('quotes.status', 2)
                ->where('purchase_orders.payment_status', 3)
                ->where('requests.sender', $userid)
                ->whereNull('quotes.deleted_at')
                ->select('quotes.*', 'requests.product_id as product_id', 'quotes.alternative_product as alternative_product_id', 'quotes.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id', 'users.name as username', 'users.company_name')
                ->get();
        }

        $reviews = Reviews::all();
        $products = Product::all();
        return view('frontend.purchaseorders.completedorders', compact('products', 'quotes', 'reviews', 'page'));
    }

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
     * Payment status change page render
     *
     * @param  int  $id------purchase_orders table id
     * @return \Illuminate\Http\Response
     */
    public function paymentchange($id)
    {
        $page = "Purchase Orders Status Change";
        $userid = auth()->id();
        if (@$id) {
            $record = Purchaseorders::where('id', $id)->first();
            $requests = Quotes::where('id', $record->request_id)->get();
            if ($requests[0]->alternative_product == '' || $requests[0]->alternative_product == 0) {
                $quotes = DB::table('quotes')
                    ->Join('requests', 'requests.id', '=', 'quotes.request_id')
                    ->leftJoin('products', 'products.id', '=', 'requests.product_id')
                    ->leftJoin('currencies', 'currencies.id', '=', 'products.currency_id')
                    ->leftJoin('unit', 'unit.id', '=', 'products.unit')
                    ->where('quotes.id', $record->request_id)
                    ->select('quotes.*', 'products.*', 'unit.name as unitname', 'currencies.name as currency_name')
                    ->get();
            } else {
                $quotes = DB::table('quotes')
                    ->leftJoin('requests', 'requests.id', 'quotes.request_id')
                    ->leftJoin('products', 'products.id', '=', 'requests.id')
                    ->leftJoin('currencies', 'currencies.id', '=', 'quotes.currency')
                    ->leftJoin('unit', 'unit.id', '=', 'products.unit')
                    ->where('quotes.id', $record->request_id)
                    ->select('quotes.*', 'products.*', 'unit.name as unitname', 'currencies.name as currency_name')
                    ->get();
            }
            if (isset($quotes[0]->shipping_unit)) {
                $shipping_unit_name = Unit::where('id', $quotes[0]->shipping_unit)->first();
                $shipping_unit = $shipping_unit_name->name;
            } else {
                $shipping_unit = '';
            }

            return view('frontend.purchaseorders.paymentchange', compact('record', 'quotes', 'shipping_unit', 'page'));
        }
    }
    public function downloadpdf($id)
    {
        $page = "Purchase Orders Status Change";
        $userid = auth()->id();

        if (@$id) {
            $record = Purchaseorders::where('id', $id)->first();
            $requests = Quotes::where('id', $record->request_id)->get();
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
                    ->where('quotes.id', $record->request_id)
                    ->select('quotes.*', 'products.*', 'unit.name as unitname', 'currencies.name as currency_name')
                    ->get();
            } else {
                $quotes = DB::table('quotes')
                    ->leftJoin('requests', 'requests.id', 'quotes.request_id')
                    ->leftJoin('products', 'products.id', '=', 'requests.product_id')
                    ->leftJoin('currencies', 'currencies.id', '=', 'quotes.currency')
                    ->leftJoin('unit', 'unit.id', '=', 'products.unit')
                    ->where('quotes.id', $record->request_id)
                    ->select('quotes.*', 'products.*', 'unit.name as unitname', 'currencies.name as currency_name')
                    ->get();
            }
            return view('frontend.purchaseorders.downloadpdf', compact('record', 'quotes', 'seller_detail', 'buyer_detail', 'page'));
        }
    }
    public function deliverychange($id)
    {
        $page = "Delivery Status Change";
        $userid = auth()->id();
        if (@$id) {
            $record = Purchaseorders::where('id', $id)->first();
            $requests = Quotes::where('id', $record->request_id)->get();
            if ($requests[0]->alternative_product == '' || $requests[0]->alternative_product == 0) {
                $quotes = DB::table('quotes')
                    ->leftJoin('requests', 'requests.id', 'quotes.request_id')
                    ->leftJoin('products', 'products.id', '=', 'requests.product_id')
                    ->leftJoin('currencies', 'currencies.id', '=', 'quotes.currency')
                    ->leftJoin('unit', 'unit.id', '=', 'products.unit')
                    ->where('quotes.id', $record->request_id)
                    ->select('quotes.*', 'products.*', 'unit.name as unitname', 'currencies.name as currency_name')
                    ->get();
            } else {
                $quotes = DB::table('quotes')
                    ->leftJoin('requests', 'requests.id', 'quotes.request_id')
                    ->leftJoin('products', 'products.id', '=', 'requests.id')
                    ->leftJoin('currencies', 'currencies.id', '=', 'quotes.currency')
                    ->leftJoin('unit', 'unit.id', '=', 'products.unit')
                    ->where('quotes.id', $record->request_id)
                    ->select('quotes.*', 'products.*', 'unit.name as unitname', 'currencies.name as currency_name')
                    ->get();
            }
            if (isset($quotes[0]->shipping_unit)) {
                $shipping_unit_name = Unit::where('id', $quotes[0]->shipping_unit)->first();
                $shipping_unit = $shipping_unit_name->name;
            } else {
                $shipping_unit = '';
            }
            return view('frontend.purchaseorders.deliverychange', compact('record', 'quotes', 'shipping_unit', 'page'));
        }
    }

    /**
     * Add Review page render
     *
     * @param  int  $id------purchase_orders table id
     * @return \Illuminate\Http\Response
     */
    public function addreview($id)
    {
        $page = "Purchase Orders";
        if (@$id) {
            $record = Purchaseorders::where('id', $id)->first();

            $userid = auth()->id();
            $username = User::where('id', $userid)->first();
            $company = $username->company_name;

            if (auth()->user()->hasRole('seller')) {
                $quotes = DB::table('quotes')
                    ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                    ->Join('requests', 'quotes.request_id', '=', 'requests.id')
                    ->Join('users', 'users.id', '=', 'requests.sender')
                    ->where('purchase_orders.id', $id)
                    ->select('requests.sender', 'users.name as username')
                    ->get();
            }
            if (auth()->user()->hasRole('buyer')) {
                $quotes = DB::table('quotes')
                    ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                    ->Join('users', 'users.id', '=', 'quotes.sender')
                    ->where('purchase_orders.id', $id)
                    ->select('quotes.sender', 'users.name as username')
                    ->get();
            }

            return view('frontend.purchaseorders.addreview', compact('record', 'quotes', 'company', 'page'));
        }
    }

    public function viewreview($id)
    {
        $page = "Your sent review";
        if (@$id) {
            $record = Purchaseorders::where('id', $id)->first();

            $userid = auth()->id();
            $record = Reviews::where('purchase_id', $id)->where('putter', $userid)->first();
            $receiver_id = $record->receiver;
            $receiver_record = Reviews::where('purchase_id', $id)->where('putter', $receiver_id)->first();
            $putter = User::where('id', $userid)->first();
            $receiver = User::where('id', $receiver_id)->first();

            return view('frontend.purchaseorders.viewreview', compact('record', 'receiver_record', 'putter', 'receiver', 'page'));
        }
    }

    /**
     * Update the specified resource in storage. (Payment status change function)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        if (@$request->file) {
            $request->validate([
                'file' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx,xlx,csv|max:2048',
            ]);
            $fileName = 'payment_' . time() . '.' . $request->file->extension();
            $request->file->move(public_path('uploads/payment_document'), $fileName);
        } else {
            $fileName = '';
        }

        if (@$request->id) {
            $id = $request->id;
            $record = Purchaseorders::where('id', $id)->first();
            switch ($record->buyer_payment_status) {
                case '1':
                    $record->buyer_payment_information = $request->payment_information;
                    $record->buyer_payment_status = 3;
                    $record->payment_status = 3;
                    $record->payment_document = $fileName;
                    $record->buyer_payment_updated_at = date('Y-m-d h:i:s');
                    break;
                case '2':
                    $record->buyer_payment_information = $request->payment_information;
                    $record->buyer_payment_updated_at = date('Y-m-d h:i:s');
                    break;
                default:
                    break;
            }
            // Seller Mail

            $seller = DB::table('quotes')
                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                ->Join('requests', 'requests.id', '=', 'quotes.request_id')
                ->Join('products', 'products.id', '=', 'requests.product_id')
                ->Join('users', 'users.id', '=', 'quotes.sender')
                ->Join('currencies', 'currencies.id', '=', 'quotes.currency')
                ->Join('categories', 'categories.id', '=', 'products.category_id')
                ->Join('unit', 'unit.id', '=', 'products.unit')
                ->where('quotes.id', $record->request_id)
                ->select('quotes.*', 'quotes.volume as req_quantity', 'unit.name as unitname', 'categories.name as categoryname', 'products.name as product_name', 'products.slug as slug', 'products.image_url as image_url', 'users.name as username', 'users.email as useremail', 'users.company_name as company_name', 'currencies.name as currency_name', 'purchase_orders.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.delivery_status', 'purchase_orders.buyer_payment_status', 'purchase_orders.buyer_delivery_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id')
                ->first();

            $email_template =EmailTemplates:: where('email_type','po_payment_request_buyer')->first();

            $sellerEmailController = new EmailsController;
            $arraySeller = [];
            $arraySeller['username'] = $seller->username;
            $arraySeller['receiver_address'] = $seller->useremail;
            $arraySeller['data'] = array(
                'name' => $arraySeller['username'],
                'product_name' => $seller->product_name,
                'product_image' => 'https://mambodubai.com/uploads/' . $seller->image_url,
                'categoryname' => $seller->categoryname,
                'company_name' => $seller->company_name,
                'unitname' => $seller->unitname,
                'req_quantity' => $seller->req_quantity,
                'product_link' => route('product.show', $seller->slug),
                "body" =>$email_template->email_body,
            );
            $arraySeller['subject'] = $email_template->email_subject;
            $sellerEmailController->paymentMailSeller($arraySeller);

            $buyer = DB::table('quotes')
                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                ->Join('requests', 'requests.id', '=', 'quotes.request_id')
                ->Join('products', 'products.id', '=', 'requests.product_id')
                ->Join('users', 'users.id', '=', 'requests.sender')
                ->Join('currencies', 'currencies.id', '=', 'quotes.currency')
                ->Join('categories', 'categories.id', '=', 'products.category_id')
                ->Join('unit', 'unit.id', '=', 'products.unit')
                ->where('quotes.id', $record->request_id)
                ->select('quotes.*', 'quotes.volume as req_quantity', 'unit.name as unitname', 'categories.name as categoryname', 'products.name as product_name', 'products.slug as slug', 'products.image_url as image_url', 'users.name as username', 'users.email as useremail', 'users.company_name as company_name', 'currencies.name as currency_name', 'purchase_orders.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.delivery_status', 'purchase_orders.buyer_payment_status', 'purchase_orders.buyer_delivery_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id')
                ->first();

            $email_template =EmailTemplates:: where('email_type','po_payment_request_buyer')->first();
            $buyerEmailController = new EmailsController;
            $arrayBuyer = [];
            $arrayBuyer['username'] = $buyer->username;
            $arrayBuyer['receiver_address'] = $buyer->useremail;
            $arrayBuyer['data'] = array(
                'name' => $arrayBuyer['username'],
                'product_name' => $buyer->product_name,
                'product_image' => 'https://mambodubai.com/uploads/' . $buyer->image_url,
                'categoryname' => $buyer->categoryname,
                'company_name' => $buyer->company_name,
                'unitname' => $buyer->unitname,
                'req_quantity' => $buyer->req_quantity,
                'product_link' => route('product.show', $buyer->slug),
                "body" => $email_template->email_body,
            );
            $arrayBuyer['subject'] = $email_template->email_subject;
            $buyerEmailController->paymentMailBuyer($arrayBuyer);

            $record->update();

            return redirect()->route('purchaseorders.index')->with('message', 'success|Payment raised for puchase order successfully');
        } elseif (@$request->accept_id) {
            $id = $request->accept_id;
            $record = Purchaseorders::where('id', $id)->first();
            switch ($record->payment_status) {
                case '0':
                    $record->payment_information = $request->payment_information;
                    $record->payment_status = 3;
                    $record->buyer_payment_status = 3;
                    $record->payment_updated_at = date('Y-m-d h:i:s');
                    break;
                case '1':
                    $record->payment_information = $request->payment_information;
                    $record->payment_status = 2;
                    $record->payment_updated_at = date('Y-m-d h:i:s');
                    break;
                case '2':
                    $record->payment_information = $request->payment_information;
                    $record->payment_updated_at = date('Y-m-d h:i:s');
                    $record->payment_status = 3;
                    $record->buyer_payment_status = 3;
                    break;
                default:
                    break;
            }

            // Seller Mail

            $seller = DB::table('quotes')
                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                ->Join('requests', 'requests.id', '=', 'quotes.request_id')
                ->Join('products', 'products.id', '=', 'requests.product_id')
                ->Join('users', 'users.id', '=', 'quotes.sender')
                ->Join('currencies', 'currencies.id', '=', 'quotes.currency')
                ->Join('categories', 'categories.id', '=', 'products.category_id')
                ->Join('unit', 'unit.id', '=', 'products.unit')
                ->where('quotes.id', $record->request_id)
                ->select('quotes.*', 'quotes.volume as req_quantity', 'quotes.id as purchase_order_no', 'unit.name as unitname', 'categories.name as categoryname', 'products.name as product_name', 'products.slug as slug', 'products.image_url as image_url', 'users.name as username', 'users.email as useremail', 'users.company_name as company_name', 'currencies.name as currency_name', 'purchase_orders.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.delivery_status', 'purchase_orders.buyer_payment_status', 'purchase_orders.buyer_delivery_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id')
                ->first();
                $email_template =EmailTemplates:: where('email_type','po_payment_request_accept_seller')->first();
            $sellerEmailController = new EmailsController;
            $arraySeller = [];
            $arraySeller['username'] = $seller->username;
            $arraySeller['receiver_address'] = $seller->useremail;
            // $arraySeller['receiver_address'] = 'rider.ustc@gmail.com';
            $arraySeller['data'] = array(
                'name' => $arraySeller['username'],
                'product_name' => $seller->product_name,
                'product_image' => 'https://mambodubai.com/uploads/' . $seller->image_url,
                'categoryname' => $seller->categoryname,
                'company_name' => $seller->company_name,
                'unitname' => $seller->unitname,
                'req_quantity' => $seller->req_quantity,
                'purchase_order_no' => $seller->purchase_order_no,
                'product_link' => route('product.show', $seller->slug),
                "body" => $email_template ->email_body,
            );

            $arraySeller['subject'] = $email_template ->email_subject."( PO" . $seller->purchase_order_no . " ).";
            $sellerEmailController->paymentAcceptMailSeller($arraySeller);

            // Buyer Mail

            $buyer = DB::table('quotes')
                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                ->Join('requests', 'requests.id', '=', 'quotes.request_id')
                ->Join('products', 'products.id', '=', 'requests.product_id')
                ->Join('users', 'users.id', '=', 'requests.sender')
                ->Join('currencies', 'currencies.id', '=', 'quotes.currency')
                ->Join('categories', 'categories.id', '=', 'products.category_id')
                ->Join('unit', 'unit.id', '=', 'products.unit')
                ->where('quotes.id', $record->request_id)
                ->select('quotes.*', 'quotes.volume as req_quantity', 'quotes.id as purchase_order_no', 'unit.name as unitname', 'categories.name as categoryname', 'products.name as product_name', 'products.slug as slug', 'products.image_url as image_url', 'users.name as username', 'users.email as useremail', 'users.company_name as company_name', 'currencies.name as currency_name', 'purchase_orders.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.delivery_status', 'purchase_orders.buyer_payment_status', 'purchase_orders.buyer_delivery_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id')
                ->first();
                $email_template =EmailTemplates:: where('email_type','po_payment_request_accept_buyer')->first();
            $buyerEmailController = new EmailsController;
            $arrayBuyer = [];
            $arrayBuyer['username'] = $buyer->username;
            $arrayBuyer['receiver_address'] = $buyer->useremail;
            $arrayBuyer['data'] = array(
                'name' => $arrayBuyer['username'],
                'product_name' => $buyer->product_name,
                'product_image' => 'https://mambodubai.com/uploads/' . $buyer->image_url,
                'categoryname' => $buyer->categoryname,
                'company_name' => $buyer->company_name,
                'unitname' => $buyer->unitname,
                'req_quantity' => $buyer->req_quantity,
                'purchase_order_no' => $seller->purchase_order_no,
                'product_link' => route('product.show', $buyer->slug),
                "body" => $email_template ->email_body,
            );
            $arrayBuyer['subject'] = $email_template ->email_subject."( PO" . $seller->purchase_order_no . " ).";
            $buyerEmailController->paymentAcceptMailBuyer($arrayBuyer);

            $record->update();
            return redirect()->route('purchaseorders.index')->with('message', 'success|Payment accepted for puchase order successfully');
        } elseif (@$request->dispute_id) {
            $id = $request->dispute_id;
            $record = Purchaseorders::where('id', $id)->first();

            $record->payment_information = $request->payment_information;
            $record->payment_status = 0;
            $record->buyer_payment_status = 0;
            $record->payment_updated_at = date('Y-m-d h:i:s');

            // Seller Mail

            $seller = DB::table('quotes')
                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                ->Join('requests', 'requests.id', '=', 'quotes.request_id')
                ->Join('products', 'products.id', '=', 'requests.product_id')
                ->Join('users', 'users.id', '=', 'quotes.sender')
                ->Join('currencies', 'currencies.id', '=', 'quotes.currency')
                ->Join('categories', 'categories.id', '=', 'products.category_id')
                ->Join('unit', 'unit.id', '=', 'products.unit')
                ->where('quotes.id', $record->request_id)
                ->select('quotes.*', 'quotes.volume as req_quantity', 'quotes.id as purchase_order_no', 'unit.name as unitname', 'categories.name as categoryname', 'products.name as product_name', 'products.slug as slug', 'products.image_url as image_url', 'users.name as username', 'users.email as useremail', 'users.company_name as company_name', 'currencies.name as currency_name', 'purchase_orders.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.delivery_status', 'purchase_orders.buyer_payment_status', 'purchase_orders.buyer_delivery_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id')
                ->first();
                $email_template =EmailTemplates:: where('email_type','po_payment_request_dispute_seller')->first();
            $sellerEmailController = new EmailsController;
            $arraySeller = [];
            $arraySeller['username'] = $seller->username;
            $arraySeller['receiver_address'] = $seller->useremail;
            // $arraySeller['receiver_address'] = 'rider.ustc@gmail.com';
            $arraySeller['data'] = array(
                'name' => $arraySeller['username'],
                'product_name' => $seller->product_name,
                'product_image' => 'https://mambodubai.com/uploads/' . $seller->image_url,
                'categoryname' => $seller->categoryname,
                'company_name' => $seller->company_name,
                'unitname' => $seller->unitname,
                'req_quantity' => $seller->req_quantity,
                'purchase_order_no' => $seller->purchase_order_no,
                'product_link' => route('product.show', $seller->slug),
                "body" => $email_template->email_body,
            );
            $arraySeller['subject'] = $email_template->email_subject. "( PO" . $seller->purchase_order_no . " ).";
            $sellerEmailController->paymentDisputeMailSeller($arraySeller);

            // Buyer Mail

            $buyer = DB::table('quotes')
                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                ->Join('requests', 'requests.id', '=', 'quotes.request_id')
                ->Join('products', 'products.id', '=', 'requests.product_id')
                ->Join('users', 'users.id', '=', 'requests.sender')
                ->Join('currencies', 'currencies.id', '=', 'quotes.currency')
                ->Join('categories', 'categories.id', '=', 'products.category_id')
                ->Join('unit', 'unit.id', '=', 'products.unit')
                ->where('quotes.id', $record->request_id)
                ->select('quotes.*', 'quotes.volume as req_quantity', 'quotes.id as purchase_order_no', 'unit.name as unitname', 'categories.name as categoryname', 'products.name as product_name', 'products.slug as slug', 'products.image_url as image_url', 'users.name as username', 'users.email as useremail', 'users.company_name as company_name', 'currencies.name as currency_name', 'purchase_orders.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.delivery_status', 'purchase_orders.buyer_payment_status', 'purchase_orders.buyer_delivery_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id')
                ->first();
                $email_template =EmailTemplates:: where('email_type','po_payment_request_dispute_buyer')->first();
            $buyerEmailController = new EmailsController;
            $arrayBuyer = [];
            $arrayBuyer['username'] = $buyer->username;
            $arrayBuyer['receiver_address'] = $buyer->useremail;
            // $arrayBuyer['receiver_address'] = 'rider.ustc@gmail.com';
            $arrayBuyer['data'] = array(
                'name' => $arrayBuyer['username'],
                'product_name' => $buyer->product_name,
                'product_image' => 'https://mambodubai.com/uploads/' . $seller->image_url,
                'categoryname' => $buyer->categoryname,
                'company_name' => $buyer->company_name,
                'unitname' => $buyer->unitname,
                'req_quantity' => $buyer->req_quantity,
                'purchase_order_no' => $buyer->purchase_order_no,
                'product_link' => route('product.show', $buyer->slug),
                "body" => $email_template->email_body,
            );
            $arrayBuyer['subject'] = $email_template->email_subject."( PO" . $buyer->purchase_order_no . " ).";
            $buyerEmailController->paymentDisputeMailBuyer($arrayBuyer);

            $record->update();
            return redirect()->route('purchaseorders.index')->with('message', 'success|Payment dispute for puchase order successfully');
        }
    }
    public function deliveryupdate(Request $request)
    {
        if (@$request->file) {
            $request->validate([

                'file' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx,xlx,csv|max:2048',
            ]);
            $fileName = 'delivery_' . time() . '.' . $request->file->extension();
            $request->file->move(public_path('uploads/delivery_document'), $fileName);
        } else {
            $fileName = '';
        }
        if (@$request->id) {
            $id = $request->id;
            $record = Purchaseorders::where('id', $id)->first();

            switch ($record->delivery_status) {
                case '1':
                    $record->delivery_information = $request->delivery_information;
                    $record->delivery_status = 3;
                    $record->buyer_delivery_status = 3;
                    $record->delivery_document = $fileName;
                    $record->delivery_updated_at = date('Y-m-d h:i:s');
                    break;
                case '2':
                    $record->delivery_information = $request->delivery_information;
                    $record->delivery_updated_at = date('Y-m-d h:i:s');
                    break;
                default:
                    break;
            }

            // Seller Mail

            $seller = DB::table('quotes')
                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                ->Join('requests', 'requests.id', '=', 'quotes.request_id')
                ->Join('products', 'products.id', '=', 'requests.product_id')
                ->Join('users', 'users.id', '=', 'quotes.sender')
                ->Join('currencies', 'currencies.id', '=', 'quotes.currency')
                ->Join('categories', 'categories.id', '=', 'products.category_id')
                ->Join('unit', 'unit.id', '=', 'products.unit')
                ->where('quotes.id', $record->request_id)
                ->select('quotes.*', 'quotes.volume as req_quantity', 'quotes.id as purchase_order_no', 'unit.name as unitname', 'categories.name as categoryname', 'products.name as product_name', 'products.slug as slug', 'products.image_url as image_url', 'users.name as username', 'users.email as useremail', 'users.company_name as company_name', 'currencies.name as currency_name', 'purchase_orders.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.delivery_status', 'purchase_orders.buyer_payment_status', 'purchase_orders.buyer_delivery_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id')
                ->first();
                $email_template =EmailTemplates:: where('email_type','po_delivery_release_seller')->first();
            $sellerEmailController = new EmailsController;
            $arraySeller = [];
            $arraySeller['username'] = $seller->username;
            $arraySeller['receiver_address'] = $seller->useremail;
            $arraySeller['data'] = array(
                'name' => $arraySeller['username'],
                'product_name' => $seller->product_name,
                'product_image' => 'https://mambodubai.com/uploads/' . $seller->image_url,
                'categoryname' => $seller->categoryname,
                'company_name' => $seller->company_name,
                'unitname' => $seller->unitname,
                'req_quantity' => $seller->req_quantity,
                'purchase_order_no' => $seller->purchase_order_no,
                'product_link' => route('product.show', $seller->slug),
                "body" =>  $email_template->email_body,
            );
            $arraySeller['subject'] = $email_template->email_subject."(PO" . $seller->purchase_order_no . " ).";
            $sellerEmailController->deliveryMailSeller($arraySeller);

            // Buyer Mail

            $buyer = DB::table('quotes')
                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                ->Join('requests', 'requests.id', '=', 'quotes.request_id')
                ->Join('products', 'products.id', '=', 'requests.product_id')
                ->Join('users', 'users.id', '=', 'requests.sender')
                ->Join('currencies', 'currencies.id', '=', 'quotes.currency')
                ->Join('categories', 'categories.id', '=', 'products.category_id')
                ->Join('unit', 'unit.id', '=', 'products.unit')
                ->where('quotes.id', $record->request_id)
                ->select('quotes.volume as req_quantity', 'products.slug as slug', 'quotes.id as purchase_order_no', 'categories.name as categoryname', 'unit.name as unitname', 'users.company_name as company_name', 'products.name as product_name', 'products.image_url as image_url', 'users.name as username', 'users.email as useremail', 'currencies.name as currency_name', 'purchase_orders.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.delivery_status', 'purchase_orders.buyer_payment_status', 'purchase_orders.buyer_delivery_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id')
                ->first();
                $email_template =EmailTemplates:: where('email_type','po_delivery_release_buyer')->first();
            $buyerEmailController = new EmailsController;
            $arrayBuyer = [];
            $arrayBuyer['username'] = $buyer->username;
            $arrayBuyer['receiver_address'] = $buyer->useremail;
            $arrayBuyer['data'] = array(
                'name' => $arrayBuyer['username'],
                'product_name' => $buyer->product_name,
                'product_image' => 'https://mambodubai.com/uploads/' . $buyer->image_url,
                'categoryname' => $buyer->categoryname,
                'company_name' => $buyer->company_name,
                'unitname' => $buyer->unitname,
                'req_quantity' => $buyer->req_quantity,
                'purchase_order_no' => $buyer->purchase_order_no,
                'product_link' => route('product.show', $buyer->slug),
                "body" => $email_template->email_body,
            );
            $arrayBuyer['subject'] = $email_template->email_subject."(PO" . $buyer->purchase_order_no . " ).";
            $buyerEmailController->deliveryMailBuyer($arrayBuyer);

            $record->update();

            return redirect()->route('purchaseorders.index')->with('message', 'success|Delivery raised for puchase order successfully');
        } elseif (@$request->accept_id) {
            $id = $request->accept_id;
            $record = Purchaseorders::where('id', $id)->first();
            switch ($record->buyer_delivery_status) {
                case '0':
                    $record->buyer_delivery_information = $request->buyer_delivery_information;
                    $record->delivery_status = 3;
                    $record->buyer_delivery_status = 3;
                    $record->payment_updated_at = date('Y-m-d h:i:s');
                    break;
                case '1':
                    $record->buyer_delivery_information = $request->buyer_delivery_information;
                    $record->buyer_delivery_status = 2;
                    break;
                case '2':
                    $record->buyer_delivery_information = $request->buyer_delivery_information;
                    $record->delivery_status = 3;
                    $record->buyer_delivery_status = 3;
                    $record->payment_updated_at = date('Y-m-d h:i:s');
                    break;
                default:
                    break;
            }

            // Seller Mail

            $seller = DB::table('quotes')
                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                ->Join('requests', 'requests.id', '=', 'quotes.request_id')
                ->Join('products', 'products.id', '=', 'requests.product_id')
                ->Join('users', 'users.id', '=', 'quotes.sender')
                ->Join('currencies', 'currencies.id', '=', 'quotes.currency')
                ->Join('categories', 'categories.id', '=', 'products.category_id')
                ->Join('unit', 'unit.id', '=', 'products.unit')
                ->where('quotes.id', $record->request_id)
                ->select('quotes.*', 'quotes.volume as req_quantity', 'quotes.id as purchase_order_no', 'unit.name as unitname', 'categories.name as categoryname', 'products.name as product_name', 'products.slug as slug', 'products.image_url as image_url', 'users.name as username', 'users.email as useremail', 'users.company_name as company_name', 'currencies.name as currency_name', 'purchase_orders.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.delivery_status', 'purchase_orders.buyer_payment_status', 'purchase_orders.buyer_delivery_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id')
                ->first();
                $email_template =EmailTemplates:: where('email_type','po_delivery_accept_seller')->first();
            $sellerEmailController = new EmailsController;
            $arraySeller = [];
            $arraySeller['username'] = $seller->username;
            $arraySeller['receiver_address'] = $seller->useremail;
            $arraySeller['data'] = array(
                'name' => $arraySeller['username'],
                'product_name' => $seller->product_name,
                'product_image' => 'https://mambodubai.com/uploads/' . $seller->image_url,
                'categoryname' => $seller->categoryname,
                'company_name' => $seller->company_name,
                'unitname' => $seller->unitname,
                'req_quantity' => $seller->req_quantity,
                'purchase_order_no' => $seller->purchase_order_no,
                'product_link' => route('product.show', $seller->slug),
                "body" => $email_template->email_body,
            );
            $arraySeller['subject'] =$email_template->email_subject. "(PO" . $seller->purchase_order_no . " ).";
            $sellerEmailController->deliveryAcceptMailSeller($arraySeller);

            // Buyer Mail
            $email_template =EmailTemplates:: where('email_type','po_delivery_accept_buyer')->first();
            $buyer = DB::table('quotes')
                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                ->Join('requests', 'requests.id', '=', 'quotes.request_id')
                ->Join('products', 'products.id', '=', 'requests.product_id')
                ->Join('users', 'users.id', '=', 'requests.sender')
                ->Join('currencies', 'currencies.id', '=', 'quotes.currency')
                ->Join('categories', 'categories.id', '=', 'products.category_id')
                ->where('quotes.id', $record->request_id)
                ->select('quotes.*', 'quotes.volume as req_quantity', 'quotes.id as purchase_order_no', 'unit.name as unitname', 'categories.name as categoryname', 'products.name as product_name', 'products.slug as slug', 'products.image_url as image_url', 'users.name as username', 'users.email as useremail', 'users.company_name as company_name', 'currencies.name as currency_name', 'purchase_orders.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.delivery_status', 'purchase_orders.buyer_payment_status', 'purchase_orders.buyer_delivery_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id')
                ->first();

            $buyerEmailController = new EmailsController;
            $arrayBuyer = [];
            $arrayBuyer['username'] = $buyer->username;
            $arrayBuyer['receiver_address'] = $buyer->useremail;
            $arrayBuyer['data'] = array(
                'name' => $arrayBuyer['username'],
                'product_name' => $buyer->product_name,
                'product_image' => 'https://mambodubai.com/uploads/' . $buyer->image_url,
                'categoryname' => $buyer->categoryname,
                'company_name' => $buyer->company_name,
                'unitname' => $buyer->unitname,
                'req_quantity' => $buyer->req_quantity,
                'purchase_order_no' => $buyer->purchase_order_no,
                'product_link' => route('product.show', $buyer->slug),
                "body" =>$email_template->email_body,
            );
            $arrayBuyer['subject'] =$email_template->email_subject ."( PO" . $buyer->purchase_order_no . " ).";
            $buyerEmailController->deliverAcceptMailBuyer($arrayBuyer);

            $record->update();
            return redirect()->route('purchaseorders.index')->with('message', 'success|Delivery accepted for puchase order successfully');
        } elseif (@$request->dispute_id) {
            $id = $request->dispute_id;
            $record = Purchaseorders::where('id', $id)->first();

            $record->buyer_delivery_information = $request->buyer_delivery_information;
            $record->buyer_delivery_status = 0;
            $record->delivery_status = 0;

            // Seller Mail

            $seller = DB::table('quotes')
                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                ->Join('requests', 'requests.id', '=', 'quotes.request_id')
                ->Join('products', 'products.id', '=', 'requests.product_id')
                ->Join('users', 'users.id', '=', 'quotes.sender')
                ->Join('currencies', 'currencies.id', '=', 'quotes.currency')
                ->Join('categories', 'categories.id', '=', 'products.category_id')
                ->Join('unit', 'unit.id', '=', 'products.unit')
                ->where('quotes.id', $record->request_id)
                ->select('quotes.*', 'quotes.volume as req_quantity', 'quotes.id as purchase_order_no', 'unit.name as unitname', 'categories.name as categoryname', 'products.name as product_name', 'products.slug as slug', 'products.image_url as image_url', 'users.name as username', 'users.email as useremail', 'users.company_name as company_name', 'currencies.name as currency_name', 'purchase_orders.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.delivery_status', 'purchase_orders.buyer_payment_status', 'purchase_orders.buyer_delivery_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id')
                ->first();
                $email_template =EmailTemplates:: where('email_type','po_delivery_dispute_seller')->first();
            $sellerEmailController = new EmailsController;
            $arraySeller = [];
            $arraySeller['username'] = $seller->username;
            $arraySeller['receiver_address'] = $seller->useremail;
            $arraySeller['data'] = array(
                'name' => $arraySeller['username'],
                'product_name' => $seller->product_name,
                'product_image' => 'https://mambodubai.com/uploads/' . $seller->image_url,
                'categoryname' => $seller->categoryname,
                'company_name' => $seller->company_name,
                'unitname' => $seller->unitname,
                'req_quantity' => $seller->req_quantity,
                'purchase_order_no' => $seller->purchase_order_no,
                'dispute_information' => $request->buyer_delivery_information,
                'product_link' => route('product.show', $seller->slug),
                "body" => $email_template->email_body,
            );
            $arraySeller['subject'] = $email_template->email_subject."( PO" . $seller->purchase_order_no . " ).";
            $sellerEmailController->deliveryDisputeMailSeller($arraySeller);

            // Buyer Mail

            $buyer = DB::table('quotes')
                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                ->Join('requests', 'requests.id', '=', 'quotes.request_id')
                ->Join('products', 'products.id', '=', 'requests.product_id')
                ->Join('users', 'users.id', '=', 'requests.sender')
                ->Join('currencies', 'currencies.id', '=', 'quotes.currency')
                ->Join('categories', 'categories.id', '=', 'products.category_id')
                ->Join('unit', 'unit.id', '=', 'products.unit')
                ->where('quotes.id', $record->request_id)
                ->select('quotes.*', 'quotes.volume as req_quantity', 'quotes.id as purchase_order_no', 'unit.name as unitname', 'categories.name as categoryname', 'products.name as product_name', 'products.slug as slug', 'products.image_url as image_url', 'users.name as username', 'users.email as useremail', 'users.company_name as company_name', 'currencies.name as currency_name', 'purchase_orders.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.delivery_status', 'purchase_orders.buyer_payment_status', 'purchase_orders.buyer_delivery_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id')
                ->first();
            $email_template =EmailTemplates:: where('email_type','po_delivery_dispute_buyer')->first();
            $buyerEmailController = new EmailsController;
            $arrayBuyer = [];
            $arrayBuyer['username'] = $buyer->username;
            $arrayBuyer['receiver_address'] = $buyer->useremail;
            $arrayBuyer['data'] = array(
                'name' => $arrayBuyer['username'],
                'product_name' => $buyer->product_name,
                'product_image' => 'https://mambodubai.com/uploads/' . $buyer->image_url,
                'categoryname' => $buyer->categoryname,
                'company_name' => $buyer->company_name,
                'unitname' => $buyer->unitname,
                'req_quantity' => $buyer->req_quantity,
                'purchase_order_no' => $buyer->purchase_order_no,
                'dispute_information' => $request->buyer_delivery_information,
                'product_link' => route('product.show', $buyer->slug),
                "body" =>  $email_template->email_body,
            );
            $arrayBuyer['subject'] =  $email_template->email_subject."( PO" . $buyer->purchase_order_no . " ).";
            $buyerEmailController->deliveryDisputeMailBuyer($arrayBuyer);

            $record->update();
            return redirect()->route('purchaseorders.index')->with('message', 'success|Delivery dispute for puchase order successfully');
        }
    }

    /**
     * view comments page
     *
     * @param int $id -> purchase orders table id
     */
    public function comments($id)
    {
        $page = "Add Comment";
        if (@$id) {
            $record = Purchaseorders::where('id', $id)->first();
            if (@$record) {
                $id = $record->id;
                $comments = Comments::where('purchase_id', $record->id)->orderBy('comments.id', 'desc')->get();
                $url = route('purchaseorders.getcomments', $id);
                return view('frontend.purchaseorders.comments', compact('record', 'comments', 'url', 'page'));
            }
        }
    }

    /**
     * response ajax data comment
     *
     * @param int $id -> purchase orders table id
     */
    public function getcomments($id)
    {
        if (@$id) {
            $record = Purchaseorders::where('id', $id)->first();
            if (@$record) {
                $comments = DB::table('comments')
                    ->Join('users', 'users.id', '=', 'comments.writer')
                    ->where('comments.purchase_id', $record->id)
                    ->orderBy('comments.id', 'desc')
                    ->select('comments.description', 'comments.sign_date', 'users.name as username')
                    ->get();

                return response()->json($comments);
            }
        }
    }

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
