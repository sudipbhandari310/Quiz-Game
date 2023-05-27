<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz_controller extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Quiz_model");
        $this->load->library('form_validation');
    }

    public function index()
	{
	//	$this->session->sess_destroy();
		$this->load->view("User/test"); 
	}


  public function signin(){

     $this->form_validation->set_rules('username','Username','required');
     $this->form_validation->set_rules('email','Email','required');
  
			
       if($this->form_validation->run() == False) { 
           
           $this->index();
         } 
       else { 
         $data=array(
              'username'=>$this->input->post('username'),
              'email'=>$this->input->post('email'),
              
          );
          // static $

          $id=$this->Quiz_model->insertUser($data);
          redirect('Quiz_controller/loadPage');


          // if(!$id){
          //     $this->session->set_flashdata("failed","Invalid Credentials");
          //     $this->index();
          // }

          // else{
          //     $data['id']=$id;
          //     $this->session->set_userdata("auth_user",$data);
          //     $this->session->set_flashdata("success","Records Inserted Successfully");
          // $this->load->view('User/quiz_view');
              
          // }
          
        } 
   
  }
  public function loadPage(){
    $this->load->view('User/quiz_view');

  }
  
         
       
		 
        
  
    public function get_question(){
      $id=$this->input->post('id');
      if ($id > 0){
        $result = $this->Quiz_model->fetch_one_row($id);
        echo json_encode($result);
       //  var_dump($result);

        
      }
      else{
        
        //echo json_encode($result);
     }
}

public function resultController(){
  $data=array(
  'user_id' => $this->input->post('user_id'),
      'total_questions' => $this->input->post('totalQuestions'),
      'attempted_questions' => $this->input->post('attempted_questions'),
      'correct_questions' => $this->input->post('correct_questions'),
      'total_time_taken' => $this->input->post('total_time_taken'),
      'begin_date_time' => date('begin_date_time')
  );

  $id=$this->Quiz_model->userResultInsert($data);
  var_dump($data);

  echo json_encode("success");
}


public function logout(){
	$this->session->sess_destroy();
	$this->session->unset_userdata('auth_user');
    $this->session->set_flashdata("success","You are logged out successfully!!");
    redirect('Quiz_controller/index');
	}

  // public function logou
}  


    
    
    
        
    