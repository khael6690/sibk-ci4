<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $useAutoIncrement = false;
    protected $primaryKey = 'nis';
    protected $table            = 'siswa';
    protected $allowedFields    = ['nis', 'nama', 'kelas_id', 'ortu_id', 'jk', 'no_hp', 'alamat'];

    // Dates
    protected $useTimestamps = true;

    public function getSiswa($id = null)
    {
        if ($id === null) {
            $this->select('siswa.*, kelas.nama_kelas AS kelas, jurusan.nama_jurusan, jurusan.singkatan, ortu.nama AS ortu')
                ->join('kelas', 'kelas.kelas_id = siswa.kelas_id', 'LEFT')
                ->join('ortu', 'siswa.ortu_id = ortu.ortu_id', 'LEFT')
                ->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id', 'LEFT')
                ->orderBy('siswa.nis', 'ASC');
            return $this->get()->getResultArray();
        } else {
            $this->select('siswa.*, kelas.nama_kelas AS kelas, jurusan.nama_jurusan, jurusan.singkatan, ortu.nama AS ortu')
                ->join('kelas', 'kelas.kelas_id = siswa.kelas_id', 'LEFT')
                ->join('ortu', 'siswa.ortu_id = ortu.ortu_id', 'LEFT')
                ->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id', 'LEFT')
                ->where('siswa.nis', $id)
                ->orderBy('siswa.nis', 'ASC');
            return $this->first();
        }
    }

    public function getCount()
    {
        $this->select('siswa.nama AS nama_siswa, siswa.no_hp AS hp_siswa,siswa.alamat, K.nama_kelas, J.singkatan, G.nama AS guru , O.nama AS nama_ortu,COUNT(PS.nis) AS total, SUM(PS.panggil_ortu) AS panggilan')
            ->join('pelanggaran_siswa PS', 'PS.nis = siswa.nis', 'LEFT')
            ->join('kelas K', 'K.kelas_id = siswa.kelas_id', 'LEFT')
            ->join('guru G', 'K.guru_id = G.guru_id', 'LEFT')
            ->join('ortu O', 'siswa.ortu_id = O.ortu_id', 'LEFT')
            ->join('jurusan J', 'J.jurusan_id = K.jurusan_id', 'LEFT')
            ->groupBy('siswa.nis')
            ->having('total > 1')
            ->orderBy('total', 'DESC');
        return $this->get()->getResultArray();
    }
}
