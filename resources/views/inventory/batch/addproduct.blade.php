@extends('layouts.inventorynowrap', ['menu' => 'batch'])

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
            vertical-align: middle!important;
            padding: 5px !important;
        }
        .table label {
            margin-bottom: 0px!important;
        }

    </style>

    <?php echo displayAlert(); ?>
    <div class="page-header pt-3">
        <h3 class="page-title"> {{ $batch->name }} </h3>
        <div class="page-inner">
            @if($containers)
                @foreach($containers as $key => $value)
                    <label>{{ $value->owner_name }}</label>
                    <input type="checkbox" name="filter_container" class = "form-control" id="filter_container" value="{{ $value->owner_name }}" />
                @endforeach
            @endif
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('inventory/container/batch') }}">Batch</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $batch->name }} </li>
            </ol>
        </nav>
    </div>

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <form action="{{ route('batchproduct.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="batch_id" value="{{$batch->id}}" />

                        <div class="col-md-12">
                            <div class="card">
                                <div class="accordion" id="accordion" role="tablist">
                                    @php
                                        $increment = 1;
                                        $tbl_inc = 1;
                                        $td_inc = 1;
                                    @endphp
                                    @foreach ($allcategory as $cus)
                                        <div class="card">
                                            <div class="card-header" role="tab" id="heading-{{ $cus->id }}">
                                                <h6 class="mb-0">
                                                    <a data-toggle="collapse" href="#collapse-{{ $cus->id }}" aria-expanded="false" aria-controls="collapse-{{ $cus->id }}"> {{ $cus->name }} </a>
                                                </h6>
                                            </div>

                                            <div id="collapse-{{ $cus->id }}" class="collapse" role="tabpanel" aria-labelledby="heading-{{ $cus->id }}" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="table-responsive">
                                                            <table class="table table-head-bg-success"
                                                            id="myTable_{{ $increment }}" style="text-align: center;">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col" rowspan="2" style="border: 1px solid #999 !important;">Product</th>
                                                                        <th scope="col" rowspan="2" style="border: 1px solid #999 !important;">Initial Stock</th>
                                                                        <th scope="col" rowspan="2" style="border: 1px solid #999 !important;">Stock After</th>
                                                                        @foreach ($containers as $container)
                                                                            @php
                                                                                $counts = count(App\Mark::where('container_id', $container->id)->get());
                                                                            @endphp
                                                                            <th scope="col" colspan="<?=$counts?>" style="text-align: center; border: 1px solid #999 !important;">{{ $container->owner_name }}</th>
                                                                        @endforeach
                                                                        <!-- <th scope="col" rowspan="2" style="border: 1px solid #999 !important;"></th> -->
                                                                    </tr>
                                                                    <tr>
                                                                        @foreach ($allmarks as $mark)
                                                                            <th scope="col">{{ $mark->name }}</th>
                                                                        @endforeach
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($allproducts as $prod)
                                                                        @if ($prod->category == $cus->id )
                                                                            @if($prod->stock > 0)
                                                                                <tr id="row_{{ $tbl_inc }}" class="getRow">
                                                                                    <td>
                                                                                        <label>{{ $prod->name }}</label>
                                                                                        <input type="hidden" name="prodName[]"
                                                                                            value="{{ $prod->id }}" />
                                                                                        <input type="hidden" name="cat_id[]"
                                                                                            value="{{ $prod->category }}" />
                                                                                    </td>
                                                                                    <td>
                                                                                        <label style="font-weight: bolder;">{{ $prod->stock }}</label>
                                                                                        <input type="hidden" name="initial_stock[]"
                                                                                            class="iStock_{{ $tbl_inc }}"
                                                                                            value="{{ $prod->stock }}" />
                                                                                    </td>
                                                                                    <td>
                                                                                        <input type="hidden" class="form-control" name="cost[]" value="{{ $prod->price }}"/>
                                                                                        <input type="text" readonly class="form-control stock_{{ $tbl_inc }}" name="stock[]" value="{{ $prod->stock }}" style="font-weight: bolder;" />
                                                                                    </td>
                                                                                    @foreach ($allmarks as $key => $mark)
                                                                                        <td>
                                                                                            <input type="text" value="0"
                                                                                                name="mark_{{ ($key + 1) + count($allmarks) * ($prod->id - 1) }}"
                                                                                                class="form-control mkkk mark_{{ $tbl_inc }}" />
                                                                                        </td>
                                                                                        @php
                                                                                            $td_inc++;
                                                                                        @endphp
                                                                                    @endforeach
                                                                                    <!-- <td>
                                                                                        <button type="button"
                                                                                            onclick="deleteTblRow(this)"
                                                                                            class="btn btn-danger btn-sm"><i
                                                                                                class="fa fa-trash"></i></button>
                                                                                    </td> -->
                                                                                </tr>

                                                                                @php
                                                                                    $tbl_inc++;
                                                                                @endphp
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $increment++;
                                        @endphp
                                    @endforeach
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success">Update</button>
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
