<div class="row">
    <!-- <div class="col-md-4"></div> -->
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">

                <form action="<?= base_url('admin/BarangKeluar/edit') ?>" method="post">
                    <div class="row">

                        <!-- <div class="form-group col-4" hidden>
                            <label for="">ID Transaksi</label>
                            <input type="text" value="<?= $kode_bk ?>" name="id_transaksi" class="form-control" readonly>
                        </div> -->
                        <div class="form-group col-4">
                            <label for="">Barang</label>
                            <input type="hidden" value="<?= $bk['ids']?>" name="ids">
                            <select name="barang" id="barang_id" class="form-control" require>
                                <option value=""><-Pilih Barang-></option>
                                <?php foreach ($barang as $brg) { ?>

                                    <option value="<?= $brg['id_brg'] ?>" <?= ($brg['id_brg'] == $bk['id_brg'])?'selected' : '' ?>><?= $brg['nama_brg'] ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('barang', '<small class="text-danger">', '</small>'); ?>

                        </div>
                        <!-- <div class="form-group col-4">
                                <label for="barang">Cari Barang</label>
                                <input type="text" name="barang" id="barang_id" class="form-control" placeholder="Masukkan Nama Barang" required>
                                
                                <?= form_error('barang', '<small class="text-danger">', '</small>'); ?>
                            </div> -->
                        <div class="form-group col-4">
                            <label for="">Tanggal Keluar</label>
                            <input type="date" name="tgl_keluar" value="<?= $bk['tgl_keluar'] ?>" class="form-control" require>
                            <?= form_error('tgl_keluar', '<small class="text-danger">', '</small>'); ?>

                        </div>
                        <!-- <div class="form-group col-4">
                            <label for="">Stok</label>
                            <input type="number" id="stok" class="form-control" require readonly>
                        </div>
                    </div>
                    <div class="row"> -->

                        <div class="form-group col-4">
                            <label for="">Harga</label>
                            <input type="number" name="harga" value="<?= $bk['harga'] ?>" class="form-control" require>
                        </div>
                        <div class="form-group col-4">
                            <label for="">Jumlah Keluar</label>
                            <input type="text" id="jumlah" name="jumlah" value="<?= $bk['jumlah'] ?>" class="form-control" require>
                            <?= form_error('jumlah', '<small class="text-danger">', '</small>'); ?>

                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>