<?php

namespace App\Http\Controllers\Admin;

use App\Adminlogs;
use App\Bulkdeal;
use App\Category;
use App\Currency;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\EmailsController;
use App\Image;
use App\Product;
use App\Unit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

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
        $products = Product::where('status', '!=', '3')->orderBy('id', 'desc')->get();
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
                if ($record[0]->status == null || $record[0]->status == 1) {
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
    // public function edit($id)
    // {
    //     if (@$id) {
    //         $res = Product::where('id', $id)->first();
    //         $record = Product::where('id', $id)->delete();

    //         $data = [];
    //         $data['title'] = 'Deleted';
    //         $data['description'] = 'Product Name: ' . $res['name'];
    //         $add_logs = Adminlogs::Addlog($data);

    //         return redirect()->route('products.index')->with('flash', 'Product has successfully deleted');
    //     } else {
    //         return back();
    //     }
    // }

    public function edit($id)
    {
        $page = 'Edit Product';
        $categories = Category::where('status', '1')->orderBy('name', 'asc')->get();
        $currencies = Currency::all();
        $main_categorys = Category::where('parent', 0)->get();
        $sub_categorys = Category::whereRaw("parent != 0")->get();
        $units = Unit::all();

        $allcate = $this->get_options($categories);
        $product_categories = array();
        foreach ($allcate as $key => $cat) {
            $cat_id = str_replace('x', '', $key);
            $product_categories[$cat_id] = $cat;
        }

        $product = Product::where('id', $id)->first();
        $allimages = Image::where('product_id', $product->id)->get();
        return view('admin.product.edit', compact('product', 'categories', 'currencies', 'units', 'allimages', 'product_categories', 'page'));
    }
    public function get_options($array, $parent = 0, $indent = "")
    {
        $return = array();
        foreach ($array as $key => $val) {
            if ($val["parent"] == $parent) {
                $return["x" . $val["id"]] = $indent . $val["name"];
                $return = array_merge($return, $this->get_options($array, $val["id"], $indent . $val['name'] . " > "));
            }
        }
        return $return;
    }

    public function makeSlug($title)
    {
        $slug = str_slug($title);
        $products = DB::table('products')
            ->select('products.slug')
            ->where('products.slug', 'like', $slug . '%')->count();
        if ($products > 0) {
            $slug = $slug . '-' . $products;
        }
        return $slug;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'category_id' => 'required',
            'unit_id' => 'required',
            'MOQ' => 'required',
            'price_from' => 'required',
            'price_to' => 'required',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
        ]);
        if (@$request->product_id) {
            $product = Product::where('id', $request->product_id)->first();
            if (ucwords(strtolower($request->name)) == $product->name) {
                $product->name = ucwords(strtolower($request->name));
                $product->category_id = $request->category_id;
                $product->currency_id = $request->currency_id;
                $product->unit = $request->unit_id;
                $product->MOQ = $request->MOQ;
                $product->description = $request->description;
                $product->price_from = $request->price_from;
                $product->price_to = $request->price_to;
                $product->price_show = $request->product_price_show;
                $product->price_fixed = $request->product_fixed_price_show;
                $product->meta_title = ucwords(strtolower($request->meta_title));
                $product->meta_description = $request->meta_description;
                $product->meta_keywords = ucwords(strtolower($request->meta_keywords));
                $product->video_link = $request->video_link;
                $product->save();

            } else {
                $product->name = ucwords(strtolower($request->name));
                $product->category_id = $request->category_id;
                $product->currency_id = $request->currency_id;
                $product->unit = $request->unit_id;
                $product->MOQ = $request->MOQ;
                $product->description = $request->description;
                $product->price_from = $request->price_from;
                $product->price_to = $request->price_to;
                $product->price_show = $request->product_price_show;
                $product->price_fixed = $request->product_fixed_price_show;
                $product->meta_title = ucwords(strtolower($request->meta_title));
                $product->meta_description = $request->meta_description;
                $product->meta_keywords = ucwords(strtolower($request->meta_keywords));
                $product->video_link = $request->video_link;
                $product->slug = makeSlug(request('name'));
                $product->save();

            }

        } else {

        }

        $singlefiles = Input::file('single');
        if (@request('single')) {
            $filename = $singlefiles->getClientOriginalName();
            $path = 'uploads';

            if (Storage::disk('uploads')->put($path . '/' . $filename, File::get($singlefiles))) {
                $productdelete = Image::where('product_id', $product->id)->where('url', $product->image_url)->delete();
                $input['url'] = $filename;
                $input['product_id'] = $product->id;
                $file = Image::create($input);
                $productimg = Product::where('id', $product->id)->first();
                $productimg->image_url = $filename;
                $productimg->save();
            }
        }

        $files = Input::file('images');

        if (@$files) {
            for ($i = 0; $i < count($files); $i++) {
                $filename = $files[$i]->getClientOriginalName();
                $path = 'uploads';
                if (Storage::disk('uploads')->put($path . '/' . $filename, File::get($files[$i]))) {

                    $input['url'] = $filename;
                    $input['product_id'] = $product->id;
                    $file = Image::create($input);
                }
            }
        }
        return redirect()->route('products.index')->with('flash', 'Product has successfully updated');

    }
    public function delete_add_image(Request $request)
    {
        $id = $request->id;
        if (@$id) {
            $product = Image::where('id', $id)->delete();
            return response()->json(['msg' => 'Successfully deleted!', 'status' => '200']);
        } else {
            return response()->json(['msg' => 'Please choose any items! There are not any chosen items now.', 'status' => '400']);
        }
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