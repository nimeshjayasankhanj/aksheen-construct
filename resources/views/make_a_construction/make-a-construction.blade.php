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
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Customer <span style="color: red"> *</span></label>

                                <select class="form-control select2 tab" onchange="viewDetail(this.value)" name="plan"
                                    id="plan">
                                    <option value="" disabled selected>Select Customer
                                    </option>
                                    @if (isset($products))
                                        @foreach ($products as $product)
                                            <option value="{{ "$product->idproduct" }}">{{ $product->product_name }}
                                            </option>
                                        @endforeach
                                    @endif

                                </select>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Plan<span style="color: red"> *</span></label>

                                <select class="form-control select2 tab" onchange="viewDetail(this.value)" name="plan"
                                    id="plan">
                                    <option value="" disabled selected>Select Plan
                                    </option>
                                    @if (isset($plans))
                                        @foreach ($plans as $plan)
                                            <option value="{{ "$plan->idplan" }}">{{ $plan->plan_name }} </option>
                                        @endforeach
                                    @endif

                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <img id="MyPlanImage" style="border: 2px solid black;border-radius:10px"
                                src="assets/images/screenimg.jpg" width="910" height="340">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card m-b-20">
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Material <span style="color: red"> *</span></label>

                                <select class="form-control select2 tab" onchange="viewDetail(this.value)" name="plan"
                                    id="plan">
                                    <option value="" disabled selected>Select Material
                                    </option>
                                    @if (isset($products))
                                        @foreach ($products as $product)
                                            <option value="{{ "$product->idproduct" }}">{{ $product->product_name }}
                                            </option>
                                        @endforeach
                                    @endif

                                </select>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Quantity<span style="color: red"> *</span></label>

                                <input type="number" class="form-control" name="quantity" id="quantity"
                                    autocomplete="off" placeholder="0.00" />
                                <span class="text-danger" id="planNameError"></small>
                            </div>
                        </div>
                        <div class="col-lg-4" style="padding-top: 23px;">
                            <button type="submit" class="btn btn-md btn-outline-primary waves-effect" id="savePlanBtn"
                                style="border-radius: 24px">
                                Add Material</button>

                            <button type="submit" class="btn btn-md btn-outline-primary waves-effect" id="waitButton"
                                style="border-radius: 24px;display: none">
                                <i class="fa fa-circle-o-notch fa-spin"></i> Plsease Wait</button>
                        </div>
                    </div>

                    <div class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>METERIAL</th>
                                        <th>QUANTITY</th>

                                        <th>DELETE</th>
                                        <th>UPDATE</th>
                                        <th style="text-align: right">TOTAL COST</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="5" style="text-align: center;font-weight:bold">Sorry No Results Found.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="font-weight:bold">Total Amount</td>
                                        <td style="font-weight:bold;text-align: right">0.00</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                   <div class="row">
                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-md btn-outline-primary waves-effect" id="savePlanBtn"
                            style="border-radius: 24px">
                            Save Construction</button>

                        <button type="submit" class="btn btn-md btn-outline-primary waves-effect" id="waitButton"
                            style="border-radius: 24px;display: none">
                            <i class="fa fa-circle-o-notch fa-spin"></i> Plsease Wait</button>
                    </div>
                   </div>
                </div>
            </div>
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


    function viewDetail(planID) {

        $.post('viewPlanImg', {
            planID: planID
        }, function(data) {
            $('#MyPlanImage').attr('src', 'assets/images/plans/' + data.images);
        })
    }

</script>


@include('includes/footer_end')
