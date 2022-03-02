<?php namespace App\Models;

use CodeIgniter\Model;

class AddUserModel extends Model
{

    protected $table = 'users';
    protected $allowedFields = [
        'email', 'username', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash',
        'status', 'status_message', 'active', 'force_pass_reset', 'permissions', 'deleted_at',
        'fullname', 'nik', 'telp',
    ];
}


?>