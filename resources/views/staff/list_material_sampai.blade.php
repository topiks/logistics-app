@extends('template/t_admin')
@section('title', 'Material Sampai | BBI Warehouse Materal System')

@section('container')

<div class="header bg-default pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#" style="color: #172B4D">List Material Sampai</a></li>
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
                        <a href="/exp_db/1" class="">
                            <button class="btn btn-md bg-success" style="color: white;">
                            <i class="fas fa-file-excel" style="font-size: 16px;"></i> Export Excel</button>
                        </a>
                    </h5>

                    <div class="sort-by-time mb-3">
                        <a href="/list-material-sampai/0">
                            @if($kode == 0)
                                <span class="badge badge-pill badge-lg badge-info">Semua</span>
                            @else
                                <span class="badge badge-pill badge-lg badge-primary">Semua</span>
                            @endif
                        </a>
                        <a href="/list-material-sampai/1">
                            @if($kode == 1)
                                <span class="badge badge-pill badge-lg badge-info">Hari Ini</span>
                            @else
                                <span class="badge badge-pill badge-lg badge-primary">Hari Ini</span>
                            @endif
                        </a>
                        <a href="/list-material-sampai/2">
                            @if($kode == 2)
                                <span class="badge badge-pill badge-lg badge-info">Minggu Ini</span>
                            @else
                                <span class="badge badge-pill badge-lg badge-primary">Minggu Ini</span>
                            @endif
                        </a>
                        <a href="/list-material-sampai/3">
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
                                                    <th>Dibuat Tanggal</th>
                                                    <th>Dokumen Material</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 0; ?>
                                                @foreach ($material_sampai as $m)
                                                <tr>
                                                    <?php $no++; ?>
                                                    <td><?= $no; ?></td>
                                                    <td>
                                                        @if ($m->status == 0)
                                                            <span class="badge badge-pill badge-lg badge-primary">Sampai</span>
                                                        @elseif ($m->status == 1)
                                                            <span class="badge badge-pill badge-lg badge-default">On Inspection</span>
                                                        @elseif ($m->status == 3)
                                                            <span class="badge badge-pill badge-lg badge-danger">Ditolak</span>
                                                        @elseif ($m->status == 4)
                                                        <span class="badge badge-pill badge-lg badge-info">Dikembalikan</span>
                                                        @endif
                                                    </td>
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
                                                    <td>{{$m->created_at}}</td>
                                                    <td>
                                                        <a href="/storage/material_datang/{{$m->dokumen_material}}" target="_blank">
                                                            <button class="btn btn-md bg-warning mr-3" style="color: white;"  data-toggle="modal" data-target="#ganti-password">
                                                                Dokumen
                                                            </button>
                                                        </a>
                                                    </td>
                                                    <td>
                                                    @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                                                        @if ($m->status != 4 && $m->status != 1)
                                                            <button class="btn btn-md bg-primary mr-3" style="color: white;" data-toggle="modal" data-target="#lpb" onclick="lpb({{ $m->id }});">
                                                                LPB
                                                            </button>
                                                        @endif

                                                        @if ($m->status == 0)
                                                            <button class="btn btn-md bg-default mr-3" style="color: white;"  data-toggle="modal" data-target="#on-inspection" onclick="on_inspection({{ $m->id }});">
                                                                On Inspection
                                                            </button>
                                                        @elseif ($m->status == 1)
                                                            <button class="btn btn-md bg-success mr-3" style="color: white;"  data-toggle="modal" data-target="#accept-modal" onclick="accept_material({{ $m->id }});">
                                                                Accept
                                                            </button>
                                                            <button class="btn btn-md bg-danger mr-3" style="color: white;"  data-toggle="modal" data-target="#reject-modal" onclick="reject_material({{ $m->id }});">
                                                                Reject
                                                            </button>
                                                        @elseif ($m->status == 3)
                                                            <button class="btn btn-md bg-info mr-3" style="color: white;"  data-toggle="modal" data-target="#return-modal" onclick="return_material({{ $m->id }});">
                                                                Kembalikan
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

    <!-- On Inspection  -->
    <div class="modal fade" id="on-inspection" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="mt-3">Material on Inspection ?</h3>
                
                    <div class="modal-footer">
                        <a id="on_ins" href="">
                            <button id="loloskan" href="" type="submit" class="btn btn-default">On Inspection</button>
                        </a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Export LPB  -->
    <div class="modal fade" id="lpb" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="mt-3">Export LPB ?</h3>
                
                    <div class="modal-footer">
                        <a id="export_lpb" href="">
                            <button id="loloskan" href="" type="submit" class="btn btn-default">Export</button>
                        </a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <!-- Rejected -->
    <div class="modal fade" id="reject-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="mt-3">Tolak Material ?</h3>
                    <form action="{{ route('staff.reject-material') }}" enctype="multipart/form-data" method="post">
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

    <!-- Acceptance -->
    <div class="modal fade" id="accept-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="mt-3">Setujui Material ?</h3>
                    <br>
                    <form action="{{ route('staff.accept-material') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="input-file-syarat-kedatangan">Lampirkan File AN (Acceptance Notice) dalam PDF</label>
                            <input name="file-an" accept="application/pdf" type="file" class="form-control-file" required>
                        </div>
                        <div class="form-group" hidden>
                            <label class="form-control-label" for="input-stock">ACC. Notice (PQC)</label>
                            <input name="acc_notice_pqc" type="text" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="input-stock">OP No.</label>
                            <input name="op_no" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="input-stock">BPM. No</label>
                            <input name="bpm_no" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="input-stock">Lokasi Penyimpanan</label>
                            <select name="tempat-penyimpanan" class="custom-select custom-select-lg mb-3" required>
                                <option hidden disabled selected>-- Pilih Lokasi Penyimpanan Material --</option>
                                <option value="Area B3">Area B3</option>
                                <option value="Area Tabung Gas">Area Tabung Gas</option>
                                <option value="Area Material">Area Material</option>
                                <option value="Area Open Yard">Area Open Yard</option>
                                <option value="Area Stainless Steel Material">Area Stainless Steel Material</option>
                            </select>
                        </div>
                        <div class="form-group" hidden>
                            <label class="form-control-label" for="input-school">id</label>
                            <input id="id_material_accept" name="id" type="text" class="form-control" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button id="loloskan" href="" type="submit" class="btn btn-success">Accept</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Dikembalikan -->
    <div class="modal fade" id="return-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="mt-3">Kembalikan Material ?</h3>
                    <form action="{{ route('staff.return-material') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group" hidden>
                            <label class="form-control-label" for="input-school">id</label>
                            <input id="id_return_mat" name="id" type="text" class="form-control" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button id="loloskan" href="" type="submit" class="btn btn-info">Kembalikan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function on_inspection(id) {
            document.getElementById('on_ins').setAttribute('href', '/update_status_material/' + '1/' + id);
        }

        function accept_material(id) {
            document.getElementById('id_material_accept').setAttribute('value', id);
        }

        function reject_material(id) {
            document.getElementById('id_reject_accept').setAttribute('value', id);
        }

        function return_material(id) {
            document.getElementById('id_return_mat').setAttribute('value', id);
        }

        function lpb(id) {
            document.getElementById('export_lpb').setAttribute('href', '/export_lpb/' + id);
        }
    </script>

@endsection