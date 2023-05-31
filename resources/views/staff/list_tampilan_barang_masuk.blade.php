@extends('template/t_admin')
@section('title', 'Daftar Barang Masuk | BBI Warehouse Materal System')

@section('container')

<div class="header bg-default pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#" style="color: #172B4D">Daftar Barang Masuk</a></li>
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
                        <a href="/exp_db/5" class="">
                            <button class="btn btn-md bg-success" style="color: white;">
                            <i class="fas fa-file-excel" style="font-size: 16px;"></i> Export Excel</button>
                        </a>
                    </h5>

                    <div class="sort-by-time mb-3">
                        <a href="/list_barang_masuk/0">
                            @if($kode == 0)
                                <span class="badge badge-pill badge-lg badge-info">Semua</span>
                            @else
                                <span class="badge badge-pill badge-lg badge-primary">Semua</span>
                            @endif
                        </a>
                        <a href="/list_barang_masuk/1">
                            @if($kode == 1)
                                <span class="badge badge-pill badge-lg badge-info">Hari Ini</span>
                            @else
                                <span class="badge badge-pill badge-lg badge-primary">Hari Ini</span>
                            @endif
                        </a>
                        <a href="/list_barang_masuk/2">
                            @if($kode == 2)
                                <span class="badge badge-pill badge-lg badge-info">Minggu Ini</span>
                            @else
                                <span class="badge badge-pill badge-lg badge-primary">Minggu Ini</span>
                            @endif
                        </a>
                        <a href="/list_barang_masuk/3">
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
                                                    <th>Nomor PO</th>
                                                    <th>Nomor Order</th>
                                                    <th>Nomor PR</th>
                                                    <th>Jumlah</th>
                                                    <th>Satuan</th>
                                                    <th>Kode Material</th>
                                                    <th>Nomor SPBB/Nota</th>
                                                    <th>Pemasok</th>
                                                    <th>Nomor OP</th>
                                                    <th>Nomor BPM</th>
                                                    <th>Waktu Masuk</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 0; ?>
                                                @foreach ($daftar_barang_masuk as $d)
                                                <tr>
                                                    <?php $no++; ?>
                                                    <td><?= $no; ?></td>
                                                    <td>{{$d->nama_material}}</td>
                                                    <td>{{$d->nomor_po}}</td>
                                                    <td>{{$d->nomor_order}}</td>
                                                    <td>{{$d->nomor_pr}}</td>
                                                    <td>{{$d->jumlah}}</td>
                                                    <td>{{$d->satuan}}</td>
                                                    <td>{{$d->kode_material}}</td>
                                                    <td>{{$d->nomor_spbb_nota}}</td>
                                                    <td>{{$d->pemasok}}</td>
                                                    <td>{{$d->op_no}}</td>
                                                    <td>{{$d->bpm_no}}</td>
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