@extends('template/t_admin')
@section('title', 'Notifikasi | BBI Warehouse Materal System')

@section('container')

<div class="header bg-default pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#" style="color: #172B4D">Notifikasi Kegiatan</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-12" style="width: 100%;">
            <div class="card" style="width: 100%;">
                <div class="card-body">

                   

                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                <?php $baris = 0; ?>
                                @foreach($notifikasi as $n)
                                    <?php $baris++; ?>
                                    <div class="alert alert-primary" role="alert">                                    

                                        <a href="/checklist_notifikasi/{{$n->id}}">
                                            <button class="btn btn-md bg-success mr-3" style="color: white;"  data-toggle="modal" data-target="#ganti-password">
                                            <i class="fas fa-check"></i>
                                            </button>
                                        </a>

                                        <strong> {{$n->user_input}} {{$n->kegiatan}} | {{$n->created_at}} </strong>
                                    </div>

                                @endforeach

                                @if($baris == 0)
                                        <strong> Tidak ada notifikasi </strong>
                                @endif

                                </div>
                            </div>


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection