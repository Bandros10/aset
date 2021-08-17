<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\pengadaan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class SumberdayaController extends Controller
{
    public function index($id){
        $konfirm = pengadaan::find($id);
        return view('Kepala_sumber_daya.konfirmasi',compact('konfirm'));
    }

    public function konfirmasi($id){
        try {
            DB::table('pengadaans')->where('kode_perangkat',$id)->update(['confirmed_kepala_sumber_daya' => true]);

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


            return redirect(route('pengadaan.index'))->with('sukses','pengadaan barang telah di aprov');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th);
        }
    }

    public function tolak(Request $req,$id){
        $tolak = pengadaan::findOrFail($id);
        $tolak->update([
            'keterangan_sumber_daya' => $req->keterangan_sumber_daya,
        ]);
        return redirect(route('pengadaan.index'))->with('error','pengadaan barang telah di tolak');
    }
}
