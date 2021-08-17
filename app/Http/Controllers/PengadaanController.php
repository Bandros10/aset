<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\pengadaan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PengadaanController extends Controller
{
    public function index(){
        $data_pengadaan = pengadaan::all();
        return view('pengadaan.index',compact('data_pengadaan'));
    }

    public function store(Request $request){
        if ($request->jenis_barang == 'laptop') {
            $nm = 'P.L-';
        } elseif ($request->jenis_barang == 'PC') {
            $nm = 'P.P-';
        } elseif ($request->jenis_barang == 'monitor'){
            $nm = 'P.M-';
        } elseif ($request->jenis_barang == 'printer'){
            $nm = 'P.PR-';
        } elseif ($request->jenis_barang == 'scanner'){
            $nm = 'P.SC-';
        }

        $id = IdGenerator::generate(['table' => 'pengadaans','field'=>'kode_perangkat', 'length' => 7, 'prefix' =>$nm]);
        try {
            $pengadaan = new pengadaan;
            $pengadaan->kode_perangkat = $id;
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
