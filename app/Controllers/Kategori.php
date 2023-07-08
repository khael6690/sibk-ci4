<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\PelanggaranModel;

class Kategori extends BaseController
{
    private $m_kategori, $m_tata;
    public function __construct()
    {
        $this->m_kategori = new KategoriModel();
        $this->m_tata = new PelanggaranModel();
    }
    public function viewdata()
    {
        if ($this->request->isAJAX()) {
            $data_kategori = $this->m_kategori->findAll();
            $data = [
                'data_kategori' => $data_kategori
            ];

            $msg = [
                'data' => view('kategori/data', $data)
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
                'data' => view('kategori/create', $data)
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
                    'rules' => 'required|is_unique[kategori.nama]',
                    'label' => 'Nama kategori',
                    'errors' => [
                        'required' => '{field} harus diisi!',
                        'is_unique' => '{field} sudah ada!'
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
            if ($this->m_kategori->save(
                [
                    'nama' => $this->request->getVar('nama'),
                    'jenis' => $this->request->getVar('jenis'),
                    'keterangan' => $this->request->getVar('keterangan')
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
            $data_kategori = $this->m_kategori->find($id);
            $data = [
                'title' => "Update",
                'data_kategori' => $data_kategori
            ];

            $msg = [
                'data' => view('kategori/update', $data)
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
            $id = $this->request->getRawInputVar('kategori_id');
            $data_kategori = $this->m_kategori->find($id);
            $data_kategori['nama'] === $this->request->getRawInputVar('nama') ?
                $rule = 'required' : $rule = 'required|is_unique[kategori.nama]';
            $validation = \config\Services::validation();
            if (!$this->validate([
                'nama' => [
                    'rules' => $rule,
                    'label' => 'Nama kategori',
                    'errors' => [
                        'required' => '{field} harus diisi!',
                        'is_unique' => '{field} sudah ada!',
                    ]
                ]
            ])) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                    ]
                ];
                return $this->response->setJSON($msg);
            }
            // masuk ke database
            if ($this->m_kategori->update(
                $this->request->getRawInputVar('kategori_id'),
                [
                    'nama' => $this->request->getRawInputVar('nama'),
                    'jenis' => $this->request->getRawInputVar('jenis'),
                    'keterangan' => $this->request->getRawInputVar('keterangan')
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
            if ($this->m_kategori->delete($this->request->getRawInputVar('kategori_id'))) {
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
