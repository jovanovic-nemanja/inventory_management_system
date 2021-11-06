<?php

namespace App\Http\Controllers\Frontend;

use App\Achievedquotes;
use App\Category;
use App\Currency;
use App\Http\Controllers\Controller;
use App\Image;
use App\Product;
use App\Purchaseorders;
use App\Quotes;
use App\Requests;
use App\Unit;
use App\User;
use App\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\EmailTemplates;

class QuotesController extends Controller
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
        $page = "Quotes";
        $userid = auth()->id();
        if (auth()->user()->hasRole('seller')) {
            $word = '[' . $userid . ']';

            $quotes = DB::table('quotes')
                ->leftJoin('requests', 'requests.id', '=', 'quotes.request_id')
                ->Join('products', 'products.id', '=', 'requests.product_id')
                ->Join('currencies', 'currencies.id', '=', 'quotes.currency')
                ->Join('users', 'users.id', '=', 'requests.sender')
                ->where('receiver', 'like', '%' . $word . '%')
                ->where('quotes.sender', $userid)
                ->orderBy('quotes.id', 'DESC')
                ->select('quotes.*', 'requests.*', 'requests.sign_date as re_sign_date', 'quotes.sign_date as sign_date', 'requests.status as re_status', 'quotes.status as status', 'quotes.id as main_id', 'users.id as company_id', 'users.company_name as company_name', 'currencies.name as currency_name')
                ->get();
        }
        if (auth()->user()->hasRole('buyer')) {
            $quotes = DB::table('quotes')
                ->select('quotes.*', 'requests.*', 'requests.sign_date as re_sign_date', 'quotes.product_name as alternative_product_name', 'quotes.sign_date as sign_date', 'requests.status as re_status', 'quotes.status as status', 'quotes.id as main_id', 'users.id as company_id', 'users.company_name as company_name', 'users.company_name', 'quotes.sender as seller_id', 'currencies.name as currency_name')
                ->leftJoin('requests', 'requests.id', '=', 'quotes.request_id')
                ->Join('users', 'users.id', '=', 'quotes.sender')
                ->Join('products', 'products.id', '=', 'requests.product_id')
                ->Join('currencies', 'currencies.id', '=', 'quotes.currency')
                ->where('requests.sender', $userid)
                ->get();
        }
        $total = array();
        if (@$quotes) {
            foreach ($quotes as $quote) {
                $id = $quote->request_id;
                $main_id = $quote->main_id;
                //FOR Alternative product name
                $quote->alternative_product_name = '';
                $quote->alternative_product_currency = '';
                if ($quote->alternative_product) {
                    $alternate = DB::table('products')
                        ->where('products.id', $quote->alternative_product)
                        ->Join('currencies', 'currencies.id', '=', 'products.currency_id')
                        ->select('products.*', 'currencies.name as currency_name')
                        ->get();

                    if (@$alternate) {
                        foreach ($alternate as $alternate_prd) {
                            $quote->alternative_product_name = $alternate_prd->name;
                            $quote->alternative_product_currency = $alternate_prd->currency_name;
                        }
                    }
                }

                $quote->purchase_info = '';

                if ($quote->main_id) {
                    $purchase_info = DB::table('purchase_orders')
                        ->where('purchase_orders.request_id', $quote->main_id)
                        ->select('purchase_orders.*')
                        ->get();

                    if (@$purchase_info) {
                        foreach ($purchase_info as $purchase) {
                            $quote->purchase_info = $purchase->id;
                        }
                    }
                }
                $total[$id][] = $quote;
            }
        }

        rsort($total);
        $products = Product::all();
        $t_quotes = Quotes::all();
        $user = User::all();

        return view('frontend.quotes.index', compact('products', 'total', 'user', 't_quotes', 'page'));
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

    public function reply($id)
    {
        $page = "New Quote";
        $userid = auth()->id();
        $userDetail = User::where('id', $userid)->first();
        if (@$id) {
            $data = [];
            $records = Requests::where('requests.id', $id)
                ->join('products', 'requests.product_id', '=', 'products.id')
                ->join('currencies', 'currencies.id', '=', 'products.currency_id')
                ->select('requests.*', 'products.price_from', 'currencies.id as currency_id', 'currencies.name as currency_name')
                ->get();

            if (@$records) {
                $data['product_name'] = $records[0]->product_name;
                if (@$records[0]->unit) {
                    $data['unit'] = $records[0]->unit;
                } else {
                    $data['unit'] = 1;
                }
                $data['req_quantity'] = $records[0]->req_quantity;
                $data['volume'] = $records[0]->volume;
                $data['product_unit_price'] = $records[0]->price_from;
                $data['readonly'] = "readonly";
                $data['currency_name'] = $records[0]->currency_name;
                $data['currency_id'] = $records[0]->currency_id;
                $data['request_id'] = $id;
                $unitname = Unit::where('id', $data['unit'])->first();
                $currencyname = Currency::where('id', $records[0]->currency_id)->first();
                $myproducts = Product::where('user_id', auth()->id())->get();
                $units = Unit::all();
                return view('frontend.quotes.new', compact('data', 'unitname', 'userDetail', 'currencyname', 'myproducts', 'units', 'page'));
            }
        }
    }

    public function formaccepted($id)
    {
        if (@$id) {
            $records = Quotes::where('id', $id)->get();
            if (@$records) {
                $quotes_id = $records[0]->id;
                $request_id = $records[0]->request_id;
                $payment_information = "Payment Pending";

                $purchaseorders = Purchaseorders::where('request_id', $quotes_id)->first();
                if (@$purchaseorders) {

                } else {
                    $product = Purchaseorders::create([
                        'request_id' => $quotes_id,
                        'payment_status' => 1,
                        'buyer_payment_status' => 1,
                        'delivery_status' => 1,
                        'buyer_delivery_status' => 1,
                        'payment_information' => $payment_information,
                        'sign_date' => date('y-m-d h:i:s'),
                        'delivery_updated_at' => date('y-m-d h:i:s'),
                        'buyer_delivery_updated_at' => date('y-m-d h:i:s'),
                    ]);

                    $records[0]->status = 2;
                    $records[0]->save();

                    $userid = auth()->id();
                    $buyer_id = Requests::where('id', $request_id)->first();
                    $product = Product::where('id', $buyer_id->product_id)->first();
                    $seller_detail = User::where('id', $userid)->first();
                    $buyer_detail = User::where('id', $buyer_id->sender)->first();
                    $product_link = route('product.show', $product->slug);
                    $category = Category::where('id', $product->category_id)->first();
                    $unit = Unit::where('id', $product->unit)->first();
                    $email_template =EmailTemplates:: where('email_type','quote_accept_buyer')->first();
                    $controller = new EmailsController;
                    $array = [];
                    $array['username'] = $buyer_detail->name;
                    $array['receiver_address'] = $buyer_detail->email;
                    $array['data'] = array(
                        'name' => $array['username'],
                        "company_name" => $seller_detail['company_name'],
                        "product_link" => $product_link,
                        'product_name' => $product->name,
                        'product_image' => 'https://mambodubai.com/uploads/' . $product->image_url,
                        'categoryname' => $category->name,
                        'unitname' => $unit->name,
                        'req_quantity' => $buyer_id->req_quantity,
                        "body" => $email_template->email_body,
                    );

                    $array['subject'] = $email_template->email_subject;
                    $array['sender_address'] = "no-reply@mambodubai.com";
                    $controller->sendQuoteAcceptedMail($array);
                    $email_template =EmailTemplates:: where('email_type','quote_accept_seller')->first();
                    $controller = new EmailsController;
                    $array = [];
                    $array['username'] = $seller_detail->name;
                    $array['receiver_address'] = $seller_detail->email;
                    $array['data'] = array(
                        'name' => $array['username'],
                        "company_name" => $buyer_detail['company_name'],
                        "product_link" => $product_link,
                        'product_name' => $product->name,
                        'product_image' => 'https://mambodubai.com/uploads/' . $product->image_url,
                        'categoryname' => $category->name,
                        'unitname' => $unit->name,
                        'req_quantity' => $buyer_id->req_quantity,
                        "body" => $email_template->email_body,
                    );
                    $array['subject'] = $email_template->email_subject;
                    $array['sender_address'] = "no-reply@mambodubai.com";
                    $controller->sendQuoteAcceptedMail($array);

                }

                return redirect()->route('purchaseorders.index')->with('message', 'success|Quotation has been successfully accepted.');
            }
        }
    }

    public function formreject($id)
    {
        if (@$id) {
            $records = Quotes::where('id', $id)->get();
            if (@$records) {
                $quotes_id = $records[0]->id;
                $request_id = $records[0]->request_id;

                $product = Achievedquotes::create([
                    'request_id' => $quotes_id,
                    'sign_date' => date('y-m-d h:i:s'),
                ]);
                $records[0]->status = 3;
                $records[0]->update();

                $userid = auth()->id();
                $buyer_id = Requests::where('id', $request_id)->first();
                $product = Product::where('id', $buyer_id->product_id)->first();
                $seller_detail = User::where('id', $userid)->first();
                $buyer_detail = User::where('id', $buyer_id->sender)->first();
                $product_link = route('product.show', $product->slug);
                $category = Category::where('id', $product->category_id)->first();
                $unit = Unit::where('id', $product->unit)->first();
                $email_template =EmailTemplates:: where('email_type','quote_reject_buyer')->first();
                $controller = new EmailsController;
                $array = [];
                $array['username'] = $buyer_detail->name;
                $array['receiver_address'] = $buyer_detail->email;
                $array['data'] = array(
                    'name' => $array['username'],
                    "company_name" => $seller_detail['company_name'],
                    "product_link" => $product_link,
                    'product_name' => $product->name,
                    'product_image' => 'https://mambodubai.com/uploads/' . $product->image_url,
                    'categoryname' => $category->name,
                    'unitname' => $unit->name,
                    'req_quantity' => $buyer_id->req_quantity,
                    "body" => $email_template->email_body,
                );
                $array['subject'] = $email_template->email_subject;
                $array['sender_address'] = "no-reply@mambodubai.com";
                $controller->sendQuoteRejectedMail($array);

                $email_template =EmailTemplates:: where('email_type','quote_reject_seller')->first();
                $controller = new EmailsController;
                $array = [];
                $array['username'] = $seller_detail->name;
                $array['receiver_address'] = $seller_detail->email;
                $array['data'] = array(
                    'name' => $array['username'],
                    "company_name" => $buyer_detail['company_name'],
                    "product_link" => $product_link,
                    'product_name' => $product->name,
                    'product_image' => 'https://mambodubai.com/uploads/' . $product->image_url,
                    'categoryname' => $category->name,
                    'unitname' => $unit->name,
                    'req_quantity' => $buyer_id->req_quantity,
                    "body" => $email_template->email_body,
                );
                $array['subject'] = $email_template->email_subject;
                $array['sender_address'] = "no-reply@mambodubai.com";
                $controller->sendQuoteRejectedMail($array);

                return redirect()->route('achieved.index')->with('message', 'danger|Quotation has been successfully rejected.');;
            }
        }
    }

    public function accepted(Request $request)
    {
        $id = $request->id;
        if (@$id) {
            $records = Quotes::where('id', $id)->get();
            if (@$records) {
                $quotes_id = $records[0]->id;
                $payment_status = 1;
                $payment_information = "Payment Pending";

                $purchaseorders = Purchaseorders::where('request_id', $quotes_id)->first();
                if (@$purchaseorders) {

                } else {
                    $product = Purchaseorders::create([
                        'request_id' => $quotes_id,
                        'payment_status' => $payment_status,
                        'buyer_payment_status' => 1,
                        'delivery_status' => 1,
                        'buyer_delivery_status' => 1,
                        'payment_information' => $payment_information,
                        'sign_date' => date('y-m-d h:i:s'),
                        'delivery_updated_at' => date('y-m-d h:i:s'),
                        'buyer_delivery_updated_at' => date('y-m-d h:i:s'),
                    ]);

                    $record[0]->status = 2;
                    $record[0]->update();

                }

                return response()->json('Accepted');
            }
        }
    }

    public function reject(Request $request)
    {
        $id = $request->id;
        if (@$id) {
            $records = Quotes::where('id', $id)->get();
            if (@$records) {
                $quotes_id = $records[0]->id;

                $product = Achievedquotes::create([
                    'request_id' => $quotes_id,
                    'sign_date' => date('y-m-d h:i:s'),
                ]);
                $record[0]->status = 3;
                $record[0]->update();

                return response()->json('Rejected');
//                return redirect()->route('achieved.index');
            }
        }
    }

    public function change($id)
    {
        if (@$id) {
            $data = [];
            $records = Quotes::where('id', $id)->get();

            $result = $records[0];
            $seller = User::where('id', $result->sender)->first();
            $result['readonly'] = "";

            return view('frontend.quotes.edit', compact('result', 'seller'));
        }
    }
    public function editquote($id)
    {
        $page = "Edit Quote";
        $userid = auth()->id();
        $userDetail = User::where('id', $userid)->first();
        if (@$id) {
            $data = [];
            $quotes = DB::table('quotes')
                ->Join('requests', 'quotes.request_id', '=', 'requests.id')
                ->Join('products', 'products.id', '=', 'requests.product_id')
                ->Join('currencies', 'currencies.id', '=', 'quotes.currency')
                ->Join('users', 'users.id', '=', 'requests.sender')
                ->where('quotes.sender', $userid)
                ->where('quotes.request_id', $id)
                ->select('quotes.*', 'requests.product_id as product_id', 'quotes.status as status', 'quotes.id as main_id',
                    'users.name as username', 'users.company_name', 'currencies.id as currency_id', 'currencies.name as currency_name', 'requests.sender as buyer_id')
                ->get();
            $records = Requests::where('requests.id', $id)
                ->join('products', 'requests.product_id', '=', 'products.id')
                ->select('requests.*', 'products.price_from')
                ->get();
            if (@$records) {
                $data['product_name'] = $records[0]->product_name;
                if (@$records[0]->unit) {
                    $data['unit'] = $records[0]->unit;
                } else {
                    $data['unit'] = 1;
                }

                $data['req_quantity'] = $records[0]->req_quantity;
                $data['volume'] = $records[0]->volume;
                $data['product_unit_price'] = $records[0]->price_from;
                $data['readonly'] = "readonly";
                $data['request_id'] = $id;
                $unitname = Unit::where('id', $data['unit'])->first();
                $myproducts = Product::where('user_id', auth()->id())->get();
                $units = Unit::all();
                return view('frontend.quotes.editquote', compact('data', 'unitname', 'userDetail', 'myproducts', 'quotes', 'units', 'page'));
            }
        }
    }
    public function detailview($id)
    {
        $page = 'Detail';
        if (@$id) {
            $data = [];
            $records = Quotes::where('id', $id)->get();
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
                $comments = Comments::where('purchase_id', $purchaseorders[0]['id'])->orderBy('comments.id', 'desc')->get();
                $url = route('purchaseorders.getcomments', $purchaseorders[0]['id']);
                $record = $purchaseorders[0];
            } else {
                $achieves = Achievedquotes::where('request_id', $id)->get();
                if (@$achieves[0]) {
                    $result['purchase'] = $achieves[0];
                } else {
                    $result['purchase'] = "";
                }
                $comments = '';
                $url = '';
                $record =  '';
            }
            $allcomments = Comments::where('quote_id',$id)->get();
// echo '<pre>'; print_r($comments); exit;
            return view('frontend.quotes.edit', compact('result', 'allcomments','seller', 'product_detail', 'imagesUrl','record', 'comments','url','page'));
        }
    }
    public function getcomments($id)
    {
        if (@$id) {
            $record = Quotes::where('id', $id)->first();
            if (@$record) {
                $comments = DB::table('comments')
                    ->Join('users', 'users.id', '=', 'comments.writer')
                    ->where('comments.quote_id', $record->id)
                    ->orderBy('comments.id', 'desc')
                    ->select('comments.description', 'comments.sign_date', 'users.name as username')
                    ->get();

                return response()->json($comments);
            }
        }
    }

    public function quoteupdate(Request $request)
    {

        $this->validate(request(), [
            'request_id' => 'required',
            'quote_id' => 'required',
        ]);

        if (@request('quote_id')) {
            $records = Quotes::where('id', request('quote_id'))->get();

            $records[0]->available = request('product_available');
            $records[0]->product_price = request('alternative_product_price');
            $records[0]->shipping_price = request('shipping_price');
            $records[0]->shipping_desc = request('shipping_desc');
            $records[0]->shipping_weight = request('shipping_weight');
            $records[0]->shipping_unit = request('shipping_unit');
            $records[0]->vat = request('vat');
            $records[0]->other_price = request('other_price');
            $records[0]->other_price_desc = request('other_price_desc');
            $records[0]->total_price = request('total_price');
            $records[0]->updated_at = date('y-m-d h:i:s');
            $records[0]->update();

            $userid = auth()->id();
            $buyer_id = Requests::where('id', $records[0]->request_id)->first();
            $product = Product::where('id', $buyer_id->product_id)->first();
            $seller_detail = User::where('id', $userid)->first();
            $buyer_detail = User::where('id', $buyer_id->sender)->first();
            $category = Category::where('id', $product->category_id)->first();
            $unit = Unit::where('id', $product->unit)->first();

            $product_link = route('product.show', $product->slug);
            $email_template =EmailTemplates:: where('email_type','quote_submission_edit')->first();
            $controller = new EmailsController;
            $array = [];
            $array['username'] = $buyer_detail->name;
            $array['receiver_address'] = $buyer_detail->email;
            $array['data'] = array(
                'name' => $array['username'],
                "company_name" => $seller_detail['company_name'],
                "product_link" => $product_link,
                'product_name' => $product->name,
                'product_image' => 'https://mambodubai.com/uploads/' . $product->image_url,
                'categoryname' => $category->name,
                'unitname' => $unit->name,
                'req_quantity' => $buyer_id->req_quantity,
                "body" => $email_template->email_body,
            );
            $array['subject'] = $email_template->email_subject;
            $array['sender_address'] = "no-reply@mambodubai.com";
            $controller->sendQuoteNowMail($array);
        }

        return redirect()->route('quote.index')->with('message', 'success|Quotation has been successfully updated.');
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
            'request_id' => 'required',
        ]);

        $userid = auth()->id();

        if (request('product_available') == '0') { //alternative product case
            $rfq = Quotes::create([
                'request_id' => request('request_id'),
                'product_name' => request('product_name'),
                'product_price' => 0,
                'sender' => $userid,
                'currency' => request('currency_id'),
                'volume' => request('volume'),
                'unit' => request('unit'),
                'alternative_product' => request('alternative_product'),
                'alternative_product_price' => request('alternative_product_price'),
                'shipping_price' => request('shipping_price'),
                'shipping_weight' => request('shipping_weight'),
                'shipping_unit' => request('shipping_unit'),
                'shipping_desc' => '',
                'other_price' => request('other_price'),
                'other_price_desc' => request('other_price_desc'),
                'available' => 1,
                'total_price' => request('total_price'),
                'status' => 1,
                'sign_date' => date('y-m-d h:i:s'),
            ]);
        } else {
            $rfq = Quotes::create([
                'request_id' => request('request_id'),
                'product_name' => request('product_name'),
                'volume' => request('volume'),
                'sender' => $userid,
                'unit' => request('unit'),
                'currency' => request('currency_id'),
                'available' => request('product_available'),
                'product_price' => request('alternative_product_price'),
                'alternative_product_price' => 0,
                'shipping_price' => request('shipping_price'),
                'shipping_weight' => request('shipping_weight'),
                'shipping_unit' => request('shipping_unit'),
                'shipping_desc' => '',
                'vat' => request('vat'),
                'other_price' => request('other_price'),
                'other_price_desc' => request('other_price_desc'),
                'total_price' => request('total_price'),
                'status' => 1,
                'sign_date' => date('y-m-d h:i:s'),
            ]);
        }

        $userid = auth()->id();
        $buyer_id = Requests::where('id', request('request_id'))->first();
        $product = Product::where('id', $buyer_id->product_id)->first();
        $seller_detail = User::where('id', $userid)->first();
        $buyer_detail = User::where('id', $buyer_id->sender)->first();
        $product_link = route('product.show', $product->slug);
        $category = Category::where('id', $product->category_id)->first();
        $unit = Unit::where('id', $product->unit)->first();
        $email_template =EmailTemplates:: where('email_type','quote_submission')->first();
        $controller = new EmailsController;
        $array = [];
        $array['username'] = $buyer_detail->name;
        $array['receiver_address'] = $buyer_detail->email;
        $array['data'] = array(
            'name' => $array['username'],
            "company_name" => $seller_detail['company_name'],
            "product_link" => $product_link,
            'product_name' => $product->name,
            'product_image' => 'https://mambodubai.com/uploads/' . $product->image_url,
            'categoryname' => $category->name,
            'unitname' => $unit->name,
            'req_quantity' => $buyer_id->req_quantity,
            "body" => $email_template->email_body,
        );
        $array['subject'] =$email_template->email_subject;
        $array['sender_address'] = "no-reply@mambodubai.com";
        $controller->sendQuoteNowMail($array);

        return redirect()->route('quote.index')->with('message', 'success|Quotation has been successfully submitted.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function show(Quotes $quotes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotes $quotes)
    {
        //
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
        $this->validate(request(), [
            'request_id' => 'required',
        ]);

        if (@request('id')) {
            $records = Quotes::where('id', request('id'))->get();

            if (request('available') != 'on') { //alternative product case
                $records[0]->alternative_product = request('alternative_product');
                $records[0]->alternative_product_price = request('alternative_product_price');
                $records[0]->available = 1;
                $records[0]->total_price = request('total_price');
                $records[0]->update();
            } else {
                $records[0]->available = 0;
                $records[0]->total_price = request('total_price');
                $records[0]->product_price = request('product_price');
                $records[0]->update();
            }
            $userid = auth()->id();
            $buyer_id = Requests::where('id', request('request_id'))->first();
            $product = Product::where('id', $buyer_id->product_id)->first();
            $seller_detail = User::where('id', $userid)->first();
            $buyer_detail = User::where('id', $buyer_id->sender)->first();
            $product_link = route('product.show', $product->slug);
            $category = Category::where('id', $product->category_id)->first();
            $unit = Unit::where('id', $product->unit)->first();
            $email_template =EmailTemplates:: where('email_type','quote_submission_edit')->first();
            $controller = new EmailsController;
            $array = [];
            $array['username'] = $buyer_detail->name;
            $array['receiver_address'] = $buyer_detail->email;
            $array['data'] = array(
                'name' => $array['username'],
                "company_name" => $seller_detail['company_name'],
                "product_link" => $product_link,
                'product_name' => $product->name,
                'product_image' => 'https://mambodubai.com/uploads/' . $product->image_url,
                'categoryname' => $category->name,
                'unitname' => $unit->name,
                'req_quantity' => $buyer_id->req_quantity,
                "body" => $email_template->email_body,
            );
            $array['subject'] = $email_template->email_subject;
            $array['sender_address'] = "no-reply@mambodubai.com";
            $controller->sendQuoteNowMailEdit($array);

        }

        return redirect()->route('quote.index')->with('message', 'success|Quotation has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quotes  $quotes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotes $quotes)
    {
        $record = Quotes::where('id', request('id'))->get();
        if (@$record) {
            $record[0]->status = 4;
            $record[0]->update();
        }

        return back();
    }

    public function getproductname(Request $request)
    {

        $myproducts = DB::table('products')
            ->select('products.*', 'unit.name as unitname')
            ->join('unit', 'unit.id', '=', 'products.unit')
            ->where('products.id', $request->product_id)->get();
        return response()->json($myproducts);
    }

    public function quotedetail(Request $request)
    {

        $myproducts = DB::table('quotes')
            ->select('quotes.*', 'unit.name as unitname', 'currencies.name as currency_name')
            ->leftJoin('requests', 'requests.id', '=', 'quotes.request_id')
            ->Join('products', 'products.id', '=', 'requests.product_id')
            ->Join('currencies', 'currencies.id', '=', 'quotes.currency')
            ->join('unit', 'unit.id', '=', 'quotes.unit')
            ->where('quotes.id', $request->id)->get();

        //Alternative product information

        foreach ($myproducts as $myproduct) {
            $myproduct->alternative_product_name = '';
            $myproduct->alternative_product_currency = '';
            if ($myproduct->alternative_product) {
                $alternate = DB::table('products')
                    ->Join('products', 'products.id', '=', 'requests.product_id')
                    ->Join('currencies', 'currencies.id', '=', 'products.currency_id')
                    ->where('products.id', $myproduct->alternative_product)
                    ->select('products.*', 'currencies.name as currency_name')
                    ->get();

                if (@$alternate) {
                    foreach ($alternate as $alternate_prd) {
                        $myproduct->alternative_product_name = $alternate_prd->name;
                        $myproduct->alternative_product_currency = $alternate_prd->currency_name;
                    }
                }
            }
            $myproduct->purchase_info = '';

            if ($myproduct->id) {
                $purchase_info = DB::table('purchase_orders')
                    ->where('purchase_orders.request_id', $myproduct->id)
                    ->select('purchase_orders.*')
                    ->get();

                if (@$purchase_info) {
                    foreach ($purchase_info as $purchase) {
                        $myproduct->purchase_info = $purchase->id;
                    }
                }
            }
        }

        return response()->json($myproducts);
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
            return view('frontend.quotes.downloadpdf', compact('quotes', 'seller_detail', 'buyer_detail', 'page'));

        }
    }

}
