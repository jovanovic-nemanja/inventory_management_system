<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Product;
use App\Requestcallback;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\EmailTemplates;

class RequestcallbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = auth()->id();
        if (auth()->user()->hasRole('buyer')) {
            $page = "My Sent Call Back Request";
            $requestcallback = Requestcallback::where('customer_id', $userid)->get();
        }

        if (auth()->user()->hasRole('seller')) {
            $page = "My Received Call Back Request";
            $requestcallback = DB::table('requestcallback')
                ->Join('products', 'products.id', '=', 'requestcallback.product_id')
                ->Join('users', 'users.id', '=', 'products.user_id')
                ->where('products.user_id', '=', $userid)
                ->select('requestcallback.*')
                ->get();
        }

        $products = Product::all();

        return view('frontend.requestcallback.index', compact('products', 'requestcallback', 'page'));
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
        $this->validate(request(), [
            'name' => 'required',
            'email_add' => 'required',
            'mobile' => 'required',
        ]);

        $userid = auth()->id();
        $user = User::where('id', $userid)->first();
        $username = $user->name;
        $useremail = $user->email;
        $product = Product::where('id', $request->product_id)->first();
        $product_name = $product->name;

        $rfq = Requestcallback::create([
            'name' => request('name'),
            'email_add' => request('email_add'),
            'mobile' => request('mobile'),
            'customer_id' => auth()->id(),
            'product_id' => request('product_id'),
            'prod_name' => $product_name,
            'sign_date' => date('y-m-d h:i:s'),
        ]);

        return back()->with('flash', 'Request Call Back has been successfully submitted.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCallback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email_add' => 'required',
            'mobile' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages();

            //pass validator errors as errors object for ajax response
            return response()->json(['status' => "failed", 'color' => 'red', 'msg' => $messages->first()]);
        }

        $userid = auth()->id() ? auth()->id() : 0;

        if ($request->product_id != '' && $request->product_id != 0) {

            $product = Product::where('products.id', $request->product_id)
                ->Join('users', 'users.id', '=', 'products.user_id')
                ->Join('currencies', 'currencies.id', '=', 'products.currency_id')
                ->Join('categories', 'categories.id', '=', 'products.category_id')
                ->Join('unit', 'unit.id', '=', 'products.unit')
                ->select('unit.name as unitname', 'categories.name as categoryname', 'products.id as id', 'products.MOQ as MOQ', 'products.name as product_name', 'products.slug as slug', 'products.image_url as image_url', 'users.name as username', 'users.email as useremail', 'users.company_name as company_name', 'currencies.name as currency_name')
                ->first();

            $productSeller = Product::where('products.id', $request->product_id)
                ->Join('currencies', 'currencies.id', '=', 'products.currency_id')
                ->Join('categories', 'categories.id', '=', 'products.category_id')
                ->Join('unit', 'unit.id', '=', 'products.unit')
                ->select('unit.name as unitname', 'categories.name as categoryname', 'products.id as id', 'products.MOQ as MOQ', 'products.name as product_name', 'products.slug as slug', 'products.image_url as image_url', 'currencies.name as currency_name')
                ->first();

            $reqUser = User::where('email', $request->email_add)->first();
            $product_id = $product->id;
            $product_name = $product->product_name;

            // Buyer Mail

            $arrayBuyer = [];
            $arrayBuyer['username'] = $reqUser->name;
            $arrayBuyer['receiver_address'] = $reqUser->email;
            $email_template =EmailTemplates:: where('email_type','rq_callback_buyer')->first();
            $arrayBuyer['data'] = array(
                'name' => $arrayBuyer['username'],
                'product_name' => $product->product_name,
                'product_image' => 'https://mambodubai.com/uploads/' . $product->image_url,
                'categoryname' => $product->categoryname,
                'company_name' => $product->company_name,
                'unitname' => $product->unitname,
                'MOQ' => $product->MOQ,
                'product_link' => route('product.show', $product->slug),
                "body" => $email_template->email_body,
            );
            $arrayBuyer['subject'] = $email_template->email_subject;

            $buyerEmailController = new EmailsController;
            $buyerEmailController->requestCallbackBuyer($arrayBuyer);

            // Seller Mail

            $arraySeller = [];
            $arraySeller['username'] = $product->username;
            $arraySeller['receiver_address'] = $product->useremail;

            $email_template =EmailTemplates:: where('email_type','rq_callback_seller')->first();
            $arraySeller['data'] = array(
                'name' => $arraySeller['username'],
                'product_name' => $productSeller->product_name,
                'product_image' => 'https://mambodubai.com/uploads/' . $productSeller->image_url,
                'categoryname' => $productSeller->categoryname,
                'company_name' => $reqUser->company_name,
                'mobile' => request('mobile'),
                'unitname' => $productSeller->unitname,
                'MOQ' => $productSeller->MOQ,
                'product_link' => route('product.show', $productSeller->slug),
                "body" => $email_template->email_body,
            );
            $arraySeller['subject'] = $email_template->email_subject;
            $sellerEmailController = new EmailsController;
            $sellerEmailController->requestCallbackSeller($arraySeller);

        } else {
            $product_id = 0;
            $product_name = '';
            // Buyer Mail
            $reqUser = User::where('email', $request->email_add)->first();
            $sellerUser = User::where('id', $request->customer_id)->first();

            $arrayBuyer = [];
            $arrayBuyer['username'] = $reqUser->name;
            $arrayBuyer['receiver_address'] = $reqUser->email;
            $email_template =EmailTemplates:: where('email_type','rq_callback_buyer')->first();
            $arrayBuyer['data'] = array(
                'name' => $arrayBuyer['username'],
                'company_name' => $sellerUser->company_name,
                "body" => $email_template->email_body,
            );
            $arrayBuyer['subject'] = $email_template->email_subject;
            $buyerEmailController = new EmailsController;
            $buyerEmailController->requestCallbackNoProductBuyer($arrayBuyer);

            // Seller Mail

            $arraySeller = [];
            $arraySeller['username'] = $sellerUser->name;
            $arraySeller['receiver_address'] = $sellerUser->email;
            $email_template =EmailTemplates:: where('email_type','rq_callback_seller')->first();
            $arraySeller['data'] = array(
                'name' => $arraySeller['username'],
                'company_name' => $reqUser->company_name,
                'mobile' => request('mobile'),
                "body" => $email_template->email_body,
            );
            $arraySeller['subject'] = $email_template->email_subject;
            $sellerEmailController = new EmailsController;
            $sellerEmailController->requestCallbackNoProductSeller($arraySeller);

        }

        $rfq = Requestcallback::create([
            'name' => request('name'),
            'email_add' => request('email_add'),
            'mobile' => request('mobile'),
            'message' => request('message'),
            'customer_id' => $userid,
            'product_id' => $product_id,
            'prod_name' => $product_name,
            'sign_date' => date('y-m-d h:i:s'),
        ]);

        return response()->json(['status' => 'success', 'color' => '#476B91', 'msg' => 'Request Call Back has been successfully submitted.']);
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
        $ss = Requestcallback::where('id', $id)->delete();

        return redirect()->route('requestcallback.index')->with('flash', 'Request Call Back has successfully deleted.');
    }
}
