<?php

namespace App\Exports;

use App\Models\pengadaan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengadaanExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct(string $year) {
        $this->year = $year;
    }

    public function query(){
<<<<<<< Updated upstream
        $data_pengadaan = pengadaan::query()->whereYear('tanggal_pengadaan', $this->year)->where('confirmed', true);
=======
        $data_pengadaan = pengadaan::query()->whereYear('tanggal_pengadaan', $this->year)->where('confirmed',true);
>>>>>>> Stashed changes
        // dd($data_pengadaan);
        return $data_pengadaan;
    }

    public function map($pengadaan): array
    {
        return [
            $pengadaan->kode_perangkat,
            $pengadaan->nama_barang,
            $pengadaan->jenis_barang,
            $pengadaan->merk_barang,
            $pengadaan->model_barang,
            $pengadaan->nomer_seri_produk,
            $pengadaan->harga_barang,
            $pengadaan->tanggal_pengadaan,
            $pengadaan->keterangan,
        ];
    }

    public function headings(): array
    {
        return [
            'Kode Perangkat',
            'Nama perangkat',
            'Jenis',
            'Merek',
            'Model',
            'Serial Nomer Produk',
            'Harga',
            'Tanggal Pembelian',
            'Keterangan Barang',
        ];
    }
}
