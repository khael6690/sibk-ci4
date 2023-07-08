<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Halaman <?= $title; ?></h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-info"></i> Halaman pengelolahan data <?= $title; ?></h5>
                        <ul>
                            <li>add data <?= $title; ?></li>
                            <li>detail data <?= $title; ?></li>
                            <li>update data <?= $title; ?></li>
                            <li>add data ortu <?= $title; ?></li>
                            <li>delete data <?= $title; ?></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">Data <?= $title; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="button" class="btn bg-gradient-primary btn-sm mb-3" id="btn-create"><i class="fas fa-plus-circle"></i> Tambah</button>
                            <div class="viewdata">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div id="viewmodal" style="display: none;"></div>

                    <div id="modaldetail" style="display: none;"></div>

                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">Data Ortu <?= $title; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="container">
                                <form action="<?= base_url('ortu') ?>" method="POST" id="form-ortu" class="form-horizontal">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="nis" id="nis" disabled>
                                    <input type="hidden" name="ortu_id" id="ortu_id" disabled>
                                    <div class="form-group row">
                                        <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama') ?>" placeholder="Nama lengkap..." disabled>
                                            <div class="invalid-feedback errornama">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jk" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="jk" name="jk" disabled>
                                                <option value="l">Laki-laki</option>
                                                <option value="p">Perempuan</option>
                                            </select>
                                            <div class="invalid-feedback errorjk">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_hp" class="col-sm-4 col-form-label">No HP</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-success">+62</span>
                                                </div>
                                                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= old('no_hp') ?>" placeholder="800 0000 0000" disabled>
                                                <div class="invalid-feedback errorno_hp">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer justify-content-between">
                                        <button type="submit" class="btn btn-success btn-save" disabled>Simpan</button>
                                </form>
                                <form action="<?= base_url('ortu') ?>" method="delete" id="form-hapus-ortu" class="d-inline float-right" data-target="">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="ortu_id" id="ortu_id_" disabled>
                                    <input type="hidden" name="nis" id="nis_" disabled>
                                    <button type="submit" class="btn btn-danger btn-hapus" disabled>Hapus</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">Data Ortu</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="viewdata-ortu">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div id="viewmodal" style="display: none;"></div>
            </div>
        </div>
</div>
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        getData('siswa/viewdata', '.viewdata')
        getData('ortu/viewdata', '.viewdata-ortu')
    });

    function isiForm(ortu_id, id, nama, no_hp, jk) {
        $('#form-ortu input, #form-ortu button, #form-ortu select').prop("disabled", false);
        $('#form-ortu #ortu_id').val(ortu_id);
        $('#form-ortu #nis').val(id);
        $('#form-ortu #nama').val(nama);
        $('#form-ortu #no_hp').val(no_hp);
        $('#form-ortu #jk').val(jk).change()
        $('#form-hapus-ortu').attr('data-target', nama)
        $('#ortu_id_').val(ortu_id);
        $('#nis_').val(id);
    }

    function resetForm() {
        $('#form-ortu input, #form-ortu button, #form-ortu select, #form-hapus-ortu button').prop("disabled", true);
        $('#form-ortu').trigger('reset');
    }

    // mengambil data table
    function getData(tujuan, taghtml) {
        $.ajax({
            url: `<?= base_url('/') ?>` + tujuan,
            dataType: "json",
            success: function(response) {
                $(taghtml).html(response.data);
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
    }



    $('#btn-create').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('siswa-create') ?>",
            dataType: "json",
            success: function(response) {
                $('#viewmodal').html(response.data).show();
                $('#modal-create').modal('show');
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


    function getOrtu(id) {
        $.ajax({
            type: "get",
            url: "<?= base_url('ortu') ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                let {
                    nama,
                    no_hp,
                    jk,
                    ortu_id
                } = response.data.data_ortu
                isiForm(ortu_id, id, nama, no_hp, jk)
            }
        });
    }

    function edit(id) {
        $.ajax({
            type: "get",
            url: "<?= site_url('siswa-update') ?>/" + id,
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('#viewmodal').html(response.data).show();
                    $('#modal-update').modal('show');
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
    }

    // form ortu
    $('#form-ortu').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btn-save').attr('disabled', 'disabled');
                $('.btn-save').html('<i class="fas fa-spinner fa-spin"></i> Simpan');
            },
            complete: function() {
                $('.btn-save').removeAttr('disabled');
                $('.btn-save').html('Simpan');
                $('.btn-save').prop('disabled', true)
            },
            success: function(response) {
                // console.log(response)
                if (response.error) {
                    response.error && response.error.nama ?
                        ($('#nama').addClass('is-invalid'), $('.errornama').html(response.error.nama)) :
                        ($('#nama').removeClass('is-invalid'), $('.errornama').html(''));
                    response.error && response.error.jk ?
                        ($('#jk').addClass('is-invalid'), $('.errorjk').html(response.error.jk)) :
                        ($('#jk').removeClass('is-invalid'), $('.errorjk').html(''));
                    response.error && response.error.no_hp ?
                        ($('#no_hp').addClass('is-invalid'), $('.errorno_hp').html(response.error.no_hp)) :
                        ($('#no_hp').removeClass('is-invalid'), $('.errorno_hp').html(''));
                } else {
                    response.status === true ? toastr.success(response.msg, 'Sukses') : toastr.error(response.msg, 'Error')
                    resetForm()
                    getData('siswa/viewdata', '.viewdata')
                    getData('ortu/viewdata', '.viewdata-ortu')
                }
            }
        });
    })

    // form hapus
    $('#form-hapus-ortu').on('submit', function(e) {
        e.preventDefault();
        const id = $(this).attr('data-target')
        swal.fire({
            title: 'Apakah anda yakin?',
            text: "Hapus data " + id,
            icon: 'warning',
            showCancelButton: true,
            showCloseButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                if (result.isConfirmed) {
                    $.ajax({
                        type: $(this).attr('method'),
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.success, 'Sukses')
                            } else {
                                toastr.error(response.error, 'Error')
                            }
                            resetForm()
                            getData('siswa/viewdata', '.viewdata')
                            getData('ortu/viewdata', '.viewdata-ortu')
                        }
                    });

                }
            }
        })
    })
</script>
<?= $this->endSection(); ?>