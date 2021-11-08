<?php

namespace App\Http\Controllers\Inventory;

use App\Container;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Inventorycategory;
use App\Mark;
use App\Prod;
use App\Productcontainer;
use App\Productmarkcontainer;
use App\Containerdetail;
use App\Batch;
use App\Consignee;
use App\Productdistribution;
use App\Shipper;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContainerController extends Controller
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
        $allcontainer = Container::whereNotIn('inventory_container.id', [0])
            ->join('inventory_shipper', 'inventory_shipper.id', '=', 'inventory_container.shipper_info')
            ->join('inventory_container_batch', 'inventory_container_batch.id', '=', 'inventory_container.container_batch')
            ->select('inventory_container.*', 'inventory_shipper.name as shipper_name', 'inventory_container_batch.name as batch_name')
            ->get();
        return view('inventory.container.index', compact('allcontainer'));
    }
    public function create()
    {
        $allcontainerdetail = Containerdetail::get();
        $allshipper = Shipper::get();
        $allconsignee = Consignee::get();
        $allcustomers = Customer::get();
        $allproducts = Prod::get();
        $allbatch = Batch::all();
        $allcategory = Inventorycategory::get();
        return view('inventory.container.create', compact('allcustomers', 'allproducts', 'allcategory', 'allcontainerdetail', 'allbatch', 'allshipper', 'allconsignee'));
    }
    public function edit($id)
    {
        $container_detail = Container::where('id', $id)->first();
        $allcontainerdetail = Containerdetail::get();
        // $cus_no = Mark::where('container_id', $id)->distinct()->get('customer_id');
        $cus_no = DB::table('inventory_mark')
            ->where('container_id', $id)
            ->select('customer_id')
            ->distinct()
            ->get();
        $con_cus = Mark::where('container_id', $id)->get();
        $allshipper = Shipper::get();
        $allconsignee = Consignee::get();
        $allcustomers = Customer::get();
        $allproducts = Prod::get();
        $allbatch = Batch::all();
        $allcategory = Inventorycategory::get();

        return view('inventory.container.edit', compact('container_detail', 'allcustomers', 'allproducts', 'allshipper', 'allconsignee', 'allcategory', 'con_cus', 'cus_no', 'allbatch', 'allcontainerdetail'));
    }
    public function store(Request $request)
    {
        $container = Container::create([
            'containerid' => $request->container_id,
            'container_batch' => $request->container_batch,
            'shipper_info' => $request->shipper_info,
            'notify_info' => $request->notify_info,
            'port_loading' => $request->port_loading,
            'container_number' => $request->container_number,
            'bill_loading' => $request->bill_loading,
            'consignee_info' => $request->consignee_info,
            'vessel_no' => $request->vessel_no,
            'port_discharge' => $request->port_discharge,
        ]);
        $container_id = $container->id;
        $customer_no = sizeof($request->customer_id);
        foreach ($request->customer_id as $customer) {
            $chk = 'mark_' . $customer_no;
            $marks = $request->$chk;
            foreach ($marks as $mark) {
                $container = Mark::create([
                    'name' => $mark,
                    'batch_id' => $request->container_batch,
                    'container_id' => $container_id,
                    'customer_id' => $customer,
                ]);
            }
            $customer_no = $customer_no - 1;
        }

        return redirect()->route('container.index')->with('message', 'success|Container has been successfully created');
    }
    public function update(Request $request)
    {

        $container = Container::where('id', $request->con_id)->first();
        $container->containerid = $request->container_id;
        $container->container_batch = $request->container_batch;
        $container->shipper_info = $request->shipper_info;
        $container->notify_info = $request->notify_info;
        $container->port_loading = $request->port_loading;
        $container->container_number = $request->container_number;
        $container->bill_loading = $request->bill_loading;
        $container->consignee_info = $request->consignee_info;
        $container->vessel_no = $request->vessel_no;
        $container->port_discharge = $request->port_discharge;
        $container->update();
        $customer_no = sizeof($request->customer_id);
        // echo '<pre>';  print_r($request->all()); exit;
        foreach ($request->customer_id as $customer) {
            $chk = 'mark_' . $customer_no;

            $marks = $request->$chk;
            foreach ($marks as $key => $mark) {
                $chk1 = 'markid_' . $customer_no;
                $markid = $request->$chk1;
                if (isset($markid[$key])) {
                    $updatemark = Mark::where('id', $markid[$key])->first();
                    // echo '<pre>';  print_r($mark); exit;
                    $updatemark->name = $mark;
                    $updatemark->batch_id = $request->container_batch;
                    $updatemark->container_id = $request->con_id;
                    $updatemark->customer_id = $customer;
                    $updatemark->update();
                } else {
                    $insertmark = Mark::create([
                        'name' => $mark,
                        'batch_id' => $request->container_batch,
                        'container_id' => $request->con_id,
                        'customer_id' => $customer,
                    ]);
                }
            }
            $customer_no = $customer_no - 1;
        }

        return redirect()->route('container.index')->with('message', 'success|Container has been successfully Updated');
    }
    public function delete_container($id)
    {
        if (@$id) {
            $product = Container::where('id', $id)->delete();
            return redirect()->route('container.index')->with('message', 'success|Container has successfully deleted');
        }
    }

    public function addProduct($id)
    {

        $container_detail = Container::where('id', $id)->first();
        $allcustomers = Customer::get();
        $allproducts = Prod::get();
        $allcategory = Inventorycategory::get();
        $allmark = Mark::where('container_id', $id)->get();
        $allmarkdetail = Productmarkcontainer::where('container_id', $id)->get()->toArray();
        $allproductdetail = Productcontainer::where('container_id', $id)
            ->join('inventory_product', 'inventory_product.id', '=', 'inventory_container_to_product.product_id')
            ->select('inventory_container_to_product.*', 'inventory_product.name as product_name')
            ->get();
        $cus_no = DB::table('inventory_mark')
            ->join('inventory_customer', 'inventory_customer.id', '=', 'inventory_mark.customer_id')
            ->where('inventory_mark.container_id', $id)
            ->select('inventory_customer.id as cus_id', 'inventory_customer.name as cus_name')
            ->distinct()
            ->get();
        // echo '<pre>'; print_r($allproductdetail); exit;
        if (sizeof($allproductdetail) <= 0) {
            return view('inventory.container.addproduct', compact('allcustomers', 'cus_no', 'container_detail', 'allmarkdetail', 'allproducts', 'allcategory', 'allmark'));
        } else {
            $allprod = Prod::whereNotIn('id', function($query){
                $query->select('product_id')->from(with(new Productcontainer)->getTable());})  
                ->select('id as product_id','category as category_id','stock as initial_stock','price as cost','price as price','stock as after_stock','name as product_name',)
                ->get();
            // echo '<pre>'; print_r(sizeof($allproductdetail)); exit;
$allproductdetail = $allproductdetail->merge($allprod);
            // echo '<pre>'; print_r($allproductdetail); exit;
            return view('inventory.container.editproduct', compact('allcustomers', 'allproductdetail', 'cus_no', 'container_detail', 'allmarkdetail', 'allproducts', 'allcategory', 'allmark'));
        }
    }
    public function storeProduct(Request $request)
    {
        $allmark = Mark::where('container_id', $request['container_id'])->get()->count();
        $makrId = Mark::where('container_id', $request['container_id'])->select('id')->get()->toArray();
        $allproducts = Prod::count();
        $loopNo = $allmark * $allproducts;
        $markData = array();
        $prd = 1;
       
        for ($inc = 1; $inc <= $loopNo; $inc++) {
            $markData[] = $request['mark_' . $inc];
            if ($inc % $allmark == 0) {
                $markVal = json_encode($markData);
                if ($prd <= $allproducts) {
                    if(isset($request['prodName'][$prd - 1])){
                    $containerChk = Productcontainer::where('product_id', $request['prodName'][$prd - 1])->where('container_id', $request['container_id'])->first();
                    

                    if (empty($containerChk)) {
                        $markcontainer = Productmarkcontainer::create([
                            'mark_id' => json_encode($makrId),
                            'mark_data' => json_encode($markData),
                            'container_id' => $request['container_id']
                        ]);
                        $markcontainer = $markcontainer->id;
                        $container = Productcontainer::create([
                            'product_id' => $request['prodName'][$prd - 1],
                            'category_id' => $request['cat_id'][$prd - 1],
                            'initial_stock' => $request['initial_stock'][$prd - 1],
                            'cost' => $request['cost'][$prd - 1],
                            'price' => $request['price'][$prd - 1],
                            'after_stock' => $request['stock'][$prd - 1],
                            'container_id' => $request['container_id'],
                            'mark_add_id' => $markcontainer
                        ]);
                        $updateprod = Prod::where('id', $request['prodName'][$prd - 1])->first();
                        $updateprod->stock = $request['stock'][$prd - 1];
                        $updateprod->update();
                        if ($request['initial_stock'][$prd - 1] != $request['stock'][$prd - 1]) {
                            Productdistribution::create([
                                'product_id' => $request['prodName'][$prd - 1],
                                'container_id' => $request['container_id'],
                                'initial_stock' => $request['initial_stock'][$prd - 1],
                                'item' => ($request['initial_stock'][$prd - 1] - $request['stock'][$prd - 1]),
                                'cost' => $request['cost'][$prd - 1],
                                'price' => $request['price'][$prd - 1],
                                'after_stock' => $request['stock'][$prd - 1]
                            ]);
                        }
                    } else {
                        // echo '<pre>'; print_r($request->all()); exit;
                        $markcontainer1 = Productmarkcontainer::where('id', $containerChk->mark_add_id)->first();
                        $markcontainer1->mark_id = json_encode($makrId);
                        $markcontainer1->mark_data = $markVal;
                        $markcontainer1->update();

                        $containerChk->initial_stock  = $request['initial_stock'][$prd - 1];
                        $containerChk->cost  = $request['cost'][$prd - 1];
                        $containerChk->price  = $request['price'][$prd - 1];
                        $containerChk->after_stock  = $request['stock'][$prd - 1];
                        $containerChk->update();

                        $updateprod = Prod::where('id', $request['prodName'][$prd - 1])->first();
                        $updateprod->stock = $request['stock'][$prd - 1];
                        $updateprod->update();
                        if ($request['initial_stock'][$prd - 1] != $request['stock'][$prd - 1]) {
                            Productdistribution::create([
                                'product_id' => $request['prodName'][$prd - 1],
                                'container_id' => $request['container_id'],
                                'initial_stock' => $request['initial_stock'][$prd - 1],
                                'item' => ($request['initial_stock'][$prd - 1] - $request['stock'][$prd - 1]),
                                'cost' => $request['cost'][$prd - 1],
                                'price' => $request['price'][$prd - 1],
                                'after_stock' => $request['stock'][$prd - 1]
                            ]);
                        }
                    }
                }
                    $prd++;
                    unset($markData);
                }
            }
        }
        return redirect()->route('container.index')->with('message', 'success|Product has been successfully Updated in container');
    }

    public function ajax_cat_prod($id)
    {
        $allproducts = Prod::where('category', $id)->get();
        return $allproducts;
    }
    public function detaillist()
    {
        $allcontainerdetail = Containerdetail::get();

        return view('inventory.container.detaillist', compact('allcontainerdetail'));
    }
    public function detailcreate()
    {
        $allcontainer = Container::get();

        return view('inventory.container.detailcreate', compact('allcontainer'));
    }
    public function detailedit($id)
    {
        $alldetail = Containerdetail::where('id', $id)->first();

        return view('inventory.container.detailedit', compact('alldetail'));
    }
    public function detailstore(Request $request)
    {
        // echo '<pre>'; print_r($request->all());exit;
        $container = Containerdetail::create([
            'shipper_info' => $request->shipper_info,
            'notify_info' => $request->notify_info,
            'port_loading' => $request->port_loading,
            'consignee_info' => $request->consignee_info,
            'port_discharge' => $request->port_discharge
        ]);
        return redirect()->route('detail.index')->with('message', 'success|Container detail has been successfully created');
    }

    public function detailupdate(Request $request)
    {
        $updatedetail = Containerdetail::where('id', $request->detail_id)->first();
        $updatedetail->shipper_info = $request->shipper_info;
        $updatedetail->notify_info = $request->notify_info;
        $updatedetail->port_loading = $request->port_loading;
        $updatedetail->bill_loading = $request->bill_loading;
        $updatedetail->consignee_info = $request->consignee_info;
        $updatedetail->vessel_no = $request->vessel_no;
        $updatedetail->port_discharge = $request->port_discharge;
        $updatedetail->update();
        return redirect()->route('detail.index')->with('message', 'success|Container detail has been successfully updated');
    }
    public function detaildelete($id)
    {
        if (@$id) {
            $product = Containerdetail::where('id', $id)->delete();
            return redirect()->route('detail.index')->with('message', 'success|Container detail has successfully deleted');
        }
    }

    public function batch()
    {
        $allbatch = Batch::all();
        
        return view('inventory.batch.index', compact('allbatch'));
    }
    public function addProductbatch($id)
    {
        $allcategory = Inventorycategory::get();
        $allproducts = Prod::get();
        $containers = Container::get();
        $batch = Batch::where('id', $id)->first();
        $allmarks = Mark::get();

        return view('inventory.batch.addproduct', compact('batch', 'containers', 'allproducts', 'allcategory', 'allmarks'));
    }
    public function batchproduct(Request $request)
    {
        // print_r($request['prodName']); exit;
        $allmark = Mark::get()->count();
        $makrId = Mark::select('id')->get()->toArray();
        $allproducts = Prod::count();
        $loopNo = $allmark * $allproducts;
        $markData = array();
        $prd = 1;
       
        for ($inc = 1; $inc <= $loopNo; $inc++) {
            if(isset($request['prodName'][$prd - 1])) {
                $idx = $request['prodName'][$prd - 1];
                $markData[] = $request['mark_' . ((($idx - 1) * $allmark) + ($inc % $allmark))];
            }
            
            if ($inc % $allmark == 0) {
                if(isset($request['prodName'][$prd - 1])) {
                    $markVal = json_encode($markData);
                }
                if ($prd <= $allproducts) {
                    if(isset($request['prodName'][$prd - 1])){
                        $containerChk = Productcontainer::where('product_id', $request['prodName'][$prd - 1])->where('batch_id', $request['batch_id'])->first();

                        if (empty($containerChk)) {
                            $markcontainer = Productmarkcontainer::create([
                                'mark_id' => json_encode($makrId),
                                'mark_data' => json_encode($markData),
                                'batch_id' => $request['batch_id']
                            ]);
                            $markcontainer = $markcontainer->id;
                            Productcontainer::create([
                                'product_id' => $request['prodName'][$prd - 1],
                                'category_id' => $request['cat_id'][$prd - 1],
                                'initial_stock' => $request['initial_stock'][$prd - 1],
                                // 'cost' => $request['cost'][$prd - 1],
                                // 'price' => $request['price'][$prd - 1],
                                'after_stock' => $request['stock'][$prd - 1],
                                'cost' => 0,
                                'price' => 0,
                                'batch_id' => $request['batch_id'],
                                'mark_add_id' => $markcontainer
                            ]);
                        } else {
                            $markcontainer1 = Productmarkcontainer::where('id', $containerChk->mark_add_id)->first();
                            $markcontainer1->mark_id = json_encode($makrId);
                            $markcontainer1->mark_data = $markVal;
                            $markcontainer1->update();

                            $containerChk->initial_stock  = $request['initial_stock'][$prd - 1];
                            $containerChk->after_stock  = $request['stock'][$prd - 1];
                            $containerChk->update();
                        }
                    }
                    $prd++;
                    unset($markData);
                }
            }
        }
        return redirect()->route('batch.index')->with('message', 'success|Product has been successfully Updated in Batch.');
    }
    public function batchcreate()
    {
        return view('inventory.batch.create');
    }
    public function batchedit($id)
    {
        $batch_detail = Batch::where('id', $id)->first();

        return view('inventory.batch.edit', compact('batch_detail'));
    }
    public function batchview($id)
    {
        $batch_detail = Batch::where('id', $id)->first();
        $allcontainer = Mark::where('inventory_mark.batch_id', $id)
            ->join('inventory_container', 'inventory_container.container_batch', '=', 'inventory_mark.batch_id')
            ->join('inventory_shipper', 'inventory_shipper.id', '=', 'inventory_container.shipper_info')
            ->join('inventory_consignee', 'inventory_consignee.id', '=', 'inventory_container.consignee_info')
            ->select('inventory_container.*', 'inventory_shipper.name as shipper_name', 'inventory_consignee.name as consignee_name')
            ->distinct()
            ->get();
        return view('inventory.batch.view', compact('batch_detail', 'allcontainer'));
    }
    public function batchstore(Request $request)
    {
        $container = Batch::create([
            'name' => $request->name,
        ]);

        return redirect()->route('batch.index')->with('message', 'success|Batch has been successfully created');
    }
    public function batchupdate(Request $request)
    {

        $container = Batch::where('id', $request->batch_id)->first();
        $container->name = $request->name;
        $container->update();

        return redirect()->route('batch.index')->with('message', 'success|Batch has been successfully Updated');
    }
    public function batchdelete($id)
    {
        if (@$id) {
            $product = Batch::where('id', $id)->delete();
            return redirect()->route('batch.index')->with('message', 'success|Batch has successfully deleted');
        }
    }
    public function batchajax_mark($id)
    {
        $allmark = Mark::where('batch_id', $id)
            ->select('name')
            ->get()->toArray();
        return $allmark;
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
        return Excel::create('Container_Detail', function ($excel) use ($data) {
            $excel->sheet('products', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
}
