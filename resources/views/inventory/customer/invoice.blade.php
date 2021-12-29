@extends('layouts.inventory', ['menu' => 'customer'])

@section('content')
    <style>
        table {
            border: 1px solid #999;
            border-collapse: collapse;
            width: 100%
        }

        td, th {
            border: 1px solid #999
        }

        .table td,
        .table th {
            padding: 5px !important;
        }



        .loader {
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
         }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .hide-loader{
            display:none;
        }

    </style>

    <?php echo displayAlert(); ?>

    <div class="page-header">
        <h3 class="page-title"> Container Invoice </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('inventory/customer') }}">Customer</a></li>
                <li class="breadcrumb-item active" aria-current="page">Container Invoice</li>
            </ol>
        </nav>
    </div>

    <div class="row grid-margin">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- <button class="btn  btn-success" id="makePdf">PDF</button> -->
                    <button data-url="{{ route('container.downloadInvoicePDF') }}" data-value="{{ $customer->id }}" class="btn btn-success invoice_pdf">PDF</button>

                    @include('inventory.customer.invoice_content', ['customer' => $customer, 'allcontainer' => $allcontainer, 'allmark' => $allmark, 'allproduct' => $allproduct])

                </div>
            </div>
        </div>
    </div>
@endsection
