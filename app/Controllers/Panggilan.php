<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PanggilanModel;
use App\Models\PelSiswaModel;

define('_TITLE', 'Panggilan');

class Panggilan extends BaseController
{
    private $m_pelanggaran, $m_panggilan;
    public function __construct()
    {
        $this->m_pelanggaran = new PelSiswaModel();
        $this->m_panggilan = new PanggilanModel();
    }

    public function index()
    {
        $data = [
            'title' => _TITLE
        ];
        return view('panggilan/index', $data);
    }

    public function viewdata()
    {
        if ($this->request->isAJAX()) {
            $data_panggilan = $this->m_panggilan->getPanggilan();
            $data = [
                'data_panggilan' => $data_panggilan
            ];

            $msg = [
                'data' => view('panggilan/data', $data)
            ];
            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            if ($this->m_panggilan->getHadir()) {
                $msg = [
                    'success' =>  'Data berhasil dihapus!'
                ];
            } else {

                $msg = [
                    'error' =>  'Data gagal dihapus!'
                ];
            }
            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function deleteById($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($this->m_panggilan->delete($id)) {
                $msg = [
                    'success' =>  'Data berhasil dihapus!'
                ];

                return $this->response->setJSON($msg);
            } else {
                $msg = [
                    'error' =>  'Data gagal dihapus!'
                ];

                return $this->response->setJSON($msg);
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function status($id = null)
    {
        if ($this->request->isAJAX()) {
            $data_panggilan = $this->m_panggilan->find($id);
            $data_panggilan['status'] == 1 ? $status = 0 : $status = 1;
            // masuk ke database
            if ($this->m_panggilan->update(
                $id,
                [
                    'status' => $status
                ]
            )) {
                $msg = [
                    'success' =>  'Data berhasil diubah!'
                ];

                return $this->response->setJSON($msg);
            } else {
                $msg = [
                    'fail' =>  'Data gagal diubah!'
                ];

                return $this->response->setJSON($msg);
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function surat($id = null)
    {
        return view('panggilan/surat');
    }
}
