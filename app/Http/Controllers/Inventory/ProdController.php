<?php

namespace App\Http\Controllers\Inventory;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Prod;
use App\Inventoryunit;
use App\Inventorycategory;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Session;
use App\Purchase;
use App\Purchaseproducts;
use App\Productdistribution;


class ProdController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        // $prods = Prod::get();
        $prods = DB::table('inventory_product')
            ->select('inventory_product.*', 'inventory_units.name as unit', 'inventory_categories.name as category')
            ->Join('inventory_units', 'inventory_units.id', '=', 'inventory_product.unit')
            ->Join('inventory_categories', 'inventory_categories.id', '=', 'inventory_product.category')
            ->get();
        return view('inventory.prod.index', compact('prods'));
    }

    public function create()
    {

        $allunits = Inventoryunit::get();
        $allcategory = Inventorycategory::get();
        return view('inventory.prod.create', compact('allunits', 'allcategory'));
    }
    public function edit($id)
    {
        $prods = Prod::where('id', $id)->first();
        $allunits = Inventoryunit::get();
        $allcategory = Inventorycategory::get();
        return view('inventory.prod.edit', compact('allunits', 'allcategory', 'prods'));
    }
    public function view($id)
    {
        $product_name = Prod::where('id', $id)->first();
        $initial_stock1  = DB::table('inventory_purchase_product')->where('product', $id)->first();

        $distribution_stock = Productdistribution::where('product_id', $id)->first();
        if (isset($initial_stock1->old_stock)) {
            $initial_stock = $initial_stock1->old_stock;
            $initial_date = $initial_stock1->created_at;
        } elseif (isset($initial_stock1->initial_stock)) {
            $initial_stock = $distribution_stock->initial_stock;
            $initial_date = $distribution_stock->created_at;
        } else {
            $initial_stock = $product_name->stock;
            $initial_date = $product_name->created_at;
        }
        $purchase  = DB::table('inventory_product')
            ->select('inventory_product.*',  'inventory_supplier.name as supplier_name', 'inventory_purchase_product.old_stock as old_stock', 'inventory_purchase_product.created_at as date', 'inventory_purchase_product.item as after_stock', 'inventory_purchase_product.price as price')
            ->Join('inventory_purchase_product', 'inventory_purchase_product.product', '=', 'inventory_product.id')
            ->Join('inventory_supplier', 'inventory_supplier.id', '=', 'inventory_purchase_product.supplier')
            ->where('inventory_purchase_product.product', $id)
            ->get();

        $distribution  = DB::table('inventory_product')
            ->select('inventory_product.*', 'inventory_container_batch.id as batch_id', 'inventory_container_batch.name as batch_name', 'inventory_product_distribution.after_stock as after_stock', 'inventory_product_distribution.created_at as date', 'inventory_product_distribution.item as item', 'inventory_product_distribution.price as price')
            ->Join('inventory_product_distribution', 'inventory_product_distribution.product_id', '=', 'inventory_product.id')
            ->Join('inventory_container_batch', 'inventory_container_batch.id', '=', 'inventory_product_distribution.batch_id')
            ->where('inventory_product_distribution.product_id', $id)
            ->get();
        return view('inventory.prod.view', compact('purchase', 'distribution', 'product_name', 'initial_stock','initial_date'));
    }
    public function update(Request $request)
    {
        $product = Prod::where('id', $request->prod_id)->first();
        $product->name = ucwords(strtolower($request->name));
        $product->category = $request->category;
        $product->stock = $request->stock;
        $product->update();
        return redirect()->route('prod.index')->with('message', 'success|Product has been successfully updated');
    }
    public function updatemanually(Request $request)
    {
        $product = Prod::where('id', $request->prod_id)->first();
        $old_stock = $product->stock;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->reason = $request->reason;
        $product->update();
        if ($request->stock > $old_stock) {
            $category = Purchase::create([
                'purchase_order_id' => 0,
                'supplier' => 0,
                'category' => 0,
                'product' => $request->prod_id,
                'item' => $request->stock - $old_stock,
                'old_stock' => $old_stock,
                'price' => $request->price,
                'total' => 0,
            ]);
        } elseif ($request->stock < $old_stock) {
            Productdistribution::create([
                'product_id' => $request->prod_id,
                'container_id' => 0,
                'initial_stock' => $old_stock,
                'item' => $old_stock - $request->stock,
                'cost' => 0,
                'price' => $request->price,
                'after_stock' => $request->stock
            ]);
        }
        return redirect()->route('prod.index')->with('message', 'success|Product has been successfully updated');
    }
    public function store(Request $request)
    {
        $category = Prod::create([
            'name' => $request->name,
            'unit' => $request->unit,
            'category' => $request->category,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        return redirect()->route('prod.index')->with('message', 'success|Product has been successfully created');
    }
    public function delete_prod($id)
    {
        if (@$id) {
            $product = Prod::where('id', $id)->delete();
            return redirect()->route('prod.index')->with('message', 'success|Product has successfully deleted');
        }
    }
    public function deleteall(Request $request)
    {
        $ids = $request->input('ids');
        if (@$ids) {
            $diff = explode(',', $ids);
            foreach ($diff as $key => $id) {
                $product = Prod::where('id', $id)->delete();
            }
            Session::flash('flash', 'Product has successfully deleted');
            Session::flash('alert-class', 'alert-danger');
            return response()->json(['msg' => 'Product has successfully deleted!', 'status' => '200']);
        } else {
            return response()->json(['msg' => 'Please choose any items! There are not any chosen items now.', 'status' => '400']);
        }
    }
    public function importExport()

    {
        return view('inventory.prod.importexport');
    }

    public function downloadExcel($type)

    {
        $data = DB::table('inventory_product')
            ->Join('inventory_categories', 'inventory_product.category', '=', 'inventory_categories.id')
            ->Join('inventory_units', 'inventory_product.unit', '=', 'inventory_units.id')
            ->select('inventory_product.name as name', 'inventory_categories.name as category', 'inventory_units.name as unit', 'inventory_product.stock as stock', 'inventory_product.price as price')
            ->get();
        $data = json_decode(json_encode($data), true);
        if (empty($data) && $type == 'csv') {
            $data = array('0' => 'name', '1' => 'category', '2' => 'unit', '3' => 'stock', '4' => 'price');
        }
        return Excel::create('product_list', function ($excel) use ($data) {
            $excel->sheet('products', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }


    public function importExcel(Request $request)

    {
        $request->validate([

            'import_file' => 'required'
        ]);
        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path, function ($reader) {
            $reader->ignoreEmpty();
        })->get()->toArray();
        $data = array_filter($data);
        $all_cat = DB::table('inventory_categories')->select('*')->get();
        $all_unit = DB::table('inventory_units')->select('*')->get();

        if (sizeof($data) > 0) {
            foreach ($data as $value) {
                foreach ($all_cat as $cat) {
                    if ($cat->name == $value['category']) {
                        $category = $cat->id;
                    }
                }
                foreach ($all_unit as $unt) {
                    if ($unt->name == $value['unit']) {
                        $unit = $unt->id;
                    }
                }
                $arr[] = [
                    'name' => $value['name'],
                    'unit' => $unit,
                    'category' => $category,
                    'stock' =>  $value['stock'],
                    'price' => $value['price'],
                ];
            }
            if (!empty($arr)) {
                Prod::insert($arr);
            }
        }
        return redirect()->route('prod.index')->with('message', 'success|Product has successfully imported .');
    }
}
