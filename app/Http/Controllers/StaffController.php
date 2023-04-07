<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\Material_Datang;
use App\Models\Material_Sampai;
use App\Models\Material_Inventory;
use App\Models\Penggunaan_Material_Buffer;
use App\Models\Penggunaan_Material;
use App\Models\Notifikasi;

use App\Mail\MyMail;

use App\Imports\LPBImport;
use App\Exports\LPBexport;


class StaffController extends Controller
{
    public function list_kedatangan_material()
    {
        $material_datang = Material_Datang::all();
        
        $nama_material = array();
        $jumlah_material = array();
        $kode_material = array();
        $satuan = array();

        foreach($material_datang as $md)
        {        
            $nama_material[] = explode(',', $md->nama_material);
            $jumlah_material[] = explode(',', $md->jumlah);
            $kode_material[] = explode(',', $md->kode_material);
            $satuan[] = explode(',', $md->satuan);
        }


        $i = 0;
        foreach($material_datang as $md)
        {
            $md->nama_material = $nama_material[$i];
            $md->jumlah = $jumlah_material[$i];
            $md->kode_material = $kode_material[$i];
            $md->satuan = $satuan[$i];
            $i++;
        }

        return view('staff.list_kedatangan_material', compact('material_datang'));
    }

    //------------------------------------------------

    public function form_kedatangan_material()
    {
        return view('staff.kedatangan_material');
    }

    //------------------------------------------------

    public function form_kedatangan_material_process(Request $request)
    {
        $material_datang = new Material_Datang;
        $material_datang->nama_material = $request->input('nama-material');
        $material_datang->nomor_po = $request->input('no-po');
        $material_datang->nomor_order = $request->input('no-order');
        $material_datang->nomor_pr = $request->input('no-pr');
        $material_datang->jumlah = $request->input('jumlah');
        $material_datang->satuan = $request->input('satuan');
        $material_datang->kode_material = $request->input('kode-material');
        $material_datang->nomor_spbb_nota = $request->input('no-spbb-nota');
        $material_datang->pemasok = $request->input('pemasok');
        $material_datang->eda = $request->input('eda');
        $material_datang->dokumen_material = $request->file('file-syarat-kedatangan')->getClientOriginalName();

        if($material_datang->save() && $request->file('file-syarat-kedatangan')->storeAs('public/material_datang', $request->file('file-syarat-kedatangan')->getClientOriginalName()))
        {
            $notifikasi = new Notifikasi;
            $notifikasi->user_input = Auth::user()->username;
            $notifikasi->kegiatan = "menambah data " . $request->input('nama-material') . " pada form kedatangan material";
            $notifikasi->save();

            return redirect()->route('staff.list-kedatangan-material')->with('success', 'Data berhasil ditambahkan');
        }
        else
            return redirect()->route('staff.list-kedatangan-material')->with('error', 'Data gagal ditambahkan');
    }

    //------------------------------------------------

    public function list_material_sampai()
    {
        $material_sampai = Material_Sampai::all();

        $nama_material = array();
        $jumlah_material = array();
        $kode_material = array();
        $satuan = array();

        foreach($material_sampai as $ms)
        {        
            $nama_material[] = explode(',', $ms->nama_material);
            $jumlah_material[] = explode(',', $ms->jumlah);
            $kode_material[] = explode(',', $ms->kode_material);
            $satuan[] = explode(',', $ms->satuan);
        }


        $i = 0;
        foreach($material_sampai as $ms)
        {
            $ms->nama_material = $nama_material[$i];
            $ms->jumlah = $jumlah_material[$i];
            $ms->kode_material = $kode_material[$i];
            $ms->satuan = $satuan[$i];
            $i++;
        }

        return view('staff.list_material_sampai', compact('material_sampai'));
    }

    //------------------------------------------------

    public function material_sampai(Request $request)
    {
        $id = $request->input('id');
        $material_datang = Material_Datang::find($id);
        
        // ----------------------------

        $material_sampai = new Material_Sampai;
        $material_sampai->status = 0;
        $material_sampai->nama_material = $material_datang->nama_material;
        $material_sampai->nomor_po = $material_datang->nomor_po;
        $material_sampai->nomor_order = $material_datang->nomor_order;
        $material_sampai->nomor_pr = $material_datang->nomor_pr;
        $material_sampai->jumlah = $material_datang->jumlah;
        $material_sampai->satuan = $material_datang->satuan;
        $material_sampai->kode_material = $material_datang->kode_material;
        $material_sampai->nomor_spbb_nota = $material_datang->nomor_spbb_nota;
        $material_sampai->pemasok = $material_datang->pemasok;
        $material_sampai->eda = $material_datang->eda;
        $material_sampai->dokumen_material = $material_datang->dokumen_material;
        $material_sampai->save();

        // ----------------------------

        $material_datang->delete();

        // ----------------------------

        return redirect()->route('staff.list-material-sampai')->with('success', 'Data Material Sampai berhasil ditambahkan');

    }

