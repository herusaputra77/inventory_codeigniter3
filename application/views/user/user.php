<div class="tambah">
    <a href="#tambah" data-toggle="modal" class="btn btn-sm btn-primary mb-3 mt-3">Tambah</a>
</div>
<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Status</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>


    <tbody>
        <?php $no = 1;

        foreach ($user as $value) { ?>

            <tr>
                <td><?= $no++ ?></td>
                <td><?= $value['nama'] ?></td>
                <td><?= $value['email'] ?></td>
                <td><?= ($value['status'] == 1)? 'Aktif':'Tidak Aktif' ?></td>
                <td><?= ($value['role_id'] == '1') ? 'Admin' : 'Member' ?></td>
                <td>
                    <?php if ($this->session->userdata('id_user') == $value['id_user']) { ?>
                        <button class="btn btn-warning">Tidak Ada Aksi</button>
                    <?php } else { ?>
                        <?php if ($value['role_id'] == 1) { ?>
                        <button class="btn btn-danger">Tidak ada akses</button>

                        <?php } else { ?>
                            <a href="#edit<?= $value['id_user'] ?>" data-toggle="modal" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                            <a href="<?= base_url('admin/user/delete/') . $value['id_user'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        <?php } ?>
                    <?php } ?>


                </td>
            </tr>
        <?php } ?>

    </tbody>
</table>

<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/User/add') ?>" method="post">

                <div class="modal-body">

                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="nama" class="form-control" require>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control" require>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" require>
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

<?php foreach ($user as $value) { ?>
    <div id="edit<?= $value['id_user'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('user/User/edit') ?>" method="post">

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" value="<?= $value['nama'] ?>" name="nama" class="form-control" require>
                            <input type="hidden" value="<?= $value['id_user'] ?>" name="id_user" class="form-control" require>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" value="<?= $value['email'] ?>" class="form-control" require>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" value="<?= $value['password'] ?>" class="form-control" require>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" class="form-control" id="">
                                <option value="<?= $value['status']?>"><?= ($value['status'] == 1) ? 'Aktif' : 'Tidak Aktif' ?></option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
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

<?php } ?>