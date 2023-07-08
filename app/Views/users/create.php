<div class="modal fade" id="modal-create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Form <?= $title; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('users') ?>" method="POST" id="form-create" class="form-horizontal">
                    <?= csrf_field() ?>
                    <div class="form-group row">
                        <label for="fullname" class="col-sm-5 col-form-label">Nama lengkap</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="fullname" id="fullname" value="<?= old('fullname') ?>" autocomplete="off" placeholder="Nama lengkap ...">
                            <div class="invalid-feedback errorfullname"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-5 col-form-label">Username</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="username" id="username" value="<?= old('username') ?>" autocomplete="off" placeholder="<?= lang('Auth.username') ?>">
                            <div class="invalid-feedback errorusername"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-5 col-form-label">Email</label>
                        <div class="col-sm-6">
                            <input type="email" id="email" class="form-control" name="email" value="<?= old('email') ?>" autocomplete="off" placeholder="<?= lang('Auth.email') ?>">
                            <div class="invalid-feedback erroremail"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="group" class="col-sm-5 col-form-label">Role / Level</label>
                        <div class="col-sm-6">
                            <select class="form-control select" name="group">
                                <?php foreach ($data_group as $value) : ?>
                                    <option value="<?= $value->name ?>" <?= old('group') == $value->name ? 'selected' : '' ?>><?= $value->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-5 col-form-label"><?= lang('Auth.password') ?></label>
                        <div class="col-sm-6">
                            <input type="password" name="password" id="password" class="form-control" placeholder="<?= lang('Auth.password') ?>">
                            <div class="invalid-feedback errorpassword"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pass_confirm" class="col-sm-5 col-form-label">Password Repeat</label>
                        <div class="col-sm-6">
                            <input type="password" id="pass_confirm" name="pass_confirm" class="form-control" placeholder="Repeat Password">
                            <div class="invalid-feedback errorpass_confirm"></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                        <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Close</button>
                    </div>
                    <!-- /.card-footer -->
                </form>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    $(document).ready(function() {

        $('#form-create').submit(function(e) {
            e.preventDefault();

            var form = $(this);

            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                dataType: "json",
                beforeSend: function() {
                    form.find('.btn-save').attr('disabled', 'disabled');
                    form.find('.btn-save').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                complete: function() {
                    form.find('.btn-save').removeAttr('disabled');
                    form.find('.btn-save').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        response.error && response.error.fullname ?
                            (form.find('#fullname').addClass('is-invalid'), form.find('.errorfullname').html(response.error.fullname)) :
                            (form.find('#fullname').removeClass('is-invalid'), form.find('.errorfullname').html(''));

                        response.error && response.error.username ?
                            (form.find('#username').addClass('is-invalid'), form.find('.errorusername').html(response.error.username)) :
                            (form.find('#username').removeClass('is-invalid'), form.find('.errorusername').html(''));

                        response.error && response.error.email ?
                            (form.find('#email').addClass('is-invalid'), form.find('.erroremail').html(response.error.email)) :
                            (form.find('#email').removeClass('is-invalid'), form.find('.erroremail').html(''));

                        response.error && response.error.password ?
                            (form.find('#password').addClass('is-invalid'), form.find('.errorpassword').html(response.error.password)) :
                            (form.find('#password').removeClass('is-invalid'), form.find('.errorpassword').html(''));

                        response.error && response.error.pass_confirm ?
                            (form.find('#pass_confirm').addClass('is-invalid'), form.find('.errorpass_confirm').html(response.error.pass_confirm)) :
                            (form.find('#pass_confirm').removeClass('is-invalid'), form.find('.errorpass_confirm').html(''));

                    } else {
                        toastr.success(response.success, 'Sukses')
                        $('#modal-create').modal('hide');
                        getData();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    Swal.fire({
                        title: xhr.status,
                        text: thrownError,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        });


    });
</script>