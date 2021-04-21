<?php namespace App\Entities;

use CodeIgniter\Model;
class PolicyEntity extends Model
{
    protected $table = 'policy';
    protected $primaryKey = 'po_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'po_id',
        'po_container_1_title',
        'po_container_1_detail',
        'po_container_2_title',
        'po_container_2_detail',
        'po_container_3_title',
        'po_container_3_detail',
        'create_date',
        'lastupdate_date',
    ];

}