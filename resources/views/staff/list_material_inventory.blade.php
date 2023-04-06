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
                                                    <th>Status</th>
                                                    <th>Lokasi Penyimpanan</th>
                                                    <th>Nama Material</th>
                                                    <th>Nomor PO</th>
                                                    <th>Nomor Order</th>
                                                    <th>Nomor PR</th>
                                                    <th>Jumlah</th>
                                                    <th>Satuan</th>
                                                    <th>Kode Material</th>
                                                    <th>Nomor SPBB/Nota</th>
                                                    <th>Pemasok</th>
                                                    <th>EDA</th>
                                                    <th>Dokumen Material</th>
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
                                                        @if ($m->status == 2)
                                                            <span class="badge badge-pill badge-lg badge-success">Accepted</span>
                                                        @endif
                                                    </td>
                                                    <td>{{$m->lokasi}}</td>
                                                    <td>
                                                        @foreach ($m->nama_material as $nm)
                                                            <li>{{$nm}}</li>
                                                        @endforeach
                                                    </td>
                                                    <td>{{$m->nomor_po}}</td>
                                                    <td>{{$m->nomor_order}}</td>
                                                    <td>{{$m->nomor_pr}}</td>
                                                    <td>
                                                        @foreach ($m->jumlah as $j)
                                                            <li>{{$j}}</li>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($m->satuan as $s)
                                                            <li>{{$s}}</li>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($m->kode_material as $km)
                                                            <li>{{$km}}</li>
                                                        @endforeach
                                                    </td>
                                                    <td>{{$m->nomor_spbb_nota}}</td>
                                                    <td>{{$m->pemasok}}</td>
                                                    <td>{{$m->eda}}</td>
                                                    <td>
                                                        <a href="/storage/material_datang/{{$m->dokumen_material}}" target="_blank">
                                                            <button class="btn btn-md bg-warning mr-3" style="color: white;"  data-toggle="modal" data-target="#ganti-password">
                                                                Dokumen
                                                            </button>
                                                        </a>
                                                    </td>
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