<?php

namespace App\Models;

use CodeIgniter\Model;

class student_feeModel extends Model
{
    protected $table      = 'student_fee';
    protected $primaryKey = 'id ';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['class','fee_type','priority','fee_amount','status','created_at','updated_at','deleted_at'];

    //protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    //protected $skipValidation     = false;
    
    
    public function get_typeof_fees($class = false)
    {     
        return $this->where('class',$class)->findAll();
    } 
    public function get_fee_types($id = false,$rid = '')
    {
       return $this->query("SELECT * FROM student_fee s")->getResultArray();
    }
    
}