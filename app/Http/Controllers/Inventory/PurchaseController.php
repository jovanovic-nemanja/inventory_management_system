<?php

namespace App\Http\Controllers\Inventory;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Prod;
use App\Inventorycategory;
use App\Supplier;
use App\Purchase;
use App\Purchaseproducts;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
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
        $allpurchase = Purchase::all();
        $allpurchase = DB::table('inventory_purchase_order')
            ->join('inventory_supplier', 'inventory_supplier.id', '=', 'inventory_purchase_order.supplier_id')
            ->select('inventory_purchase_order.*', 'inventory_supplier.name as supplier_name')
            ->get();
        return view('inventory.purchase.index', compact('allpurchase'));
    }

    public function view($id)
    {
        $purchase_detail = Purchaseproducts::where('id', $id)->first();
        $allpurchase = Purchase::where('supplier', $purchase_detail->supplier_id)->get();
        $allsupplier = Supplier::all();
        $allprod = Prod::all();
        $allcategory = Inventorycategory::all();
        return view('inventory.purchase.view', compact('allsupplier', 'allprod', 'allcategory', 'purchase_detail', 'allpurchase'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $allsupplier = Supplier::whereNotIn('id', [0])->get();
        $allprod = Prod::all();
        $allcategory = Inventorycategory::all();
        return view('inventory.purchase.create', compact('allsupplier', 'allprod', 'allcategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchaseproducts = Purchaseproducts::create([
            'supplier_id' => $request->supplier_id,
            'purchase_order' => $request->purchase_order,
            'purchase_reference' => $request->purchase_reference,
            'created_at' => $request->created_at
        ]);
        $porder = $purchaseproducts->id;

        for ($i = 0; $i < sizeof($request->category_id); $i++) {
            $prodUpdate = Prod::where('id',  $request->product_id[$i])->first();
            $old_stock = $prodUpdate->stock;
            $prodUpdate->stock = $prodUpdate->stock + $request->item[$i];
            $prodUpdate->price = $request->price[$i];
            $prodUpdate->update();

            $category = Purchase::create([
                'purchase_order_id' => $porder,
                'supplier' => $request->supplier_id,
                'category' => $request->category_id[$i],
                'product' => $request->product_id[$i],
                'item' => $request->item[$i],
                'old_stock' => $old_stock,
                'price' => $request->price[$i],
                'vat' => $request->vat[$i],
                'total' => $request->total[$i],
            ]);
        }

        return redirect()->route('purchase.index')->with('message', 'success|Purchase has been successfully created');
    }


    public function edit($id)
    {
        $purchase_detail = Purchaseproducts::where('id', $id)->first();
        $allpurchase = Purchase::where('inventory_purchase_product.purchase_order_id', $purchase_detail->id)
        ->join('inventory_product','inventory_product.id','=','inventory_purchase_product.product')
        ->join('inventory_categories','inventory_categories.id','=','inventory_purchase_product.category')
        ->join('inventory_units','inventory_units.id','=','inventory_product.unit')
        ->select('inventory_purchase_product.*','inventory_product.name as product_name','inventory_categories.name as category_name','inventory_units.name as unit_name')
        ->get();
        // echo '<pre>'; print_r($allpurchase); exit;
        $allsupplier = Supplier::whereNotIn('id', [0])->get();
        $allprod = Prod::all();
        $allcategory = Inventorycategory::all();
        return view('inventory.purchase.edit', compact('allsupplier', 'allprod', 'allcategory', 'purchase_detail', 'allpurchase'));
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

        $purchaseprod = Purchaseproducts::where('id', $request->pur_ord_id)->first();

        $purchaseprod->supplier_id = $request->supplier_id;
        $purchaseprod->save();

        $Pur = Purchase::where('purchase_order_id', $request->pur_ord_id)->first();
        $Pur->supplier = $request->supplier_id;
        $Pur->save();
        // echo '<pre>'; print_r($request->product_id[0]); exit;
        // $loopNo = sizeof($request->category_id);
        // $productId = Purchase::where('supplier', $request->supplier_id)->select('product')->get()->toArray();
        // $productId = array_column($productId, 'product');
        // $supplier = Purchase::where('supplier', $request->supplier_id)->get()->toArray();
        // for ($i = 0; $i < $loopNo; $i++) {
        //     if (in_array($request->product_id[$i], $productId)) {
        //         $purchaseUpdate = Purchase::where('supplier', $request->supplier_id)->where('product', $request->product_id[$i])->get();
        //         echo '<pre>';
        //         print_r($request->item[$i]);
        //         exit;
        //         $purchaseUpdate->item = $request->item[$i];
        //         $purchaseUpdate->price = $request->price[$i];
        //         $purchaseUpdate->total = $request->total[$i];
        //         $purchaseUpdate->update();
        //     } else {
        //         Purchase::create([
        //             'supplier' => $request->supplier_id,
        //             'category' => $request->category_id[$i],
        //             'product' => $request->product_id[$i],
        //             'item' => $request->item[$i],
        //             'price' => $request->price[$i],
        //             'total' => $request->total[$i],
        //         ]);
        //     }
        // }
        return redirect()->route('purchase.index')->with('message', 'success|Purchase has successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // Purchase::where('id', $id)->delete();

        return redirect()->route('purchase.index')->with('message', 'success|Purchase has successfully deleted');
    }
    public function ajax_cat_prod($id)
    {
        $allproducts = Prod::where('category', $id)->get();
        return $allproducts;
    }
    public function ajax_prod($id)
    {
        $allproducts = Prod::where('inventory_product.id', $id)->join('inventory_units', 'inventory_product.unit', '=', 'inventory_units.id')
            ->select('inventory_units.name as unitname', 'inventory_product.*')
            ->first();
        return $allproducts;
    }
}
