<?php

namespace App\Http\Controllers\Inventory;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Consignee;

class ConsigneeController extends Controller
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
        $allshipper = Consignee::all();
        return view('inventory.consignee.index', compact('allshipper'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('inventory.consignee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shipper = Consignee::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('consignee.index')->with('message', 'success|Consignee has been successfully created');
    }


    public function edit($id)
    {
        $consignee = Consignee::where('id',$id)->first();
        return view('inventory.consignee.edit', compact('consignee'));
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

        $shipper = Consignee::where('id',$request->con_id)->first();
        $shipper->name = $request->name;
        $shipper->email = $request->email;
        $shipper->phone = $request->phone;
        $shipper->address = $request->address;
        $shipper->update();
        return redirect()->route('consignee.index')->with('message', 'success|Consignee has successfully updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Consignee::where('id',$id)->delete();

        return redirect()->route('consignee.index')->with('message', 'success|Consignee has successfully deleted');
    }
}
