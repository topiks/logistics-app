@extends('template/t_admin')
@section('title', 'Form Penggunaan Material Gudang Kecil | BBI Warehouse Materal System')

@section('container')

<div class="header bg-default pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a style="color: #172B4D">Form Penggunaan Material Gudang Kecil oleh Staff Pekerja</a></li>
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
                        @if($len != 0)
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <button class="btn btn-md bg-primary mb-3" style="color: white"  data-toggle="modal" data-target="#gunakan-material-modal">
                                            <i class="fas fa-cart-plus" style="font-size: 16px;"></i> Gunakan Material
                                        </button>
                                  
                                        <div class="row">
                                            @foreach($penggunaan_material_buffer as $pmb)
                                            <div class="card col-8 col-md-2 bg-success p-3 m-2">
                                                <h3>Nama Material : {{$pmb->nama_material}}</h3>
                                                <h3>Kode Material : {{$pmb->kode_material}}</h3>
                                                <h3>Akan Digunakan : {{$pmb->jumlah_akan_digunakan}} {{$pmb->satuan}}</h3>
                                                <a href="/hapus_penggunaan_material_raw/{{$pmb->id}}" class="text-align: left">
                                                    <button class="btn btn-md bg-danger" style="color: white;">Hapus</button>
                                                </a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ route('staff.form-penggunaan-material-gudang-kecil-process') }}" enctype="multipart/form-data" method="post">
                                            @csrf

                                            @if ($notification = Session::get('failed'))
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $notification }}</strong>
                                            </div>
                                            @endif

                                            @if ($notification = Session::get('success'))
                                            <div class="alert alert-success" role="alert">
                                                <strong>{{ $notification }}</strong>
                                            </div>
                                            @endif

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-nama-material">Nama Material</label>
                                                <select name="id_material_terpilih" class="custom-select custom-select-lg mb-3" required>
                                                    <option hidden disabled selected>-- Pilih Material di Gudang Kecil --</option>
                                                    @foreach($penggunaan_material as $m)
                                                        <option value="{{$m->id}}">Nama : {{$m->nama_material}} | Kode : {{$m->kode_material}} | Stock : {{$m->jumlah_yang_dipinjam}} {{$m->satuan}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-school">Spesifikasi</label>
                                                <input name="spesifikasi" type="text" class="form-control"  required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-school">Jumlah Penggunaan Material</label>
                                                <input name="jumlah_material" type="text" class="form-control"  required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-school">Order</label>
                                                <input name="project" type="text" class="form-control"  required>
                                            </div>

                                            <button type="submit" value="" class="btn text-lighter" style="width: 100%; background-color: #264579;">Tambah</button>
                                            <hr class="my-4" />
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="modal fade" id="gunakan-material-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="mt-3">Gunakan Material ?</h3>
                </div>
                <div class="modal-footer">
                    <a href="/form_penggunaan_material_gudang_kecil_process_final">
                        <button id="loloskan" href="" type="submit" class="btn btn-primary">Gunakan</button>
                    </a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

@endsection