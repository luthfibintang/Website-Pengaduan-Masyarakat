<?php

namespace App\Controllers;
use CodeIgniter\Entity;
use CodeIgniter\Validation\Rules;
use Myth\Auth\Authorization\GroupModel;
use Myth\Auth\Authorization\PermissionModel;
use Myth\Auth\Password;

class User extends BaseController
{
    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->pengaduan = $this->db->table('pengaduan');
        $this->build = $this->db->table('auth_groups');
        $this->tanggapan = $this->db->table('tanggapan');
    }

    public function index()
    {
        $data = [
            'title' => 'Profile',
            'validation' => \Config\Services::validation()
        ];
        // mendapatkan * pengaduan berdasarkan userid
        $this->pengaduan->where('userid', user()->id);
        $data['total'] = $this->pengaduan->countAllResults();

        // Mendapatkan pengaduan berdasarkan userid dan berstatus selesai
        $this->pengaduan->where('userid', user()->id);
        $this->pengaduan->where('status', 'selesai');
        $data['selesai'] = $this->pengaduan->countAllResults();

        //mendapatkan pengaduan berdasarkan status
        $this->pengaduan->where('status', '0');
        $data['belumverif'] = $this->pengaduan->countAllResults();
        $this->pengaduan->where('status !=', '0');
        $data['verif'] = $this->pengaduan->countAllResults();

        $this->tanggapan->where('id_petugas', user()->id);
        $data['tanggapan'] = $this->tanggapan->countAllResults();
        

        $this->builder->select('users.id as userid, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', user()->id);
        $this->query = $this->builder->get();

        $data['users'] = $this->query->getResult();
        
        return view('user/index', $data);
    }

    public function changepassword(){
        $data = [
            'title' => 'Ubah Password',
            'validation' => \Config\Services::validation()
        ];

        return view('user/changepass', $data);
    }

    public function edit(){
        $data = [
            'title' => 'Edit Profile',
            'validation' => \Config\Services::validation()
        ];

        return view('user/editprofile', $data);
    }
    
    public function updateprofile($id){

        if (in_groups('masyarakat')) {
        if(!$this->validate([
            'nik' => [
                'rules' =>'required|is_unique[users.nik,id,{id}]|decimal',
                'errors' => [
                    'is_unique' => 'NIK sudah terdaftar',
                    'decimal' => 'NIK harus angka'
                ]
            ],
            'fullname' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap wajib diisi'
                ]
            ],
            'username' => [
                'rules' => 'required|alpha_numeric|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]',
                'errors' => [
                    'required' => 'Username wajib diisi',
                    'min_length' => 'Username minimum memiliki 3 character',
                    'max_length' => 'Username maximum memiliki 30 character',
                    'is_unique' => 'username sudah terdaftar',
                    'alpha_numeric' => 'Username hanya boleh berisi alphanumeric character'
                ]
            ],
            'email'    => [
                'rules' => 'required|valid_email|is_unique[users.email,id,{id}]',
                'errors' => [
                    'required' => 'Email wajib diisi',
                    'valid_email' => 'Format Email tidak valid',
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ],
            'telp' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Nomor Telephone wajib diisi',
                    'decimal' => 'Nomor telephone harus berisi angka'
                ]
            ],
            'user_image' => [
                'rules' => 'max_size[user_image,2044]|is_image[user_image]|mime_in[user_image,image/jpg,image/jpeg,image/png,image/svg]',
                'errors' => [
                    'max_size' => 'Ukuran File Terlalu besar',
                    'is_image' => 'Harus berupa gambar',
                    'mime_in' => 'Harus berupa gambar'
                ]
            ]
    
        ])) {            
            // return redirect()->to('/user/edit/')->withInput();
            return redirect()->to('/user')->withInput();
        }
    }else {
            if(!$this->validate([
                'fullname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Lengkap wajib diisi'
                    ]
                ],
                'username' => [
                    'rules' => 'required|alpha_numeric|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]',
                    'errors' => [
                        'required' => 'Username wajib diisi',
                        'min_length' => 'Username minimum memiliki 3 character',
                        'max_length' => 'Username maximum memiliki 30 character',
                        'is_unique' => 'username sudah terdaftar',
                        'alpha_numeric' => 'Username hanya boleh berisi alphanumeric character'
                    ]
                ],
                'email'    => [
                    'rules' => 'required|valid_email|is_unique[users.email,id,{id}]',
                    'errors' => [
                        'required' => 'Email wajib diisi',
                        'valid_email' => 'Format Email tidak valid',
                        'is_unique' => 'Email sudah terdaftar'
                    ]
                ],
                'telp' => [
                    'rules' => 'required|decimal',
                    'errors' => [
                        'required' => 'Nomor Telephone wajib diisi',
                        'decimal' => 'Nomor telephone harus berisi angka'
                    ]
                ],
                'user_image' => [
                    'rules' => 'max_size[user_image,2044]|is_image[user_image]|mime_in[user_image,image/jpg,image/jpeg,image/png,image/svg]',
                    'errors' => [
                        'max_size' => 'Ukuran File Terlalu besar',
                        'is_image' => 'Harus berupa gambar',
                        'mime_in' => 'Harus berupa gambar'
                    ]
                ]
            ])) {            
                // return redirect()->to('/user/edit/')->withInput();
                return redirect()->to('/user')->withInput();
            }
        }

        $oldprofile = $this->request->getVar('old_userImage');
        //ambil gambar
        $fileProfile = $this->request->getFile('user_image');

        if($fileProfile->getError() == 4) {
            $namaprofile = $oldprofile;
        } else {
            $namaprofile = $fileProfile->getRandomName();
            $fileProfile->move('img/user-profile', $namaprofile);
            if (user()->user_image != 'default.svg') {
                unlink('img/user-profile/' . $oldprofile);
            }
        }


        $nik = $this->request->getVar('nik');
        if (!empty($nik)) {
            $data = [
             'nik' => $this->request->getVar('nik'),
             'email' => $this->request->getVar('email'),
             'username' => $this->request->getVar('username'),
             'fullname' => $this->request->getVar('fullname'),
             'telp' => $this->request->getVar('telp'),
             'user_image' => $namaprofile,
             'bio' => $this->request->getVar('bio')
            ]; }
             else {
                $data = [
                    'email' => $this->request->getVar('email'),
                    'username' => $this->request->getVar('username'),
                    'fullname' => $this->request->getVar('fullname'),
                    'telp' => $this->request->getVar('telp'),
                    'user_image' => $namaprofile,
                    'bio' => $this->request->getVar('bio')
                ];
            }

            $this->builder->set($data);
            $this->builder->where('id', $id);
            $this->builder->update();
            
            session()->setFlashdata('success', 'Profile kamu berhasil diubah');
            return redirect()->to('/user');
    }

}
