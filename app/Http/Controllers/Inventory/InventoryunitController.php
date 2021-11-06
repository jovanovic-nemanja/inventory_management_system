<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Inventoryunit;

class InventoryunitController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $inventoryunits = Inventoryunit::get();
        // echo '<pre>'; print_r($units); exit;

        return view('inventory.inventoryunit.index',compact('inventoryunits') );
    }

    public function create()
    {
        return view('inventory.inventoryunit.create');
    }
    public function edit($id)
    {
        $unit = Inventoryunit::where('id',$id)->first();
        return view('inventory.inventoryunit.edit', compact('unit'));
    }
    public function update(Request $request)
    {
        $category = Inventoryunit::where('id', $request->unit_id)->first();
        $category->name = ucwords(strtolower($request->name));
        $category->update();
        return redirect()->route('inventoryunit.index')->with('message', 'success|Unit has been successfully updated');
    }
    public function store(Request $request)
    {
        $category = Inventoryunit::create([
            'name' => $request->name,
        ]);

        return redirect()->route('inventoryunit.index')->with('message', 'success|Unit has been successfully created');
    }
    public function delete_unit($id)
    {
        if (@$id) {
            $product = Inventoryunit::where('id', $id)->delete();
            return redirect()->route('inventoryunit.index')->with('message', 'success|Unit has successfully deleted');
        }
    }
}