    //------------------------------------------------

    public function list_notifikasi()
    {
        $notifikasi = DB::table('notifications')->orderBy('created_at', 'desc')->get();
        return view('staff.list_notifikasi', compact('notifikasi'));
    }

    //------------------------------------------------

    public function checklist_notifikasi($id)
    {
        $notifikasi = Notifikasi::find($id);
        $notifikasi->delete();

        return redirect()->route('staff.list-notifikasi');
    }

    //------------------------------------------------

    public function update_status_material($kode_update, $id)
    {
        $material_sampai = Material_Sampai::find($id);
        $material_sampai->status = $kode_update;
        $material_sampai->save();

        return redirect()->route('staff.list-material-sampai')->with('success', 'Status Material Sampai berhasil diubah');
    }

    //------------------------------------------------

    public function accept_material(Request $request)
    {
        $id = $request->input('id');
        $lokasi = $request->input('tempat-penyimpanan');
        
        // ----------------------------

        $material_sampai = Material_Sampai::find($id);

        // ----------------------------

        $nama_material = array();
        $jumlah_material = array();
        $kode_material = array();
        $satuan = array();

        // ----------------------------

        $nama_material[] = explode(',', $material_sampai->nama_material);
        $jumlah_material[] = explode(',', $material_sampai->jumlah);
        $kode_material[] = explode(',', $material_sampai->kode_material);
        $satuan[] = explode(',', $material_sampai->satuan);

        // ----------------------------

        $len = count($nama_material[0]);
        for($i = 0; $i < $len; $i++)
        {
            $material_inventory = new Material_Inventory;
            $material_inventory->status = 2;
            $material_inventory->lokasi = $lokasi;
            $material_inventory->nama_material = $nama_material[0][$i];
            $material_inventory->nomor_po = $material_sampai->nomor_po;
            $material_inventory->nomor_order = $material_sampai->nomor_order;
            $material_inventory->nomor_pr = $material_sampai->nomor_pr;
            $material_inventory->jumlah = $jumlah_material[0][$i];
            $material_inventory->satuan = $satuan[0][$i];
            $material_inventory->kode_material = $kode_material[0][$i];
            $material_inventory->nomor_spbb_nota = $material_sampai->nomor_spbb_nota;
            $material_inventory->pemasok = $material_sampai->pemasok;
            $material_inventory->eda = $material_sampai->eda;
            $material_inventory->dokumen_material = $material_sampai->dokumen_material;
            $material_inventory->dokumen_an = $request->file('file-an')->getClientOriginalName();

            $material_inventory->save();
        }

        // ----------------------------

        $material_sampai->delete();

        // ----------------------------

        if($request->file('file-an')->storeAs('public/acceptance_notice', $request->file('file-an')->getClientOriginalName()))
            return redirect()->route('staff.list-material-inventory')->with('success', 'Data Material berhasil diterima');
        else
            return redirect()->route('staff.list-material-inventory')->with('error', 'Data Material gagal diterima');

    }

    //------------------------------------------------

    public function reject_material(Request $request)
    {
        $id = $request->input('id');

        //------------------------
        
        $material_sampai = Material_Sampai::find($id);
        $material_sampai->status = 3;
        $material_sampai->save();

        //------------------------

        $notifikasi = new Notifikasi;
        $notifikasi->user_input = Auth::user()->username;
        $notifikasi->kegiatan = "menolak material " . $material_sampai->nama_material . " dengan nomor PO " . $material_sampai->nomor_po;
        $notifikasi->save();

        //------------------------

        return redirect()->route('staff.list-material-sampai')->with('success', 'Data Material berhasil ditolak');
    }

    //------------------------------------------------

    public function return_material(Request $request)
    {
        $id = $request->input('id');

        //------------------------

        $material_sampai = Material_Sampai::find($id);
        $material_sampai->status = 4;
        $material_sampai->save();

        //------------------------

        return redirect()->route('staff.list-material-sampai')->with('success', 'Data Material berhasil dikembalikan');
    }

    //------------------------------------------------

    public function list_material_inventory()
    {
        $material_inventory = Material_Inventory::all();

        return view('staff.list_material_inventory', compact('material_inventory'));
    }

    // ------------------------------------------------

    public function form_penggunaan_material()
    {
        $material_inventory = Material_Inventory::all();
        $penggunaan_material_buffer = Penggunaan_Material_Buffer::all();
        $len = count($penggunaan_material_buffer);

        return view('staff.form_penggunaan_material', compact('material_inventory', 'penggunaan_material_buffer', 'len'));
    }

    // ------------------------------------------------

