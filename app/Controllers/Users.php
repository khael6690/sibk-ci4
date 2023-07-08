<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;
use Myth\Auth\Password;


define('_TITLE', 'Users');

class Users extends BaseController
{
    private $m_myth, $m_group;
    public function __construct()
    {
        $this->m_myth = new UserModel();
        $this->m_group = new GroupModel();
    }

    public function index()
    {
        $data = [
            'title' => _TITLE
        ];

        return view('users/index', $data);
    }

    public function viewdata()
    {

        if ($this->request->isAJAX()) {
            $data_users = $this->m_myth->findAll();

            $data = [
                'data_users' => $data_users
            ];

            $msg = [
                'data' => view('users/data', $data)
            ];
            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }


    public function create()
    {
        if ($this->request->isAJAX()) {
            $data_group = $this->m_group->orderBy('name')->findAll();

            $data = [
                'title' => "Create",
                'data_group' => $data_group
            ];

            $msg = [
                'data' => view('users/create', $data)
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
                'username' => [
                    'rules' => 'required|is_unique[users.username]',
                    'label' => 'Username',
                    'errors' => [
                        'required' => '{field} harus diisi!',
                        'is_unique' => '{field} sudah digunakan!'
                    ]
                ],
                'fullname' => [
                    'rules' => 'required',
                    'label' => 'Nama lengkap',
                    'errors' => [
                        'required' => '{field} harus diisi!'
                    ]
                ],
                'email' => [
                    'rules' => 'required',
                    'label' => 'Email',
                    'errors' => [
                        'required' => '{field} harus diisi!'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[8]',
                    'label' => 'Password',
                    'errors' => [
                        'required' => '{field} harus diisi!',
                        'min_length' => '{field} minimal 8 karakter!'
                    ]
                ],
                'pass_confirm' => [
                    'rules' => 'required|matches[password]',
                    'label' => 'Password Konfirmasi',
                    'errors' => [
                        'required' => '{field} harus diisi!',
                        'matches' => '{field} tidak sama dengan password!'
                    ]
                ],
            ])) {
                $msg = [
                    'error' => [
                        'username' => $validation->getError('username'),
                        'fullname' => $validation->getError('fullname'),
                        'email' => $validation->getError('email'),
                        'password' => $validation->getError('password'),
                        'pass_confirm' => $validation->getError('pass_confirm'),
                    ]
                ];
                return $this->response->setJSON($msg);
            }

            // masuk ke database
            if ($this->m_myth->withGroup($this->request->getVar('group'))->save(
                [
                    'username' => $this->request->getVar('username'),
                    'fullname' => $this->request->getVar('fullname'),
                    'email' => $this->request->getVar('email'),
                    'password_hash' => Password::hash($this->request->getVar('password')),
                    'active' => 1
                ]
            )) {
                $msg = [
                    'success' =>  'Data berhasil ditambahkan!'
                ];
                return $this->response->setJSON($msg);
            } else
                $msg = [
                    'fail' =>  'Data gagal ditambahkan!'
                ];
            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function delete($id = null)
    {

        if ($this->request->isAJAX()) {
            if ($this->m_myth->delete($id)) {
                $msg = [
                    'success' =>  'Data berhasil dihapus!'
                ];

                return $this->response->setJSON($msg);
            } else {

                $msg = [
                    'fail' =>  'Data gagal dihapus!'
                ];

                return $this->response->setJSON($msg);
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public  function reset($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($this->m_myth->save([
                'id' => $id,
                'password_hash' => Password::hash("12345678")
            ])) {

                $msg = [
                    'success' =>  'Password berhasil direset!'
                ];

                return $this->response->setJSON($msg);
            } else
                $msg = [
                    'fail' =>  'Password gagal direset!'
                ];

            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function active($id = null)
    {
        if ($this->request->isAJAX()) {
            $user = $this->m_myth->find($id);
            $user->active == 1 ? $status = 0 : $status = 1;

            if ($this->m_myth->save([
                'id' => $id,
                'active' => $status
            ])) {
                $msg = [
                    'success' =>  'Status berhasil dirubah!'
                ];

                return $this->response->setJSON($msg);
            } else
                $msg = [
                    'fail' =>  'Status gagal dirubah!'
                ];

            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function setuser()
    {
        $group = $this->m_group->getGroupsForUser(user_id());
        $data = [
            'title' => "Setting Account",
            'group' => $group,
        ];
        return view('setting/index', $data);
    }

    public function getUser()
    {
        if ($this->request->isAJAX()) {
            $data_user = $this->m_myth->find(user_id());
            $data = [
                'datauser' => $data_user
            ];
            $msg = [
                'data' => view('setting/formuser', $data)
            ];
            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function getPass()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('setting/formpass')
            ];
            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function saveset($id)
    {
        if ($this->request->isAJAX()) {
            // validasi data
            $validation = \config\Services::validation();
            user()->username === $this->request->getRawInputVar('username') ? $rule = 'required' : $rule = 'required|is_unique[users.username]';
            if (!$this->validate([
                'username' => [
                    'rules' => $rule,
                    'label' => 'Username',
                    'errors' => [
                        'required' => '{field} harus diisi!',
                        'is_unique' => '{field} sudah digunakan!'
                    ]
                ],
                'fullname' => [
                    'rules' => 'required',
                    'label' => 'Nama lengkap',
                    'errors' => [
                        'required' => '{field} harus diisi!'
                    ]
                ],
                'email' => [
                    'rules' => 'required',
                    'label' => 'Email',
                    'errors' => [
                        'required' => '{field} harus diisi!'
                    ]
                ]
            ])) {

                $msg = [
                    'error' => [
                        'username' => $validation->getError('username'),
                        'fullname' => $validation->getError('fullname'),
                        'email' => $validation->getError('email')
                    ]
                ];

                return $this->response->setJSON($msg);
            }
            // masuk ke database
            if ($this->m_myth->save(
                [
                    'id' => $id,
                    'username' => $this->request->getRawInputVar('username'),
                    'fullname' => $this->request->getRawInputVar('fullname'),
                    'email' => $this->request->getRawInputVar('email')
                ]
            )) {
                $msg = [
                    'success' =>  'Data berhasil diubah!'
                ];
                return $this->response->setJSON($msg);
            } else
                $msg = [
                    'fail' =>  'Data gagal diubah!'
                ];
            return $this->response->setJSON($msg);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function savepass($id = null)
    {

        if ($this->request->isAJAX()) {

            $data_user = $this->m_myth->find(user_id());
            // validasi data
            $validation = \config\Services::validation();
            if (!$this->validate([
                'oldpass' => [
                    'rules' => 'required',
                    'label' => 'Password lama',
                    'errors' => [
                        'required' => '{field} harus diisi!'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[8]',
                    'label' => 'Password baru',
                    'errors' => [
                        'required' => '{field} harus diisi!',
                        'min_length' => '{field} minimal 8 karakter!'
                    ]
                ],
                'pass_confirm' => [
                    'rules' => 'required|matches[password]',
                    'label' => 'Password Konfirmasi',
                    'errors' => [
                        'required' => '{field} harus diisi!',
                        'matches' => '{field} Tidak sama dengan password!'
                    ]
                ],
            ])) {
                $msg = [
                    'error' => [
                        'oldpass' => $validation->getError('oldpass'),
                        'password' => $validation->getError('password'),
                        'pass_confirm' => $validation->getError('pass_confirm')

                    ]
                ];
                return $this->response->setJSON($msg);
            }

            if (Password::verify($this->request->getRawInputVar('oldpass'), $data_user->password_hash)) {
                if ($this->m_myth->save([
                    'id' => user_id(),
                    'password_hash' => Password::hash($this->request->getRawInputVar('password'))
                ])) {

                    $msg = [
                        'success' =>  'Password berhasil diubah!'
                    ];

                    return $this->response->setJSON($msg);
                } else {
                    $msg = [
                        'fail' =>  'Password gagal diubah!'
                    ];

                    return $this->response->setJSON($msg);
                }
            } else {
                $msg = [
                    'error' => [
                        'oldpass' => 'Password lama yang anda masukan salah!'
                    ]
                ];

                return $this->response->setJSON($msg);
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}
