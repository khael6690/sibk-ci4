<div class="table-responsive">
    <table id="tb-data2" class="table table-bordered table-hover">
        <thead class="bg-secondary">
            <tr>
                <th>Jurusan</th>
                <th>Singkatan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($data_jurusan as $value) : ?>
                <tr>
                    <td><?= $value['nama_jurusan']; ?></td>
                    <td><?= $value['singkatan']; ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm text-white m-1" onclick="edit('<?= base_url('jurusan-update/') . $value['jurusan_id']; ?>','#modal-jurusan','#modal-update-jurusan')"><i class="fas fa-edit"></i></button>
                        <form action="<?= base_url('jurusan') ?>" method="delete" class="d-inline form-hapus-jurusan" data-target="<?= $value['nama_jurusan']; ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="jurusan_id" value="<?= $value['jurusan_id']; ?>">
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
        $("#tb-data2").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
        })
    });

    // form hapus
    $('.form-hapus-jurusan').on('submit', function(e) {
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
                                toastr.error(response.error,'Error')
                            }
                            getData('jurusan/viewdata', '.viewdatajurusan')
                        }
                    });

                }
            }
        })
    })
</script>