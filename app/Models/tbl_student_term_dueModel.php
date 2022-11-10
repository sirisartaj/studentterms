<?php

namespace App\Models;

use CodeIgniter\Model;

class tbl_student_term_dueModel extends Model
{
    protected $table      = 'tbl_student_term_due';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [];

    //protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    //protected $skipValidation     = false;
    
    function termslist(){
        $this->select('term_name');
        $this->groupBy('term_name');
        return $this->get();
    }
    function findrole($id){

        $this->db->select('*');
        $this->db->from('userrole');
       return $role = $this->db->where('iduserrole',$id);
    }

    function students_with_followup(){

        return $this->query("SELECT s.*,f.created_at followupon FROM tbl_student_term_due s left join followups f on s.student_id=f.student_id ")->getResultArray();
      // return $user = $userModel->find($user_id);
    }

    public function getUsers($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
    
}