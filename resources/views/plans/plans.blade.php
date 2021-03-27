@include('includes/header_start')

<link href="{{ URL::asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ URL::asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ URL::asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ URL::asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<!-- Plugins css -->
<link href="{{ URL::asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}"
    rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"
    rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}"
    rel="stylesheet" />
<link href="{{ URL::asset('assets/css/custom_checkbox.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/jquery.notify.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/mdb.css') }}" rel="stylesheet" type="text/css">

<meta name="csrf-token" content="{{ csrf_token() }}" />


@include('includes/header_end')

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
                    <form action="{{ route('plans') }}" method="GET">
                        <div class="row">

                            <div class="col-lg-7 form-group" style="padding-top: 6px">

                                {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="search" name="search" id="search" autocomplete="off"
                                        class="form-control" placeholder="Search Plan name here">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-md btn-outline-success waves-effect"
                                    style="border-radius: 24px">Search
                                </button>
                            </div>
                            <div class="col-lg-3">
                                <button type="button" class="btn btn-md btn-outline-primary waves-effect float-right"
                                    data-toggle="modal" data-target="#addPlanModal" style="border-radius: 24px">
                                    Add a Plan</button>
                            </div>
                        </div>
                    </form>



                    <div class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>PLAN IMAGE</th>
                                        <th>PLAN NAME</th>

                                        <th>STATUS</th>
                                        <th>UPDATE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($plans))
                                        @if (count($plans) == 0)
                                            <tr>
                                                <td colspan="6" style="text-align: center;font-weight: bold  ">Sorry No
                                                    Results Found.
                                                </td>
                                            </tr>
                                        @endif
                                        @foreach ($plans as $plan)
                                            <tr>
                                                <td>
                                                    <img src="assets/images/plans/{{ $plan->images }}" alt="user-image"
                                                        style="border: 1px solid black"
                                                        class="thumb-md rounded-circle mr-2" />
                                                </td>
                                                <td>{{ $plan->plan_name }}</td>


                                                @if ($plan->status == 1)

                                                    <td>
                                                        <p>
                                                            <input type="checkbox"
                                                                onchange="adMethod('{{ $plan->idplan }}','plan')"
                                                                id="{{ 'c' . $plan->idplan }}" checked
                                                                switch="none" />
                                                            <label for="{{ 'c' . $plan->idplan }}" data-on-label="On"
                                                                data-off-label="Off"></label>
                                                        </p>
                                                    </td>
                                                @else
                                                    <td>
                                                        <p>
                                                            <input type="checkbox"
                                                                onchange="adMethod('{{ $product->idplan }}','plan')"
                                                                id="{{ 'c' . $plan->idplan }}" switch="none" />
                                                            <label for="{{ 'c' . $plan->idplan }}" data-on-label="On"
                                                                data-off-label="Off"></label>
                                                        </p>
                                                    </td>

                                                @endif
                                                <td>

                                                    <p>
                                                        <button type="button"
                                                            class="btn btn-sm btn-warning  waves-effect waves-light"
                                                            data-toggle="modal" data-id="{{ $plan->idplan }}"
                                                            data-name="{{ $plan->plan_name }}"
                                                            data-image="{{ $plan->images }}" id="uPlanID"
                                                            data-target="#editPlanModal"><i class="fa fa-edit"></i>
                                                        </button>
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                            {{ $plans->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<div class="modal fade" id="addPlanModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Add a Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">
                <form class="" method="post" enctype="multipart/form-data" action="{{ route('savePlan') }}"
                    id="savePlanId">
                    {{ csrf_field() }}
                    <label>Plan Image<span style="color: red"> *</span></label>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <img onclick="openPlanUploader()" id="MyPlanImage" class="rounded-circle" alt="200x200"
                                style="border: 1px solid black" src="assets/images/screenimg.jpg"
                                data-holder-rendered="true" width="150" height="150">
                            <input onchange="setPlanImage(this)" type="file" name="planImage" id="planImage"
                                style="display:none">

                        </div>

                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-lg-6">
                            <span class="text-danger" id="planImageError" style="text-align: center"></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Plan Name<span style="color: red"> *</span></label>

                        <input type="text" class="form-control" name="planName" id="planName" autocomplete="off"
                            placeholder="Plan Name" />
                        <span class="text-danger" id="planNameError"></small>
                    </div>

                    <button type="submit" class="btn btn-md btn-outline-primary waves-effect" id="savePlanBtn"
                        style="border-radius: 24px">
                        Save Plan</button>

                    <button type="submit" class="btn btn-md btn-outline-primary waves-effect" id="waitButton"
                        style="border-radius: 24px;display: none">
                        <i class="fa fa-circle-o-notch fa-spin"></i> Plsease Wait</button>

                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editPlanModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Edit Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">
                <form class="" method="post" enctype="multipart/form-data" action="{{ route('editPlan') }}"
                    id="editPlanId">
                    {{ csrf_field() }}
                    <label>Plan Image<span style="color: red"> *</span></label>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <img onclick="uOpenPlanUploader()" name="uMyPlanImage" id="uMyPlanImage" class="rounded-circle" alt="200x200"
                                style="border: 1px solid black" src="assets/images/screenimg.jpg"
                                data-holder-rendered="true" width="150" height="150">
                            <input onchange="uSetPlanImage(this)" type="file" name="uPlanImage" id="uPlanImage"
                                style="display:none">

                        </div>

                        <div class="col-md-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-lg-6">
                            <span class="text-danger" id="uPlanImageError" style="text-align: center"></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Plan Name<span style="color: red"> *</span></label>

                        <input type="text" class="form-control" name="uPlanName" id="uPlanName" autocomplete="off"
                            placeholder="Plan Name" />
                        <span class="text-danger" id="uPlanNameError"></small>
                    </div>
                    <input type="hidden" id="hiddenPID" name="hiddenPID" />
                    <button type="submit" class="btn btn-md btn-outline-warning waves-effect" id="editPlanBtn"
                        style="border-radius: 24px">
                        Edit Plan</button>

                    <button type="submit" class="btn btn-md btn-outline-warning waves-effect" id="uWaitButton"
                        style="border-radius: 24px;display: none">
                        <i class="fa fa-circle-o-notch fa-spin"></i> Plsease Wait</button>

                </form>
            </div>
        </div>
    </div>
</div>



@include('includes/footer_start')

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
<script src="{{ URL::asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
<!-- Responsive examples -->
<script src="{{ URL::asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

<script src="{{ URL::asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('assets/pages/sweet-alert.init.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ URL::asset('assets/pages/datatables.init.js') }}"></script>

<!-- Parsley js -->
<script type="text/javascript" src="{{ URL::asset('assets/plugins/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/bootstrap-notify.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.notify.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });
    $(document).on("wheel", "input[type=number]", function(e) {
        $(this).blur();
    });

    function adMethod(dataID, tableName) {

        $.post('activateDeactivate', {
            id: dataID,
            table: tableName
        }, function(data) {

        });
    }
    $('.modal').on('hidden.bs.modal', function() {
        $('input').val('');
        $("#planImageError").html('');
        $("#planNameError").html('');
    });


    //save plan
    $('#savePlanId').on('submit', function(event) {

        $("#savePlanBtn").hide();
        $("#waitButton").show();
        $("#planImageError").html('');
        $("#planNameError").html('');


        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: "{{ route('savePlan') }}",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

                if (data.errors != null) {
                    $("#savePlanBtn").show();
                    $("#waitButton").hide();
                    if (data.errors.planImage) {
                        var p = document.getElementById('planImageError');
                        p.innerHTML = data.errors.planImage[0];
                    }
                    if (data.errors.planName) {
                        var p = document.getElementById('planNameError');
                        p.innerHTML = data.errors.planName[0];
                    }
                }
                if (data.success != null) {
                    notify({
                        type: "success", //alert | success | error | warning | info
                        title: 'PLAN SAVED',
                        autoHide: true, //true | false
                        delay: 2500, //number ms
                        position: {
                            x: "right",
                            y: "top"
                        },
                        icon: '<img src="{{ URL::asset('assets/images/correct.png') }}" />',

                        message: data.success,
                    });
                    $("#savePlanBtn").show();
                    $("#waitButton").hide();
                    setTimeout(function() {
                        $('#addPlanModal').modal('hide');
                    }, 200);
                    $("tbody").html(data.tableData)
                }
            }
        });
    });

    $('#editPlanId').on('submit', function(event) {

        $("#editPlanBtn").hide();
        $("#uWaitButton").show();
        $("#uPlanImageError").html('');
        $("#uPlanNameError").html('');


        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: "{{ route('editPlan') }}",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

                if (data.errors != null) {
                    $("#editPlanBtn").show();
                    $("#uWaitButton").hide();

                    if (data.errors.uPlanName) {
                        var p = document.getElementById('uPlanNameError');
                        p.innerHTML = data.errors.uPlanName[0];
                    }
                }
                if (data.success != null) {
                    notify({
                        type: "success", //alert | success | error | warning | info
                        title: 'PLAN UPDATED',
                        autoHide: true, //true | false
                        delay: 2500, //number ms
                        position: {
                            x: "right",
                            y: "top"
                        },
                        icon: '<img src="{{ URL::asset('assets/images/correct.png') }}" />',

                        message: data.success,
                    });
                    $("#editPlanBtn").show();
                    $("#uWaitButton").hide();
                    setTimeout(function() {
                        $('#editPlanModal').modal('hide');
                    }, 200);
                    $("tbody").html(data.tableData)
                }
            }
        });
    });


    function openPlanUploader() {
        $("#planImage").click();
    }

    function setPlanImage(input) {

        if (input.files[0] !== null) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("MyPlanImage").setAttribute("src", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function uOpenPlanUploader() {
        $("#uPlanImage").click();
    }

    function uSetPlanImage(input) {

        if (input.files[0] !== null) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("uMyPlanImage").setAttribute("src", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }


    $(document).on('click', '#uPlanID', function() {
        var planId = $(this).data("id");
        var planName = $(this).data("name");
        var planImage = $(this).data("image");

        $("#uPlanName").val(planName);
        $("#hiddenPID").val(planId);
        $('#uMyPlanImage').attr('src', 'assets/images/plans/' + planImage);

    });

</script>


@include('includes/footer_end')
