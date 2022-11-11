<?php

namespace App\Models;

use CodeIgniter\Model;

class fee_paymentModel extends Model
{
    protected $table      = 'student_fee_payments';
    protected $primaryKey = 'student_fee_payments_id ';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['student_id','payed_amount', 'balance','status','created_at','updated_at','deleted_at'];

    //protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    //protected $skipValidation     = false;
    
    
    public function getpayments($id = false)
    {

        return $this->where('student_id',$id)->findAll();

      
    } 
    public function get_fee_types($class = false)
    {
        if($class){
            return $this->query("SELECT * FROM student_fee s where class='".$class."' order by priority DESC")->getResultArray();
        }
       return $this->query("SELECT * FROM student_fee s")->getResultArray();
    }

    
    
}