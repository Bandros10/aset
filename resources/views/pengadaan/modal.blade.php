<div class="modal fade" id="pengadaanmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Pengadaan Barang Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('pengadaan.store')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <label>Nama Perangkat</label>
                                    <input type="text" class="form-control" name="nama_barang" placeholder="Masukkan Nama Perangkat" required>
                                </div>
                                <div class="col-3">
                                    <label>Jenis</label>
                                    <select class="form-control" name="jenis_barang" required>
                                        <option selected disabled>- Jenis Perangkat - </option>
                                        <option value="laptop">Laptop</option>
                                        <option value="PC">PC</option>
                                        <option value="monitor">Monitor</option>
                                        <option value="printer">Printer</option>
                                        <option value="scanner">Scanner</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label>Merek</label>
                                    <input type="text" class="form-control" name="merk_barang" placeholder="Merek Perangkat Pengadaan" required>
                                </div>
                                <div class="col-3">
                                    <label>Tipe Perangkat</label>
                                    <input type="text" class="form-control" name="model_barang" placeholder="Tipe Perangkat Pengadaan" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <label>Nomor Seri Produk</label>
                                            <input type="text" class="form-control" name="nomer_seri_produk" placeholder="Masukkan Nomor Seri Produk" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Harga Perangkat</label>
                                            <input type="number" class="form-control" name="harga_barang" placeholder="Harga Perangkat" required>
                                        </div>
                                        <div class="col-6">
                                            <label>Tanggal Pengadaan</label>
                                            <input type="date" class="form-control" name="tanggal_pengadaan" placeholder="Tanggal" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control" rows="4" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
