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
                <td>Kondisi</td>
                <td>Harga</td>
                <td>Tanggal Pembelian</td>
                <td>Kelengkapan perangkat</td>
                <td>Keterangan</td>
                <td>Foto gambar</td>
                <td>qr Code</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($scanner as $scanner)
            <tr>
                <td>{{$no++}}</td>
                @if ($scanner->status == true)
                    <td>{{$scanner->kode_perangkat}} <br> <sup  class="label bg-success">Di pinjam</sup></td>
                @else
                    <td>{{$scanner->kode_perangkat}}</td>
                @endif
                <td>{{$scanner->nama_perangkat}}</td>
                <td>{{$scanner->kategori}}</td>
                <td>{{$scanner->tipe}}</td>
                <td>{{$scanner->merek}}</td>
                <td>{{$scanner->model}}</td>
                <td>{{$scanner->kondisi}}</td>
                <td>{{$scanner->harga}}</td>
                <td>{{$scanner->tgl_pembelian}}</td>
                <td>{{$scanner->kelengkapan}}</td>
                <td>{{$scanner->keterangan}}</td>
                <td>
                    @if (!empty($scanner->photo))
                    <img src="{{ asset('uploads/product/' . $scanner->photo) }}" alt="{{ $scanner->nama_perangkat }}"
                        width="100px" height="100px">
                    @else
                    <img src="http://via.placeholder.com/50x50" alt="{{ $scanner->nama_perangkat }}">
                    @endif
                </td>
                <td>{!! QrCode::size(100)->generate($scanner->kode_perangkat); !!}</td>
                <td>
                    @if ($scanner->status == true)
                    <p style="color: red">barang sedang Di Pinjam</p>
                @else
                    <a href="{{route('aset.edit',$scanner->kode_perangkat)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{route('aset.destroy', $scanner->kode_perangkat)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></i> Hapus</a>
                @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
