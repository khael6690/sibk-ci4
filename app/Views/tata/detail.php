<div class="modal fade" id="modal-detail">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Detail Tata tertib</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- card -->
                <div class="card card-primary">
                    <div class="card-body">
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Tata tertib</b>
                                <p class="float-right"><?= $data_tata['nama']; ?></p>
                            </li>
                            <li class="list-group-item">
                                <b>Kategori</b>
                                <p class="float-right"><?= $data_tata['nama_kategori']; ?></p>
                            </li>
                            <li class="list-group-item">
                                <b>bobot</b>
                                <p class="float-right">
                                    <?php
                                    if ($data_tata['bobot'] == 1) {
                                        echo "<span class='badge bg-warning'>Ringan</span>";
                                    } elseif ($data_tata['bobot'] == 2) {
                                        echo "<span class='badge bg-orange'>Menengah</span>";
                                    } else {
                                        echo "<span class='badge bg-danger'>Berat</span>";
                                    }
                                    ?>
                                </p>
                            </li>
                            <li class="list-group-item">
                                <b>Deskripsi</b>
                                <p><?= $data_tata['deskripsi']; ?></p>
                            </li>
                            <li class="list-group-item">
                                <b>Hukuman</b>
                                <p><?= $data_tata['hukuman']; ?></p>
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