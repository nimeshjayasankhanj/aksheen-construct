@include('includes.header_start')

<!-- Plugins css -->
<link href="{{ URL::asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}"
    rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"
    rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}"
    rel="stylesheet" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="{{ URL::asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/jquery.notify.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/mdb.css') }}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
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

        <div class="col-lg-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <form action="{{ route('customers') }}" method="get">
                        {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6 form-group" style="padding-top: 6px">

                                <div class="input-group">
                                    <input type="search" name="search" id="search" class="form-control"
                                        placeholder="Search Customer here">
                                </div>

                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-md btn-outline-success waves-effect"
                                style="border-radius: 24px">Search
                            </button>
                        </div>
                        <div class="col-lg-4 form-group">
                            <button type="button" class="btn btn-md btn-outline-primary waves-effect float-right"
                                data-toggle="modal" data-target="#addCustomer" style="border-radius: 24px">
                                Add Customer</button>
                        </div>
                    </div>
                </form>

                    <div class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>CUSTOMER NAME</th>
                                        <th>CONTACT NO</th>
                                        <th>STATUS</th>
                                        <th>OPTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($customers))
                                        @if (count($customers) == 0)
                                            <tr>
                                                <td colspan="8" style="text-align: center;font-weight: bold  ">Sorry No
                                                    Results Found.
                                                </td>
                                            </tr>
                                        @endif
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td>{{ $customer->first_name }} {{ $customer->last_name }} </td>
                                                <td>{{ $customer->contactNo1 }}</td>

                                                @if ($customer->status == 1)

                                                    <td>
                                                        <p>
                                                            <input type="checkbox"
                                                                onchange="adMethod('{{ $customer->iduser }}','supplier')"
                                                                id="{{ 'c' . $customer->iduser }}" checked
                                                                switch="none" />
                                                            <label for="{{ 'c' . $customer->iduser }}"
                                                                data-on-label="On" data-off-label="Off"></label>
                                                        </p>
                                                    </td>
                                                @else
                                                    <td>
                                                        <p>
                                                            <input type="checkbox"
                                                                onchange="adMethod('{{ $customer->iduser }}','supplier')"
                                                                id="{{ 'c' . $customer->iduser }}" switch="none" />
                                                            <label for="{{ 'c' . $customer->iduser }}"
                                                                data-on-label="On" data-off-label="Off"></label>
                                                        </p>
                                                    </td>
                                                @endif
                                                <td>
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-outline-success waves-effect btn-sm dropdown-toggle"
                                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            Option
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a href="#" class="dropdown-item" data-toggle="modal"
                                                                data-id="{{ $customer->iduser }}"
                                                                id="updateCustomerModal"
                                                                data-target="#updateCustomer">Edit
                                                            </a>
                                                            <a href="#" class="dropdown-item" data-toggle="modal"
                                                                data-id="{{ $customer->iduser }}"
                                                                id="viewCustomerModal" data-target="#viewCustomer">View
                                                            </a>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                            {{ $customers->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--add supplier model-->
<div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Add Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <label for="example-text-input" class="col-form-label">Customer Name<span style="color: red">
                                *</span></label>
                        <input type="text" class="form-control" name="customerName" id="customerName" required
                            placeholder="Customer Name" />
                        <small class="text-danger" id="customerNameError"></small>
                    </div>
                    <div class="col-lg-6">

                        <label for="example-text-input" class="col-form-label">Contact No<span style="color: red">
                                *</span></label>
                        <input type="number" class="form-control" name="contactNo1"
                            oninput="this.value = Math.abs(this.value)" id="contactNo1" required
                            placeholder="(+94) XXX XXXXXX" />
                        <small class="text-danger" id="contactNo1Error"></small>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12 form-group">
                        <label for="example-text-input" class="col-form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="address" required
                            placeholder="Address" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 ">
                        <button type="button" class="btn btn-md btn-outline-primary waves-effect " id="saveButton"
                            onclick="saveCustomer()" style="border-radius: 24px">
                            Save Customer</button>
                        <button type="submit" class="btn btn-md btn-outline-primary waves-effect" id="waitButton"
                            style="border-radius: 24px;display: none">
                            <i class="fa fa-circle-o-notch fa-spin"></i> Plsease Wait</button>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!--view supplier-->

<div class="modal fade" id="viewCustomer" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">View Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">


                <div class="table-rep-plugin">
                    <div class="table-responsive b-0" data-pattern="priority-columns">
                        <table id="tech-companies-1" class="table  table-striped">

                            <tbody id="dataViewBody">

                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


<!--update supplier-->
<div class="modal fade" id="updateCustomer" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Edit Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Customer Name<span
                                    style="color: red"> *</span></label>
                            <input type="text" class="form-control" name="uCustomerName" id="uCustomerName" required
                                placeholder="Customer Name" />
                                <small class="text-danger" id="uCustomerNameError"></small>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Contact No<span style="color: red">
                                    *</span></label>
                            <input type="text" class="form-control" name="uContactNo1"
                                oninput="this.value = Math.abs(this.value)" id="uContactNo1" required
                                placeholder="(+94) XXX XXXXXX" />
                                <small class="text-danger" id="uContactNo1NameError"></small>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Address</label>
                            <input type="text" class="form-control" name="uAddress" id="uAddress"
                                placeholder="Address" />
                        </div>
                    </div>
                </div>
                <input id="hiddenCustomerId" type="hidden">
                <div class="row">
                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-md btn-outline-warning waves-effect" id="editButton"
                            onclick="updateCustomer()" style="border-radius: 24px">
                            Update Customer</button>

                        <button type="submit" class="btn btn-md btn-outline-warning waves-effect" id="uWaitButton"
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
<script src="{{ URL::asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('assets/pages/sweet-alert.init.js') }}"></script>

<!-- Parsley js -->
<script type="text/javascript" src="{{ URL::asset('assets/plugins/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/bootstrap-notify.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/my_alerts.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.notify.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $(document).on('focus', ':input', function() {
        $(this).attr('autocomplete', 'off');
    });
    $('.modal').on('hidden.bs.modal', function() {
        $('#customerNameError').html("");
        $('#contactNo1Error').html("");

        $('#uCustomerNameError').html("");
        $('#uContactNo1Error').html("");
        $('input').val('');
    });

    function adMethod(dataID, tableName) {

        $.post('activateDeactivate', {
            id: dataID,
            table: tableName
        }, function(data) {

        });
    }


    function saveCustomer() {

        $('#customerNameError').html("");
        $('#contactNo1Error').html("");

        $("#saveButton").hide();
        $("#waitButton").show();

        var customerName = $("#customerName").val();
        var contactNo1 = $("#contactNo1").val();
        var address = $("#address").val();

        $.post('saveCustomer', {
            customerName: customerName,
            contactNo1: contactNo1,
            address: address,

        }, function(data) {




            if (data.errors != null) {

                if (data.errors.customerName) {
                    var p = document.getElementById('customerNameError');
                    p.innerHTML = data.errors.customerName;

                }
                if (data.errors.contactNo1) {
                    var p = document.getElementById('contactNo1Error');
                    p.innerHTML = data.errors.contactNo1;

                }

                $("#saveButton").show();
                $("#waitButton").hide();
            }
            if (data.success != null) {
                $("#saveButton").hide();
                $("#waitButton").show();
                notify({
                    type: "success", //alert | success | error | warning | info
                    title: 'CUSTOMER SAVED',
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
                setTimeout(function() {
                    $('#addCustomer').modal('hide');
                }, 200);

            }
            $('tbody').html(data.tableData);
        })
    }


    $(document).on('click', '#viewCustomerModal', function() {

        var CustomerId = $(this).data("id");

        $.post('viewCustomer', {
            CustomerId: CustomerId
        }, function(data) {

            $("#dataViewBody").html(data.tableData);
        });
    });


    $(document).on('click', '#updateCustomerModal', function() {

        var customerId = $(this).data("id");

        $.post('getCustomerById', {
            customerId: customerId
        }, function(data) {
            $("#hiddenCustomerId").val(data.iduser);
            $("#uCustomerName").val(data.first_name);
            $("#uContactNo1").val(data.contactNo1);
            $("#uAddress").val(data.address);
        });
    });


    function updateCustomer() {

        $('#uCustomerNameError').html("");
        $('#uContactNo1Error').html("");

        $("#editButton").hide();
        $("#uWaitButton").show();

        var uCustomerName = $("#uCustomerName").val();
        var uContactNo1 = $("#uContactNo1").val();
        var uAddress = $("#uAddress").val();
        var hiddenCustomerId = $("#hiddenCustomerId").val();



        $.post('updateCustomer', {
            hiddenCustomerId: hiddenCustomerId,
            uCustomerName: uCustomerName,
            uContactNo1: uContactNo1,
            uAddress: uAddress,

        }, function(data) {
            if (data.errors != null) {
                if (data.errors.uCustomerName) {
                    var p = document.getElementById('uCustomerNameError');
                    p.innerHTML = data.errors.uCustomerName;

                }
                if (data.errors.uContactNo1) {
                    var p = document.getElementById('uContactNo1Error');
                    p.innerHTML = data.errors.uContactNo1;

                }

                $("#editButton").show();
                $("#uWaitButton").hide();

            }
            if (data.success != null) {
                $("#editButton").show();
                $("#uWaitButton").hide();

                notify({
                    type: "success", //alert | success | error | warning | info
                    title: 'CUSTOMER UPDATED',
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
                setTimeout(function() {
                    $('#updateCustomer').modal('hide');
                }, 200);
            }
            $('tbody').html(data.tableData);
        })
    }

</script>


@include('includes.footer_end')
