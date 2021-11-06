<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Files;
use App\GeneralRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\EmailsController;
use App\Product;
use App\Requests;
use App\Unit;
use App\User;
use App\EmailTemplates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
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
        $page = 'Request';
        $userid = auth()->id();
        if (auth()->user()->hasRole('buyer')) {
            $requests = Requests::where('sender', $userid)->orderBy('id', 'DESC')->get();
        }
        if (auth()->user()->hasRole('seller')) {
            //            $query = "JSON_CONTAINS('receiver', " . $userid . ", '$')=1";
            //            $requests = Requests::whereRaw($query)->where('status', 2)->get();
            //             $requests = Requests::whereJsonContains('receiver', $userid)->where('status', 2)->get();
            $word = '[' . $userid . ']';
            //            $requests = DB::table('requests') ->where('receiver', 'like','%' . $word . '%')->get();
            $requests = Requests::where('receiver', 'like', '%' . $word . '%')->orderBy('id', 'DESC')->get();
            //            echo '<pre>'; print_r($requests); exit;
        }

        $products = Product::all();

        return view('frontend.request.index', compact('products', 'requests', 'page'));
    }
    public function generalrequest()
    {
        $page = 'General Request';
        $userid = auth()->id();
        $requests = Requests::where('sender', $userid)->where('receiver', '')->orderBy('id', 'DESC')->get();

        return view('frontend.request.general', compact('requests', 'page'));
    }
    public function addgeneralrequest()
    {
        $page = ' Add General Request';
        $userid = auth()->id();
        $units = Unit::all();

        return view('frontend.request.addgeneral', compact('units', 'page'));
    }

    /**
     * Show the form for sending a new request.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($product_id = null)
    {
        if (auth()->user()->hasRole('buyer')) {
            if (@$product_id) { //when buyer click the product directly
                $product = Product::where('id', $product_id)->get();
            } else { //when buyer didn't click any product.
                $product = [];
            }

            return view('frontend.request.create', compact('product'));
        }

        if (auth()->user()->hasRole('seller')) {
            return redirect()->route('sellerdashboard.index');
        }
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard.index');
        }
        if (auth()->user()->hasRole('manager')) {
            return redirect()->route('managesellers.index');
        }
    }

    /**
     * Show the form for editing the sent request.
     *
     * @return \Illuminate\Http\Response
     */
    public function change($request_id = null)
    {
        $page = "Request Change";
        if (@$request_id) { //when buyer click the product directly
            $request = Requests::where('id', $request_id)->get();
            $product_id = $request[0]->product_id;
            if (@$product_id) {
                $product = Product::where('id', $product_id)->get();
            } else {
                $product = null;
            }
        }
        //echo '<pre>';print_r($product);exit;
        return view('frontend.request.change', compact('request', 'product', 'page'));
    }

    /**
     * Show the form for viewing the sent request.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($request_id = null)
    {
        $page = 'Request';
        if (@$request_id) { //when buyer click the product directly
            $request = Requests::where('id', $request_id)->get();
            $product_id = $request[0]->product_id;
            $unit_id = $request[0]->unit;
            $unit = Unit::where('id', $unit_id)->first();
            $unit_name = $unit->name;
            if (@$product_id) {
                $product = Product::where('id', $product_id)->first();
            } else {
                $product = null;
            }
        }

        // echo '<pre>'; print_r($unit);exit;
        //        echo '<pre>'; print_r($request[0]['id']);exit;
        return view('frontend.request.view', compact('request', 'product', 'unit_name', 'page'));
    }

    public function generalstore(Request $request)
    {

        $this->validate(request(), [
            'product_name' => 'required',
            'req_quantity' => 'required',
        ]);
        $userid = auth()->id();
        $user = User::where('id', $userid)->first();
        $username = $user->name;
        $useremail = $user->email;

        $rfq = GeneralRequest::create([
            'product_name' => request('product_name'),
            'req_quantity' => request('req_quantity'),
            'additional_information' => request('description'),
            'sender' => auth()->id(),
            'volume' => 0,
            'unit' => request('unit'),
            'receiver' => '',
            'status' => 1,
            'sign_date' => date('y-m-d h:i:s'),
        ]);

        $files = Files::upload_file_rfq($rfq['id']);
        $product_name = request('product_name');
        if (@$files) {
            $host = request()->getHost();
            $file_link = "https://" . $host . "/uploads/" . $files->name;
        } else {
            $file_link = "";
        }

        $record = GeneralRequest::where('id', $rfq['id'])->get();

        $email_template =EmailTemplates:: where('email_type','gen_quote_buyer')->first();
        //To buyer

        $controller = new EmailsController;
        $array = [];
        $array['username'] = $username;
        $array['receiver_address'] = $useremail;
        $array['data'] = array(
            'name' => $array['username'],
            "body" => $email_template->email_body,
            "company_name" => '',
            "product_link" => $product_name,
            "file_link" => $file_link,
            "rfq" => $record[0],
        );
        $array['subject'] = $email_template->email_subject;
        $array['sender_address'] = "no-reply@mambodubai.com";
        $controller->sendapprovedRFQ($array);

        //To seller
        $email_template =EmailTemplates:: where('email_type','gen_quote_seller')->first();

        $controller = new EmailsController;
        $array = [];
        $array['username'] = $username;
        $array['receiver_address'] = 'marketing@mambodubai.com';
        $array['data'] = array(
            'name' => 'Marketing MamboDubai',
            "body" =>  $email_template->email_body,
            "customer_name" => $username,
            "product_link" => $product_name,
            "file_link" => $file_link,
            "rfq" => $record[0],
        );
        $array['subject'] = $email_template->email_subject;
        $array['sender_address'] = "no-reply@mambodubai.com";

        $controller->approveGeneralRequest($array);

        return redirect()->route('request.index')->with('message', 'success|General Request has been successfully submitted.');

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
            'product_name' => 'required',
            'req_quantity' => 'required',
        ]);
        $userid = auth()->id();
        $user = User::where('id', $userid)->first();
        $username = $user->name;
        $useremail = $user->email;

        if (request('type') == -1) { //when buyer didn't choose any product and send the rfq.
            $rfq = Requests::create([
                'product_name' => request('product_name'),
                'req_quantity' => request('req_quantity'),
                'additional_information' => request('description'),
                'sender' => auth()->id(),
                'volume' => 0,
                'unit' => request('unit'),
                'port_of_destination' => 'blank',
                'receiver' => '',
                'status' => 1,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            $files = Files::upload_file_rfq($rfq['id']);
        } else { //when buyer choose any product and send the rfq.
            $product = Product::where('id', request('product_id'))->get();

            if (@$product) {
                $receiver = $product[0]->user_id;
                $product_id = $product[0]->id;
            }

            $rfq = Requests::create([
                'product_name' => request('product_name'),
                'req_quantity' => request('req_quantity'),
                'additional_information' => request('description'),
                'sender' => auth()->id(),
                'volume' => request('volume'),
                'product_id' => $product_id,
                'unit' => request('unit'),
                'port_of_destination' => request('port_of_destination'),
                'receiver' => '[' . $receiver . ']',
                'status' => 1,
                'sign_date' => date('y-m-d h:i:s'),
            ]);

            $files = Files::upload_file_rfq($rfq['id']);
        }

        if (@$rfq['product_id']) {
            $product = Product::where('id', $rfq['product_id'])->first();
            $user = User::where('id', $product->user_id)->first();
            $catname = Category::where('id', $product->category_id)->first();
            $company_name = $user->company_name;
            $customer_name = $user->name;
            $host = request()->getHost();
            $categoryname = $catname->name;
            $product_image = 'https://' . $host . '/uploads/' . $product->image_url;
            $product_link = route('product.show', $product->slug);
        } else {
            $product = [];
            $company_name = "";
            $customer_name = '';
            $product_image = '';
            $categoryname = '';
            $product_link = route('product.index');
        }

        if (@$files) {
            $host = request()->getHost();
            $file_link = "https://" . $host . "/uploads/" . $files->name;
        } else {
            $file_link = "";
        }

        $record = Requests::where('id', $rfq['id'])->get();
        //To buyer
        $userid = $record[0]->sender;
        $unitname = Unit::where('id', $record[0]->unit)->first();
        $user = User::where('id', $userid)->first();
        $username = $user->name;
        $useremail = $user->email;
        $email_template =EmailTemplates:: where('email_type','req_quote_buyer')->first();

        $controller = new EmailsController;
        $array = [];
        $array['username'] = ucfirst(strtolower($username));
        $array['unitname'] = $unitname->name;
        $array['receiver_address'] = $useremail;
        $array['data'] = array(
            'name' => $array['username'],
            'body' => $email_template->email_body,
            'unitname' => $array['unitname'],
            "company_name" => $company_name,
            "product_link" => $product_link,
            "categoryname" => $categoryname,
            "product_image" => $product_image,
            "file_link" => $file_link,
            "rfq" => $record[0]);
        $array['subject'] =  $email_template->email_subject;
        $array['sender_address'] = "no-reply@mambodubai.com";
        $controller->sendapprovedRFQ($array);

        //To seller
        $arrs = $record[0]->receiver;
        if (@$arrs) {
            $diff = str_replace('[', '', $arrs);
            $diff1 = str_replace(']', '', $diff);
            $arr = [];
            $diff_arrays = explode(',', $diff1);

            foreach ($diff_arrays as $key => $value) {
                $userid = $value;
                $user = User::where('id', $userid)->first();
                $customer_id = auth()->id();
                $customer_detail = User::where('id', $customer_id)->first();
                $email_template =EmailTemplates:: where('email_type','req_quote_seller')->first();
                $username = $user->name;
                $useremail = $user->email;
                $controller = new EmailsController;
                $array = [];
                $array['username'] = ucfirst(strtolower($username));
                $array['receiver_address'] = $useremail;
                $array['data'] = array(
                    'name' => $array['username'],
                    'body' => $email_template->email_body,
                    'unitname' => $unitname->name,
                    "customer_name" => $customer_detail->company_name,
                    "product_link" => $product_link,
                    "categoryname" => $categoryname,
                    "product_image" => $product_image,
                    "file_link" => $file_link,
                    "rfq" => $record[0]);
                $array['subject'] = $email_template->email_subject;
                $array['sender_address'] = "no-reply@mambodubai.com";
                $controller->approveRequest($array);
            }

        } else {
            return redirect()->route('request.index')->with('message', 'success|General Request has been successfully submitted.');

        }

        // $controller->sendRequest($array);
        //            return redirect()->route('request.index')->with('flash', 'Request has been successfully added.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requests  $quotation
     * @return \Illuminate\Http\Response
     */
    public function show(Requests $requests)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requests  $quotation
     * @return \Illuminate\Http\Response
     */
    public function edit(Requests $requests)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requests  $quotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //        echo '<pre>'; print_r($request->all());exit;
        $this->validate(request(), [
            'product_name' => 'required',
            'req_quantity' => 'required',
            'volume' => 'required',
            'port_of_destination' => 'required',
            'description' => 'required',
        ]);

        if (@request('id')) {
            $records = Requests::where('id', request('id'))->get();
        }

        $records[0]->additional_information = request('description');
        $records[0]->req_quantity = request('req_quantity');
        $records[0]->volume = request('volume');
        $records[0]->unit = request('unit');
        $records[0]->port_of_destination = request('port_of_destination');
        $records[0]->update();

        return redirect()->route('request.index')->with('message', 'success|Request has been successfully changed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requests  $quotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requests $requests)
    {
        $record = Requests::where('id', request('id'))->get();
        if (@$record) {
            $record[0]->status = 3;
            $record[0]->update();
        }

        return back();
    }
}
