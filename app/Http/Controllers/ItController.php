<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\aset;
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

    public function pengembalian_aset($id){
        $data_pengembalian = pengembalian::find($id);
        return \view('IT.pengembalian_barang',compact('data_pengembalian'));
    }

    public function pengembalian_submit(Request $request,$id){
        pengembalian::find($id)->update(['kelengkapan'=>$request->kelengkapan]);
        aset::where('kode_perangkat','=',$request->kode_perangkat)->update(['kondisi' => 'buruk','status' => false]);
        // DB::table('asets')->where('kode_perangkat',$request->kode_perangkat)->update(['kondisi' => 'buruk','status' => false]);
        return redirect('IT/pengembalian')->with('sukses','barang telah di kembalikan');
    }

    public function pengembalian_delete($id){
        pengembalian::find($id)->delete();
        return redirect()->back()->with('sukses','permintaan perbaikan berhasil di konfirmasi');
    }

    public function perbaikan(){
        $perbaikan = perbaikan::all();
        return \view('IT.perbaikan',\compact('perbaikan'));
    }

    public function search(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $kode_perangkat = DB::table('asets')->where('kode_perangkat','LIKE','%'.$cari."%")->get();

            return response()->json($kode_perangkat);
        }
        $kode_perangkat= DB::table('asets')->where('status','=',false)->where([['kondisi','=',array('baik')]])->select('kode_perangkat','nama_perangkat')->get();

        return response()->json($kode_perangkat);
    }

    public function search_perbaikan(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $kode_perangkat = DB::table('asets')->where('kode_perangkat','LIKE','%'.$cari."%")->get();

            return response()->json($kode_perangkat);
        }
        $kode_perangkat= DB::table('asets')->where([['kondisi','=',array('buruk')]])->select('kode_perangkat','nama_perangkat')->get();

        return response()->json($kode_perangkat);
    }

    public function pengajuan(Request $request){
        peminjaman::create($request->all());
        $pengembalian = new pengembalian;
        $pengembalian->kode_perangkat = $request->kode_perangkat;
        $pengembalian->nama_peminjam = $request->nama_peminjam;
        $pengembalian->jabatan_peminjam = $request->jabatan_peminjam;
        $pengembalian->devisi_peminjam = $request->devisi_peminjam;
        $pengembalian->keperluan = $request->keperluan;
        $pengembalian->save();
        DB::table('asets')->where('kode_perangkat',$request->kode_perangkat)->update(['status' => true]);
        return redirect()->back()->with('sukses','pengajuan peminjama barang'.$request->kode_perangkat.'berhasil');
    }

    public function peminjaman_delete($id){
        peminjaman::find($id)->delete();
        return redirect()->back()->with('sukses','data peminjaman telah di hapus');
    }

    public function perbaikan_input(Request $request){
        perbaikan::create($request->all());
        return redirect()->back()->with('sukses','pengajuan erbaikan');
    }

    public function perbaikan_konfirmasi($id){
        perbaikan::where('kode_perangkat',$id)->update(['status'=>true]);
        aset::where('kode_perangkat',$id)->update(['kondisi'=>'baik','status'=>false]);
        return redirect()->back()->with('sukses','permintaan perbaikan berhasil di konfirmasi');
    }

    public function perbaikan_delete($id){
        perbaikan::find($id)->delete();
        return redirect()->back()->with('sukses','data perbaikan berhasil di hapus');
    }

    public function monitoring(){
        $data = aset::all();
        return \view('IT.monitoring',compact('data'));
    }
}
