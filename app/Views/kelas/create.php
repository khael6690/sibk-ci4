<div class="modal fade" id="modal-create-kelas">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Form <?= $title; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="<?= base_url('kelas') ?>" method="POST" class="form-horizontal form-create-kelas">
                        <?= csrf_field() ?>
                        <div class="form-group row">
                            <label for="nama_kelas" class="col-sm-4 col-form-label">Nama Kelas</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="<?= old('nama_kelas') ?>" placeholder="XII">
                                <div class="invalid-feedback errornama_kelas">

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="guru_id" class="col-sm-4 col-form-label">Guru</label>
                            <div class="col-sm-8">
                                <select class="form-control select2" id="guru_id" name="guru_id">
                                    <?php foreach ($data_guru as $guru) { ?>
                                        <option value="<?= $guru['guru_id']; ?>"><?= $guru['nama']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jurusan_id" class="col-sm-4 col-form-label">Jurusan</label>
                            <div class="col-sm-8">
                                <select class="form-control select2" id="jurusan_id" name="jurusan_id">
                                    <?php foreach ($data_jurusan as $jurusan) { ?>
                                        <option value="<?= $jurusan['jurusan_id']; ?>"><?= $jurusan['singkatan']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-success btn-save">Simpan</button>
                            <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    $(document).ready(function() {

        //Initialize Select2 Elements
        $('.select2').select2({
            theme: 'bootstrap4'
        })

    });

    $('.form-create-kelas').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            dataType: "json",
            beforeSend: function() {
                form.find('.btn-save').attr('disabled', 'disabled');
                form.find('.btn-save').html('<i class="fas fa-spinner fa-spin"></i> Simpan');
            },
            complete: function() {
                form.find('.btn-save').removeAttr('disabled');
                form.find('.btn-save').html('Simpan');
            },
            success: function(response) {
                if (response.error) {
                    response.error && response.error.nama_kelas ?
                        (form.find('#nama_kelas').addClass('is-invalid'), form.find('.errornama_kelas').html(response.error.nama_kelas)) :
                        (form.find('#nama_kelas').removeClass('is-invalid'), form.find('.errornama_kelas').html(''));
                } else {
                    toastr.success(response.success, 'Sukses')
                    $('#modal-create-kelas').modal('hide')
                    getData('kelas/viewdata', '.viewdata')
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