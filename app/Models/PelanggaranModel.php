<?php

namespace App\Models;

use CodeIgniter\Model;

class PelanggaranModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pelanggaran';
    protected $primaryKey       = 'pelanggaran_id';
    protected $allowedFields    = ['kategori_id', 'nama', 'deskripsi', 'hukuman', 'bobot'];

    // Dates
    protected $useTimestamps = true;


    public function getPel($id = null)
    {
        if ($id === null) {
            $this->select('pelanggaran.*, kategori.jenis, kategori.nama AS nama_kategori')
                ->join('kategori', 'pelanggaran.kategori_id = kategori.kategori_id', 'LEFT');
            return $this->get()->getResultArray();
        } else {
            $this->select('pelanggaran.*, kategori.jenis, kategori.nama AS nama_kategori')
                ->join('kategori', 'pelanggaran.kategori_id = kategori.kategori_id', 'LEFT')
                ->where('pelanggaran.pelanggaran_id', $id);
            return $this->first();
        }
    }
}
