@include('includes/header_start')

<link href="{{ URL::asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
<!-- Responsive datatable examples -->
<link href="{{ URL::asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset('assets/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<!-- Plugins css -->
<link href="{{ URL::asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset('assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet"/>
<link href="{{ URL::asset('assets/css/custom_checkbox.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset('assets/css/jquery.notify.css')}}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/mdb.css')}}" rel="stylesheet" type="text/css">

<meta name="csrf-token" content="{{ csrf_token() }}"/>


@include('includes/header_end')

<!-- Page title -->
<ul class="list-inline menu-left mb-0">
    <li class="list-inline-item">
        <button type="button" class="button-menu-mobile open-left waves-effect">
            <i class="ion-navicon"></i>
        </button>
    </li>
    <li class="hide-phone list-inline-item app-search">
        <h3 class="page-title">{{$title}}</h3>
    </li>
</ul>

<div class="clearfix"></div>
</nav>

</div>
<!-- Top Bar End -->

<!-- ==================
     PAGE CONTENT START
     ================== -->

<div class="page-content-wrapper">

    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <form action="{{ route('brand') }}" method="GET">
                        <div class="row">

                            <div class="col-lg-7 form-group" style="padding-top: 6px">

                                {{csrf_field()}}
                                <div class="input-group">
                                    <input type="search" name="search" id="search" autocomplete="off" class="form-control"
                                           placeholder="Search Brand here">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-md btn-outline-success waves-effect" style="border-radius: 24px"
                                >Search
                                </button>
                            </div>
                            <div class="col-lg-3">
                                <button type="button" class="btn btn-md btn-outline-primary waves-effect float-right"
                                        data-toggle="modal"  data-target="#addProductModal" style="border-radius: 24px">
                                    Add Product</button>
                            </div>
                        </div>
                    </form>



                    <div class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <table  class="table table-striped table-bordered"
                                    cellspacing="0"
                                    width="100%">
                                <thead>
                                <tr>
                                    <th>BRAND NAME</th>
                                    <th>PRODUCT NAME</th>
                                    <th>CREATED AT</th>
                                    <th>STATUS</th>
                                    <th>UPDATE</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($products))
                                    @if(count($products)==0)
                                        <tr>
                                            <td colspan="6" style="text-align: center;font-weight: bold  ">Sorry No Results Found.
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach($products as $product)
                                        <tr>

                                            <td>{{$product->Category->category_name}}</td>
                                            <td>{{$product->product_name}}</td>
                                            <td>{{$product->created_at}}</td>

                                                @if($product->status == 1)

                                                    <td>
                                                        <p>
                                                            <input type="checkbox"
                                                                   onchange="adMethod('{{ $product->idcategory}}','category')"
                                                                   id="{{"c".$product->idcategory}}" checked
                                                                   switch="none"/>
                                                            <label for="{{"c".$product->idcategory}}"
                                                                   data-on-label="On"
                                                                   data-off-label="Off"></label>
                                                        </p>
                                                    </td>
                                                @else
                                                    <td>
                                                        <p>
                                                            <input type="checkbox"
                                                                   onchange="adMethod('{{ $product->idcategory}}','category')"
                                                                   id="{{"c".$product->idcategory}}"
                                                                   switch="none"/>
                                                            <label for="{{"c".$product->idcategory}}"
                                                                   data-on-label="On"
                                                                   data-off-label="Off"></label>
                                                        </p>
                                                    </td>

                                            @endif
                                            <td>

                                                    <p>
                                                        <button type="button"
                                                                class="btn btn-sm btn-warning  waves-effect waves-light"
                                                                data-toggle="modal"
                                                                data-id="{{ $product->idcategory}}"
                                                                data-name="{{$product->category_name}}"
                                                                id="uBrandID"
                                                                data-target="#editBrandModal"><i
                                                                    class="fa fa-edit"></i>
                                                        </button>
                                                    </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$products->links()}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- add category section -->
@include('products.add-product-from')

<!-- edit category section -->
@include('products.edit-product-form')

@include('includes/footer_start')

<!-- Plugins js -->
<script src="{{ URL::asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"
        type="text/javascript"></script>

<!-- Plugins Init js -->
<script src="{{ URL::asset('assets/pages/form-advanced.js')}}"></script>

<!-- Required datatable js -->
<script src="{{ URL::asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<!-- Buttons examples -->
<script src="{{ URL::asset('assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/buttons.colVis.min.js')}}"></script>
<!-- Responsive examples -->
<script src="{{ URL::asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

