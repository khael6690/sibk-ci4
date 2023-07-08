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
            <!-- /.row -->
            <div class="row justify-content-center">
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">Data Ketegori</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-info"></i> Halaman pengelolahan data <?= $title; ?></h5>
                                <ul>
                                    <li>add data <?= $title; ?></li>
                                    <li>detail data <?= $title; ?></li>
                                    <li>update data <?= $title; ?></li>
                                    <li>delete data <?= $title; ?></li>
                                </ul>
                            </div>
                            <?php if (has_permission('manage-data')) : ?>
                                <button type="button" class="btn bg-gradient-primary btn-sm mb-3" id="create-kategori"><i class="fas fa-plus-circle"></i> Tambah</button>
                            <?php endif; ?>
                            <div class="datakategori">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div id="modal-kategori" style="display: none;"></div>

                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-danger">
                            <h3 class="card-title">Data <?= $title; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if (has_permission('manage-data')) : ?>
                                <button type="button" class="btn bg-gradient-danger btn-sm mb-3" id="create-tata"><i class="fas fa-plus-circle"></i> Tambah</button>
                            <?php endif; ?>
                            <div class="viewdata">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div id="modal-tata" style="display: none;"></div>
                    <div id="modaldetail" style="display: none;"></div>
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
        getData('tata-tertib/viewdata', '.viewdata')
        getData('kategori/viewdata', '.datakategori')
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

    $('#create-tata').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('tata-tertib/create') ?>",
            dataType: "json",
            success: function(response) {
                // console.log(response)
                $('#modal-tata').html(response.data).show();
                $('#modal-create-tata').modal('show');
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

    $('#create-kategori').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('kategori/create') ?>",
            dataType: "json",
            success: function(response) {
                // console.log(response)
                $('#modal-kategori').html(response.data).show();
                $('#modal-create-kategori').modal('show');
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