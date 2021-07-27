<?php

namespace App\Http\Controllers;

use App\Models\peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItController extends Controller
{
    //
    public function index(){
        $peminjam = peminjaman::all();
        return view('IT.peminjaman',\compact('peminjam'));
    }

    public function search(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $id_perangkat = DB::table('asets')->where('id_perangkat','LIKE','%'.$cari."%")->get();

            return response()->json($id_perangkat);
        }
        $id_perangkat= DB::table('asets')->select('id_perangkat','nama_perangkat')->get();

        return response()->json($id_perangkat);
    }

    public function pengajuan(Request $request){
        peminjaman::create($request->all());
        return redirect()->back()->with('sukses','pengajuan peminjama barang'.$request->id_perangkat.'berhasil');
    }

}
