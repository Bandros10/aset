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
            @foreach ($printer as $printer)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$printer->id_perangkat}}</td>
                <td>{{$printer->nama_perangkat}}</td>
                <td>{{$printer->kategori}}</td>
                <td>{{$printer->tipe}}</td>
                <td>{{$printer->merek}}</td>
                <td>{{$printer->model}}</td>
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
                <td>
                    <form action="{{ route('aset.destroy', $printer->id_perangkat) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="created_at" value="{{$printer->created_at}}">
                        <a href="{{route('aset.edit',$laptop->id_perangkat)}}" class="btn btn-warning btn-sm"><i
                            class="fa fa-edit"></i>Edit</a>
                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
