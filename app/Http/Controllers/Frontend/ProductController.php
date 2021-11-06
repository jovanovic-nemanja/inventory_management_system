<?php

namespace App\Http\Controllers\Frontend;

use App\Bulkdeal;
use App\Category;
use App\Currency;
use App\Filters\ProductFilters;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\EmailsController;
use App\Image;
use App\LocalizationSetting;
use App\Product;
use App\Requests;
use App\Unit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Session;
use App\EmailTemplates;

class ProductController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth')->except(['index', 'search_product', 'show', 'getcategory', 'getlocalizationsettings', 'getproductsbyfilter', 'getrole', 'deleteproductsbychoosing']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductFilters $filters, Request $request)
    {
        $category = Category::where('slug', $request['category'])->first();
        // echo '<pre>'; print_r($category);exit;
        if (isset($category->thumbs_url)) {
            $slider_main_image = $category->thumbs_url;
        } else {
            $slider_main_image = '';
        }

        $categorys = Category::where('status', '1')->orderBy('name', 'asc')->get();

        if (!empty($category)) {
            $cat_name = $category['name'];
            $cat_slug = $category['slug'];
        } else {
            $cat_name = '';
            $cat_slug = '';
        }
        if ($request['category'] != '') {
            $categoryIds = $this->sub_cat_id($categorys, $category['id']);
            $slidercategoryIds = $categoryIds;
            $categoryIds[] = $category['id'];
        } else {
            $categoryIds = $this->sub_cat_id($categorys, 0);
            $slidercategoryIds = $categoryIds;
        }

        $categories = Product::whereIn('category_id', $categoryIds)->Where('status', 2)->orderBy(DB::raw('RAND()'))->paginate(12);
        $slider_category = Category::whereIn('id', $slidercategoryIds)->get();
        $count = count($categories);
        $arrs = 'all';

        foreach ($categorys as $cate) {
            if (@$cate['meta_keywords']) {
                $arrs = $arrs . ", " . $cate->meta_keywords;
            }
        }

        return view('frontend.product.index', compact('categories', 'categorys', 'category', 'count', 'arrs', 'cat_name', 'slider_category', 'slider_main_image', 'cat_slug'));
    }

    public function search_product(Request $request)
    {
        $category = Category::where('slug', $request['category'])->first();
        $categorys = Category::where('status', '1')->orderBy('name', 'asc')->get();
        if (!empty($category)) {
            $cat_name = $category['name'];
            $cat_slug = $category['slug'];
        } else {
            $cat_name = '';
            $cat_slug = '';
        }
        if ($request['category'] != 'all') {
            $categoryIds = $this->sub_cat_id($categorys, $category['id']);
            $categoryIds[] = $category['id'];
        } else {
            $categoryIds = $this->sub_cat_id($categorys, 0);
        }

        if ($request['category'] != 'all') {
            $searchQuery = trim($request['word']);
            $requestData = ['name', 'description'];
            $categories = Product::where(function ($q) use ($requestData, $searchQuery) {
                foreach ($requestData as $field) {
                    $q->orWhere($field, 'like', "%{$searchQuery}%");
                }
            })
                ->whereIn('category_id', $categoryIds)
                ->Where('status', 2)
                ->orderBy('id', 'DESC')
                ->paginate(12);
        } else {
            $searchQuery = trim($request['word']);
            $requestData = ['name', 'description'];
            $categories = Product::where(function ($q) use ($requestData, $searchQuery) {
                foreach ($requestData as $field) {
                    $q->orWhere($field, 'like', "%{$searchQuery}%");
                }
            })
                ->Where('status', 2)
                ->orderBy('id', 'DESC')
                ->paginate(12);

        }
        // $count = count($categories);
        // $perPage = 12;
        // $offset = (4 - 1) * $perPage;
        // $categories = array_slice($categories, $offset, $perPage);
        // $products = new Paginator($categories, $count, $perPage, '4', ['path' => $request->url(), 'query' => $request->query()]);

        $arrs = 'all';
        foreach ($categorys as $cate) {
            if (@$cate['meta_keywords']) {
                $arrs = $arrs . ", " . $cate->meta_keywords;
            }
        }
        return view('frontend.product.search', compact('categories', 'categorys', 'category', 'arrs', 'cat_name', 'cat_slug'));
    }

    public function sub_cat_id($array, $parent, $indent = "")
    {
        $return = array();
        $count = 0;
        foreach ($array as $key => $val) {
            if ($val["parent"] == $parent) {
                $return[$count] = $indent . $val["id"];
                $return = array_merge($return, $this->sub_cat_id($array, $val["id"], $indent));
            }
            $count++;
        }
        return $return;
    }

    /**
     * All products by every filter conditions.
     *
     * @return \Illuminate\Http\Response
     */
    public function getproductsbyfilter($word, $by, $min_price, $max_price, $category, $sort)
    {
        ($word == 'null') ? $word = '' : $word = $word;
        ($by == 'null') ? $by = '' : $by = $by;
        ($min_price == 'null') ? $min_price = 0 : $min_price = $min_price;
        ($sort == 'null') ? $sortV = -1 : $sortV = $sort;
        if ($sortV == -1 || $sortV == 1) {
            $column = "products.sign_date";
            $type = "DESC";
        } elseif ($sortV == 2) { //old to latest
            $column = "products.sign_date";
            $type = "ASC";
        } elseif ($sortV == 3) { //low to high
            $column = "products.price_to";
            $type = "ASC";
        } elseif ($sortV == 4) { //high to low
            $column = "products.price_to";
            $type = "DESC";
        }

        $allcate = Category::where('status', '1')->orderBy('name', 'asc')->get();

        if ($category != 'null') {
            $category = Category::where('slug', $category)->first();
            $categoryIds = $this->sub_cat_id($allcate, $category['id']);
            $categoryIds[] = $category['id'];
            // echo '<pre>'; print_r($categoryIds); exit;
        } else {
            $categoryIds = $this->sub_cat_id($allcate, 0);
            // echo '<pre>'; print_r($categoryIds); exit;
        }
        $requestData = ['products.name', 'products.description'];
        if ($category == 'null') {
            $products = DB::table('products')
                ->select('products.*', 'images.url', 'users.name as username', 'users.id as user_id', 'categories.name as category_name', 'users.company_name', 'users.verified', 'unit.name as unitname', 'currencies.name as currency_name')
                ->Join('images', 'products.id', '=', 'images.product_id')
                ->Join('users', 'users.id', '=', 'products.user_id')
                ->Join('unit', 'unit.id', '=', 'products.unit')
                ->Join('currencies', 'currencies.id', '=', 'products.currency_id')
                ->Join('categories', 'categories.id', '=', 'products.category_id')
                ->whereIn('products.category_id', $categoryIds)
                ->where('products.status', 2)
                ->whereNull('products.deleted_at')
                ->where(function ($q) use ($requestData, $word) {
                    foreach ($requestData as $field) {
                        $q->orWhere($field, 'like', "%" . $word . "%");
                    }

                })
                ->where('products.username', 'like', '%' . $by . '%')
                ->where('products.price_to', '>=', $min_price)
                ->where('products.price_to', '<=', $max_price)
                ->orderBy($column, $type)
                ->groupBy('products.id')
                ->paginate(12);
        } else {
            $products = DB::table('products')
                ->select('products.*', 'images.url', 'users.name as username', 'users.id as user_id', 'categories.name as category_name', 'users.company_name as company_name', 'users.verified', 'unit.name as unitname', 'currencies.name as currency_name')
                ->Join('images', 'products.id', '=', 'images.product_id')
                ->Join('users', 'users.id', '=', 'products.user_id')
                ->Join('unit', 'unit.id', '=', 'products.unit')
                ->Join('currencies', 'currencies.id', '=', 'products.currency_id')
                ->Join('categories', 'categories.id', '=', 'products.category_id')
                ->whereIn('products.category_id', $categoryIds)
            // ->whereIn('categories.id', $cate)
                ->where('products.status', 2)
                ->whereNull('products.deleted_at')
                ->where(function ($q) use ($requestData, $word) {
                    foreach ($requestData as $field) {
                        $q->orWhere($field, 'like', "%" . $word . "%");
                    }

                })
                ->where('products.username', 'like', '%' . $by . '%')
                ->where('products.price_to', '>=', $min_price)
                ->where('products.price_to', '<=', $max_price)
                ->orderBy($column, $type)
                ->groupBy('products.id')
                ->paginate(12);
        }

        $view = view('frontend.product.sorting', compact('products'))->render();
        return response()->json($view, 200);

    }

    /**
     * Remove selected products by ajax calling.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteproductsbychoosing(Request $request)
    {
        $ids = $request->input('ids');
        if (@$ids) {
            $diff = explode(',', $ids);
            foreach ($diff as $key => $id) {
                $product = Product::where('id', $id)->delete();
            }

            return response()->json(['msg' => 'Successfully deleted!', 'status' => '200']);
        } else {
            return response()->json(['msg' => 'Please choose any items! There are not any chosen items now.', 'status' => '400']);
        }
    }

    public function approveproductsbychoosing(Request $request)
    {
        $ids = $request->input('ids');
        if (@$ids) {
            $diff = explode(',', $ids);
            foreach ($diff as $key => $id) {
                $record = Product::where('id', $id)->first();
                $record->status = 2;
                $record->update();
                $latestproduct = Bulkdeal::create([
                    'product_id' => $id,
                    'created_at' => date('y-m-d h:i:s'),
                    'updated_at' => date('y-m-d h:i:s'),
                ]);

                // $product = Product::where('id', $id)->delete();
            }

            return response()->json(['msg' => 'Successfully deleted!', 'status' => '200']);
        } else {
            return response()->json(['msg' => 'Please choose any items! There are not any chosen items now.', 'status' => '400']);
        }
    }

    /**
     * Return Ajax response category data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getcategory()
    {
        $data = [];

        //////////////////////////////////// sub-category part ////////////////////////////////////
        // $root_categorys = Category::whereNull('parent')->get();  //Get Root Categories
        // if(@$root_categorys) {
        //     foreach($root_categorys as $key => $rC) {
        //         $childs = Category::where('parent', $rC->id)->get();    //Get Child Categories by parent id
        //         $root_categorys[$key]['childs'] = $childs;  //Set sub-array in Main array
        //     }
        // }
        // $data['categorys'] = $root_categorys;
        //////////////////////////////////// sub-category part ////////////////////////////////////

        $data['categorys'] = Category::where('status', '1')->orderBy('name', 'asc')->get();
        $data['url'] = Route('product.index') . "?category=";
        echo 'r';
        exit;
        return response()->json($data);
    }

    /**
     * Return Ajax response user role infor.
     *
     * @return \Illuminate\Http\Response
     */
    public function getrole()
    {
        $userid = auth()->id();
        if (@$userid) {
            if (auth()->user()->hasRole('buyer')) {
                $role = "buyer";
            } else {
                $role = "";
            }
        } else {
            $role = "guest";
        }

        return response()->json($role);
    }

    /**
     * Return Ajax response localization settings data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getlocalizationsettings()
    {
        $localization_setting = LocalizationSetting::first();

        return response()->json($localization_setting);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myproduct()
    {
        $page = 'My Product';
        $products = Product::where('user_id', auth()->id())->where('status', '!=', '3')->orderBy('id', 'DESC')->get();
        return view('frontend.product.my', compact('products', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function create()
    {
        $userid = auth()->id();
        $user_detail = User::where('id', $userid)->first();
        if ($user_detail->company_name != '' && $user_detail->company_address != '') {
            $page = 'Add Product';
            $categories = Category::where('status', '1')->orderBy('name', 'asc')->get();
            $currencies = Currency::orderBy('Name', 'ASC')->get();
            $allcate = $this->get_options($categories);
            $product_categories = array();
            foreach ($allcate as $key => $cat) {
                $cat_id = str_replace('x', '', $key);
                $product_categories[$cat_id] = $cat;
            }
            return view('frontend.product.create', compact('categories', 'currencies', 'page', 'product_categories'));
        } else {
            return redirect()->route('account')->with('message', 'danger|Please complete your profile first before adding products!');
        }
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
            'category_id' => 'required',
            'unit_id' => 'required',
            'MOQ' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'price_from' => 'required',
            'price_to' => 'required',
            'images' => 'required',
        ]);

        $userid = auth()->id();
        $user_record = User::where('id', $userid)->first();
        $username = $user_record->name;

        $product = Product::create([
            'name' => ucwords(strtolower(request('name'))),
            'meta_title' => ucwords(strtolower(request('meta_title'))),
            'meta_description' => ucwords(strtolower(request('meta_description'))),
            'meta_keywords' => ucwords(strtolower(request('meta_keywords'))),
            'MOQ' => request('MOQ'),
            'quantity' => request('quantity'),
            'description' => request('description'),
            'user_id' => auth()->id(),
            'username' => $username,
            'price_from' => request('price_from'),
            'price_to' => request('price_to'),
            'category_id' => request('category_id'),
            'unit' => request('unit_id'),
            'slug' => $this->makeSlug(request('name')),
            'status' => "2", //testing
            'sign_date' => date('y-m-d h:i:s'),
        ]);

        $file = Input::file('images');
        $fl = $file[0];

        $filename = $fl->getClientOriginalName();

        $path = hash('sha256', time());
        if (Storage::disk('public_local')->put($path . '/' . $filename, File::get($fl))) {

            $input['url'] = $filename;
            $input['product_id'] = $product->id;
            $file = Image::create($input);

            $controller = new EmailsController;
            $array = [];
            $userid = auth()->id();
            $user = User::where('id', $userid)->first();
            $array['username'] = $user->name;
            $array['receiver_address'] = $user->email;
            $array['data'] = array('name' => $array['username'], "body" => "Thanks for your product has been recieved. It will be reviewed and approved.");
            $array['subject'] = "Successfully added product.";
            $array['sender_address'] = "solaris.dubai@gmail.com";
            $controller->save($array);

            return response()->json([
                'success' => true,
                'id' => $file->id,
            ], 200);
        }

        return response()->json([
            'success' => false,
        ], 500);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadFile(Request $request)
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

        $userid = auth()->id();
        $user_record = User::where('id', $userid)->first();
        $company_name = $user_record->company_name;
        $username = $user_record->name;
        $product = Product::create([
            'name' => ucwords(strtolower(request('name'))),
            'MOQ' => request('MOQ'),
            'description' => request('description'),
            'user_id' => auth()->id(),
            'username' => $username,
            'price_from' => request('price_from'),
            'price_to' => request('price_to'),
            'price_show' => request('product_price_show'),
            'price_fixed' => request('product_fixed_price_show'),
            'category_id' => request('category_id'),
            'currency_id' => request('currency_id'),
            'meta_title' => ucwords(strtolower(request('meta_title'))),
            'meta_description' => request('meta_description'),
            'meta_keywords' => ucwords(strtolower(request('meta_keywords'))),
            'video_link' => request('video_link'),
            'unit' => request('unit_id'),
            'slug' => $this->makeSlug(request('name')),
            'status' => "1",
            'sign_date' => date('y-m-d h:i:s'),
        ]);

        $product_link = route('product.show', $product->slug);
        $category = Category::where('id', $request->category_id)->first();
        $unit = Unit::where('id', $request->unit_id)->first();
        $categoryname = $category->name;
        $unitname = $unit->name;
        $singlefiles = Input::file('single');
        if (@request('single')) {
            $filename = $singlefiles->getClientOriginalName();
            $path = 'uploads';
            if (Storage::disk('uploads')->put($path . '/' . $filename, File::get($singlefiles))) {

                $input['url'] = $filename;
                $input['product_id'] = $product->id;
                $file = Image::create($input);
                $productimg = Product::where('id', $product->id)->first();
                $productimg->image_url = $filename;
                $productimg->save();
                $product_image = $filename;
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

        $email_template = EmailTemplates::where('email_type', 'seller_add_product')->first();
        $controller = new EmailsController;
        $array = [];
        $user = User::where('id', $userid)->first();
        $array['username'] = $user->name;
        $array['receiver_address'] = $user->email;
        $array['data'] = array(
            'name' => $array['username'],
            "body" => $email_template->email_body,
            "company_name" => $company_name,
            "product_link" => $product_link,
            "product_image" => "https://mambodubai.com/uploads/".$product_image,
            "product" => $product,
            'category' => $categoryname,
            'unitname' => $unitname
        );
        $array['subject'] = $email_template->email_subject;
        $array['sender_address'] = "solaris.dubai@gmail.com";
        $controller->addProductseller($array);

        return redirect()->route('product.my')->with('message', 'success|Product added succesfully.');
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
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $userid = auth()->id();
        $user = User::where('id', $userid)->first();
        if (!empty($user)) {
            $useremail = $user->email;
        } else {
            $useremail = '';
        }

        $product_list = Product::where('id', '!=', $product['id'])
            ->where('user_id', $product['user_id'])->where('status', 2)->orderBy(DB::raw('RAND()'))->paginate(10);
        $category_name = Category::where('id', $product['category_id'])->first();
        $product_other_category = Product::where('id', '!=', $product['id'])->where('category_id', $category_name->id)->where('status', 2)->orderBy(DB::raw('RAND()'))->paginate(10);
        $category_slug = $category_name->slug;
        $category_name = $category_name->name;
        $sellerFlag = 0;
        if ($product['user_id'] == $userid) {
            $sellerFlag = 1;
        }
        // echo auth()->user(); exit;
        $product_currency_name = Currency::where('id', $product->currency_id)->first();
        return view('frontend.product.show', compact('product', 'product_list', 'product_currency_name', 'useremail', 'category_name', 'category_slug', 'sellerFlag', 'product_other_category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
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

        $product = Product::where('slug', $slug)->first();
        $allimages = Image::where('product_id', $product->id)->get();
        return view('frontend.product.edit', compact('product', 'categories', 'currencies', 'units', 'allimages', 'product_categories', 'page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function updateupload(Request $request)
    {
       // echo '<pre>'; print_r($request->price_to); exit;
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

        $userid = auth()->id();
        $user_record = User::where('id', $userid)->first();
        $username = $user_record->name;
        if (@$request->product_id) {
            $product = Product::where('id', $request->product_id)->first();

            if (ucwords(strtolower($request->name)) == $product->name) {
                $product->name = ucwords(strtolower($request->name));
                $product->category_id = $request->category_id;
                $product->currency_id = $request->currency_id;
                $product->unit = $request->unit_id;
                $product->MOQ = $request->MOQ;
                $product->description = $request->description;
                

                $product->price_fixed = $request->product_fixed_price_show;
                //Check if price is fixed or range
                if($request->product_fixed_price_show==0){

                // Range
                $product->price_from = $request->price_from;
                $product->price_to = $request->price_to;

                }else if($request->product_fixed_price_show==1){

                    // Range
                    $product->price_to = $request->price_to_fixed;
    
                }
                
                $product->price_show = $request->product_price_show;
                
                $product->meta_title = ucwords(strtolower($request->meta_title));
                $product->meta_description = $request->meta_description;
                $product->meta_keywords = ucwords(strtolower($request->meta_keywords));
                $product->video_link = $request->video_link;
                $product->update();

            } else {
                $product->name = ucwords(strtolower($request->name));
                $product->category_id = $request->category_id;
                $product->currency_id = $request->currency_id;
                $product->unit = $request->unit_id;
                $product->MOQ = $request->MOQ;
                $product->description = $request->description;
                $product->price_fixed = $request->product_fixed_price_show;
                //Check if price is fixed or range
                if($request->product_fixed_price_show==0){

                // Range
                $product->price_from = $request->price_from;
                $product->price_to = $request->price_to;

                }else if($request->product_fixed_price_show==1){

                    // Range
                    $product->price_to = $request->price_to_fixed;
    
                }
                $product->price_show = $request->product_price_show;
                //$product->price_fixed = $request->product_fixed_price_show;
                $product->meta_title = ucwords(strtolower($request->meta_title));
                $product->meta_description = $request->meta_description;
                $product->meta_keywords = ucwords(strtolower($request->meta_keywords));
                $product->video_link = $request->video_link;
                $product->slug = $this->makeSlug(request('name'));
                $product->update();
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
        Session::flash('flash', 'Product updated succesfully');
        Session::flash('alert-class', 'alert-danger');

        return redirect()->route('product.my');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->user_id == auth()->id()) {
            $quote_product = Requests::where('product_id', $product->id)->count();
            if ($quote_product > 0) {
                $product->status = 3;
                $product->update();
            } else {
                $product->delete();
            }

        }
        Session::flash('flash', 'Product deletd succesfully');
        Session::flash('alert-class', 'alert-danger');

        return back();
    }

    public function deleteadditionalimage(Request $request)
    {
        $id = $request->id;
        if (@$id) {
            $product = Image::where('id', $id)->delete();
            return response()->json(['msg' => 'Successfully deleted!', 'status' => '200']);
        } else {
            return response()->json(['msg' => 'Please choose any items! There are not any chosen items now.', 'status' => '400']);
        }
    }

}