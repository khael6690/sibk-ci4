<div class="modal fade" id="modal-create">
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
                    <form action="<?= base_url('pelanggaran') ?>" method="POST" id="form-create" class="form-horizontal">
                        <?= csrf_field() ?>
                        <div class="form-group row">
                            <label for="nis" class="col-sm-4 col-form-label">Pilih Siswa</label>
                            <div class="col-sm-8">
                                <select class="form-control select2" id="nis" name="nis">
                                    <?php foreach ($data_siswa as $siswa) { ?>
                                        <option value="<?= $siswa['nis']; ?>"><?= $siswa['nama'] . " | " . $siswa['kelas'] . " - " . $siswa['singkatan']; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback errornis">

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kategori_id" class="col-sm-4 col-form-label">Pilih Kategori</label>
                            <div class="col-sm-8">
                                <select class="form-control select2" id="kategori_id" name="kategori_id">
                                    <?php foreach ($data_kategori as $kategori) { ?>
                                        <option value="<?= $kategori['kategori_id']; ?>"><?= $kategori['nama']; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback errorkategori_id">

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pelanggaran_id" class="col-sm-4 col-form-label">Pilih Pelanggaran</label>
                            <div class="col-sm-8">
                                <select class="form-control select2" id="pelanggaran_id" name="pelanggaran_id">

                                </select>
                                <div class="invalid-feedback errorpelanggaran_id">

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" id="keterangan" name="keterangan" placeholder="keterangan ..." style="resize: none;"><?= old('keterangan') ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tindakan" class="col-sm-4 col-form-label">Tindakan</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" id="tindakan" name="tindakan" placeholder="tindakan ..." style="resize: none;"><?= old('tindakan') ?></textarea>
                                <div class="invalid-feedback errortindakan">

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

    });

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
                    response.error && response.error.pelanggaran_id ?
                        (form.find('#pelanggaran_id').addClass('is-invalid'), form.find('.errorpelanggaran_id').html(response.error.pelanggaran_id)) :
                        (form.find('#pelanggaran_id').removeClass('is-invalid'), form.find('.errorpelanggaran_id').html(''));
                } else {
                    toastr.success(response.success, 'Sukses')
                    $('#modal-create').modal('hide');
                    getData()
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

    $('#kategori_id').on('change', function(e) {
        e.preventDefault()
        let id = $(this).val()
        $.ajax({
            type: "get",
            url: "<?= base_url('pelanggaran/getPel') ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                const dataPel = response.data
                $('#pelanggaran_id').empty();
                dataPel.map((pelanggaran) => {
                    $('#pelanggaran_id').append(` <option value="` + pelanggaran.pelanggaran_id + `">` + pelanggaran.nama + `</option>`);
                })
            }
        });
    });
</script>