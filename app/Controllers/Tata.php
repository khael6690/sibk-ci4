<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\PelanggaranModel;

define('_TITLE', 'Tata Tertib');

class Tata extends BaseController
{
    private $m_tata, $m_kategori;
    public function __construct()
    {
        $this->m_tata = new PelanggaranModel();
        $this->m_kategori = new KategoriModel();
    }

    public function index()
    {
        $data = [
            "title" => _TITLE
        ];
        return view('tata/index', $data);
    }

    public function viewdata()
    {
        if ($this->request->isAJAX()) {
            $data_tata = $this->m_tata->getPel();
            $data = [
                'data_tata' => $data_tata
            ];

            $msg = [
                'data' => view('tata/data', $data)
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
            $data_tata = $this->m_tata->getPel($id);
            $data = [
                'title' => _TITLE,
                'data_tata' => $data_tata
            ];

            $msg = [
                'data' => view('tata/detail', $data)
            ];
            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function create()
    {
        if ($this->request->isAJAX()) {
            $data_ketegori = $this->m_kategori->findAll();
            $data = [
                'title' => "Create",
                'data_kategori' => $data_ketegori
            ];

            $msg = [
                'data' => view('tata/create', $data)
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
                    'rules' => 'required|is_unique[pelanggaran.nama]',
                    'label' => 'Nama tata tertib',
                    'errors' => [
                        'required' => '{field} harus diisi!',
                        'is_unique' => '{field} sudah ada!'
                    ]
                ],
                'hukuman' => [
                    'rules' => 'required',
                    'label' => 'Hukuman',
                    'errors' => [
                        'required' => '{field} harus diisi!'
                    ]
                ],
            ])) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'hukuman' => $validation->getError('hukuman')
                    ]
                ];
                return $this->response->setJSON($msg);
            }
            // masuk ke database
            if ($this->m_tata->save(
                [
                    'nama' => $this->request->getVar('nama'),
                    'kategori_id' => $this->request->getVar('kategori_id'),
                    'bobot' => $this->request->getVar('bobot'),
                    'deskripsi' => $this->request->getVar('deskripsi'),
                    'hukuman' => $this->request->getVar('hukuman'),
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
            $data_tata = $this->m_tata->find($id);
            $data_ketegori = $this->m_kategori->findAll();
            $data = [
                'title' => "Update",
                'data_tata' => $data_tata,
                'data_kategori' => $data_ketegori
            ];

            $msg = [
                'data' => view('tata/update', $data)
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
            $id = $this->request->getRawInputVar('pelanggaran_id');
            $data_tata = $this->m_tata->find($id);
            $data_tata['nama'] === $this->request->getRawInputVar('nama') ?
                $rule = 'required' : $rule = 'required|is_unique[pelanggaran.nama]';
            $validation = \config\Services::validation();
            if (!$this->validate([
                'nama' => [
                    'rules' => $rule,
                    'label' => 'Nama tata tertib',
                    'errors' => [
                        'required' => '{field} harus diisi!',
                        'is_unique' => '{field} sudah ada!',
                    ]
                ],
                'hukuman' => [
                    'rules' => 'required',
                    'label' => 'Hukuman',
                    'errors' => [
                        'required' => '{field} harus diisi!'
                    ]
                ]
            ])) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'hukuman' => $validation->getError('hukuman')
                    ]
                ];
                return $this->response->setJSON($msg);
            }
            // masuk ke database
            if ($this->m_tata->update(
                $this->request->getRawInputVar('pelanggaran_id'),
                [
                    'nama' => $this->request->getRawInputVar('nama'),
                    'kategori_id' => $this->request->getRawInputVar('kategori_id'),
                    'deskripsi' => $this->request->getRawInputVar('deskripsi'),
                    'hukuman' => $this->request->getRawInputVar('hukuman'),
                    'bobot' => $this->request->getRawInputVar('bobot'),
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
            if ($this->m_tata->delete($this->request->getRawInputVar('pelanggaran_id'))) {
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
