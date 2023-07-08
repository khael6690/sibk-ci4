<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table            = 'kelas';
    protected $primaryKey       = 'kelas_id';
    protected $allowedFields    = ['jurusan_id', 'guru_id', 'nama_kelas'];
    // Dates
    protected $useTimestamps = true;

    public function getKelas($id = null)
    {
        if ($id === null) {
            $this->select('kelas.kelas_id, kelas.jurusan_id, kelas.guru_id, kelas.nama_kelas, jurusan.nama_jurusan, jurusan.singkatan, guru.nama AS wali')
                ->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id', 'LEFT')
                ->join('guru', 'guru.guru_id = kelas.guru_id', 'LEFT');
            return $this->get()->getResultArray();
        } else {
            $this->select('kelas.kelas_id, kelas.jurusan_id, kelas.guru_id, kelas.nama_kelas, jurusan.nama_jurusan, jurusan.singkatan, guru.nama AS wali')
                ->join('jurusan', 'jurusan.jurusan_id = kelas.jurusan_id', 'LEFT')
                ->join('guru', 'guru.guru_id = kelas.guru_id', 'LEFT')
                ->where('kelas.kelas_id', $id);
            return $this->get()->getResultArray();
        }
    }
}
