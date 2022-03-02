<?php namespace App\Models;

use CodeIgniter\Model;

class CatgroupsModel extends Model
{

    protected $table = 'kategori_groups';
    protected $primaryKey = 'id_cat';
    protected $allowedFields = ['kategori_id', 'group_id'];

}


?>