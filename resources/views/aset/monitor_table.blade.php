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
                <td>Kelengkapan Perangkat</td>
                <td>Keterangan</td>
                <td>Foto Perangkat</td>
                <td>QR Code</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($monitor as $monitor)
            <tr>
                <td>{{$no++}}</td>
                @if ($monitor->status == true)
                    <td>{{$monitor->kode_perangkat}} <br> <sup  class="label bg-success">Dipinjam</sup></td>
                @else
                    <td>{{$monitor->kode_perangkat}}</td>
                @endif
                <td>{{$monitor->nama_perangkat}}</td>
                <td>{{$monitor->kategori}}</td>
                <td>{{$monitor->tipe}}</td>
                <td>{{$monitor->merek}}</td>
                <td>{{$monitor->model}}</td>
                <td>{{$monitor->kondisi}}</td>
                <td>{{$monitor->harga}}</td>
                <td>{{$monitor->tgl_pembelian}}</td>
                <td>{{$monitor->kelengkapan}}</td>
                <td>{{$monitor->keterangan}}</td>
                <td>
                    @if (!empty($monitor->photo))
                    <img src="{{ asset('uploads/product/' . $monitor->photo) }}" alt="{{ $monitor->nama_perangkat }}"
                        width="100px" height="100px">
                    @else
                    <img src="http://via.placeholder.com/50x50" alt="{{ $monitor->nama_perangkat }}">
                    @endif
                </td>
                <td>{!! QrCode::size(100)->generate($monitor->kode_perangkat); !!}</td>
                <td>
                    @if ($monitor->status == true)
                        <p style="color: red">Barang Sedang Dipinjam</p>
                    @else
                        <a href="{{route('aset.edit',$monitor->kode_perangkat)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                        <a href="{{route('aset.destroy', $monitor->kode_perangkat)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></i> Hapus</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
