<?php

namespace App\Http\Controllers;

use App\Models\perbaikan;
use App\Models\peminjaman;
use App\Models\pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItController extends Controller
{
    //
    public function index(){
        $peminjam = peminjaman::all();
        return view('IT.peminjaman',\compact('peminjam'));
    }

    public function pengembalian_index(){
        $pengembalian = pengembalian::all();
        return view ('IT.pengembalian',\compact('pengembalian'));
    }

    public function pengembalian_aset(Request $req,$id){
        DB::table('pengembalians')->where('id_perangkat','=',$id)->update(['kelengkapan' => $req->Kelengkapan]);
        DB::table('asets')->where('id_perangkat',$id)->update(['kondisi' => 'buruk'],['status' => false]);
        DB::table('peminjamen')->where('id_perangkat',$id)->delete();
        return redirect()->back()->with('sukses','data berhasil di hapus');
    }

    public function perbaikan(){
        $perbaikan = perbaikan::all();
        return \view('IT.perbaikan',\compact('perbaikan'));
    }

    public function search(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $id_perangkat = DB::table('asets')->where('id_perangkat','LIKE','%'.$cari."%")->get();

            return response()->json($id_perangkat);
        }
        $id_perangkat= DB::table('asets')->where('status','=',false)->where([['kondisi','=',array('baik')]])->select('id_perangkat','nama_perangkat')->get();

        return response()->json($id_perangkat);
    }

    public function search_perbaikan(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $id_perangkat = DB::table('asets')->where('id_perangkat','LIKE','%'.$cari."%")->get();

            return response()->json($id_perangkat);
        }
        $id_perangkat= DB::table('asets')->where([['kondisi','=',array('buruk')]])->select('id_perangkat','nama_perangkat')->get();

        return response()->json($id_perangkat);
    }

    public function pengajuan(Request $request){
        peminjaman::create($request->all());
        $pengembalian = new pengembalian;
        $pengembalian->id_perangkat = $request->id_perangkat;
        $pengembalian->nama_peminjam = $request->nama_peminjam;
        $pengembalian->jabatan_peminjam = $request->jabatan_peminjam;
        $pengembalian->devisi_peminjam = $request->devisi_peminjam;
        $pengembalian->keperluan = $request->keperluan;
        $pengembalian->save();
        DB::table('asets')->where('id_perangkat',$request->id_perangkat)->update(['status' => true]);
        return redirect()->back()->with('sukses','pengajuan peminjama barang'.$request->id_perangkat.'berhasil');
    }

    public function perbaikan_input(Request $request){
        perbaikan::create($request->all());
        return redirect()->back()->with('sukses','pengajuan erbaikan');
    }
}
