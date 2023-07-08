<div class="table-responsive">
    <table id="tb-data" class="table table-bordered table-hover">
        <thead class="bg-secondary">
            <tr>
                <th style="width: 5%;">No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jumlah -</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($data_pelanggaran as $value) : ?>
                <tr>
                    <td><?= $no++; ?> </td>
                    <td><?= $value['nama_siswa']; ?></td>
                    <td><?= $value['nama_kelas']; ?> - <?= $value['singkatan']; ?></td>
                    <td><?= $value['total']; ?></td>
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
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', {
                        extend: 'print',
                        text: 'Print',
                        title: '<h3 style="text-align: center;" class="mb-3">Data Siswa yang sering melanggar</h3>',
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
                                                <p>(.............................)</p>
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
                                toastr.error(response.fail, 'Error')
                            }
                            getData();
                        }
                    });

                }
            }
        })
    })
</script>