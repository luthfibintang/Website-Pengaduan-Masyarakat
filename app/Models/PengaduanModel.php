<?php namespace App\Models;

use CodeIgniter\Model;


class PengaduanModel extends Model
{
    protected $table = 'pengaduan';
    protected $primaryKey = 'id_pengaduan';
    protected $allowedFields = [
        'userid', 'nik_masyarakat', 'judul', 'id_kategori', 'kategori', 'tgl_pengaduan', 'isi_laporan', 'foto', 'level', 'status'
    ];

}

?>