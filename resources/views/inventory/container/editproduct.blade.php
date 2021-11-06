@extends('layouts.inventory')

@section('content')
    <style>
        table {
            border: 1px solid #999;
            border-collapse: collapse;
            width: 100%
        }

        td {
            border: 1px solid #999
        }

        .table td,
        .table th {
            padding: 5px !important;
        }

    </style>
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <?php echo displayAlert(); ?>
                <div class="page-header">
                    <h4 class="page-title">Edit Container Product</h4>
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="#">
                                <i class="flaticon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>

                        <li class="nav-item">
                            <a href="">Container List</a>
                        </li>
                    </ul>
                </div>
                <form action="{{ route('product.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-space">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h3>
                                            Container Number {{ $container_detail->containerid }}
                                            <input type="hidden" name="container_id" value="{{ $container_detail->id }}">
                                        </h3>
                                    </div>
                                </div>

                                <div class="accordion accordion-secondary">
                                    @php
                                        $increment = 1;
                                        $tbl_inc = 1;
                                        $td_inc = 1;
                                    @endphp
                                    @foreach ($allcategory as $cus)
                                        <div class="card">
                                            <div class="card-header collapsed" id="heading{{ $cus->id }}"
                                                data-toggle="collapse" data-target="#collapse{{ $cus->id }}"
                                                aria-expanded="false" aria-controls="collapse{{ $cus->id }}"
                                                role="button">
                                                <div class="span-icon">
                                                    <div class="flaticon-box-1"></div>
                                                </div>
                                                <div class="span-title">
                                                    {{ $cus->name }}
                                                </div>
                                                <div class="span-mode"></div>
                                            </div>

                                            <div id="collapse{{ $cus->id }}" class="collapse"
                                                aria-labelledby="heading{{ $cus->id }}" data-parent="#accordion">
                                                <div class="card-body">

                                                    <table class="table table-head-bg-success"
                                                        id="myTable_{{ $increment }}">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Product</th>
                                                                <th scope="col">Initial Stock</th>
                                                                @foreach ($allmark as $mark)
                                                                    <th scope="col">{{ $mark->name }}</th>
                                                                @endforeach
                                                                <th scope="col">Cost</th>
                                                                <th scope="col">Price</th>
                                                                <th scope="col">VAT</th>
                                                                <th scope="col">Stock After</th>
                                                                <th scope="col"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($allproductdetail as $prod)
                                                                @if ($prod->category_id == $cus->id)
                                                                    <tr id="row_{{ $tbl_inc }}" class="getRow">
                                                                        <td>
                                                                            <label>{{ $prod->product_name }}</label>
                                                                            <input type="hidden" name="prodName[]"
                                                                                value="{{ $prod->product_id }}" />
                                                                            <input type="hidden" name="cat_id[]"
                                                                                value="{{ $prod->category_id }}" />
                                                                        </td>
                                                                        <td>
                                                                            <label>{{ $prod->initial_stock }}</label>
                                                                            <input type="hidden" name="initial_stock[]"
                                                                                class="iStock_{{ $tbl_inc }}"
                                                                                value="{{ $prod->initial_stock }}" />
                                                                        </td>
                                                                        @if (isset($allmarkdetail[$tbl_inc - 1]))
                                                                            
                                                                        
                                                                        @php
                                                                            $markinc = 1;
                                                                            // $incMarkId = $allmarkdetail[$tbl_inc - 1]['mark_id'];
                                                                            // $incMarkId = json_decode($incMarkId);
                                                                            $incMarkData = $allmarkdetail[$tbl_inc - 1]['mark_data'];
                                                                            $incMarkData = json_decode($incMarkData);

                                                                        @endphp
                                                                        @foreach ($allmark as $mark)
                                                                        @php
                                                                                $makrval = $incMarkData[$markinc-1];
                                                                                // echo '<pre>'; print_r($incMarkData);
                                                                                @endphp

                                                                                <td>
                                                                                    <input type="text"
                                                                                        value="{{ $makrval }}"
                                                                                        name="mark_{{ $td_inc }}"
                                                                                        class="form-control mkkk mark_{{ $tbl_inc }}" />
                                                                                </td>
                                                                                @php
                                                                                    $td_inc++;
                                                                                    $markinc++;
                                                                                @endphp
                                                                        @endforeach
                                                                        @else
                                                                        <td>
                                                                            <input type="text"
                                                                                name="mark_{{ $td_inc }}"
                                                                                class="form-control mkkk mark_{{ $tbl_inc }}" />
                                                                        </td>
                                                                        @endif
                                                                        <td>
                                                                            <label>{{ $prod->cost }}</label>
                                                                            <input type="hidden" class="form-control"
                                                                                name="cost[]"
                                                                                value="{{ $prod->cost }}" />
                                                                        </td>
                                                                        <td>

                                                                            <input type="text" class="form-control"
                                                                                name="price[]"
                                                                                value="{{ $prod->price }}" />
                                                                        </td>
                                                                        <td>
                                                                            <select name="vat[]" class="form-control">
                                                                                @if ($prod->vat == 1)
                                                                                    <option selected value="1">Y
                                                                                    </option>
                                                                                    <option value="0">N
                                                                                    </option>
                                                                                @else
                                                                                    <option value="1">Y
                                                                                    </option>
                                                                                    <option selected value="0">N
                                                                                    </option>

                                                                                @endif


                                                                            </select>
                                                                        </td>
                                                                        <td><input type="text" readonly
                                                                                class="form-control stock_{{ $tbl_inc }}"
                                                                                name="stock[]"
                                                                                value="{{ $prod->after_stock }}" /></td>
                                                                        <td><button type="button"
                                                                                onclick="deleteTblRow(this)"
                                                                                class="btn btn-danger"><i
                                                                                    class="fa fa-trash"></i></button>
                                                                        </td>
                                                                    </tr>

                                                                    @php
                                                                        $tbl_inc++;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $increment++;
                                        @endphp
                                    @endforeach
                                </div>
                                <div class="card-footer">
                                    <div class="card-action">
                                        <button type="submit" class="btn btn-success">Update</button>
                                            <button type="button" id="makePdfContainer" class="btn btn-warning pull-right">
                                                <i class="fas fa-file-pdf"></i> Download Loading List</button>
                                    
                                        {{-- <button class="btn btn-danger pull-right">Lock Container</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


                <div class="row" style="display: none;">
                    <div class="col-md-12" id="sideview5">
                        <div class="card card-space">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h3>
                                        Container Number {{ $container_detail->containerid }}
                                        <input type="hidden" name="container_id" value="{{ $container_detail->id }}">
                                    </h3>
                                </div>
                            </div>

                            {{-- <div class="accordion accordion-secondary"> --}}
                                @php
                                    $increment = 1;
                                    $tbl_inc = 1;
                                    $td_inc = 1;
                                @endphp
                                @foreach ($allcategory as $cus)
                                    <div class="card">
                                        {{-- <div class="card-header collapsed" id="heading{{ $cus->id }}"
                                            data-toggle="collapse" data-target="#collapse{{ $cus->id }}"
                                            aria-expanded="false" aria-controls="collapse{{ $cus->id }}"
                                            role="button">
                                            <div class="span-icon">
                                                <div class="flaticon-box-1"></div>
                                            </div>
                                            <div class="span-title">
                                                {{ $cus->name }}
                                            </div>
                                            <div class="span-mode"></div>
                                        </div> --}}
                                        <div class="span-title p-2">
                                            {{ $cus->name }}
                                        </div>
                                        {{-- <div id="collapse{{ $cus->id }}" class="collapse"
                                            aria-labelledby="heading{{ $cus->id }}" data-parent="#accordion"> --}}
                                            <div class="card-body">

                                                <table class="table table-head-bg-success"
                                                    id="myTable_{{ $increment }}">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Product</th>
                                                            <th scope="col">Initial Stock</th>
                                                            @foreach ($allmark as $mark)
                                                                <th scope="col">{{ $mark->name }}</th>
                                                            @endforeach
                                                            <th scope="col">Cost</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col">VAT</th>
                                                            <th scope="col">Stock After</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($allproductdetail as $prod)
                                                            @if ($prod->category_id == $cus->id)
                                                                <tr id="row_{{ $tbl_inc }}" class="getRow" style="height: 80px;">
                                                                    <td>
                                                                        <label>{{ $prod->product_name }}</label>
                                                                      
                                                                    </td>
                                                                    <td>
                                                                        <label>{{ $prod->initial_stock }}</label>
                                                                       
                                                                    </td>
                                                                    @if (isset($allmarkdetail[$tbl_inc - 1]))
                                                                    @php
                                                                        $markinc = 1;
                                                                        // $incMarkId = $allmarkdetail[$tbl_inc - 1]['mark_id'];
                                                                        // $incMarkId = json_decode($incMarkId);
                                                                        $incMarkData = $allmarkdetail[$tbl_inc - 1]['mark_data'];
                                                                        $incMarkData = json_decode($incMarkData);

                                                                    @endphp
                                                                    @foreach ($allmark as $mark)
                                                                    @php
                                                                            $makrval = $incMarkData[$markinc-1];
                                                                            // echo '<pre>'; print_r($incMarkData);
                                                                            @endphp

                                                                            <td>
                                                                                {{ $makrval }}
                                                                               
                                                                            </td>
                                                                            @php
                                                                                $td_inc++;
                                                                                $markinc++;
                                                                            @endphp
                                                                    @endforeach
                                                                    @else
                                                                    <td>
                                                                       
                                                                    </td>
                                                                    @endif
                                                                    <td>
                                                                        <label>{{ $prod->cost }}</label>
                                                                    </td>
                                                                    <td>
                                                                        {{ $prod->price }}
                                                                       
                                                                    </td>
                                                                    <td>
                                                                        
                                                                            @if ($prod->vat == 1)
                                                                            Y
                                                                            @else
                                                                            N
                                                                            @endif
                                                                    </td>
                                                                    <td>{{ $prod->after_stock }}</td>
                                                                    
                                                                </tr>

                                                                @php
                                                                    $tbl_inc++;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        {{-- </div> --}}
                                    </div>
                                    @php
                                        $increment++;
                                    @endphp
                                @endforeach
                            {{-- </div> --}}
                            {{-- <div class="card-footer">
                                <div class="card-action">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="{{ url('/inventory/container/downloadExcel/xls') }}">
                                        <button type="button" class="btn btn-warning text-center">Download Loding List</button>
                                    </a>
                                    <button class="btn btn-danger pull-right">Lock Container</button>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
