<?php

namespace App\Http\Controllers;

use App\Models\pengadaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SumberdayaController extends Controller
{
    public function index($id){
        $konfirm = pengadaan::find($id);
        return view('Kepala_sumber_daya.konfirmasi',compact('konfirm'));
    }

    public function konfirmasi($id){
        try {
            DB::table('pengadaans')->where('id',$id)->update(['confirmed' => true]);
            return redirect()->back()->with('sukses','pengadaan barang sudah di konfirmasi');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th);
        }
    }
}
