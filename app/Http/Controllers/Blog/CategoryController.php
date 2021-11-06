<?php

namespace App\Http\Controllers\Blog;

use App\Blogcategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'blog']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Blogcategory::all();
        return view('blog.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allcategories = Blogcategory::all();
        return view('blog.category.create', compact('allcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Blogcategory::create([
            'title' => $request->title,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'parent' => $request->parent,
            'meta_description' => $request->meta_description,
            'description' => $request->description,
            'slug' => Str::slug($request->title),
        ]);

        $data = [];
        $data['title'] = 'Added';
        $data['description'] = 'Category Name: ' . $request->name;

        return redirect()->route('blog.category')->with('flash', 'Category has been successfully created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blogcategory $category)
    {
        $allcategories = Blogcategory::all();
        return view('blog.category.edit', compact('category', 'allcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blogcategory $category)
    {
        $category->title = $request->title;
        $category->meta_title = $request->meta_title;
        $category->meta_keyword = $request->meta_keyword;
        $category->parent = $request->parent;
        $category->meta_description = $request->meta_description;
        $category->slug = Str::slug($request->title);
        $category->description = $request->description;
        $category->save();
        return redirect()->route('blog.category')->with('flash', 'Category has successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blogcategory $category)
    {
        $category->delete();

        return redirect()->route('blog.category')->with('flash', 'Category has successfully deleted');
    }
}