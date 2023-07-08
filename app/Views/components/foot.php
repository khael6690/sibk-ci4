<!-- jQuery -->
<script src="<?= base_url() ?>assets/admin/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url() ?>assets/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url() ?>assets/admin/plugins/select2/js/select2.full.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url() ?>assets/admin/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>assets/admin/plugins/toastr/toastr.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url() ?>assets/admin/plugins/chart.js/Chart.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url() ?>assets/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url() ?>assets/admin/plugins/moment/moment.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Bootstrap Switch -->
<script src="<?= base_url() ?>assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url() ?>assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/admin/dist/js/adminlte.js"></script>
<script>
    const namaBulan = {
        0: 'Januari',
        1: 'Februari',
        2: 'Maret',
        3: 'April',
        4: 'Mei',
        5: 'Juni',
        6: 'Juli',
        7: 'Agustus',
        8: 'September',
        9: 'Oktober',
        10: 'November',
        11: 'Desember'
    };

    // Mendapatkan tanggal saat ini
    const tanggalSekarang = new Date();

    // Mendapatkan tanggal, bulan, dan tahun dari objek tanggal saat ini
    const tanggal = tanggalSekarang.getDate();
    const bulan = tanggalSekarang.getMonth();
    const tahun = tanggalSekarang.getFullYear();

    // Mengonversi bulan menjadi nama bulan dalam bahasa Indonesia
    const namaBulanIndonesia = namaBulan[bulan];

    // Format tanggal dalam format "30 Juni 2023"
    const tanggalFormatIndonesia = tanggal + ' ' + namaBulanIndonesia + ' ' + tahun;

    var namaApp = '<?= $_SESSION['nama'] ?>'
    var sekolah = '<?= $_SESSION['sekolah'] ?>'
    var alamat = '<?= $_SESSION['alamat'] ?>'
    var telepon = '<?= $_SESSION['telepon'] ?>'
    var email = '<?= $_SESSION['email'] ?>'

    $("[name='my-checkbox']").bootstrapSwitch();
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "500",
        "timeOut": "1000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });


    //function detail 
    function detail(id) {
        const tujuan = window.location.pathname + `/detail`;
        $.ajax({
            url: tujuan,
            type: "get",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                $('#modaldetail').html(response.data).show();
                $('#modal-detail').modal('show');
            }
        })
    }
</script>