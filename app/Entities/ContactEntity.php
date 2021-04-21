<?php namespace App\Entities;

use CodeIgniter\Model;

class ContactEntity extends Model
{
    protected $table = 'contactus';
    protected $primaryKey = 'conus_id ';
    protected $returnType = 'array';
    protected $allowedFields = [
        'conus_id ',
        'conus_address',
        'conus_tel',
        'conus_email',
        'conus_email1',
        'conus_email2',
        'conus_facebook',
        'conus_line',
        'conus_instagram',
        'conus_youtube',
        'conus_ourservice',
        'conus_latlon',
    ];
}