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
		print_r($this->model_posts->get_list_posts());		
	}
	####################################################################
	public function save_discussion()
	{
		if(isset($_REQUEST['post_title']))
		{
			$data["post_title"]= $_REQUEST["post_title"];
			$data["post_content"]= $_REQUEST["post_content"];
			$data["post_type"]= "discussion";

			$this->model_posts->add_post($data);
		}

		$this->load->view('posts/save_discussion');
		print_r($this->model_posts->get_list_posts());		
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