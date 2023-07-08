<?php

namespace App\Models;

use CodeIgniter\Model;

class PanggilanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'panggilan_ortu';
    protected $primaryKey       = 'panggilan_id';
    protected $protectFields    = true;
    protected $allowedFields    = ['nis', 'status', 'keterangan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'date';


    public function getPanggilan($id = null)
    {
        if ($id == null) {
            $this->select('panggilan_ortu.*, DATE_FORMAT(panggilan_ortu.created_at, "%e %M %Y") AS tanggal,DATE_FORMAT(DATE_ADD(panggilan_ortu.created_at, INTERVAL 3 DAY), "%e %M %Y") AS tgl_hadir,siswa.nama AS nama_siswa, ortu.nama AS nama_ortu')
                ->join('siswa', 'siswa.nis = panggilan_ortu.nis')
                ->join('ortu', 'ortu.ortu_id = siswa.ortu_id')
                ->orderBy('panggilan_ortu.created_at', 'DESC');
            return $this->get()->getResultArray();
        } else {
            $this->select('panggilan_ortu.*, DATE_FORMAT(panggilan_ortu.created_at, "%e %M %Y") AS tanggal,DATE_FORMAT(DATE_ADD(panggilan_ortu.created_at, INTERVAL 3 DAY), "%e %M %Y") AS tgl_hadir,siswa.nama AS nama_siswa, ortu.nama AS nama_ortu')
                ->join('siswa', 'siswa.nis = panggilan_ortu.nis')
                ->join('ortu', 'ortu.ortu_id = siswa.ortu_id')
                ->where('panggilan_ortu.panggilan_id', $id)
                ->orderBy('panggilan_ortu.created_at', 'DESC');
            return $this->first();
        }
    }

    public function getHadir()
    {
        $currentMonth = date('m');
        $year = date('Y');
        $this->select('*')
            ->where('MONTH(created_at)',  $currentMonth)
            ->where('YEAR(created_at)', $year)
            ->where('status', 1);
        return $this->delete();
    }
}
