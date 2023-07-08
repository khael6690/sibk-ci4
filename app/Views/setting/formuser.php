<form action="<?= base_url('/setting/user/' . user_id()) ?>" method="PUT" class="form-horizontal" id="form-user">
    <?= csrf_field() ?>
    <div class="card-body">
        <div class="form-group row">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="username" id="username" value="<?= old('username', $datauser->username) ?>" placeholder="<?= lang('Auth.username') ?>">
                <div class="invalid-feedback errorusername">

                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="fullname" class="col-sm-2 col-form-label">Nama lengkap</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="fullname" id="fullname" value="<?= old('fullname', $datauser->fullname)  ?>" placeholder="nama lengkap...">
                <div class="invalid-feedback errorfullname">

                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-5">
                <input type="email" class="form-control" name="email" id="email" value="<?= old('email', $datauser->email)  ?>" placeholder="<?= lang('Auth.email') ?>">
                <div class="invalid-feedback erroremail">

                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" id="save-user" class="btn btn-primary">Simpan</button>
    </div>
    <!-- /.card-footer -->
</form>
<script>
    $('#form-user').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            dataType: "json",
            beforeSend: function() {
                $('#save-user').attr('disable', 'disabled');
                $('#save-user').html('<i class="fas fa-spinner fa-spin"></i>');
            },
            complete: function() {
                $('#save-user').removeAttr('disable', 'disabled');
                $('#save-user').html('Simpan');
            },
            success: function(response) {
                if (response.error) {
                    response.error && response.error.username ?
                        (form.find('#username').addClass('is-invalid'), form.find('.errorusername').html(response.error.username)) :
                        (form.find('#username').removeClass('is-invalid'), form.find('.errorusername').html(''));

                    response.error && response.error.fullname ?
                        (form.find('#fullname').addClass('is-invalid'), form.find('.errorfullname').html(response.error.fullname)) :
                        (form.find('#fullname').removeClass('is-invalid'), form.find('.errorfullname').html(''));

                    response.error && response.error.email ?
                        (form.find('#email').addClass('is-invalid'), form.find('.erroremail').html(response.error.email)) :
                        (form.find('#email').removeClass('is-invalid'), form.find('.erroremail').html(''));
                } else {
                    toastr.success(response.success, 'Sukses')
                    getData('setting/user', '.form-user')
                }
            }
        });
    });
</script>