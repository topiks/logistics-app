@extends('template/t_admin')
@section('title', 'Daftar Barang Keluar | BBI Warehouse Materal System')

@section('container')

<div class="header bg-default pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#" style="color: #172B4D">Daftar Barang Keluar</a></li>
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

                    <h5 class="card-title" style="font-size: xx-large; text-align: left;">
                        <a href="/exp_db/6" class="">
                            <button class="btn btn-md bg-success" style="color: white;">
                            <i class="fas fa-file-excel" style="font-size: 16px;"></i> Export Excel</button>
                        </a>
                    </h5>

                    <div class="sort-by-time mb-3">
                        <a href="/list_barang_keluar/0">
                            @if($kode == 0)
                                <span class="badge badge-pill badge-lg badge-info">Semua</span>
                            @else
                                <span class="badge badge-pill badge-lg badge-primary">Semua</span>
                            @endif
                        </a>
                        <a href="/list_barang_keluar/1">
                            @if($kode == 1)
                                <span class="badge badge-pill badge-lg badge-info">Hari Ini</span>
                            @else
                                <span class="badge badge-pill badge-lg badge-primary">Hari Ini</span>
                            @endif
                        </a>
                        <a href="/list_barang_keluar/2">
                            @if($kode == 2)
                                <span class="badge badge-pill badge-lg badge-info">Minggu Ini</span>
                            @else
                                <span class="badge badge-pill badge-lg badge-primary">Minggu Ini</span>
                            @endif
                        </a>
                        <a href="/list_barang_keluar/3">
                            @if($kode == 3)
                                <span class="badge badge-pill badge-lg badge-info">Bulan Ini</span>
                            @else
                            <span class="badge badge-pill badge-lg badge-primary">Bulan Ini</span>
                            @endif
                        </a>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-4">
                                <div class="card-body">

                                    @if ($notification = Session::get('success'))
                                        <div class="alert alert-success" role="alert">
                                            <strong>{{ $notification }}</strong>
                                        </div>
                                    @endif

                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Material</th>
                                                    <th>Spesifikasi</th>
                                                    <th>Kode Material</th>
                                                    <th>Satuan</th>
                                                    <th>Jumlah Yang Dipinjam</th>
                                                    <th>Nomor BPG</th>
                                                    <th>Waktu Barang Keluar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 0; ?>
                                                @foreach ($daftar_barang_keluar as $d)
                                                <tr>
                                                    <td>{{ ++$no }}</td>
                                                    <td>{{$d->nama_material}}</td>
                                                    <td>{{$d->spesifikasi}}</td>
                                                    <td>{{$d->kode_material}}</td>
                                                    <td>{{$d->satuan}}</td>
                                                    <td>{{$d->jumlah_yang_dipinjam}}</td>
                                                    <td>{{$d->no_bpg}}</td>
                                                    <td>{{$d->updated_at}}</td>
                                                </tr>
                                                @endforeach
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
    </div>


@endsection