<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\pengadaan;
use App\Models\peminjaman;
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
            return redirect(route('pengadaan.index'))->with('sukses','pengadaan barang telah di aprov');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th);
        }
    }

    public function konfirmasi_peminjaman($id){
        peminjaman::where('id',$id)->update(['status' => true]);
        return redirect()->back()->with('sukses','pengajuan peminjaman barang terah di konfirmasi');
    }

    public function tolak(Request $req,$id){
        $tolak = pengadaan::findOrFail($id);
        $tolak->update([
            'keterangan_sumber_daya' => $req->keterangan_sumber_daya,
        ]);
        return redirect(route('pengadaan.index'))->with('error','pengadaan barang telah di tolak');
    }
}
