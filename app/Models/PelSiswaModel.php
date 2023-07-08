<?php

namespace App\Models;

use CodeIgniter\Model;

class PelSiswaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pelanggaran_siswa';
    protected $primaryKey       = 'pelsiswa_id';
    protected $allowedFields    = ['nis', 'pelanggaran_id', 'keterangan', 'tindakan', 'panggil_ortu', 'status'];
    // Dates
    protected $useTimestamps = true;

    public function getPelanggaran($id = null)
    {
        if ($id === null) {
            $this->select('pelanggaran_siswa.*,DATE_FORMAT(pelanggaran_siswa.created_at, "%e %M %Y") AS tanggal, P.kategori_id, S.nama AS nama_siswa, S.no_hp AS hp_siswa,S.alamat, K.nama_kelas, J.singkatan, G.nama AS guru, P.nama AS nama_pelanggaran,P.bobot , O.nama AS nama_ortu')
                ->join('pelanggaran P', 'pelanggaran_siswa.pelanggaran_id = P.pelanggaran_id', 'LEFT')
                ->join('siswa S', 'pelanggaran_siswa.nis = S.nis', 'LEFT')
                ->join('ortu O', 'S.ortu_id = O.ortu_id')
                ->join('kelas K', 'S.kelas_id = K.kelas_id', 'LEFT')
                ->join('jurusan J', 'J.jurusan_id = K.jurusan_id', 'LEFT')
                ->join('guru G', 'K.guru_id = G.guru_id', 'LEFT');
            return $this->get()->getResultArray();
        } else {
            $this->select('pelanggaran_siswa.*,DATE_FORMAT(pelanggaran_siswa.created_at, "%e %M %Y") AS tanggal, P.kategori_id, S.nama AS nama_siswa, S.no_hp AS hp_siswa,S.alamat, K.nama_kelas, J.singkatan, G.nama AS guru, P.nama AS nama_pelanggaran,P.bobot , O.nama AS nama_ortu')
                ->join('pelanggaran P', 'pelanggaran_siswa.pelanggaran_id = P.pelanggaran_id', 'LEFT')
                ->join('siswa S', 'pelanggaran_siswa.nis = S.nis', 'LEFT')
                ->join('ortu O', 'S.ortu_id = O.ortu_id')
                ->join('kelas K', 'S.kelas_id = K.kelas_id', 'LEFT')
                ->join('jurusan J', 'J.jurusan_id = K.jurusan_id', 'LEFT')
                ->join('guru G', 'K.guru_id = G.guru_id', 'LEFT')
                ->where('pelanggaran_siswa.pelsiswa_id', $id);
            return $this->first();
        }
    }

    public function getPanggilan($id)
    {
        $this->select('pelanggaran_siswa.*,DATE_FORMAT(pelanggaran_siswa.created_at, "%e %M %Y") AS tanggal, P.kategori_id, S.nama AS nama_siswa, S.no_hp AS hp_siswa,S.alamat, K.nama_kelas, J.singkatan, G.nama AS guru, P.nama AS nama_pelanggaran, O.nama AS nama_ortu')
            ->join('pelanggaran P', 'pelanggaran_siswa.pelanggaran_id = P.pelanggaran_id', 'LEFT')
            ->join('siswa S', 'pelanggaran_siswa.nis = S.nis', 'LEFT')
            ->join('ortu O', 'S.ortu_id = O.ortu_id')
            ->join('kelas K', 'S.kelas_id = K.kelas_id', 'LEFT')
            ->join('jurusan J', 'J.jurusan_id = K.jurusan_id', 'LEFT')
            ->join('guru G', 'K.guru_id = G.guru_id', 'LEFT')
            ->where('pelanggaran_siswa.panggil_ortu', $id);
        return $this->get()->getResultArray();
    }
}
