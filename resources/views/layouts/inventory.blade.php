<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('admindesign/img/icon.ico') }}" type="image/x-icon" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts and icons -->

    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/codemirror/ambiance.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-toast-plugin/jquery.toast.min.css') }}">

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_horizontal-navbar.html -->
        <div class="horizontal-menu">
            <nav class="navbar top-navbar col-lg-12 col-12 p-0">
                <div class="container">
                    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                        <a class="navbar-brand brand-logo" href="{{ url('/inventoryboard') }}"><img style="height: 60px !important;" src="{{ asset('admindesign/img/logo.png') }}" alt="logo" /></a>
                        <a class="navbar-brand brand-logo-mini" href="{{ url('/inventoryboard') }}"><img src="{{ asset('admindesign/img/logo.png') }}" alt="logo" /></a>
                    </div>
                    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                        <ul class="navbar-nav navbar-nav-right">
                            <li class="nav-item dropdown d-inline-flex align-items-center user-dropdown">
                                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                                    <img class="img-xs rounded-circle mr-2" src="{{ asset('admindesign/img/profile.jpg') }}" alt="Profile image"> <span class="d-none d-md-inline"> Super Admin </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                                    <div class="dropdown-header text-center">
                                        <img class="img-xs rounded-circle mr-2" src="{{ asset('admindesign/img/profile.jpg') }}" alt="Profile image">
                                        <p class="mb-1 mt-3 font-weight-semibold">Super Admin</p>
                                        <p class="font-weight-light text-muted mb-0">saels@inventory.com</p>
                                    </div>
                                    <a class="dropdown-item" href="/"><i class="dropdown-item-icon icon-user text-primary"></i> Visit Website </a>
                                    <a class="dropdown-item" href="{{ url('admin/general') }}"><i class="dropdown-item-icon icon-speech text-primary"></i> Site Settings</a>
                                    <a class="dropdown-item" onClick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="dropdown-item-icon icon-power text-primary"></i>Sign Out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                            <span class="icon-menu"></span>
                        </button>
                    </div>
                </div>
            </nav>
            <nav class="bottom-navbar">
                <div class="container">
                    <ul class="nav page-navigation">
                        <li class="nav-item <?= ($menu == "dashboard") ? "active" : "" ?>">
                            <a class="nav-link" href="{{ url('/inventoryboard') }}">
                                <i class="icon-home menu-icon"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item <?= ($menu == "batch") ? "active" : "" ?>">
                            <a class="nav-link" href="{{ url('inventory/container/batch') }}">
                                <i class="icon-reload menu-icon"></i>
                                <span class="menu-title">Batch</span>
                            </a>
                        </li>
                        <li class="nav-item <?= ($menu == "container") ? "active" : "" ?>">
                            <a class="nav-link" href="{{ url('inventory/container') }}">
                                <i class="icon-reload menu-icon"></i>
                                <span class="menu-title">Container</span>
                            </a>
                        </li>
                        <li class="nav-item <?= ($menu == "products" || $menu == "units" || $menu == "category" || $menu == "container_detail" || $menu == "container_type") ? "active" : "" ?>">
                            <a href="#" class="nav-link">
                                <i class="icon-book-open menu-icon"></i>
                                <span class="menu-title">Resources</span>
                                <i class="menu-arrow"></i></a>
                            <div class="submenu">
                                <ul class="submenu-item">
                                    <li class="nav-item"><a class="nav-link <?= ($menu == "products") ? "active" : "" ?>" href="{{ url('inventory/prod') }}">Products</a></li>
                                    <li class="nav-item"><a class="nav-link <?= ($menu == "units") ? "active" : "" ?>" href="{{ url('inventory/unit') }}">Units</a></li>
                                    <li class="nav-item"><a class="nav-link <?= ($menu == "category") ? "active" : "" ?>" href="{{ url('inventory/category') }}">Category</a></li>
                                    <li class="nav-item"><a class="nav-link <?= ($menu == "container_detail") ? "active" : "" ?>" href="{{ url('inventory/container/detail') }}">Container Detail</a></li>
                                    <li class="nav-item"><a class="nav-link <?= ($menu == "container_type") ? "active" : "" ?>" href="{{ url('inventory/container/type') }}">Container Type</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item <?= ($menu == "customer") ? "active" : "" ?>">
                            <a class="nav-link" href="{{ url('inventory/customer') }}">
                                <i class="icon-reload menu-icon"></i>
                                <span class="menu-title">Customer</span>
                            </a>
                        </li>
                        <li class="nav-item <?= ($menu == "supplier") ? "active" : "" ?>">
                            <a class="nav-link" href="{{ url('inventory/supplier') }}">
                                <i class="icon-reload menu-icon"></i>
                                <span class="menu-title">Supplier</span>
                            </a>
                        </li>
                        <li class="nav-item <?= ($menu == "purchase") ? "active" : "" ?>">
                            <a class="nav-link" href="{{ url('inventory/purchase') }}">
                                <i class="icon-reload menu-icon"></i>
                                <span class="menu-title">Purchase</span>
                            </a>
                        </li>
                        <li class="nav-item <?= ($menu == "shipper") ? "active" : "" ?>">
                            <a class="nav-link" href="{{ url('inventory/shipper') }}">
                                <i class="icon-reload menu-icon"></i>
                                <span class="menu-title">Shipper Info</span>
                            </a>
                        </li>
                        <li class="nav-item <?= ($menu == "consignee") ? "active" : "" ?>">
                            <a class="nav-link" href="{{ url('inventory/consignee') }}">
                                <i class="icon-reload menu-icon"></i>
                                <span class="menu-title">Consignee Info</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper" style="min-height: calc(100vh - 174px);">
                    @yield('content')
                </div>
            
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer container">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?= date('Y'); ?> Stellar. All rights reserved. <a href="/"> Terms of use</a><a href="/">Privacy Policy</a></span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="icon-heart text-danger"></i></span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
        </div>
        <!-- main-panel ends -->
    </div>
    
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/misc.js') }}"></script> --}}
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/dashboard.js') }}"></script> --}}

    <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    
    <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>

    <script src="{{ asset('assets/vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/daterangepicker/daterangepicker.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script type="text/javascript" src="{{ asset('newdesign/js/image-uploader.min.js') }}"></script>

    <script src="{{ asset('admindesign/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <script src="{{ asset('admindesign/js/plugin/jquery.number.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
            $('.delete-image').click(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if (confirm("Are you sure want to delete it ?")) {


                    var id = this.id;
                    $.ajax({
                        url: '{{ route('products.delete_add_image') }}',
                        type: 'POST',
                        data: {
                            id: id
                        },
                        success: function(result) {
                            $('#previd' + id).remove();
                        }
                    });
                }

            });
        });
        $(function() {
            var imagesPreview = function(input, placeToInsertImagePreview) {
                var ext = input.files[0].name.split(".");
                ext = ext[ext.length - 1].toLowerCase();
                var arrayExtensions = ["jpg", "jpeg", "png"];

                if (arrayExtensions.lastIndexOf(ext) == -1) {
                    alert("Wrong extension type.");
                    $("#gallery-photo-add").val("");
                    return false;
                }
                if (input.files[0].size > 2000000) {
                    alert("Image too large");
                    $("#gallery-photo-add").val("");
                    return false;
                }

                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(
                                placeToInsertImagePreview);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }

            };
            $('#gallery-photo-add').on('change', function() {

                $(".gallery img:last-child").remove()
                imagesPreview(this, 'div.gallery');
            });
        });
        $('.input-images-1').imageUploader();
    </script>

    <script>
        $(".myselect2").select2();

        $('.price_check').keyup(function(e) {
            e.preventDefault();
            var price_from = $('#price_from').val();
            var price_to = $('#price_to').val();

            if (parseInt(price_to) < parseInt(price_from)) {
                $('#price_to_error').css('display', 'block');
                // $this.focus();
                e.preventDefault();
            } else {
                $('#price_to_error').css('display', 'none');
            }

        });
        $('.product_price_show').change(function() {
            if (this.value == '1') {
                // $('#price_section').css('display', 'contents');
                $('#price_ask').css('display', 'none');
                $('#fixed_price').css('display', 'block');
                $('#price_section').css('display', 'contents');
                $('#range_show').prop('checked', 'true');

            } else if (this.value == '0') {
                $('#price_section').css('display', 'none');
                $('#fixed_price').css('display', 'none');
                $('#fixed_price_section').css('display', 'none');
                $('#price_ask').css('display', 'block');
                $('#price_from').val(0);
                $('#price_to').val(0);

            }
        });
        $('.product_fixed_price_show').change(function() {
            if (this.value == '1') {
                $('#fixed_price_section').css('display', 'contents');
                $('#price_section').css('display', 'none');

            } else if (this.value == '0') {
                $('#price_section').css('display', 'contents');
                $('#fixed_price_section').css('display', 'none');
                $('#price_from').val(0);

            }
        });
        $("#price_fixed").keyup(function(e) {

            e.preventDefault();
            var price_fixed = $('#price_fixed').val();
            console.log(price_fixed);
            $('#price_to').val(price_fixed);

        });
        $("#product_submit").click(function(e) {

            var desc = CKEDITOR.instances['prod_description'].getData();
            if (desc == '') {
                CKEDITOR.instances['prod_description'].focus();
                $("#prod_des").scrollTop();
                e.preventDefault();
                return false;
            }
        });



        $('#makePdfContainer1').click(function() {
            var pdf = new jsPDF('p', 'pt', 'letter'), source = $('#sideview5')[0], specialElementHandlers = {}

            margins = {
                top: 80,
                bottom: 60,
                left: 40,
                width: 522
            };
            // all coords and widths are in jsPDF instance's declared units
            // 'inches' in this case
            pdf.fromHTML
            (
                source // HTML string or DOM elem ref.
              , margins.left // x coord
              , margins.top // y coord
              , {'width': margins.width // max width of content on PDF
                 , 'elementHandlers': specialElementHandlers
                }
              , function (dispose) 
                {
                   // dispose: object with X, Y of the last line add to the PDF
                   // this allow the insertion of new lines after html
                   pdf.save('Mypdf.pdf');
                }
              , margins
            )
        });

        $('#makePdfContainer').click(function() {
            var HTML_Width = $("#sideview5").width();
            var HTML_Height = $("#sideview5").height();
            var top_left_margin = 25;
            var PDF_Width = HTML_Width+(top_left_margin*2);
            var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;
            
            var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;
		

            html2canvas($("#sideview5")[0],{allowTaint:true}).then(function(canvas) {
                canvas.getContext('2d');
                
                console.log(canvas.height+"  "+canvas.width);
                
                
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
                
                
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                
                pdf.save("loading-list.pdf");
            });
        });
    </script>
    <script>
        // $('#lineChart').sparkline([102, 109, 120, 99, 110, 105, 115], {
        //     type: 'line',
        //     height: '70',
        //     width: '100%',
        //     lineWidth: '2',
        //     lineColor: '#177dff',
        //     fillColor: 'rgba(23, 125, 255, 0.14)'
        // });

        // $('#lineChart2').sparkline([99, 125, 122, 105, 110, 124, 115], {
        //     type: 'line',
        //     height: '70',
        //     width: '100%',
        //     lineWidth: '2',
        //     lineColor: '#f3545d',
        //     fillColor: 'rgba(243, 84, 93, .14)'
        // });

        // $('#lineChart3').sparkline([105, 103, 123, 100, 95, 105, 115], {
        //     type: 'line',
        //     height: '70',
        //     width: '100%',
        //     lineWidth: '2',
        //     lineColor: '#ffa534',
        //     fillColor: 'rgba(255, 165, 52, .14)'
        // });
    </script>
    <script>
        $(document).ready(function() {
            $('#basic-datatables').DataTable({});
            $('#products-datatables').DataTable({});
            $('#requests-datatables').DataTable({});
            $('#quotation-datatables').DataTable({});
            $('#purchase-datatables').DataTable({});
            $('#completes-datatables').DataTable({});
            $('#archived-datatables').DataTable({});
            $('#callback-datatables').DataTable({});


            $('#multi-filter-select').DataTable({
                "pageLength": 25,
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-control"><option value=""></option></select>'
                            )
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>')
                        });
                    });
                }
            });

            // Add Row
            $('#add-row').DataTable({
                "order": [
                    [0, "desc"]
                ],
                "pageLength": 25,
            });

            var action =
                '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

            $('#addRowButton').click(function() {
                $('#add-row').dataTable().fnAddData([
                    $("#addName").val(),
                    $("#addPosition").val(),
                    $("#addOffice").val(),
                    action
                ]);
                $('#addRowModal').modal('hide');

            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var alls = $('.product-list tbody').children();

            $('body').on('click', '#selectAll', function() {
                if ($(this).hasClass('allChecked')) {
                    $('.checks input[type="checkbox"]', alls).prop('checked', false);
                    var table = $(".product-list").DataTable();
                    table.$("input[type='checkbox']").prop('checked', false);

                    $('.checkVals').val('');

                    // $('.submit_checkbox').remove();
                } else {
                    // $('input[type="checkbox"]', alls).prop('checked', true);
                    var table = $(".product-list").DataTable();
                    table.$("input[type='checkbox']").prop('checked', true);
                    var ids = [];

                    $('.product-list input:checked').each(function() {
                        if ($(this).attr('id') == 'selectAll') {

                        } else
                            ids.push($(this).val());
                    });

                    $('.checkVals').val(ids);
                }
                $(this).toggleClass('allChecked');


            })
        });
        $('.submit_checkbox').click(function() {
            submitcheck();
        });

        function submitcheck() {
            var ids = $('.checks').val();
            var table = $(".product-list").DataTable();
            var ids = [];
            table.$('td > input:checkbox').each(function() {
                if (this.checked) {
                    ids.push($(this).val());
                }
            });
            var ids = ids.toString();
            if (!ids) {
                alert('There are not any chosen items now.');
                return;
            }
            var href = $('.url').val();

            $.ajax({
                url: href,
                type: 'GET',
                data: {
                    ids: ids
                },
                success: function(result, status) {
                    if (result.status == 200) {
                        location.reload();

                    } else {
                        alert(result.msg);
                    }
                }
            })
        };
    </script>
    <script>
        function deleteCustomer(obj) {
            $(obj).closest('div.divCustomer').remove();
        }

        function deleteThis(obj) {
            $(obj).closest('div').remove();
        }

        function deleteCategory(obj) {
            $(obj).closest('div.cpy_div').remove();
        }

        function deleteTblRow(obj) {
            $(obj).closest('tr').remove();
        }

        $(document).on('change', '.prdLst', function() {
            var id = $(this).attr('id');
            id = id.split("_");
            var catid = parseInt(id[1]) + 1;

            var $tableBody = $('#myTable_' + id[1]).find("tbody"),
                $trLast = $tableBody.find("tr:first"),
                $trNew = $trLast.clone();
            var cyp_row = $trNew.attr('id');
            cyp_row = cyp_row.split("_");
            cyp_id = parseInt(cyp_row[2]) + 1;
            $("#" + cyp_row[0] + "_" + cyp_row[1] + "_" + cyp_row[2]).attr('id', cyp_row[0] + "_" + cyp_row[1] +
                "_" + cyp_id);


            $trLast.after($trNew);
        });
        $(document).on('click', '#add_customer', function() {
            var catid = $('.addMark').attr('id');
            catid = catid.split("_");
            var old_cat_id = catid[1];
            if ($('#customerList_' + old_cat_id).val() == '') {
                alert('Please select customer');
                return false;
            }
            catid = parseInt(catid[1]) + 1;

            $("#customer_div").clone().insertAfter("#card-header");



            $("#customerList").attr('id', 'customerList_' + catid);
            for (var i = 1; i <= old_cat_id; i++) {
                var selectedCus = $('#customerList_' + i).val();
                $('#customerList_' + catid + ' option[value="' + selectedCus + '"]').remove();
            }
            var cusLength = $('#customerList_' + catid + '> option').length;
            if (cusLength <= 1) {
                $('#customer_div').remove();
                alert('All customer added in this container');
            } else {
                $('#customer_div').removeAttr('style');
                $('#customer_div').removeAttr('id');
            }
            $("#nameMark").attr('name', 'mark_' + catid + '[]');
            $('#nameMark').removeAttr('id');

            $("#addMarkBtnId").attr('id', 'addMark_' + catid);
            $('#addMark_' + catid).addClass('addMark');
            $('#addMark').addClass('markDiv_' + catid);
            $('#addMark').removeAttr('id');
            $('.slect').addClass('myselect2');

        });
        $(document).on('change', '.catLst', function(e) {
            var id = $(this).attr('id');
            id = id.split("_");
            console.log(id);
            var catid = parseInt(id[1]);
            var cat_id = e.target.value;
            $.get('./../ajax_cat_prod/' + cat_id, function(data) {
                var subcat = $('#prdLst_' + catid).empty();
                $.each(data, function(key, value) {
                    subcat.append('<option value ="' + value.id + '">' + value.name +
                        '</option>');
                });
            });
        });
        $(document).on('change', '.categorySlt', function(e) {
            var id = $(this).attr('id');
            id = id.split("_");
            var catid = parseInt(id[1]);
            var cat_id = e.target.value;
            $.get('./../purchase/ajax_cat_prod/' + cat_id, function(data) {
                var subcat = $('#prodid_' + catid).empty();
                $.each(data, function(key, value) {
                    subcat.append('<option value ="' + value.id + '">' + value.name +
                        '</option>');
                });
            });
        });
        $(document).on('change', '.productSlt', function(e) {
            var id = $(this).attr('id');
            id = id.split("_");
            var catid = parseInt(id[1]);
            var cat_id = e.target.value;
            $.get('./../purchase/ajax_prod/' + cat_id, function(data) {
                $('#unitname_' + id[1]).text(data.unitname);
                $('#price_' + id[1]).val(data.price);
            });
        });
        $(document).on('change', '.vatAdd', function(e) {
            var rowId = $(this).closest('tr').attr('id');
            rowId = rowId.split("_");
            var item = $('#item_' + rowId[1]).val();
            var price = $('#price_' + rowId[1]).val();
            var total = parseInt(item) * parseInt(price);
            $("#vatamount_" + rowId[1]).text(0.00);
            if ($('#vat_' + rowId[1]).val() == 1) {
                $("#vatamount_" + rowId[1]).text($.number(Math.ceil(total * 0.05), 2));
                total = Math.ceil(parseFloat(total) + parseFloat(total * 0.05));
            }
            $("#totaltext_" + rowId[1]).text($.number(total, 2));
            $("#total_" + rowId[1]).val(total);
            var rowCount = $('#prodTbl >tbody >tr').length;
            var totalPrice = 0;
            for (var i = 0; i < rowCount; i++) {
                totalPrice = parseInt(totalPrice) + parseInt($('#total_' + i).val());
            }
            $('#totalTxt').text($.number(totalPrice, 2));
            $('#alltotal').val(totalPrice);
        });
        $(document).on('click', '#addProduct', function(e) {
            var $tableBody = $('#prodTbl').find("tbody"),
                $trLast = $tableBody.find("tr:first"),
                $trNew = $('#cpyTr').clone();
            var cyp_row = $trLast.attr('id');
            var catId = $('.categorySlt').attr('id');
            catId = catId.split("_");
            catId = parseInt(catId[1]) + 1;
            $trLast.before($trNew);
            $("#cpyTr").attr('id', 'cpyTr_' + catId);
            $("#catid").attr('id', 'catid_' + catId);
            $("#prodid").attr('id', 'prodid_' + catId);
            $("#unitname").attr('id', 'unitname_' + catId);
            $("#item").attr('id', 'item_' + catId);
            $("#price").attr('id', 'price_' + catId);
            $("#vat").attr('id', 'vat_' + catId);
            $("#beforevat").attr('id', 'beforevat_' + catId);
            $("#vatamount").attr('id', 'vatamount_' + catId);
            $("#totaltext").attr('id', 'totaltext_' + catId);
            $("#total").attr('id', 'total_' + catId);
        });

        $(document).on('keyup', '.itemNo', function() {
            var rowId = $(this).closest('tr').attr('id');
            rowId = rowId.split("_");
            var item = $('#item_' + rowId[1]).val();
            var price = $('#price_' + rowId[1]).val();
            var total = parseFloat(item) * parseFloat(price);
            $("#beforevat_" + rowId[1]).text($.number(total, 2));
            if ($('#vat_' + rowId[1]).val() == 1) {
                $("#vatamount_" + rowId[1]).text($.number(Math.ceil(total * 0.05), 2));
                total = Math.ceil(parseFloat(total) + parseFloat(total * 0.05));
            }
            $("#totaltext_" + rowId[1]).text($.number(total, 2));
            $("#total_" + rowId[1]).val(total);
            var rowCount = $('#prodTbl >tbody >tr').length;
            var totalPrice = 0;
            for (var i = 0; i < rowCount; i++) {
                totalPrice = parseFloat(totalPrice) + parseFloat($('#total_' + i).val());
            }
            $('#totalTxt').text($.number(totalPrice, 2));
            $('#alltotal').val(totalPrice);

        });

        function deleteTblRowProd(obj) {
            $(obj).closest('tr').remove();
            var totalPrice = 0;
            $("input[name='total[]']").each(function() {
                totalPrice = parseInt(totalPrice) + parseInt($(this).val());
            });

            $('#totalTxt').text(totalPrice);
            $('#alltotal').val(totalPrice);

        }

        $(document).on('keyup', '.mkkk', function() {
            var fStock = 0;
            var rowId = $(this).closest('tr').attr('id');
            rowId = rowId.split("_");
            var iStock = $('.iStock_' + rowId[1]).val();
            var inputs = $(".mark_" + rowId[1]);
            for (var i = 0; i < inputs.length; i++) {
                fStock = parseInt(fStock) + parseInt($(inputs[i]).val());
            }
            var stk = parseInt(iStock) - parseInt(fStock);
            if (stk < 0) {
                var fStock = 0;
                alert("Product not in stock");
                $(this).val(0);
                var inputs = $(".mark_" + rowId[1]);
                for (var i = 0; i < inputs.length; i++) {
                    fStock = parseInt(fStock) + parseInt($(inputs[i]).val());
                }
                fStocknew = parseInt(iStock) - parseInt(fStock);
                $('.stock_' + rowId[1]).val(fStocknew);
            } else {
                $('.stock_' + rowId[1]).val(stk);
            }
        });

        $(document).on('click', '.add_category', function() {
            var old_cat_id = $(this).attr('id');
            old_cat_id = old_cat_id.split("_");
            old_cat_id = old_cat_id[1];
            var id = $('.addProduct').attr('id');
            id = id.split("_");
            id = parseInt(id[1]) + 1;

            var copyContent = $("#addTable_" + old_cat_id).clone();
            $('.addTable_' + old_cat_id).append(copyContent);
            $('#category_div').attr('class', 'card cpy_div addTable_' + old_cat_id);
            $('#category_div').removeAttr('style');
            $('#category_div').removeAttr('id');
            $("#addProduct").attr('id', 'addProduct_' + id);
            $("#myTable").attr('id', 'myTable_' + id);
            $('#addProduct_' + id).addClass('addProduct');
            $('#addTable').removeAttr('id');
            $('.slect').addClass('myselect2');

        });
        $(document).on('click', '.addMark', function() {
            var batchId = $("#container_batch").val();
            var markId = $(this).attr('id');
            markId = markId.split("_");
            var check1 = 'mark_' + markId[1];
            var emptyCheck = $('input[name="mark_' + markId[1] + '[]"]').val();
            var found = 0;
            $.ajax({
                url: 'ajax_mark/' + batchId,
                cache: false,
                async: false,
                success: function(data) {
                    console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].name == emptyCheck) {
                            found = 1;
                            break;
                        }
                    }
                    return false;
                }
            });
            if (found == 1) {
                alert("Already added this mark in a batch");
                return false;

            }
            var arr = $('input[name="mark_' + markId[1] + '[]"]').map(function() {
                return this.value; // $(this).val()
            }).get();
            let hasDuplicate = arr.some((val, i) => arr.indexOf(val) !== i);
            if (emptyCheck == '') {
                alert("Mark did not added.");
                return false;

            }
            if (hasDuplicate == true) {
                alert("Already added this mark");
                return false;

            }
            $('#addMark_' + markId[1]).after('<div  class="bg-white markDiv_' + markId[1] +
                '" ><div class="span-title pt-3 pb-3"><input type="text" name="mark_' +
                markId[1] +
                '[]" class="form-control" placeholder="Mark" /></div><button type="button" class="btn btn-danger" onclick="deleteThis(this)">Delete Mark</button></div>'
            );

        });

        $(document).on('change', '#container_number', function(e) {
            var container_number = $('#container_number').val().length;
            if (container_number > 7) {
                alert('Container number should not be greater than 7');
                $('#container_number').val('');
            }
        });


        $(document).ready(function() {

            $(".container_total").each(function() {
                var total = $(this).val();
                var id = $(this).attr('data-id');
                $('#container_amount_' + id).text("( Total - " + $.number(total ,2) + ' AED )');
            });
            var current_balance = $('#current_balance').val();
            var customer_expense = $('#customer_expense').val();
            console.log(current_balance);
            var balance = parseFloat(current_balance) - parseFloat(customer_expense);
            $('#expense').text('Expense :' + $.number(customer_expense,2) +' AED');
            $('#balance').text('Balance :' + $.number(balance,2)+' AED');

        });

        $(document).on('click', '#makePdf', function(e) {

            var pdfname = $('#pdfName').val();
            var doc = new jsPDF();
            doc.addHTML($('#invoicePdf'), {
                'background': '#fff',
            }, function() {
                doc.save(pdfname+'.pdf');
            });

        });
        $('#alert_demo_7').click(function(e) {
					swal({
						title: 'Are you sure?',
						text: "You won't be able to change anything in this container!",
						type: 'warning',
						buttons:{
							confirm: {
								text : 'Yes, Lock it!',
								className : 'btn btn-success'
							},
							cancel: {
								visible: true,
								className: 'btn btn-danger'
							}
						}
					}).then((Lock) => {
						if (Lock) {
							swal({
								title: 'LOCKED!',
								text: 'Your container has been Locked.',
								type: 'success',
								buttons : {
									confirm: {
										className : 'btn btn-success'
									}
								}
							}).then((Lock) => {
                                window.location.href = './../../container';
                            });

						} else {
							swal.close();
						}

					});
				});
    </script>

    @yield('script')
</body>

</html>
<!-- Localized -->
