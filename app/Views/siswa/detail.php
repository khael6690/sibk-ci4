<div class="modal fade" id="modal-detail">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Detail <?= $title; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- card -->
                <div class="card card-primary">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/img/user.png') ?>" alt="userimg">
                        </div>

                        <h3 class="profile-username text-center"><?= $data_siswa['nama']; ?></h3>

                        <p class="text-muted text-center"><?= $data_siswa['nis']; ?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Nama Lengkap</b>
                                <p class="float-right"><?= $data_siswa['nama']; ?></p>
                            </li>
                            <li class="list-group-item">
                                <b>Kelas</b>
                                <p class="float-right"><?= $data_siswa['kelas'] . " - " . $data_siswa['singkatan']; ?></p>
                            </li>
                            <li class="list-group-item">
                                <b>Orang tua</b>
                                <p class="float-right"><?= $data_siswa['ortu']; ?></p>
                            </li>
                            <li class="list-group-item">
                                <b>Alamat</b>
                                <p class="float-right"><?= $data_siswa['alamat']; ?></p>
                            </li>
                            <li class="list-group-item">
                                <b>Jenis Kelamin</b>
                                <p class="float-right"><?= ($data_siswa['jk'] === 'l' ? "Laki - laki" : "Perempuan"); ?></p>
                            </li>
                            <li class="list-group-item">
                                <b>No HP</b>
                                <p class="float-right"><?= $data_siswa['no_hp']; ?></p>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->