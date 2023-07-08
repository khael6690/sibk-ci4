<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\KategoriModel;
use App\Models\KelasModel;
use App\Models\PanggilanModel;
use App\Models\PelanggaranModel;
use App\Models\PelSiswaModel;
use App\Models\SiswaModel;

define('_TITLE', 'Pelanggaran');

class Pelanggaran extends BaseController
{
    private $m_pelanggaran, $m_tata, $m_kategori, $m_siswa, $m_panggilan;
    public function __construct()
    {
        $this->m_pelanggaran = new PelSiswaModel();
        $this->m_panggilan = new PanggilanModel();
        $this->m_kategori = new KategoriModel();
        $this->m_siswa = new SiswaModel();
        $this->m_tata = new PelanggaranModel();
    }
    public function index()
    {
        $data = [
            "title" => _TITLE
        ];
        return view('pelanggaran/index', $data);
    }

    public function viewdata()
    {
        if ($this->request->isAJAX()) {
            $data_pelanggaran = $this->m_pelanggaran->getPelanggaran();
            $data = [
                'data_pelanggaran' => $data_pelanggaran
            ];

            $msg = [
                'data' => view('pelanggaran/data', $data)
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
            $data_pelanggaran = $this->m_pelanggaran->getPelanggaran($id);
            $data = [
                'title' => _TITLE,
                'data_pelanggaran' => $data_pelanggaran
            ];

            $msg = [
                'data' => view('pelanggaran/detail', $data)
            ];
            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function create()
    {
        if ($this->request->isAJAX()) {
            $data_kategori = $this->m_kategori->findAll();
            $data_siswa = $this->m_siswa->getSiswa();
            $data = [
                'title' => "Create",
                'data_kategori' => $data_kategori,
                'data_siswa' => $data_siswa
            ];

            $msg = [
                'data' => view('pelanggaran/create', $data)
            ];

            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function getPel()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data_tata = $this->m_tata->where('kategori_id', $id)->get()->getResultArray();

            $msg = [
                'data' => $data_tata
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
                'nis' => [
                    'rules' => 'required',
                    'label' => 'Siswa',
                    'errors' => [
                        'required' => '{field} belum dipilih!'
                    ]
                ],
                'pelanggaran_id' => [
                    'rules' => 'required',
                    'label' => 'Pelanggaran',
                    'errors' => [
                        'required' => '{field} belum dipilih!'
                    ]
                ]
            ])) {
                $msg = [
                    'error' => [
                        'nis' => $validation->getError('nis'),
                        'kategori_id' => $validation->getError('kategori_id'),
                        'pelanggaran_id' => $validation->getError('pelanggaran_id')
                    ]
                ];
                return $this->response->setJSON($msg);
            }
            // masuk ke database
            if ($this->m_pelanggaran->save(
                [
                    'nis' => $this->request->getVar('nis'),
                    'pelanggaran_id' => $this->request->getVar('pelanggaran_id'),
                    'tindakan' => $this->request->getVar('tindakan'),
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
            $data_pelanggaran = $this->m_pelanggaran->getPelanggaran($id);
            $data_kategori = $this->m_kategori->findAll();
            $data_siswa = $this->m_siswa->getSiswa();
            $data = [
                'title' => "Update",
                'data_pelanggaran' => $data_pelanggaran,
                'data_kategori' => $data_kategori,
                'data_siswa' => $data_siswa
            ];

            $msg = [
                'data' => view('pelanggaran/update', $data)
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
                'nis' => [
                    'rules' => 'required',
                    'label' => 'Siswa',
                    'errors' => [
                        'required' => '{field} belum dipilih!'
                    ]
                ],
                'pelanggaran_id' => [
                    'rules' => 'required',
                    'label' => 'Pelanggaran',
                    'errors' => [
                        'required' => '{field} belum dipilih!'
                    ]
                ]
            ])) {
                $msg = [
                    'error' => [
                        'nis' => $validation->getError('nis'),
                        'kategori_id' => $validation->getError('kategori_id'),
                        'pelanggaran_id' => $validation->getError('pelanggaran_id')
                    ]
                ];
                return $this->response->setJSON($msg);
            }
            // masuk ke database
            if ($this->m_pelanggaran->update(
                $this->request->getRawInputVar('pelsiswa_id'),
                [
                    'nis' => $this->request->getRawInputVar('nis'),
                    'pelanggaran_id' => $this->request->getRawInputVar('pelanggaran_id'),
                    'tindakan' => $this->request->getRawInputVar('tindakan'),
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
            if ($this->m_pelanggaran->delete($this->request->getRawInputVar('pelsiswa_id'))) {
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
            $data_pelanggaran = $this->m_pelanggaran->find($id);
            $data_pelanggaran['status'] == 1 ? $status = 0 : $status = 1;
            // masuk ke database
            if ($this->m_pelanggaran->update(
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

    public function panggil()
    {
        if ($this->request->isAJAX()) {
            // masuk ke database
            if ($this->m_panggilan->save(
                [
                    'nis' => $this->request->getVar('nis'),
                    'keterangan' => $this->request->getVar('keterangan')
                ]
            )) {
                $msg = [
                    'success' =>  'Data berhasil ditambahkan!'
                ];

                return $this->response->setJSON($msg);
            } else {
                $msg = [
                    'fail' =>  'Data gagal ditambahkan!'
                ];

                return $this->response->setJSON($msg);
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
