<?php

namespace App\Controllers;

use App\Models\TanggapanModel;
use App\Models\PengaduanModel;

class Laporan extends BaseController
{
    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('tanggapan');
        $this->user = $this->db->table('users');
        $this->pengaduan = $this->db->table('pengaduan');
        $this->category = $this->db->table('kategori');
        $this->tanggapanModel = new TanggapanModel;    
        $this->pengaduanModel = new PengaduanModel;
    }

    public function index(){
        $this->category->select('kategori.id_kategori, nama_kategori');
        $this->query = $this->category->get();
        
        $data = [
            'title' => 'Generate Laporan',
            'kategori' => $this->query->getResult()
        ];

        return view('laporan/index', $data);
    }

    public function getLaporan(){
            $data = [
                'title' => 'Generate Laporan',
            ];

            $from = $this->request->getVar('from');
            $to = $this->request->getVar('to');
            $cat = $this->request->getVar('kategori');
            $stat = $this->request->getVar('status');

            $this->pengaduan->select('*');
            $this->pengaduan->join('kategori', 'kategori.id_kategori = pengaduan.id_kategori');
            if($from != null){
            $this->pengaduan->where('tgl_pengaduan >=', $from);
            }
            if($to != null) {
            $this->pengaduan->where('tgl_pengaduan <=', $to);
            } 
            if($cat != null){
            $this->pengaduan->where('pengaduan.id_kategori', $cat);
            }
            if($stat != null){
                $this->pengaduan->where('pengaduan.status', $stat);
            }
            $this->pengaduan->orderBy('tgl_pengaduan', "asc");
            $this->query = $this->pengaduan->get();

    
            $data['pengaduan'] = $this->query->getResult();
            return view('laporan/print', $data);
    }

    // public function printpdf(){
    //     $data = [
    //         'title' => 'Generate Laporan',
    //     ];

    //     $from = $this->request->getVar('from');
    //     $to = $this->request->getVar('to');

    //     $this->pengaduan->select('pengaduan.id_pengaduan, isi_laporan, status, judul, kategori, userid, judul, tgl_pengaduan, tgl_tanggapan');
    //     $this->pengaduan->join('tanggapan', 'tanggapan.id_pengaduan = pengaduan.id_pengaduan');
    //     if($from != null){
    //     $this->pengaduan->where('tgl_pengaduan >=', $from);
    //     }elseif($to != null) {
    //     $this->pengaduan->where('tgl_pengaduan <=', $to);
    //     }
    //     $this->pengaduan->where('status', 'selesai');
    //     $this->pengaduan->orderBy('tgl_pengaduan', "asc");
    //     $this->query = $this->pengaduan->get();


    //     $data['pengaduan'] = $this->query->getResult();
        // $html = view('laporan/index', $data);

        // $this->dompdf->loadHtml('hello World');
        // $this->dompdf->setPaper('A4', 'landscape');
        // $this->dompdf->render();
        // $this->dompdf->stream();
    // }

}