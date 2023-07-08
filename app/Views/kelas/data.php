<div class="table-responsive">
    <table id="tb-data" class="table table-bordered table-hover">
        <thead class="bg-secondary">
            <tr>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Wali</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($data_kelas as $value) : ?>
                <tr>
                    <td><?= $value['nama_kelas']; ?></td>
                    <td><?= $value['nama_jurusan']; ?> - <?= $value['singkatan']; ?></td>
                    <td><?= $value['wali']; ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm text-white m-1" onclick="edit('<?= site_url('kelas-update/') . $value['kelas_id']; ?>','#modal-kelas','#modal-update-kelas')"><i class="fas fa-edit"></i></button>
                        <form action="<?= base_url('kelas') ?>" method="delete" class="d-inline form-hapus-kelas" data-target="<?= $value['nama_kelas'] . " - " . $value['singkatan']; ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="kelas_id" value="<?= $value['kelas_id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm text-white m-1"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
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
            "autoWidth": false
        })
    });

    // form hapus
    $('.form-hapus-kelas').on('submit', function(e) {
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
                            getData('kelas/viewdata', '.viewdata')
                        }
                    });

                }
            }
        })
    })
</script>