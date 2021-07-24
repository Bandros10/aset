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
                <td>Foto gamabar</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($scanner as $scanner)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$scanner->id_perangkat}}</td>
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
                <td>
                    <form action="{{ route('aset.destroy', $scanner->id_perangkat) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        {{-- <a href="{{ route('users.edit', $row->id) }}" class="btn btn-warning btn-sm"><i
                                class="fa fa-edit"></i></a> --}}
                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
