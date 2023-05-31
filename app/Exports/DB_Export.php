<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Models\Material_Datang;
use App\Models\Material_Sampai;
use App\Models\Material_Inventory;
use App\Models\Penggunaan_Material;
use App\Models\Penggunaan_Gudang_Kecil;
use App\Models\Daftar_Barang_Masuk;
use App\Models\Daftar_Barang_Keluar;

class DB_Export implements FromQuery, WithHeadings
{
    /*
        Kode untuk mengambil data dari database
        |----- 0 = Material Datang
        |----- 1 = Material Sampai
        |----- 2 = Material Inventory / Gudang Besar
        |----- 3 = Material Gudang Kecil
        |----- 4 = Material Penggunaan
        |----- 5 = Daftar Barang Masuk
    */

    use Exportable;

    public function __construct($_kode)
    {
        $this->kode_tabel = $_kode;
    }

    public function query()
    {
       if ($this->kode_tabel == 0) {
            return Material_Datang::query();
       } else if ($this->kode_tabel == 1) {
            return Material_Sampai::query();
       } else if ($this->kode_tabel == 2) {
            return Material_Inventory::query();
       } else if ($this->kode_tabel == 3) {
            return Penggunaan_Material::query();
       } else if ($this->kode_tabel == 4) {
            return Penggunaan_Gudang_Kecil::query();
       } else if ($this->kode_tabel == 5) {
            return Daftar_Barang_Masuk::query();
       } else if ($this->kode_tabel == 6) {
            return Daftar_Barang_Keluar::query();
   }
    }

    public function headings(): array
    {
        if ($this->kode_tabel == 0) 
        {
            return [
                'id',
                'nama_material',
                'nomor po',
                'nomor order',
                'nomor pr',
                'jumlah',
                'satuan',
                'kode material',
                'nomor spbb nota',
                'pemasok',
                'eda',
                'dokumen material',
                'dibuat tanggal',
                'diupdate tanggal'
            ];
        }

        else if ($this->kode_tabel == 1) 
        {
            return [
                'id',
                'status',
                'nama material',
                'nomor po',
                'nomor order',
                'nomor pr',
                'jumlah',
                'satuan',
                'kode material',
                'nomor spbb nota',
                'pemasok',
                'eda',
                'dokumen material',
                'dibuat tanggal',
                'diupdate tanggal'
            ];
        }

        else if ($this->kode_tabel == 2) 
        {
            return [
                'id',
                'status',
                'lokasi',
                'nama_material',
                'nomor po',
                'nomor order',
                'nomor pr',
                'jumlah',
                'satuan',
                'kode material',
                'nomor spbb nota',
                'pemasok',
                'eda',
                'dokumen material',
                'dokumen an',
                'dibuat tanggal',
                'diupdate tanggal'
            ];
        }
        else if ($this->kode_tabel == 3) 
        {
            return [
                'id',
                'nama material',
                'status',
                'spesifikasi',
                'kode material',
                'satuan',
                'jumlah',
                'dibuat tanggal',
                'diupdate tanggal'
            ];
        }
        else if ($this->kode_tabel == 4) 
        {
            return [
                'id',
                'nama material',
                'status',
                'spesifikasi',
                'kode material',
                'satuan',
                'jumlah',
                'nama project',
                'dibuat tanggal',
                'diupdate tanggal'
            ];
        }
        else if ($this->kode_tabel == 5) 
        {
            return [
                'id',
                'lokasi',
                'nama_material',
                'nomor po',
                'nomor order',
                'nomor pr',
                'jumlah',
                'satuan',
                'kode material',
                'nomor spbb nota',
                'pemasok',
                'op_no',
                'bpm_no',
                'dibuat tanggal',
                'diupdate tanggal'
            ];
        }
        else if ($this->kode_tabel == 6) 
        {
            return [
                'id',
                'nama material',
                'spesifikasi',
                'kode material',
                'satuan',
                'jumlah yang dikeluar',
                'no bpg',
                'dibuat tanggal',
                'diupdate tanggal'
            ];
        }
    }
}
