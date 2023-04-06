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
                                                @foreach ($material_sampai as $m)
                                                <tr>
                                                    <?php $no++; ?>
                                                    <td><?= $no; ?></td>
                                                    <td>
                                                        @if ($m->status == 0)
                                                            <span class="badge badge-pill badge-lg badge-primary">Sampai</span>
                                                        @elseif ($m->status == 1)
                                                            <span class="badge badge-pill badge-lg badge-default">On Inspection</span>
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
                                                    <td>
                                                        <a href="/storage/material_datang/{{$m->dokumen_material}}" target="_blank">
                                                            <button class="btn btn-md bg-warning mr-3" style="color: white;"  data-toggle="modal" data-target="#ganti-password">
                                                                Dokumen
                                                            </button>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-md bg-primary mr-3" style="color: white;"  data-toggle="modal" data-target="#material-sampai" onclick="material_sampai({{ $m->id }});">
                                                            LPB
                                                        </button>

                                                        @if ($m->status == 0)
                                                            <button class="btn btn-md bg-default mr-3" style="color: white;"  data-toggle="modal" data-target="#on-inspection" onclick="on_inspection({{ $m->id }});">
                                                                On Inspection
                                                            </button>
                                                        @elseif ($m->status == 1)
                                                            <button class="btn btn-md bg-success mr-3" style="color: white;"  data-toggle="modal" data-target="#accept-modal" onclick="accept_material({{ $m->id }});">
                                                                Accept
                                                            </button>
                                                            <button class="btn btn-md bg-danger mr-3" style="color: white;"  data-toggle="modal" data-target="#on-inspection" onclick="on_inspection({{ $m->id }});">
                                                                Reject
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
                        <div class="form-group">
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

    <script type="text/javascript">
        function on_inspection(id) {
            document.getElementById('on_ins').setAttribute('href', '/update_status_material/' + '1/' + id);
        }

        function accept_material(id) {
            document.getElementById('id_material_accept').setAttribute('value', id);
        }
    </script>

@endsection