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
                                    <label>Nama Barang</label>
                                    <input type="text" class="form-control" name="nama_barang" placeholder="Masukan Nama Barang" required>
                                </div>
                                <div class="col-3">
                                    <label>Jenis</label>
                                    <input type="text" class="form-control" name="jenis_barang" placeholder="Jenis Barang Pengadaan" required>
                                </div>
                                <div class="col-3">
                                    <label>Merek</label>
                                    <input type="text" class="form-control" name="merk_barang" placeholder="Merek Barang Pengadaan" required>
                                </div>
                                <div class="col-3">
                                    <label>Tipe Barang</label>
                                    <input type="text" class="form-control" name="model_barang" placeholder="Model Barang Pengadaan" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Jumlah</label>
                                            <input type="number" class="form-control" name="jumlah_pengadaan" placeholder="Jumlah Barang" required>
                                        </div>
                                        <div class="col-6">
                                            <label>Harga Satuan</label>
                                            <input type="number" class="form-control" name="harga_barang" placeholder="Harga Barang" required>
                                        </div>
                                    </div>
                                    <label>Tanggal Pengadaan</label>
                                    <input type="date" class="form-control" name="tanggal_pengadaan" placeholder="Harga Barang" required>
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
