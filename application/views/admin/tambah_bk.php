<div class="row">
    <!-- <div class="col-md-4"></div> -->
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">

                <form action="<?= base_url('admin/BarangKeluar/add')?>" method="post">
                    <div class="row">

                        <div class="form-group col-4"hidden>
                            <label for="">ID Transaksi</label>
                            <input type="text" value="<?= $kode_bk ?>" name="id_transaksi" class="form-control" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label for="">Barang</label>
                            <select name="barang" id="barang_id" class="form-control" require>
                                <option value=""><-Pilih Barang-></option>
                                <?php foreach ($barang as $brg) { ?>

                                    <option value="<?= $brg['id_brg'] ?>"><?= $brg['nama_brg'] ?></option>
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
                            <input type="date" name="tgl_keluar" class="form-control" require>
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
                            <input type="number" name="harga" class="form-control" require>
                        </div>
                        <div class="form-group col-4">
                            <label for="">Jumlah Keluar</label>
                            <input type="text" id="jumlah" name="jumlah" class="form-control" require>
                            <?= form_error('jumlah', '<small class="text-danger">', '</small>'); ?>

                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  let hal = '<?= $this->uri->segment(1); ?>';

// let satuan = $('#satuan');
let stok = $('#stok');
let total = $('#total_stok');
let jumlah = hal == 'barangmasuk' ? $('#jumlah_masuk') : $('#jumlah_keluar');
// console.warn(jumlah);


$(document).on('change', '#barang_id', function() {
    console.warn(this.value)
    $.ajax({
        url: '<?= base_url('admin/barang/getStok/'); ?>' + this.value,
        method: 'get',
        async: true,
        dataType: 'json',
        success: function(data) {
            if (data == null) {

                stok.val('0');
            } else {

                console.warn(data);
                stok.val(data);
                total.val(data);
                jumlah.focus();
            }




        }
    });
});
</script>