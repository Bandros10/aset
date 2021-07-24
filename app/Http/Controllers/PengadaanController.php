<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\pengadaan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PengadaanController extends Controller
{
    public function index(){
        $pengadaan_data = pengadaan::all();
        return view('pengadaan.index',compact('pengadaan_data'));
    }

    public function store(Request $request){
        $kode = ucwords(\substr($request->jenis_barang,0,1));
        $date = Carbon::now()->format('my');
        $k_perangkat = $kode.$date.'-'.Str::upper($request->model_barang);
        try {
            $pengadaan = new pengadaan;
            $pengadaan->kode_perangkat = $k_perangkat;
            $pengadaan->nama_barang = $request->nama_barang;
            $pengadaan->jenis_barang = $request->jenis_barang;
            $pengadaan->merk_barang = $request->merk_barang;
            $pengadaan->model_barang = $request->model_barang;
            $pengadaan->harga_barang = $request->harga_barang;
            $pengadaan->tanggal_pengadaan = $request->tanggal_pengadaan;
            $pengadaan->jumlah_pengadaan = $request->jumlah_pengadaan;
            $pengadaan->keterangan = $request->keterangan;
            $pengadaan->save();
            return redirect()->back()->with('sukses','berhasil menambhakan pengadaan barang baru');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','ooppss..! terjadi kesalahan silahkan hubungi bagian IT');
        }

    }
}
