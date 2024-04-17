<div class="isi">
	<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
		style="border-collapse: collapse; border-spacing: 0; width: 100%;">
		<thead>
			<tr>
				<th class="text-center">No</th>
				<th>Tanggal</th>
				<th>Kode Barang</th>
				<th>Nama Barang</th>
				<th>Stok Awal</th>
				<th>Masuk</th>
				<th>Keluar</th>
				<th class="text-center">Stok Akhir</th>
			</tr>
		</thead>
		<tbody>
		<?php $no = 1;
            foreach ($stok_akhir as $datanya) { ?>
			<tr>
				<td width="10%" class="text-center"><?= $no++?></td>
				<td width="30%"><?= $datanya['tanggal']?></td>
				<td width="30%"><?= $datanya['kode_brg']?></td>
				<td width="50%"><?= $datanya['nama_brg']?></td>
				<td width="20%"><?= $datanya['stokawl']?></td>
				<td width="20%"><?= $datanya['jm']?></td>
				<td width="20%"><?= $datanya['jk']?></td>
				<td width="20%" class="text-center font-weight-bold"><?= $datanya['stok_akhir']?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<div class="tambah">
    <a href="<?= base_url('admin/LaporanStok') ?>" class="btn btn-sm btn-primary mt-3 mb-3">Kembali</a>
</div>
</div>
