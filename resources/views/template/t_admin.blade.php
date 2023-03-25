<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
        <meta name="author" content="Taufik Hidayat">

        <title>@yield('title')</title>

        <link rel="icon" href="admin/assets/img/homepage/evol.png" type="image/png">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
        <link rel="stylesheet" href="admin/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
        <link rel="stylesheet" href="admin/assets/css/argon.css?v=1.2.0" type="text/css">
        <link rel="stylesheet" href="admin/assets/css/lightbox.min.css" type="text/css">
        <link rel="stylesheet" href="admin/assets/vendor/datatables/dataTables.bootstrap4.min.css">

    </head>

    <body>

        <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
            <div class="scrollbar-inner">
                
                <div class="sidenav-header  align-items-center mb-4">
                    <a class="navbar-brand" href="javascript:void(0)">

                        <h1>EVOLUTION</h1>
                        <p> Admin Controls </p>

                    </a>
                </div>

                <div class=" navbar-inner">
                    
                    <div class="collapse navbar-collapse" id="sidenav-collapse-main">

                        <ul class="navbar-nav">

                            <li class="nav-item">
                                <a class="nav-link" href="#"
                                    style="font-size: 18px; text-align: center">
                                    <i class="fas fa-home" style="font-size: 16px;"></i>
                                    <span class="nav-link-text ml-2">Dashboard</span>
                                </a>
                            </li>

                            <!-- <hr class="my-2">

                            <li class="nav-item dropdown">
                                <a style="font-size: 18px; text-align: center" class="nav-link" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user-plus mr-2" style="font-size: 16px;"></i>
                                    <span> Daftarkan Peserta</span>
                                </a>

                                <div class="dropdown-menu  dropdown-menu-right">
                                    
                                    <div class="list-group list-group-flush">
                                        <a href="#"
                                            class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <div class="col ml--2">
                                                    <h4 class="mb-0 text-sm">Electra</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="list-group list-group-flush">
                                        <a href="#"
                                            class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <div class="col ml--2">
                                                    <h4 class="mb-0 text-sm">Baronas</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            </li>

                            <hr class="my-2">

                            <li class="nav-item dropdown">
                                <a style="font-size: 18px; text-align: center" class="nav-link" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-list-alt mr-2" style="font-size: 16px;"></i>
                                    <span> Daftar Peserta</span>
                                </a>
                                <div class="dropdown-menu  dropdown-menu-right">
                                    
                                    <div class="list-group list-group-flush">
                                        <a href="#"
                                            class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <div class="col ml--2">
                                                    <h4 class="mb-0 text-sm">Electra</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="list-group list-group-flush">
                                        <a href="#"
                                            class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <div class="col ml--2">
                                                    <h4 class="mb-0 text-sm">Semifinalis</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="list-group list-group-flush">
                                        <a href="#"
                                            class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <div class="col ml--2">
                                                    <h4 class="mb-0 text-sm">Baronas</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="list-group list-group-flush">
                                        <a href="#"
                                            class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <div class="col ml--2">
                                                    <h4 class="mb-0 text-sm">Evolve</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            </li>

                            <hr class="my-2">

                            <li class="nav-item dropdown">
                                <a style="font-size: 18px; text-align: center" class="nav-link" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-file-excel mr-2" style="font-size: 16px;"></i>
                                    <span> Export Data</span>
                                </a>

                                <div class="dropdown-menu  dropdown-menu-right">
                                    <div class="list-group list-group-flush">
                                        <a href="#"
                                            class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <div class="col ml--2">
                                                    <h4 class="mb-0 text-sm">Electra</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="list-group list-group-flush">
                                        <a href="#"
                                            class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <div class="col ml--2">
                                                    <h4 class="mb-0 text-sm">Baronas</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="list-group list-group-flush">
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <div class="col ml--2">
                                                    <h4 class="mb-0 text-sm">Evolve</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            
                            <hr class="my-2">

                            <li class="nav-item">
                                <a class="nav-link" href="#"
                                    style="font-size: 18px; text-align: center">
                                    <i class="fas fa-chart-bar" style="font-size: 16px;"></i>
                                    <span class="nav-link-text ml-2">Semifinal</span>
                                </a>
                            </li>

                            <hr class="my-2">

                            <li class="nav-item">
                                <a class="nav-link" href="#"
                                    style="font-size: 18px; text-align: center">
                                    <i class="fas fa-desktop" style="font-size: 16px;"></i>
                                    <span class="nav-link-text ml-2">Final Electra</span>
                                </a>
                            </li>

                            <hr class="my-2">

                            <li class="nav-item dropdown">
                                <a style="font-size: 18px; text-align: center" class="nav-link" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-podcast mr-2" style="font-size: 16px;"></i>
                                    <span>Live Baronas</span>
                                </a>

                                <div class="dropdown-menu  dropdown-menu-right">
                                    <div class="list-group list-group-flush">
                                        <a href="#"
                                            class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <div class="col ml--2">
                                                    <h4 class="mb-0 text-sm">Penyisihan SD</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="list-group list-group-flush">
                                        <a href="#"
                                            class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <div class="col ml--2">
                                                    <h4 class="mb-0 text-sm">Penyisihan SMP</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="list-group list-group-flush">
                                        <a href="#"
                                            class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <div class="col ml--2">
                                                    <h4 class="mb-0 text-sm">Penyisihan SMA</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            </li> -->
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

        <script src="admin/assets/vendor/jquery/dist/jquery.min.js"></script>
        <script src="admin/assets//vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="admin/assets//vendor/js-cookie/js.cookie.js"></script>
        <script src="admin/assets//vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="admin/assets//vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
        
        <script src="admin/assets/js/argon.js?v=1.2.0"></script>
        
        <script src="admin/assets/js/lightbox-plus-jquery.min.js"></script>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        
        <script src="admin/assets//vendor/datatables/jquery.dataTables.js"></script>
        <script src="admin/assets//vendor/datatables/dataTables.bootstrap4.min.js"></script>

    </body>

</html>