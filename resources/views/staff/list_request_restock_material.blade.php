@extends('template/t_admin')
@section('title', 'List Resuest Restock Material | BBI Warehouse Materal System')

@section('container')

<div class="header bg-default pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#" style="color: #172B4D">List Request Restock Material</a></li>
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
                                                    <th>Nama Material</th>
                                                    <th>Kode Material</th>
                                                    <th>Waktu Request</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 0; ?>
                                                @foreach ($request_stock as $m)
                                                <tr>
                                                    <?php $no++; ?>
                                                    <td><?= $no; ?></td>
                                                    <td>
                                                        @if ($m->status == 0)
                                                            <span class="badge badge-pill badge-warning">Menunggu Persetujuan</span>
                                                        @elseif ($m->status == 1)
                                                            <span class="badge badge-pill badge-success">Disetujui</span>
                                                        @elseif ($m->status == 2)
                                                            <span class="badge badge-pill badge-danger">Ditolak</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @foreach ($m->nama_material as $nm)
                                                            <li>{{$nm}}</li>
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

                                                                <button class="btn btn-md bg-warning mr-3" style="color: white;"  data-toggle="modal" data-target="#reject-modal" onclick="reject_material({{ $m->id }});">
                                                                    Reject
                                                                </button>

                                                                <button class="btn btn-md bg-danger mr-3" style="color: white;"  data-toggle="modal" data-target="#material-hapus" onclick="material_hapus({{ $m->id }});">
                                                                Hapus
                                                                </button>
                                                            @endif
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
                <h3 class="mt-3">Setujui Restock Material ?</h3>
                <form action="{{ route('staff.acc-request-restock-material') }}" enctype="multipart/form-data" method="post">
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
                <h3 class="mt-3">Tolak Restock Material ?</h3>
                <form action="{{ route('staff.reject-request-restock-material') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group" hidden>
                        <label class="form-control-label" for="input-school">id</label>
                        <input id="id_reject_accept" name="id" type="text" class="form-control" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button id="loloskan" href="" type="submit" class="btn btn-warning">Tolak</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Hapus  -->
<div class="modal fade" id="material-hapus" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="mt-3">Hapus Material ?</h3>
                <form action="{{ route('staff.hapus-restock') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group" hidden>
                        <label class="form-control-label" for="input-school">id</label>
                        <input id="id_material_hapus" name="id" type="text" class="form-control" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button id="loloskan" href="" type="submit" class="btn btn-danger">Hapus</button>
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

        function material_hapus(id) {
            document.getElementById('id_material_hapus').value = id;
        }

    </script>

@endsection