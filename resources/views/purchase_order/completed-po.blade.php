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
                    <form action="{{ route('search-completed-po') }}" method="get">
                        <div class="row">
                            {{ csrf_field() }}


                            <div class="form-group col-md-3 ">
                                <label for="id">Search By</label>
                                <div class="input-group">
                                    <input class="form-control " placeholder="PO No" type="number" min="0" id="id" name="id">

                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <label>By Date</label>

                                <div class="input-daterange input-group" id="date-range">
                                    <input placeholder="dd/mm/yy" type="text" autocomplete="off"
                                           class="form-control" value="" id="date" name="date"/>

                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label>By Supplier</label>
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

                            <div class="form-group col-md-2" style="padding-top: 25px">
                                <button type="submit" class="btn btn-md btn-outline-success waves-effect" style="border-radius: 24px"
                                >Search
                                </button>
                            </div>

                        </div>
                    </form>


                    <div class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <table id="datatable-buttons" class="table table-striped table-bordered"
                                   cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>PO NO</th>
                                    <th>SUPPLIER</th>
                                    <th>TOTAL</th>
                                    <th>DATE</th>
                                    <th>USER</th>
                                    <th>CREATED AT</th>
                                    <th>OPTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($completedPO))
                                    @if(count($completedPO)==0)
                                        <tr>
                                            <td colspan="8" style="text-align: center;font-weight: bold  ">Sorry No
                                                Results Found.
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach($completedPO as $PO)
                                        <tr>
                                            <td>{{$PO->po_no}}</td>
                                            <td>{{$PO->Supplier->company_name}}</td>
                                            <td>{{ number_format($PO->total,2) }}</td>
                                            <td>{{$PO->date}}</td>
                                            <td>{{$PO->User->first_name}}</td>
                                            <td>{{$PO->created_at}}</td>

                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-success waves-effect btn-sm dropdown-toggle" type="button"
                                                            id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                        Option
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a href="#" class="dropdown-item" data-toggle="modal"
                                                           data-id="{{ $PO->idpurchase_order}}" id="viewItems"
                                                           data-target="#viewPOItemModal">View
                                                        </a>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$completedPO->links()}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!--view supplier-->

<div class="modal fade" id="viewPOItemModal" tabindex="-1"
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
                                        <th>CATEGORY</th>
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
    });
    function adMethod(dataID, tableName) {

        $.post('activateDeactivate', {id: dataID, table: tableName}, function (data) {

        });
    }


    $(document).on('click','#viewItems', function () {

        var poId = $(this).data("id");

        $.post('getPOById', {poId: poId}, function (data) {

            $("#viewItem").html(data.tableData);
        });
    });




</script>


@include('includes.footer_end')