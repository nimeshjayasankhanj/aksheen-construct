@include('includes.header_start')

<!-- Plugins css -->
<link href="{{ URL::asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ URL::asset('assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}"
      rel="stylesheet"/>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<link href="{{ URL::asset('assets/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/jquery.notify.css')}}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/mdb.css')}}" rel="stylesheet" type="text/css">
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
                    <form action="{{ route('grn-history') }}" method="get">

                        <div class="row">
                            {{ csrf_field() }}


                            <div class="form-group col-md-3 ">
                                <label for="id">Search By</label>
                                <div class="input-group">
                                    <input class="form-control " placeholder="GRN No" type="number" min="0" id="id" name="id">

                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>By Date Range</label>

                                <div class="input-daterange input-group" id="date-range">
                                    <input placeholder="dd/mm/yy" type="text" autocomplete="off"
                                           class="form-control" value="" id="startDate" name="startDate"/>
                                    <input placeholder="dd/mm/yy" type="text" autocomplete="off"
                                           class="form-control" value="" id="endDate" name="endDate"/>

                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label>By Supplier</label>
                                <div class="form-group">
                                    <select class="form-control select2 tab" name="supplierSearch"
                                            id="supplierSearch">
                                        <option value="" disabled selected>Select Supplier
                                        </option>
                                        @if(isset($suppliers))
                                            @foreach($suppliers as $supplier)
                                                <option value="{{"$supplier->idsupplier"}}">{{$supplier->company_name}} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-2" style="padding-top: 25px">
                                <button type="submit" class="btn btn-md btn-outline-success waves-effect" style="border-radius: 24px"
                                >Search
                                </button>
                            </div>

                        </div>
                    </form>

                    <div class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <table class="table table-striped table-bordered" id="mainCat"
                                   cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>GRN NO</th>
                                    <th>SUPPLIER</th>
                                    <th style="text-align: right">TOTAL</th>
                                    <th style="text-align: right">PAID</th>
                                    <th>DUE</th>
                                    <th>DATE</th>
                                    <th>OPTION</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if(isset($grnHistories))
                                    @if(count($grnHistories)==0)
                                        <tr>
                                            <td colspan="8" style="text-align: center;font-weight: bold">Sorry No
                                                Results Found
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach($grnHistories as $grnHistory)
                                        <tr>
                                            <td>{{ str_pad($grnHistory->idmaster_grn,5,'0',STR_PAD_LEFT) }}</td>
                                            <td>{{$grnHistory->Supplier->company_name}}</td>
                                            <td style="text-align: right">{{ number_format($grnHistory->total,2) }}</td>
                                            <td style="text-align: right">{{ number_format($grnHistory->paid_amount,2) }}</td>
                                            <td style="text-align: right">{{ number_format($grnHistory->due,2) }}</td>

                                            <td>{{$grnHistory->date}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-success waves-effect btn-sm dropdown-toggle" type="button"
                                                            id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                        Option
                                                    </button>
                                                    <div class="dropdown-menu"
                                                         aria-labelledby="dropdownMenuButton">
                                                        <a href="#" class="dropdown-item" data-toggle="modal"
                                                           data-id="{{$grnHistory->idmaster_grn}}" id="grnId"
                                                           data-target="#viewGrn">View Items</i>
                                                        </a>
                                                        <a href="#" class="dropdown-item" data-toggle="modal"
                                                           data-id="{{$grnHistory->idmaster_grn}}" id="masterId"
                                                           data-target="#viewMore">More</i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$grnHistories->links()}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--view more-->
<div class="modal fade" id="viewMore" tabindex="-1"
     role="dialog"
     aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">More</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                        <div class="table-rep-plugin">
                            <div class="table-responsive b-0" data-pattern="priority-columns">
                                <table class="table table-striped table-bordered"
                                       cellspacing="0"
                                       width="100%">
                                    <tbody id="viewMoreArea">

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
<div class="modal fade" id="viewGrn" tabindex="-1"
     role="dialog"
     aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">View Products</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                        <div class="table-rep-plugin">
                            <div class="table-responsive b-0" data-pattern="priority-columns">
                                <table class="table table-striped table-bordered"
                                       cellspacing="0"
                                       width="100%">
                                    <thead>
                                    <tr>
                                        <th>PRODUCT</th>
                                        <th>QTY</th>
                                        <TH style="text-align: right">BUYING PRICE</TH>
                                    </tr>
                                    </thead>
                                    <tbody id="viewItem">

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
@include('includes.footer_start')

<!-- Plugins js -->
<script src="{{ URL::asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"
        type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}"
        type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"
        type="text/javascript"></script>

<!-- Plugins Init js -->
<script src="{{ URL::asset('assets/pages/form-advanced.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/sweet-alert2/sweetalert2.min.js')}}"></script>
<script src="{{ URL::asset('assets/pages/sweet-alert.init.js')}}"></script>

<!-- Parsley js -->
<script type="text/javascript" src="{{ URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/bootstrap-notify.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/my_alerts.js')}}"></script>
<script src="{{ URL::asset('assets/js/jquery.notify.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $(document).on('focus', ':input', function () {
        $(this).attr('autocomplete', 'off');
    });
    $('.modal').on('hidden.bs.modal', function () {
        $('#errorAlert').hide();
        $('#errorAlert').html('');
        $('#errorAlert1').hide();
        $('#errorAlert1').html('');
        $('input').val('');
        $(".select2").val('').trigger('change');
    });
    function adMethod(dataID, tableName) {

        $.post('activateDeactivate', {id: dataID, table: tableName}, function (data) {

        });
    }
    $(document).on("wheel", "input[type=number]", function (e) {
        $(this).blur();
    });

    $(document).on('click', '#grnId', function () {
        var grnId = $(this).data("id");
        $.post('getVGrnByID', {grnId: grnId}, function (data) {
            $('#viewItem').html(data.tableData);
        });
    });


    $(document).on('click', '#masterId', function () {
        var masterId = $(this).data("id");

        $.post('getMoreByGrnID', {masterId: masterId}, function (data) {
            $('#viewMoreArea').html(data.tableData);
        });
    });
    $(document).on('focus', ':input', function () {
        $(this).attr('autocomplete', 'off');
    });
</script>


@include('includes.footer_end')
