<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Posts;
use App\Product;
use App\VerifyEmailcodes;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::where('status', 2)->get();
        //        $bulk_products = DB::table('bulk_deals')
        //                ->Join('products', 'products.id', '=', 'bulk_deals.product_id')
        //                ->leftJoin('unit', 'unit.id', '=', 'products.unit')
        //                ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
        //                ->leftJoin('currencies', 'currencies.id', '=', 'products.currency_id')
        //                ->select('bulk_deals.id as bulkid', 'products.*', 'unit.name as product_unit_name', 'currencies.name as currency_name', 'categories.name as product_catgory_name')
        //                ->get();
        $bulk_products = Product::Join('bulk_deals', 'bulk_deals.product_id', '=', 'products.id')
            ->leftJoin('unit', 'unit.id', '=', 'products.unit')
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoin('currencies', 'currencies.id', '=', 'products.currency_id')
        // ->where('products.status', '=', '1')
            ->orderBy('bulk_deals.id', 'DESC')
            ->select('bulk_deals.id as bulkid', 'products.*', 'unit.name as product_unit_name', 'currencies.name as currency_name', 'categories.name as product_catgory_name')
            ->get();
        //    echo '<pre>';        print_r($bulk_products);exit;
        $main_categorys = Category::where('parent', 0)->where('status', 1)->orderBy('name', 'asc')->paginate(8);
        $sub_categorys = Category::whereRaw("parent != 0")->where('status', 1)->get();
        $essentials = Category::where('essentials', 1)->where('status', 1)->get();
        $slider_image = DB::table('slider_image')->select('*')->get();
        $blog_detail = DB::table('blog')->select('*')->get();
        $blog_detail = Posts::where('status', '1')->orderBy('id', 'DESC')->paginate(4);

        return view('frontend.home', compact('bulk_products', 'slider_image', 'main_categorys', 'sub_categorys', 'essentials', 'blog_detail', 'product'));
    }

    public function verify_check($useremail)
    {
        $products = VerifyEmailcodes::where('email', $useremail)->where('status', 1)->get();
        if (!empty($products[0])) {
            preg_match('/^.?(.*)?.@.+$/', $useremail, $matches);
            $useremail = str_replace($matches[1], str_repeat('*', strlen($matches[1])), $useremail);
            return view('frontend.accountverify', compact('useremail'));
        } else {
            return redirect()->to('/');
        }
    }

    public function aboutus()
    {
        return view('frontend.aboutus');
    }
    public function products()
    {
        return view('frontend.products');
    }
    public function howtobuy()
    {
        return view('frontend.howtobuy');
    }
    public function howtosell()
    {
        return view('frontend.howtosell');
    }
    public function ourgoal()
    {
        return view('frontend.ourgoal');
    }
    public function privacypolicy()
    {
        return view('frontend.privacypolicy');
    }
    public function termsconditions()
    {
        return view('frontend.termsconditions');
    }
    public function allcategory()
    {
        $categories = Category::where('status', '1')->orderBy('name', 'asc')->get();
        $main_categories = Category::where('parent', 0)->where('status', 1)->orderBy('name', 'asc')->paginate(8);
        $allCategories = $this->get_options($categories);
        return view('frontend.allcategory', compact('main_categories', 'categories'));
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
    public function blogdetail($postid)
    {
        $allposts = Posts::where('status', '1')->get();
        $posts = Posts::where('id', $postid)->first();
        // echo '<pre>'; print_r($posts);exit;
        return view('frontend.blogdetail', compact('posts', 'allposts'));
    }
    public function bloghome()
    {
        $allposts = Posts::where('status', '1')->get();
        // echo '<pre>'; print_r($allposts);exit;
        return view('frontend.bloghome', compact('allposts'));
    }
    public function sellerdetail($sellerid)
    {
        $sellerid = decrypt($sellerid);

        $page = 'Dashboard';
        $userdeatil = DB::table('users')
            ->Join('currencies', 'currencies.id', '=', 'users.currency')
            ->Join('countries', 'countries.id', '=', 'users.country')
            ->where('users.id', '=', $sellerid)
            ->select('users.*', 'currencies.name as currency_name', 'countries.name as country_name')
            ->get();
            $allreviews = DB::table('reviews')
            ->Join('users', 'users.id', '=', 'reviews.putter')
            ->where('reviews.receiver', '=', $sellerid)
            ->select('reviews.*','users.name as username','users.company_logo as user_image')
            ->get();
// echo '<pre>'; print_r($allreviews); exit;
        $products = Product::where('user_id', $sellerid)->where('status', 2)->orderBy('id', 'desc')->paginate(12);

        $totalProduct = count($products);
        return view('frontend.sellerdetail', compact('userdeatil', 'page', 'totalProduct', 'products','allreviews'));
    }
}
