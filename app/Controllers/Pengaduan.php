<?php

namespace App\Controllers;

use App\Models\PengaduanModel;
use App\Models\TanggapanModel;
use App\Models\AuthGroupsUsers;
use App\Models\CatgroupsModel;

class Pengaduan extends BaseController
{
    public function __construct()
    {
        $this->kategoriModel = new CatgroupsModel();
        $this->authGroupsUsers = new AuthGroupsUsers();
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('pengaduan');
        $this->tanggapan = $this->db->table('tanggapan');
        $this->build = $this->db->table('users');
        $this->category = $this->db->table('kategori');
        $this->pengaduanModel = new PengaduanModel();   
        $this->tanggapanModel = new TanggapanModel(); 

        //mengidentifikasikan group_id pada table kategori_groups berdasarkan session user yang login
        $userid = user_id();
        $getgroup = $this->authGroupsUsers->find($userid);
        $this->getcat = $this->kategoriModel->where('group_id', $getgroup['group_id'])->find(); 
    }

    public function index()
    {
        $this->category->select('kategori.id_kategori, nama_kategori');
        $this->query = $this->category->get();


        $data = [
            'category' => $this->query->getResult(),
            'title' => 'Tulis Pengaduan',
            'validation' => \Config\Services::validation()
        ];

        return view('user/masyarakat/pengaduan', $data);
    }
    
    public function details(){
        
        $pengaduan = $this->pengaduanModel;
        
        $pengaduan->select('pengaduan.status, id_pengaduan, userid, judul, tgl_pengaduan');
        $pengaduan->join('users', 'users.id = pengaduan.userid');
        $pengaduan->where('userid', user()->id);
        $pengaduan->orderBy('pengaduan.status', 'asc');
        
        $keyword = $this->request->getVar('keyword');
        if($keyword){
                $pengaduan->where('userid', user()->id)->like('judul', $keyword);
                $pengaduan->where('userid', user()->id)->orLike('tgl_pengaduan', $keyword);
                $pengaduan->where('userid', user()->id)->orLike('pengaduan.status', $keyword);
            } else {
                    $pengaduan = $this->pengaduanModel;
                }
        
        $this->query = $pengaduan->get();
        $data = [
            'title' => 'Detail Pengaduan',
            // 'pengaduan' => $pengaduan->paginate(5),
            // 'pager' => $pengaduan->pager,
            'pengaduan' => $this->query->getResultArray(),
            'keyword' => $keyword,
        ];

        return view('user/masyarakat/details/detail', $data);
    }


    public function detail($id){

        $data = [
            'title' => 'Detail Pengaduan',
        ];

        $this->builder->select('pengaduan.status, id_pengaduan, nik_masyarakat, isi_laporan, foto, userid, judul, tgl_pengaduan');
        $this->builder->join('users', 'users.id = pengaduan.userid');
        $this->builder->where('id_pengaduan', $id);
        $this->query = $this->builder->get();

        $data['pengaduan'] = $this->query->getResultArray();

        if(empty($data['pengaduan'])){
            return redirect()->to('/pengaduan/details');
        }

        if($data['pengaduan'][0]['userid'] != user()->id){
            return redirect()->to('pengaduan/details');
        }


        return view('user/masyarakat/details/pengaduan-detail', $data);
    }

    public function selesai($id){

        $data = [
            'title' => 'Detail Pengaduan',
            'validation' => \Config\Services::validation()
        ];

        $this->builder->select('pengaduan.status, id_pengaduan, nik_masyarakat, isi_laporan, foto, userid, judul, tgl_pengaduan');
        $this->builder->join('users', 'users.id = pengaduan.userid');
        $this->builder->where('id_pengaduan', $id);
        $this->builder->where('userid', user()->id);
        $this->query = $this->builder->get();
        $data['pengaduan'] = $this->query->getRow();

        $this->tanggapan->select('tanggapan.id_tanggapan, id_pengaduan, tanggapan, id_petugas, tgl_tanggapan, foto');
        $this->tanggapan->where('id_pengaduan', $id);
        $this->sql = $this->tanggapan->get();

        $data['tanggapan'] = $this->sql->getRow();

        if(empty($data['pengaduan']) || empty($data['tanggapan'])){
            return redirect()->to('/pengaduan/details');
        }

        if($data['pengaduan']->status == 'selesai' ){
            return view('user/masyarakat/details/tanggapan', $data);
        } else {
            return redirect()->to('pengaduan/details');
        }
    }

