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
use App\Models\Penggunaan_Gudang_Kecil;
use App\Models\Request_Stock_Buffer;
use App\Models\Request_Stock;
use App\Models\Notifikasi;

use App\Mail\MyMail;

use App\Imports\LPBImport;
use App\Exports\LPBexport;
use App\Exports\DB_Export;


class StaffController extends Controller
{
    public function list_kedatangan_material($kode)
    {   
        if($kode == 0)
            $material_datang = Material_Datang::all();
        else if($kode == 1)
            $material_datang = Material_Datang::whereDate('created_at', date('Y-m-d'))->get();
        else if($kode == 2)
            $material_datang = Material_Datang::whereBetween('created_at', [date('Y-m-d', strtotime('monday this week')), date('Y-m-d', strtotime('sunday this week'))])->get();
        else if($kode == 3)
            $material_datang = Material_Datang::whereMonth('created_at', date('m'))->get();
        
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

        return view('staff.list_kedatangan_material', compact('material_datang', 'kode'));
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

            return redirect()->route('staff.list-kedatangan-material', ['kode' => 0])->with('success', 'Data berhasil ditambahkan');
        }
        else
            return redirect()->route('staff.list-kedatangan-material', ['kode' => 0])->with('error', 'Data gagal ditambahkan');
    }

    //------------------------------------------------

    public function list_material_sampai($kode)
    {
        if($kode == 0)
            $material_sampai = Material_Sampai::all();
        else if($kode == 1)
            $material_sampai = Material_Sampai::whereDate('created_at', date('Y-m-d'))->get();
        else if($kode == 2)
            $material_sampai = Material_Sampai::whereBetween('created_at', [date('Y-m-d', strtotime('monday this week')), date('Y-m-d', strtotime('sunday this week'))])->get();
        else if($kode == 3)
            $material_sampai = Material_Sampai::whereMonth('created_at', date('m'))->get();

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

        return view('staff.list_material_sampai', compact('material_sampai', 'kode'));
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

        return redirect()->route('staff.list-material-sampai', ['kode' => 0])->with('success', 'Data Material Sampai berhasil ditambahkan');

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

        return redirect()->route('staff.list-material-sampai', ['kode' => 0])->with('success', 'Status Material Sampai berhasil diubah');
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

        $notifikasi = new Notifikasi;
        $notifikasi->user_input = Auth::user()->username;
        $notifikasi->kegiatan = "menyetujui penerimaan menerima material " . $material_sampai->nama_material . " dengan nomor PO " . $material_sampai->nomor_po;
        $notifikasi->save();

        // ----------------------------

        $material_sampai->delete();

        // ----------------------------

        if($request->file('file-an')->storeAs('public/acceptance_notice', $request->file('file-an')->getClientOriginalName()))
            return redirect()->route('staff.list-material-inventory', ['kode' => 0])->with('success', 'Data Material berhasil diterima');
        else
            return redirect()->route('staff.list-material-inventory', ['kode' => 0])->with('error', 'Data Material gagal diterima');

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

        return redirect()->route('staff.list-material-sampai', ['kode' => 0])->with('success', 'Data Material berhasil ditolak');
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

        return redirect()->route('staff.list-material-sampai', ['kode' => 0])->with('success', 'Data Material berhasil dikembalikan');
    }

    //------------------------------------------------

    public function list_material_inventory($kode)
    {
        if($kode == 0)
            $material_inventory = Material_Inventory::all();
        else if($kode == 1)
            $material_inventory = Material_Inventory::whereDate('updated_at', date('Y-m-d'))->get();
        else if($kode == 2)
            $material_inventory = Material_Inventory::whereBetween('updated_at', [date('Y-m-d', strtotime('monday this week')), date('Y-m-d', strtotime('sunday this week'))])->get();
        else if($kode == 3)
            $material_inventory = Material_Inventory::whereMonth('updated_at', date('m'))->get();

        return view('staff.list_material_inventory', compact('material_inventory', 'kode'));
    }

    // ------------------------------------------------

    public function update_stock_material_inventory(Request $request)
    {
        $id = $request->input('id');
        $jumlah = $request->input('stock');

        // ----------------------------

        $material_inventory = Material_Inventory::find($id);
        $material_inventory->jumlah = $jumlah;
        $material_inventory->save();

        // ----------------------------

        return redirect()->route('staff.list-material-inventory', ['kode' => 0])->with('success', 'Data Material berhasil diubah');
    }

    // ------------------------------------------------

    public function form_penggunaan_material()
    {
        $material_inventory = Material_Inventory::all();
        $penggunaan_material_buffer = Penggunaan_Material_Buffer::where('status', 0)->get();
        $len = count($penggunaan_material_buffer);

        return view('staff.form_penggunaan_material', compact('material_inventory', 'penggunaan_material_buffer', 'len'));
    }

    // ------------------------------------------------

    public function form_penggunaan_material_buffer_process(Request $request)
    {
        $id = $request->input('id_material_terpilih');
        $jumlah_akan_digunakan = $request->input('jumlah_material');
        $spesifikasi = $request->input('spesifikasi');

        // ----------------------------

        $material_inventory = Material_Inventory::find($id);
        $penggunaan_material_buffer = new Penggunaan_Material_Buffer;

        // ----------------------------

        $penggunaan_material_buffer->nama_material = $material_inventory->nama_material;
        $penggunaan_material_buffer->status = 0;
        $penggunaan_material_buffer->spesifikasi = $spesifikasi;
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
        $status = $penggunaan_material_buffer->status;
        $penggunaan_material_buffer->delete();

        if($status == 1)
            return redirect()->route('staff.form-penggunaan-material-gudang-kecil')->with('success', 'Data Material berhasil dihapus');
        else if($status == 0)
            return redirect()->route('staff.form-penggunaan-material')->with('success', 'Data Material berhasil dihapus');
    }

    // ------------------------------------------------

    public function form_penggunaan_material_process()
    {
        $penggunaan_material_buffer = Penggunaan_Material_Buffer::where('status', 0)->get();

        $nama_material = array();
        $spesifikasi = array();
        $jumlah_akan_digunakan = array();
        $kode_material = array();
        $satuan = array();

        // ----------------------------

        foreach ($penggunaan_material_buffer as $key => $value) {
            $nama_material[] = $value->nama_material;
            $spesifikasi[] = $value->spesifikasi;
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
                }
            }
        }

        // ----------------------------
        
        $nama_material = implode(",", $nama_material);
        $spesifikasi = implode(",", $spesifikasi);
        $jumlah_akan_digunakan = implode(",", $jumlah_akan_digunakan);
        $kode_material = implode(",", $kode_material);
        $satuan = implode(",", $satuan);

        // ----------------------------

        $penggunaan_material = new Penggunaan_Material;
        $penggunaan_material->nama_material = $nama_material;
        $penggunaan_material->status = 0;
        $penggunaan_material->spesifikasi = $spesifikasi;
        $penggunaan_material->jumlah_yang_dipinjam = $jumlah_akan_digunakan;
        $penggunaan_material->kode_material = $kode_material;
        $penggunaan_material->satuan = $satuan;
        $penggunaan_material->save();

        // ----------------------------

        $penggunaan_material_buffer->each->delete();

        // ----------------------------

        $notifikasi = new Notifikasi;
        $notifikasi->user_input = Auth::user()->username;
        $notifikasi->kegiatan = "meminta menggunakan material " . $nama_material . " dengan kode " . $kode_material . " sebanyak " . $jumlah_akan_digunakan . " " . $satuan . " ke gudang kecil";
        $notifikasi->save();

        // ----------------------------

        return redirect()->route('staff.list-penggunaan-material', ['kode' => 0])->with('success', 'Data Penggunaan Material berhasil ditambahkan');
    }

    // ------------------------------------------------

    public function list_penggunaan_material($kode)
    {
        if($kode == 0)
            $penggunaan_material = Penggunaan_Material::all();
        else if($kode == 1)
            $penggunaan_material = Penggunaan_Material::whereDate('updated_at', date('Y-m-d'))->get();
        else if($kode == 2)
            $penggunaan_material = Penggunaan_Material::whereBetween('updated_at', [date('Y-m-d', strtotime('monday this week')), date('Y-m-d', strtotime('sunday this week'))])->get();
        else if($kode == 3)
            $penggunaan_material = Penggunaan_Material::whereMonth('updated_at', date('m'))->get();

        $nama_material = array();
        $spesifikasi = array();
        $jumlah_yang_dipinjam = array();
        $kode_material = array();
        $satuan = array();

        // ----------------------------

        foreach ($penggunaan_material as $key => $value) {
            $nama_material[] = explode(",", $value->nama_material);
            $spesifikasi[] = explode(",", $value->spesifikasi);
            $jumlah_yang_dipinjam[] = explode(",", $value->jumlah_yang_dipinjam);
            $kode_material[] = explode(",", $value->kode_material);
            $satuan[] = explode(",", $value->satuan);
        }

        // ----------------------------

        $i = 0;
        foreach ($penggunaan_material as $key => $value) {
            $value->nama_material = $nama_material[$i];
            $value->spesifikasi = $spesifikasi[$i];
            $value->jumlah_yang_dipinjam = $jumlah_yang_dipinjam[$i];
            $value->kode_material = $kode_material[$i];
            $value->satuan = $satuan[$i];
            $i++;
        }

        return view('staff.list_penggunaan_material', compact('penggunaan_material', 'kode'));
    }

    // ------------------------------------------------

    public function acc_penggunaan_gudang_kecil(Request $request)
    {
        $id = $request->input('id');
        $penggunaan_material = Penggunaan_Material::find($id);
        $jumlah_yang_dipinjam = $penggunaan_material->jumlah_yang_dipinjam;

        // ---------------------------

        $nama_material = array();
        $spesifikasi = array();
        $jumlah_yang_dipinjam = array();
        $kode_material = array();
        $satuan = array();

        $nama_material[] = explode(",", $penggunaan_material->nama_material);
        $spesifikasi[] = explode(",", $penggunaan_material->spesifikasi);
        $jumlah_yang_dipinjam[] = explode(",", $penggunaan_material->jumlah_yang_dipinjam);
        $kode_material[] = explode(",", $penggunaan_material->kode_material);
        $satuan[] = explode(",", $penggunaan_material->satuan);

        // ----------------------------

        $material_inventory = Material_Inventory::all();
        
        foreach ($material_inventory as $key => $value) {
            for ($i=0; $i < count($kode_material[0]); $i++) { 
                if($value->kode_material == $kode_material[0][$i] && $value->nama_material == $nama_material[0][$i]){
                    $value->jumlah = $value->jumlah - $jumlah_yang_dipinjam[0][$i];
                    if ($value->jumlah < 0) {
                        return redirect()->route('staff.list-penggunaan-material', ['kode' => 0])->with('failed', 'Jumlah Material '. $value->nama_material .' tidak mencukupi');
                    }
                    else{
                        $value->save();
                    }
                }
            }
        }
        
        // ----------------------------

        $jumlah_data = count($nama_material[0]);
        for($i=0; $i<$jumlah_data; $i++){
            $penggunaan_material_satuan = Penggunaan_Material::where('kode_material', $kode_material[0][$i])->where('status', 1)->get();
            if($penggunaan_material_satuan->count() > 0){
                $penggunaan_material_satuan = $penggunaan_material_satuan->first();
                $penggunaan_material_satuan->jumlah_yang_dipinjam = $penggunaan_material_satuan->jumlah_yang_dipinjam + $jumlah_yang_dipinjam[0][$i];
                $penggunaan_material_satuan->save();
            }
            else{
                $penggunaan_material_satuan = new Penggunaan_Material;
                $penggunaan_material_satuan->nama_material = $nama_material[0][$i];
                $penggunaan_material_satuan->status = 1;
                $penggunaan_material_satuan->spesifikasi = $spesifikasi[0][$i];
                $penggunaan_material_satuan->jumlah_yang_dipinjam = $jumlah_yang_dipinjam[0][$i];
                $penggunaan_material_satuan->kode_material = $kode_material[0][$i];
                $penggunaan_material_satuan->satuan = $satuan[0][$i];
                $penggunaan_material_satuan->save();
            }
        }

        // ----------------------------

        $notifikasi = new Notifikasi;
        $notifikasi->user_input = Auth::user()->username;
        $notifikasi->kegiatan = "menyetujui penerimaan pengambilan material " . $penggunaan_material->penggunaan_material . " dengan kode material " . $penggunaan_material->kode_material . " dari gudang besar ke gudang kecil";
        $notifikasi->save();

        // ----------------------------

        $penggunaan_material->delete();

        // ----------------------------

        return redirect()->route('staff.list-penggunaan-material', ['kode' => 0])->with('success', 'Penggunaan Material berhasil disetujui');
    }

    // ------------------------------------------------

    public function reject_penggunaan_gudang_kecil(Request $request)
    {
        $id = $request->input('id');
        $penggunaan_material = Penggunaan_Material::find($id);

        $penggunaan_material->status = 2;
        $penggunaan_material->save();

        $notifikasi  = new Notifikasi;
        $notifikasi->user_input = Auth::user()->username;
        $notifikasi->kegiatan = "menolak penggunaan material " . $penggunaan_material->nama_material . " dengan kode material " . $penggunaan_material->kode_material . " dari gudang besar ke gudang kecil";
        $notifikasi->save();

        return redirect()->route('staff.list-penggunaan-material')->with('success', 'Penggunaan Material berhasil ditolak');

    }

    // ------------------------------------------------

    public function form_request_restock_material_raw()
    {
        $material_inventory = Material_Inventory::all();
        $request_stock_buffer = Request_Stock_Buffer::all();
        $len = count($request_stock_buffer);

        return view('staff.form_request_restock_material', compact('material_inventory', 'request_stock_buffer', 'len'));
    }

    // ------------------------------------------------

    public function form_request_restock_material_raw_process(Request $request)
    {
        $id = $request->input('id_material_terpilih');

        // ----------------------------

        $material_inventory = Material_Inventory::find($id);
        $request_stock_buffer = new Request_Stock_Buffer;

        // ----------------------------

        $request_stock_buffer->nama_material = $material_inventory->nama_material;
        $request_stock_buffer->kode_material = $material_inventory->kode_material;
        $request_stock_buffer->save();

        // ----------------------------

        return redirect()->route('staff.form-request-restock-material-raw')->with('success', 'Data Material berhasil ditambahkan');
    }

    // ------------------------------------------------

    public function hapus_request_restock_material_raw($id)
    {
        $request_stock_buffer = Request_Stock_Buffer::find($id);
        $request_stock_buffer->delete();

        return redirect()->route('staff.form-request-restock-material-raw')->with('success', 'Data Material berhasil dihapus');
    }

    // ------------------------------------------------

    public function form_request_restock_material()
    {
        $request_stock_buffer = Request_Stock_Buffer::all();

        $nama_material = array();
        $kode_material = array();

        // ----------------------------

        foreach ($request_stock_buffer as $key => $value) {
            $nama_material[] = $value->nama_material;
            $kode_material[] = $value->kode_material;
        }

        // ----------------------------

        $nama_material = implode(",", $nama_material);
        $kode_material = implode(",", $kode_material);

        // ----------------------------

        $request_stock = new Request_Stock;
        $request_stock->status = 0;
        $request_stock->nama_material = $nama_material;
        $request_stock->kode_material = $kode_material;
        $request_stock->save();

        // ----------------------------

        $request_stock_buffer->each->delete();

        // ----------------------------

        $notifikasi = new Notifikasi;
        $notifikasi->user_input = Auth::user()->username;
        $notifikasi->kegiatan = "mengajukan permintaan restock material " . $nama_material . " dengan kode " . $kode_material;
        $notifikasi->save();

        // ----------------------------

        return redirect()->route('staff.list-request-restock-material')->with('success', 'Data Request Restock Material berhasil ditambahkan');
    }

    // ------------------------------------------------

    public function list_request_restock_material_raw()
    {
        $request_stock = Request_Stock::all();

        $nama_material = array();
        $kode_material = array();

        // ----------------------------

        foreach ($request_stock as $key => $value) {
            $nama_material[] = explode(",", $value->nama_material);
            $kode_material[] = explode(",", $value->kode_material);
        }

        // ----------------------------

        $i = 0;
        foreach ($request_stock as $key => $value) {
            $value->nama_material = $nama_material[$i];
            $value->kode_material = $kode_material[$i];
            $i++;
        }

        return view('staff.list_request_restock_material', compact('request_stock'));
    }

    // ------------------------------------------------

    public function acc_request_restock_material(Request $request)
    {
        $id = $request->input('id');

        // ----------------------------
        
        $request_stock = Request_Stock::find($id);
        $request_stock->status = 1;

        // ----------------------------

        $request_stock->save();

        // ----------------------------

        $notifikasi = new Notifikasi;
        $notifikasi->user_input = Auth::user()->username;
        $notifikasi->kegiatan = "menyetujui permintaan restock material " . $request_stock->nama_material . " dengan kode " . $request_stock->kode_material;
        $notifikasi->save();

        return redirect()->route('staff.list-request-restock-material')->with('success', 'Request Restock Material berhasil disetujui');
    }

    // ------------------------------------------------

    public function reject_request_restock_material(Request $request)
    {
        $id = $request->input('id');

        // ----------------------------
        
        $request_stock = Request_Stock::find($id);
        $request_stock->status = 2;

        // ----------------------------

        $request_stock->save();

        // ----------------------------

        $notifikasi = new Notifikasi;
        $notifikasi->user_input = Auth::user()->username;
        $notifikasi->kegiatan = "menolak permintaan restock material " . $request_stock->nama_material . " dengan kode " . $request_stock->kode_material;
        $notifikasi->save();

        return redirect()->route('staff.list-request-restock-material')->with('success', 'Request Restock Material berhasil ditolak');
    }

    // ------------------------------------------------

    public function form_penggunaan_material_gudang_kecil()
    {
        $penggunaan_material = Penggunaan_Material::all();
        $penggunaan_material_buffer = Penggunaan_Material_Buffer::where('status', 1)->get();
        $len = count($penggunaan_material_buffer);

        return view('staff.form_penggunaan_material_gkecil', compact('penggunaan_material', 'penggunaan_material_buffer', 'len'));
    }

    // ------------------------------------------------

    public function form_penggunaan_material_gudang_kecil_process(Request $request)
    {
        $id = $request->input('id_material_terpilih');
        $spesifikasi = $request->input('spesifikasi');
        $jumlah = $request->input('jumlah_material');
        $project = $request->input('project');

        // ----------------------------

        $penggunaan_material = Penggunaan_Material::find($id);
        $penggunaan_material_buffer = new Penggunaan_Material_Buffer;

        // ----------------------------

        $penggunaan_material_buffer->nama_material = $penggunaan_material->nama_material;
        $penggunaan_material_buffer->kode_material = $penggunaan_material->kode_material;
        $penggunaan_material_buffer->spesifikasi = $spesifikasi;
        $penggunaan_material_buffer->jumlah_akan_digunakan = $jumlah;
        $penggunaan_material_buffer->status = 1;
        $penggunaan_material_buffer->satuan = $penggunaan_material->satuan;
        $penggunaan_material_buffer->project = $project;
        $penggunaan_material_buffer->save();

        // ----------------------------

        return redirect()->route('staff.form-penggunaan-material-gudang-kecil')->with('success', 'Data Material berhasil ditambahkan');
    }

    // ------------------------------------------------

    public function form_penggunaan_material_gudang_kecil_process_final()
    {
        $penggunaan_material_buffer = Penggunaan_Material_Buffer::where('status', 1)->get();

        $nama_material = array();
        $spesifikasi = array();
        $jumlah_akan_digunakan = array();
        $kode_material = array();
        $satuan = array();
        $project = array();

        // ----------------------------

        foreach ($penggunaan_material_buffer as $key => $value) {
            $nama_material[] = $value->nama_material;
            $spesifikasi[] = $value->spesifikasi;
            $jumlah_akan_digunakan[] = $value->jumlah_akan_digunakan;
            $kode_material[] = $value->kode_material;
            $satuan[] = $value->satuan;
            $project[] = $value->project;
        }

        // ----------------------------

        $penggunaan_material = Penggunaan_Material::all();

        foreach ($penggunaan_material as $key => $value) {
            for($i = 0; $i < count($kode_material); $i++)
            {
                if($value->kode_material == $kode_material[$i] && $value->nama_material == $nama_material[$i]){
                    $value->jumlah_yang_dipinjam = $value->jumlah_yang_dipinjam - $jumlah_akan_digunakan[$i];
                    if ($value->jumlah_yang_dipinjam < 0) {
                        return redirect()->route('staff.form-penggunaan-material-gudang-kecil')->with('failed', 'Jumlah Material '. $value->nama_material .' tidak mencukupi');
                    }
                }
            }
        }

        // ----------------------------

        $nama_material = implode(",", $nama_material);
        $spesifikasi = implode(",", $spesifikasi);
        $jumlah_akan_digunakan = implode(",", $jumlah_akan_digunakan);
        $kode_material = implode(",", $kode_material);
        $satuan = implode(",", $satuan);
        $project = implode(",", $project);

        // ----------------------------

        $penggunaan_gudang_kecil = new Penggunaan_Gudang_Kecil;
        $penggunaan_gudang_kecil->nama_material = $nama_material;
        $penggunaan_gudang_kecil->spesifikasi = $spesifikasi;
        $penggunaan_gudang_kecil->jumlah_yang_dipinjam = $jumlah_akan_digunakan;
        $penggunaan_gudang_kecil->kode_material = $kode_material;
        $penggunaan_gudang_kecil->satuan = $satuan;
        $penggunaan_gudang_kecil->status = 0;
        $penggunaan_gudang_kecil->project = $project;
        $penggunaan_gudang_kecil->save();

        // ----------------------------

        $penggunaan_material_buffer->each->delete();

        // ----------------------------

        $notifikasi = new Notifikasi;
        $notifikasi->user_input = Auth::user()->username;
        $notifikasi->kegiatan = "meminta menggunakan material " . $nama_material . " dengan kode " . $kode_material . " sebanyak " . $jumlah_akan_digunakan . " " . $satuan . " ke staff pekerja";
        $notifikasi->save();

        // ----------------------------

        return redirect()->route('staff.list-penggunaan-material-gudang-kecil', ['kode' => 0])->with('success', 'Data Penggunaan Material berhasil ditambahkan');

    }

    // ------------------------------------------------

    public function list_penggunaan_material_gudang_kecil($kode)
    {
        if($kode == 0)
            $penggunaan_gudang_kecil = Penggunaan_Gudang_Kecil::all();
        else if($kode == 1)
            $penggunaan_gudang_kecil = Penggunaan_Gudang_Kecil::whereDate('updated_at', date('Y-m-d'))->get();
        else if($kode == 2)
            $penggunaan_gudang_kecil = Penggunaan_Gudang_Kecil::whereBetween('updated_at', [date('Y-m-d', strtotime('monday this week')), date('Y-m-d', strtotime('sunday this week'))])->get();
        else if($kode == 3)
            $penggunaan_gudang_kecil = Penggunaan_Gudang_Kecil::whereMonth('updated_at', date('m'))->get();

        $nama_material = array();
        $spesifikasi = array();
        $jumlah_yang_dipinjam = array();
        $kode_material = array();
        $satuan = array();
        $project = array();

        // ----------------------------

        foreach ($penggunaan_gudang_kecil as $key => $value) {
            $nama_material[] = explode(",", $value->nama_material);
            $spesifikasi[] = explode(",", $value->spesifikasi);
            $jumlah_yang_dipinjam[] = explode(",", $value->jumlah_yang_dipinjam);
            $kode_material[] = explode(",", $value->kode_material);
            $satuan[] = explode(",", $value->satuan);
            $project[] = explode(",", $value->project);
        }

        // ----------------------------

        $i = 0;
        foreach ($penggunaan_gudang_kecil as $key => $value) {
            $value->nama_material = $nama_material[$i];
            $value->spesifikasi = $spesifikasi[$i];
            $value->jumlah_yang_dipinjam = $jumlah_yang_dipinjam[$i];
            $value->kode_material = $kode_material[$i];
            $value->satuan = $satuan[$i];
            $value->project = $project[$i];
            $i++;
        }

        return view('staff.list_penggunaan_gudang_kecil', compact('penggunaan_gudang_kecil', 'kode'));
    }

    // ------------------------------------------------

    public function acc_penggunaan_material_gudang_kecil(Request $request)
    {
        $id = $request->input('id');
        $penggunaan_gudang_kecil = Penggunaan_Gudang_Kecil::find($id);
        $jumlah_yang_dipinjam = $penggunaan_gudang_kecil->jumlah_yang_dipinjam;

        // ---------------------------

        $nama_material = array();
        $spesifikasi = array();
        $jumlah_yang_dipinjam = array();
        $kode_material = array();
        $satuan = array();
        $project = array();

        $nama_material[] = explode(",", $penggunaan_gudang_kecil->nama_material);
        $spesifikasi[] = explode(",", $penggunaan_gudang_kecil->spesifikasi);
        $jumlah_yang_dipinjam[] = explode(",", $penggunaan_gudang_kecil->jumlah_yang_dipinjam);
        $kode_material[] = explode(",", $penggunaan_gudang_kecil->kode_material);
        $satuan[] = explode(",", $penggunaan_gudang_kecil->satuan);
        $project[] = explode(",", $penggunaan_gudang_kecil->project);

        // ----------------------------

        $penggunaan_material = Penggunaan_Material::all();

        foreach ($penggunaan_material as $key => $value) {
            for ($i=0; $i < count($kode_material[0]); $i++) { 
                if($value->kode_material == $kode_material[0][$i] && $value->nama_material == $nama_material[0][$i]){
                    $value->jumlah_yang_dipinjam = $value->jumlah_yang_dipinjam - $jumlah_yang_dipinjam[0][$i];
                    if ($value->jumlah_yang_dipinjam < 0) {
                        return redirect()->route('staff.list-penggunaan-material-gudang-kecil', ['kode' => 0])->with('failed', 'Jumlah Material '. $value->nama_material .' tidak mencukupi');
                    }
                    else{
                        $value->save();
                    }
                }
            }
        }

        // ----------------------------

        $jumlah_data = count($nama_material[0]);
        for($i=0; $i<$jumlah_data; $i++){
            $penggunaan_gudang_kecil_satuan = Penggunaan_Gudang_Kecil::where('kode_material', $kode_material[0][$i])->where('status', 1)->where('project', $project[0][$i])->get();
            if($penggunaan_gudang_kecil_satuan->count() > 0){
                $penggunaan_gudang_kecil_satuan = $penggunaan_gudang_kecil_satuan->first();
                $penggunaan_gudang_kecil_satuan->jumlah_yang_dipinjam = $penggunaan_gudang_kecil_satuan->jumlah_yang_dipinjam + $jumlah_yang_dipinjam[0][$i];
                $penggunaan_gudang_kecil_satuan->save();
            }
            else{
                $penggunaan_gudang_kecil_satuan = new Penggunaan_Gudang_Kecil;
                $penggunaan_gudang_kecil_satuan->nama_material = $nama_material[0][$i];
                $penggunaan_gudang_kecil_satuan->status = 1;
                $penggunaan_gudang_kecil_satuan->spesifikasi = $spesifikasi[0][$i];
                $penggunaan_gudang_kecil_satuan->jumlah_yang_dipinjam = $jumlah_yang_dipinjam[0][$i];
                $penggunaan_gudang_kecil_satuan->kode_material = $kode_material[0][$i];
                $penggunaan_gudang_kecil_satuan->satuan = $satuan[0][$i];
                $penggunaan_gudang_kecil_satuan->project = $project[0][$i];
                $penggunaan_gudang_kecil_satuan->save();
            }
        }

        // ----------------------------

        $notifikasi = new Notifikasi;
        $notifikasi->user_input = Auth::user()->username;
        $notifikasi->kegiatan =  "menyetujui penggunaan  material " . $penggunaan_gudang_kecil->nama_material . " dari gudang kecil ke staff pekerja";
        $notifikasi->save();

        // ----------------------------

        $penggunaan_gudang_kecil->delete();

        // ----------------------------
 
        return redirect()->route('staff.list-penggunaan-material-gudang-kecil', ['kode' => 0])->with('success', 'Penggunaan Material berhasil disetujui');

    }

    // ------------------------------------------------

    public function reject_penggunaan_material_gudang_kecil(Request $request)
    {
        $id = $request->input('id');
        $penggunaan_material = Penggunaan_Gudang_Kecil::find($id);

        // ----------------------------

        $penggunaan_material->status = 2;
        $penggunaan_material->save();

        // ----------------------------

        $notifikasi = new Notifikasi;
        $notifikasi->user_input = Auth::user()->username;
        $notifikasi->kegiatan = "menolak penggunaan  material " . $penggunaan_material->nama_material . " dari gudang kecil ke staff pekerja";
        $notifikasi->save();

        return redirect()->route('staff.list-penggunaan-material-gudang-kecil', ['kode' => 0])->with('success', 'Penggunaan Material berhasil ditolak');
    }

    // ------------------------------------------------

    public function export_db($_kode)
    {
        $nama_tabel = null;
        if($_kode == 0)
            $nama_tabel = 'Material Datang';
        else if($_kode == 1)
            $nama_tabel = 'Material Sampai';
        else if($_kode == 2)
            $nama_tabel = 'Material Inventory Gudang Besar';
        else if($_kode == 3)
            $nama_tabel = 'Material Gudang Kecil';
        else if($_kode == 4)
        $nama_tabel = 'Material Penggunaan oleh Pekerja';
        

        return Excel::download(new DB_Export($_kode), 'Tabel '.$nama_tabel.'.xlsx');
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
