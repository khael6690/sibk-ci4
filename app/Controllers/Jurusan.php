<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JurusanModel;

define('_TITLE', 'Jurusan');

class Jurusan extends BaseController
{
    private $m_jurusan;
    public function __construct()
    {
        $this->m_jurusan = new JurusanModel();
    }

    public function viewdata()
    {
        if ($this->request->isAJAX()) {
            $data_jurusan = $this->m_jurusan->findAll();
            $data = [
                'data_jurusan' => $data_jurusan
            ];

            $msg = [
                'data' => view('jurusan/data', $data)
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
                'title' => "Create"
            ];

            $msg = [
                'data' => view('jurusan/create', $data)
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
                'nama_jurusan' => [
                    'rules' => 'required|is_unique[jurusan.nama_jurusan]',
                    'label' => 'Nama jurusan',
                    'errors' => [
                        'required' => '{field} harus diisi!',
                        'is_unique' => '{field} sudah ada!'
                    ]
                ],
                'singkatan' => [
                    'rules' => 'required|is_unique[jurusan.singkatan]',
                    'label' => 'Singkatan',
                    'errors' => [
                        'required' => '{field} harus diisi!',
                        'is_unique' => '{field} sudah ada!'
                    ]
                ],
            ])) {
                $msg = [
                    'error' => [
                        'nama_jurusan' => $validation->getError('nama_jurusan'),
                        'singkatan' => $validation->getError('singkatan')
                    ]
                ];
                return $this->response->setJSON($msg);
            }
            // masuk ke database
            if ($this->m_jurusan->save(
                [
                    'nama_jurusan' => $this->request->getVar('nama_jurusan'),
                    'singkatan' => $this->request->getVar('singkatan')
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
            $data_jurusan = $this->m_jurusan->find($id);
            $data = [
                'title' => "Update",
                'data_jurusan' => $data_jurusan
            ];

            $msg = [
                'data' => view('jurusan/update', $data)
            ];

            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getRawInputVar('jurusan_id');
            $data_jurusan = $this->m_jurusan->find($id);
            // validasi data
            $data_jurusan['nama_jurusan'] === $this->request->getRawInputVar('nama_jurusan') ?
                $rule1 = 'required' :
                $rule1 = 'required|is_unique[jurusan.nama_jurusan]';

            $data_jurusan['singkatan'] === $this->request->getRawInputVar('singkatan') ?
                $rule2 = 'required' :
                $rule2 = 'required|is_unique[jurusan.singkatan]';

            $validation = \config\Services::validation();
            if (!$this->validate([
                'nama_jurusan' => [
                    'rules' => $rule1,
                    'label' => 'Nama jurusan',
                    'errors' => [
                        'required' => '{field} harus diisi!',
                        'is_unique' => '{field} sudah ada!'
                    ]
                ],
                'singkatan' => [
                    'rules' => $rule2,
                    'label' => 'Singkatan',
                    'errors' => [
                        'required' => '{field} harus diisi!',
                        'is_unique' => '{field} sudah ada!'
                    ]
                ],
            ])) {
                $msg = [
                    'error' => [
                        'nama_kelas' => $validation->getError('nama_kelas'),
                        'singkatan' => $validation->getError('singkatan')
                    ]
                ];
                return $this->response->setJSON($msg);
            }
            // masuk ke database
            if ($this->m_jurusan->update(
                $this->request->getRawInputVar('jurusan_id'),
                [
                    'nama_jurusan' => $this->request->getRawInputVar('nama_jurusan'),
                    'singkatan' => $this->request->getRawInputVar('singkatan'),
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
            if ($this->m_jurusan->delete($this->request->getRawInputVar('jurusan_id'))) {
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
