<div class="table-responsive">
    <table id="tb-data" class="table table-bordered table-hover">
        <thead class="bg-secondary">
            <tr>
                <th style="width: 5%;">No</th>
                <th>Nama</th>
                <th>Ortu</th>
                <th>Tanggal</th>
                <th>Tanggal Kehadiran</th>
                <?php if (has_permission('manage-data')) : ?>
                    <th>Kehadiran</th>
                    <th>Action</th>
                <?php endif ?>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($data_panggilan as $value) : ?>
                <tr>
                    <td><?= $no++; ?> </td>
                    <td><?= $value['nama_siswa']; ?></td>
                    <td><?= $value['nama_ortu']; ?></td>
                    <td><?= $value['tanggal']; ?></td>
                    <td><?= $value['tgl_hadir']; ?></td>
                    <?php if (has_permission('manage-data')) : ?>
                        <td>
                            <form action="<?= base_url('panggilan/status/') . $value['panggilan_id']; ?>" data-target="<?= $value['nama_siswa'] ?>" method="post" class="d-inline form-status">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="POST">
                                <button type="submit" class="btn btn-sm <?= $value['status'] == 1 ? 'btn-success' : 'btn-danger'; ?>"><?= $value['status'] == 1 ? 'Hadir' : 'Tidak Hadir'; ?></button>
                            </form>
                        </td>
                        <td>
                            <form action="<?= base_url('panggilan/id/') . $value['panggilan_id']; ?>" data-target="<?= $value['nama_siswa'] ?>" method="delete" class="d-inline form-hapus">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="delete">
                                <button type="submit" class="btn btn-danger btn-sm text-white m-1"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    <?php endif ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $("#tb-data").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            dom: "<'row'<'col-sm-6 awal'l><'col-sm-6'f>>" +
                "<'row'<'col-sm-12't>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            initComplete: function() {
                <?php if (has_permission('manage-data')) : ?>
                    $(`<p class="m-1">Hapus telah hadir pada bulan ini :</p>
                            <form action="<?= base_url('panggilan') ?>" method="DELETE" class="d-inline" id="form-hadir">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-primary">Hapus</button>
                            </form>`)
                        .appendTo('#tb-data_wrapper .awal');

                    $('#form-hadir').on('submit', function(e) {
                        e.preventDefault()
                        swal.fire({
                            title: 'Apakah anda yakin?',
                            text: "Hapus data telah hadir",
                            icon: 'warning',
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
                    <?php endif; ?>
                    });
            }
        })
    });

    // tombol status
    $('.form-status').submit(function(e) {
        e.preventDefault();
        const id = $(this).attr('data-target');
        swal.fire({
            title: 'Apakah anda yakin?',
            text: "Ubah status " + id,
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


    // form hapus
    $('.form-hapus').submit(function(e) {
        e.preventDefault();
        const nama = $(this).attr('data-target');
        swal.fire({
            title: 'Apakah anda yakin?',
            text: "Hapus data panggilan " + nama,
            icon: 'warning',
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