<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KelasModel;
use App\Models\OrtuModel;
use App\Models\SiswaModel;

define('_TITLE', 'Siswa');

class Siswa extends BaseController
{
    private $m_siswa, $m_ortu, $m_kelas;
    public function __construct()
    {
        $this->m_siswa = new SiswaModel();
        $this->m_ortu = new OrtuModel();
        $this->m_kelas = new KelasModel();
    }

    public function index()
    {
        $data = [
            "title" => _TITLE
        ];
        return view('siswa/index', $data);
    }

    public function viewdata()
    {
        if ($this->request->isAJAX()) {
            $data_siswa = $this->m_siswa->getSiswa();
            $data = [
                'data_siswa' => $data_siswa
            ];

            $msg = [
                'data' => view('siswa/data', $data)
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
            $data_siswa = $this->m_siswa->getSiswa($id);
            $data = [
                'title' => _TITLE,
                'data_siswa' => $data_siswa
            ];

            $msg = [
                'data' => view('siswa/detail', $data)
            ];
            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function create()
    {
        if ($this->request->isAJAX()) {
            $data_kelas = $this->m_kelas->getKelas();
            $data = [
                'title' => "Create",
                'data_kelas' => $data_kelas
            ];

            $msg = [
                'data' => view('siswa/create', $data)
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
                    'rules' => 'required|is_unique[siswa.nis]',
                    'label' => 'NIS',
                    'errors' => [
                        'required' => '{field} harus diisi!',
                        'is_unique' => '{field} sudah ada!'
                    ]
                ],
                'nama' => [
                    'rules' => 'required',
                    'label' => 'Nama',
                    'errors' => [
                        'required' => '{field} harus diisi!'
                    ]
                ],
                'no_hp' => [
                    'rules' => 'required',
                    'label' => 'No HP',
                    'errors' => [
                        'required' => '{field} harus diisi!'
                    ]
                ],
                'alamat' => [
                    'rules' => 'required',
                    'label' => 'Alamat',
                    'errors' => [
                        'required' => '{field} harus diisi!'
                    ]
                ],
            ])) {
                $msg = [
                    'error' => [
                        'nis' => $validation->getError('nis'),
                        'nama' => $validation->getError('nama'),
                        'alamat' => $validation->getError('alamat'),
                        'no_hp' => $validation->getError('no_hp'),
                    ]
                ];
                return $this->response->setJSON($msg);
            }
            // masuk ke database
            if ($this->m_siswa->save(
                [
                    'nis' => $this->request->getVar('nis'),
                    'nama' => $this->request->getVar('nama'),
                    'alamat' => $this->request->getVar('alamat'),
                    'jk' => $this->request->getVar('jk'),
                    'kelas_id' => $this->request->getVar('kelas_id'),
                    'no_hp' => $this->request->getVar('no_hp')
                ]
            )) {
                $msg = [
                    'status' =>  true,
                    'msg' =>  'Data berhasil ditambahkan!',
                ];

                return $this->response->setJSON($msg);
            } else {
                $msg = [
                    'status' =>  false,
                    'msg' =>  'Data gagal ditambahkan!'
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
            $data_siswa = $this->m_siswa->getSiswa($id);
            $data_kelas = $this->m_kelas->getKelas();
            $data = [
                'title' => "Update",
                'data_siswa' => $data_siswa,
                'data_kelas' => $data_kelas
            ];

            $msg = [
                'data' => view('siswa/update', $data)
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
                ],
                'no_hp' => [
                    'rules' => 'required',
                    'label' => 'No HP',
                    'errors' => [
                        'required' => '{field} harus diisi!'
                    ]
                ],
                'alamat' => [
                    'rules' => 'required',
                    'label' => 'Alamat',
                    'errors' => [
                        'required' => '{field} harus diisi!'
                    ]
                ],
            ])) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'alamat' => $validation->getError('alamat'),
                        'no_hp' => $validation->getError('no_hp')
                    ]
                ];
                return $this->response->setJSON($msg);
            }
            // masuk ke database
            if ($this->m_siswa->update(
                $this->request->getRawInputVar('nis'),
                [
                    'nama' => $this->request->getRawInputVar('nama'),
                    'alamat' => $this->request->getRawInputVar('alamat'),
                    'jk' => $this->request->getRawInputVar('jk'),
                    'kelas_id' => $this->request->getRawInputVar('kelas_id'),
                    'no_hp' => $this->request->getRawInputVar('no_hp')
                ]
            )) {
                $msg = [
                    'status' =>  true,
                    'msg' =>  'Data berhasil diupdate!'
                ];

                return $this->response->setJSON($msg);
            } else {
                $msg = [
                    'status' =>  false,
                    'msg' =>  'Data gagal diupdate!'
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
            if ($this->m_siswa->delete($this->request->getRawInputVar('nis')) && $this->m_ortu->delete($this->request->getRawInputVar('ortu_id'))) {
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
