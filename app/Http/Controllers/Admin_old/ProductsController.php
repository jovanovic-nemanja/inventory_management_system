<?php

namespace App\Http\Controllers\Admin;

use Mail;
use App\User;
use App\Unit;
use App\Category;
use App\Product;
use App\Bulkdeal;
use App\Adminlogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\EmailsController;


class ProductsController extends Controller
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
        $products = Product::all();
        //      $re =  $products->getCategoryname(4);
        //        echo '<pre>'; print_r($re);exit;
        return view('admin.product.index', compact('products'));
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
    public function store($id)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (@$id) {
            $record = Product::where('id', $id)->get();
            if (@$record) {
                if ($record[0]->status == NULL || $record[0]->status == 1) {
                    $record[0]->status = 2;
                    $record[0]->update();
                    Bulkdeal::create([
                        'product_id' => $record[0]->id,
                    ]);
                    $data = [];
                    $data['title'] = 'Approved';
                    $data['description'] = 'Product Name: ' . $record[0]->name;
                    $add_logs = Adminlogs::Addlog($data);

                    $userid = $record[0]->user_id;
                    $user = User::where('id', $userid)->first();
                    $username = $user->name;
                    $useremail = $user->email;

                    $product_link = route('product.show', $record[0]->slug);
                    $company_name = $user->company_name;
                    $category = Category::where('id', $record[0]->category_id)->first();
                    $unit = Unit::where('id', $record[0]->unit)->first();
                    $categoryname = $category->name;
                    $unitname = $unit->name;


                    $controller = new EmailsController;
                    $array = [];
                    $user = User::where('id', $userid)->first();
                    $array['username'] = $user->name;
                    $array['receiver_address'] = $user->email;
                    $array['data'] = array('name' => $array['username'], "body" => "Thanks for your product has been approved.", "company_name" => $company_name, "product_link" => $product_link, "product" => $record[0], 'category' => $categoryname, 'unitname' => $unitname);
                    $array['subject'] = "Successfully approved your product.";
                    $array['sender_address'] = "solaris.dubai@gmail.com";
                    $controller->approveProductadmin($array);
                } else {
                    $record[0]->status = 1;
                    $record[0]->update();

                    $data = [];
                    $data['title'] = 'Pending';
                    $data['description'] = 'Product Name: ' . $record[0]->name;
                    $add_logs = Adminlogs::Addlog($data);
                }
            } else {
                return back();
            }
            return redirect()->route('products.index')->with('flash', 'Product has been successfully changed the status');
        } else {
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (@$id) {
            $res = Product::where('id', $id)->first();
            $record = Product::where('id', $id)->delete();

            $data = [];
            $data['title'] = 'Deleted';
            $data['description'] = 'Product Name: ' . $res['name'];
            $add_logs = Adminlogs::Addlog($data);

            return redirect()->route('products.index')->with('flash', 'Product has successfully deleted');
        } else {
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('flash', 'Product has successfully deleted');
    }
}