    public function form_penggunaan_material_buffer_process(Request $request)
    {
        $id = $request->input('id_material_terpilih');
        $jumlah_akan_digunakan = $request->input('jumlah_material');

        // ----------------------------

        $material_inventory = Material_Inventory::find($id);
        $penggunaan_material_buffer = new Penggunaan_Material_Buffer;

        // ----------------------------

        $penggunaan_material_buffer->nama_material = $material_inventory->nama_material;
        $penggunaan_material_buffer->kode_material = $material_inventory->kode_material;
        $penggunaan_material_buffer->satuan = $material_inventory->satuan;
        $penggunaan_material_buffer->jumlah_akan_digunakan = $jumlah_akan_digunakan;

        // ----------------------------

        $penggunaan_material_buffer->save();
        return redirect()->route('staff.form-penggunaan-material')->with('success', 'Data Material berhasil ditambahkan');

    }

    // ------------------------------------------------

    public function hapus_penggunaan_material_raw($id)
    {
        $penggunaan_material_buffer = Penggunaan_Material_Buffer::find($id);
        $penggunaan_material_buffer->delete();

        return redirect()->route('staff.form-penggunaan-material')->with('success', 'Data Material berhasil dihapus');
    }

    // ------------------------------------------------

    public function form_penggunaan_material_process()
    {
        $penggunaan_material_buffer = Penggunaan_Material_Buffer::all();

        $nama_material = array();
        $jumlah_akan_digunakan = array();
        $kode_material = array();
        $satuan = array();

        // ----------------------------

        foreach ($penggunaan_material_buffer as $key => $value) {
            $nama_material[] = $value->nama_material;
            $jumlah_akan_digunakan[] = $value->jumlah_akan_digunakan;
            $kode_material[] = $value->kode_material;
            $satuan[] = $value->satuan;
        }

        // ----------------------------

        $material_inventory = Material_Inventory::all();

        foreach ($material_inventory as $key => $value) {
            for ($i=0; $i < count($kode_material); $i++) { 
                if($value->kode_material == $kode_material[$i] && $value->nama_material == $nama_material[$i]){
                    $value->jumlah = $value->jumlah - $jumlah_akan_digunakan[$i];
                    if ($value->jumlah < 0) {
                        return redirect()->route('staff.form-penggunaan-material')->with('failed', 'Jumlah Material '. $value->nama_material .' tidak mencukupi');
                    }
                    else 
                    {
                        $value->save();
                    }
                }
            }
        }

        // ----------------------------
        
        $nama_material = implode(",", $nama_material);
        $jumlah_akan_digunakan = implode(",", $jumlah_akan_digunakan);
        $kode_material = implode(",", $kode_material);
        $satuan = implode(",", $satuan);

        // ----------------------------

        $penggunaan_material = new Penggunaan_Material;
        $penggunaan_material->nama_material = $nama_material;
        $penggunaan_material->jumlah_yang_dipinjam = $jumlah_akan_digunakan;
        $penggunaan_material->kode_material = $kode_material;
        $penggunaan_material->satuan = $satuan;
        $penggunaan_material->save();

        // ----------------------------

        $penggunaan_material_buffer->each->delete();

        // ----------------------------

        $notifikasi = new Notifikasi;
        $notifikasi->user_input = Auth::user()->username;
        $notifikasi->kegiatan = "menggunakan material " . $nama_material . " dengan kode " . $kode_material . " sebanyak " . $jumlah_akan_digunakan . " " . $satuan;
        $notifikasi->save();

        // ----------------------------

        return redirect()->route('staff.list-penggunaan-material')->with('success', 'Data Penggunaan Material berhasil ditambahkan');
    }

    // ------------------------------------------------

    public function list_penggunaan_material()
    {
        $penggunaan_material = Penggunaan_Material::all();

        $nama_material = array();
        $jumlah_yang_dipinjam = array();
        $kode_material = array();
        $satuan = array();

        // ----------------------------

        foreach ($penggunaan_material as $key => $value) {
            $nama_material[] = explode(",", $value->nama_material);
            $jumlah_yang_dipinjam[] = explode(",", $value->jumlah_yang_dipinjam);
            $kode_material[] = explode(",", $value->kode_material);
            $satuan[] = explode(",", $value->satuan);
        }

        // ----------------------------

        $i = 0;
        foreach ($penggunaan_material as $key => $value) {
            $value->nama_material = $nama_material[$i];
            $value->jumlah_yang_dipinjam = $jumlah_yang_dipinjam[$i];
            $value->kode_material = $kode_material[$i];
            $value->satuan = $satuan[$i];
            $i++;
        }

        return view('staff.list_penggunaan_material', compact('penggunaan_material'));
    }

    // ------------------------------------------------

    public function export()
    {
        // download with styles
        return Excel::download(new LPBExport, 'LPB_coba.xlsx');
    }

    public function display_export()
    {
        return view('excel.t_LPB');
    }

}
