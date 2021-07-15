<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\aset;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AsetController extends Controller
{
    public function index(){
        return \view('aset.index');
    }

    public function create(){
        return \view('aset.create');
    }

    public function store(Request $request){
        $kode = ucwords(\substr($request->kategori,0,1));
        $date = Carbon::now()->format('my');
        $id = $kode.$date.Str::upper($request->tipe);
        $photo = Image::make($request->photo)->fit(400)->encode('data-url');
        // dd($photo);
        $aset = new aset;
        $aset->id_perangkat = $id;
        $aset->nama_perangkat = $request->nama_perangkat;
        $aset->kategori = $request->kategori;
        $aset->tipe = $request->tipe;
        $aset->merek = $request->merek;
        $aset->model = $request->model;
        $aset->kondisi = $request->kondisi;
        $aset->harga = $request->harga;
        $aset->jumlah = $request->jumlah;
        $aset->tgl_pembelian = $request->tgl_pembelian;
        $aset->keterangan = $request->keterangan;
        $aset->kelengkapan = $request->kelengkapan;
        $aset->photo = $photo;
        $aset->save();
        return \view('aset.index');

    }
}
