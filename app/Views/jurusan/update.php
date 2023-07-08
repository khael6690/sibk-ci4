<div class="modal fade" id="modal-update-jurusan">
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
                    <form action="<?= base_url('jurusan') ?>" method="PUT" class="form-horizontal form-update-jurusan">
                        <?= csrf_field() ?>
                        <input type="hidden" value="<?= $data_jurusan['jurusan_id']; ?>" name="jurusan_id" id="jurusan_id">
                        <div class="form-group row">
                            <label for="nama_jurusan" class="col-sm-4 col-form-label">Nama Jurusan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" value="<?= old('nama_jurusan', $data_jurusan['nama_jurusan']) ?>" placeholder="Ilmu Pengetahuan ....">
                                <div class="invalid-feedback errornama_jurusan">

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="singkatan" class="col-sm-4 col-form-label">Singkatan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="singkatan" name="singkatan" value="<?= old('singkatan', $data_jurusan['singkatan']) ?>" placeholder="IP...">
                                <div class="invalid-feedback errorsingkatan">

                                </div>
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

        $('.form-update-jurusan').submit(function(e) {
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
                        response.error && response.error.nama_jurusan ?
                            (form.find('#nama_jurusan').addClass('is-invalid'), form.find('.errornama_jurusan').html(response.error.nama_jurusan)) :
                            (form.find('#nama_jurusan').removeClass('is-invalid'), form.find('.errornama_jurusan').html(''));
                        response.error && response.error.singkatan ?
                            (form.find('#singkatan').addClass('is-invalid'), form.find('.errorsingkatan').html(response.error.singkatan)) :
                            (form.find('#singkatan').removeClass('is-invalid'), form.find('.errorsingkatan').html(''));
                    } else {
                        toastr.success(response.success, 'Sukses')
                        $('#modal-update-jurusan').modal('hide');
                        getData('jurusan/viewdata', '.viewdatajurusan')
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