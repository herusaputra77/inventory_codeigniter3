<div class="tambah">
    <a href="<?= base_url('admin/BarangMasuk/tambah') ?>" class="btn btn-sm btn-primary mt-3 mb-3">Tambah</a>
</div>
<div class="isi">
    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Masuk</th>
                <th>Kode Barang</th>
                <th>No Transaksi</th>
                <th>Jenis Transaksi</th>
                <!-- <th>Suplier</th> -->
                <th>Nama Barang</th>
                <th>Harga Barang</th>
                <th>Jumlah Barang</th>
                <th>Status</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($barangMasuk as $bm) { ?>
                <tr>
                    <td td style="text-align: center;"><?= $no++ ?></td>
                    <td style="text-align: center;"><?= $bm['tgl_masuk'] ?></td>
                    <td style="text-align: center;"><?= $bm['kode_brg'] ?></td>
                    <td style="text-align: center;"><?= $bm['notr'] ?></td>
                    <td style="text-align: center;"><?= $bm['jenis_tr'] ?></td>
                    <!-- <td style="text-align: center;"><?= $bm['supplier'] ?></td> -->
                    <td><?= $bm['nama_brg'] ?></td>
                    <td style="text-align: center;"><?= $bm['harga'] ?></td>
                    <td style="text-align: center;"><?= $bm['jumlah'] ?></td>
                    <td style="text-align: center;"><?= $bm['status_bm'] ?></td>
                    <td>
                        <a href="<?= base_url('admin/BarangMasuk/editBm/' . $bm['ids']) ?>" class="btn btn-sm btn-success"> <i class="fa fa-edit"></i></a>
                        <a href="<?= base_url('admin/BarangMasuk/deleteBm/' . $bm['ids']) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        <?php if ($bm['status_bm'] == 'Proses') { ?>
                            <a href="<?= base_url('admin/BarangMasuk/release/' . $bm['ids']) ?>" class="btn btn-sm btn-warning">Release</a>
                        <?php } else { ?>
                            <button class="btn btn-sm btn-success">Closed</button>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>