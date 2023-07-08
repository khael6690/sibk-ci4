<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrtuModel;
use App\Models\SiswaModel;

class Ortu extends BaseController
{
    private $m_ortu, $m_siswa;
    public function __construct()
    {
        $this->m_ortu = new OrtuModel();
        $this->m_siswa = new SiswaModel();
    }

    public function getData()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data_siswa = $this->m_siswa->find($id);
            $data_siswa['ortu_id'] === null ?
                $data_ortu = [
                    'nama' => null,
                    'no_hp' => null,
                    'jk' => null
                ] :
                $data_ortu = $this->m_ortu->find($data_siswa['ortu_id']);
            $data = [
                'data_ortu' => $data_ortu
            ];

            $msg = [
                'data' => $data
            ];
            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function viewdata()
    {
        if ($this->request->isAJAX()) {
            $data_ortu = $this->m_ortu->findAll();
            $data = [
                'data_ortu' => $data_ortu
            ];

            $msg = [
                'data' => view('ortu/data', $data)
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
                ],
                'no_hp' => [
                    'rules' => 'required',
                    'label' => 'No HP',
                    'errors' => [
                        'required' => '{field} harus diisi!'
                    ]
                ],
                'jk' => [
                    'rules' => 'required',
                    'label' => 'Jenis kelamin',
                    'errors' => [
                        'required' => '{field} harus pilih!'
                    ]
                ],
            ])) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'jk' => $validation->getError('jk'),
                        'no_hp' => $validation->getError('no_hp'),
                    ]
                ];
                return $this->response->setJSON($msg);
            }
            $ortuId = $this->request->getVar('ortu_id');
            $id = $ortuId === '' ? null : $ortuId;

            $data = [
                'nama' => $this->request->getVar('nama'),
                'jk' => $this->request->getVar('jk'),
                'no_hp' => $this->request->getVar('no_hp')
            ];

            if ($id === null) {
                if ($this->m_ortu->insert($data)) {
                    $this->m_siswa->update(
                        $this->request->getVar('nis'),
                        ['ortu_id' => $this->m_ortu->getInsertID()]
                    );

                    $msg = [
                        'status' =>  true,
                        'msg' =>  'Data berhasil ditambahkan!',
                        'id' => $this->m_ortu->getInsertID()
                    ];
                } else {
                    $msg = [
                        'status' =>  false,
                        'msg' =>  'Data gagal ditambahkan!'
                    ];
                }
            } else {
                if ($this->m_ortu->save(['ortu_id' => $id] + $data)) {
                    $msg = [
                        'status' =>  true,
                        'msg' =>  'Data berhasil ditambahkan!'
                    ];
                } else {
                    $msg = [
                        'status' =>  false,
                        'msg' =>  'Data gagal ditambahkan!'
                    ];
                }
            }

            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            if ($this->m_ortu->delete($this->request->getRawInputVar('ortu_id')) && $this->m_siswa->update($this->request->getRawInputVar('nis'), ['ortu_id' => null])) {
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
