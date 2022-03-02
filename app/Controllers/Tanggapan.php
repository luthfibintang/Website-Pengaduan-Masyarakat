<?php

namespace App\Controllers;

use App\Models\TanggapanModel;
use App\Models\PengaduanModel;
use App\Models\AuthGroupsUsers;
use App\Models\CatgroupsModel;

class Tanggapan extends BaseController
{

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('tanggapan');
        $this->user = $this->db->table('users');
        $this->pengaduan = $this->db->table('pengaduan');
        $this->tanggapanModel = new TanggapanModel;    
        $this->pengaduanModel = new PengaduanModel;
        $this->authGroupsUsers = new AuthGroupsUsers();
        $this->catModel = new CatgroupsModel();

        $userid = user_id();
        $getgroup = $this->authGroupsUsers->find($userid);
        $this->getcat = $this->catModel->where('group_id', $getgroup['group_id'])->find();
    }
    
    public function index($id) {
        
        $this->pengaduan->select('*');
        $this->pengaduan->where('id_pengaduan', $id);
        $this->query = $this->pengaduan->get();
        
        
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

    public function tanggapi(){
        if(!$this->validate([
			'tanggapan' => [
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
            ]

        ])) {            
            return redirect()->to('/tanggapan/index/' . $this->request->getVar('id_pengaduan'))->withInput();
        }

        $fileProfile = $this->request->getFile('foto');

        if($fileProfile->getError() == 4) {
            $namaprofile = 'download.jpg';
        } else {
            $namaprofile = $fileProfile->getRandomName();
            $fileProfile->move('img/tanggapan', $namaprofile);
        }
        
            $data = [
                'id_petugas' => user()->id,
                'id_pengaduan' => $this->request->getVar('id_pengaduan'),
                'tgl_tanggapan' => date('Y-m-d'),
                'tanggapan' => $this->request->getVar('tanggapan'),
                'foto' => $namaprofile,
            ];

        $status = [
            'status' => 'selesai'
        ];
        $this->tanggapanModel->insert($data);

        $this->pengaduan->set($status);
        $this->pengaduan->where('id_pengaduan', $this->request->getVar('id_pengaduan'));
        $this->pengaduan->update();
        
        if(has_permission('kategorial')){
        session()->setFlashdata('success', 'Pengaduan Berhasil di tanggapi');
        return redirect()->to('/pengaduan/proses_details');
        } else {
        session()->setFlashdata('success', 'Pengaduan Berhasil di tanggapi');
        return redirect()->to('/pengaduan/verifikasi');
        }
        
        // session()->setFlashdata('success', 'Registrasi petugas berhasil');
    }

    public function selesai(){
        
        $kategori = $this->getcat;

        $this->pengaduanModel->select('*');
        $this->pengaduanModel->join('tanggapan', 'tanggapan.id_pengaduan = pengaduan.id_pengaduan');
        $this->pengaduanModel->join('kategori', 'kategori.id_kategori = pengaduan.id_kategori');
        $this->pengaduanModel->where('status', 'selesai');
        $this->pengaduanModel->where('pengaduan.id_kategori', $kategori[0]['kategori_id']);

        $barrier = ['kategori.id_kategori' => $kategori[0]['kategori_id'], 'pengaduan.status' => 'selesai'];
        $keyword = $this->request->getVar('keyword');
        if($keyword){
                $this->pengaduanModel->like('judul', $keyword)->where($barrier);
                $this->pengaduanModel->orLike('tgl_pengaduan', $keyword)->where($barrier);
                $this->pengaduanModel->orLike('pengaduan.status', $keyword)->where($barrier);
            } else {
                    $this->pengaduanModel = $this->pengaduanModel;
                }
        $this->pengaduanModel->orderBy('level', 'desc');
        $this->pengaduanModel->orderBy('pengaduan.id_pengaduan', 'desc');
        $this->query = $this->pengaduanModel->get();
        $data = [
            'title' => 'Pengaduan selesai',
            // 'pengaduan' => $this->pengaduanModel->paginate(5),
            // 'pager' => $this->pengaduanModel->pager,
            'pengaduan' => $this->query->getResultArray(),
            'keyword' => $keyword,
        ];
        
        return view('tanggapan/pengaduan-selesai/index', $data);
    }

    public function detail($id){

        $categories = $this->getcat; 
        $kategori = $categories[0]['kategori_id'];

        $this->pengaduanModel->select('*');
        $this->pengaduanModel->join('kategori', 'kategori.id_kategori = pengaduan.id_kategori');
        $this->pengaduanModel->where('id_pengaduan', $id);
        $this->query = $this->pengaduanModel->get();
        
        $this->builder->select('tanggapan.id_tanggapan, id_pengaduan, tanggapan, id_petugas, tgl_tanggapan, foto');
        $this->builder->where('id_pengaduan', $id);
        $this->sql = $this->builder->get();
        
        $data = [
            'title' => 'Detail Pengaduan',
            'pengaduan' => $this->query->getRow(),
            'tanggapan' => $this->sql->getRow(),
            'validation' => \Config\Services::validation(),
        ];

        if(empty($data['pengaduan']) || empty($data['tanggapan']) || $data['pengaduan']->id_kategori != $kategori){
            return redirect()->to('/tanggapan/selesai');
        }
        

        if($data['pengaduan']->status == 'selesai' ){
            return view('tanggapan/pengaduan-selesai/detail', $data);
        } else {
            return redirect()->to('tanggapan/selesai');
        }
    }


    public function tanggapiall() {
        
        if(isset($_POST['btntanggapi'])){
            if(!empty($this->request->getVar('checkbox_value'))){
                $test = $this->request->getVar('checkbox_value');
                $checkid = [];
                foreach ($test as $t){
                    array_push($checkid, $t);
                }
            } else{
                session()->setFlashdata('success', 'Select data setidaknya satu');
                return redirect()->to('/pengaduan/proses_details');
            }
        }
        
        $data = [
            'title' => 'Tulis Tanggapan',
            'pengaduan' => $checkid,
            'validation' => \Config\Services::validation()
        ];

        // dd($data['pengaduan']);
        return view('tanggapan/pengaduan-proses/banyaktanggapan', $data);
    }
    
    public function multiinsert(){
        if(!$this->validate([
			'tanggapan' => [
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
            ]

        ])) {            
            return redirect()->to('/tanggapan/index/' . $this->request->getVar('id_pengaduan'))->withInput();
        }

        $fileProfile = $this->request->getFile('foto');

        if($fileProfile->getError() == 4) {
            $namaprofile = 'download.jpg';
        } else {
            $namaprofile = $fileProfile->getRandomName();
            $fileProfile->move('img/tanggapan', $namaprofile);
        }

        $cat = $this->request->getVar('id_pengaduan');

        foreach($cat as $k){
            $data = [
                'id_petugas' => user()->id,
                'id_pengaduan' => $k,
                'tgl_tanggapan' => date('Y-m-d'),
                'tanggapan' => $this->request->getVar('tanggapan'),
                'foto' => $namaprofile,
            ];


        $status = [
            'status' => 'selesai'
        ];
        $this->tanggapanModel->insert($data);

        $this->pengaduan->set($status);
        $this->pengaduan->where('id_pengaduan', $k);
        $this->pengaduan->update();

    }
        
        session()->setFlashdata('success', 'Pengaduan Berhasil di tanggapi');
        return redirect()->to('/pengaduan/proses_details');
        // session()->setFlashdata('success', 'Registrasi petugas berhasil');
    }

}