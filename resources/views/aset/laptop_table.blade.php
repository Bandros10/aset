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
                <td>Nomor Serial Produk</td>
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
            @foreach ($laptop as $laptop)
            <tr>
                <td>{{$no++}}</td>
                @if ($laptop->status == true)
                    <td>{{$laptop->kode_perangkat}} <br> <sup  class="label bg-success">Dipinjam</sup></td>
                @else
                    <td>{{$laptop->kode_perangkat}}</td>
                @endif
                <td>{{$laptop->nama_perangkat}}@if (empty($laptop->kondisi))
                    <sup  class="label bg-danger">info barang belum lengkap</sup>
                @endif</td>
                <td>{{$laptop->kategori}}</td>
                <td>{{$laptop->tipe}}</td>
                <td>{{$laptop->merek}}</td>
                <td>{{$laptop->model}}</td>
                <td>{{$laptop->nomer_seri_produk}}</td>
                <td>{{$laptop->kondisi}}</td>
                <td>{{$laptop->harga}}</td>
                <td>{{$laptop->tgl_pembelian}}</td>
                <td>{{$laptop->kelengkapan}}</td>
                <td>{{$laptop->keterangan}}</td>
                <td>
                    @if (!empty($laptop->photo))
                    <img src="{{ asset('uploads/product/' . $laptop->photo) }}" alt="{{ $laptop->nama_perangkat }}"
                        width="100px" height="100px">
                    @else
                    <img src="http://via.placeholder.com/50x50" alt="{{ $laptop->nama_perangkat }}">
                    @endif
                </td>
                <td>{!! QrCode::size(100)->generate($laptop->kode_perangkat); !!}</td>
                <td>
                    @if ($laptop->status == true)
                        <p style="color: red">Barang Sedang Dipinjam</p>
                    @else
                        <a href="{{route('aset.edit',$laptop->kode_perangkat)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                        <a href="{{route('aset.destroy', $laptop->kode_perangkat)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></i> Hapus</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
