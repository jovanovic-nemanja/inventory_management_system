<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Label;
use App\Customer;
use Illuminate\Http\Request;

class LabelController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    public function index()
    {
        $labels = Label::get();

        return view('inventory.label.index',compact('labels') );
    }

    public function create()
    {
        
        $customers = Customer::get();
        return view('inventory.label.create',compact('labels','customers') );
    }
    public function store(Request $request)
    {
        $category = Label::create([
            'name' => $request->name,
            'customer_id' => $request->customer_id,
        ]);

        return redirect()->route('inventory.index')->with('message', 'success|Label has been successfully created');
    }
}
