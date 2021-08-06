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
            @foreach ($laptop as $laptop)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$laptop->id_perangkat}}</td>
                <td>{{$laptop->nama_perangkat}}</td>
                <td>{{$laptop->kategori}}</td>
                <td>{{$laptop->tipe}}</td>
                <td>{{$laptop->merek}}</td>
                <td>{{$laptop->model}}</td>
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
                <td>{!! QrCode::size(100)->generate('KODE = '.$laptop->id_perangkat); !!}</td>
                <td>
                    <a href="{{route('aset.edit',$laptop->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{route('aset.destroy', $laptop->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></i> Hapus</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
