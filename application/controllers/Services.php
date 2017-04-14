<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {
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
	public function add_project()
	{
		if(isset($_REQUEST['post_title']))
		{
			$data["post_title"]= $_REQUEST["post_title"];
			$data["post_content"]= $_REQUEST["post_content"];
			$data["post_type"]= "project";

			$this->model_posts->add_post($data);
		}

		$list_order_posts = $this->model_posts->get_list_posts();
		echo json_encode($list_order_posts);
	}
	####################################################################
	public function add_discussion()
	{
		if(isset($_REQUEST['post_title']))
		{
			$data["post_title"]= $_REQUEST["post_title"];
			$data["post_content"]= $_REQUEST["post_content"];
			$data["post_type"]= "discussion";

			$this->model_posts->add_post($data);
		}

		$list_order_posts = $this->model_posts->get_list_posts();
		echo json_encode($list_order_posts);
	}
	####################################################################
	public function add_task()
	{
		if(isset($_REQUEST['post_title']))
		{
			$data["post_title"]= $_REQUEST["post_title"];
			$data["post_content"]= $_REQUEST["post_content"];
			$data["post_type"]= "task";

			$this->model_posts->add_post($data);
		}

		$list_order_posts = $this->model_posts->get_list_posts();
		echo json_encode($list_order_posts);
	}
	####################################################################
	public function add_comment()
	{
		if(isset($_REQUEST['post_content']))
		{
			$data["post_content"]= $_REQUEST["post_content"];
			$data["post_type"]= "comment";

			$this->model_posts->add_post($data);
		}

		$list_order_posts = $this->model_posts->get_list_posts();
		echo json_encode($list_order_posts);
	}

	
}
