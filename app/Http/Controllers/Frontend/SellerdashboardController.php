<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Product;
use App\Quotes;
use App\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellerdashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'Dashboard';
        $userid = auth()->id();
        $products = Product::where('user_id', $userid)->get();
        if (auth()->user()->hasRole('buyer')) {
            $requests = Requests::where('sender', $userid)->get();
        }
        if (auth()->user()->hasRole('seller')) {
//            $query = "JSON_CONTAINS(receiver, " . $userid . ", '$')=1";
            //            $requests = Requests::whereRaw($query)->where('status', 2)->get();
            $word = '[' . $userid . ']';
            $requests = DB::table('requests')
                ->where('receiver', 'like', '%' . $word . '%')
                ->get();

            //Purchase Orders

            $purchases = DB::table('quotes')
                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                ->where('quotes.sender', $userid)
            // ->where('purchase_orders.payment_status', '!=', 3)
                ->whereNull('quotes.deleted_at')
                ->select('quotes.*', 'purchase_orders.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id')
                ->get();

            // Completed Orders

            $completed = DB::table('quotes')
                ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
                ->Join('requests', 'quotes.request_id', '=', 'requests.id')
                ->Join('users', 'users.id', '=', 'requests.sender')
                ->where('quotes.sender', $userid)
                ->where('purchase_orders.payment_status', 3)
                ->whereNull('quotes.deleted_at')
                ->select('quotes.*', 'purchase_orders.sign_date as sign_date', 'quotes.status as status', 'quotes.id as main_id', 'purchase_orders.payment_status', 'purchase_orders.payment_information', 'purchase_orders.id as p_id', 'users.name as username', 'users.company_name', 'requests.sender as buyer_id')
                ->get();

            // Archieved Orders

            $archieved = DB::table('quotes')
                ->Join('achieved_quotes', 'achieved_quotes.request_id', '=', 'quotes.request_id')
                ->leftJoin('requests', 'requests.id', '=', 'quotes.request_id')
                ->where('requests.receiver', $userid)
                ->whereNull('quotes.deleted_at')
                ->select('quotes.*', 'requests.*', 'requests.sign_date as re_sign_date', 'achieved_quotes.sign_date as sign_date', 'requests.status as re_status', 'quotes.status as status', 'quotes.id as main_id')
                ->get();
        }

        $quotes = Quotes::where('sender', $userid)->get();

        $totalProduct = count($products);
        $totalRequest = count($requests);
        $totalQuotes = count($quotes);
        $totalPurchases = count($purchases);
        $totalCompleted = count($completed);
        $totalArchieved = count($archieved);

        return view('frontend.dashboard.index', compact('page', 'totalProduct', 'totalRequest', 'totalQuotes', 'totalPurchases', 'totalCompleted', 'totalArchieved'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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