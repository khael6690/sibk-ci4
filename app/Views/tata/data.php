<div class="table-responsive">
    <table id="tb-data" class="table table-bordered table-hover">
        <thead class="bg-secondary">
            <tr>
                <th style="width: 8%;">#</th>
                <th>Tata tertib</th>
                <th>Kategori</th>
                <?php if (has_permission('manage-data')) : ?>
                    <th>Action</th>
                <?php endif ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data_tata as $value) : ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $value['nama']; ?></td>
                    <td><?= $value['nama_kategori']; ?></td>
                    <?php if (has_permission('manage-data')) : ?>
                        <td>
                            <button class="btn btn-success btn-sm m-1" data-toggle="modal" onclick="detail(<?= $value['pelanggaran_id'] ?>)"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-warning btn-sm text-white m-1" onclick="edit('<?= site_url('tata-tertib/update/') . $value['pelanggaran_id']; ?>','#modal-tata','#modal-update-tata')"><i class="fas fa-edit"></i></button>
                            <form action="<?= base_url('tata-tertib') ?>" method="delete" class="d-inline form-hapus-tata" data-target="<?= $value['nama']; ?>">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="pelanggaran_id" value="<?= $value['pelanggaran_id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm text-white m-1"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    <?php endif ?>
                </tr>
            <?php
                $no++;
            endforeach; ?>
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
    $('.form-hapus-tata').on('submit', function(e) {
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
                            getData('tata-tertib/viewdata', '.viewdata')
                        }
                    });

                }
            }
        })
    })
</script>