<form action="<?= base_url('setting/pass/' . user_id()) ?>" method="PUT" class="form-horizontal" id="form-password">
    <?= csrf_field() ?>
    <div class="card-body">
        <div class="form-group row">
            <label for="oldpass" class="col-sm-3 col-form-label"><?= lang('Auth.password') ?> Lama</label>
            <div class="col-sm-5">
                <input type="password" name="oldpass" id="oldpass" class="form-control" placeholder="<?= lang('Auth.password') ?> Lama" autocomplete="off">
                <div class="invalid-feedback erroroldpass">

                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-3 col-form-label"><?= lang('Auth.password') ?> Baru</label>
            <div class="col-sm-5">
                <input type="password" name="password" id="password" class="form-control" placeholder="<?= lang('Auth.password') ?> Baru" autocomplete="off">
                <div class="invalid-feedback errorpassword">

                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="pass_confirm" class="col-sm-3 col-form-label"><?= lang('Auth.repeatPassword') ?></label>
            <div class="col-sm-5">
                <input type="password" name="pass_confirm" id="pass_confirm" class="form-control" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                <div class="invalid-feedback errorpass_confirm">

                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary" id="save-pass">Simpan</button>
    </div>
    <!-- /.card-footer -->
</form>
<script>
    $('#form-password').submit(function(e) {
        e.preventDefault();
        var form = $(this); // Menyimpan referensi form dalam variabel form
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'), // Menggunakan variabel form untuk mendapatkan URL aksi form
            data: form.serialize(), // Menggunakan variabel form untuk mengambil data form yang akan di-serialize
            dataType: "json",
            beforeSend: function() {
                $('#save-pass').attr('disable', 'disabled');
                $('#save-pass').html('<i class="fas fa-spinner fa-spin"></i>');
            },
            complete: function() {
                $('#save-pass').removeAttr('disable', 'disabled');
                $('#save-pass').html('Simpan');
            },
            success: function(response) {
                if (response.error) {
                    response.error && response.error.oldpass ?
                        (form.find('#oldpass').addClass('is-invalid'), form.find('.erroroldpass').html(response.error.oldpass)) :
                        (form.find('#oldpass').removeClass('is-invalid'), form.find('.erroroldpass').html(''));

                    response.error && response.error.password ?
                        (form.find('#password').addClass('is-invalid'), form.find('.errorpassword').html(response.error.password)) :
                        (form.find('#password').removeClass('is-invalid'), form.find('.errorpassword').html(''));

                    response.error && response.error.pass_confirm ?
                        (form.find('#pass_confirm').addClass('is-invalid'), form.find('.errorpass_confirm').html(response.error.pass_confirm)) :
                        (form.find('#pass_confirm').removeClass('is-invalid'), form.find('.errorpass_confirm').html(''));
                } else {
                    toastr.success(response.success, 'Sukses')
                    form[0].reset();
                    form.find('input[type="password"]').removeClass('is-invalid');
                    form.find('input[type="password"]').val('');
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
</script>