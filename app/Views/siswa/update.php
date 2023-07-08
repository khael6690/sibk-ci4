<div class="modal fade" id="modal-update">
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
                    <form action="<?= base_url('siswa') ?>" method="PUT" id="form-update" class="form-horizontal">
                        <?= csrf_field() ?>
                        <input type="hidden" id="nis" name="nis" value="<?= $data_siswa['nis'] ?>">
                        <div class="form-group row">
                            <label for="nis" class="col-sm-4 col-form-label">NIS</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="_nis" value="<?= $data_siswa['nis'] ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama', $data_siswa['nama']) ?>" placeholder="Nama lengkap...">
                                <div class="invalid-feedback errornama">

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kelas_id" class="col-sm-4 col-form-label">Kelas</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="kelas_id" name="kelas_id">
                                    <?php foreach ($data_kelas as $value) { ?>
                                        <option value="<?= $value['kelas_id']; ?>" <?= $value['kelas_id'] === old('kelas_id', $data_siswa['kelas_id']) ? 'selected' : ''; ?>><?= $value['nama_kelas'] . " - " . $value['singkatan']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jk" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="jk" name="jk">
                                    <option value="l" <?= old('jk', $data_siswa['jk']) === "l" ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="p" <?= old('jk', $data_siswa['jk']) === "p" ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_hp" class="col-sm-4 col-form-label">No HP</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success">+62</span>
                                    </div>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= old('no_hp', $data_siswa['no_hp']) ?>" placeholder="800 0000 0000">
                                    <div class="invalid-feedback errorno_hp">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="2" id="alamat" name="alamat" placeholder="Jl. ....." style="resize: none;"><?= old('alamat', $data_siswa['alamat']) ?></textarea>
                                <div class="invalid-feedback erroralamat">

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

        $('#form-update').submit(function(e) {
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
                        response.error && response.error.nis ?
                            (form.find('#nis').addClass('is-invalid'), form.find('.errornis').html(response.error.nis)) :
                            (form.find('#nis').removeClass('is-invalid'), form.find('.errornis').html(''));
                        response.error && response.error.nama ?
                            (form.find('#nama').addClass('is-invalid'), form.find('.errornama').html(response.error.nama)) :
                            (form.find('#nama').removeClass('is-invalid'), form.find('.errornama').html(''));
                        response.error && response.error.no_hp ?
                            (form.find('#no_hp').addClass('is-invalid'), form.find('.errorno_hp').html(response.error.no_hp)) :
                            (form.find('#no_hp').removeClass('is-invalid'), form.find('.errorno_hp').html(''));
                        response.error && response.error.alamat ?
                            (form.find('#alamat').addClass('is-invalid'), form.find('.erroralamat').html(response.error.alamat)) :
                            (form.find('#alamat').removeClass('is-invalid'), form.find('.erroralamat').html(''));
                    } else {
                        response.status === true ? toastr.success(response.success, 'Sukses') : toastr.error(response.error, 'Error')
                        $('#modal-update').modal('hide');
                        getData('siswa/viewdata', '.viewdata')
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