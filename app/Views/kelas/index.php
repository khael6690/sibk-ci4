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
                            <li>update data <?= $title; ?></li>
                            <li>delete data <?= $title; ?></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-sm-7">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">Data <?= $title; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="button" class="btn bg-gradient-primary btn-sm mb-3" id="create-kelas"><i class="fas fa-plus-circle"></i> Tambah</button>
                            <div class="viewdata">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div id="modal-kelas" style="display: none;"></div>
                </div>
                <div class="col-sm-5">
                    <div class="card">
                        <div class="card-header bg-danger">
                            <h3 class="card-title">Data Jurusan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="button" class="btn bg-gradient-danger btn-sm mb-3" id="create-jurusan"><i class="fas fa-plus-circle"></i> Tambah</button>
                            <div class="viewdatajurusan">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div id="modal-jurusan" style="display: none;"></div>
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
        getData('kelas/viewdata', '.viewdata')
        getData('jurusan/viewdata', '.viewdatajurusan')
    });

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

    $('#create-kelas').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('kelas-create') ?>",
            dataType: "json",
            success: function(response) {
                // console.log(response)
                $('#modal-kelas').html(response.data).show();
                $('#modal-create-kelas').modal('show');
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

    $('#create-jurusan').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('jurusan-create') ?>",
            dataType: "json",
            success: function(response) {
                // console.log(response)
                $('#modal-jurusan').html(response.data).show();
                $('#modal-create-jurusan').modal('show');
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

    function edit(tujuan, modal, formModal) {
        $.ajax({
            type: "GET",
            url: tujuan,

            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $(modal).html(response.data).show();
                    $(formModal).modal('show');
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
</script>
<?= $this->endSection(); ?>