<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\aset;
use App\Models\perbaikan;
use App\Models\peminjaman;
use App\Models\pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;

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
        pengembalian::find($id)->update(['kelengkapan'=>$request->kelengkapan, 'tgl_pengembalian' => Carbon::now()->format('Y/m/d')]);
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

    public function autofill(Request $request){
        $kode_perangkat = $_GET['kode_perangkat'];
        $check = DB::table('asets')->where('kode_perangkat',$kode_perangkat)->select('asets.*')->first();
        return response()->json($check);
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
        $peminjaman = new peminjaman;
        $peminjaman->kode_perangkat = $request->kode_perangkat;
        $peminjaman->nama_peminjam = $request->nama_peminjam;
        $peminjaman->jabatan_peminjam = $request->jabatan_peminjam;
        $peminjaman->devisi_peminjam = $request->devisi_peminjam;
        $peminjaman->keperluan = $request->keperluan;
        $peminjaman->kelengkapan = $request->kelengkapan;
        $peminjaman->tgl_peminjaman = Carbon::now()->format('Y/m/d');
        $peminjaman->save();

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

    public function peminjaman_cetak($id){
        $cetak_pinjam = peminjaman::find($id);
        $barang_pinjam = aset::where('kode_perangkat','=',$cetak_pinjam->kode_perangkat)->first();
        $tanggal_sekarang = Carbon::now()->translatedFormat('d F Y');

        $templateProcessor = new TemplateProcessor('template/cetak_pinjam.docx');
        $templateProcessor->setValue('tanggal_sekarang', $tanggal_sekarang);
        $templateProcessor->setValue('nama_pemberi', auth()->user()->name);
        $templateProcessor->setValue('jabatan_pemberi', auth()->user()->jabatan);
        $templateProcessor->setValue('divisi_pemberi', auth()->user()->divisi);
        $templateProcessor->setValue('nama_peminjam', $cetak_pinjam->nama_peminjam);
        $templateProcessor->setValue('jabatan_peminjam', $cetak_pinjam->jabatan_peminjam);
        $templateProcessor->setValue('divisi_peminjam',  $cetak_pinjam->divisi_peminjam);
        $templateProcessor->setValue('jenis',  $barang_pinjam->model);
        $templateProcessor->setValue('merek',  $barang_pinjam->merek);
        $templateProcessor->setValue('tipe',  $barang_pinjam->tipe);
        $templateProcessor->setValue('nomer_seri_produk',  $barang_pinjam->nomer_seri_produk);
        $templateProcessor->setValue('nama_perangkat',  $barang_pinjam->nama_perangkat);
        $templateProcessor->setValue('kelengkapan',  $cetak_pinjam->kelengkapan);
        $templateProcessor->setValue('keperluan',  $cetak_pinjam->keperluan);

        $fileName = "peminjaman ".(strtoupper($barang_pinjam->nama_perangkat).".". $cetak_pinjam->nama_peminjam.".". $tanggal_sekarang);
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
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
        $data_aset_tahun_laptop = aset::select(\DB::raw("COUNT(*) as count,kategori"),DB::raw("year(tgl_pembelian) as year"),)
                    ->where('kategori','=','laptop')
                    ->groupBy(\DB::raw("year(tgl_pembelian)"))
                    ->pluck('count');
        // dd($data_aset_tahun_laptop);

        $data_aset_tahun_PC = aset::select(\DB::raw("COUNT(*) as count,kategori"),DB::raw("year(tgl_pembelian) as year"),)
                    ->where('kategori','=','PC')
                    ->groupBy(\DB::raw("year(tgl_pembelian)"))
                    ->pluck('count');
        $data_aset_tahun_monitor = aset::select(\DB::raw("COUNT(*) as count,kategori"),DB::raw("year(tgl_pembelian) as year"),)
                    ->where('kategori','=','monitor')
                    ->groupBy(\DB::raw("year(tgl_pembelian)"))
                    ->pluck('count');
        $data_aset_tahun_printer = aset::select(\DB::raw("COUNT(*) as count,kategori"),DB::raw("year(tgl_pembelian) as year"),)
                    ->where('kategori','=','printer')
                    ->groupBy(\DB::raw("year(tgl_pembelian)"))
                    ->pluck('count');
        $data_aset_tahun_scanner = aset::select(\DB::raw("COUNT(*) as count,kategori"),DB::raw("year(tgl_pembelian) as year"),)
                    ->where('kategori','=','laptscannerop')
                    ->groupBy(\DB::raw("year(tgl_pembelian)"))
                    ->pluck('count');


        $data_laptop = aset::where('kategori','=','laptop')->get()->count();
        $data_pc = aset::where('kategori','=','PC')->get()->count();
        $data_monitor = aset::where('kategori','=','monitor')->get()->count();
        $data_printer = aset::where('kategori','=','printer')->get()->count();
        $data_scanner = aset::where('kategori','=','scanner')->get()->count();
        $data_peminjaman = peminjaman::all()->count();
        $raw_peminjaman = peminjaman::where('status','=',false)->count();
        $data_pengembalian = pengembalian::all()->count();
        $raw_perbaikan = perbaikan::where('status','=',false)->count();
        $data_perbaikan = perbaikan::all()->count();

        return \view('IT.monitoring',compact('data_laptop','data_aset_tahun_scanner','data_aset_tahun_printer','data_aset_tahun_monitor','data_aset_tahun_laptop','data_aset_tahun_PC','data_pc','data_monitor','data_printer','data_scanner','data_peminjaman','data_pengembalian','data_perbaikan','raw_peminjaman','raw_perbaikan'));
    }
}
