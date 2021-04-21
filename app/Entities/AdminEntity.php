<?php namespace App\Entities;

use CodeIgniter\Model;

class AdminEntity extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id',
        'firstname',
        'lastname',
        'admin_email',
        'username',
        'password',
        'create_at',
        'login_at',
    ];
}