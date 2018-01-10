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
	public function project_add()
	{
            if(isset($_REQUEST['post_title']))
            {
                    $data["post_title"]= $_REQUEST["post_title"];
                    $data["post_content"]= $_REQUEST["post_content"];
                    $data["post_type"]= "project";
                    $this->model_posts->add_post($data);
            }

            $view_data['list_projects'] = $list_projects = $this->model_posts->get_list_projects();

            $this->load->view('template/header');
            $this->load->view('posts/project_add', $view_data);
            $this->load->view('template/footer');

            print_r($list_projects);		
	}
	####################################################################
	public function discussion_add()
	{
		if(isset($_REQUEST['post_title'])){

			$data["parent_id"]= $_REQUEST["project_id"];
			$data["post_title"]= $_REQUEST["post_title"];
			$data["post_content"]= $_REQUEST["post_content"];
			$data["post_type"]= "discussion";

			$this->model_posts->add_post($data);
		}
                
                $view_data['list_projects'] = $this->model_posts->get_list_projects();
                
		$view_data['list_discussions'] = $list_discussions = $this->model_posts->get_list_discussions();

		$this->load->view('template/header');
		$this->load->view('posts/discussion_add', $view_data);
		$this->load->view('template/footer');

		print_r($list_discussions);		
	}
	####################################################################
	public function task_add(){
		if(isset($_REQUEST['post_title'])){
			$data["parent_id"]= $_REQUEST["discussion_id"];
			$data["post_title"]= $_REQUEST["post_title"];
			$data["post_content"]= $_REQUEST["post_content"];
			$data["post_type"]= "task";

			$this->model_posts->add_post($data);
		}
		
                $view_data['list_discussions'] = $this->model_posts->get_list_discussions();
                
                $view_data['list_tasks'] = $list_tasks = $this->model_posts->get_list_tasks();

		$this->load->view('template/header');
		$this->load->view('posts/task_add', $view_data);
		$this->load->view('template/footer');
		print_r($list_tasks);		
	}
	####################################################################
	public function comment_add()
	{
            if(isset($_REQUEST['post_title'])){
                $data["parent_id"]= $_REQUEST["discussion_id"];
                $data["post_title"]= $_REQUEST["post_title"];
                $data["post_content"]= $_REQUEST["post_content"];
                $data["post_type"]= "comment";

                $this->model_posts->add_post($data);
            }


            $view_data['list_comments'] = $list_comments = $this->model_posts->get_list_comments();

            $this->load->view('template/header');
            $this->load->view('posts/comment_add', $view_data);
            $this->load->view('template/footer');
            print_r($list_comments);		
	}
}