@extends('template/t_admin')
@section('title', 'Ganti Password | BBI Warehouse Materal System')

@section('container')

<div class="header bg-default pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a style="color: #172B4D">Ganti Password</a></li>
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
                                        <form action="{{ route('admin.ganti_pass_process') }}" enctype="multipart/form-data" method="post">
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
                                                <label class="form-control-label" for="input-school">Password Lama</label>
                                                <input name="password_lama" type="password" class="form-control" placeholder="Password Lama" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-school">Password Baru</label>
                                                <input name="password_baru" type="password" class="form-control" placeholder="Password Baru" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                            </div>

                                            <button type="submit" value="pembayaran" class="btn text-lighter" style="width: 100%; background-color: #264579;">Submit</button>
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