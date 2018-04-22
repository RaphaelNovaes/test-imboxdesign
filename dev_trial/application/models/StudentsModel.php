<?php
class StudentsModel extends CI_Model {
	function __construct()
    {
        parent::__construct();
    }

    function addStd($data){

    	$callback = $this->db->set($data)->insert('students');

    	if ($callback) {
    		return true;
    	}else{
    		file_put_contents('erro_db.log', $this->db->error());
    		return false;
    	}
    }

    function getAllStds($data){
    	
    	$this->db->select('id_student,first_name,last_name,email,phone');

    	if(isset($data['search']) && $data['search']){
    		$this->db->like('first_name', $data['search']);
    		$this->db->or_like('last_name', $data['search']);
    		$this->db->or_like('email', $data['search']);
    		$this->db->or_like('phone', $data['search']);
    	}

    	$query = $this->db->get('students');

    	$rows = $query->result_array();

    	if($rows){
    		return $rows;
    	}else{
    		file_put_contents('erro_db.log', $this->db->error());
    		return false;
    	}
    }

    function getStd($id){
    	
    	$this->db->select('id_student,first_name,last_name,email,phone');

    	$this->db->where('id_student', $id);

    	$query = $this->db->get('students');

    	$row = $query->row_array();

    	if($row){
    		return $row;
    	}else{
    		file_put_contents('erro_db.log', $this->db->error());
    		return false;
    	}
    }

    function getPassStd($id){
    	
    	$this->db->select('password');

    	$this->db->where('id_student', $id);

    	$query = $this->db->get('students');

    	$row = $query->row_array();

    	if($row){
    		return $row;
    	}else{
    		file_put_contents('erro_db.log', $this->db->error());
    		return false;
    	}
    }

    function putStd($data){
    	
    	$id = $data['id_student'];
    	unset($data['id_student']);

    	$this->db->where('id_student', $id);
        $this->db->update('students', $data);

    	$rows = $this->db->affected_rows();

    	if($rows > 0){
    		return true;
    	}else{
    		file_put_contents('erro_db.log', $this->db->error());
    		return false;
    	}
    }

    function putPassStd($data){
    	
    	$id = $data['id_student'];
    	unset($data['id_student']);
    	unset($data['old_password']);

    	$this->db->where('id_student', $id);
        $this->db->update('students', $data);

    	$rows = $this->db->affected_rows();

    	if($rows > 0){
    		return true;
    	}else{
    		file_put_contents('erro_db.log', $this->db->error());
    		return false;
    	}
    }

    function delStd($data){
    	
    	$this->db->where_in('id_student',$data['students']);

    	$query = $this->db->delete('students');

    	if($query){
    		return true;
    	}else{
    		file_put_contents('erro_db.log', $this->db->error());
    		return false;
    	}
    }
}
?>