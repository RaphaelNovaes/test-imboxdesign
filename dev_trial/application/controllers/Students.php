<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends CI_Controller {

  /**
   * Index for trail web site
   */
  public function index() {
    $this->load->view('header');
    $this->load->view('students');
    $this->load->view('footer');
  }

  /**
   * Create a new student data 
   */
  public function postStd(){
  	
  	//load module
  	$this->load->model('studentsModel');
  	
  	$data = $this->input->post();

  	$data['password'] = md5($data['password']);

  	$callback = $this->studentsModel->addStd($data);

  	header('Content-type: application/json');

  	echo json_encode(array('status'=>$callback));
  }

  /**
   * Get all students data 
   */
  public function getAllStds(){
  	
  	//load module
  	$this->load->model('studentsModel');

  	$get = $this->input->get();

  	$data = $this->studentsModel->getAllStds($get);

  	$callback = ($data)?true:false;  

  	header('Content-type: application/json');

  	echo json_encode(array('status'=>$callback,'students'=>$data));
  }

  /**
   * Delete students data 
   */
  public function delStd(){
  	
  	//load module
  	$this->load->model('studentsModel');

  	$data = $this->input->post();

  	$callback = $this->studentsModel->delStd($data);

  	header('Content-type: application/json');

  	echo json_encode(array('status'=>$callback));
  }

  /**
   * Get one student data 
   */
  public function getStd(){
  	
  	//load module
  	$this->load->model('studentsModel');

  	$post = $this->input->get();

  	$data = $this->studentsModel->getStd($post['id']);

  	$callback = ($data)?true:false;  

  	header('Content-type: application/json');

  	echo json_encode(array('status'=>$callback,'students'=>$data));
  }

  /**
   * Updata one student data 
   */
  public function putStd(){
  	
  	//load module
  	$this->load->model('studentsModel');

  	$data = $this->input->post();

  	$callback = $this->studentsModel->putStd($data);

  	header('Content-type: application/json');

  	echo json_encode(array('status'=>$callback));
  }

  /**
   * Updata password student data 
   */
  public function putPassStd(){
  	
  	//load module
  	$this->load->model('studentsModel');

  	$data = $this->input->post();

  	$old_password = $this->studentsModel->getPassStd($data['id_student']);

  	if($old_password){

	  	if(md5($data['old_password']) === $old_password['password']){

	  		$data['password'] = md5($data['password']);

	  		$callback = $this->studentsModel->putPassStd($data);

	  	}else{

	  		$callback = "Password doesn't match with oldies cadastred";
	  	}
	}else{
		$callback = false;
	}

  	header('Content-type: application/json');

  	echo json_encode(array('status'=>$callback));
  }
}
