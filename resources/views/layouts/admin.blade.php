<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Superadmin | Petshop</title>
    @livewireStyles
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
    <!-- Styles -->
    <link href="{{ URL::asset('assets/css/lib/calendar2/pignose.calendar.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/lib/chartist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/lib/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/lib/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/lib/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/lib/owl.theme.default.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/lib/weather-icons.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/lib/menubar/sidebar.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/lib/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/lib/helper.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</head>

<body>
    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <div class="logo"><a href="index.html">
                            <!-- <img src="assets/images/logo.png" alt="" /> --><span>Petshop</span></a></div>
                    <li class="label">Main</li>
                    <li><a href="{{ route('admin.home') }}"><i class="ti-home"></i> Dashboard</a>
                        
                    </li>
      
                    <li class="label">Master Data</li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-layout-grid3"></i> Master Data <span
                                class="badge badge-primary">4</span> <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.categories.index') }}"><i class="ti-harddrives"></i> Kategori Produk</a></li>
                            <li><a href="{{ route('admin.couriers.index') }}"><i class="ti-car"></i> Kurir</a></li>
                            <li><a href="{{ route('admin.province.index') }}"><i class="ti-flag-alt"></i> Provinsi</a></li>
                            <li><a href="{{ route('admin.account.index') }}"><i class="ti-user"></i> Admin</a></li>
                        </ul>
                    </li>

                    <li class="label">Pengadaan Barang</li>
                    <li><a href="{{ route('admin.product.index') }}"><i class="ti-bag"></i> Produk </a>
                    <li><a href="{{ route('admin.review.index') }}"><i class="ti-thumb-up"></i> Review Produk </a>
                    </li>
                    <li><a href="{{ route('admin.discount.index') }}"><i class="ti-money"></i> Diskon </a>
                    </li>

                    <li class="label">Transaksi</li>
                    <li><a href="{{ route('admin.transaction.index') }}"><i class="ti-receipt"></i> Transaksi </a>
                    </li>
                    </li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-wallet"></i> Laporan Keuangan </a>
                    </li>
                </ul>
            </div>
        </div>
      </div>
      <!-- /# sidebar -->
      
      <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <div class="hamburger sidebar-toggle">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </div>
                    <div class="float-right">

                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <i class="ti-bell"></i>
                                <div class="drop-down dropdown-menu dropdown-menu-right">
                                    
                                    @livewire('notification-admin')
                                    
                                </div>
                            </div>
                        </div>
                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <span class="user-avatar">
                                    <img style="border-radius: 100px" src="{{ URL::asset('admin/foto/'.Auth::guard('admin')->user()->profile_image) }}" alt="" width="40px">
                                    John
                                    <i class="ti-angle-down f-s-10"></i>
                                </span>
                                <div class="drop-down dropdown-profile dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-content-heading">
                                        <span class="text-left">Upgrade Now</span>
                                        <p class="trial-day">30 Days Trail</p>
                                    </div>
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <i class="ti-user"></i>
                                                    <span>Profile</span>
                                                </a>
                                            </li>
      
                                            <li>
                                                <a href="#">
                                                    <i class="ti-email"></i>
                                                    <span>Inbox</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ti-settings"></i>
                                                    <span>Setting</span>
                                                </a>
                                            </li>
      
                                            <li>
                                                <a href="#">
                                                    <i class="ti-lock"></i>
                                                    <span>Lock Screen</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ti-power-off"></i>
                                                    <span>Logout</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    @yield('section')

    <!-- jquery vendor -->
    <script src="{{ URL::asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lib/jquery.nanoscroller.min.js') }}"></script>
    @include('sweetalert::alert')   
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    <script>
        $(document).on('click', '#btn-submit', function(e) {
            e.preventDefault();
            var me = $(this);
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this data!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }).then(function (result) {
                if(result.value === true){
                    $('#delete-form'+me.val()).submit();
                }
                console.log(result === true);
                console.log(result);
                console.log();
            });
        });

        $(document).on('click', '#btn-submit-verify', function(e) {
            e.preventDefault();
            var me = $(this);
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this data!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }).then(function (result) {
                if(result.value === true){
                    $('#delete-form-verify'+me.val()).submit();
                }
                console.log(result === true);
                console.log(result);
                console.log();
            });
        });
        $(document).on('click', '#btn-submit-notverify', function(e) {
            e.preventDefault();
            var me = $(this);
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this data!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }).then(function (result) {
                if(result.value === true){
                    $('#delete-form-notverify'+me.val()).submit();
                }
                console.log(result === true);
                console.log(result);
                console.log();
            });
        });
    </script>
    <!-- nano scroller -->
    <script src="{{ URL::asset('assets/js/lib/menubar/sidebar.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lib/preloader/pace.min.js') }}"></script>
    <!-- sidebar -->

    <script src="{{ URL::asset('assets/js/lib/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/scripts.js') }}"></script>
    <!-- bootstrap -->

    <script src="{{ URL::asset('assets/js/lib/calendar-2/moment.latest.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lib/calendar-2/pignose.calendar.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lib/calendar-2/pignose.init.js') }}"></script>


    <script src="{{ URL::asset('assets/js/lib/weather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lib/weather/weather-init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lib/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lib/circle-progress/circle-progress-init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lib/chartist/chartist.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lib/sparklinechart/jquery.sparkline.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lib/sparklinechart/sparkline.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lib/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lib/owl-carousel/owl.carousel-init.js') }}"></script>
    <!-- scripit init-->
    <script src="{{ URL::asset('assets/js/dashboard2.js') }}"></script>
    <!-- scripit init (Datatables) -->
    <script src="{{ URL::asset('assets/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lib/data-table/buttons.flash.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lib/data-table/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lib/data-table/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lib/data-table/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lib/data-table/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/lib/data-table/datatables-init.js') }}"></script>
    @livewireScripts
    
</body>

</html>