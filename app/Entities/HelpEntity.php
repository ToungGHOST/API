<?php namespace App\Entities;

use CodeIgniter\Model;

class HelpEntity extends Model
{
    protected $table = 'help';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id',
        'help_detail',
    ];
}