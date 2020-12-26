        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="">
                        <a href="{{ URL::asset('/')}}" class="logo"><img src="{{ URL::asset('assets/images/screenimg.jpg')}}" height="90" alt="logo"></a>
                    </div>
                </div>

                <div class="sidebar-inner slimscrollleft">
                    <div id="sidebar-menu">
                        <ul>

                            <li>
                                <a href="{{ URL::asset('/')}}" class="waves-effect"><i class="dripicons-device-desktop"></i><span>Dashboard </span></a>
                            </li>

                            <li class="menu-title">Products</li>


                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ion-fork ion-pizza"></i><span>Products<span
                                                class="pull-right"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="{{ URL::asset('/categories')}}"><span>Categories</span></a>
                                    </li>

                                </ul>
                            </li>


                            {{-- <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ion-filing"></i><span>Productions<span
                                                class="pull-right"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="list-unstyled">

                                    <li>
                                        <a href="productions"><span>Products</span></a>
                                    </li>
                                    <li>
                                        <a href="production-category"><span>Categories</span></a>
                                    </li>
                                </ul>
                            </li>


                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ion-fork ion-pizza"></i><span>Daily Productions<span
                                                class="pull-right"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="add-daily-production"><span>Add Daily Production</span></a>
                                    </li>
                                    <li>
                                        <a href="active-daily-production"><span>Active Daily Production</span></a>
                                    </li>
                                    <li>
                                        <a href="deactive-daily-production"><span>Finished Daily Production</span></a>
                                    </li>
                                </ul>
                            </li> --}}


                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- end sidebarinner -->
            </div>
            <!-- Left Sidebar End -->
