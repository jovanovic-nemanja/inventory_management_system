<?php

namespace App\Http\Controllers\Inventory;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Shipper;

class ShipperController extends Controller
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
        $allshipper = Shipper::all();
        return view('inventory.shipper.index', compact('allshipper'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('inventory.shipper.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shipper = Shipper::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('shipper.index')->with('message', 'success|Shipper has been successfully created');
    }


    public function edit($id)
    {
        $shipper = Shipper::where('id',$id)->first();
        return view('inventory.shipper.edit', compact('shipper'));
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

        $shipper = Shipper::where('id',$request->sup_id)->first();
        $shipper->name = $request->name;
        $shipper->email = $request->email;
        $shipper->phone = $request->phone;
        $shipper->address = $request->address;
        $shipper->update();
        return redirect()->route('shipper.index')->with('message', 'success|Shipper has successfully updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Shipper::where('id',$id)->delete();

        return redirect()->route('shipper.index')->with('message', 'success|Shipper has successfully deleted');
    }
}
