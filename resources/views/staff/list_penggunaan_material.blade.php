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
                            <li class="breadcrumb-item"><a href="#" style="color: #172B4D">List Penggunaan Material</a></li>
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
                                                    <th>Nama Material</th>
                                                    <th>Jumlah</th>
                                                    <th>Satuan</th>
                                                    <th>Kode Material</th>
                                                    <th>Waktu Peminjaman</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 0; ?>
                                                @foreach ($penggunaan_material as $m)
                                                <tr>
                                                    <?php $no++; ?>
                                                    <td><?= $no; ?></td>
                                                    <td>
                                                        @foreach ($m->nama_material as $nm)
                                                            <li>{{$nm}}</li>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach($m->jumlah_yang_dipinjam as $j)
                                                            <li>{{$j}}</li>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach($m->satuan as $s)
                                                            <li>{{$s}}</li>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach($m->kode_material as $k)
                                                            <li>{{$k}}</li>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $m->created_at }}</td>
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

@endsection