<?php

namespace App\Http\Controllers\Inventory;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
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
        $allsupplier = Supplier::whereNotIn('id', [0])->get();
        return view('inventory.supplier.index', compact('allsupplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('inventory.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Supplier::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'trn_no' => $request->trn_no,
        ]);

        return redirect()->route('supplier.index')->with('message', 'success|Supplier has been successfully created');
    }


    public function edit($id)
    {
        $supplier = Supplier::where('id',$id)->first();
        return view('inventory.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $supplier = Supplier::where('id',$request->sup_id)->first();
        $supplier->name = $request->name;
        $supplier->phone = $request->phone;
        $supplier->trn_no = $request->trn_no;
        $supplier->update();
        return redirect()->route('supplier.index')->with('message', 'success|Supplier has successfully updated');
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
    public function delete($id)
    {
        Supplier::where('id',$id)->delete();

        return redirect()->route('supplier.index')->with('message', 'success|Supplier has successfully deleted');
    }
}
