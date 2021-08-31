<?php

namespace App\Exports;

use App\Models\aset;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AsetExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct(string $year) {
        $this->year = $year;
    }

    public function query(){
        $data_aset = aset::query()->whereYear('created_at', $this->year);
        // dd($data_aset);
        return $data_aset;
    }

    public function map($aset): array
    {
        return [
            $aset->kode_perangkat,
            $aset->nama_perangkat,
            $aset->kategori,
            $aset->tipe,
            $aset->merek,
            $aset->model,
            $aset->kondisi,
            $aset->harga,
            $aset->nomer_seri_produk,
            $aset->tgl_pembelian,
            $aset->kelengkapan,
            $aset->keterangan,
        ];
    }

    public function headings(): array
    {
        return [
            'Kode Perangkat',
            'Nama perangkat',
            'Kategori',
            'Tipe',
            'Merek',
            'Model',
            'Kondisi',
            'Harga',
            'Nomor Seri Produk',
            'Tanggal Pembelian',
            'Kelengkapan',
            'Keterangan',
        ];
    }
}
