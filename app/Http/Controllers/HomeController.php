<?php

namespace App\Http\Controllers;

use App\Models\aset;
use App\Models\pengadaan;
use App\Models\perbaikan;
use App\Models\peminjaman;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $barang_aset = aset::all()->count();
        $barang_pengadaan = pengadaan::all()->count();
        $notif_pengadaan = pengadaan::where('confirmed',false)->count();
        $barang_pinjam = peminjaman::all()->count();
        $notif_pinjam = peminjaman::where('status',false)->count();
        $data_perbaikan = aset::where('kondisi','=','buruk')->count();
        return view('home',compact('barang_aset','barang_pengadaan','notif_pengadaan','barang_pinjam','data_perbaikan','notif_pinjam'));
    }
}
