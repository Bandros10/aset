<div class="table-responsive">
    <table id="example1" class="table table-bordered table-hover">
        <thead>
            <tr>
                <td>No</td>
                <td>Kode Perangkat</td>
                <td>Nama Perangkat</td>
                <td>Kategori</td>
                <td>Tipe Jenis</td>
                <td>Merek</td>
                <td>Model</td>
                <td>Nomor SerIal Produk</td>
                <td>Kondisi</td>
                <td>Harga</td>
                <td>Tanggal Pembelian</td>
                <td>Kelengkapan Perangkat</td>
                <td>Keterangan</td>
                <td>Gambar Perangkat</td>
                <td>QR Code</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($PC as $pc)
            <tr>
                <td>{{$no++}}</td>
                @if ($pc->status == true)
                    <td>{{$pc->kode_perangkat}} <br> <sup  class="label bg-success">Dipinjam</sup></td>
                @else
                    <td>{{$pc->kode_perangkat}}</td>
                @endif
                <td>{{$pc->nama_perangkat}}</td>
                <td>{{$pc->kategori}}</td>
                <td>{{$pc->tipe}}</td>
                <td>{{$pc->merek}}</td>
                <td>{{$pc->model}}</td>
                <td>{{$pc->nomer_seri_produk}}</td>
                <td>{{$pc->kondisi}}</td>
                <td>{{$pc->harga}}</td>
                <td>{{$pc->tgl_pembelian}}</td>
                <td>{{$pc->kelengkapan}}</td>
                <td>{{$pc->keterangan}}</td>
                <td>
                    @if (!empty($pc->photo))
                    <img src="{{ asset('uploads/product/' . $pc->photo) }}" alt="{{ $pc->nama_perangkat }}"
                        width="100px" height="100px">
                    @else
                    <img src="http://via.placeholder.com/50x50" alt="{{ $pc->nama_perangkat }}">
                    @endif
                </td>
                <td>{!! QrCode::size(100)->generate($pc->kode_perangkat); !!}</td>
                <td>
                    @if ($pc->status == true)
                    <p style="color: red">Perangkat Sedang Dipinjam</p>
                @else
                    <a href="{{route('aset.edit',$pc->kode_perangkat)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{route('aset.destroy', $pc->kode_perangkat)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></i> Hapus</a>
                @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
