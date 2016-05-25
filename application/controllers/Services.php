<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {
	####################################################################
	public function __construct(){
		parent::__construct();
      $this->load->library('session');
      $this->load->model('model_template');
      $this->load->model('model_posts');
      $this->load->model('model_users');

      $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}
	####################################################################		
	public function login(){
		$id_user = NULL;
		if(isset($_REQUEST['user_email']) 
		AND isset($_REQUEST['user_password']) 
		AND strcasecmp(trim($_REQUEST['user_email']),"")!=0
		AND strcasecmp(trim($_REQUEST['user_password']),"")!=0
			){
			$id_user = $this->model_users->get_id_user($_REQUEST['user_email'], $_REQUEST['user_password']);
		}
		echo json_encode( array("user_id"=>$id_user) );
	}
	####################################################################
	public function view_list_projects(){
		$list_order_projects = $this->model_posts->get_list_projects($_REQUEST["user_id"]);
		echo json_encode($list_order_projects);
	}
	####################################################################
	public function view_list_activities(){		

		$user_id = 0;



		if(isset($_REQUEST['user_id'])){
			$user_id = $_REQUEST['user_id'];
			file_put_contents("ptm_log.txt", "user_id = ".$_REQUEST['user_id']);
		}
		else{
			file_put_contents("ptm_log.txt", "there isn't USER_ID", FILE_APPEND | LOCK_EX);
		}

		$list_activities = $this->model_posts->get_list_activities($user_id);
		echo json_encode($list_activities);
	}
	####################################################################
	public function view_list_forums(){		
		$list_order_forums = $this->model_posts->get_list_forums($REQUEST['user_id']);
		echo json_encode($list_order_forums);
	}

	####################################################################
	public function index()
	{
		$this->load->view('welcome_message');
	}
	####################################################################
	public function add_project(){
		if(isset($_REQUEST['post_content'])){
			$data["user_id"]= $_REQUEST["user_id"];
			//$data["post_title"]= $_REQUEST["post_title"];
			$data["post_content"]= $_REQUEST["post_content"];
			$data["post_type"]= "project";

			$this->model_posts->add_post($data);
		}

		$list_order_posts = $this->model_posts->get_list_posts();
		echo json_encode($list_order_posts);
	}
	####################################################################
	public function add_forum(){
		if(isset($_REQUEST['post_content'])){
			$data["user_id"]= $_REQUEST["user_id"];
			$data["post_content"]= $_REQUEST["post_content"];
			$data["parent_id"]= $_REQUEST["parent_id"];
			$data["project_id"]= $_REQUEST["parent_id"];
			$data["post_type"]= "forum";

			$this->model_posts->add_post($data);
		}

		$list_order_posts = $this->model_posts->get_list_posts();
		echo json_encode($list_order_posts);
	}
	####################################################################
	public function add_task(){
		if(isset($_REQUEST['post_title'])){
			$data["user_id"]= $_REQUEST["user_id"];
			$data["post_title"]= $_REQUEST["post_title"];
			$data["post_content"]= $_REQUEST["post_content"];
			$data["post_type"]= "task";

			$this->model_posts->add_post($data);
		}

		$list_order_posts = $this->model_posts->get_list_posts();
		echo json_encode($list_order_posts);
	}
	####################################################################
	public function add_comment(){
		if(isset($_REQUEST['post_content'])){
			$data["user_id"]= $_REQUEST["user_id"];
			$data["post_content"]= $_REQUEST["post_content"];
			$data["parent_id"]= $_REQUEST["parent_id"];
			$data["project_id"]= $_REQUEST["project_id"];

			if(! isset($_REQUEST["forum_id"]) OR $_REQUEST["forum_id"] == NULL OR $_REQUEST["forum_id"]==0){
				$data["forum_id"]= $_REQUEST["parent_id"];	
			}
			else{
				$data["forum_id"]= $_REQUEST["forum_id"];		
			}
			$data["post_type"]= "comment";
			$this->model_posts->add_post($data);
		}

		$list_order_posts = $this->model_posts->get_list_posts();
		echo json_encode($list_order_posts);
	}
}
