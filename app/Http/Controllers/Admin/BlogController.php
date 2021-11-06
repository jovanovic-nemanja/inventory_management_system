<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Posts;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Posts::all();

        return view('admin.blog.index', compact('blogs'));
    }
    public function approve(Request $request, $id)
    {
        $record = Posts::where('id', $id)->get();
        $record[0]->status = 1;
        $record[0]->update();
        return redirect()->route('blog.index')->with('flash', 'Blog has been successfully approved the status');

    }
    public function deapprove(Request $request, $id)
    {
        $record = Posts::where('id', $id)->get();
        $record[0]->status = 0;
        $record[0]->update();
        return redirect()->route('blog.index')->with('flash', 'Blog has been successfully deapproved the status');

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Posts::where('id', $id)->delete();

        return redirect()->route('blog.index')->with('flash', 'Blog has successfully deleted');
    }
}