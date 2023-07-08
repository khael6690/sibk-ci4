<table id="tb-users" class="table table-bordered table-striped tb-data">
    <thead>
        <tr>
            <th style="width: 5%;">No</th>
            <th>Username</th>
            <th>Nama lengkap</th>
            <th>Email</th>
            <th>Config</th>
            <th style="width: 10%;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($data_users as $value) : ?>
            <tr>
                <td><?= $no++; ?> </td>
                <td><?= $value->username; ?></td>
                <td><?= $value->fullname; ?></td>
                <td><?= $value->email; ?></td>
                <td>
                    <?php if ($value->id !== user_id()) : ?>
                        <form action="<?= base_url('users/active/' . $value->id) ?>" method="post" data-target="<?= $value->username ?>" class="d-inline form-status">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="POST">
                            <button class="btn btn-sm text-white <?= $value->active == 1 ? 'btn-success' : 'btn-danger' ?>"><?= $value->active == 1 ? 'ON' : 'OFF' ?></button>
                        </form>
                    <?php endif; ?>
                    <form action="<?= base_url('users/reset/' . $value->id) ?>" data-target="<?= $value->username ?>" method="post" class="d-inline form-reset">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="POST">
                        <button class="btn btn-info btn-sm text-white"><i class="fas fa-key"></i> Reset</button>
                    </form>
                </td>

                <td>
                    <?php if ($value->id !== user_id()) : ?>
                        <form action="<?= base_url('users/' . $value->id) ?>" data-target="<?= $value->username ?>" method="delete" class="d-inline form-hapus">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger btn-sm text-white"><i class="fas fa-trash"></i></button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {

        $("#tb-users").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        })

    });

    // tombol aktif
    $('.form-status').submit(function(e) {
        e.preventDefault();
        const username = $(this).attr('data-target');
        swal.fire({
            title: 'Apakah anda yakin?',
            text: "Ubah status " + username,
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

    // tombol resetpass
    $('.form-reset').submit(function(e) {
        e.preventDefault();
        const username = $(this).attr('data-target');
        swal.fire({
            title: 'Apakah anda yakin?',
            text: "Reset password " + username,
            icon: 'warning',
            showCancelButton: true,
            showCloseButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Reset',
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

    // tombol hapus
    $('.form-hapus').on('submit', function(e) {
        e.preventDefault();
        const username = $(this).attr('data-target');
        swal.fire({
            title: 'Apakah anda yakin?',
            text: "Hapus data " + username,
            icon: 'warning',
            showCancelButton: true,
            showCloseButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus!',
            cancelButtonText: 'Tidak!'
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
                    }
                });

            }
        })
    })
</script>