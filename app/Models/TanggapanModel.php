<?php namespace App\Models;

use CodeIgniter\Model;


class TanggapanModel extends Model
{
    protected $primaryKey = 'id_tanggapan';
    protected $table = 'tanggapan';
    protected $allowedFields = [
        'id_pengaduan', 'id_petugas', 'tgl_tanggapan', 'tanggapan', 'kategori', 'foto',
    ];

}

?>