<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\Mark;
use App\Productcontainer;
use App\Inventorycategory;
use App\Customerbalancelog;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $labels = Customer::get();

        return view('inventory.customer.index', compact('labels'));
    }

    public function create()
    {
        return view('inventory.customer.create');
    }
    public function edit($id)
    {
        $customer = Customer::where('id', $id)->first();
        return view('inventory.customer.edit', compact('customer'));
    }
    public function deposit($id)
    {
        $alldeposit = Customerbalancelog::where('customer_id', $id)->orderBy('created_at', 'DESC')->get();
        $customer = Customer::where('id', $id)->first();
        return view('inventory.customer.deposit', compact('customer', 'alldeposit'));
    }
    public function view($id)
    {
        $allcontainer  = Mark::where('inventory_mark.customer_id', $id)
            ->Join('inventory_container', 'inventory_container.id', '=', 'inventory_mark.container_id')
            ->select('inventory_container.containerid as con_name', 'inventory_container.id as con_id', 'inventory_mark.*')
            ->groupBy('inventory_container.containerid')
            ->get();

        $allmark  = Mark::where('inventory_mark.customer_id', $id)
            ->Join('inventory_container', 'inventory_container.id', '=', 'inventory_mark.container_id')
            ->select('inventory_mark.*', 'inventory_container.containerid as con_name')
            ->get();
        $allproduct = Productcontainer::leftJoin('inventory_mark', 'inventory_mark.id', '=', 'inventory_container_to_product.mark_add_id')
            ->leftJoin('inventory_product', 'inventory_product.id', '=', 'inventory_container_to_product.product_id')
            ->leftJoin('inventory_container_mark_add', 'inventory_container_mark_add.id', '=', 'inventory_container_to_product.mark_add_id')
            ->select('inventory_mark.*', 'inventory_product.name as product_name', 'inventory_container_to_product.price as price_value', 'inventory_container_mark_add.mark_id as all_mark_id', 'inventory_container_mark_add.mark_data as all_mark_data')
            ->get();

        $customer = Customer::where('id', $id)->first();

        return view('inventory.customer.view', compact('customer', 'allcontainer', 'allmark', 'allproduct'));
    }
    public function invoice($id)
    {
        $allcontainer  = Mark::where('inventory_mark.customer_id', $id)
            ->Join('inventory_container', 'inventory_container.id', '=', 'inventory_mark.container_id')
            ->select('inventory_container.containerid as con_name', 'inventory_container.id as con_id', 'inventory_mark.*')
            ->groupBy('inventory_container.containerid')
            ->get();

        $allmark  = Mark::where('inventory_mark.customer_id', $id)
            ->Join('inventory_container', 'inventory_container.id', '=', 'inventory_mark.container_id')
            ->select('inventory_mark.*', 'inventory_container.containerid as con_name')
            ->get();
        $allproduct = Productcontainer::leftJoin('inventory_mark', 'inventory_mark.id', '=', 'inventory_container_to_product.mark_add_id')
            ->leftJoin('inventory_product', 'inventory_product.id', '=', 'inventory_container_to_product.product_id')
            ->leftJoin('inventory_container_mark_add', 'inventory_container_mark_add.id', '=', 'inventory_container_to_product.mark_add_id')
            ->select('inventory_mark.*', 'inventory_product.name as product_name', 'inventory_container_to_product.price as price_value', 'inventory_container_mark_add.mark_id as all_mark_id', 'inventory_container_mark_add.mark_data as all_mark_data')
            ->get();

        $customer = Customer::where('id', $id)->first();

        return view('inventory.customer.invoice', compact('customer', 'allcontainer', 'allmark', 'allproduct'));
    }
    public function consolidate($id, $con_id)
    {
        $allcontainer  = Mark::where('inventory_mark.customer_id', $id)
            ->where('inventory_mark.container_id', $con_id)
            ->Join('inventory_container', 'inventory_container.id', '=', 'inventory_mark.container_id')
            ->select('inventory_container.containerid as con_name', 'inventory_container.id as con_id', 'inventory_mark.*')
            ->groupBy('inventory_container.containerid')
            ->get();
        $allcategory  = Inventorycategory::get();
        $allmark  = Mark::Join('inventory_container', 'inventory_container.id', '=', 'inventory_mark.container_id')
        ->where('inventory_mark.container_id', $con_id)
        ->where('inventory_mark.customer_id', $id)
            ->select('inventory_mark.id','inventory_mark.name')
            ->get()->toArray();
        $allproduct = Productcontainer::Join('inventory_container_mark_add', 'inventory_container_mark_add.id', '=', 'inventory_container_to_product.mark_add_id')
            ->leftJoin('inventory_product', 'inventory_product.id', '=', 'inventory_container_to_product.product_id')
            ->leftJoin('inventory_categories', 'inventory_categories.id', '=', 'inventory_product.category')
            ->leftJoin('inventory_units', 'inventory_units.id', '=', 'inventory_product.unit')
            // ->leftJoin('inventory_container_mark_add', 'inventory_container_mark_add.id', '=', 'inventory_container_to_product.mark_add_id')
            // ->where('inventory_mark.customer_id', $id)
            // ->where('inventory_container_to_product.container_id', $con_id)
            // ->select('inventory_container_mark_add.*') 
            ->select('inventory_container_mark_add.*', 'inventory_container_to_product.*','inventory_units.name as unit_name', 'inventory_categories.id as category_id', 'inventory_categories.name as category_name', 'inventory_product.stock', 'inventory_product.name as product_name', 'inventory_container_to_product.price as price_value', 'inventory_container_mark_add.mark_id as all_mark_id', 'inventory_container_mark_add.mark_data as all_mark_data')
            ->get();
        // echo '<pre>'; print_r($allproduct); exit;
        $customer = Customer::where('id', $id)->first();

        return view('inventory.customer.consolidate', compact('customer', 'allcontainer', 'allmark', 'allproduct', 'allcategory'));
    }
    public function update(Request $request)
    {

        // echo '<pre>'; print_r($request->all()); exit;
        $category = Customer::where('id', $request->customer_id)->first();
        if (isset($request->deposit_balance)) {
            $category->name = $request->name;
            $category->email = $request->email;
            $category->phone = $request->phone;
            $category->balance = $request->balance;
            $category->current_balance = $request->balance + $request->deposit_balance;

            $category->save();
            $id = $category->id;

            Customerbalancelog::create([
                'customer_id' => $id,
                'current_balance' => $request->balance,
                'deposit_balance' => $request->deposit_balance,
                'deposit_date' => $request->deposit_date,
                'remarks' => $request->remarks

            ]);
            return redirect()->route('customer.index')->with('message', 'success|Customer has been successfully depost amount');
        } else {
            $category->name = $request->name;
            $category->email = $request->email;
            $category->phone = $request->phone;
            $category->balance = $request->balance;
            $category->current_balance = $request->balance;
            $category->save();
            return redirect()->route('customer.index')->with('message', 'success|Customer has been successfully updated');
        }
    }

    public function store(Request $request)
    {
        $category = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'balance' => $request->balance,
            'current_balance' => $request->balance,
        ]);

        return redirect()->route('customer.index')->with('message', 'success|Customer has been successfully created');
    }
    public function delete_customer($id)
    {
        if (@$id) {
            $product = Customer::where('id', $id)->delete();
            return redirect()->route('customer.index')->with('message', 'success|Customer has successfully deleted');
        }
    }
    public function downloadExcel($type)

    {
        $data = DB::table('inventory_customer_balance_log')
            ->select('inventory_customer_balance_log.deposit_balance as Deposit Balance', 'inventory_customer_balance_log.deposit_date as Deposit Date', 'inventory_customer_balance_log.remarks as Remarks')
            ->get();
        $data = json_decode(json_encode($data), true);
        if (empty($data) && $type == 'csv') {
            $data = array('0' => 'Deposit Balance', '1' => 'Deposit Date', '2' => 'Remarks');
        }
        return Excel::create('Customer Balance Leadger', function ($excel) use ($data) {
            $excel->sheet('products', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
}
