@extends('template/t_admin')
@section('title', 'Dashboard | BBI Warehouse Materal System')

@section('container')

<div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url('account/images/dashboard_1.jpg'); background-size: cover; background-position: center;">

    <span class="mask bg-gradient-default opacity-7"></span>
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col col-md-10">
                @if ($role == 0)
                <h1 class="display-2 text-white mb-5" style="font-size: 50px">SELAMAT DATANG ADMIN</h1>
                @endif

                @if ($role == 1)
                <h1 class="display-2 text-white mb-5" style="font-size: 50px">SELAMAT DATANG SPV MANAGEMENT MATERIAL</h1>
                @endif

                @if ($role == 2)
                <h1 class="display-2 text-white mb-5" style="font-size: 50px">SELAMAT DATANG STAFF GUDANG UTAMA</h1>
                @endif

                @if ($role == 3)
                <h1 class="display-2 text-white mb-5" style="font-size: 50px">SELAMAT DATANG STAFF GUDANG WORKSHOP</h1>
                @endif

                @if ($role == 4)
                <h1 class="display-2 text-white mb-5" style="font-size: 50px">SELAMAT DATANG STAFF PENGADAAN</h1>
                @endif
            </div>
        </div>
    </div>

</div>

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                
                <div class="card-header border-0">
                    <h1 class="mb-0">Deskirpsi</h1>
                    <br>
                    @if($role == 0)
                    <p>
                        Admin hanya memiliki akses penuh dalam manajemen user
                    </p>
                    @elseif($role == 1)
                    <p>
                        Dalam sistem role ini akan dijalankan oleh seorang kepala management 
                        material PT. Boma Bisma Indra yang salah satu tugas dan tanggung 
                        jawabnya adalah memonitoring seluruh pergerakan persediaan material 
                        yang dimiliki perusahaan. User dapat menjalankan sistem website 
                        warehouse guna megelola data penerimaan, penyimpanan dan juga 
                        penggunaan material, seperti meng-input, meng-update, menghapus data 
                        material yang akan menjadi persediaan perusahaan. Role ini memliki akses 
                        yang lebih leluasa dalam penggunaan sistem. 
                    </p>
                    @elseif($role == 2)
                    <p>
                        Role ini diperankan oleh staff gudang material yang dibawahi langsung oleh 
                        Kepala Management Material. Role ini memiliki kewenangan dalam 
                        melayani permintaan material untuk pabrikasi pada sistem user ini memiliki 
                        tanggung jawab dalam meng-update list material gudang. User ini memiliki 
                        akses yang sama dengan user Spv MM, tetapi dengan atas permintaan dan 
                        perizinan dari user Spv MM.
                    </p>
                    @elseif($role == 3)
                    <p>
                        Role ini pada sistem diperankan oleh seorang pekerja pabrik yang 
                        merupakan PIC gudang pada area workshop. Role ini bertanggung jawab 
                        secara langsung kepada Kepala MM dalam pelaporan material setiap 
                        harinya. User ini harus dapat menggunakan sistem untuk mengisi form 
                        penggunaan material untuk produksi sesuai dengan nompor order, project, 
                        dan keterangan kegiatan, dan juga meng-update jumlah material yang 
                        disimpan di gudang workshop, 
                    </p>
                    @elseif($role == 4)
                    <p>
                        Role ini merupakan role pendukung dalam sistem dalam menyampaikan 
                        informasi kedatangan material. Role ini diperankan oleh Bagian Pengadaan 
                        Material. User pada pengguanaan sistem web dapat menginput data material 
                        yang akan datang. Informasi seperti nama, spesifikasi, jumlah, volume 
                        material dan juga No.PO, No. Order, Surat Jalan, Sertifikat Material yang 
                        disertakan oleh supplier serta estimasi kedatangan material diinput kedalam 
                        sistem.
                    </p>
                    @endif
                </div>
                
                <div class="table-responsive">
                    <table class="table align-items-center ">
                        <div class="media-body p-4">
                            <span class="name mb-0 text-sm" style="text-align: justify;">

                            </span>
                        </div>
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection