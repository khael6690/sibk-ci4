<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;

define('_TITLE', 'Guru');

class Guru extends BaseController
{
    private $m_guru;
    public function __construct()
    {
        $this->m_guru = new GuruModel();
    }

    public function index()
    {
        $data = [
            "title" => _TITLE
        ];
        return view('guru/index', $data);
    }

    public function viewdata()
    {
        if ($this->request->isAJAX()) {
            $data_guru = $this->m_guru->guruClass();
            $data = [
                'data_guru' => $data_guru
            ];

            $msg = [
                'data' => view('guru/data', $data)
            ];
            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function detail()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data_guru = $this->m_guru->guruClass($id);
            $data = [
                'title' => _TITLE,
                'data_guru' => $data_guru
            ];

            $msg = [
                'data' => view('guru/detail', $data)
            ];
            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function create()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => "Create",
            ];

            $msg = [
                'data' => view('guru/create', $data)
            ];

            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            // validasi data
            $validation = \config\Services::validation();
            if (!$this->validate([
                'nama' => [
                    'rules' => 'required',
                    'label' => 'Nama',
                    'errors' => [
                        'required' => '{field} harus diisi!'
                    ]
                ]
            ])) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama')
                    ]
                ];
                return $this->response->setJSON($msg);
            }
            // masuk ke database
            if ($this->m_guru->save(
                [
                    'nama' => $this->request->getVar('nama'),
                    'alamat' => $this->request->getVar('alamat'),
                    'jk' => $this->request->getVar('jk'),
                    'no_hp' => $this->request->getVar('no_hp')
                ]
            )) {
                $msg = [
                    'success' =>  'Data berhasil ditambahkan!'
                ];

                return $this->response->setJSON($msg);
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function edit($id = null)
    {
        if ($this->request->isAJAX()) {
            $data_guru = $this->m_guru->find($id);
            $data = [
                'title' => "Update",
                'data_guru' => $data_guru
            ];

            $msg = [
                'data' => view('guru/update', $data)
            ];

            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            // validasi data
            $validation = \config\Services::validation();
            if (!$this->validate([
                'nama' => [
                    'rules' => 'required',
                    'label' => 'Nama',
                    'errors' => [
                        'required' => '{field} harus diisi!'
                    ]
                ]
            ])) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama')
                    ]
                ];
                return $this->response->setJSON($msg);
            }
            // masuk ke database
            if ($this->m_guru->update(
                $this->request->getRawInputVar('guru_id'),
                [
                    'nama' => $this->request->getRawInputVar('nama'),
                    'alamat' => $this->request->getRawInputVar('alamat'),
                    'jk' => $this->request->getRawInputVar('jk'),
                    'no_hp' => $this->request->getRawInputVar('no_hp')
                ]
            )) {
                $msg = [
                    'success' =>  'Data berhasil diupdate!'
                ];

                return $this->response->setJSON($msg);
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            if ($this->m_guru->delete($this->request->getRawInputVar('guru_id'))) {
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
}
