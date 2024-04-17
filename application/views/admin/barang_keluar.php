<div class="tambah">
    <a href="<?= base_url('admin/BarangKeluar/tambah') ?>" class="btn btn-sm btn-primary mt-3 mb-3">Tambah</a>
</div>

<div class="isi">
    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Keluar</th>
                <th>Kode Barang</th>
                <th>No Transaksi</th>
                <th>Jenis Transaksi</th>
                <th>Nama Barang</th>
                <th>Harga Barang</th>
                <th>Jumlah Barang</th>
                <th>Status</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($barangKeluar as $bk) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $bk['tgl_keluar'] ?></td>
                    <td><?= $bk['kode_brg'] ?></td>
                    <td><?= $bk['notr'] ?></td>
                    <td><?= $bk['jenis_tr'] ?></td>
                    <td><?= $bk['nama_brg'] ?></td>
                    <td><?= $bk['harga'] ?></td>
                    <td><?= $bk['jumlah'] ?></td>
                    <td><?= $bk['status_bk'] ?></td>
                    <td>
                        <a href="<?= base_url('admin/BarangKeluar/editBk/' . $bk['ids']) ?>" class="btn btn-sm btn-success"> <i class="fa fa-edit"></i></a>
                        <a href="<?= base_url('admin/BarangKeluar/delete/' . $bk['ids']) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        <?php if ($bk['status_bk'] == 'Proses') { ?>
                            <a href="<?= base_url('admin/BarangKeluar/release/' . $bk['ids']) ?>" class="btn btn-sm btn-warning">Release</a>
                        <?php } else { ?>
                            <button class="btn btn-sm btn-success">Closed</button>
                        <?php } ?>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>