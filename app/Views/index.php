<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- section small box -->
      <div class="row justify-content-center">
        <div class="col-lg-3 col-sm-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h4 id="guru-box"></h4>

              <p>Guru</p>
            </div>
            <div class="icon">
              <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <?php if (in_groups('admin')) : ?>
              <a href="<?= base_url('guru') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            <?php endif; ?>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h4 id="siswa-box"></h4>

              <p>Siswa</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <?php if (in_groups('admin')) : ?>
            <a href="<?= base_url('siswa') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            <?php endif ?>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6">
          <!-- small box -->
          <div class="small-box bg-dark">
            <div class="inner">
              <h4 id="kelas-box"></h4>

              <p>Kelas</p>
            </div>
            <div class="icon">
              <i class="fas fa-book-reader"></i>
            </div>
            <?php if (in_groups('admin')) : ?>
            <a href="<?= base_url('kelas') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            <?php endif ?>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h4 id="pelanggaran-box"> </h4>

              <p>Pelanggaran <span>bulan <?= date('F'); ?></span></p>
            </div>
            <div class="icon">
              <i class="fas fa-users-slash"></i>
            </div>
            <?php if (in_groups('admin')) : ?>
            <a href="<?= base_url('pelanggaran') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            <?php endif ?>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- ./row -->
      <div class="row justify-content-center">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header bg-primary">
              <h3 class="card-title">Riwayat siswa yang sering melakukan pelanggaran</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i>Siswa yang sering melanggar!</h5>
                Data siswa yang melakukan pelanggaran lebih dari 1x akan ditampilkan!
              </div>
              <div class="viewdata">
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <div id="viewmodal" style="display: none;"></div>

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
    getData()
    getRows()
  });

  // mengambil data table
  function getData() {
    $.ajax({
      url: "<?= site_url('/viewdata') ?>",
      dataType: "json",
      success: function(response) {
        $('.viewdata').html(response.data);
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

  function getRows() {
    $.ajax({
      type: "get",
      url: "<?= base_url('/count') ?>",
      dataType: "json",
      beforeSend: function() {
        $('#guru-box').html('<i class="fas fa-spinner fa-spin"></i>');
        $('#siswa-box').html('<i class="fas fa-spinner fa-spin"></i>');
        $('#kelas-box').html('<i class="fas fa-spinner fa-spin"></i>');
        $('#pelanggaran-box').html('<i class="fas fa-spinner fa-spin"></i>');
      },
      success: function(response) {
        // console.log(response)
        if (response.status == true) {
          $('#guru-box').html(response.data.guru);
          $('#siswa-box').html(response.data.siswa);
          $('#kelas-box').html(response.data.kelas);
          $('#pelanggaran-box').html(response.data.pelanggaran);
        }
      }
    });
  }
</script>
<?= $this->endSection(); ?>