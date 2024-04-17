<div class="isi">
	<form action="<?= base_url('admin/Stok/filter') ?>" method="post" class="mb-3">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						<label for="bulan">Bulan:</label>
						<select name="bulan" id="bulan" class="form-control" required>
							<option value="01">Januari</option>
							<option value="02">Februari</option>
							<option value="03">Maret</option>
							<option value="04">April</option>
							<option value="05">Mei</option>
							<option value="06">Juni</option>
							<option value="07">Juli</option>
							<option value="08">Agustus</option>
							<option value="09">September</option>
							<option value="10">Oktober</option>
							<option value="11">November</option>
							<option value="12">Desember</option>
						</select>
					</div>
					<div class="col-md-4">
						<label for="tahun">Tahun:</label>
                        <select name="tahun" id="" class="form-control">
                            <option value=""><--Pilih Tahun--></option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                        </select>
					</div>
				</div>
				<button type="submit" class="btn btn-primary mt-5">Cari Stok</button>
			</div>
		</div>
	</form>
</div>
<div class="isi">
    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <!-- <th>Nomor Transaksi</th>
                <th>Jenis Transaksi</th>                 -->
                <th>Nama Barang</th>    
                <th>Kode Barang</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <!-- <th>Stok</th> -->
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1;
            foreach ($stok as $key => $value) {?>
            <?php  
            ?>   
                <tr>
                    <td><?= $no++?></td>
                    <td><?= $value['tanggal']?></td>
                    <!-- <td><?= $value['notr']?></td>
                    <td><?= $value['jenis_tr']?></td> -->
                    <td><?= $value['nama_brg']?></td>
                    <td><?= $value['kode_brg']?></td>
                    <td><?= $value['jm']?></td>
                    <td><?= $value['jk']?></td>
                    <!-- <td><?= $value['stok_akhir']?></td> -->
                    <td><?= $value['sisa']?></td>

                        
                    </td>
                </tr>
            <?php }?>
        </tbody>    
    </table>
</div>
