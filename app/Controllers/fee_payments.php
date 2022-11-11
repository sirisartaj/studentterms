<?php 
namespace App\Controllers;
use App\Models\fee_paymentModel;
use App\Models\payed_type_historyModel;
use CodeIgniter\Controller;
class fee_payments extends Controller
{
    // show users list
    public function index($student_id=""){
        $fee_paymentModel = new fee_paymentModel();
        $get_fee_types = $fee_paymentModel->get_fee_types();
                //echo "<pre>";print_r($get_fee_types);
        foreach($get_fee_types as $g){
            $data['class'][$g['class']][$g['priority']] = $g;

        }
        $data['student_id'] = $student_id;
        return view('feepayments', $data);
    }
    // add user form
    public function create(){
        return view('setupUser');
    }
 
    // insert data
    public function store() {
        //$this->load->library('session');
        $fee_paymentModel = new fee_paymentModel();
        
        

        $data = [
            'student_id' => $this->request->getVar('student_id'),
            'payed_amount' => $this->request->getVar('payed_amount'),
            'balance' => $this->request->getVar('balance'),
            'status' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            
        ];
        $fee_paymentModel->insert($data);
        $fee_payment_id = $fee_paymentModel->getInsertID();
        $class=$this->request->getVar('class');
       
        $get_fee_types = $fee_paymentModel->get_fee_types($class);
        
        foreach($get_fee_types as $get_fee_type){
           $hdata[$get_fee_type['priority']]['fee_amount']=$this->request->getVar($get_fee_type['priority']);
           $hdata[$get_fee_type['priority']]['fee_type_id']=$get_fee_type['id'];
           $hdata[$get_fee_type['priority']]['student_fee_payments_id']=$fee_payment_id;
           $hdata[$get_fee_type['priority']]['created_at']=date('Y-m-d H:i:s');
           
        }
        $payed_type_historyModel = new payed_type_historyModel();
        //echo "<pre>";print_r($hdata);exit;
        $payed_type_historyModel->batchinserthistory($hdata);  

        //$_SESSION['message'] ='payment updated';
        return $this->response->redirect(site_url('/fee_payments/'.$data['student_id']));
    }
    // show single user
    public function singleUser($id = null){
        $userModel = new UserModel();
        $data['user_obj'] = $userModel->where('iduser', $id)->first();
        return view('edit_user', $data);
    }
    // update user data
    public function update(){
        $userModel = new UserModel();
        $id = $this->request->getVar('iduser');
        $data = [
            'Name' => $this->request->getVar('Name'),
            'EmailId'  => $this->request->getVar('EmailId'),
        ];
        $userModel->update($id, $data);
        return $this->response->redirect(site_url('/usersList'));
    }
    // update user data
    public function changepwd(){
        $userModel = new UserModel();
        $id = $this->request->getVar('iduser');
        $data = [
            'Password' => md5($this->request->getVar('Password')),            
        ];
        $userModel->update($id, $data);
        return $this->response->redirect(site_url('/usersList'));
    }
 
    // delete user
    public function delete($id = null){
        $userModel = new UserModel();
        $data['user'] = $userModel->where('iduser', $id)->delete($id);
        return $this->response->redirect(site_url('/usersList'));
    }    
}