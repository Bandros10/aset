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

    public function konfirmasi(Request $request, $id){
        try {
            $kode = ucwords(\substr($request->kategori,0,1));
            $date = Carbon::now()->format('my');
            $id = $kode.$date.'-'.Str::upper($request->tipe);
            DB::table('asets')->insert(['id_perangkat' => $id,
            'nama_perangkat' => $request->nama_perangkat,
            'kategori' => $request->kategori,
            'tipe' => $request->tipe,
            'merek' => $request->merek,
            'harga' => $request->harga,
            'tgl_pembelian' => $request->tgl_pembelian,
            'keterangan' => $request->keterangan]);
            DB::table('pengadaans')->where('id',$id)->update(['confirmed' => true]);
            // $pengadaan_delete = pengadaan::Find($id);
            // $pengadaan_delete->delete();
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
