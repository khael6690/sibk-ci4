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
            <div class="row">
                <div class="col-sm-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/img/user.png') ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= user()->fullname; ?></h3>

                            <p class="text-muted text-center"><?= $group[0]['name'] ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Username</b>
                                    <p class="float-right"><?= user()->username ?></p>
                                </li>
                                <li class="list-group-item">
                                    <b>Nama Lengkap</b>
                                    <p class="float-right"><?= user()->fullname ?></p>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b>
                                    <p class="float-right"><?= user()->email ?></p>
                                </li>
                                <li class="list-group-item">
                                    <b>Role</b>
                                    <p class="float-right"><?= $group[0]['name'] ?></p>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title"><?= $title; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="true">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-content-below-password-tab" data-toggle="pill" href="#custom-content-below-password" role="tab" aria-controls="custom-content-below-password" aria-selected="false">Password</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="custom-content-below-tabContent">
                                <div class="tab-pane fade show active" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                    <div class="form-user"></div>
                                </div>
                                <div class="tab-pane fade" id="custom-content-below-password" role="tabpanel" aria-labelledby="custom-content-below-password-tab">
                                    <div class="form-pass"></div>
                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection('content'); ?>
<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        getData('setting/user', '.form-user')
        getData('setting/pass', '.form-pass')
    });

    // mengambil data 
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
</script>
<?= $this->endSection('script'); ?>