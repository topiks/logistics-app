@extends('template/t_admin')
@section('title', 'List User | BBI Warehouse Materal System')

@section('container')

<div class="header bg-default pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#" style="color: #172B4D">List User</a></li>
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
                        <a href="/add-account" class="">
                            <button class="btn btn-md bg-success" style="color: white;">
                            <i class="fas fa-plus" style="font-size: 16px;"></i> Tambahkan User</button>
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

                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Username </th>
                                                    <th>Role</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 0; ?>
                                                @foreach($users as $u)
                                                    @if ($u->role != 0)        
                                                        <?php $no++; ?>
                                                        <tr>
                                                            <td><?= $no; ?></td>
                                                            <td>{{$u->username}}</td>
                                                            <td>
                                                                @if ($u->role == 1)
                                                                    Spy Management Material
                                                                @endif
                                                                @if ($u->role == 2)
                                                                    Staff Gudang Utama
                                                                @endif
                                                                @if ($u->role == 3)
                                                                    Staff Gudang Workshop
                                                                @endif
                                                                @if ($u->role == 4)
                                                                    Staff Pengadaan
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-md bg-warning mr-3" style="color: white;"  data-toggle="modal" data-target="#ganti-password" onclick="ganti_password({{ $u->id }});">
                                                                    <i class="fas fa-edit" style="font-size: 16px;"></i> Ganti Password
                                                                </button>

                                                                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#ganti-role" onclick="ganti_role({{ $u->id }}, {{ $u->role }});">
                                                                    <i class="fas fa-hammer" style="font-size: 16px;"></i> Ubah Role
                                                                </button>

                                                                <a href="/delete_user/{{$u->id}}" class="">
                                                                    <button class="btn btn-md bg-danger" style="color: white;">
                                                                        <i class="fas fa-trash" style="font-size: 16px;"></i> Hapus
                                                                    </button>
                                                                </a>
                                                        </tr>
                                                    @endif
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

    <div class="modal fade" id="ganti-password" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="mt-3">Ubah Role</h3>
                    <form action="{{ route('admin.edit_password_user') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="form-control-label" for="input-school">Password</label>
                            <input name="password" type="password" class="form-control" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        </div>

                        <div class="form-group" hidden>
                            <label class="form-control-label" for="input-school">id</label>
                            <input id="id_pass_role" name="id" type="text" class="form-control" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button id="loloskan" href="" type="submit" class="btn btn-success">Ubah</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ganti-role" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="mt-3">Ubah Role</h3>
                    <form action="{{ route('admin.edit_role_user') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group">
                            <select id="role_selected" name="role" class="custom-select custom-select-lg mb-3" required>
                                <option hidden disabled selected>-- Pilih Role --</option>
                                <option value="1">Spy Management Material</option>
                                <option value="2">Staff Gudang Utama</option>
                                <option value="3">Staff Gudang Workshop</option>
                                <option value="4">Staff Pengadaan</option>
                            </select>
                        </div>

                        <div class="form-group" hidden>
                            <label class="form-control-label" for="input-school">id</label>
                            <input id="id_model_role" name="id" type="text" class="form-control" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button id="loloskan" href="" type="submit" class="btn btn-success">Ubah</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function ganti_role(id, role) {
            document.getElementById('id_model_role').value = id;
            document.getElementById('role_selected').value = role;
        }

        function ganti_password(id) {
            document.getElementById('id_pass_role').value = id;
        }
    </script>

@endsection