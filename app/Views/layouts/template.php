<!DOCTYPE html>
<html lang="en">

<?= $this->include('components/head'); ?>

<body class="hold-transition sidebar-mini-xs sidebar-collapse layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?= $this->include('components/navbar'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->include('components/sidebar'); ?>
        <!-- /.Main Sidebar Container -->

        <!-- Content Wrapper. Contains page content -->
        <?= $this->renderSection('content'); ?>
        <!-- /.content-wrapper -->

        <?= $this->include('components/footer'); ?>


    </div>
    <!-- ./wrapper -->
    <?= $this->include('components/foot'); ?>
    <?= $this->renderSection('script'); ?>
</body>

</html>