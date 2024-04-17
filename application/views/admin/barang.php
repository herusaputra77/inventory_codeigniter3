<div class="tambah">
    <a href="#tambah" data-toggle="modal" class="btn btn-sm btn-primary mb-3 mt-3">Tambah</a>
</div>
<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    	<?php $no=1;
    	foreach ($barang as $key => $value) {?>


    		<tr>
    			<td><?= $no++?></td>
    			<td><?= $value['kode_brg']?></td>
    			<td><?= $value['nama_brg']?></td>
                <td><?= $value['harga_beli']?></td>
    			<td><?= $value['harga_jual']?></td>
    			<td><?= $value['status']?></td>
    			<td>

                        <a href="#edit<?= $value['id_brg'] ?>" data-toggle="modal" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                        <a href="<?= base_url('admin/barang/delete/') . $value['id_brg'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
    			</td>
    		</tr>
    	<?php } ?>
    </tbody>
</table>


<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/barang/add') ?>" method="post">

                <div class="modal-body">

                    <div class="form-group" hidden>
                        <label for="">Kode Barang</label>
                        <input type="text" value="<?= $kode_brg ?>" name="kode_brg" class="form-control" hidden>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" name="barang" class="form-control" require>
                    </div>
                    <div class="form-group">
                        <label for="">Harga Beli</label>
                        <input type="number" min="0" name="harga_beli" class="form-control" require>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php foreach ($barang as $key => $value) {?>
	<div id="edit<?= $value['id_brg']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Edit Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/barang/edit') ?>" method="post">

                <div class="modal-body">

                    <div class="form-group" hidden>
                        <label for="">Kode Barang</label>
                        <input type="text" value="<?= $value['kode_brg'] ?>" name="kode_brg" class="form-control" hidden>
                        <input type="hidden" value="<?= $value['id_brg'] ?>" name="id_brg" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" name="barang" value="<?= $value['nama_brg']?>" class="form-control" require>
                    </div>
                    <div class="form-group">
                        <label for="">Harga Beli</label>
                        <input type="number" min="0" name="harga_beli" value="<?= $value['harga_beli']?>" class="form-control" require>
                    </div>
                    <div class="form-group"hidden>
                        <label for="">Harga Jual</label>
                        <input type="number" name="harga_jual" value="<?= $value['harga_jual']?>" class="form-control" min="0">
                    </div>
                     <div class="form-group">
                        <label for="">Status</label>
                       <input type="radio" name="status" value="Aktif" <?= ($value['status'] == 'Aktif')?'checked':''?>/> Aktif
                       <input type="radio" name="status" value="Tidak Aktif" <?= ($value['status'] == 'Tidak Aktif')?'checked':''?>/> Tidak Aktif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<?php }?>
