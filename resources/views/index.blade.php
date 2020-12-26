@include('includes/header_start')

<!--Morris Chart CSS -->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/morris/morris.css')}}">
<link href="{{ URL::asset('assets/css/mdb.css')}}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" rel="stylesheet"/>

@include('includes/header_end')

<!-- Page title -->
<ul class="list-inline menu-left mb-0">
    <li class="list-inline-item">
        <button type="button" class="button-menu-mobile open-left waves-effect">
            <em class="ion-navicon"></em>
        </button>
    </li>
    <li class="hide-phone list-inline-item app-search">
        <h3 class="page-title">Dashboard</h3>
    </li>
</ul>
<style type="text/css">

    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }

    body {
        font-family: "Poppins", sans-serif !important;
    }

    .btn-circle.btn-lg {
        width: 100px;
        height: 100px;
        padding: 20px 26px;
        font-size: 18px;
        line-height: 1.33;
        border-radius: 55px;

    }

    .checked {
        color: orange;

    }
    span.colour{
        font-size: 30px;
    }
    #area-chart,
    #line-chart,
    #bar-chart,
    #stacked,
    #pie-chart{
        min-height: 250px;
    }
</style>
<div class="clearfix"></div>
</nav>

</div>
<!-- Top Bar End -->

<!-- ==================
     PAGE CONTENT START
     ================== -->

<div class="page-content-wrapper">

    <br>
    <div class="">
        <div class="container-fluid">
            <div class="card m-b-30">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>





</div> <!-- Page content Wrapper -->

</div> <!-- content -->

@include('includes/footer_start')

<!--Morris Chart-->
<script src="{{ URL::asset('assets/plugins/morris/morris.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugins/raphael/raphael-min.js')}}"></script>

<script src="{{ URL::asset('assets/pages/dashborad.js')}}"></script>
<script type="text/javascript">
    Morris.Donut({
        element: 'donut-example',
        data: [
            { label: "Download Sales", value: 12 },
            { label: "In-Store Sales", value: 30 },
            { label: "Mail-Order Sales", value: 20 }
        ]
    });
</script>
@include('includes/footer_end')