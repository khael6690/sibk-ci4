<?= $this->extend('layouts/print'); ?>
<?= $this->section('content'); ?>
<!-- Main content -->
<section>
    <div class="container mt-4">
        <!-- title row -->
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h4 class="font-weight-bold m-0">PEMERINTAH KABUPATEN CIREBON</h4>
                <h4 class="font-weight-bold m-0">DINAS PENDIDIKAN</h4>
                <h2 class="font-weight-bold m-0"><?= $_SESSION['sekolah'] ?></h2>
                <p class="font-weight-normal m-0">Alamat: <?= $_SESSION['alamat'] ?></p>
                <p class="font-weight-normal">Telepon: <?= $_SESSION['telepon'] ?>, Email: <?= $_SESSION['email'] ?></p>
                <hr>
            </div>
            <!-- /.col -->
        </div>
        <div class="row justify-content-start">
            <div class="col-12">
                <p>Perihal : Pemberitahuan</p>
                <p>Kepada:</p>
                <p>Yth: Bapak/Ibu Orang Tua/Wali</p>
                <p class="ml-3"><span class="font-weight-bold">a.n</span> <span class="text-capitalize"><?= $siswa['nama_siswa']; ?></span></p>
                <p class="ml-3">di Tempat</p>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-12">
                <p class="font-italic">Dengan Hormat,</p>
                <p class="mt-2">
                    Puji Syukur kita panjatkan Kehadirat Tuhan Yang Maha Esa atas segala nikmat dan anugerah-nya kepada
                    kita. Untuk menjalin hubungan dan komunikasi yang baik antara orang tua/wali siswa dengan pihak
                    sekolah dalam rangka tanggung jawab bersama dalam mendidik dan melatih anak kita ke arah yang
                    baik,maka dengan ini kami pihak sekolah perlu memanggil Bapak/Ibu Orang Tua/wali siswa bahwa siswa
                    yang bersangkutan telah melakukan pelanggaran tata tertib sekolah.
                </p>
                <p class="mt-2">
                    Demikian Surat pemberitahuan ini kami sampaikan untuk dapat diketahui oleh orang tua/wali siswa,atas
                    perhatian dan kerjasamanya diucapkan terima kasih.
                </p>
            </div>
        </div>
        <div class="row justify-content-between mt-5 mb-5">
            <div class="col-3 text-center">
                <br>
                <p>Mengetahui,</p>
                <p>Kepala Sekolah,</p>
                <br>
                <br>
                <br>
                <p>…………………. </p>
                <p>NIP. ………………………</p>
            </div>
            <div class="col-3">
                <p class="text-center"><?= $_SESSION['kota'] ?> <?= $tgl; ?></p>
                <br>
                <p class="text-center">Guru Bimbingan Konseling</p>
                <br>
                <br>
                <br>
                <p class="text-center"><?= user()->fullname ?></p>
                <p class="text-center">NIP………………………</p>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<?= $this->endSection('content'); ?>