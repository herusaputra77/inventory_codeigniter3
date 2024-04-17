<div class="card">
    <div class="card-body">
    <?= $this->session->flashdata('pesan'); ?>
    <?php echo form_error('password', '<div class="text-danger small">', '</div>') ?>
    <?php echo form_error('password2', '<div class="text-danger small">', '</div>') ?>

        <div class="row">
            <div class="col-md-6">
                <table class="table table-hover">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= $user['nama'] ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?= $user['email'] ?></td>
                    </tr>
                    <tr>
                        <td>Role</td>
                        <td>:</td>
                        <td><?= ($user['role_id'] == 1) ? 'Admin' : 'Member' ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td><?= ($user['status'] == 1) ? 'Aktif' : 'Tidak Aktif' ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6" style="">
            <center>

                <img src="<?= base_url() ?>assets/template/images/users/user-4.jpg" alt="user" class="rounded-circle">
            </center>

            </div>
            <a href="#ganti_pass" data-toggle="modal" class="btn btn-success">Ganti Password</a>
        </div>
    </div>
</div>

<div id="ganti_pass" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Ganti Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('user/User/ganti_pass') ?>" method="post">

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">Password Baru</label>
                            <input type="password"  name="password" class="form-control" require>
                            <input type="hidden" value="<?= $user['id_user'] ?>" name="id_user" class="form-control" require>
                        </div>
                        <div class="form-group">
                            <label for="">Konfirmasi Password</label>
                            <input type="password" name="password2"  class="form-control" require>
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