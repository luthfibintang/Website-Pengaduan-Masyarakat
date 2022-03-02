<?php namespace App\Models;

use Myth\Auth\Models\UserModel as MythModel;
use Myth\Auth\Entities\User;


class UserModel extends MythModel
{
    protected $returnType = User::class;
    protected $table = 'users';
    protected $allowedFields = [
        'email', 'username', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash',
        'status', 'status_message', 'active', 'force_pass_reset', 'permissions', 'deleted_at',
        'fullname', 'nik', 'telp', 'bio'
    ];

    public function search($keyword){
        // $builder = $this->table('users');
        // $builder->like('username', $keyword);
        // return $builder;

        return $this->table('users')->like('username', $keyword);
    }

}

?>