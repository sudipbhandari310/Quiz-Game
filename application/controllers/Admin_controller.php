<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller {

public function __construct(){
    parent::__construct();
    $this->load->model('Quiz_model');
    $this->load->library('form_validation');
}
 
public function index(){
 //   echo "hello";
    $this->load->view('Admin/admin_login');

}


public function login(){

    $this->form_validation->set_rules('username','Username','required');
    $this->form_validation->set_rules('email','Email','required');

    if($this->form_validation->run()===true){
        $data=array(
            'Username'=>$this->input->post('username'),
            'email'=>$this->input->post('email'),
            'role'=>'admin'
        );

        $result=$this->Quiz_model->getUsers($data);

        if($result){

            $auth_user=[
                'id'=>$result->id,
                'username'=>$result->username,
                'email'=>$result->email,
            ];

            $this->session->set_userdata('auth_admin',$auth_user);
            $this->session->set_flashdata("success","Logged In Successfully");
        //    redirect('Admin_controller/dashboard');
        redirect('admin1/index');
        }

else{

   $this->load->view('Admin/admin_login');
}



       
    }

    else{
       
    }


}
}