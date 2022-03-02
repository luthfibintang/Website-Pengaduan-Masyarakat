<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AddUserModel;
use App\Models\PengaduanModel;
use Config\Validation;
use App\Models\AuthGroupsModel;
use Myth\Auth\Password;
use App\Models\AuthGroupsUsers;
use App\Models\CatgroupsModel;
use App\Models\KategoriModel;

class Admin extends BaseController
{


    protected $db, $builder, $build, $authorize, $command;

    public function __construct()
    {
        $this->kategoriModel = new CatgroupsModel();
        $this->authGroupsUsers = new AuthGroupsUsers();
        $this->authGroupsModel = new AuthGroupsModel();
        $this->userModel = new UserModel();
        $this->addUser = new AddUserModel();
        $this->pengaduanModel = new PengaduanModel();
        $this->kategori = new KategoriModel();

        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->build = $this->db->table('auth_groups');
        // $this->kategori = $this->db->table('kategori');
        $this->kategori_groups = $this->db->table('kategori_groups');
        $this->auth_groups = $this->db->table('auth_groups');

        $this->authorize = service('authorization');

    }
    
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'validation' => \Config\Services::validation()
        ];
        
        //petugas kategorial
        if(has_permission('kategorial')) {
            
        $userid = user_id();
        $getgroup = $this->authGroupsUsers->find($userid);
        $this->getcat = $this->kategoriModel->where('group_id', $getgroup['group_id'])->find(); 
        $this->kategori = $this->getcat[0]['kategori_id'];
        
        $this->pengaduanModel->select('*');
        $this->pengaduanModel->join('kategori', 'kategori.id_kategori = pengaduan.id_kategori');
        $this->pengaduanModel->where('pengaduan.id_kategori', $this->kategori);
        $this->pengaduanModel->where('pengaduan.status', 'verifikasi');
        $data['catmasuk'] = $this->pengaduanModel->countAllResults();

        $this->pengaduanModel->select('*');
        $this->pengaduanModel->join('kategori', 'kategori.id_kategori = pengaduan.id_kategori');
        $this->pengaduanModel->where('pengaduan.id_kategori', $this->kategori);
        $this->pengaduanModel->where('pengaduan.status', 'proses');
        $data['catproses'] = $this->pengaduanModel->countAllResults();

        $this->pengaduanModel->select('*');
        $this->pengaduanModel->join('kategori', 'kategori.id_kategori = pengaduan.id_kategori');
        $this->pengaduanModel->where('pengaduan.id_kategori', $this->kategori);
        $this->pengaduanModel->where('pengaduan.status', 'selesai');
        $data['catselesai'] = $this->pengaduanModel->countAllResults();
        }


        // admin
        $this->addUser->select('*');
        $this->addUser->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->addUser->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->addUser->where('name', 'masyarakat');
        $masyarakat = $this->addUser->get()->getResultArray();
        $data['masyarakat'] = count($masyarakat);

        $this->addUser->select('*');
        $this->addUser->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->addUser->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->addUser->where('name', 'petugas');
        $petugas = $this->addUser->get()->getResultArray();
        $data['petugas'] = count($petugas);

        $this->addUser->select('*');
        $this->addUser->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->addUser->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $kategorial = "name!='masyarakat' AND name!='petugas' AND name!='admin'";
        $this->addUser->where($kategorial);
        $kategorial = $this->addUser->get()->getResultArray();
        $data['kategorial'] = count($kategorial);

        $this->pengaduanModel->select('*');
        $data['pengaduan'] = $this->pengaduanModel->countAllResults();


        //petugas
        $this->pengaduanModel->select('*');
        $this->pengaduanModel->where('status', '0');
        $data['belumverif'] = $this->pengaduanModel->countAllResults();

        $this->pengaduanModel->select('*');
        $this->pengaduanModel->where('status !=', '0');
        $data['verif'] = $this->pengaduanModel->countAllResults();

        $this->pengaduanModel->select('*');
        $this->pengaduanModel->where('status', 'tolak');
        $data['tolak'] = $this->pengaduanModel->countAllResults();

        $this->pengaduanModel->select('*');
        $this->pengaduanModel->where('level', 'urgent');
        $this->pengaduanModel->where('status', '0');
        $data['urgent'] = $this->pengaduanModel->countAllResults();


        //masyarakat
        $this->pengaduanModel->select('*');
        $this->pengaduanModel->where('status', '0');
        $this->pengaduanModel->where('userid', user()->id);
        $data['belum'] = $this->pengaduanModel->countAllResults();

        $this->pengaduanModel->select('*');
        $this->pengaduanModel->where('status', 'verifikasi');
        $this->pengaduanModel->where('userid', user()->id);
        $data['sudah'] = $this->pengaduanModel->countAllResults();

        $this->pengaduanModel->select('*');
        $this->pengaduanModel->where('status', 'proses');
        $this->pengaduanModel->where('userid', user()->id);
        $data['proses'] = $this->pengaduanModel->countAllResults();

        $this->pengaduanModel->select('*');
        $this->pengaduanModel->where('status', 'selesai');
        $this->pengaduanModel->where('userid', user()->id);
        $data['tertanggapi'] = $this->pengaduanModel->countAllResults();

        // dd($data['total']);
        // $data['verifikasi'] = $this->addUser->where('name', 'petugas')->countAllResults();

        // $kategorial = ['name !=' => 'masyarakat', 'name !=' => 'petugas', 'name !=' => 'admin'];
        // $this->addUser->where($kategorial);
        // $data['kategorial'] = $this->addUser->where($kategorial)->countAllResults();

        return view('admin/index', $data);

    }

    public function masyarakat()
    {
        $user = $this->userModel;
        
        // $users = new \Myth\Auth\Models\UserModel();
        // $data['users'] = $users->findAll();  
        $user->select('users.id as userid, telp, username, email, name');
        $user->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $user->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $user->where('name', 'masyarakat');
        
        $barrier = ['name' => 'masyarakat'];
        $keyword = $this->request->getVar('keyword');
        if($keyword){
            $user->like('username', $keyword)->where($barrier);
            $user->orLike('email', $keyword)->where($barrier);
            $user->orLike('telp', $keyword)->where($barrier);
        } else {
            $user = $this->userModel;
        }

        $this->query = $user->get();
        
        $data = [
            'title' => 'Masyarakat',
            'keyword' => $keyword,
            'users' => $this->query->getResult(),
        ];

        return view('admin/masyarakat', $data);
    }

    public function petugas()
    {
        $medis = 'medis';
        $user = $this->userModel;
        
        $user->select('users.id as userid, telp, username, email, name');
        $user->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $user->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $user->where('name !=', 'masyarakat');
        $user->Where('name !=', 'admin');
    
        $array = "name!='masyarakat' AND name!='admin'";
        $keyword = $this->request->getVar('keyword');
        if($keyword){
            $user->like('username', $keyword)->where($array);
            $user->orLike('email', $keyword)->where($array);
            $user->orLike('telp', $keyword)->where($array);
            $user->orLike('name', $keyword)->where($array);
        } else {
            $user = $this->userModel;
        }
        
        $this->query = $user->get();

        $data = [
            'title' => 'Manage User Petugas',
            'keyword' => $keyword,
            'users' => $this->query->getResult()
    ];
        
        return view('admin/petugas', $data);
    }

    public function divisi(){
        $this->kategori_groups->select('*');
        $this->kategori_groups->join('auth_groups', 'auth_groups.id = kategori_groups.group_id');
        $this->kategori_groups->join('kategori', 'kategori.id_kategori = kategori_groups.kategori_id');
        $query = $this->kategori_groups->get();

        $data = [
            'title' => 'Manage Divisi & Kategori',
            'kategori' => $query->getResult()
        ];

        return view('admin/divisi', $data);
    }

    public function tambahpetugas(){
        session();
        $this->authGroupsModel->select('*');
        $this->authGroupsModel->where('id !=', '1');
        $this->authGroupsModel->Where('id !=', '2');
        $this->query = $this->authGroupsModel->get();
        $data = [
            'divisi' => $this->query->getResult(),
            'title' => 'Tambah Petugas',
            'validation' => \Config\Services::validation()
        ];

        
        return view('admin/manageuser/add/addpetugas', $data);
    }

    public function tambahmasyarakat(){
        $data= [
            'title' => 'Tambah Masyarakat',
            'validation' => \Config\Services::validation()
        ];
        
        return view('admin/manageuser/add/addmasyarakat', $data);
    }

    public function tambahdivisi(){
        $data= [
            'title' => 'Tambah Kategori & Divisi',
            'validation' => \Config\Services::validation()
        ];
        
        return view('admin/manageuser/add/adddivisi', $data);
    }

    public function detail($id = 0)
    {
        $data['title'] = 'Detail User';

        $this->builder->select('users.id as userid, nik, username, fullname, telp, user_image, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $this->query = $this->builder->get();

        $data['user'] = $this->query->getRow();

        if(empty($data['user'])){
            return redirect()->to('/admin');
        }

        return view('admin/detail', $data);
    }

    public function delete($id){
        $img = $this->addUser->find($id);

        if($img['user_image'] != 'default.svg'){
            unlink('img/user-profile/' . $img['user_image']);
        }

        $this->builder->where('id', $id);
        $this->builder->delete();
         session()->setFlashdata('message', 'Data masyarakat berhasil dihapus');
         return redirect()->to('/admin/masyarakat');

    }

    public function deleteptg($id){
        $img = $this->addUser->find($id);

        if($img['user_image'] != 'default.svg'){
            unlink('img/user-profile/' . $img['user_image']);
        }

        $this->builder->where('id', $id);
        $this->builder->delete();
        session()->setFlashdata('message', 'Data petugas berhasil dihapus');
        return redirect()->to('/admin/petugas');

   }

   public function deletediv($id){

    $kategori_groups = $this->db->table('kategori_groups');
    $kategori = $this->db->table('kategori');
    $role = $this->db->table('auth_groups');

    $kategori_groups->select('*');
    $kategori_groups->join('auth_groups', 'auth_groups.id = kategori_groups.group_id');
    $kategori_groups->join('kategori', 'kategori.id_kategori = kategori_groups.kategori_id');
    $kategori_groups->where('id_cat', $id);
    $id_role = $kategori_groups->get()->getResult();

    
    $kategori->where('id_kategori', $id_role[0]->id_kategori);
    $kategori->delete();

    $role->where('id', $id_role[0]->id);
    $role->delete();

    session()->setFlashdata('message', 'Data petugas berhasil dihapus');
    return redirect()->to('/admin/divisi');

}
   

   public function addptgs(){

        if(!$this->validate([
            'fullname' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nama Lengkap wajib diisi'
				]
			],
			'username' => [
				'rules' => 'required|alpha_numeric|min_length[3]|max_length[30]|is_unique[users.username]',
				'errors' => [
					'required' => 'Username wajib diisi',
					'min_length' => 'Username minimum memiliki 3 character',
					'max_length' => 'Username maximum memiliki 30 character',
					'is_unique' => 'username sudah terdaftar',
					'alpha_numeric' => 'Username hanya boleh berisi alphanumeric character'
				]
			],
            'password'     => [
				'rules' => 'required|strong_password',
				'errors' => [
					'required' => 'Password wajib diisi',
					'strong_password' => 'Password kurang kuat'
				]
			],
			'pass_confirm' => [
				'rules' => 'required|matches[password]',
				'errors' =>[
					'required' => 'Confirm Password wajib diisi',
					'matches' => 'Confirm password tidak sama'
				]
			],
			'email'    => [
				'rules' => 'required|valid_email|is_unique[users.email]',
				'errors' => [
					'required' => 'Email wajib diisi',
					'valid_email' => 'Format Email tidak valid',
					'is_unique' => 'Email sudah terdaftar'
				]
			],
            'divisi' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Divisi wajib dipilih',
				]
			],
			'telp' => [
				'rules' => 'required|decimal',
				'errors' => [
					'required' => 'Nomor Telephone wajib diisi',
					'decimal' => 'Nomor telephone harus berisi angka'
				]
            ],

        ])) {            
            return redirect()->to('/admin/tambahpetugas')->withInput();
        }

        $password = Password::hash($this->request->getVar('password'));
        
        $data = [
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'fullname' => $this->request->getVar('fullname'),
            'telp' => $this->request->getVar('telp'),
            'password_hash' => $password,
            'active' => 1
        ];
        
        $divisi = $this->request->getVar('divisi');

        $this->addUser->insert($data);
        $last_id = $this->addUser->getInsertID();

        $this->authorize->addUserToGroup($last_id, $divisi);

        session()->setFlashdata('success', 'Registrasi petugas berhasil');
        return redirect()->to('/admin/petugas');
   }

   public function addDivisi(){

    if(!$this->validate([
        'divisi' => [
            'rules' => 'required|is_unique[auth_groups.name]',
            'errors' => [
                'required' => 'Nama Lengkap wajib diisi',
                'is_unique' => 'Divisi Sudah Terdaftar'
            ]
        ],
        'kategori' => [
            'rules' => 'required|is_unique[kategori.nama_kategori]',
            'errors' => [
                'required' => 'Kategori Wajib diisi',
                'is_unique' => 'Kategori Sudah Terdaftar',
            ]
        ],
    ])) {            
        return redirect()->to('/admin/tambahdivisi')->withInput();
    }
    
    $role_name = $this->request->getVar('divisi');
    $role = [
        'name' => $role_name,
        'description' => 'Petugas ' . $role_name
    ];
    
    $this->authGroupsModel->insert($role);
    $last_div = $this->authGroupsModel->getInsertID();
    
    $permis = $this->db->table('auth_groups_permissions');
    $permission = [
        'group_id' => $last_div,
        'permission_id' => '1'
    ];
    $permis->insert($permission);

    $kat_name = $this->request->getVar('kategori');
    $kategori = [
        'nama_kategori' => $kat_name,
        'description' => 'Kategori' . $role_name
    ];
    
    $this->kategori->insert($kategori);
    $last_kat = $this->kategori->getInsertID();

    $groups = [
        'group_id' => $last_div,
        'kategori_id' => $last_kat
    ];

    $this->kategoriModel->insert($groups);
   
    session()->setFlashdata('success', 'Divisi dan kategori sudah berhasil ditambahkan');
    return redirect()->to('/admin/divisi');
}

   public function addmasyarakat(){
    if(!$this->validate([
        'nik' => [
            'rules' =>'required|is_unique[users.nik]|decimal',
            'errors' => [
                'required' => 'NIK wajib diisi',
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
            'rules' => 'required|alpha_numeric|min_length[3]|max_length[30]|is_unique[users.username]',
            'errors' => [
                'required' => 'Username wajib diisi',
                'min_length' => 'Username minimum memiliki 3 character',
                'max_length' => 'Username maximum memiliki 30 character',
                'is_unique' => 'username sudah terdaftar',
                'alpha_numeric' => 'Username hanya boleh berisi alphanumeric character'
            ]
        ],
        'password'     => [
            'rules' => 'required|strong_password',
            'errors' => [
                'required' => 'Password wajib diisi',
                'strong_password' => 'Password kurang kuat'
            ]
        ],
        'pass_confirm' => [
            'rules' => 'required|matches[password]',
            'errors' =>[
                'required' => 'Confirm Password wajib diisi',
                'matches' => 'Confirm password tidak sama'
            ]
        ],
        'email'    => [
            'rules' => 'required|valid_email|is_unique[users.email]',
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
        ]

    ])) {            
        return redirect()->to('/admin/tambahmasyarakat')->withInput();
    }

    $password = Password::hash($this->request->getVar('password'));
    $data = [
         'nik' => $this->request->getVar('nik'),
         'email' => $this->request->getVar('email'),
         'username' => $this->request->getVar('username'),
         'fullname' => $this->request->getVar('fullname'),
         'telp' => $this->request->getVar('telp'),
         'password_hash' => $password,
         'active' => 1
    ];

    
    $this->addUser->insert($data);
    $last_id = $this->addUser->getInsertID();

    $this->authorize->addUserToGroup($last_id, 'masyarakat');

    session()->setFlashdata('success', 'Registrasi masyarakat berhasil');
    return redirect()->to('/admin/masyarakat');
    }

    public function editmasyarakat($id)
    {
        $data = [
            'title' => 'Edit Masyarakat',
            'validation' => \Config\Services::validation()
        ];
        $this->builder->select('users.id, nik, password_hash, username, fullname, telp, user_image, email');
        $this->builder->where('users.id', $id);
        $this->query = $this->builder->get();
        $data['user'] = $this->query->getRow();

        if(empty($data['user'])){
            return redirect()->to('/admin/masyarakat');
        }


        return view('admin/manageuser/edit/editmasyarakat', $data);
    }

    public function editpetugas($id){
        $data = [
            'title' => 'Edit Petugas',
            'validation' => \Config\Services::validation()
        ];

        $this->builder->select('users.id, password_hash, username, fullname, telp, user_image, email');
        $this->builder->where('users.id', $id);
        $this->query = $this->builder->get();
        $data['user'] = $this->query->getRow();

        if(empty($data['user'])){
            return redirect()->to('/admin/petugas');
        }
        return view('admin/manageuser/edit/editpetugas', $data);
    }

    public function update($id) {
        if(!$this->validate([
            'nik' => [
                'rules' =>'required|is_unique[users.nik,id,{id}]|decimal',
                'errors' => [
                    'required' => 'NIK wajib diisi',
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
            'pass_confirm' => [
                'rules' => 'matches[password]',
                'errors' =>[
                    'matches' => 'Confirm password tidak sama'
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
                
    
        ])) {            
            return redirect()->to('/admin/editmasyarakat/' . $id)->withInput();
        }

        $pass = $this->request->getVar('password');
        if (!empty($pass)) {
        
            
        $password = Password::hash($this->request->getVar('password'));
        $data = [
         'nik' => $this->request->getVar('nik'),
         'email' => $this->request->getVar('email'),
         'username' => $this->request->getVar('username'),
         'fullname' => $this->request->getVar('fullname'),
         'telp' => $this->request->getVar('telp'),
         'password_hash' => $password
        ]; } else {
            $data = [
                'nik' => $this->request->getVar('nik'),
                'email' => $this->request->getVar('email'),
                'username' => $this->request->getVar('username'),
                'fullname' => $this->request->getVar('fullname'),
                'telp' => $this->request->getVar('telp')
            ];
        }

        $this->builder->set($data);
        $this->builder->where('id', $id);
        $this->builder->update();

        session()->setFlashdata('success', 'Data Masyarakat berhasil diubah');
        return redirect()->to('/admin/detail/' . $id);
    }
    
    public function updateptgs($id) {

        if(!$this->validate([
            'fullname' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nama Lengkap wajib diisi'
				]
			],
			'username' => [
				'rules' => 'required|alpha_numeric|min_length[3]|max_length[30]|is_unique[users.username, id, {id}]',
				'errors' => [
					'required' => 'Username wajib diisi',
					'min_length' => 'Username minimum memiliki 3 character',
					'max_length' => 'Username maximum memiliki 30 character',
					'is_unique' => 'username sudah terdaftar',
					'alpha_numeric' => 'Username hanya boleh berisi alphanumeric character'
				]
			],
			'pass_confirm' => [
				'rules' => 'matches[password]',
				'errors' =>[
					'matches' => 'Confirm password tidak sama'
				]
			],
			'email'    => [
				'rules' => 'required|valid_email|is_unique[users.email, id, {id}]',
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
			]

        ])) {            
            return redirect()->to('/admin/editpetugas/' . $id)->withInput();
        }


        $pass = $this->request->getVar('password');
        if (!empty($pass)) {
        $password = Password::hash($this->request->getVar('password'));
        $data = [
         'nik' => $this->request->getVar('nik'),
         'email' => $this->request->getVar('email'),
         'username' => $this->request->getVar('username'),
         'fullname' => $this->request->getVar('fullname'),
         'telp' => $this->request->getVar('telp'),
         'password_hash' => $password
        ]; } else {
            $data = [
                'nik' => $this->request->getVar('nik'),
                'email' => $this->request->getVar('email'),
                'username' => $this->request->getVar('username'),
                'fullname' => $this->request->getVar('fullname'),
                'telp' => $this->request->getVar('telp')
            ];
        }

        $this->builder->set($data);
        $this->builder->where('id', $id);
        $this->builder->update();

        session()->setFlashdata('success', 'Data petugas berhasil diubah');
        return redirect()->to('/admin/detail/' . $id);
    }

}
