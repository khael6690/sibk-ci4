<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $_SESSION['nama'] ?> | Surat Panggilan</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/admin/dist/css/adminlte.min.css">
</head>

<body>
    <div class="wrapper">
        <?= $this->renderSection('content'); ?>
    </div>
    <!-- ./wrapper -->

    <!-- Page specific script -->
    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/admin/plugins/jquery/jquery.min.js"></script>
    <!-- load window print -->
    <script>
        $(document).ready(function() {
            window.print()
        });
    </script>
</body>

</html>