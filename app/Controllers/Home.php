<?php

namespace App\Controllers;

use App\Models\GuruModel;
use App\Models\KategoriModel;
use App\Models\KelasModel;
use App\Models\PelanggaranModel;
use App\Models\PelSiswaModel;
use App\Models\SiswaModel;

define('_TITLE', 'Dashboard');

class Home extends BaseController
{
    private $m_pelanggaran, $m_tata, $m_kategori, $m_siswa, $m_guru, $m_kelas;
    public function __construct()
    {
        $this->m_pelanggaran = new PelSiswaModel();
        $this->m_guru = new GuruModel();
        $this->m_kategori = new KategoriModel();
        $this->m_siswa = new SiswaModel();
        $this->m_tata = new PelanggaranModel();
        $this->m_kelas = new KelasModel();
    }

    public function index()
    {
        $data = [
            "title" => _TITLE
        ];
        return view('index', $data);
    }

    public function viewdata()
    {
        if ($this->request->isAJAX()) {
            $data_pelanggaran = $this->m_siswa->getCount();
            $data = [
                'data_pelanggaran' => $data_pelanggaran
            ];

            $msg = [
                'data' => view('data', $data)
            ];
            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function count()
    {
        if ($this->request->isAJAX()) {
            $guru = $this->m_guru->countAllResults();
            $siswa = $this->m_siswa->countAllResults();
            $kelas = $this->m_kelas->countAllResults();
            $pelanggaran = $this->m_pelanggaran->where('MONTH(pelanggaran_siswa.created_at) = MONTH(CURDATE())')->countAllResults();

            $data = [
                'guru' => $guru,
                'siswa' => $siswa,
                'kelas' => $kelas,
                'pelanggaran' => $pelanggaran
            ];
            $json = [
                'data' => $data,
                'status' => true
            ];

            return $this->response->setJSON($json);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
