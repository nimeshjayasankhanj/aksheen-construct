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
                    <form action="{{ route('pending-constructions') }}" method="get">

                        <div class="row">
                            {{ csrf_field() }}


                            <div class="form-group col-md-3 ">
                                <label for="id">Search By</label>
                                <div class="input-group">
                                    <input class="form-control " placeholder="Construction ID" type="number" min="0"
                                        id="constructionId" name="constructionId">

                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>By Date Range</label>

                                <div class="input-daterange input-group" id="date-range">
                                    <input placeholder="dd/mm/yy" type="text" autocomplete="off" class="form-control"
                                        value="" id="startDate" name="startDate" />
                                    <input placeholder="dd/mm/yy" type="text" autocomplete="off" class="form-control"
                                        value="" id="endDate" name="endDate" />

                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label>By Customer</label>
                                <div class="form-group">
                                    <select class="form-control select2 tab" name="customer" id="customer">
                                        <option value="" disabled selected>Select Customer
                                        </option>
                                        @if (isset($customerNames))
                                            @foreach ($customerNames as $customerName)
                                                <option value="{{ "$customerName->iduser" }}">
                                                    {{ $customerName->first_name }} {{ $customerName->last_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-2" style="padding-top: 25px">
                                <button type="submit" class="btn btn-md btn-outline-success waves-effect"
                                    style="border-radius: 24px">Search
                                </button>
                            </div>

                        </div>
                    </form>

                    <div class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <table class="table table-striped table-bordered" id="mainCat" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>CONSTRUCTION ID</th>
                                        <th>CUSTOMER</th>
                                        <th style="text-align: right">TOTAL</th>
                                        <th style="text-align: right">PAID</th>
                                        <th>DUE</th>
                                        <th>CREATED DATE</th>
                                        <th>OPTION</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (isset($constructionDetails))
                                        @if (count($constructionDetails) == 0)
                                            <tr>
                                                <td colspan="8" style="text-align: center;font-weight: bold">Sorry No
                                                    Results Found
                                                </td>
                                            </tr>
                                        @endif
                                        @foreach ($constructionDetails as $constructionDetail)
                                            <tr>
                                                <td>AC-{{ str_pad($constructionDetail->idmaster_construction, 5, '0', STR_PAD_LEFT) }}
                                                </td>
                                                <td>{{ $constructionDetail->User->first_name }}
                                                    {{ $constructionDetail->User->last_name }}</td>
                                                <td style="text-align: right">
                                                    {{ number_format($constructionDetail->total, 2) }}</td>
                                                <td style="text-align: right">
                                                    {{ number_format($constructionDetail->paid_amount, 2) }}</td>
                                                <td style="text-align: right">
                                                    {{ number_format($constructionDetail->due_amount, 2) }}</td>

                                                <td>{{ $constructionDetail->created_date }}</td>
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
                                                                data-id="{{ $constructionDetail->idmaster_construction }}"
                                                                id="employeeId" data-target="#addEmployeeModal">Add
                                                                Employees</i>
                                                            </a>
                                                            <a href="#" class="dropdown-item" data-toggle="modal"
                                                                data-id="{{ $constructionDetail->idmaster_construction }}"
                                                                id="grnId" data-target="#addEmployeeModal">Add
                                                                Payment</i>
                                                            </a>
                                                            <a href="#" class="dropdown-item" data-toggle="modal"
                                                                data-id="{{ $constructionDetail->idmaster_construction }}"
                                                                id="grnId" data-target="#paymentHistoryModal">Payments
                                                                History</i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                            {{ $constructionDetails->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--view more-->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Add Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-8">

                        <label>Employee<span style="color: red"> *</span></label>
                        <div class="form-group">
                            <select class="form-control select2 tab" name="employee" id="employee">
                                <option value="" disabled selected>Select Employee
                                </option>
                                @if (isset($employees))
                                    @foreach ($employees as $employee)
                                        <option value="{{ "$employee->iduser" }}">
                                            {{ $employee->first_name }} {{ $employee->last_name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <small class="text-danger" id="EmployeeError"></small>
                        </div>
                    </div>
                    <input type="hidden" id="hiddenConId" name="hiddenConId" />
                    <div class="col-lg-4" style="padding-top: 23px">
                        <button type="submit" class="btn btn-md btn-outline-primary waves-effect" id="saveEmployee"
                            style="border-radius: 24px" onclick="saveEMployee()">
                            Save Employee</button>

                        <button type="submit" class="btn btn-md btn-outline-primary waves-effect" id="waitEmpButton"
                            style="border-radius: 24px;display: none">
                            <i class="fa fa-circle-o-notch fa-spin"></i> Plsease Wait</button>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="table-rep-plugin">
                            <div class="table-responsive b-0" data-pattern="priority-columns">
                                <table class="table table-striped table-bordered" id="mainCat" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>EMPLOYEE</th>
                                            <th>DELETE</th>

                                        </tr>
                                    </thead>

                                    <tbody id="employeeArea">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--view irems-->
<div class="modal fade" id="paymentHistoryModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Payment History</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <section id="cd-timeline" class="cd-container">
                        <div class="cd-timeline-block">
                            <div class="cd-timeline-img bg-success">
                                <i class="mdi mdi-adjust"></i>
                            </div> <!-- cd-timeline-img -->

                            <div class="cd-timeline-content">
                                <h3>Timeline Event One</h3>
                                <p class="mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
                                <span class="cd-date">May 23</span>
                            </div> <!-- cd-timeline-content -->
                        </div> <!-- cd-timeline-block -->

                        <div class="cd-timeline-block">
                            <div class="cd-timeline-img bg-danger">
                                <i class="mdi mdi-adjust"></i>
                            </div> <!-- cd-timeline-img -->

                            <div class="cd-timeline-content">
                                <h3>Timeline Event Two</h3>
                                <p class="m-b-20 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde?</p>
                                <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light m-t-5">See more detail</button>

                                <span class="cd-date">May 30</span>
                            </div> <!-- cd-timeline-content -->
                        </div> <!-- cd-timeline-block -->

                        <div class="cd-timeline-block">
                            <div class="cd-timeline-img bg-info">
                                <i class="mdi mdi-adjust"></i>
                            </div> <!-- cd-timeline-img -->

                            <div class="cd-timeline-content">
                                <h3>Timeline Event Three</h3>
                                <p class="mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, obcaecati, quisquam id molestias eaque asperiores voluptatibus cupiditate error assumenda delectus odit similique earum voluptatem doloremque dolorem ipsam quae rerum quis. Odit, itaque, deserunt corporis vero ipsum nisi eius odio natus ullam provident pariatur temporibus quia eos repellat ... <a href="#">Read more</a></p>
                                <span class="cd-date">Jun 05</span>
                            </div> <!-- cd-timeline-content -->
                        </div> <!-- cd-timeline-block -->

                        <div class="cd-timeline-block">
                            <div class="cd-timeline-img bg-pink">
                                <i class="mdi mdi-adjust"></i>
                            </div> <!-- cd-timeline-img -->

                            <div class="cd-timeline-content">
                                <h3>Timeline Event Four</h3>
                                <p class="m-b-20 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
                                <img src="assets/images/small/img-1.jpg" alt="" class="rounded" width="120">
                                <img src="assets/images/small/img-2.jpg" alt="" class="rounded" width="120">
                                <span class="cd-date">Jun 14</span>
                            </div> <!-- cd-timeline-content -->
                        </div> <!-- cd-timeline-block -->

                        <div class="cd-timeline-block">
                            <div class="cd-timeline-img bg-warning">
                                <i class="mdi mdi-adjust"></i>
                            </div> <!-- cd-timeline-img -->

                            <div class="cd-timeline-content">
                                <h3>Timeline Event Five</h3>
                                <p class="m-b-20 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum.</p>
                                <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">See more detail</button>
                                <span class="cd-date">Jun 18</span>
                            </div> <!-- cd-timeline-content -->
                        </div> <!-- cd-timeline-block -->

                        <div class="cd-timeline-block">
                            <div class="cd-timeline-img bg-primary">
                                <i class="mdi mdi-adjust"></i>
                            </div> <!-- cd-timeline-img -->

                            <div class="cd-timeline-content">
                                <h3>Timeline Event End</h3>
                                <p class="mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, obcaecati, quisquam id molestias eaque asperiores voluptatibus cupiditate error assumenda delectus odit similique earum voluptatem doloremque dolorem ipsam quae rerum quis. Odit, itaque, deserunt corporis vero ipsum nisi eius odio natus ullam provident pariatur temporibus quia eos repellat consequuntur perferendis enim amet quae quasi repudiandae sed quod veniam dolore possimus rem voluptatum eveniet eligendi quis fugiat aliquam sunt similique aut adipisci.</p>
                                <span class="cd-date">Jun 30</span>
                            </div> <!-- cd-timeline-content -->
                        </div> <!-- cd-timeline-block -->
                    </section> <!-- cd-timeline -->
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


    function employeeList(id) {
        $.post('viewEmployees', {
            id: id
        }, function(data) {
            $("#employeeArea").html(data)
        })
    }

    function approvedConstruction(id) {


        swal({
                title: 'Do you really want to approved this ?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Approved!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-md btn-outline-primary waves-effect',
                cancelButtonClass: 'btn btn-md btn-outline-danger waves-effect',
                buttonsStyling: false
            }).then(function() {
                $.ajax({

                    type: 'POST',

                    url: " {{ route('approvedConstruction') }}",

                    data: {
                        id: id
                    },

                    success: function(data) {

                        notify({
                            type: "success", //alert | success | error | warning | info
                            title: 'CONSTRUCTION APPROVED',
                            autoHide: true, //true | false
                            delay: 2500, //number ms
                            position: {
                                x: "right",
                                y: "top"
                            },
                            icon: '<img src="{{ URL::asset('assets/images/correct.png') }}" />',

                            message: data.success,
                        });
                        location.reload();
                    }
                })


            }),
            function() {

            }

    }


    function saveEMployee() {

        $("#waitEmpButton").show();
        $("#saveEmployee").hide();
        $("#EmployeeError").html('');

        var hiddenConId = $("#hiddenConId").val();
        var employee = $("#employee").val();

        $.post('saveConEmployee', {
            hiddenConId: hiddenConId,
            employee: employee
        }, function(data) {
            if (data.errors != null) {

                $("#waitEmpButton").hide();
                $("#saveEmployee").show();

                if (data.errors.employee) {
                    var p = document.getElementById('EmployeeError');
                    p.innerHTML = data.errors.employee;

                }

            }
            if (data.success != null) {

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

                $(".select2").val('').trigger('change');
                $("#waitEmpButton").hide();
                $("#saveEmployee").show();
            }

        })
        employeeList(hiddenConId);
    }

    $(document).on('click', '#employeeId', function() {
        var constructionId = $(this).data("id");
        employeeList(constructionId);
        $("#hiddenConId").val(constructionId);
    });

    function deleteEmployee(id,constructionId) {
        $.post('deleteEmployee', {
            id: id
        }, function(data) {
            if (data.success != null) {

                notify({
                    type: "success", //alert | success | error | warning | info
                    title: 'EMPLOYEE DELETED',
                    autoHide: true, //true | false
                    delay: 2500, //number ms
                    position: {
                        x: "right",
                        y: "top"
                    },
                    icon: '<img src="{{ URL::asset('assets/images/correct.png') }}" />',

                    message: data.success,
                });

                $(".select2").val('').trigger('change');

            }
        })
        employeeList(constructionId);
    }

</script>


@include('includes.footer_end')
