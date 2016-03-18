<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {
	####################################################################
	public function __construct()
	{
		parent::__construct();
      $this->load->library('session');
      $this->load->model('model_template');
      $this->load->model('model_posts');
      $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}
	####################################################################
	public function index()
	{
		$this->load->view('welcome_message');
	}	
	
	####################################################################
	public function view_list_comments()
	{		
		$list_order_posts = $this->model_posts->get_list_posts();
		echo json_encode($list_order_posts);
	}
	####################################################################
	public function save_project()
	{
		if(isset($_REQUEST['post_title']))
		{
			$data["post_title"]= $_REQUEST["post_title"];
			$data["post_content"]= $_REQUEST["post_content"];
			$data["post_type"]= "project";

			$this->model_posts->add_post($data);
		}

		

		$this->load->view('posts/save_project');

		print_r($this->model_posts->get_list_projects());		
	}
	####################################################################
	public function save_forum()
	{
		if(isset($_REQUEST['post_title']))
		{
			$data["parent_id"]= $_REQUEST["project_id"];
			$data["post_title"]= $_REQUEST["post_title"];
			$data["post_content"]= $_REQUEST["post_content"];
			$data["post_type"]= "forum";

			$this->model_posts->add_post($data);
		}

		$view_data['list_projects'] = $this->model_posts->get_list_projects();		
		$view_data['list_forums'] = $this->model_posts->get_list_forums();		

		$this->load->view('posts/save_forum', $view_data);

		print_r($this->model_posts->get_list_forums());		
	}
	####################################################################
	public function save_task()
	{
		if(isset($_REQUEST['post_title']))
		{
			$data["post_title"]= $_REQUEST["post_title"];
			$data["post_content"]= $_REQUEST["post_content"];
			$data["post_type"]= "task";

			$this->model_posts->add_post($data);
		}

		$this->load->view('posts/save_task');
		print_r($this->model_posts->get_list_posts());
	}
	####################################################################
	public function save_comment()
	{
		if(isset($_REQUEST['post_title']))
		{
			$data["post_title"]= $_REQUEST["post_title"];
			$data["post_content"]= $_REQUEST["post_content"];
			$data["post_type"]= "comment";

			$this->model_posts->add_post($data);
		}
		$this->load->view('posts/save_comment');
		print_r($this->model_posts->get_list_posts());		
	}
}