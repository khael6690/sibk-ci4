<?php

namespace App\Models;

use CodeIgniter\Model;

class OrtuModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ortu';
    protected $primaryKey       = 'ortu_id';
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'no_hp', 'jk'];
    // Dates
    protected $useTimestamps = true;
}
