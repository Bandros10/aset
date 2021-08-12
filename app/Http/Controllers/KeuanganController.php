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
            // if ($request->kategori == 'laptop') {
            //     $nm = 'L-';
            // } elseif ($request->kategori == 'PC') {
            //     $nm = 'P-';
            // } elseif ($request->kategori == 'monitor'){
            //     $nm = 'M-';
            // } elseif ($request->kategori == 'printer'){
            //     $nm = 'PR-';
            // } elseif ($request->kategori == 'scanner'){
            //     $nm = 'SC-';
            // }

            // $id = IdGenerator::generate(['table' => 'asets','field'=>'id_perangkat', 'length' => 7, 'prefix' =>$nm]);
            // DB::table('asets')->insert(['id_perangkat' => $id,
            // 'nama_perangkat' => $request->nama_perangkat,
            // 'kategori' => $request->kategori,
            // 'tipe' => $request->tipe,
            // 'merek' => $request->merek,
            // 'harga' => $request->harga,
            // 'tgl_pembelian' => $request->tgl_pembelian,
            // 'keterangan' => $request->keterangan]);
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
