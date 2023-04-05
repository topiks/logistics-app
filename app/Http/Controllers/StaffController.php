<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\Material_Datang;
use App\Models\Material_Sampai;
use App\Models\Notifikasi;

use App\Mail\MyMail;

class StaffController extends Controller
{
    public function list_kedatangan_material()
    {
        $material_datang = Material_Datang::all();
        
        $nama_material = array();
        $jumlah_material = array();
        $kode_material = array();

        foreach($material_datang as $md)
        {        
            $nama_material[] = explode(',', $md->nama_material);
            $jumlah_material[] = explode(',', $md->jumlah);
            $kode_material[] = explode(',', $md->kode_material);
        }


        $i = 0;
        foreach($material_datang as $md)
        {
            $md->nama_material = $nama_material[$i];
            $md->jumlah = $jumlah_material[$i];
            $md->kode_material = $kode_material[$i];
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

        foreach($material_sampai as $ms)
        {        
            $nama_material[] = explode(',', $ms->nama_material);
            $jumlah_material[] = explode(',', $ms->jumlah);
            $kode_material[] = explode(',', $ms->kode_material);
        }


        $i = 0;
        foreach($material_sampai as $ms)
        {
            $ms->nama_material = $nama_material[$i];
            $ms->jumlah = $jumlah_material[$i];
            $ms->kode_material = $kode_material[$i];
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
        $material_sampai->nama_material = $material_datang->nama_material;
        $material_sampai->nomor_po = $material_datang->nomor_po;
        $material_sampai->nomor_order = $material_datang->nomor_order;
        $material_sampai->nomor_pr = $material_datang->nomor_pr;
        $material_sampai->jumlah = $material_datang->jumlah;
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

}
