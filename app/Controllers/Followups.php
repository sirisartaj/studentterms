<?php 
namespace App\Controllers;
use App\Models\followupModel;
use CodeIgniter\Controller;
class Followups extends Controller
{
    // show users list
    public function index($id='',$rid=''){
        $followupModel = new followupModel();
        $data['student'] = $followupModel->getstudentinfo($id,$rid);
        $data['followup'] = $followupModel->getcompletefollowup($id);
        $data['student_id'] = $id;
        $data['rid'] = $rid;

      
        return view('followup', $data);
    }
   
    // insert data
    public function store() {
        $followupModel = new followupModel();
        //echo "<pre>";print_r($_REQUEST);echo $this->request->getVar('student_id');exit;
        $id = $this->request->getVar('id')?$this->request->getVar('id'):'';
        $rid = $this->request->getVar('rid')?$this->request->getVar('rid'):'';
        $data = [
            'executive' => $this->request->getVar('executive'),
            'follow_up_type' => $this->request->getVar('follow_up_type'),
            'next_follow_up' => date('Y-m-d H:i:s',strtotime($this->request->getVar('next_follow_up'))),
            'Overview' => $this->request->getVar('Overview'),
            'student_id' => $this->request->getVar('student_id'),           
            'Status'  => $this->request->getVar('Status'),            
        ];
        //print_r($id);
//print_r($data);
       // exit;
        if($id){
            $followupModel->update($id, $data);
        }else{
            //echo "sartaj";exit;
            //print_r($data);exit;
            $followupModel->insert($data);
        }
        
        return $this->response->redirect(site_url('/Followups/'.$data['student_id'].'/'.$rid));
    }
    // show single user
    public function singleUser($id = null){
        $followupModel = new followupModel();
        return $data['user_obj'] = $followupModel->where('id', $id)->first();
        
    }    
 
    // delete user
    public function delete($id = null){
        $followupModel = new followupModel();
        $data['user'] = $followupModel->where('iduser', $id)->delete($id);
        return $this->response->redirect(site_url('/usersList'));
    }    
}