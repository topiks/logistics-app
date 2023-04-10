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
                            <li class="breadcrumb-item"><a href="#" style="color: #172B4D">List Inventory Gudang Besar</a></li>
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
                        <a href="/form_penggunaan_material" class="">
                            <button class="btn btn-md bg-primary" style="color: white;">
                            <i class="fas fa-plus" style="font-size: 16px;"></i> Form Penggunaan Material ke Gudang Kecil</button>
                        </a>

                        <a href="/form_request_restock_material_raw" class="">
                            <button class="btn btn-md bg-warning" style="color: white;">
                            <i class="fas fa-exclamation" style="font-size: 16px;"></i> Request Pengambilan Stock Material</button>
                        </a>
                        @endif
                        <a href="/exp_db/2" class="">
                            <button class="btn btn-md bg-success" style="color: white;">
                            <i class="fas fa-file-excel" style="font-size: 16px;"></i> Export Excel</button>
                        </a>
                    </h5>

                    <div class="sort-by-time mb-3">
                        <a href="/list_material_inventory/0">
                            @if($kode == 0)
                                <span class="badge badge-pill badge-lg badge-info">Semua</span>
                            @else
                                <span class="badge badge-pill badge-lg badge-primary">Semua</span>
                            @endif
                        </a>
                        <a href="/list_material_inventory/1">
                            @if($kode == 1)
                                <span class="badge badge-pill badge-lg badge-info">Hari Ini</span>
                            @else
                                <span class="badge badge-pill badge-lg badge-primary">Hari Ini</span>
                            @endif
                        </a>
                        <a href="/list_material_inventory/2">
                            @if($kode == 2)
                                <span class="badge badge-pill badge-lg badge-info">Minggu Ini</span>
                            @else
                                <span class="badge badge-pill badge-lg badge-primary">Minggu Ini</span>
                            @endif
                        </a>
                        <a href="/list_material_inventory/3">
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
                                                    <th>Jumlah</th>
                                                    <th>Satuan</th>
                                                    <th>Kode Material</th>
                                                    <th>Lokasi Penyimpanan</th>
                                                    <th>Diupdate Tanggal</th>
                                                    <th>Aksi</th>
                                                    <th>Dokumen Acceptance Notice</th>
                                                    <th>BPM</th>
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
                                                    <td>{{$m->updated_at}}</td>
                                                    <td>
                                                        @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                                                        <button class="btn btn-md bg-warning mr-3" style="color: white;"  data-toggle="modal" data-target="#update-stock" onclick="update_stock({{ $m->id }}, {{ $m->jumlah }});">
                                                            Update Stock
                                                        </button>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="/storage/acceptance_notice/{{$m->dokumen_an}}" target="_blank">
                                                            <button class="btn btn-md bg-primary mr-3" style="color: white;"  data-toggle="modal" data-target="#material-sampai" onclick="material_sampai({{ $m->id }});">
                                                                Acceptance Notice
                                                            </button>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-md bg-success mr-3" style="color: white;" data-toggle="modal" data-target="#bpm_modal" onclick="bpm({{ $m->id }});">
                                                            BPM
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

     <!-- Export BPM  -->
     <div class="modal fade" id="bpm_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="mt-3">Export BPM ?</h3>
                    <div class="modal-footer">
                        <a id="export_bpm" href="">
                            <button id="loloskan" href="" type="submit" class="btn btn-success">Export</button>
                        </a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- UPDATE STOCK -->
    <div class="modal fade" id="update-stock" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="mt-3">Update Stock Material</h3>
                    <form action="{{ route('staff.update-stock-material_inventory') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label" for="input-stock">Stock</label>
                            <input id="stock" name="stock" type="text" class="form-control" required>
                        </div>

                        <div class="form-group" hidden>
                            <label class="form-control-label" for="input-school">id</label>
                            <input id="id_material" name="id" type="text" class="form-control" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button id="loloskan" href="" type="submit" class="btn btn-warning">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function update_stock(id, jumlah) {
            document.getElementById('id_material').value = id;
            document.getElementById('stock').value = jumlah;
        }
        function bpm(id) {
            document.getElementById('export_bpm').setAttribute('href', '/export_bpm/' + id);
        }
    </script>

@endsection