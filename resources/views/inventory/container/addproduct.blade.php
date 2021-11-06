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
        .table td, .table th {
    padding: 5px !important;
}

    </style>
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <?php echo displayAlert(); ?>
                <div class="page-header">
                    <h4 class="page-title">Add Container Product</h4>
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
                                            <input type="hidden" name="container_id" value="{{$container_detail->id}}">
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
                                        <div class="card-header collapsed" id="heading{{$cus->id}}" data-toggle="collapse"
                                            data-target="#collapse{{$cus->id}}" aria-expanded="false" aria-controls="collapse{{$cus->id}}"
                                            role="button">
                                            <div class="span-icon">
                                                <div class="flaticon-box-1"></div>
                                            </div>
                                            <div class="span-title">
                                               {{$cus->name}}
                                            </div>
                                            <div class="span-mode"></div>
                                        </div>

                                        <div id="collapse{{$cus->id}}" class="collapse" aria-labelledby="heading{{$cus->id}}"
                                            data-parent="#accordion">
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
                                                    @foreach ($allproducts as $prod)
                                                    @if ($prod->category == $cus->id )
                                                        <tr id="row_{{ $tbl_inc }}" class="getRow">
                                                            <td>
                                                                <label>{{ $prod->name }}</label>
                                                                <input type="hidden" name="prodName[]"
                                                                    value="{{ $prod->id }}" />
                                                                    <input type="hidden" name="cat_id[]"
                                                                    value="{{ $prod->category }}" />
                                                            </td>
                                                            <td>
                                                                <label>{{ $prod->stock }}</label>
                                                                <input type="hidden" name="initial_stock[]"
                                                                    class="iStock_{{ $tbl_inc }}"
                                                                    value="{{ $prod->stock }}" />
                                                            </td>
                                                            @foreach ($allmark as $mark)
                                                                    <td>

                                                                        <input type="text" value="0"
                                                                            name="mark_{{ $td_inc }}"
                                                                            class="form-control mkkk mark_{{ $tbl_inc }}" />
                                                                    </td>
                                                                    @php
                                                                        $td_inc++;
                                                                    @endphp
                                                            @endforeach
                                                            <td>
                                                                <label>{{ $prod->price }}</label>
                                                                <input type="hidden" class="form-control"
                                                                    name="cost[]" value="{{ $prod->price }}"/></td>
                                                            <td>

                                                                <input type="text" class="form-control"
                                                                    name="price[]"
                                                                    value="{{ $prod->price }}" /></td>
                                                            <td>
                                                                <select name="vat[]" class="form-control">
                                                                    <option value="1">Y
                                                                    </option>
                                                                    <option value="0">N
                                                                    </option>
                                                                </select>
                                                            </td>
                                                            <td><input type="text" readonly
                                                                    class="form-control stock_{{ $tbl_inc }}"
                                                                    name="stock[]"
                                                                    value="{{ $prod->stock }}" /></td>
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
                                        <button class="btn btn-danger pull-right">Lock Container</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>


@endsection
