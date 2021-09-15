<?php

namespace App\Http\Controllers;

use File;
use Carbon\Carbon;
use App\Models\aset;
use App\Models\perbaikan;
use App\Models\peminjaman;
use Illuminate\Support\Str;
use App\Models\pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
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
        return redirect('IT/pengembalian')->with('Sukses','Perangkat telah dikembalikan');
    }

    public function pengembalian_delete($id){
        pengembalian::find($id)->delete();
        return redirect()->back()->with('Sukses','Permintaan perbaikan berhasil dikonfirmasi');
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
        $kode_perangkat= DB::table('asets')->where('status','=',false)->where([['kondisi','=',array('baik')]])->select('kode_perangkat','tipe','merek')->get();

        return response()->json($kode_perangkat);
    }

    public function data_pegawai(Request $request)
    {
        $data_pegawai = DB::connection('mysql2')->table('pegawais')->select('nik','nama_depan','nama_belakang')->get();
        return response()->json($data_pegawai);
    }


    public function autofill(Request $request){
        $kode_perangkat = $_GET['kode_perangkat'];
        $check = DB::table('asets')->where('kode_perangkat',$kode_perangkat)->select('asets.*')->first();
        return response()->json($check);
    }

    public function autofillpegawai(Request $request){
        $nik_pegawai = $_GET['nik'];
        $check = DB::connection('mysql2')->table('pegawais')->where('nik',$nik_pegawai)->select('pegawais.*')->first();
        return response()->json($check);
    }

    public function search_perbaikan(Request $request)
    {
        if ($request->has('q')) {
            $cari = $request->q;
            $kode_perangkat = DB::table('asets')->where('kode_perangkat','LIKE','%'.$cari."%")->get();

            return response()->json($kode_perangkat);
        }
        $kode_perangkat= DB::table('asets')->where([['kondisi','=',array('buruk')]])->select('kode_perangkat','tipe','merek')->get();

        return response()->json($kode_perangkat);
    }

    public function pengajuan(Request $request){
        $get_nama= DB::connection('mysql2')->table('pegawais')->where('nik',$request->nik)->select('pegawais.*')->first();
        $nama_pegawai = $get_nama->nama_depan.' '.$get_nama->nama_belakang;
        $peminjaman = new peminjaman;
        $peminjaman->kode_perangkat = $request->kode_perangkat;
        $peminjaman->nama_peminjam = $nama_pegawai;
        $peminjaman->jabatan_peminjam = $request->jabatan_peminjam;
        $peminjaman->devisi_peminjam = $request->devisi_peminjam;
        $peminjaman->keperluan = $request->keperluan;
        $peminjaman->kelengkapan = $request->kelengkapan;
        $peminjaman->tgl_peminjaman = Carbon::now()->format('Y/m/d');
        $peminjaman->save();

        $pengembalian = new pengembalian;
        $pengembalian->kode_perangkat = $request->kode_perangkat;
        $pengembalian->nama_peminjam = $nama_pegawai;
        $pengembalian->jabatan_peminjam = $request->jabatan_peminjam;
        $pengembalian->devisi_peminjam = $request->devisi_peminjam;
        $pengembalian->keperluan = $request->keperluan;
        $pengembalian->save();
        DB::table('asets')->where('kode_perangkat',$request->kode_perangkat)->update(['status' => true]);
        return redirect()->back()->with('Sukses','Pengajuan peminjaman perangkat'.$request->kode_perangkat.'Berhasil');
    }

    public function peminjaman_delete($id){
        peminjaman::find($id)->delete();
        return redirect()->back()->with('Sukses','Data peminjaman telah dihapus');
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
        $templateProcessor->setValue('divisi_peminjam',  $cetak_pinjam->devisi_peminjam);
        $templateProcessor->setValue('jenis',  $barang_pinjam->model);
        $templateProcessor->setValue('merek',  $barang_pinjam->merek);
        $templateProcessor->setValue('tipe',  $barang_pinjam->tipe);
        $templateProcessor->setValue('nomer_seri_produk',  $barang_pinjam->nomer_seri_produk);
        $templateProcessor->setValue('nama_perangkat',  $barang_pinjam->merek.' '.$barang_pinjam->tipe);
        $templateProcessor->setValue('kelengkapan',  $cetak_pinjam->kelengkapan);
        $templateProcessor->setValue('keperluan',  $cetak_pinjam->keperluan);

        $fileName = "Peminjaman ".(strtoupper($barang_pinjam->nama_perangkat)."_". $cetak_pinjam->nama_peminjam."_". $tanggal_sekarang);
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }

    public function pengembalian_cetak($id){
        $cetak_pengembalian = pengembalian::find($id);
        $barang_kembali = aset::where('kode_perangkat','=',$cetak_pengembalian->kode_perangkat)->first();
        $tanggal_sekarang = Carbon::now()->translatedFormat('d F Y');

        $templateProcessor = new TemplateProcessor('template/cetak_kembali.docx');
        $templateProcessor->setValue('tanggal_sekarang', $tanggal_sekarang);
        $templateProcessor->setValue('nama_pemberi', auth()->user()->name);
        $templateProcessor->setValue('jabatan_pemberi', auth()->user()->jabatan);
        $templateProcessor->setValue('divisi_pemberi', auth()->user()->divisi);
        $templateProcessor->setValue('nama_peminjam', $cetak_pengembalian->nama_peminjam);
        $templateProcessor->setValue('jabatan_peminjam', $cetak_pengembalian->jabatan_peminjam);
        $templateProcessor->setValue('divisi_peminjam',  $cetak_pengembalian->devisi_peminjam);
        $templateProcessor->setValue('jenis',  $barang_kembali->model);
        $templateProcessor->setValue('merek',  $barang_kembali->merek);
        $templateProcessor->setValue('tipe',  $barang_kembali->tipe);
        $templateProcessor->setValue('nomer_seri_produk',  $barang_kembali->nomer_seri_produk);
        $templateProcessor->setValue('nama_perangkat', $barang_kembali->merek.' '.$barang_kembali->tipe);
        $templateProcessor->setValue('kelengkapan',  $cetak_pengembalian->kelengkapan);
        $templateProcessor->setValue('keperluan',  $cetak_pengembalian->keperluan);

<<<<<<< Updated upstream
        $fileName = "Pengembalian ".(strtoupper($barang_kembali->nama_perangkat)."_". $cetak_pengembalian->nama_peminjam."_". $tanggal_sekarang);
=======
        $fileName = "pengembalian ".(strtoupper($barang_kembali->merek.' '.$barang_kembali->tipe).".". $cetak_pengembalian->nama_peminjam.".". $tanggal_sekarang);
>>>>>>> Stashed changes
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }

    private function saveFile($name, $photo)
    {
        //set nama file adalah gabungan antara nama produk dan time(). Ekstensi gambar tetap dipertahankan
        $images = Str::slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        //set path untuk menyimpan gambar
        $path = public_path('uploads/product');

        //cek jika uploads/product bukan direktori / folder
        if (!File::isDirectory($path)) {
            //maka folder tersebut dibuat
            File::makeDirectory($path, 0777, true, true);
        }
        //simpan gambar yang diuplaod ke folrder uploads/produk
        Image::make($photo)->save($path . '/' . $images);
        //mengembalikan nama file yang ditampung divariable $images
        return $images;
    }

    public function perbaikan_input(Request $request){
        $photo = null;
        //jika terdapat file (Foto / Gambar) yang dikirim
        if ($request->hasFile('photo')) {
            //maka menjalankan method saveFile()
            $photo = $this->saveFile($request->kode_perangkat, $request->file('photo'));
        }
        perbaikan::firstOrCreate(
                            ['kode_perangkat' => $request->kode_perangkat,
                            'keterangan_perbaikan' => $request->keterangan_perbaikan,
                            'photo' => $photo]);
        return redirect()->back()->with('Sukses','Pengajuan perbaikan');
    }

    public function perbaikan_konfirmasi($id){
        perbaikan::where('kode_perangkat',$id)->update(['status'=>true]);
        aset::where('kode_perangkat',$id)->update(['kondisi'=>'baik','status'=>false]);
        return redirect()->back()->with('Sukses','Permintaan perbaikan berhasil dikonfirmasi');
    }

    public function perbaikan_delete($id){
        perbaikan::find($id)->delete();
        return redirect()->back()->with('Sukses','Data perbaikan berhasil dihapus');
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
