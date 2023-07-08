<div class="modal fade" id="modal-update-tata">
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
                    <form action="<?= base_url('tata-tertib') ?>" method="PUT" id="form-update-tata" class="form-horizontal">
                        <?= csrf_field() ?>
                        <input type="hidden" name="pelanggaran_id" id="pelanggaran_id" value="<?= $data_tata['pelanggaran_id'] ?>">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-4 col-form-label">Tata tertib</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama', $data_tata['nama']) ?>" placeholder="Nama tata tertib...">
                                <div class="invalid-feedback errornama">

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kategori_id" class="col-sm-4 col-form-label">Jenis Kategori</label>
                            <div class="col-sm-8">
                                <select class="form-control select2" id="kategori_id" name="kategori_id">
                                    <?php foreach ($data_kategori as $value) { ?>
                                        <option value="<?= $value['kategori_id']; ?>" <?= old('kategori_id', $data_tata['kategori_id']) === $value['kategori_id'] ? 'selected' : ''; ?>><?= $value['nama']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bobot" class="col-sm-4 col-form-label">Bobot</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="bobot" name="bobot">
                                    <option value="1" <?= old('bobot', $data_tata['bobot'])  == 1 ? 'selected' : '' ?>>Ringan</option>
                                    <option value="2" <?= old('bobot', $data_tata['bobot']) == 2 ? 'selected' : '' ?>>Menengah</option>
                                    <option value="3" <?= old('bobot', $data_tata['bobot']) == 3 ? 'selected' : '' ?>>Berat</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deskripsi" class="col-sm-4 col-form-label">Deskripsi</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" id="deskripsi" name="deskripsi" placeholder="Deskripsi tata tertib..." style="resize: none;"><?= old('deskripsi', $data_tata['deskripsi']) ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hukuman" class="col-sm-4 col-form-label">Hukuman</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" id="hukuman" name="hukuman" placeholder="Hukuman ..." style="resize: none;"><?= old('hukuman', $data_tata['hukuman']) ?></textarea>
                                <div class="invalid-feedback errorhukuman">

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

        //Initialize Select2 Elements
        $('.select2').select2({
            theme: 'bootstrap4'
        })

        $('#form-update-tata').submit(function(e) {
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
                        response.error && response.error.nama ?
                            (form.find('#nama').addClass('is-invalid'), form.find('.errornama').html(response.error.nama)) :
                            (form.find('#nama').removeClass('is-invalid'), form.find('.errornama').html(''));
                        response.error && response.error.hukuman ?
                            (form.find('#hukuman').addClass('is-invalid'), form.find('.errorhukuman').html(response.error.hukuman)) :
                            (form.find('#hukuman').removeClass('is-invalid'), form.find('.errorhukuman').html(''));
                    } else {
                        toastr.success(response.success, 'Sukses')
                        $('#modal-update-tata').modal('hide');
                        getData('tata-tertib/viewdata', '.viewdata')
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