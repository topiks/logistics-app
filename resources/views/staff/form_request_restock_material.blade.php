@extends('template/t_admin')
@section('title', 'Form Request Restock | BBI Warehouse Materal System')

@section('container')

<div class="header bg-default pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a style="color: #172B4D">Form Request Pengambilan Stock Material</a></li>
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
                                        <button class="btn btn-md bg-warning mb-3" style="color: white"  data-toggle="modal" data-target="#ajukan-restock-modal">
                                            <i class="fas fa-store" style="font-size: 16px;"></i> Ajukan Restock Material
                                        </button>
                                  
                                        <div class="row">
                                            @foreach($request_stock_buffer as $rsb)
                                            <div class="card col-8 col-md-2 bg-success p-3 m-2">
                                                <h3>Nama Material : {{$rsb->nama_material}}</h3>
                                                <h3>Kode Material : {{$rsb->kode_material}}</h3>
                                                <a href="/hapus_request_restock_material_raw/{{$rsb->id}}" class="text-align: left">
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
                                        <form action="{{ route('staff.form-request-restock-material-raw-process') }}" enctype="multipart/form-data" method="post">
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
                                                    <option hidden disabled selected>-- Pilih Material --</option>
                                                    @foreach($material_inventory as $m)
                                                        <option value="{{$m->id}}">Nama : {{$m->nama_material}} | Kode : {{$m->kode_material}} | Stock : {{$m->jumlah}} {{$m->satuan}}</option>
                                                    @endforeach
                                                </select>
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

    <div class="modal fade" id="ajukan-restock-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="mt-3">Ajukan Restock Material ?</h3>
                </div>
                <div class="modal-footer">
                    <a href="/form_request_restock_material">
                        <button id="loloskan" href="" type="submit" class="btn btn-warning">Ajukan</button>
                    </a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

@endsection