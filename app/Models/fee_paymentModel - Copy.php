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
        //$this->join('tbl_student_term_due student','student.student_id = followups.student_id','right');
       //return $this->where(['student.student_id' => $id])->group_by('student.student_id')->findAll();

        return $this->where('student_id',$id)->findAll();

      // return $this->query(" SELECT * FROM tbl_student_term_due s left join followups f on s.student_id=f.student_id where s.student_id=$id GROUP BY s.student_id")->getResultArray();
    } 
    public function get_fee_types($class = false)
    {
        if($class){
            return $this->query("SELECT * FROM student_fee s where class='".$class."' order by priority DESC")->getResultArray();
        }
       return $this->query("SELECT * FROM student_fee s")->getResultArray();
    }
    
}