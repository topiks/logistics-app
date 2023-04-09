@extends('template/t_admin')
@section('title', 'List Gudang Kecil | BBI Warehouse Materal System')

@section('container')

<div class="header bg-default pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#" style="color: #172B4D">List Inventory Gudang Kecil</a></li>
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
                        @if (Auth::user()->role == 3)
                        <a href="/form_penggunaan_material_gudang_kecil" class="">
                            <button class="btn btn-md bg-primary" style="color: white;">
                            <i class="fas fa-plus" style="font-size: 16px;"></i> Form Penggunaan Material oleh Staff Pekerja</button>
                        </a>
                        @endif

                        <a href="/exp_db/3" class="">
                            <button class="btn btn-md bg-success" style="color: white;">
                            <i class="fas fa-file-excel" style="font-size: 16px;"></i> Export Excel</button>
                        </a>

                        <a href="/list_penggunaan_material_gudang_kecil" class="">
                            <button class="btn btn-md bg-warning" style="color: white;">
                            <i class="fas fa-list" style="font-size: 16px;"></i> List Penggunaan Material</button>
                        </a>
                    </h5>

                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-4">
                                <div class="card-body">

                                    @if ($notification = Session::get('success'))
                                        <div class="alert alert-success" role="alert">
                                            <strong>{{ $notification }}</strong>
                                        </div>
                                    @endif

                                    @if ($notification = Session::get('failed'))
                                        <div class="alert alert-danger" role="alert">
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
                                                    <th>Spesifikasi</th>
                                                    <th>Jumlah</th>
                                                    <th>Satuan</th>
                                                    <th>Kode Material</th>
                                                    <th>Waktu Pengambilan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 0; ?>
                                                @foreach ($penggunaan_material as $m)
                                                <tr>
                                                    <?php $no++; ?>
                                                    <td><?= $no; ?></td>
                                                    <td>
                                                        @if($m->status == 0)
                                                            <span class="badge badge-warning">Menunggu Persetujuan</span>
                                                        @elseif($m->status == 1)
                                                            <span class="badge badge-success">Disetujui</span>
                                                        @elseif($m->status == 2)
                                                            <span class="badge badge-danger">Ditolak</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @foreach ($m->nama_material as $nm)
                                                            <li>{{$nm}}</li>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach($m->spesifikasi as $s)
                                                            <li>{{$s}}</li>
                                                        @endforeach
                                                    <td>
                                                        @foreach($m->jumlah_yang_dipinjam as $j)
                                                            <li>{{$j}}</li>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach($m->satuan as $s)
                                                            <li>{{$s}}</li>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach($m->kode_material as $k)
                                                            <li>{{$k}}</li>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $m->created_at }}</td>
                                                    <td>
                                                        @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                                                            @if($m->status == 0)
                                                            <button class="btn btn-md bg-success mr-3" style="color: white;"  data-toggle="modal" data-target="#acc-modal" onclick="accept_material({{ $m->id }});">
                                                                Accept
                                                            </button>

                                                            <button class="btn btn-md bg-danger mr-3" style="color: white;"  data-toggle="modal" data-target="#reject-modal" onclick="reject_material({{ $m->id }});">
                                                                Reject
                                                            </button>
                                                            @endif

                                                        @endif

                                                        @if($m->status == 1)
                                                                <button class="btn btn-md bg-primary mr-3" style="color: white;">
                                                                    BPG
                                                                </button>
                                                        @endif
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

<!-- Accepted -->
<div class="modal fade" id="acc-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="mt-3">Setujui Penggunaan Material ke Gudang Kecil ?</h3>
                    <form action="{{ route('staff.acc-penggunaan-gudang-kecil') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group" hidden>
                            <label class="form-control-label" for="input-school">id</label>
                            <input id="id_material_accept" name="id" type="text" class="form-control" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button id="loloskan" href="" type="submit" class="btn btn-success">Setujui</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
                </form>
            </div>
        </div>
    </div>

<!-- Rejected -->
<div class="modal fade" id="reject-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="mt-3">Tolak Penggunaan Material ke Gudang Kecil ?</h3>
                    <form action="{{ route('staff.reject-penggunaan-gudang-kecil') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group" hidden>
                            <label class="form-control-label" for="input-school">id</label>
                            <input id="id_reject_accept" name="id" type="text" class="form-control" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button id="loloskan" href="" type="submit" class="btn btn-danger">Tolak</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function accept_material(id) {
            document.getElementById('id_material_accept').setAttribute('value', id);
        }

        function reject_material(id) {
            document.getElementById('id_reject_accept').setAttribute('value', id);
        }

    </script>

@endsection