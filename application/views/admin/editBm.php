<div class="row">
    <!-- <div class="col-md-4"></div> -->
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">

                <form action="<?= base_url('admin/BarangMasuk/edit') ?>" method="post">
                    <div class="row">

                        <!-- <div class="form-group col-4" hidden>
                            <label for="">ID Transaksi</label>
                            <input type="text" value="<?= $kode_bm ?>" name="id_transaksi" class="form-control" readonly>
                        </div> -->
                        <input type="hidden" name="ids" value="<?= $bm['ids']?>" >
                        <div class="form-group col-4">
                            <label for="">Barang</label>
                            <select name="barang" id="barang_id" class="form-control" require>
                                <!-- <option value=""><-Pilih Barang-></option> -->
                                <?php foreach ($barang as $brg) { ?>

                                    <option value="<?= $brg['id_brg'] ?>" <?= ($brg['id_brg'] == $bm['id_brg'])?'selected' : '' ?>><?= $brg['nama_brg'] ?></option>
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
                            <label for="">Tanggal Masuk</label>
                            <input type="date" name="tgl_masuk" class="form-control" value="<?= $bm['tgl_masuk']?>" require>
                            <?= form_error('tgl_masuk', '<small class="text-danger">', '</small>'); ?>

                        </div>
                        <div class="form-group col-4">
                            <label for="">Suplier</label>
                            <input type="text" name="suplier" class="form-control" value="<?= $bm['supplier']?>">
                            <?= form_error('suplier', '<small class="text-danger">', '</small>'); ?>

                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group col-4">
                            <label for="">Harga</label>
                            <input type="number" name="harga" value="<?= $bm['harga']?>" class="form-control" placeholder="Masukan Harga Satuan">
                            <?= form_error('harga', '<small class="text-danger">', '</small>'); ?>

                        </div>
                        <!-- <div class="form-group col-4">
                            <label for="">Stok</label>
                            <input type="number" id="stok" class="form-control" readonly>
                        </div> -->
                        <div class="form-group col-4">
                            <label for="">Jumlah Masuk</label>
                            <input type="text" id="jumlah" name="jumlah" value="<?= $bm['jumlah']?>"  class="form-control" require>
                            <?= form_error('jumlah', '<small class="text-danger">', '</small>'); ?>

                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>