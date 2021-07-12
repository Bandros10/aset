<?php

namespace App\Http\Controllers;

use App\Models\pengadaan;
use Illuminate\Http\Request;

class PengadaanController extends Controller
{
    public function index(){
        $pengadaan_data = pengadaan::all();
        return view('pengadaan.index',compact('pengadaan_data'));
    }

    public function store(Request $request){
        try {
            pengadaan::create($request->all());
            return redirect()->back()->with('sukses','berhasil menambhakan pengadaan barang baru');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','ooppss..! terjadi kesalahan silahkan hubungi bagian IT');
        }

    }
}
