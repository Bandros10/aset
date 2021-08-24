<?php

namespace App\Exports;

use App\Models\pengembalian;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PengembalianExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    function __construct(string$first,$second) {
        $this->first = $first;
        $this->second = $second;
    }

    public function query(){
        $data_balik = pengembalian::query()->whereBetween('tgl_pengembalian',[$this->first,$this->second])->whereNotNull('kelengkapan')->select('pengembalians.*');
        return $data_balik;
    }

    public function map($peminjaman): array
    {
        return [
            $peminjaman->kode_perangkat,
            $peminjaman->nama_peminjam,
            $peminjaman->jabatan_peminjam,
            $peminjaman->devisi_peminjam,
            $peminjaman->keperluan,
            $peminjaman->kelengkapan,
            $peminjaman->tgl_pengembalian,
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
            'kelengkapan',
            'Tanggal Peminjaman',
        ];
    }
}
