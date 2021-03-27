@include('includes.header_start')


<!-- DataTables -->
<link href="{{ URL::asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ URL::asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<!-- Responsive datatable examples -->
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<!-- Plugins css -->
<link href="{{ URL::asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}"
    rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"
    rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}"
    rel="stylesheet" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="{{ URL::asset('assets/css/jquery.notify.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/mdb.css') }}" rel="stylesheet" type="text/css">


@include('includes.header_end')

<!-- Page title -->
<ul class="list-inline menu-left mb-0">
    <li class="list-inline-item">
        <button type="button" class="button-menu-mobile open-left waves-effect">
            <i class="ion-navicon"></i>
        </button>
    </li>
    <li class="hide-phone list-inline-item app-search">
        <h3 class="page-title">{{ $title }}</h3>
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
        <div class="col-md-12">
            <div class="card m-b-20">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible " id="errorAlert" style="display:none">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Product<span style="color: red"> *</span></label>
                                <select class="form-control select2 tab" onchange="getProductPrice(this.value);"
                                    name="item" id="item" required>
                                    <option value="" disabled selected>Select Product
                                    </option>
                                    @if (isset($products))
                                        @foreach ($products as $product)
                                            <option value="{{ "$product->idproduct" }}">
                                                {{ "$product->product_name" }} </option>
                                        @endforeach
                                    @endif
                                </select>
                                <small class="text-danger" id="productError"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Buying Price <span style="color: red"> *</span></label>
                            <input type="number" class="form-control tab" name="costPrice" id="costPrice" min="0"
                                oninput="this.value = Math.abs(this.value)" placeholder="0.00" />
                            <small class="text-danger" id="buyingPriceError"></small>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Qty <span style="color: red"> *</span></label>
                                <input type="number" class="form-control tab" name="qty" id="qty" min="0"
                                    oninput="this.value = Math.abs(this.value)" placeholder="0" />
                                <small class="text-danger" id="qtyError"></small>
                            </div>
                        </div>

                    </div>
                    <div class="row">


                        <div class="col-md-2">
                            <button onclick="addItem()" type="button"
                                class="btn btn-md btn-outline-primary waves-effect" style="border-radius: 24px"
                                id="saveItemBtn"> Add to Table</button>
                            <button type="submit" class="btn btn-md btn-outline-primary waves-effect" id="waitItemButton"
                                style="border-radius: 24px;display: none">
                                <i class="fa fa-circle-o-notch fa-spin"></i> Plsease Wait</button>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card m-b-20">
                <div class="card-body">

                    <div class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>PRODUCT NAME</th>
                                        <th>QTY</th>
                                        <th style="text-align: right;">BUYING PRICE</th>
                                        <th style="text-align: right;">TOTAL PRICE</th>
                                        <th style="text-align: center">OPTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-10"></div>
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-md btn-outline-primary waves-effect float-right"
                                data-toggle="modal" data-target="#saveGrn" id="savePOButton" onclick="showSaveModal()"
                                style="border-radius: 24px">
                                Make a Payment</button>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="saveGrn" tabindex="-1" role="dialog" style="overflow-y:scroll;"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Save GRN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <input type="hidden" name="hiddenGrnID" id="hiddenGrnID">
                <div class="row">

                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible " id="errorAlert2" style="display:none">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="supplier">Supplier</label>
                            <select class="form-control select2" name="supplier" id="supplier" required>
                                <option disabled value="" selected>Select Supplier
                                </option>
                                @if (isset($suppliers))
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ "$supplier->idsupplier" }}">
                                            {{ "$supplier->company_name" }}
                                        </option>
                                    @endforeach
                                @endif

                            </select>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="total">Sub Total</label>
                            <input class="form-control" type="number" min="0" readonly
                                oninput="this.value = Math.abs(this.value);countNet()" onchange="countNet()" id="total"
                                name="total">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="discount">Discount</label>
                            <div class="input-group">
                                <input class="form-control" type="number" min="0"
                                    oninput="this.value = Math.abs(this.value);countNet()" onchange="countNet()"
                                    id="discount" name="discount">
                                <div class="input-group-append">
                                    <select class="form-control select2 doNotClear" name="discountType"
                                        onchange="$('#discount').val('0');countNet();" id="discountType" required>
                                        <option value="1" selected>% &nbsp;</option>
                                        <option value="2">Rs. &nbsp;</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="net">Net Total</label>
                            <input class="form-control" min="0" readonly type="number" id="net" name="net">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <label>Payment Type</label>
                        <select class="form-control" name="payment" onchange="paymentTypeChanged(this)" id="payment"
                            required>
                            <option disabled value="" selected>Payment Type
                            </option>

                            <option value="1">Cash Payment
                            </option>

                        </select>
                    </div>
                </div>

                <br>

                <div style="display: none" id="paidDueDiv">

                    <div class="row col-md-12">
                        <h6>CASH PAYMENTS</h6>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Paid Amount</label>
                            <div class="input-group mb-2 ">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rs.</div>
                                </div>
                                <input class="form-control" type="number" placeholder="0.00"
                                    oninput="this.value = Math.abs(this.value)" id="paid" name="paid">
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-md btn-outline-primary waves-effect float-right" id="saveGrnBtn"
                    onclick="saveGrn()" style="border-radius: 24px">
                    Save GRN</button>


                <button type="submit" class="btn btn-md btn-outline-primary waves-effect" id="waitButton"
                    style="border-radius: 24px;display: none">
                    <i class="fa fa-circle-o-notch fa-spin"></i> Plsease Wait</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="editProductModal" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible " id="errorAlert2" style="display:none">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4">
                        <input type="hidden" id="grnId" />
                        <div class="form-group">
                            <label>Product</label>
                            <select class="form-control select2 " onchange="uGetProductPrice(this.value);" name="uItem"
                                id="uItem" required>
                                <option value="" disabled selected>Select Product
                                </option>

                                @if (isset($products))
                                    @foreach ($products as $product)
                                        <option value="{{ "$product->idproduct" }}">
                                            {{ "$product->product_name" }} </option>
                                    @endforeach
                                @endif
                            </select>
                            <small id="uProductError" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Buying Price</label>
                        <input type="number" class="form-control tab" name="uBPrice" id="uBPrice" min="0"
                            oninput="this.value = Math.abs(this.value)" placeholder="0.00" />
                        <small id="uPriceError" class="text-danger"></small>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Qty</label>
                            <input type="number" class="form-control tab" name="uQty" id="uQty" min="0"
                                oninput="this.value = Math.abs(this.value)" placeholder="0.00" />
                            <small id="uQtyError" class="text-danger"></small>
                        </div>
                    </div>

                </div>
                <div class="row">


                    <div class="col-md-2">
                        <button onclick="updateItem()" type="button" class="btn btn-md btn-outline-warning waves-effect"
                            style="border-radius: 24px" id="updateProductBtn">Update Product</button>

                        <button type="submit" class="btn btn-md btn-outline-warning waves-effect" id="waitUButton"
                            style="border-radius: 24px;display: none">
                            <i class="fa fa-circle-o-notch fa-spin"></i> Plsease Wait</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.footer_start')

