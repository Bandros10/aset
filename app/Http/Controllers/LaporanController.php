<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Exports\AsetExport;
use App\Models\pengembalian;
use Illuminate\Http\Request;
use App\Exports\PeminjamanExport;
use Illuminate\Support\Facades\DB;
use App\Exports\PengembalianExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function peminjaman(Request $request){
        $d = explode("-",$request->laporan_peminjam);
        $awal = Carbon::parse($d[0])->format('Y-m-d');
        $akhir = Carbon::parse($d[1])->format('Y-m-d');
        return Excel::download(new PeminjamanExport($awal,$akhir), 'Laporan peminjaman '.$awal.' - '.$akhir.'.xlsx');
    }

    public function pengembalian(Request $request){
        $p = explode("-",$request->laporan_pengembalian);
        $awal = Carbon::parse($p[0])->format('Y-m-d');
        $akhir = Carbon::parse($p[1])->format('Y-m-d');
        return Excel::download(new PengembalianExport($awal,$akhir), 'Laporan pengembalian '.$awal.' - '.$akhir.'.xlsx');
    }

    public function aset(Request $request){
        $tahun = $request->tahun_laporan_aset;
        return Excel::download(new AsetExport($tahun), 'Laporan aset '.$tahun.'.xlsx');
    }
}
