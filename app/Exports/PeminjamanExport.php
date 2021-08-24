<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\peminjaman;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PeminjamanExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    function __construct(string $first,$second) {
            $this->first = $first;
            $this->second = $second;
    }

    public function query(){
        $data_pinjam = peminjaman::query()->whereBetween('tgl_peminjaman',[$this->first,$this->second])->where('status',true)->select('peminjamen.*');
        return $data_pinjam;
    }

    public function map($peminjaman): array
    {
        return [
            $peminjaman->kode_perangkat,
            $peminjaman->nama_peminjam,
            $peminjaman->jabatan_peminjam,
            $peminjaman->devisi_peminjam,
            $peminjaman->keperluan,
            $peminjaman->tgl_peminjaman,
        ];
    }

    public function headings(): array
    {
        return [
            'Kode Perangkat',
            'Nama Peminjam',
            'Jabatan Peminjam',
            'Devisi Peminjam',
            'Keperluan',
            'Tanggal Peminjaman',
        ];
    }
}
