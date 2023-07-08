<div class="table-responsive">
    <table id="tb-data" class="table table-bordered table-hover">
        <thead class="bg-secondary">
            <tr>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($data_siswa as $value) : ?>
                <tr>
                    <td><?= $value['nis']; ?></td>
                    <td><?= $value['nama']; ?></td>
                    <td><?= $value['kelas']; ?> - <?= $value['singkatan']; ?></td>
                    <td>
                        <button class="btn btn-success btn-sm m-1" data-toggle="modal" onclick="detail(<?= $value['nis'] ?>)"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-warning btn-sm text-white m-1" onclick="edit('<?= $value['nis']; ?>')"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-primary btn-sm text-white m-1" onclick="getOrtu(<?= $value['nis']; ?>)"><i class="fas fa-user"></i></button>
                        <form action="<?= base_url('siswa') ?>" method="delete" class="d-inline form-hapus" data-target="<?= $value['nama']; ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="nis" value="<?= $value['nis']; ?>">
                            <input type="hidden" name="ortu_id" value="<?= $value['ortu_id']; ?>">
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
    $('.form-hapus').on('submit', function(e) {
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
                            resetForm()
                            getData('siswa/viewdata', '.viewdata')
                            getData('ortu/viewdata', '.viewdata-ortu')
                        }
                    });

                }
            }
        })
    })
</script>