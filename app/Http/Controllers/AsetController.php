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
        $all_aset = aset::all();
        return \view('aset.index', compact('all_aset'));
    }

    public function create(){
        return \view('aset.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'photo' => 'mimes:png,jpg,'
        ]);
        $kode = ucwords(\substr($request->kategori,0,1));
        $date = Carbon::now()->format('my');
        $id = $kode.$date.'-'.$request->tipe;
        $photo = Image::make($request->photo)->fit(400)->encode('data-url');
        dd($id);
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
