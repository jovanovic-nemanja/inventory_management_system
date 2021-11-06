<?php

namespace App\Http\Controllers\Admin;

use App\Adminlogs;
use App\Http\Controllers\Controller;
use App\Product;
use App\Requests;
use App\User;
use App\Verify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagesellersController extends Controller
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
        $categories = User::all();
        return view('admin.managesellers.index', compact('categories'));
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
     * Display the verify page resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verify($id)
    {
        return view('admin.managesellers.verify', compact('id'));
    }

    /**
     * verify status change : From Not verified to Verified
     * @param $request
     * @since 2020-12-14
     * @author Nemanja
     * @return \Illuminate\Http\Response
     */
    public function submitVerify(Request $request)
    {
        $this->validate(request(), [
            'document' => 'required',
            'comment' => 'required',
            'userid' => 'required',
        ]);

        $user = User::where('id', $request->userid)->first();
        if (@$user) {
            $user->verified = 2;
            if ($user->update()) {
                $verify = Verify::create([
                    'document' => $request->document,
                    'comment' => $request->comment,
                    'userid' => $request->userid,
                    'sign_date' => date('Y-m-d h:i:s'),
                ]);

                Verify::upload_document($verify->id);
            }
        }

        return redirect()->route('managesellers.index');
    }

    /**
     * Remove the verified data and change the status from verified to not verified.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function notverify($id)
    {
        $seller = User::where('id', $id)->first();
        if (@$seller) {
            $seller->verified = 1;
            if ($seller->update()) {
                Verify::where('userid', $seller->id)->delete();
            }
        }

        return redirect()->route('managesellers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (@$id) {
            $records = User::where('id', $id)->get();
            if (@$records) {
                $records[0]['block'] = 0;
                $records[0]->update();

                $data = [];
                $data['title'] = 'Un-Blocked';
                $data['description'] = 'Seller Name: ' . $records[0]['name'];
                $add_logs = Adminlogs::Addlog($data);

                return redirect()->route('managesellers.index')->with('message', 'success|Seller has been successfully changed the status blocked.');
            }
        } else {
            return redirect()->route('managesellers.index');
        }
    }

    public function details($id)
    {
        $user_detail = DB::table('users')->where('users.id', $id)
            ->Join('countries', 'countries.id', '=', 'users.country')
            ->Join('currencies', 'currencies.id', '=', 'users.currency')
            ->select('users.*', 'countries.name as country_name', 'currencies.name as currency_name')
            ->first();

        $all_product = Product::where('user_id', $id)->where('status', '2')->get();

        $all_request = Requests::where('requests.receiver', '[' . $id . ']')
            ->Join('products', 'products.id', '=', 'requests.product_id')
            ->Join('currencies', 'currencies.id', '=', 'products.currency_id')
            ->Join('unit', 'unit.id', '=', 'requests.unit')
            ->select('requests.*', 'unit.name as unit_name', 'products.name as product_name', 'currencies.name as currency_name')
            ->get();

        $all_quote = Requests::where('requests.receiver', '[' . $id . ']')
            ->Join('quotes', 'quotes.request_id', '=', 'requests.id')
            ->Join('products', 'products.id', '=', 'requests.product_id')
            ->Join('users', 'users.id', '=', 'requests.sender')
            ->Join('currencies', 'currencies.id', '=', 'products.currency_id')
            ->Join('unit', 'unit.id', '=', 'requests.unit')
            ->select('quotes.*', 'unit.name as unit_name', 'users.company_name as buyer_name', 'products.name as product_name', 'currencies.name as currency_name')
            ->get();

        $all_purchase = Requests::where('requests.receiver', '[' . $id . ']')
            ->Join('quotes', 'quotes.request_id', '=', 'requests.id')
            ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
            ->Join('products', 'products.id', '=', 'requests.product_id')
            ->Join('users', 'users.id', '=', 'requests.sender')
            ->Join('currencies', 'currencies.id', '=', 'products.currency_id')
            ->Join('unit', 'unit.id', '=', 'requests.unit')
            ->select('purchase_orders.*', 'quotes.total_price as total_price', 'unit.name as unit_name', 'users.company_name as buyer_name', 'products.name as product_name', 'currencies.name as currency_name')
            ->get();

        $all_complete = Requests::where('requests.receiver', '[' . $id . ']')
            ->Join('quotes', 'quotes.request_id', '=', 'requests.id')
            ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
            ->Join('products', 'products.id', '=', 'requests.product_id')
            ->Join('users', 'users.id', '=', 'requests.sender')
            ->Join('currencies', 'currencies.id', '=', 'products.currency_id')
            ->Join('unit', 'unit.id', '=', 'requests.unit')
            ->where('purchase_orders.payment_status', 3)
            ->where('purchase_orders.delivery_status', 3)
            ->select('purchase_orders.*', 'quotes.total_price as total_price', 'unit.name as unit_name', 'users.company_name as buyer_name', 'products.name as product_name', 'currencies.name as currency_name')
            ->get();

        $all_archived = Requests::where('requests.receiver', '[' . $id . ']')

            ->Join('quotes', 'quotes.request_id', '=', 'requests.id')
            ->Join('purchase_orders', 'purchase_orders.request_id', '=', 'quotes.id')
            ->Join('achieved_quotes', 'achieved_quotes.request_id', '=', 'quotes.id')
            ->Join('products', 'products.id', '=', 'requests.product_id')
            ->Join('users', 'users.id', '=', 'requests.sender')
            ->Join('currencies', 'currencies.id', '=', 'products.currency_id')
            ->Join('unit', 'unit.id', '=', 'requests.unit')
            ->where('purchase_orders.payment_status', 3)
            ->where('purchase_orders.delivery_status', 3)
            ->select('purchase_orders.*', 'quotes.total_price as total_price', 'unit.name as unit_name', 'users.company_name as buyer_name', 'products.name as product_name', 'currencies.name as currency_name')
            ->get();

        $all_callback = Product::Join('requestcallback', 'requestcallback.product_id', '=', 'products.id')
            ->select('requestcallback.*', 'products.name as product_name')
            ->where('products.user_id', $id)
            ->get();

        return view('admin.managesellers.details', compact('user_detail', 'all_product', 'all_request', 'all_quote', 'all_purchase', 'all_complete', 'all_archived', 'all_callback'));

    }

    /**
     * User Block feature.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (@$id) {
            $records = User::where('id', $id)->get();
            if (@$records) {
                $records[0]['block'] = 1;
                $records[0]->update();

                $data = [];
                $data['title'] = 'Blocked';
                $data['description'] = 'Seller Name: ' . $records[0]['name'];
                $add_logs = Adminlogs::Addlog($data);

                return redirect()->route('managesellers.index')->with('message', 'success|Seller has been successfully changed the status active.');
            }
        } else {
            return redirect()->route('managesellers.index');
        }
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
