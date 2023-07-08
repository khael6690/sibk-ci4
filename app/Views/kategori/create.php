<div class="modal fade" id="modal-create-kategori">
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
                    <form action="<?= base_url('kategori') ?>" method="POST" id="form-create-kategori" class="form-horizontal">
                        <?= csrf_field() ?>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-4 col-form-label">Kategori</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama') ?>" placeholder="Nama kategori...">
                                <div class="invalid-feedback errornama">

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis" class="col-sm-4 col-form-label">Jenis Peraturan</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="jenis" name="jenis">
                                    <option value="1">Peraturan Akademik</option>
                                    <option value="2">Peraturan Non Akademik</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" id="keterangan" name="keterangan" placeholder="Keterangan kategori..." style="resize: none;"><?= old('keterangan') ?></textarea>
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

        $('#form-create-kategori').submit(function(e) {
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
                    } else {
                        toastr.success(response.success, 'Sukses')
                        $('#modal-create-kategori').modal('hide');
                        getData('kategori/viewdata', '.datakategori')
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