<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	####################################################################
	public function __construct()
	{
		parent::__construct();
      $this->load->library('session');
      $this->load->model('model_template');
      $this->load->model('model_users');
      $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}
	####################################################################
	public function is_login($user_email, $user_password, $id_user){

		$id_user = $this->session->userdata('id_user');

		if(!isset($id_user)){

			$id_user = $this->model_users->get_id_user($user_email, $user_password);

			if($id_user !== NULL){
				echo "Welcome user ".$user_email;

				$this->session->set_userdata('id_user', $id_user);
				return TRUE;
			}
			else{				
				echo "Try with other login data or you don't sign up";
				return FALSE;
			}			
		}
		else{			
			echo "Welcome user ".$user_email;
			return TRUE;
		}
	}

	public function login(){
		if(isset($_REQUEST['login'])){

			if(is_login($_REQUEST['user_email'], $_REQUEST['user_password'], $_REQUEST['id_user'])){

			}

		}

		$this->load->view('login');
	}
	
	####################################################################
	public function signup()
	{
		if(isset($_REQUEST['signup'])){
			$data['user_email'] = $_REQUEST['user_email'];
			$data['user_password'] = $_REQUEST['user_password'];
			$data['user_name'] = $_REQUEST['user_name'];
			$data['user_profilename'] = $_REQUEST['user_profilename'];
			$data['user_profilelastname'] = $_REQUEST['user_profilelastname'];
			$this->model_users->add_user($data);			
		}

		$this->load->view('signup');
	}
	####################################################################
	public function index()
	{
		$this->load->view('welcome_message');
	}
}