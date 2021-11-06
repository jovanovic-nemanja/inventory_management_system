<?php

namespace App\Http\Controllers\Admin;

use App\Adminlogs;
use App\Files;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\EmailsController;
use App\Product;
use App\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestsController extends Controller
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
        $categories = Requests::orderBy('id', 'desc')
            ->Join('unit', 'unit.id', '=', 'requests.unit')
            ->select('requests.*', 'unit.name as unitname')
            ->get();
        return view('admin.requests.index', compact('categories'));
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
        if (@Request('sellers')) {
            $arrs = Request('sellers');
            $values;

            foreach ($arrs as $key => $value) {
                if ($key == 0) {
                    $values = $value;
                } else {
                    $values .= ',' . $value;
                }

                $userid = $value;
                $user = User::where('id', $userid)->first();
                $username = $user->name;
                $useremail = $user->email;

                $controller = new EmailsController;
                $array = [];
                $array['username'] = $username;
                $array['receiver_address'] = $useremail;
                $array['data'] = array('name' => $array['username'], "body" => "Please check this URL: http://rfq.projexonlineservices.com/request");
                $array['subject'] = "The following RFQ has been assigned to you by administrator.";
                $array['sender_address'] = "solaris.dubai@gmail.com";

                $controller->save($array);
            }
            $id = Request('id');
            $records = Requests::where('id', $id)->first();

            $data = [];
            $data['title'] = 'Assigned';
            $data['description'] = 'RFQ Name: ' . $records->product_name;
            $add_logs = Adminlogs::Addlog($data);

            $records->receiver = '[' . $values . ']';
            $records->update();
        }

        return redirect()->route('requests.index')->with('message', 'success|Sellers has been successfully choosed.');
    }

    public function assign($id)
    {
        if (@$id) {
            $records = Requests::where('id', $id)->first();
        } else {
            $records = '';
        }

        $sellers = DB::table('users')
            ->Join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', 2)
            ->where('users.block', 0)
            ->select('users.*')
            ->get();

        return view('admin.requests.assign', compact('records', 'sellers'));
    }

    public function view($id)
    {
        $records = Requests::where('requests.id', $id)
            ->Join('products', 'products.id', '=', 'requests.product_id')
            ->Join('currencies', 'currencies.id', '=', 'products.currency_id')
            ->Join('unit', 'unit.id', '=', 'products.unit')
            ->select('requests.*', 'currencies.name as currency_name', 'unit.name as unitname', 'products.price_to as price_to', 'products.price_from as price_from', 'products.price_show as price_show', 'products.price_fixed as price_fixed', 'products.MOQ as MOQ', 'products.name as product_name', 'products.image_url as product_image_url', 'products.slug as product_slug')
            ->first();
        $seller_id = str_replace('[', ' ', $records->receiver);
        $seller_id = str_replace(']', ' ', $seller_id);
        $buyer_detail = User::where('id', $records->sender)->first();
        $seller_detail = User::where('id', $seller_id)->first();
        return view('admin.requests.view', compact('records', 'buyer_detail', 'seller_detail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (@$id) {
            $record = Requests::where('id', $id)->get();
            if (@$record) {
                if ($record[0]->status == null || $record[0]->status == 1) {
                    $record[0]->status = 2;
                    $record[0]->update();

                    $product_id = $record[0]->product_id;
                    $files = Files::where('request_id', $record[0]->id)->first();

                    if (@$product_id) {
                        $product = Product::where('id', $product_id)->first();
                        $user = User::where('id', $product->user_id)->first();
                        $customer = User::where('id', $record[0]->sender)->first();
                        $company_name = $user->company_name;
                        $customer_name = $customer->name;
                        $product_link = route('product.show', $product->slug);
                    } else {
                        $company_name = "";
                        $customer_name = "";
                        $product_link = route('product.index');
                    }

                    if (@$files) {
                        $file_link = "https://rfq.mambodubai.com/uploads/" . $files->name;
                    } else {
                        $file_link = "";
                    }

                    //To buyer
                    $userid = $record[0]->sender;
                    $user = User::where('id', $userid)->first();
                    $username = $user->name;
                    $useremail = $user->email;

                    $controller = new EmailsController;
                    $array = [];
                    $array['username'] = $username;
                    $array['receiver_address'] = $useremail;
                    $array['data'] = array('name' => $array['username'], "body" => "Successfully approved your RFQ.", "company_name" => $company_name, "product_link" => $product_link, "file_link" => $file_link, "rfq" => $record[0]);
                    $array['subject'] = "Successfully approved your RFQ.";
                    $array['sender_address'] = "solaris.dubai@gmail.com";
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
                            $username = $user->name;
                            $useremail = $user->email;

                            $controller = new EmailsController;
                            $array = [];
                            $array['username'] = $username;
                            $array['receiver_address'] = $useremail;
                            $array['data'] = array('name' => $array['username'], "body" => "Successfully submitted a RFQ for your product.", "customer_name" => $customer_name, "product_link" => $product_link, "file_link" => $file_link, "rfq" => $record[0]);
                            $array['subject'] = "The following RFQ has been assigned to you by administrator.";
                            $array['sender_address'] = "solaris.dubai@gmail.com";

                            $controller->approveRequest($array);
                        }
                    }
                } else {
                    $record[0]->status = 1;
                    $record[0]->update();

                    $data = [];
                    $data['title'] = 'Pending';
                    $data['description'] = 'RFQ Name: ' . $record[0]->product_name;
                    $add_logs = Adminlogs::Addlog($data);
                }
            } else {
                return back();
            }
            return redirect()->route('requests.index')->with('message', 'success|Request status has been successfully changed.');
        } else {
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (@$id) {
            $record = Requests::where('id', $id)->delete();
            return redirect()->route('requests.index')->with('message', 'success|Request has successfully deleted');
        } else {
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requests $requests)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requests $requests)
    {
        //
    }
}
