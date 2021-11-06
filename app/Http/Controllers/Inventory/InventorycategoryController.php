<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Inventorycategory;

class InventorycategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $inventorycategory = Inventorycategory::get();

        return view('inventory.inventorycategory.index',compact('inventorycategory') );
    }

    public function create()
    {
        return view('inventory.inventorycategory.create');
    }
    public function edit($id)
    {
        $category = Inventorycategory::where('id',$id)->first();
        return view('inventory.inventorycategory.edit', compact('category'));
    }
    public function update(Request $request)
    {
        $category = Inventorycategory::where('id', $request->cat_id)->first();
        $category->name = ucwords(strtolower($request->name));
        $category->update();
        return redirect()->route('inventorycategory.index')->with('message', 'success|Category has been successfully updated');
    }
    public function store(Request $request)
    {
        $category = Inventorycategory::create([
            'name' => $request->name,
        ]);

        return redirect()->route('inventorycategory.index')->with('message', 'success|Unit has been successfully created');
    }
    public function delete_cat($id)
    {
        // echo '<pre>'; print_r($id); exit;
        if (@$id) {
            $product = Inventorycategory::where('id', $id)->delete();
            return redirect()->route('inventorycategory.index')->with('message', 'success|Category has successfully deleted');
        }
    }
}
