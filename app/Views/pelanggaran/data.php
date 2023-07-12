<div class="table-responsive">
    <table id="tb-data" class="table table-bordered table-hover">
        <thead class="bg-secondary">
            <tr>
                <th style="width: 5%;">No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Pelanggaran</th>
                <th>Tanggal</th>
                <th>Bobot</th>
                <?php if (has_permission('manage-data')) : ?>
                    <th>Status</th>
                <?php endif ?>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($data_pelanggaran as $value) : ?>
                <tr>
                    <td><?= $no++; ?> </td>
                    <td><?= $value['nama_siswa']; ?></td>
                    <td><?= $value['nama_kelas']; ?> - <?= $value['singkatan']; ?></td>
                    <td><?= $value['nama_pelanggaran']; ?></td>
                    <td><?= $value['tanggal']; ?></td>
                    <td>
                        <?php if ($value['bobot'] == 1) {
                            echo '<span class="badge badge-warning">Ringan</span>';
                        } elseif ($value['bobot'] == 2) {
                            echo '<span class="badge bg-orange">Menengah</span>';
                        } else {
                            echo '<span class="badge badge-danger">Berat</span>';
                        } ?>
                    </td>
                    <?php if (has_permission('manage-data')) : ?>
                        <td>
                            <form action="<?= base_url('pelanggaran/status/') . $value['pelsiswa_id']; ?>" data-target="<?= $value['nama_siswa'] ?>" method="post" class="d-inline form-status">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="POST">
                                <button type="submit" class="btn btn-sm <?= $value['status'] == 1 ? 'btn-success' : 'btn-danger'; ?>"><?= $value['status'] == 1 ? 'selesai' : 'belum'; ?></button>
                            </form>
                        </td>
                    <?php endif ?>
                    <td>
                        <button class="btn btn-success btn-sm m-1" data-toggle="modal" onclick="detail(<?= $value['pelsiswa_id'] ?>)"><i class="fas fa-eye"></i></button>
                        <?php if (has_permission('manage-data')) : ?>
                            <button class="btn btn-warning btn-sm text-white m-1" onclick="edit('<?= $value['pelsiswa_id']; ?>')"><i class="fas fa-edit"></i></button>
                        <?php endif ?>
                        <?php if (has_permission('manage-data')) : ?>
                            <form action="<?= base_url('pelanggaran') ?>" method="delete" class="d-inline form-hapus" data-target="<?= $value['nama_siswa'] . " " . $value['nama_kelas'] . "-" . $value['singkatan']; ?>">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="pelsiswa_id" value="<?= $value['pelsiswa_id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm text-white m-1"><i class="fas fa-trash"></i></button>
                            </form>
                        <?php endif ?>
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
            "autoWidth": false,
            <?php if (in_groups('admin')) : ?>
                dom: "<'row'<'col-sm-12 col-md-6' B l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    'excel', 'pdf', {
                        extend: 'print',
                        text: 'Print',
                        title: '<h3 style="text-align: center;" class="mb-3">Data Pelanggaran Siswa</h3>',
                        exportOptions: {
                            columns: ':visible'
                        },
                        customize: function(win) {
                            const header = ` <div class="row mb-3">
                                            <div class="col">
                                                <h3 class="text-center font-weight-bold">${namaApp}</h3>
                                                <h2 class="text-center p-0 m-0">${sekolah}</h2>
                                                <p class="text-center p-0 m-0 font-weight-light">${alamat}</p>
                                                <p class="text-center p-0 m-0 font-weight-light">Telepon: ${telepon}, Email: ${email}</p>
                                                <hr>
                                            </div>
                                        </div>`;
                            const footer = ` <div class="row justify-content-end mt-5">
                                            <div class="col-sm-2">
                                                <p class="font-weight-light">Cirebon, ${tanggalFormatIndonesia}</p>
                                                <br>
                                                <br>
                                                <br>
                                                <p>(..............................)</p>
                                            </div>
                                        </div>`;
                            $(win.document.body).prepend(header);
                            $(win.document.body).append(footer);
                            $(win.document.body).css('font-family', 'Propins, sans-serif');
                        }
                    }, {
                        extend: 'colvis',
                        text: 'Tampilan kolom'
                    },
                ]
            <?php endif; ?>
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
                            getData();
                        }
                    });

                }
            }
        })
    })

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
</script>