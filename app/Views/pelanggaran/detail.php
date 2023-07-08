<div class="modal fade" id="modal-detail">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Detail <?= $title; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-2">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/img/user.png') ?>" alt="userimg">
                </div>

                <h3 class="profile-username text-center"><?= $data_pelanggaran['nama_siswa']; ?></h3>

                <p class="text-muted text-center"><?= $data_pelanggaran['nama_kelas']; ?> - <?= $data_pelanggaran['singkatan']; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>NIS</b>
                        <p class="float-right"><?= $data_pelanggaran['nis']; ?></p>
                    </li>
                    <li class="list-group-item">
                        <b>Wali Kelas</b>
                        <p class="float-right"><?= $data_pelanggaran['guru']; ?></p>
                    </li>
                    <li class="list-group-item">
                        <b>Alamat</b>
                        <p class="float-right"><?= $data_pelanggaran['alamat']; ?></p>
                    </li>
                    <li class="list-group-item">
                        <b>No HP</b>
                        <p class="float-right"><?= $data_pelanggaran['hp_siswa']; ?></p>
                    </li>
                    <li class="list-group-item">
                        <b>Pelanggaran</b>
                        <p><?= $data_pelanggaran['nama_pelanggaran']; ?></p>
                    </li>
                    <li class="list-group-item">
                        <b>Keterangan</b>
                        <p><?= $data_pelanggaran['keterangan']; ?></p>
                    </li>
                    <li class="list-group-item">
                        <b>Tindakan</b>
                        <p><?= $data_pelanggaran['tindakan']; ?></p>
                    </li>
                </ul>
            </div>
            <div class="modal-footer justify-content-between">
                <form action="<?= base_url('pelanggaran/panggilan/') ?>" data-target="<?= $data_pelanggaran['nama_siswa'] ?>" method="post" id="form-panggilan" class="d-inline">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="nis" value="<?= $data_pelanggaran['nis']; ?>">
                    <input type="hidden" name="keterangan" value="<?= $data_pelanggaran['keterangan']; ?>">
                    <button type="submit" class="btn btn-warning text-white">Panggil Orang Tua</button>
                </form>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    // tombol status
    $('#form-panggilan').submit(function(e) {
        e.preventDefault();
        const id = $(this).attr('data-target');
        swal.fire({
            title: 'Apakah anda yakin?',
            text: "Panggil Ortu " + id,
            icon: 'question',
            showCancelButton: true,
            showCloseButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = $(this)
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            response.success ?
                                toastr.success(response.success, 'Sukses') :
                                toastr.error(response.fail, 'Error')
                            getData();
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
        })
    })
</script>