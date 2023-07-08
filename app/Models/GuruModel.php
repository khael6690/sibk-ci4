<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table            = 'guru';
    protected $primaryKey       = 'guru_id';
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'alamat', 'jk', 'no_hp'];

    // Dates
    protected $useTimestamps = true;

    public function guruClass($id = null)
    {
        if ($id === null) {
            $this->select('guru.guru_id,guru.nama, guru.alamat, guru.jk, guru.no_hp, kelas.nama_kelas AS kelas, jurusan.nama_jurusan AS jurusan, jurusan.singkatan')
                ->join('kelas', 'guru.guru_id = kelas.guru_id', 'LEFT')
                ->join('jurusan', 'kelas.jurusan_id = jurusan.jurusan_id', 'LEFT');
            return $this->get()->getResultArray();
        } else {
            $this->select('guru.guru_id,guru.nama, guru.alamat, guru.jk, guru.no_hp, kelas.nama_kelas AS kelas, jurusan.nama_jurusan AS jurusan, jurusan.singkatan')
                ->join('kelas', 'guru.guru_id = kelas.guru_id', 'LEFT')
                ->join('jurusan', 'kelas.jurusan_id = jurusan.jurusan_id', 'LEFT');
            $this->where('guru.guru_id', $id);
            return $this->first();
        }
    }
}
