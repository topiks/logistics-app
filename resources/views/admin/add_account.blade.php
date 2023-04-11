@extends('template/t_admin')
@section('title', 'Add Account | BBI Warehouse Materal System')

@section('container')

<div class="header bg-default pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a style="color: #172B4D">Tambahkan Akun</a></li>
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
                                        <form action="{{ route('admin.add-account-process') }}" enctype="multipart/form-data" method="post">
                                            @csrf

                                            @if ($notification = Session::get('failed'))
                                            <div class="alert alert-danger" role="alert">
                                                <strong>{{ $notification }}</strong>
                                            </div>
                                            @endif

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-school">Username</label>
                                                <input name="username" type="text" class="form-control" placeholder="Username" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-school">Password</label>
                                                <input name="password" type="password" class="form-control" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label" for="input-school">Role</label>
                                                <select name="role" class="custom-select custom-select-lg mb-3" required>
                                                    <option hidden disabled selected>-- Pilih Role --</option>
                                                    <option value="1">Spv Management Material</option>
                                                    <option value="2">Staff Gudang Utama</option>
                                                    <option value="3">Staff Gudang Workshop</option>
                                                    <option value="4">Staff Pengadaan</option>
                                                </select>
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