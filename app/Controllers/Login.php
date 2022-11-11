<?php 
namespace App\Controllers;
use App\Models\tbl_student_term_dueModel;
use CodeIgniter\Controller;
class Login extends Controller
{
    // show users list
    public function index(){
        $tbl_student_term_dueModel = new tbl_student_term_dueModel();
        $data['students'] = $tbl_student_term_dueModel->students_with_followup();
        //$tbl_student_term_dueModel->orderBy('id', 'DESC')->findAll();
        $data['terms'] = $tbl_student_term_dueModel->termslist()->getResultArray();
        
       
        return view('students_list', $data);
    }
    // add user form
    public function create(){
        return view('setupUser');
    }
 
    // insert data
    public function store() {
        $userModel = new UserModel();
        $role=explode('_', $this->request->getVar('UserRole')); 

        $data = [
            'LoginID' => $this->request->getVar('DisplayName').'_'.$this->request->getVar('Mobile'),//$this->request->getVar('LoginID'),
            'Password' => $this->request->getVar('Password'),
            'DisplayName' => $this->request->getVar('DisplayName'),
            'Name' => $this->request->getVar('Name'),
            'SurName' => $this->request->getVar('SurName'),
            'Gender' => $this->request->getVar('Gender'),
            'EmailID'  => $this->request->getVar('EmailID'),
            'Phone'  => $this->request->getVar('Phone'),
            'Mobile'  => $this->request->getVar('Mobile'),
            'Address1'  => $this->request->getVar('Address1'),
            'Address2'  => $this->request->getVar('Address2'),
            'idCountry'  => $this->request->getVar('idCountry'),
            'idState'  => $this->request->getVar('idState'),
            'idCity'  => $this->request->getVar('idCity'),
            'idTimeZone'  => 1,
            'idLocale'  => 1,
            'Status'  => 'Active',
            'UserType'  => 'User',
            'isSuperAdmin'  => 0,
            'DOB'  => $this->request->getVar('DOB'),
            'UserRole'  => $role[0],
            'idUserRole'  => $role[1],
        ];
        $userModel->insert($data);
        return $this->response->redirect(site_url('/usersList'));
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