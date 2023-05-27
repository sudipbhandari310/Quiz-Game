<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin1 extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Quiz_model");
		    if(!$this->session->has_userdata('auth_admin')){
			  redirect('Admin_controller');
		    }  
      }

      public function index(){
        $rows=$this->Quiz_model->getUserResult();
        $data['rows']=$rows;
        // var_dump($rows);
          $this->load->view("Admin/adminDashboard",$data);
      }

      public function logout(){
        $this->session->sess_destroy();
        $this->session->unset_userdata('auth_admin');
        $this->session->set_flashdata("success","You are logged out successfully!!");
        redirect('Admin_controller');
        }

}