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
                    <h4 class="page-title">Edit Product</h4>
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
                            <a href="{{ url('inventory/container/batch') }}">Batch List</a>
                        </li>
                    </ul>
                </div>
                <form action="{{ route('batchproduct.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-space">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h3>
                                            {{ $batch->name }}
                                            <input type="hidden" name="batch_id" value="{{$batch->id}}">
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
                                                        id="myTable_{{ $increment }}" style="text-align: center;">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" rowspan="2" style="border: 1px solid #999 !important;">Product</th>
                                                                
                                                                <th scope="col" rowspan="2" style="border: 1px solid #999 !important;">Initial Stock</th>

                                                                @foreach ($containers as $container)
                                                                    @php
                                                                        $counts = count(App\Mark::where('container_id', $container->id)->get());
                                                                    @endphp
                                                                    <th scope="col" colspan="<?=$counts?>" style="text-align: center; border: 1px solid #999 !important;">{{ $container->containerid }}</th>
                                                                @endforeach
                                                                
                                                                <th scope="col" rowspan="2" style="border: 1px solid #999 !important;">Stock After</th>
                                                                <th scope="col" rowspan="2" style="border: 1px solid #999 !important;"></th>
                                                            </tr>
                                                            <tr>
                                                                @foreach ($allmarks as $mark)
                                                                    <th scope="col">{{ $mark->name }}</th>
                                                                @endforeach
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
                                                                            @foreach ($allmarks as $key => $mark)
                                                                                @php
                                                                                    $makrval = $incMarkData[$markinc-1];
                                                                                    // echo '<pre>'; print_r($incMarkData);
                                                                                @endphp

                                                                                    <td>
                                                                                        <input type="text"
                                                                                            value="{{ $makrval }}"
                                                                                            name="mark_{{ ($key + 1) + count($allmarks) * ($prod->product_id - 1) }}"
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
            </div>
        </div>
    </div>


@endsection
