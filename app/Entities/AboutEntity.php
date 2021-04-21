<?php namespace App\Entities;

use CodeIgniter\Model;
class AboutEntity extends Model
{
    protected $table = 'aboutus';
    protected $primaryKey = 'aboutus_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'aboutus_id',
        'aboutus_container_1_title',
        'aboutus_container_1_detail',
        'aboutus_container_2_title',
        'aboutus_container_2_detail',
        'create_date',
        'lastupdate_date',
    ];

}