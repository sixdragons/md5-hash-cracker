<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function index(){
		ini_set('max_execution_time', 900); 
		ini_set('memory_limit','20M');
		if(!$this->session->userdata('logged_in')){
				redirect('Login');
			}
		$data['pageTitle']='home';
		$data['log']='nothing';
		

		$this->form_validation->set_rules('passwordF', 'Password List', 'required');
  		if($this->form_validation->run() === FALSE){

          	 //view loading
			$this->load->view('templates/header', $data);
			$this->load->view('panel/home', $data);
			$this->load->view('templates/footer', $data);
  			} else {
				// Get filename.
				$temp = explode(".", $_FILES["password"]["name"]);
				// Get extension.
				$filetype = strtolower(end($temp));
				$filename = sha1(microtime()) . ".txt";

				$config['upload_path'] = './uploads/text';
				$config['allowed_types'] = 'txt|TXT|text|TEXT';
				$config['max_size'] = '5000';
				$config['file_name'] =$filename;
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('password')){
					$errors = array('error' => $this->upload->display_errors());
					$lines = '';

				} else {
					$data = array('upload_data' => $this->upload->data());
					$lines = file(base_url('uploads/text/').$filename);
					foreach($lines as $line){
						if (!$this->Admin_model->exist(trim($line))) {
							$this->Admin_model->addPass(trim($line));
						}
					    
					}
					
				}
				if ($lines=='') {
					$this->session->set_flashdata('wrong', 'something wrong..!!!');
				}
				$this->session->set_flashdata('file_added', 'Your list added..');
				redirect('admin');   
			
      }
	}

	public function get($pass=''){

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
		header('Access-Control-Allow-Methods: GET, POST, PUT');

		$passL= strlen($pass);
		if($passL == 32){
			if ($this->Admin_model->getH($pass)) {
				$re= $this->Admin_model->getH($pass)['text'];
				$res = array(
					'type' => 'success',
					'password' => $re
					 );
	        	header('Content-Type: application/json');
	    		echo json_encode($res);
			}else{
				$res = array(
					'type' => 'error',
					'msg' => $this->Admin_model->rowC().' passwords fucked by this hash..!!'
					 );
				header('Content-Type: application/json');
	    		echo json_encode($res);
			}
		}else{
			$res = array(
					'type' => 'error',
					'msg' =>'something wrong..!!'
					 );
				header('Content-Type: application/json');
	    		echo json_encode($res);
		}
	    
	}


	public function register(){

      if($this->session->userdata('logged_in')){
         redirect('Home');
       }
       $data['pageTitle'] = 'Create an account';

       $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_check_admin_exists');
       $this->form_validation->set_rules('password1', 'Password', 'trim|required');
       $this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|matches[password1]');



  		if($this->form_validation->run() === FALSE){

           $this->load->view('panel/register', $data);
  			} else {

        // Encrypt password
        $enc_password = md5($this->input->post('password1')."@#@$#@@#$@#");
        $this->Admin_model->register($enc_password);
		$this->session->set_flashdata('user_registered', 'You are now registered and can log in');
		redirect('Login');
      }

  	}

  	public function login(){
  		$this->load->library('user_agent');
  	
    	if($this->session->userdata('logged_in')){
				redirect('Home');
			}
			$data['pageTitle'] = 'Log In';
			
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			if($this->form_validation->run() === FALSE){
				$this->load->view('panel/login',$data);
			} else {

				// Get username
				$username = $this->security->xss_clean($this->input->post('username'));
				// Get and encrypt the password
				$password = md5($this->input->post('password')."@#@$#@@#$@#");
				// Login user
				$userData = $this->Admin_model->login($username, $password);
				
				if($userData){
					// Create session
					$userdata = array(
						'id' => $userData['user_id'],
						'username' => $userData['userName'],
						'logged_in' => true
					);
					$this->session->set_userdata($userdata);
					// Set message
					$this->session->set_flashdata('user_loggedin', 'You are now logged in');
					redirect('Admin');
					
					
				} else {
					// Set message
					$this->session->set_flashdata('login_failed', 'Login is invalid');
					redirect('login');
				}
			}
	}

     // Log user out
	public function logout(){
			// Unset user data
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('id');
            $this->session->unset_userdata('username');
			// Set message
			
			$this->session->set_flashdata('user_loggedout', 'You are now logged out');
			redirect('login');
	}


    // Check if admin exists
	public function check_admin_exists($username){
		$this->form_validation->set_message('check_admin_exists', "You can't create an account..!!");
		if($this->Admin_model->check_admin_exists()){
			return false;
		} else {
			return true;
		}
	}


}
