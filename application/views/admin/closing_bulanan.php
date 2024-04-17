<div class="isi">
	<h5 class="font-18 text-center"><?php echo $this->session->flashdata('pesan') ?></h5>

	<!-- Search Form -->
	<form action="<?= base_url('admin/ClosingBulanan/aksi_closing') ?>" method="post" class="mb-3">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						<label for="bulan">Bulan:</label>
						<?php
						$result = $this->db->query("SELECT tanggal FROM stok ORDER BY tanggal ASC LIMIT 1");
						$result2 = $this->db->query("SELECT tanggal FROM stok WHERE jenis_tr = 'AWL' ORDER BY tanggal DESC LIMIT 1");
						$tanggal = null;
						// var_dump($result2->num_rows());
						if ($result2->num_rows() > 0) {
							$row2 = $result2->row_array();
							$tanggal = $row2['tanggal'];
							// $tanggal = date('Y-m-d', strtotime('+1 month', strtotime($tgl1)));
						} else {
							$row = $result->row_array();
							$tanggal = $row['tanggal'];
					
						}
						$bulan = date('m', strtotime($tanggal));

						$nm_bln = [
							"01" => "Januari", "02" => "February", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", "07" => "July", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember"
						];
						?>
						<!-- <select name="bulan" id="bulan" class="form-control" required>
							<option value="<?= $bulan ?>" <?= ($bulan == $bulan) ? 'selected' : '' ?>><?= $nm_bln[$bulan] ?></option>
						</select> -->
						<input name="bulan1" id="bulan1" class="form-control" value ="<?= $nm_bln[$bulan] ?>" readonly>
						<input type="hidden" name="bulan" id="bulan" class="form-control" value ="<?= $bulan ?>" readonly>

					
						<!-- <select name="bulan" id="bulan" class="form-control" required>
						<?php foreach ($nm_bln as $key => $value) : ?>
							<?php if ($key == $bulan) : ?>
								<option value="<?= $key ?>" selected><?= $value ?></option>
							<?php else : ?>
								<option value="<?= $key ?>"><?= $value ?></option>
							<?php endif; ?>
						<?php endforeach; ?>
						</select> -->


					</div>
					<div class="col-md-4">
						<label for="tahun">Tahun:</label>
						<?php
						$tahun = date('Y', strtotime($tanggal))
						?>
						<input type="number" name="tahun" id="tahun" value="<?= $tahun ?>" class="form-control" placeholder="Tahun">
					</div>
				</div>


				<button type="submit" class="btn btn-primary mt-5">closing</button>
			</div>
		</div>
	</form>
</div>