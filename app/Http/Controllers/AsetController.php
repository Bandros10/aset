<?php

namespace App\Http\Controllers;

use File;
use Carbon\Carbon;
use App\Models\aset;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;

class AsetController extends Controller
{
    public function index(){
        // $all_aset = aset::all();
        $laptop = aset::where('kategori','=','laptop')->get();
        $PC = aset::where('kategori','=','PC')->get();
        $monitor = aset::where('kategori','=','monitor')->get();
        $printer = aset::where('kategori','=','printer')->get();
        $scanner = aset::where('kategori','=','scanner')->get();
        return \view('aset.index', compact('PC','laptop','monitor','printer','scanner'));
    }

    public function create(){
        return \view('aset.create');
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

    public function store(Request $request){
        $this->validate($request,[
            'photo' => 'mimes:png,jpg,'
        ]);
        $kode = ucwords(\substr($request->kategori,0,1));
        $date = Carbon::now()->format('my');
        $id_p = $kode.$date.'-'.Str::upper($request->tipe);

        $photo = null;
        //jika terdapat file (Foto / Gambar) yang dikirim
        if ($request->hasFile('photo')) {
            //maka menjalankan method saveFile()
            $photo = $this->saveFile($request->nama_perangkat, $request->file('photo'));
        }

        // dd($id);
        try {
            aset::firstOrCreate(
                ['id_perangkat' => $id_p,
                'nama_perangkat' => $request->nama_perangkat,
                'kategori' => $request->kategori,
                'tipe' => $request->tipe,
                'merek' => $request->merek,
                'model' => $request->model,
                'kondisi' => $request->kondisi,
                'harga' => $request->harga,
                'jumlah' => $request->jumlah,
                'tgl_pembelian' => $request->tgl_pembelian,
                'keterangan' => $request->keterangan,
                'kelengkapan' => $request->kelengkapan,
                'photo' => $photo]
            );
            return redirect('/aset')->with('sukses','data aset berhasil di tambahkan');
        } catch (\Throwable $th) {
            return redirect('/aset')->with('error','data aset sudah tersedia');
        }
    }

    public function destroy($id)
    {
        $delete = DB::table('asets')->where('id', '=', $id);
        // $delete = aset::where([['id_perangkat','=',$id],['tgl_pembelian','=',$req->tgl_pembelian],['created_at','=',$req->created_at]])->first();
        // dd($delete);

        if (!empty($delete->photo)) {
            //file akan dihapus dari folder uploads/produk
            File::delete(public_path('uploads/product/' . $delete->photo));
        }
        $delete->delete();
        return redirect()->back()->with(['sukses' => 'Data Aset Dihapus']);
    }

    public function edit($id){
        $asetedit = aset::findOrFail($id);
        return view('aset.edit', compact('asetedit',));
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'photo' => 'mimes:png,jpg,'
        ]);

        $getaset = aset::findOrFail($id);
        $photo = $getaset->photo;

        $kode = ucwords(\substr($request->kategori,0,1));
        $date = Carbon::now()->format('my');
        $id_p = $kode.$date.'-'.Str::upper($request->tipe);

        if ($request->hasFile('photo')) {
            //cek, jika photo tidak kosong maka file yang ada di folder uploads/product akan dihapus
            !empty($photo) ? File::delete(public_path('uploads/product/' . $photo)):null;
            //uploading file dengan menggunakan method saveFile() yg telah dibuat sebelumnya
            $photo = $this->saveFile($request->nama_perangkat, $request->file('photo'));
        }

        $getaset->update([
            'id_perangkat' => $id_p,
            'nama_perangkat' => $request->nama_perangkat,
            'kategori' => $request->kategori,
            'tipe' => $request->tipe,
            'merek' => $request->merek,
            'model' => $request->model,
            'kondisi' => $request->kondisi,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
            'tgl_pembelian' => $request->tgl_pembelian,
            'keterangan' => $request->keterangan,
            'kelengkapan' => $request->kelengkapan,
            'photo' => $photo
        ]);
        return redirect(route('aset.index'))->with(['sukses' => $getaset->nama_perangkat .' Diperbaharui']);
    }
}