<!-- Plugins js -->
<script src="{{ URL::asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"
    type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"
    type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"
    type="text/javascript"></script>

<!-- Plugins Init js -->
<script src="{{ URL::asset('assets/pages/form-advanced.js') }}"></script>

<!-- Required datatable js -->
<script src="{{ URL::asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ URL::asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
<!-- Responsive examples -->
<script src="{{ URL::asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ URL::asset('assets/pages/datatables.init.js') }}"></script>

<!-- Parsley js -->
<script src="{{ URL::asset('assets/js/bootstrap-notify.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('assets/pages/sweet-alert.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.notify.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery('.datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        showGrnTable();

    });

    $(document).on("wheel", "input[type=number]", function(e) {
        $(this).blur();
    });

    $('.modal').on('hidden.bs.modal', function() {

        $('#errorAlert').hide();
        $('#errorAlert').html('');
        $('#errorAlert1').hide();
        $('#errorAlert1').html('');
        $(".select2").val('').trigger('change');
    });



    function getProductPrice(productId) {
        $.post('getProductById', {
            productId: productId,
        }, function(data) {
            if (data != 0) {
                $("#costPrice").val(data.cost_price);
            }
        })
    }

    function addItem() {

        $('#productError').html("");
        $('#buyingPriceError').html("");
        $('#qtyError').html("");

        $("#waitItemButton").show();
        $("#saveItemBtn").hide();


        var item = $("#item").val();
        var qty = $("#qty").val();
        var costPrice = $("#costPrice").val();


        $.post('saveTempGrn', {
            item: item,
            qty: qty,
            costPrice: costPrice,

        }, function(data) {

            if (data.errors != null) {

                $("#waitItemButton").hide();
                $("#saveItemBtn").show();

                if (data.errors.costPrice) {
                    var p = document.getElementById('buyingPriceError');
                    p.innerHTML = data.errors.costPrice;

                }
                if (data.errors.item) {
                    var p = document.getElementById('productError');
                    p.innerHTML = data.errors.item;

                }
                if (data.errors.qty) {
                    var p = document.getElementById('qtyError');
                    p.innerHTML = data.errors.qty;

                }
            }
            if (data.success != null) {

                notify({
                    type: "success", //alert | success | error | warning | info
                    title: 'ADDED TO TABLE',
                    autoHide: true, //true | false
                    delay: 2500, //number ms
                    position: {
                        x: "right",
                        y: "top"
                    },
                    icon: '<img src="{{ URL::asset('assets/images/correct.png') }}" />',

                    message: data.success,
                });

                $('input').val('');
                $(".select2").val('').trigger('change');
                $("#waitItemButton").hide();
                $("#saveItemBtn").show();
            }

            showGrnTable();
        });
    }

    function showGrnTable() {

        $.ajax({

            type: 'post',

            url: 'getGrnTempTableData',

            data: {},

            success: function(data) {

                if (data.total > 0) {
                    $("#total").val(data.total.toFixed(2));
                    $('#savePOButton').show();
                } else {
                    $('#savePOButton').hide();
                }

                $('tbody').html(data.tableData);


            }

        });
    }


    $(document).on('click', '#editProduct', function() {
        var grnId = $(this).data("id");
        $.post('getGRNByID', {
            grnId: grnId
        }, function(data) {

            $("#grnId").val(data.idgrn_temp);
            $("#uItem").val(data.product_idproduct).trigger('change');
            $('#uBPrice').val(data.buying_price);
            $('#uQty').val(data.qty);

        });
    });

    function updateItem() {

        $("#updateProductBtn").hide();
        $("#waitUButton").show();

        $("#uProductError").html("");
        $("#uPriceError").html("");
        $("#uQtyError").html("");

        var uItem = $("#uItem").val();
        var uBPrice = $("#uBPrice").val();
        var uQty = $("#uQty").val();
        var grnId = $("#grnId").val();



        $.post('updateTempItem', {
            grnId: grnId,
            uItem: uItem,
            uBPrice: uBPrice,
            uQty: uQty

        }, function(data) {

            console.log(data)
            if (data.errors != null) {
                $("#updateProductBtn").show();
                $("#waitUButton").hide();

                if (data.errors.uBPrice) {
                    var p = document.getElementById('uPriceError');
                    p.innerHTML = data.errors.uBPrice;

                }
                if (data.errors.uItem) {
                    var p = document.getElementById('uProductError');
                    p.innerHTML = data.errors.uItem;

                }
                if (data.errors.uQty) {
                    var p = document.getElementById('uQtyError');
                    p.innerHTML = data.errors.uQty;

                }
            }
            if (data.success != null) {
                $("#updateProductBtn").show();
                $("#waitUButton").hide();

                notify({
                    type: "success", //alert | success | error | warning | info
                    title: 'PRODUCT UPDATED',
                    autoHide: true, //true | false
                    delay: 2500, //number ms
                    position: {
                        x: "right",
                        y: "top"
                    },
                    icon: '<img src="{{ URL::asset('assets/images/correct.png') }}" />',

                    message: data.success,
                });

                $('input').val('');
                $(".select2").val('').trigger('change');

                setTimeout(function() {
                    $('#editProductModal').modal('hide');
                }, 200);
            }
            showGrnTable();
        });
    }

    $(document).on('click', '#deleteItem', function() {
        var GrnId = $(this).data("id");
        $.post('deleteTempItem', {
            GrnId: GrnId
        }, function(data) {
            notify({
                type: "success", //alert | success | error | warning | info
                title: 'ITEM DELETED',
                autoHide: true, //true | false
                delay: 2500, //number ms
                position: {
                    x: "right",
                    y: "top"
                },
                icon: '<img src="{{ URL::asset('assets/images/correct.png') }}" />',

                message: data.success,
            });
            showGrnTable();
        });
    });





    function getProduct(categoryId) {

        $.post('getProducts', {
            categoryId: categoryId,
        }, function(data) {
            $("#bPrice").val('');
            $("#item").html(data);

        });
    }

    function uGetProduct(categoryId) {

        var uCategory = $("#uCategory").val();
        var proSet = $("#proSet").val();

        if (proSet != uCategory) {
            $.post('getProducts', {
                categoryId: categoryId,
            }, function(data) {
                $("#bPrice").val('');
                $("#uItem").html(data);

            });
        }

    }

    function countNet() {

        let discoutInput = parseFloat($('#discount').val());
        let total = parseFloat($('#total').val());
        let discountType = $("#discountType").val();
        if (discountType == 1) {
            discount = parseFloat(total * (discoutInput / 100));
            if (discoutInput > 100) {
                $('#discount').val(100);
            }

            let NewdiscountInput = parseFloat($('#discount').val());
            let Newtotal = parseFloat($('#total').val());
            Newdiscount = parseFloat(Newtotal * (NewdiscountInput / 100));
            if (Newdiscount != null) {
                $('#net').val(parseFloat(Newtotal - Newdiscount).toFixed(2));
            }

        }
        if (discountType == 2) {
            discount = discoutInput;
            if (discount > total) {
                $('#discount').val(parseFloat(total));
            }

            let Newdiscount = parseFloat($('#discount').val());
            let Newtotal = parseFloat($('#total').val());
            if (Newtotal != null) {
                $('#net').val(parseFloat(Newtotal - Newdiscount).toFixed(2));
            }

        }


    }

    function showSaveModal() {

        $('#discount').val(0);
        $('#paid').val('');
        $('#paidDueDiv').hide();
        $('#discountType').val('1').trigger('change');
        $('#payment').val(1).trigger('change');
        $('#saveGrn').modal('show');
    }

    function paymentTypeChanged(el) {
        let payment = $(el).val();

        $('#paid').val('');
        $('#paidDueDiv').hide();

        if (payment == 1) {
            //             $('#paid').val($('#net').val());
            $('#paidDueDiv').show();
        }

    }

    function uGetProductPrice(productId) {
        $.post('getProductById', {
            productId: productId,
        }, function(data) {
            if (data != 0) {
                $("#bPrice").val(data.buying_price);
            }
        })
    }


    $(document).ready(function() {
        $(document).on('focus', ':input', function() {
            $(this).attr('autocomplete', 'off');
        });
    });

    function saveGrn() {

        $("#saveGrnBtn").hide();
        $("#waitButton").show();

        $('#errorAlert2').hide();
        $('#errorAlert2').html("");

        var supplier = $("#supplier").val();
        var paymentType = $("#payment").val();
        var paid = $("#paid").val();
        let discountType = $("#discountType").val();
        var discount = $("#discount").val();


        if (discountType == 1) {
            var discount = parseFloat(discount / 100);
        } else {
            var discount = $("#discount").val();
        }

        $.post('saveGrn', {

            supplier: supplier,
            discount: discount,
            paymentType: paymentType,
            paid: paid,
            discountType: discountType,

        }, function(data) {

            if (data.errors != null) {

                $("#saveGrnBtn").show();
                $("#waitButton").hide();

                $('#errorAlert2').show();
                $('#errorAlert2').show().scrollTop(0);
                $.each(data.errors, function(key, value) {
                    $('#errorAlert2').append('<p>' + value + '</p>');
                });
            }
            if (data.success != null) {

                notify({
                    type: "success", //alert | success | error | warning | info
                    title: 'GRN SAVED',
                    autoHide: true, //true | false
                    delay: 2500, //number ms
                    position: {
                        x: "right",
                        y: "top"
                    },
                    icon: '<img src="{{ URL::asset('assets/images/correct.png') }}" />',

                    message: data.success,
                });
                $('input').val('');
                $(".supplier").val('').trigger('change');
                $('input').val('');

                $('#saveGrn').modal('hide');
                $("#saveGrnBtn").show();
                $("#waitButton").hide();

                showGrnTable();
            }

        })

    }

</script>


@include('includes.footer_end')
