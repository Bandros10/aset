<?php

namespace App\Http\Controllers;

use App\Models\pengadaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function index($id){
        $konfirm = pengadaan::find($id);
        return view('Keuangan.konfirmasi',compact('konfirm'));
    }

    public function konfirmasi($id){
        try {
            $c = pengadaan::findOrFail($id);
            $c->update([
                'confirmed_keuangan' => true,
            ]);
            // DB::table('pengadaans')->where('id',$id)->update(['confirmed_keuangan' => true]);
            return redirect(route('pengadaan.index'))->with('sukses','pengadaan barang telah di approv');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th);
        }
    }

    public function tolak(Request $req,$id){
        $tolak = pengadaan::findOrFail($id);
        // dd($tolak);
        $tolak->update([
            'keterangan_keuangan' => $req->keterangan_keuangan,
        ]);
        return redirect(route('pengadaan.index'))->with('error','pengadaan barang telah di tolak');
    }
}
