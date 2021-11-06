<?php

namespace App\Http\Controllers\Admin;

use App\Adminlogs;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $product_categories = array();
        $allcate = $this->get_options($categories);
        foreach ($allcate as $key => $cat) {
            $cat_id = str_replace('x', '', $key);
            $product_categories[$cat_id] = $cat;
        }

        return view('admin.category.create', compact('product_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'slug' => $request->slug,
            'status' => $request->status,
            'sign_date' => date('y-m-d h:i:s'),
        ]);

        $data = [];
        $data['title'] = 'Added';
        $data['description'] = 'Category Name: ' . $request->name;
        $add_logs = Adminlogs::Addlog($data);

        return redirect()->route('category.index')->with('message', 'success|Category has been successfully created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
    public function edit(Category $category)
    {
        // echo '<pre>';
        // print_r($category->parent);exit;
        $categories = Category::all();
        $product_categories = array();
        $allcate = $this->get_options($categories);
        foreach ($allcate as $key => $cat) {
            $cat_id = str_replace('x', '', $key);
            $product_categories[$cat_id] = $cat;
        }
        return view('admin.category.edit', compact('category', 'product_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $category->name = $request->name;
        $category->parent = $request->parent;
        $category->meta_title = $request->meta_title;
        $category->meta_keywords = $request->meta_keywords;
        $category->meta_description = $request->meta_description;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->save();

        $categorys = Category::all();
        $categoryIds = $this->sub_cat_id($categorys, $category['id']);
        foreach ($categoryIds as $cat_id) {

            $categorys = Category::where('id', $cat_id)->first();
            $categorys->status = $request->status;
            $categorys->update();

        }

        $data = [];
        $data['title'] = 'Updated';
        $data['description'] = 'Category Name: ' . $request->name;
        $add_logs = Adminlogs::Addlog($data);

        return redirect()->route('category.index')->with('message', 'success|Category has successfully updated');
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        $data = [];
        $data['title'] = 'Deleted';
        $data['description'] = 'Category Name: ' . $category['name'];
        $add_logs = Adminlogs::Addlog($data);

        return redirect()->route('category.index')->with('message', 'success|Category has successfully deleted');
    }
}
