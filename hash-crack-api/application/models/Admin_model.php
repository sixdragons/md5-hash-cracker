<?php

 defined('BASEPATH') OR exit('No direct script access allowed');
	class Admin_model extends CI_Model{

    	public function __construct(){
			$this->load->database();
		}

		// register user
		public function register($enc_password){
			// User data array
			$data = array(
				'username' =>$this->security->xss_clean($this->input->post('username')) ,
				'password' => $enc_password
			);
			// Insert user
			return $this->db->insert('admin', $data);
		}

		//add pass
		public function addPass($line){
			// User data array
			$data = array(
				'text' =>$this->security->xss_clean($line) ,
				'md5' => md5($line)
			);
			// Insert user
			return $this->db->insert('rainbow', $data);
		}

		public function exist($line){
			$this->db->select('id');
			$query = $this->db->get_where('rainbow', array('text' => $line));
			if(empty($query->row_array())){
				return false;
			} else {
				return true;
			}
		}

		public function getH($pass){
			$sql= "SELECT * FROM `rainbow` WHERE md5= '$pass'";
			$query = $this->db->query($sql);
			if(empty($query->row_array(0))){
				return false;
			} else {
				return $query->row_array(0);
			}
		}
		public function rowC(){
			$this->db->select('id');
			$query = $this->db->get('rainbow');
			if(empty($query->num_rows())){
				return false;
			} else {
				return $query->num_rows();
			}
		}

		// Log user in
		public function login($username, $password){
			// Validate
			$this->db->select('id, username');
			$this->db->where('username',$username);
			$this->db->where('password', $password);
			$result = $this->db->get('admin');
			if($result->num_rows() == 1){
				return $result->row_array(0);
			} else {
				return false;
			}
		}

		// Check admin exists
		public function check_admin_exists(){
			$this->db->select('id');
			$query = $this->db->get('admin');
			if(empty($query->row_array())){
				return false;
			} else {
				return true;
			}
		}

	}
