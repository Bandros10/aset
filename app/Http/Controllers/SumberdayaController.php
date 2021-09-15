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
            return redirect(route('pengadaan.index'))->with('Sukses','Pengadaan perangkat telah diapprov');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th);
        }
    }

    public function konfirmasi_peminjaman($id){
        $data_pinjam = peminjaman::where('id',$id)->first();
        return view('IT.peminjaman_confirm',\compact('data_pinjam'));
    }

    public function konfirmasi_barang($id){
        peminjaman::where('id',$id)->update(['status' => true]);
        return redirect(route('it.peminjaman'))->with('Sukses','Pengajuan peminjaman perangkat telah dikonfirmasi');
    }

    public function tolak(Request $req,$id){
        $tolak = pengadaan::findOrFail($id);
        $tolak->update([
            'keterangan_sumber_daya' => $req->keterangan_sumber_daya,
        ]);
        return redirect(route('pengadaan.index'))->with('Error','Pengadaan perangkat telah ditolak');
    }
}
