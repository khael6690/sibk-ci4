<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\JurusanModel;
use App\Models\KelasModel;

define('_TITLE', 'Kelas & Jurusan');

class Kelas extends BaseController
{
    private $m_kelas, $m_jurusan, $m_guru;
    public function __construct()
    {
        $this->m_kelas = new KelasModel();
        $this->m_jurusan = new JurusanModel();
        $this->m_guru = new GuruModel();
    }

    public function index()
    {
        $data = [
            "title" => _TITLE
        ];
        return view('kelas/index', $data);
    }

    public function viewdata()
    {
        if ($this->request->isAJAX()) {
            $data_kelas = $this->m_kelas->getKelas();
            $data = [
                'data_kelas' => $data_kelas
            ];

            $msg = [
                'data' => view('kelas/data', $data)
            ];
            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function create()
    {
        if ($this->request->isAJAX()) {
            $data_guru = $this->m_guru->findAll();
            $data_jurusan = $this->m_jurusan->findAll();
            $data = [
                'title' => "Create",
                'data_guru' => $data_guru,
                'data_jurusan' => $data_jurusan
            ];

            $msg = [
                'data' => view('kelas/create', $data)
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
                'nama_kelas' => [
                    'rules' => 'required',
                    'label' => 'Nama kelas',
                    'errors' => [
                        'required' => '{field} harus diisi!'
                    ]
                ]
            ])) {
                $msg = [
                    'error' => [
                        'nama_kelas' => $validation->getError('nama_kelas')
                    ]
                ];
                return $this->response->setJSON($msg);
            }
            // masuk ke database
            if ($this->m_kelas->save(
                [
                    'nama_kelas' => $this->request->getVar('nama_kelas'),
                    'jurusan_id' => $this->request->getVar('jurusan_id'),
                    'guru_id' => $this->request->getVar('guru_id')
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
            $data_kelas = $this->m_kelas->find($id);
            $data_guru = $this->m_guru->findAll();
            $data_jurusan = $this->m_jurusan->findAll();
            $data = [
                'title' => "Update",
                'data_kelas' => $data_kelas,
                'data_guru' => $data_guru,
                'data_jurusan' => $data_jurusan
            ];

            $msg = [
                'data' => view('kelas/update', $data)
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
                'nama_kelas' => [
                    'rules' => 'required',
                    'label' => 'Nama',
                    'errors' => [
                        'required' => '{field} harus diisi!'
                    ]
                ]
            ])) {
                $msg = [
                    'error' => [
                        'nama_kelas' => $validation->getError('nama_kelas')
                    ]
                ];
                return $this->response->setJSON($msg);
            }
            // masuk ke database
            if ($this->m_kelas->update(
                $this->request->getRawInputVar('kelas_id'),
                [
                    'nama_kelas' => $this->request->getRawInputVar('nama_kelas'),
                    'guru_id' => $this->request->getRawInputVar('guru_id'),
                    'jurusan_id' => $this->request->getRawInputVar('jurusan_id')
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
            if ($this->m_kelas->delete($this->request->getRawInputVar('kelas_id'))) {
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
