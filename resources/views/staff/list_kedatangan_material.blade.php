@extends('template/t_admin')
@section('title', 'List Kedatangan Material | BBI Warehouse Materal System')

@section('container')

<div class="header bg-default pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#" style="color: #172B4D">Material yang Akan Datang</a></li>
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

                    @if (Auth::user()->role == 4)
                    <h5 class="card-title" style="font-size: xx-large; text-align: left;">
                        <a href="/kedatangan-material" class="">
                            <button class="btn btn-md bg-success" style="color: white;">
                            <i class="fas fa-plus" style="font-size: 16px;"></i> Tambahkan Material Akan Datang </button>
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
                                                    <th>Status</th>
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
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 0; ?>
                                                @foreach ($material_datang as $m)
                                                <tr>
                                                    <?php $no++; ?>
                                                    <td><?= $no; ?></td>
                                                    <td><span class="badge badge-pill badge-lg badge-warning">Akan Datang</span></td>
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

                                                    @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                                                    <td>
                                                        <button class="btn btn-md bg-success mr-3" style="color: white;"  data-toggle="modal" data-target="#material-sampai" onclick="material_sampai({{ $m->id }});">
                                                            Sampai
                                                        </button>
                                                    </td>
                                                    @endif
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

    <div class="modal fade" id="material-sampai" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="mt-3">Material Sudah Sampai ?</h3>
                    <form action="{{ route('staff.material-sampai') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group" hidden>
                            <label class="form-control-label" for="input-school">id</label>
                            <input id="id_material_sampai" name="id" type="text" class="form-control" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button id="loloskan" href="" type="submit" class="btn btn-success">Sampai</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function material_sampai(id) {
            document.getElementById('id_material_sampai').value = id;
        }
    </script>

@endsection