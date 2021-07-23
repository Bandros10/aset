<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\aset;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
use File;

class AsetController extends Controller
{
    public function index(){
        $all_aset = aset::all();
        return \view('aset.index', compact('all_aset'));
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
        $id = $kode.$date.'-'.$request->tipe;

        $photo = null;
        //jika terdapat file (Foto / Gambar) yang dikirim
        if ($request->hasFile('photo')) {
            //maka menjalankan method saveFile()
            $photo = $this->saveFile($request->nama_perangkat, $request->file('photo'));
        }

        // dd($id);
        try {
            aset::firstOrCreate(
                ['id_perangkat' => $id,
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
}
