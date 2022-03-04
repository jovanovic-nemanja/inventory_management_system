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
use App\InventoryTypes;
use App\BatchProdPrices;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

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
        $types = InventoryTypes::get();
        $allshipper = Shipper::get();
        $allconsignee = Consignee::get();
        $allcustomers = Customer::get();
        $allproducts = Prod::get();
        $allbatch = Batch::all();
        $allcategory = Inventorycategory::get();
        return view('inventory.container.create', compact('types', 'allcustomers', 'allproducts', 'allcategory', 'allcontainerdetail', 'allbatch', 'allshipper', 'allconsignee'));
    }
    public function edit($id)
    {
        $container_detail = Container::where('id', $id)->first();
        $types = InventoryTypes::get();
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

        return view('inventory.container.edit', compact('types', 'container_detail', 'allcustomers', 'allproducts', 'allshipper', 'allconsignee', 'allcategory', 'con_cus', 'cus_no', 'allbatch', 'allcontainerdetail'));
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
            'shipping_date' => $request->shipping_date,
            'owner_name' => $request->owner_name,
            'seal_number' => $request->seal_number,
            'container_type' => $request->container_type,
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
        $container->shipping_date = $request->shipping_date;
        $container->owner_name = $request->owner_name;
        $container->seal_number = $request->seal_number;
        $container->container_type = $request->container_type;

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

    public function addProduct($container_id, $batch_id)
    {
        $allcategory = Inventorycategory::get();
        $allproducts = Prod::get();
        $container = Container::where('id', $container_id)->first();
        $batch = Batch::where('id', $batch_id)->first();
        $allmarks = Mark::where('container_id', $container_id)->get();
        $all_mark = Mark::all();
        
        $cur_mark = Mark::where('container_id', $container_id)->first();
        $prev_count = Mark::where('id', '<', $cur_mark->id)->count();

        $allmarkdetail = Productmarkcontainer::where('batch_id', $batch_id)->get()->toArray();
        $allproductdetail = Productcontainer::where('batch_id', $batch_id)
            ->join('inventory_product', 'inventory_product.id', '=', 'inventory_container_to_product.product_id')
            ->select('inventory_container_to_product.*', 'inventory_product.name as product_name')
            ->get();

        if (sizeof($allproductdetail) <= 0) {
            return view('inventory.container.addproduct', compact('all_mark', 'prev_count', 'batch', 'container', 'allproducts', 'allcategory', 'allmarks'));
        }else{
            $allprod = Prod::whereNotIn('id', function($query){
                $query->select('product_id')->from(with(new Productcontainer)->getTable());})  
                ->select('id as product_id','category as category_id','stock as initial_stock','price as cost','price as price','stock as after_stock','name as product_name',)
                ->get();

            $allproductdetail = $allproductdetail->merge($allprod);

            return view('inventory.container.editproduct', compact('all_mark', 'prev_count', 'batch', 'container', 'allproductdetail', 'allmarkdetail', 'allproducts', 'allcategory', 'allmarks'));
        }
    }
    public function storeProduct(Request $request)
    {
        $allproducts = Prod::count();
       
        for ($inc = 0; $inc < $allproducts; $inc++) {
            if(@$request->prodName[$inc]) {
                $price_item = BatchProdPrices::where('container_id', $request->container_id)->where('batch_prod_id', $request->prodName[$inc])->first();
                if(@$price_item) {
                    $price_item->price = $request->price[$inc];
                    $price_item->vat = $request->vat[$inc];
                    $price_item->update();
                }else{
                    BatchProdPrices::create([
                        'batch_prod_id' => $request->prodName[$inc],
                        'container_id' => $request->container_id,
                        'price' => $request->price[$inc],
                        'vat' => $request->vat[$inc],
                        'sign_date' => date('Y-m-d H:i:s')
                    ]);
                }
            }
            
            // $productdistribution = Productdistribution::where('product_id', $request['prodName'][$inc])->where('batch_id', $request['batch_id'])->first();
            // if(@$productdistribution) {
            //     $productdistribution->price = $request['price'][$inc];

            //     $productdistribution->update();
            // }
        }
        return redirect()->route('container.index')->with('message', 'success|Product has been successfully Updated in container.');
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

    public function type()
    {
        $alltypes = InventoryTypes::get();

        return view('inventory.type.index', compact('alltypes'));
    }
    public function typecreate()
    {
        return view('inventory.type.create');
    }
    public function typeedit($id)
    {
        $type = InventoryTypes::where('id', $id)->first();

        return view('inventory.type.edit', compact('type'));
    }
    public function typestore(Request $request)
    {
        $container = InventoryTypes::create([
            'title' => $request->title,
            'sign_date' => date('Y-m-d')
        ]);
        return redirect()->route('type.index')->with('message', 'success|Container Type has been successfully created.');
    }

    public function typeupdate(Request $request)
    {
        $model = InventoryTypes::where('id', $request->id)->first();
        $model->title = $request->title;
        $model->update();
        return redirect()->route('type.index')->with('message', 'success|Container Type has been successfully updated.');
    }
    public function typedelete($id)
    {
        if (@$id) {
            InventoryTypes::where('id', $id)->delete();
            return redirect()->route('type.index')->with('message', 'success|Container Type has successfully deleted.');
        }
    }

    public function batch()
    {
        $allbatch = Batch::all();
        $is_closed = Batch::where('status', 1)->first();
        
        return view('inventory.batch.index', compact('allbatch', 'is_closed'));
    }
    public function addProductbatch($id)
    {
        $allcategory = Inventorycategory::get();
        $allproducts = Prod::get();
        $containers = Container::get();
        $batch = Batch::where('id', $id)->first();
        $allmarks = DB::table('inventory_mark')
            ->join('inventory_container', 'inventory_mark.container_id', '=', 'inventory_container.id')
            ->select('inventory_mark.*')
            ->get();

        $allmarkdetail = Productmarkcontainer::where('batch_id', $id)->get()->toArray();
        $allproductdetail = Productcontainer::where('batch_id', $id)
            ->join('inventory_product', 'inventory_product.id', '=', 'inventory_container_to_product.product_id')
            ->select('inventory_container_to_product.*', 'inventory_product.name as product_name')
            ->get();

        $cus_no = DB::table('inventory_mark')
            ->join('inventory_customer', 'inventory_customer.id', '=', 'inventory_mark.customer_id')
            ->where('inventory_mark.container_id', $id)
            ->select('inventory_customer.id as cus_id', 'inventory_customer.name as cus_name')
            ->distinct()
            ->get();

        if (sizeof($allproductdetail) <= 0) {
            return view('inventory.batch.addproduct', compact('batch', 'containers', 'allproducts', 'allcategory', 'allmarks'));
        }else{
            $allprod = Prod::whereNotIn('id', function($query){
                $query->select('product_id')->from(with(new Productcontainer)->getTable());})  
                ->select('id as product_id','category as category_id','stock as initial_stock','price as cost','price as price','stock as after_stock','name as product_name',)
                ->get();

            $allproductdetail = $allproductdetail->merge($allprod);

            return view('inventory.batch.editproduct', compact('batch', 'containers', 'allproductdetail', 'allmarkdetail', 'allproducts', 'allcategory', 'allmarks'));
        }
    }
    public function batchproduct(Request $request)
    {
        // dd($request); 
        $allmark = Mark::get()->count();
        $makrId = Mark::select('id')->get()->toArray();
        $allproducts = Prod::count();
        $loopNo = $allmark * $allproducts;
        $markData = array();
        $prd = 0;
       
        for ($inc = 1; $inc <= $loopNo; $inc++) {
            if(isset($request['prodName'][$prd])) {
                $idx = $request['prodName'][$prd];
                if($inc % $allmark == 0) {
                    $markData[] = $request['mark_' . ((($idx - 1) * $allmark) + $allmark)];
                }else{
                    $markData[] = $request['mark_' . ((($idx - 1) * $allmark) + ($inc % $allmark))];
                }
            }
            
            if ($inc % $allmark == 0) {
                if(isset($request['prodName'][$prd])) {
                    $markVal = json_encode($markData);
                }
                if ($prd <= $allproducts) {
                    if(isset($request['prodName'][$prd])){
                        $containerChk = Productcontainer::where('product_id', $request['prodName'][$prd])->where('batch_id', $request['batch_id'])->first();

                        if (empty($containerChk)) {
                            $markcontainer = Productmarkcontainer::create([
                                'mark_id' => json_encode($makrId),
                                'mark_data' => json_encode($markData),
                                'batch_id' => $request['batch_id']
                            ]);
                            $markcontainer = $markcontainer->id;
                            Productcontainer::create([
                                'product_id' => $request['prodName'][$prd],
                                'category_id' => $request['cat_id'][$prd],
                                'initial_stock' => $request['initial_stock'][$prd],
                                'cost' => @$request['cost'][$prd],
                                // 'price' => $request['price'][$prd],
                                'after_stock' => $request['stock'][$prd],
                                'price' => 0,
                                'batch_id' => $request['batch_id'],
                                'mark_add_id' => $markcontainer
                            ]);

                            $updateprod = Prod::where('id', $request['prodName'][$prd])->first();
                            $updateprod->stock = $request['stock'][$prd];
                            $updateprod->update();

                            if ($request['initial_stock'][$prd] != $request['stock'][$prd]) {
                                Productdistribution::create([
                                    'product_id' => $request['prodName'][$prd],
                                    'batch_id' => $request['batch_id'],
                                    'initial_stock' => $request['initial_stock'][$prd],
                                    'item' => ($request['initial_stock'][$prd] - $request['stock'][$prd]),
                                    'price' => 0,
                                    'cost' => $request['cost'][$prd],
                                    // 'price' => $request['price'][$prd],
                                    'after_stock' => $request['stock'][$prd]
                                ]);
                            }
                        } else {
                            $markcontainer1 = Productmarkcontainer::where('id', $containerChk->mark_add_id)->first();
                            $markcontainer1->mark_id = json_encode($makrId);
                            $markcontainer1->mark_data = $markVal;
                            $markcontainer1->update();

                            $containerChk->initial_stock  = $request['initial_stock'][$prd];
                            $containerChk->cost  = $request['cost'][$prd];
                            $containerChk->after_stock  = $request['stock'][$prd];
                            $containerChk->update();

                            $updateprod = Prod::where('id', $request['prodName'][$prd])->first();
                            $updateprod->stock = $request['stock'][$prd];
                            $updateprod->update();

                            if ($request['initial_stock'][$prd] != $request['stock'][$prd]) {
                                $productdistribution = Productdistribution::where('product_id', $request['prodName'][$prd])->where('batch_id', $request['batch_id'])->first();
                                if(@$productdistribution) {
                                    $productdistribution->initial_stock = $request['initial_stock'][$prd];
                                    $productdistribution->item = ($request['initial_stock'][$prd] - $request['stock'][$prd]);
                                    $productdistribution->cost = $request['cost'][$prd];
                                    $productdistribution->after_stock = $request['stock'][$prd];

                                    $productdistribution->update();
                                }else{
                                    Productdistribution::create([
                                        'product_id' => $request['prodName'][$prd],
                                        'batch_id' => $request['batch_id'],
                                        'initial_stock' => $request['initial_stock'][$prd],
                                        'item' => ($request['initial_stock'][$prd] - $request['stock'][$prd]),
                                        'cost' => $request['cost'][$prd],
                                        // 'price' => $request['price'][$prd],
                                        'price' => 0,
                                        'after_stock' => $request['stock'][$prd]
                                    ]);
                                }
                            }
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

    /**
     * Close the Batch, so user can't edit it anymore.
     * @author Nemanja
     * @since 2021-11-22
     * @param batch_id
     * @return bool true or false
     */
    public function batchclose($id)
    {
        $batch_detail = Batch::where('id', $id)->first();
        if(@$batch_detail) {
            $batch_detail->status = 2;
            $batch_detail->update();
        }

        return redirect()->route('batch.index')->with('message', 'success|Batch has been successfully closed.');
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
            'status' => 1,
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

    /**
     * Download the add-product as PDF.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadPDF($container_id, $batch_id)
    {
        $items = [];
        $items['allcategory'] = Inventorycategory::get();
        $items['allproducts'] = Prod::get();
        $items['container'] = Container::where('id', $container_id)->first();
        $items['batch'] = Batch::where('id', $batch_id)->first();
        $items['allmarks'] = Mark::where('container_id', $container_id)->get();
        $items['all_mark'] = Mark::all();
        
        $cur_mark = Mark::where('container_id', $container_id)->first();
        $items['prev_count'] = Mark::where('id', '<', $cur_mark->id)->count();

        $items['allmarkdetail'] = Productmarkcontainer::where('batch_id', $batch_id)->get()->toArray();
        $items['allproductdetail'] = Productcontainer::where('batch_id', $batch_id)
            ->join('inventory_product', 'inventory_product.id', '=', 'inventory_container_to_product.product_id')
            ->select('inventory_container_to_product.*', 'inventory_product.name as product_name')
            ->get();

        $allprod = Prod::whereNotIn('id', function($query){
            $query->select('product_id')->from(with(new Productcontainer)->getTable());})  
            ->select('id as product_id','category as category_id','stock as initial_stock','price as cost','price as price','stock as after_stock','name as product_name',)
            ->get();

        $items['allproductdetail'] = $items['allproductdetail']->merge($allprod);

        view()->share('items', $items);

        $pdf = PDF::loadView('inventory.container.downloadpdf');
        return $pdf->download('pdfview.pdf');
    }

    /**
     * Download the add-product as PDF.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadInvoicePDF(Request $request)
    {
        $items = [];
        $items['allcontainer']  = Mark::where('inventory_mark.customer_id', $request->customer_id)
            ->Join('inventory_container', 'inventory_container.id', '=', 'inventory_mark.container_id')
            ->select('inventory_container.containerid as con_name', 'inventory_container.id as con_id', 'inventory_mark.*')
            ->groupBy('inventory_container.containerid')
            ->get();

        $items['allmark']  = Mark::where('inventory_mark.customer_id', $request->customer_id)
            ->Join('inventory_container', 'inventory_container.id', '=', 'inventory_mark.container_id')
            ->select('inventory_mark.*', 'inventory_container.containerid as con_name')
            ->get();
        $items['allproduct'] = Productcontainer::leftJoin('inventory_mark', 'inventory_mark.id', '=', 'inventory_container_to_product.mark_add_id')
            ->leftJoin('inventory_product', 'inventory_product.id', '=', 'inventory_container_to_product.product_id')
            ->leftJoin('inventory_container_mark_add', 'inventory_container_mark_add.id', '=', 'inventory_container_to_product.mark_add_id')
            ->select('inventory_mark.*', 'inventory_product.id as product_id', 'inventory_product.name as product_name', 'inventory_container_to_product.price as price_value', 'inventory_container_mark_add.mark_id as all_mark_id', 'inventory_container_mark_add.mark_data as all_mark_data')
            ->get();

        $items['customer'] = Customer::where('id', $request->customer_id)->first();

        view()->share('items', $items);

        $pdf = PDF::loadView('inventory.customer.downloadInvoicePDF');
        $path = public_path('pdf/');
        $fileName = 'Container Invoice ' . time(). '.' . 'pdf';
        $pdf->save($path . '/' . $fileName);

        $pdf = public_path('pdf/' . $fileName);
        return response()->download($pdf);
    }
}
