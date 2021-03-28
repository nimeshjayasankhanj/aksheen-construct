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
                    <form action="{{ route('employees') }}" method="get">
                        {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6 form-group" style="padding-top: 6px">

                                <div class="input-group">
                                    <input type="search" name="search" id="search" class="form-control"
                                        placeholder="Search Employee here">
                                </div>Employee

                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-md btn-outline-success waves-effect"
                                style="border-radius: 24px">Search
                            </button>
                        </div>
                        <div class="col-lg-4 form-group">
                            <button type="button" class="btn btn-md btn-outline-primary waves-effect float-right"
                                data-toggle="modal" data-target="#addEmployee" style="border-radius: 24px">
                                Add Employee</button>
                        </div>
                    </div>
                </form>

                    <div class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>EMPLOYEE NAME</th>
                                        <th>CONTACT NO</th>
                                        <th>STATUS</th>
                                        <th>OPTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($employees))
                                        @if (count($employees) == 0)
                                            <tr>
                                                <td colspan="8" style="text-align: center;font-weight: bold  ">Sorry No
                                                    Results Found.
                                                </td>
                                            </tr>
                                        @endif
                                        @foreach ($employees as $employee)
                                            <tr>
                                                <td>{{ $employee->first_name }}</td>
                                                <td>{{ $employee->contactNo1 }}</td>

                                                @if ($employee->status == 1)

                                                    <td>
                                                        <p>
                                                            <input type="checkbox"
                                                                onchange="adMethod('{{ $employee->iduser }}','supplier')"
                                                                id="{{ 'c' . $employee->iduser }}" checked
                                                                switch="none" />
                                                            <label for="{{ 'c' . $employee->iduser }}"
                                                                data-on-label="On" data-off-label="Off"></label>
                                                        </p>
                                                    </td>
                                                @else
                                                    <td>
                                                        <p>
                                                            <input type="checkbox"
                                                                onchange="adMethod('{{ $employee->iduser }}','supplier')"
                                                                id="{{ 'c' . $employee->iduser }}" switch="none" />
                                                            <label for="{{ 'c' . $employee->iduser }}"
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
                                                                data-id="{{ $employee->iduser }}"
                                                                id="updateEmployeeModal"
                                                                data-target="#updateEmployee">Edit
                                                            </a>
                                                            <a href="#" class="dropdown-item" data-toggle="modal"
                                                                data-id="{{ $employee->iduser }}"
                                                                id="viewEmployeeModal" data-target="#viewEmployee">View
                                                            </a>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                            {{ $employees->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--add supplier model-->
<div class="modal fade" id="addEmployee" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Add Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <label for="example-text-input" class="col-form-label">Employee Name<span style="color: red">
                                *</span></label>
                        <input type="text" class="form-control" name="employeeName" id="employeeName" required
                            placeholder="Employee Name" />

                            <small class="text-danger" id="employeeNameError"></small>

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
                            onclick="saveEmployee()" style="border-radius: 24px">
                            Save Employee</button>
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

<div class="modal fade" id="viewEmployee" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">View Employee</h5>
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
<div class="modal fade" id="updateEmployee" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Edit Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Employee Name<span
                                    style="color: red"> *</span></label>
                            <input type="text" class="form-control" name="uEmployeeName" id="uEmployeeName" required
                                placeholder="Customer Name" />
                                <small class="text-danger" id="uEmployeeNameError"></small>
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
                <input id="hiddenEmployeeId" type="hidden">
                <div class="row">
                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-md btn-outline-warning waves-effect" id="editButton"
                            onclick="updateEmployee()" style="border-radius: 24px">
                            Update Employee</button>

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
        $('#employeeNameError').html("");
        $('#contactNo1Error').html("");
        $('#uEmployeeNameError').html("");
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


    function saveEmployee() {

        $('#employeeNameError').html("");
        $('#contactNo1Error').html("");

        $("#saveButton").hide();
        $("#waitButton").show();

        var employeeName = $("#employeeName").val();
        var contactNo1 = $("#contactNo1").val();
        var address = $("#address").val();

        $.post('saveEmployee', {
            employeeName: employeeName,
            contactNo1: contactNo1,
            address: address,

        }, function(data) {




            if (data.errors != null) {

                if (data.errors.employeeName) {
                    var p = document.getElementById('employeeNameError');
                    p.innerHTML = data.errors.employeeName;

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
                    title: 'EMPLOYEE SAVED',
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
                    $('#addEmployee').modal('hide');
                }, 200);

            }
            $('tbody').html(data.tableData);
        })
    }


    $(document).on('click', '#viewEmployeeModal', function() {

        var employeeId = $(this).data("id");

        $.post('viewEmployee', {
            employeeId: employeeId
        }, function(data) {

            $("#dataViewBody").html(data.tableData);
        });
    });


    $(document).on('click', '#updateEmployeeModal', function() {

        var employeeId = $(this).data("id");

        $.post('getEmployeeById', {
            employeeId: employeeId
        }, function(data) {
            $("#hiddenEmployeeId").val(data.iduser);
            $("#uEmployeeName").val(data.first_name);
            $("#uContactNo1").val(data.contactNo1);
            $("#uAddress").val(data.address);
        });
    });


    function updateEmployee() {

        $('#uEmployeeNameError').html("");
        $('#uContactNo1Error').html("");

        $("#editButton").hide();
        $("#uWaitButton").show();

        var uEmployeeName = $("#uEmployeeName").val();
        var uContactNo1 = $("#uContactNo1").val();
        var uAddress = $("#uAddress").val();
        var hiddenEmployeeId = $("#hiddenEmployeeId").val();



        $.post('updateEmployee', {
            hiddenEmployeeId: hiddenEmployeeId,
            uEmployeeName: uEmployeeName,
            uContactNo1: uContactNo1,
            uAddress: uAddress,

        }, function(data) {
            if (data.errors != null) {
                if (data.errors.uCustomerName) {
                    var p = document.getElementById('uEmployeeNameError');
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
                    title: 'EMPLOYEE UPDATED',
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
                    $('#updateEmployee').modal('hide');
                }, 200);
            }
            $('tbody').html(data.tableData);
        })
    }

</script>


@include('includes.footer_end')
