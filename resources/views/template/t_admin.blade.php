<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">

        <title>@yield('title')</title>

        <link rel="icon" type="image/png" href="general/images/favicon-bbi.png"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
        <link rel="stylesheet" href="/admin/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
        <link rel="stylesheet" href="/admin/assets/css/argon.css?v=1.2.0" type="text/css">
        <link rel="stylesheet" href="/admin/assets/css/lightbox.min.css" type="text/css">
        <link rel="stylesheet" href="/admin/assets/vendor/datatables/dataTables.bootstrap4.min.css">

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

        <script>
            $(document).ready(function () {
            $('#dataTable').DataTable();
            $('.dataTables_length').addClass('bs-select');
            });
        </script>

    </head>

    <body>

        <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
            <div class="scrollbar-inner">
                
                <div class="sidenav-header  align-items-center mb-4">
                    <a class="navbar-brand" href="javascript:void(0)">
                        <h1>BBI Warehouse</h1>
                        <p>Admin Panel</p>
                    </a>
                </div>

                <div class=" navbar-inner">
                    
                    <div class="collapse navbar-collapse" id="sidenav-collapse-main">

                        <ul class="navbar-nav">

                            <li class="nav-item">
                                <a class="nav-link" href="/dashboard"
                                    style="font-size: 18px; text-align: center">
                                    <i class="fas fa-home" style="font-size: 16px;"></i>
                                    <span class="nav-link-text ml-2">Dashboard</span>
                                </a>
                            </li>

                            <hr class="my-2">

                            @if (Auth::user()->role == 0)
                            <li class="nav-item">
                                <a class="nav-link" href="/list-user"
                                    style="font-size: 18px; text-align: center">
                                    <i class="fas fa-user-check" style="font-size: 16px;"></i>
                                    <span class="nav-link-text ml-2">List User</span>
                                </a>
                            </li>

                            <hr class="my-2">
                            @endif

                            @if (Auth::user()->role != 0 && Auth::user()->role != 3)
                            <li class="nav-item">
                                <a class="nav-link" href="/list-kedatangan-material/0"
                                    style="font-size: 18px; text-align: center">
                                    <i class="fas fa-truck" style="font-size: 16px;"></i>
                                    <span class="nav-link-text ml-2">Kedatangan</span>
                                </a>
                            </li>

                            <hr class="my-2">
                            @endif

                            @if (Auth::user()->role != 0 && Auth::user()->role != 3)
                            <li class="nav-item">
                                <a class="nav-link" href="/list-material-sampai/0"
                                    style="font-size: 18px; text-align: center">
                                    <i class="fas fa-box-open" style="font-size: 16px;"></i>
                                    <span class="nav-link-text ml-2">Pengecekan</span>
                                </a>
                            </li>

                            <hr class="my-2">
                            @endif

                            @if (Auth::user()->role != 0)
                            <li class="nav-item dropdown">
                                <a style="font-size: 18px; text-align: center" class="nav-link" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-warehouse mr-2" style="font-size: 16px;"></i>
                                    <span> Inventory</span>
                                </a>

                                
                                <div class="dropdown-menu  dropdown-menu-right">    
                                    <div class="list-group list-group-flush">
                                        <a href="/list_material_inventory/0"
                                            class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <div class="col ml--2">
                                                    <h4 class="mb-0 text-sm">Gudang Besar</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="list-group list-group-flush">
                                        <a href="/list_penggunaan_material/0"
                                            class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <div class="col ml--2">
                                                    <h4 class="mb-0 text-sm">Gudang Kecil</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            </li>

                            <hr class="my-2">

                            @endif

                            @if (Auth::user()->role != 0 && Auth::user()->role != 3)
                            <li class="nav-item">
                                <a class="nav-link" href="/list_request_restock_material"
                                    style="font-size: 18px; text-align: center">
                                    <i class="fas fa-store" style="font-size: 16px;"></i>
                                    <span class="nav-link-text ml-2">Restock</span>
                                </a>
                            </li>

                            <hr class="my-2">
                            @endif

                            @if (Auth::user()->role != 0 && Auth::user()->role != 3)
                            <li class="nav-item dropdown">
                                <a style="font-size: 18px; text-align: center" class="nav-link" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-list mr-2" style="font-size: 16px;"></i>
                                    <span>Daftar Material</span>
                                </a>

                                
                                <div class="dropdown-menu  dropdown-menu-right">    
                                    <div class="list-group list-group-flush">
                                        <a href="/list_barang_masuk/0"
                                            class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <div class="col ml--2">
                                                    <h4 class="mb-0 text-sm">Masuk</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="list-group list-group-flush">
                                        <a href="/list_barang_keluar/0"
                                            class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <div class="col ml--2">
                                                    <h4 class="mb-0 text-sm">Keluar</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            </li>

                            <hr class="my-2">

                            @endif

                            @if (Auth::user()->role != 0)
                            <li class="nav-item">
                                <a class="nav-link" href="/list-notifikasi"
                                    style="font-size: 18px; text-align: center">
                                    <i class="fas fa-bell" style="font-size: 16px;"></i>
                                    <span class="nav-link-text ml-2">Notifikasi</span>
                                </a>
                            </li>

                            <hr class="my-2">
                            @endif

                          
                        </ul>

                        <hr class="my-3">
                    </div>
                </div>
            </div>
        </nav>

        <div class="main-content" id="panel">
            
            <nav class="navbar navbar-top navbar-expand bg-default navbar-dark border-bottom">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item">
                                <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                                    data-target="#sidenav-main">
                                    <div class="sidenav-toggler-inner">
                                        <i class="sidenav-toggler-line"></i>
                                        <i class="sidenav-toggler-line"></i>
                                        <i class="sidenav-toggler-line"></i>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item d-sm-none">
                                <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                                    <i class="ni ni-zoom-split-in"></i>
                                </a>
                            </li>
                        </ul>

                        <ul class="navbar-nav align-items-center  ml-auto ">
                            <li class="nav-item dropdown">
                                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <div class="media align-items-center">
                                        <span class="avatar avatar-sm rounded-circle">
                                            <i class="fas fa-user-shield fa-lg"></i>
                                        </span>
                                        <div class="media-body  ml-2  d-none d-lg-block">
                                            <span class="mb-0 text-sm  font-weight-bold"></span>
                                        </div>
                                    </div>
                                </a>

                                <div class="dropdown-menu  dropdown-menu-right ">
                                    <div class="dropdown-item">
                                        <span>User : {{ Auth::user()->username }}</span>
                                    </div>
                                    <a href="/ganti_pass" class="dropdown-item">
                                        <span>Ganti Password</span>
                                    </a>
                                    <a href="/logout" class="dropdown-item">
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>

            @yield('container')

            <footer class="footer pt-0">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6">
                        <div class="copyright text-center  text-lg-left  text-muted">
                            &copy; 2023 <span class="font-weight-bold ml-1" style="color: #172B4D">BBI Warehouse Material System</span>
                        </div>
                    </div>
                </div>
            </footer>

            </div>
        </div>

        <script src="/admin/assets/vendor/jquery/dist/jquery.min.js"></script>
        <script src="/admin/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/admin/assets/vendor/js-cookie/js.cookie.js"></script>
        <script src="/admin/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="/admin/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
        
        <script src="/admin/assets/js/argon.js?v=1.2.0"></script>
        
        <script src="/admin/assets/js/lightbox-plus-jquery.min.js"></script>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        
        <script src="/admin/assets/vendor/datatables/jquery.dataTables.js"></script>
        <script src="/admin/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    </body>

</html>