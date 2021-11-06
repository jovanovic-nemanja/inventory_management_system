<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Filters\ProductFilters;
use App\Http\Controllers\Controller;
use App\Product;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth')->except(['index', 'show', 'getcategory', 'getlocalizationsettings', 'getproductsbyfilter', 'getrole', 'deleteproductsbychoosing']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductFilters $filters, Request $request)
    {
        $page = 'Dashboard';
        $categories = Product::latest()->filter($filters)->where('status', 2)->paginate(15);
        $categorys = Category::where('status', '1')->orderBy('name', 'asc')->get();
        $category = Category::where('slug', $request['category'])->first();
        if (!empty($category)) {
            $cat_name = $category['name'];
        } else {
            $cat_name = '';
        }
        $units = Unit::all();
        $count = count($categories);
        $arrs = 'all';
        foreach ($categorys as $cate) {
            if (@$cate['meta_keywords']) {
                $arrs = $arrs . ", " . $cate->meta_keywords;
            }
        }
//        echo '<pre>'; print_r($categories);exit;

        return view('frontend.dashboard.index', compact('categories', 'categorys', 'category', 'count', 'units', 'arrs', 'cat_name', 'page'));
    }

}