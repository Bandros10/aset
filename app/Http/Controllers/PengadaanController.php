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

        $id = $nm.\substr($request->nomer_seri_produk,0,5);
        try {
            $pengadaan = new pengadaan;
            $pengadaan->kode_perangkat = $id;
            $pengadaan->nama_barang = $request->nama_barang;
            $pengadaan->jenis_barang = $request->jenis_barang;
            $pengadaan->merk_barang = $request->merk_barang;
            $pengadaan->model_barang = $request->model_barang;
            $pengadaan->harga_barang = $request->harga_barang;
            $pengadaan->tanggal_pengadaan = $request->tanggal_pengadaan;
            $pengadaan->nomer_seri_produk = $request->nomer_seri_produk;
            $pengadaan->keterangan = $request->keterangan;
            $pengadaan->save();
            return redirect()->back()->with('Sukses','Berhasil menambahkan pengadaan aset baru');
        } catch (\Throwable $th) {
            return redirect()->back()->with('Error','Ooppss..! terjadi kesalahan silahkan hubungi bagian IT');
        }
    }

    public function edit($id){
        $peng_edit = pengadaan::findOrFail($id);
        return \view('pengadaan.edit',\compact('peng_edit'));
    }

    public function update(Request $request,$id){
        $peng_update = pengadaan::findOrFail($id);
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
        $id = $nm.\substr($request->nomer_seri_produk,0,5);

        $peng_update->update(['kode_perangkat' => $id,'nama_barang' => $request->nama_barang,'jenis_barang' => $request->jenis_barang,'keterangan' => $request->keterangan,
                                'merk_barang' => $request->merk_barang,'model_barang' => $request->model_barang,'nomer_seri_produk' => $request->nomer_seri_produk,
                                'harga_barang' => $request->harga_barang,'tanggal_pengadaan' => $request->tanggal_pengadaan]);
        return redirect(\route('pengadaan.index'))->with('sukses','data pengadaan berhasil di rubah');
    }
}
