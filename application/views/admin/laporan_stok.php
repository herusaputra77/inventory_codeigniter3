<div class="isi">
	<form action="<?= base_url('admin/LaporanStok/laporan_bulan') ?>" method="post" class="mb-3">
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
						<input type="number" name="tahun" id="tahun" class="form-control" placeholder="Tahun" required>
					</div>
				</div>
				<button type="submit" class="btn btn-primary mt-5">Cari Laporan</button>
			</div>
		</div>
	</form>
</div>

