<?php namespace App\Entities;

use CodeIgniter\Model;

class TeestEntity extends Model
{
    protected $table = 'teest';
    protected $primaryKey = 'teest_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'teest_id',
    ];
}