@extends('template/t_admin')
@section('title', 'Material Inventory | BBI Warehouse Materal System')

@section('container')

<div class="header bg-default pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#" style="color: #172B4D">List Material Inventory</a></li>
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

                    @if (Auth::user()->role == 3)
                    <h5 class="card-title" style="font-size: xx-large; text-align: left;">
                        <a href="/form_penggunaan_material" class="">
                            <button class="btn btn-md bg-primary" style="color: white;">
                            <i class="fas fa-plus" style="font-size: 16px;"></i> Form Penggunaan Material</button>
                        </a>
                    </h5>
                    @endif

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
                                                    <th>Jumlah</th>
                                                    <th>Satuan</th>
                                                    <th>Kode Material</th>
                                                    <th>Lokasi Penyimpanan</th>
                                                    <th>Dokumen Acceptance Notice</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 0; ?>
                                                @foreach ($material_inventory as $m)
                                                <tr>
                                                    <?php $no++; ?>
                                                    <td><?= $no; ?></td>
                                                    <td>
                                                        {{$m->nama_material}}
                                                    </td>
                                                    <td>
                                                        {{$m->jumlah}}
                                                    </td>
                                                    <td>
                                                        {{$m->satuan}}
                                                    </td>
                                                    <td>
                                                        {{$m->kode_material}}
                                                    </td>
                                                    <td>{{$m->lokasi}}</td>
                                                    <td>
                                                        <button class="btn btn-md bg-primary mr-3" style="color: white;"  data-toggle="modal" data-target="#material-sampai" onclick="material_sampai({{ $m->id }});">
                                                            Acceptance Notice
                                                        </button>
                                                    </td>
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