<?php

namespace App\Models;

use CodeIgniter\Model;

class payed_type_historyModel extends Model
{
    protected $table      = 'payed_type_history';
    protected $primaryKey = 'id ';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['student_fee_payments_id','fee_type_id', 'fee_amount','created_at','updated_at','deleted_at'];

    //protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    //protected $skipValidation     = false;
    
    
   public function batchinserthistory($data = false)
    {
        return $this->insertBatch($data); 
    }
    
}