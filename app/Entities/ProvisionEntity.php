<?php namespace App\Entities;

use CodeIgniter\Model;

class ProvisionEntity extends Model
{
    protected $table = 'provision';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id',
        'provision',
        'update_at',
    ];
}