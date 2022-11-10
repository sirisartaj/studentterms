<?php

namespace App\Models;

use CodeIgniter\Model;

class followupModel extends Model
{
    protected $table      = 'followups';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['executive','follow_up_type', 'next_follow_up','Overview','student_id','Status','created_at','updated_at','deleted_at'];

    //protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    //protected $skipValidation     = false;
    
    
    public function getcompletefollowup($id = false)
    {
        //$this->join('tbl_student_term_due student','student.student_id = followups.student_id','right');
       //return $this->where(['student.student_id' => $id])->group_by('student.student_id')->findAll();

        return $this->where('student_id',$id)->findAll();

      // return $this->query(" SELECT * FROM tbl_student_term_due s left join followups f on s.student_id=f.student_id where s.student_id=$id GROUP BY s.student_id")->getResultArray();
    } 
    public function getstudentinfo($id = false,$rid = '')
    {
       return $this->query("SELECT * FROM tbl_student_term_due s where s.student_id=$id and s.id=$rid GROUP BY s.student_id")->getResultArray();
    }
    
}