<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use App\Quotes;
use App\Product;
use App\Reviews;
use App\Requests;
use App\Comments;
use App\Purchaseorders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

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
                ->Join('users', 'users.id', '=', 'quotes.sender')
                ->where('quotes.sender', $userid)
                //                    ->where('purchase_orders.delivery_status',"!=", 3)
                //                    ->whereNull('quotes.deleted_at')
                ->select('quotes.*', 'users.currency as currency_name', 'purchase_orders.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.delivery_status', 'purchase_orders.buyer_payment_status', 'purchase_orders.buyer_delivery_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id')
                ->get();
        }
        if (auth()->user()->hasRole('buyer')) {
            $quotes = DB::table('quotes')
                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                ->Join('requests', 'quotes.request_id', '=', 'requests.id')
                ->Join('users', 'users.id', '=', 'quotes.sender')
                //                    ->where('purchase_orders.payment_status', '!=', 3)
                //                    ->where('purchase_orders.buyer_delivery_status',"!=", 3)
                //                    ->where('quotes.status', 2)
                ->where('requests.sender', $userid)
                //                    ->whereNull('quotes.deleted_at')
                ->select('quotes.*', 'users.currency as currency_name', 'quotes.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.buyer_payment_status', 'purchase_orders.buyer_delivery_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id', 'users.name as username', 'users.company_name')
                ->get();
        }
                // echo '<pre>';        print_r($quotes);exit;

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

        //echo '<pre>'; print_r($quotes); exit;

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
            //         if (auth()->user()->hasRole('buyer')) {
            $requests = Quotes::where('id', $record->request_id)->get();
            //            echo '<pre>';        print_r($requests);exit;
            if ($requests[0]->alternative_product == '' || $requests[0]->alternative_product == 0) {
                /* $quotes = DB::table('quotes')
                  ->leftJoin('products', 'products.id', '=', $requests[0]->alternative_product)
                  ->leftJoin('unit', 'unit.id', '=', 'products.unit')
                  ->where('quotes.id', $record->request_id)
                  ->select( 'quotes.*','products.*','unit.name as unitname')
                  ->get(); */

                $quotes = DB::table('quotes')
                    ->leftJoin('requests', 'requests.id', 'quotes.request_id')
                    ->leftJoin('products', 'products.id', '=', 'requests.id')
                    ->leftJoin('currencies', 'currencies.id', '=', 'products.currency_id')
                    ->leftJoin('unit', 'unit.id', '=', 'products.unit')
                    ->where('quotes.id', $record->request_id)
                    ->select('quotes.*', 'products.*', 'unit.name as unitname', 'currencies.name as currency_name')
                    ->get();
            } else {
                $quotes = DB::table('quotes')
                    ->leftJoin('requests', 'requests.id', 'quotes.request_id')
                    ->leftJoin('products', 'products.id', '=', 'requests.id')
                    ->leftJoin('currencies', 'currencies.id', '=', 'products.currency_id')
                    ->leftJoin('unit', 'unit.id', '=', 'products.unit')
                    ->where('quotes.id', $record->request_id)
                    ->select('quotes.*', 'products.*', 'unit.name as unitname', 'currencies.name as currency_name')
                    ->get();
            }
            //        }
            //        if (auth()->user()->hasRole('seller')) {
            //            $word = '['.$userid.']';
            //            $requests = DB::table('requests')
            //                ->where('receiver', 'like','%' . $word . '%')
            //                ->get();
            //        }
            //        echo '<pre>';        print_r($record);exit;

            return view('frontend.purchaseorders.paymentchange', compact('record', 'quotes', 'page'));
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
            // echo '<pre>'; print_r($receiver);exit;
            $receiver = str_replace(']', '', str_replace('[', '', $getid[0]->receiver));
            $seller_detail = User::where('id', $receiver)->get();
            $buyer_detail = User::where('id', $getid[0]->sender)->get();
            if ($requests[0]->alternative_product == '' || $requests[0]->alternative_product == 0) {
                $quotes = DB::table('quotes')
                    ->leftJoin('requests', 'requests.id', 'quotes.request_id')
                    ->leftJoin('products', 'products.id', '=', 'requests.id')
                    ->leftJoin('currencies', 'currencies.id', '=', 'products.currency_id')
                    ->leftJoin('unit', 'unit.id', '=', 'products.unit')
                    ->where('quotes.id', $record->request_id)
                    ->select('quotes.*', 'products.*', 'unit.name as unitname', 'currencies.name as currency_name')
                    ->get();
            } else {
                $quotes = DB::table('quotes')
                    ->leftJoin('requests', 'requests.id', 'quotes.request_id')
                    ->leftJoin('products', 'products.id', '=', 'requests.id')
                    ->leftJoin('currencies', 'currencies.id', '=', 'products.currency_id')
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
                    ->leftJoin('products', 'products.id', '=', 'requests.id')
                    ->leftJoin('currencies', 'currencies.id', '=', 'products.currency_id')
                    ->leftJoin('unit', 'unit.id', '=', 'products.unit')
                    ->where('quotes.id', $record->request_id)
                    ->select('quotes.*', 'products.*', 'unit.name as unitname', 'currencies.name as currency_name')
                    ->get();
            } else {
                $quotes = DB::table('quotes')
                    ->leftJoin('requests', 'requests.id', 'quotes.request_id')
                    ->leftJoin('products', 'products.id', '=', 'requests.id')
                    ->leftJoin('currencies', 'currencies.id', '=', 'products.currency_id')
                    ->leftJoin('unit', 'unit.id', '=', 'products.unit')
                    ->where('quotes.id', $record->request_id)
                    ->select('quotes.*', 'products.*', 'unit.name as unitname', 'currencies.name as currency_name')
                    ->get();
            }
            //  echo '<pre>'; print_r($quotes);exit;
            return view('frontend.purchaseorders.deliverychange', compact('record', 'quotes', 'page'));
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
                    //                    $record->payment_status = 3;
                    break;
                default:
                    # code...
                    break;
            }

            $record->update();
            return redirect()->route('purchaseorders.index');
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
                    # code...
                    break;
            }

            $record->update();
            return redirect()->route('purchaseorders.index');
        } elseif (@$request->dispute_id) {
            $id = $request->dispute_id;
            $record = Purchaseorders::where('id', $id)->first();

            $record->payment_information = $request->payment_information;
            $record->payment_status = 0;
            $record->buyer_payment_status = 0;
            $record->payment_updated_at = date('Y-m-d h:i:s');

            $record->update();
            return redirect()->route('purchaseorders.index');
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
                    //                    $record->buyer_delivery_status = 3;
                    break;
                default:
                    # code...
                    break;
            }

            $record->update();
            return redirect()->route('purchaseorders.index');
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
                    # code...
                    break;
            }

            $record->update();
            return redirect()->route('purchaseorders.index');
        } elseif (@$request->dispute_id) {
            $id = $request->dispute_id;
            $record = Purchaseorders::where('id', $id)->first();

            $record->buyer_delivery_information = $request->buyer_delivery_information;
            $record->buyer_delivery_status = 0;
            $record->delivery_status = 0;

            $record->update();
            return redirect()->route('purchaseorders.index');
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
