<?php

namespace App\Http\Controllers\Blog;

use App\Blogcategory;
use App\Http\Controllers\Controller;
use App\Image;
use App\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsController extends Controller
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
        $allposts = Posts::all();
        return view('blog.posts.index', compact('allposts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allcategories = Blogcategory::all();
        return view('blog.posts.create', compact('allcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo  '<pre>'; print_r($request->all());exit;
        $post = Posts::create([
            'title' => $request->title,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'meta_description' => $request->meta_description,
            'category_id' => $request->parent,
        ]);
        $singlefiles = Input::file('image');
        if (@request('image')) {
            $filename = $singlefiles->getClientOriginalName();
            $extention = File::extension($filename);
            $filename = 'blogpost_image_' . $post->id . '.' . $extention;
            $path = 'uploads';
            if (Storage::disk('uploads')->put($path . '/' . $filename, File::get($singlefiles))) {
                $productimg = Posts::where('id', $post->id)->first();
                $productimg->image = $filename;
                $productimg->save();
            }
        }

        return redirect()->route('blog.posts')->with('flash', 'Category has been successfully created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $category)
    {
        $allcategories = Blogcategory::all();
        return view('blog.posts.edit', compact('category', 'allcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $category)
    {
        $category->title = $request->title;
        $category->meta_title = $request->meta_title;
        $category->meta_keywords = $request->meta_keywords;
        $category->meta_description = $request->meta_description;
        $category->slug = Str::slug($request->title);
        $category->description = $request->description;
        $category->category_id = $request->category_id;
        $category->save();
        $singlefiles = Input::file('image');
        if (@request('image')) {
            $filename = $singlefiles->getClientOriginalName();
            $extention = File::extension($filename);
            $filename = 'blogpost_image_' . $category->id . '.' . $extention;
            $path = 'uploads';
            if (Storage::disk('uploads')->put($path . '/' . $filename, File::get($singlefiles))) {
                $productimg = Posts::where('id', $category->id)->first();
                $productimg->image = $filename;
                $productimg->save();
            }
        }
        return redirect()->route('blog.posts')->with('flash', 'Posts has successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $category)
    {
        $category->delete();

        return redirect()->route('blog.posts')->with('flash', 'Post has successfully deleted');
    }
}