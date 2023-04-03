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
use App\Mail\MyMail;

class StaffController extends Controller
{
    public function form_kedatangan_material()
    {
        return view('staff.kedatangan_material');
    }

    public function form_kedatangan_material_process(Request $request)
    {
        $nama_material = $request->input('nama-material');
        $nomor_po = $request->input('no-po');
        $nomor_order = $request->input('no-order');
        $nomor_pr = $request->input('no-pr');
        $jumlah = $request->input('jumlah');
        $kode_material = $request->input('kode-material');
        $nomor_spbb_nota = $request->input('no-spbb-nota');
        $pemasok = $request->input('pemasok');
        $eda = $request->input('eda');

        

    }

}