    public function tulis(){
        // $user = user()->id;
        // foreach($kat as $k) {
        //     $cek = [
        //         'user' => $user,
        //         'kategori' => $kat
        //     ];
        //     dd($cek);
        // }
        if(!$this->validate([
            'judul' => [
				'rules' => 'required|min_length[3]|max_length[50]',
				'errors' => [
					'required' => 'Judul wajib diisi',
					'min_length' => 'Judul minimum memiliki 3 character',
					'max_length' => 'Judul maximum memiliki 50 character',
				]
			],
			'isi_laporan' => [
				'rules' => 'required|min_length[8]',
				'errors' => [
					'required' => 'Isi laporan wajib diisi',
					'min_length' => 'Isi laporan minimum memiliki 8 character',
				]
			],
			'foto' => [
                'rules' => 'max_size[foto,6000]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/svg]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Harus berupa gambar',
                    'mime_in' => 'Harus berupa gambar'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori wajib diisi',
                ]
            ]

        ])) {            
            return redirect()->to('/pengaduan')->withInput();
        }

        $fileProfile = $this->request->getFile('foto');

        if($fileProfile->getError() == 4) {
            $namaprofile = 'download.jpg';
        } else {
            $namaprofile = $fileProfile->getRandomName();
            $fileProfile->move('img/pengaduan', $namaprofile);
        }
        $level = $this->request->getVar('urgent');
        $kat = $this->request->getVar('kategori');
        foreach ($kat as $k){
        $data = [
            'userid' => user()->id,
            'nik_masyarakat' => user()->nik,
            'tgl_pengaduan' => date('Y-m-d'),
            'judul' => $this->request->getVar('judul'),
            'isi_laporan' => $this->request->getVar('isi_laporan'),
            'foto' => $namaprofile,
            'status' => '0',
            'id_kategori' => $k,
        ];
        if(empty($level)){
            $data['level'] = 'biasa';
        } else{
            $data['level'] = 'urgent';
        }
        $this->pengaduanModel->insert($data);
    }
        session()->setFlashdata('success', 'Pengaduan sudah berhasil, harap menunggu konfirmasi petugas');
        return redirect()->to('/pengaduan/details');
        // session()->setFlashdata('success', 'Registrasi petugas berhasil');

    }

    public function delete($id){

        $this->builder->select('pengaduan.id_pengaduan, userid, judul, isi_laporan, foto');
        $this->builder->where('id_pengaduan', $id);
        $this->query = $this->builder->get();
        $data['pengaduan'] = $this->query->getRow();
        if($data['pengaduan']->userid != user()->id){
            return redirect()->to('/pengaduan/details');
        }

        $img = $this->pengaduanModel->find($id);

        if($img['foto'] != 'download.jpg'){
            unlink('img/pengaduan/' . $img['foto']);
        }

        $this->builder->where('id_pengaduan', $id);
        $this->builder->delete();
        session()->setFlashdata('message', 'Pengaduan berhasil dihapus');
        return redirect()->to('/pengaduan/details');

    }

    public function editform($id) {
        $this->builder->select('pengaduan.id_pengaduan, userid, judul, isi_laporan, foto, pengaduan.id_kategori, nama_kategori');
        $this->builder->join('kategori', 'kategori.id_kategori = pengaduan.id_kategori');
        $this->builder->where('pengaduan.id_pengaduan', $id);
        $this->query = $this->builder->get();
        
        $this->category->select('kategori.id_kategori, nama_kategori');
        $this->kategori = $this->category->get();
        $data = [
            'title' => 'Edit Masyarakat',
            'pengaduan' => $this->query->getRow(),
            'category' => $this->kategori->getResult(),
            'validation' => \Config\Services::validation()
        ];

        if(empty($data['pengaduan'])){
            return redirect()->to('/pengaduan/details');
        }

        if($data['pengaduan']->userid != user()->id){
            return redirect()->to('pengaduan/details');
        }

        return view('user/masyarakat/editpengaduan', $data);
    }

    public function edit($id) {
        if(!$this->validate([
            'judul' => [
				'rules' => 'required|min_length[3]|max_length[30]',
				'errors' => [
					'required' => 'Judul wajib diisi',
					'min_length' => 'Judul minimum memiliki 3 character',
					'max_length' => 'Judul maximum memiliki 30 character',
				]
			],
			'isi_laporan' => [
				'rules' => 'required|min_length[8]',
				'errors' => [
					'required' => 'Isi laporan wajib diisi',
					'min_length' => 'Isi laporan minimum memiliki 8 character',
				]
			],
			'foto' => [
                'rules' => 'max_size[foto,6000]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/svg]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Harus berupa gambar',
                    'mime_in' => 'Harus berupa gambar'
                ]
            ],
            'kategori' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Kategori Wajib diisi'
				]
			],

        ])) {            
            return redirect()->to('/pengaduan/editform/' . $id)->withInput();
        }
        $oldfoto = $this->request->getVar('old-foto');


        $fileProfile = $this->request->getFile('foto');

        if($fileProfile->getError() == 4) {
            $namaprofile = $oldfoto;
        } else {
            $namaprofile = $fileProfile->getName();
            $fileProfile->move('img/pengaduan', $namaprofile);
            if ($oldfoto != 'download.jpg') {
                unlink('img/pengaduan/' . $oldfoto);
            }
        }

        $data = [
            'judul' => $this->request->getVar('judul'),
            'isi_laporan' => $this->request->getVar('isi_laporan'),
            'foto' => $namaprofile,
            'id_kategori' => $this->request->getVar('kategori') ];
        
            $this->builder->set($data);
            $this->builder->where('id_pengaduan', $id);
            $this->builder->update();
            
            session()->setFlashdata('success', 'Pengaduan berhasil diubah');
            return redirect()->to('/pengaduan/details');
    }

    public function verifikasi(){
        $pengaduan = $this->pengaduanModel;
        $pengaduan->select('*');
        $pengaduan->where('status', '0');
        $pengaduan->orderBy('level', 'desc');
        $pengaduan->orderBy('id_pengaduan', 'desc');
        
        $keyword = $this->request->getVar('keyword');
        if($keyword){
            $pengaduan->like('judul', $keyword);
            $pengaduan->orLike('tgl_pengaduan', $keyword);
            $pengaduan->orLike('pengaduan.status', $keyword);
        } else {
            $pengaduan = $this->pengaduanModel;
        }
        $this->query = $pengaduan->get();

        $data = [
            'title' => 'Verifikasi Pengaduan',
            'pengaduan' => $this->query->getResultArray(),
            'keyword' => $keyword,
        ];
        
        $nonverif = $this->pengaduanModel;
        $nonverif->select('*');
        $nonverif->where('status !=', '0');
        $nonverif->orderBy('status', 'asc');
        $nonverif->orderBy('level', 'desc');
        $nonverif->orderBy('id_pengaduan', 'desc');
        
        $keyword2 = $this->request->getVar('keywordd');
        if($keyword2){
            $nonverif->like('judul', $keyword2);
            $nonverif->orLike('tgl_pengaduan', $keyword2);
            $nonverif->orLike('pengaduan.status', $keyword2);
        } else {
            $nonverif = $this->pengaduanModel;
        }
        $this->test = $nonverif->get();
        $data['nonverif'] = $this->test->getResultArray();
        $data['keyword2'] = $keyword2;

        return view('user/petugas/verifikasi', $data);
    }

    
    public function verifikasi_detail($id){

        
        $this->builder->select('pengaduan.status, id_pengaduan, nik_masyarakat, isi_laporan, foto, userid, judul, tgl_pengaduan, nama_kategori, level, pengaduan.id_kategori');
        $this->builder->join('kategori', 'kategori.id_kategori = pengaduan.id_kategori');
        $this->builder->where('id_pengaduan', $id);
        $this->query = $this->builder->get();
        
        $this->category->select('*');
        $this->cat = $this->category->get();
        
        
        $data = [
            'title' => 'Detail Pengaduan',
            'pengaduan' => $this->query->getRow(),
            'category' => $this->cat->getResult(),
            'validation' => \Config\Services::validation()
        ];
        
        if(empty($data['pengaduan'])){
            return redirect()->to('/pengaduan/detail');
        }
        
        
        return view('user/petugas/verifikasi-detail.php', $data);
    }
    
    public function verifikasi_pengaduan($id) {
        
        if(!$this->validate([
            'kategori' => [
                'rules' => 'required',
				'errors' => [
					'required' => 'Kategori wajib dipilih',
				]
			],
        ])) {            
            return redirect()->to('/pengaduan/verifikasi_detail/' . $id)->withInput();
        }
        
        if(isset($_POST['tolak'])){
            $data = [
                'status' => 'tolak',
            ];
            
            $this->builder->set($data);
                $this->builder->where('id_pengaduan', $id);
                $this->builder->update();

                session()->setFlashdata('success', 'Pengaduan berhasil di verifikasi');
                return redirect()->to('/pengaduan/verifikasi');
            }elseif(isset($_POST['tanggap'])){
                
                $this->builder->select('*');
                $this->builder->where('id_pengaduan', $id);
                $this->query = $this->builder->get();
                
                
                $data = [
                    'title' => 'Tulis Tanggapan',
                    'pengaduan' => $this->query->getRow(),
                    'validation' => \Config\Services::validation()
                ];

                if(empty($data['pengaduan'])){
                    return redirect()->to('/pengaduan/proses_details');
                }

                return view('tanggapan/pengaduan-proses/tanggapan', $data);

            }
             else {
                
                $data = [
                    'status' => 'verifikasi',
                    'id_kategori' => $this->request->getVar('kategori'),
                    'level' => $this->request->getVar('level')
                ];
                
                $this->builder->set($data);
                $this->builder->where('id_pengaduan', $id);
                $this->builder->update();
                
                session()->setFlashdata('success', 'Pengaduan berhasil di verifikasi');
                return redirect()->to('/pengaduan/verifikasi');
            }
        }
        
        public function verifikasiall(){
            if(isset($_POST['btnverif'])){
                if(!empty($this->request->getVar('check_pengaduan'))){
                    $test = $this->request->getVar('check_pengaduan');
                    foreach ($test as $t){
                        $data = [
                            'status' => 'verifikasi'
                        ];
                        
                        $this->builder->set($data);
                        $this->builder->where('id_pengaduan', $t);
                        $this->builder->update();
                    }

                    
                    session()->setFlashdata('success', 'Pengaduan yang dipilih berhasil di verifikasi');
                    return redirect()->to('/pengaduan/verifikasi');

                } else{
                    session()->setFlashdata('message', 'Select data setidaknya satu');
                    return redirect()->to('/pengaduan/verifikasi');
                }

            }

            if(isset($_POST['btntolak'])){
                if(!empty($this->request->getVar('check_pengaduan'))){
                    $test = $this->request->getVar('check_pengaduan');
                    foreach ($test as $t){
                        $data = [
                            'status' => 'tolak',
                        ];
                        $this->builder->set($data);
                        $this->builder->where('id_pengaduan', $t);
                        $this->builder->update();
                    }

                    session()->setFlashdata('success', 'Pengaduan berhasil di tolak');
                    return redirect()->to('/pengaduan/verifikasi');

                } else{
                    session()->setFlashdata('message', 'Select data setidaknya satu');
                    return redirect()->to('/pengaduan/verifikasi');
                }
            }
            
        }

    public function masuk(){
        $pengaduan = $this->pengaduanModel;
        $kategori = $this->getcat[0]['kategori_id'];
    
        $pengaduan->select('*');
        $pengaduan->join('kategori', 'kategori.id_kategori = pengaduan.id_kategori');
        $pengaduan->where('pengaduan.status', 'verifikasi');
        $pengaduan->where ('kategori.id_kategori', $kategori);

        $barrier = ['kategori.id_kategori' => $kategori, 'pengaduan.status' => 'verifikasi'];
        $keyword = $this->request->getVar('keyword');
        if($keyword){
                $pengaduan->like('judul', $keyword)->where($barrier);
                $pengaduan->orLike('pengaduan.tgl_pengaduan', $keyword)->where($barrier);
                $pengaduan->orLike('pengaduan.status', $keyword)->where($barrier);
            } else {
                    $pengaduan = $this->pengaduanModel;
                }
        $pengaduan->orderBy('level', 'desc');
        $pengaduan->orderBy('id_pengaduan', 'desc');
        $this->query = $pengaduan->get();
        $data = [
            'title' => 'Pengaduan Masuk',
            // 'pengaduan' => $pengaduan->paginate(5),
            // 'pager' => $pengaduan->pager,
            'pengaduan' => $this->query->getResultArray(),
            'keyword' => $keyword,
        ];
        
        return view('tanggapan/pengaduan-masuk/pengaduan', $data);
    }

    public function masuk_detail($id){
        $kategori = $this->getcat[0]['kategori_id'];

        $data = [
            'title' => 'Detail Pengaduan',
            'validation' => \Config\Services::validation()
        ];

        $this->builder->select('*');
        $this->builder->join('kategori', 'kategori.id_kategori = pengaduan.id_kategori');
        $this->builder->where('id_pengaduan', $id);
        $this->query = $this->builder->get();

        $data['pengaduan'] = $this->query->getRow();

        if(empty($data['pengaduan']) || $data['pengaduan']->id_kategori != $kategori){
            return redirect()->to('/pengaduan/masuk');
        }

        if($data['pengaduan']->status == 'verifikasi' ){
            return view('tanggapan/pengaduan-masuk/pengaduan-detail', $data);
        } else {
            return redirect()->to('pengaduan/masuk');
        }
    }

    public function proses($id) {

        $data = [
            'status' => 'proses'
        ];
        
            $this->builder->set($data);
            $this->builder->where('id_pengaduan', $id);
            $this->builder->update();
            
            session()->setFlashdata('success', 'Pengaduan berhasil di proses');
            return redirect()->to('/pengaduan/masuk');
    }

    public function prosesall(){
        if(isset($_POST['btnproses'])){
            if(!empty($this->request->getVar('check_pengaduan'))){
                $test = $this->request->getVar('check_pengaduan');
                foreach ($test as $t){
                    $data = [
                        'status' => 'proses'
                    ];
                    
                    $this->builder->set($data);
                    $this->builder->where('id_pengaduan', $t);
                    $this->builder->update();
                }

                
                session()->setFlashdata('success', 'Pengaduan berhasil di proses');
                return redirect()->to('/pengaduan/masuk');

            } else{
                session()->setFlashdata('message', 'Select data setidaknya satu');
                return redirect()->to('/pengaduan/masuk');
            }

        }
    }

    public function proses_details(){
        $pengaduan = $this->pengaduanModel;
        $kategori = $this->getcat[0]['kategori_id'];

        $pengaduan->select('*');
        $pengaduan->join('kategori', 'kategori.id_kategori = pengaduan.id_kategori');
        $pengaduan->where('pengaduan.status', 'proses');
        $pengaduan->where('kategori.id_kategori', $kategori);

        $barrier = ['kategori.id_kategori' => $kategori, 'pengaduan.status' => 'proses'];
        $keyword = $this->request->getVar('keyword');
        if($keyword){
                $pengaduan->like('judul', $keyword)->where($barrier);
                $pengaduan->orLike('tgl_pengaduan', $keyword)->where($barrier);
                $pengaduan->orLike('pengaduan.status', $keyword)->where($barrier);
            } else {
                    $pengaduan = $this->pengaduanModel;
                }
        $pengaduan->orderBy('level', 'desc');
        $pengaduan->orderBy('id_pengaduan', 'desc');
        $this->query = $pengaduan->get();
        $data = [
            'title' => 'Pengaduan Masuk',
            // 'pengaduan' => $pengaduan->paginate(5),
            // 'pager' => $pengaduan->pager,
            'pengaduan' => $this->query->getResultArray(),
            'keyword' => $keyword,
        ];
        return view('tanggapan/pengaduan-proses/index', $data);
    }

    public function proses_detail($id){

        $data = [
            'title' => 'Detail Pengaduan',
            'validation' => \Config\Services::validation()
        ];
        $kategori = $this->getcat[0]['kategori_id'];

        $this->builder->select('*');
        $this->builder->join('kategori', 'kategori.id_kategori = pengaduan.id_kategori');
        $this->builder->where('id_pengaduan', $id);
        $this->query = $this->builder->get();

        $data['pengaduan'] = $this->query->getRow();

        // dd($data);

        if(empty($data['pengaduan'])|| $data['pengaduan']->id_kategori != $kategori){
            return redirect()->to('/pengaduan/proses_details');
        }

        if($data['pengaduan']->status == 'proses' ){
            return view('tanggapan/pengaduan-proses/pengaduan-detail', $data);
        } else {
            return redirect()->to('pengaduan/proses_details');
        }
    }
}
