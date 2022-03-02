<?php namespace App\Models;

use CodeIgniter\Model;

class AuthGroupsUsers extends Model
{

    protected $table = 'auth_groups_users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['groups_id', 'user_id'];
}


?>