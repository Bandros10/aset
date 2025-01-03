<div class="table-responsive">
    <table id="example2" class="table table-bordered table-hover">
        <thead>
            <tr>
                <td>No</td>
                <td>Kode Perangkat</td>
                <td>Nama Perangkat</td>
                <td>Kategori</td>
                <td>Tipe Jenis</td>
                <td>Merek</td>
                <td>Model</td>
                <td>Serial Nomer Produk</td>
                <td>Kondisi</td>
                <td>Harga</td>
                <td>Tanggal Pembelian</td>
                <td>Kelengkapan Perangkat</td>
                <td>Keterangan</td>
                <td>Foto Perangkat</td>
                <td>QR Code</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($printer as $printer)
            <tr>
                <td>{{$no++}}</td>
                @if ($printer->status == true)
                    <td>{{$printer->kode_perangkat}} <br> <sup  class="label bg-success">Dipinjam</sup></td>
                @else
                    <td>{{$printer->kode_perangkat}}</td>
                @endif
                <td>{{$printer->nama_perangkat}}</td>
                <td>{{$printer->kategori}}</td>
                <td>{{$printer->tipe}}</td>
                <td>{{$printer->merek}}</td>
                <td>{{$printer->model}}</td>
                <td>{{$printer->nomer_seri_produk}}</td>
                <td>{{$printer->kondisi}}</td>
                <td>{{$printer->harga}}</td>
                <td>{{$printer->tgl_pembelian}}</td>
                <td>{{$printer->kelengkapan}}</td>
                <td>{{$printer->keterangan}}</td>
                <td>
                    @if (!empty($printer->photo))
                    <img src="{{ asset('uploads/product/' . $printer->photo) }}" alt="{{ $printer->nama_perangkat }}"
                        width="100px" height="100px">
                    @else
                    <img src="http://via.placeholder.com/50x50" alt="{{ $printer->nama_perangkat }}">
                    @endif
                </td>
                <td>{!! QrCode::size(100)->generate($printer->kode_perangkat); !!}</td>
                <td>
                    @if ($printer->status == true)
                    <p style="color: red">Perangkat Sedang Dipinjam</p>
                @else
                    <a href="{{route('aset.edit',$printer->kode_perangkat)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{route('aset.destroy', $printer->kode_perangkat)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></i> Hapus</a>
                @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
