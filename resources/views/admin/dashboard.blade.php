@extends('template/t_admin')
@section('title', 'Dashboard | BBI Warehouse Materal System')

@section('container')

<div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url('account/images/bg-02.jpg'); background-size: cover; background-position: center;">

    <span class="mask bg-gradient-default opacity-7"></span>
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col col-md-10">
                @if ($role == 0)
                <h1 class="display-2 text-white mb-5" style="font-size: 50px">SELAMAT DATANG ADMIN</h1>
                @endif

                @if ($role == 1)
                <h1 class="display-2 text-white mb-5" style="font-size: 50px">SELAMAT DATANG SPY MANAGEMENT MATERIAL</h1>
                @endif

                @if ($role == 2)
                <h1 class="display-2 text-white mb-5" style="font-size: 50px">SELAMAT DATANG STAFF GUDANG UTAMA</h1>
                @endif

                @if ($role == 3)
                <h1 class="display-2 text-white mb-5" style="font-size: 50px">SELAMAT DATANG STAFF GUDANG WORKSHOP</h1>
                @endif

                @if ($role == 4)
                <h1 class="display-2 text-white mb-5" style="font-size: 50px">SELAMAT DATANG STAFF PENGADAAN</h1>
                @endif
            </div>
        </div>
    </div>

</div>

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                
                <div class="card-header border-0">
                    <h1 class="mb-0">Deskirpsi</h1>
                    <br>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                        It has survived not only five centuries, but also the leap into electronic typesetting, remaining 
                        essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets 
                        containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus 
                        PageMaker including versions of Lorem Ipsum</p>
                </div>
                
                <div class="table-responsive">
                    <table class="table align-items-center ">
                        <div class="media-body p-4">
                            <span class="name mb-0 text-sm" style="text-align: justify;">

                            </span>
                        </div>
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection