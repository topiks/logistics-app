@extends('template/t_admin')
@section('title', 'Kedatangan Material | BBI Warehouse Materal System')

@section('container')


<div class="header bg-default pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a style="color: #172B4D">Kedatangan Material</a></li>
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
                            
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ route('staff.form-kedatangan-material-process') }}" enctype="multipart/form-data" method="post">
                                            @csrf

                                            @if ($notification = Session::get('failed'))
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $notification }}</strong>
                                            </div>
                                            @endif

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-school">Nama Material</label>
                                                <input name="nama-material" type="text" class="form-control"  required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-school">Nomor PO</label>
                                                <input name="no-po" type="text" class="form-control"  required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-school">Nomor Order</label>
                                                <input name="no-order" type="text" class="form-control"  required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-school">Nomor PR</label>
                                                <input name="no-pr" type="text" class="form-control"  required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-school">Jumlah</label>
                                                <input name="jumlah" type="text" class="form-control"  required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-school">Kode Material</label>
                                                <input name="kode-material" type="text" class="form-control"  required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-school">Nomor SPBB/Nota</label>
                                                <input name="no-spbb-nota" type="text" class="form-control"  required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-school">Pemasok</label>
                                                <input name="pemasok" type="text" class="form-control"  required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-school">EDA</label>
                                                <input name="eda" type="text" class="form-control"  required>
                                            </div>

                                            <div class="form-group">
                                                <label for="input-file-syarat-kedatangan">Unggah File Invoice, BL, PO, Surat Jalan, Sertifikat Material (Jadikan 1 PDF)</label>
                                                <input name="file-syarat-kedatangan" accept="application/pdf" type="file" class="form-control-file" required>
                                            </div>

                                            <button type="submit" value="" class="btn text-lighter" style="width: 100%; background-color: #264579;">Submit</button>
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

@endsection