@include('includes.header_account')
<link href="{{ URL::asset('assets/css/mdb.css')}}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">


<!-- Begin page -->
<div class="page-content-wrapper " style="background-image:url('assets/images/auth-bg.jpg')">

    <div class="container-fluid card-align-items-center mx-auto">
        <div class="col-lg-7 card-align-items-center mx-auto">
            <div class="card m-b-8 card-align-items-center" style="border-radius: 11px">
                <div class="card-body card-align-items-center " >
<div class="row">
    <div class="col-lg-6">
        <img src="{{ URL::asset('assets/images/screenimg.jpg') }}" style="margin-top: 70px" width="83%"
             alt="logo">
    </div>
    <div class="col-lg-6">
            <h5 style="text-align: center">Aksheen Construction</h5>
        @if(\Session::has('error'))
            <div class="alert alert-danger alert-dismissible ">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p>{{ \Session::get('error') }}</p>
            </div>
        @endif

        @if(\Session::has('warning'))
            <div class="alert alert-warning alert-dismissible ">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p>{{ \Session::get('warning') }}</p>
            </div>
        @endif

        <form class="form-horizontal m-t-30" action="{{ route('loginMy') }}" method="POST">
            {{--<form class="form-horizontal m-t-30" action="{{ route('authenticate') }}" method="POST">--}}

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" autocomplete="off" id="username" name="username"
                       placeholder="Enter username">
                <small class="text-danger">{{ $errors->first('username') }}</small>
            </div>

            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" autocomplete="off" class="form-control" id="password" name="password" placeholder="Enter password">
                <small class="text-danger">{{ $errors->first('password') }}</small>
            </div>
            <input type="hidden" name="_token" value="{{ Session::token() }}">

            <div class="form-group row m-t-20">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6 text-right">
                    <button type="submit" class="btn btn-md btn-outline-primary waves-effect"
                           style="border-radius: 24px">
                        Log In</button>
                </div>
            </div>
        </form>
    </div>
</div>
                </div>
            </div>
        </div>
    </div><!-- container -->

</div>

<style>
    html {
        background: url('assets/images/auth-bg.jpg');
    }
</style>
@include('includes.footer_account')

<script>
 $(document).ready(function(){
        $( document ).on( 'focus', ':input', function(){
            $( this ).attr( 'autocomplete', 'off' );
        });
    });
</script>