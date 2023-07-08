<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kategori';
    protected $primaryKey       = 'kategori_id';
    protected $allowedFields    = ['jenis', 'nama', 'keterangan'];

    // Dates
    protected $useTimestamps = true;
}