<script src="{{ URL::asset('assets/plugins/sweet-alert2/sweetalert2.min.js')}}"></script>
<script src="{{ URL::asset('assets/pages/sweet-alert.init.js')}}"></script>

<!-- Datatable init js -->
<script src="{{ URL::asset('assets/pages/datatables.init.js')}}"></script>

<!-- Parsley js -->
<script type="text/javascript" src="{{ URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/bootstrap-notify.js')}}"></script>
<script src="{{ URL::asset('assets/js/jquery.notify.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('form').parsley();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });
    $(document).on("wheel", "input[type=number]", function (e) {
        $(this).blur();
    });
    function adMethod(dataID, tableName) {

        $.post('activateDeactivate', {id: dataID, table: tableName}, function (data) {

        });
    }
    $('.modal').on('hidden.bs.modal', function () {
        $('input').val('');
        $("#categryError").html('');
        $("#pNameError").html('');
        $("#cPriceError").html('');
        $("#sPriceError").html('');
    });


    //save product
    $("#saveProductId").on("submit", function (event) {
                $("#saveProduct").hide();
                $("#waitButton").show();

                $("#categryError").html('');
                $("#pNameError").html('');
                $("#cPriceError").html('');
                $("#sPriceError").html('');

                var categry=$("#categry").val();

                event.preventDefault();

                    $.ajax({
                        url: '{{route('saveProduct')}}',
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function (data) {
                            if (data.success != null) {
                                $("#saveProduct").show();
                                $("#waitButton").hide();

                                notify({
                                type: "success", //alert | success | error | warning | info
                                title: 'PRODUCT SAVED',
                                autoHide: true, //true | false
                                delay: 2500, //number ms
                                position: {
                                    x: "right",
                                    y: "top"
                                },
                                icon: '<img src="{{ URL::asset('assets/images/correct.png')}}" />',

                                message: data.success,
                                });

                                setTimeout(function () {
                                $('#addProductModal').modal('hide');
                            }, 200);
                            $('tbody').html(data.tableData);
                            }
                        },
                        error: function (data) {
                            $("#saveProduct").show();
                            $("#waitButton").hide();

                            $.each(data.responseJSON.errors, function (parentKey, parentValue) {

                               if(data.responseJSON.errors){
                                   if(data.responseJSON.errors.category!=null){
                                       var error=data.responseJSON.errors.category[0];
                                    document.getElementById('categryError').innerHTML=error;
                                   }

                                   if(data.responseJSON.errors.pName!=null){
                                       var error=data.responseJSON.errors.pName[0];
                                    document.getElementById('pNameError').innerHTML=error;
                                   }

                                   if(data.responseJSON.errors.cPrice!=null){
                                       var error=data.responseJSON.errors.cPrice[0];
                                    document.getElementById('cPriceError').innerHTML=error;
                                   }

                                   if(data.responseJSON.errors.sPrice!=null){
                                       var error=data.responseJSON.errors.sPrice[0];
                                    document.getElementById('sPriceError').innerHTML=error;
                                   }
                               }

                            });
                        }
                    });
                }
            );

    //set brands
    $(document).on('click', '#uBrandID', function () {
        var brandId = $(this).data("id");
        var brandName = $(this).data("name");
       $("#hiddenID").val(brandId);
        $("#uBrand").val(brandName);

    });

    //edit brand
    $("#editBrandId").on("submit", function (event) {
                $("#editBrand").hide();
                $("#uWaitButton").show();

                $("#uCategryError").html('');

                event.preventDefault();

                    $.ajax({
                        url: '{{route('editBrand')}}',
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function (data) {
                            if (data.success != null) {
                                $("#editBrand").show();
                                $("#uWaitButton").hide();

                                notify({
                                type: "success", //alert | success | error | warning | info
                                title: 'BRAND UPDATED',
                                autoHide: true, //true | false
                                delay: 2500, //number ms
                                position: {
                                    x: "right",
                                    y: "top"
                                },
                                icon: '<img src="{{ URL::asset('assets/images/correct.png')}}" />',

                                message: data.success,
                                });

                                setTimeout(function () {
                                $('#editBrandModal').modal('hide');
                            }, 200);
                            }
                        },
                        error: function (data) {
                            $("#editBrand").show();
                            $("#uWaitButton").hide();
                            $.each(data.responseJSON.errors, function (parentKey, parentValue) {
                            $.each(parentValue, function (key, value) {

                               document.getElementById('uCategryError').innerHTML=value;

                            });
                            });
                        }
                    });
                }
            );


</script>


@include('includes/footer_end')
