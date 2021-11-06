<?php

namespace App\Http\Controllers\Admin;

use App\Adminlogs;
use App\Http\Controllers\Controller;
use App\Quotes;
use App\User;
use Illuminate\Http\Request;

class QuotesController extends Controller
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
        $quotes = Quotes::Join('requests', 'requests.id', '=', 'quotes.request_id')
            ->Join('users', 'users.id', '=', 'requests.sender')
            ->Join('products', 'products.id', '=', 'requests.product_id')
            ->Join('currencies', 'currencies.id', '=', 'products.currency_id')
            ->select('quotes.*', 'requests.sender as buyer', 'currencies.name as currency_name', 'requests.receiver as seller', 'users.company_name as buyer_company_name', 'requests.receiver as seller')
            ->get();

        // $buyer_detail = User::where('id',)->first();
        // echo '<pre>';
        // print_r($quotes);exit;

        return view('admin.quotes.index', compact('quotes'));
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
     * @param  \App\Quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (@$id) {
            $record = Quotes::where('id', $id)->get();

            if (@$record) {
                $name = $record[0]->product_name;
                if ($record[0]->status == null || $record[0]->status == 1) {
                    $record[0]->status = 2;
                    $record[0]->update();

                    return redirect()->route('quotes.index')->with('flash', 'The Quote: "' . $name . '" has been approved.');
                } else {
                    $record[0]->status = 1;
                    $record[0]->update();

                    return redirect()->route('quotes.index')->with('flash', 'The Quote: "' . $name . '" has been reviewed.');
                }
            } else {
                return back();
            }

        } else {
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (@$id) {
            $res = Quotes::where('id', $id)->first();
            $record = Quotes::where('id', $id)->delete();

            $data = [];
            $data['title'] = 'Deleted';
            $data['description'] = 'Quote Name: ' . $res->product_name;
            $add_logs = Adminlogs::Addlog($data);

            return redirect()->route('quotes.index')->with('flash', 'Quote has successfully deleted');
        } else {
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotes $quotes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotes $quotes)
    {
        //
    }

    public function view($id)
    {
        $records = Quotes::where('quotes.id', $id)
            ->Join('requests', 'requests.id', '=', 'quotes.request_id')
            ->Join('products', 'products.id', '=', 'requests.product_id')
            ->Join('currencies', 'currencies.id', '=', 'products.currency_id')
            ->Join('unit', 'unit.id', '=', 'products.unit')
            ->select('quotes.*', 'requests.id as requests_id', 'requests.sign_date as request_date', 'requests.sender as requestsender', 'currencies.name as currency_name', 'unit.name as unitname', 'products.price_to as price_to', 'products.price_from as price_from', 'products.price_show as price_show', 'products.price_fixed as price_fixed', 'products.MOQ as MOQ', 'products.name as product_name', 'products.image_url as product_image_url', 'products.slug as product_slug')
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
        return view('admin.quotes.view', compact('records', 'buyer_detail', 'seller_detail'));
    }
}