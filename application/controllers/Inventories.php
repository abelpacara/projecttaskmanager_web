<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventories extends CI_Controller {
	####################################################################
	public function __construct()
	{
		parent::__construct();
      $this->load->library('session');
      $this->load->model('model_template');
      $this->load->model('model_inventories');
      $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}
	####################################################################
	public function index()
	{
		$this->load->view('welcome_message');
	}
	####################################################################
	public function kardex_view(){		
		
		$list_found_kardexes = array();
		if(isset($_REQUEST['btn_search'])){			
			$list_found_kardexes = $this->model_inventories->get_list_found_kardexes($_REQUEST['kardex_code'], $_REQUEST['kardex_serial']);
		}
		$view_data['list_found_kardexes'] = $list_found_kardexes;

		

		$this->load->view('template/header');
		$this->load->view('inventories/kardex_search', $view_data);
		$this->load->view('template/footer');
	}	
	####################################################################
	public function kardex_search(){		
		
		$list_found_kardexes = array();
		if(isset($_REQUEST['btn_search'])){			
			$list_found_kardexes = $this->model_inventories->get_list_found_kardexes($_REQUEST['kardex_code'], $_REQUEST['kardex_serial']);
		}
		$view_data['list_found_kardexes'] = $list_found_kardexes;

		

		$this->load->view('template/header');
		$this->load->view('inventories/kardex_search', $view_data);
		$this->load->view('template/footer');
	}
	####################################################################
	public function kardex_data(){		
		header('Access-Control-Allow-Origin: *');

		$matches = array();
		if(isset($_REQUEST['kardex_code'])){			

			$matches = $this->model_inventories->get_kardex("kardex_code", $_REQUEST['kardex_code']);
		}
		print_r($matches);		
	}
	####################################################################
	public function list_kardexes_code(){		
		header('Access-Control-Allow-Origin: *');

		$matches = array();
		if(isset($_REQUEST['term'])){			
			$matches = $this->array_values_recursive( $this->model_inventories->list_kardexes_code($_REQUEST['term']) );
		}		
		echo json_encode($matches);
	}
	####################################################################
	function array_values_recursive($ary)
	{
	   $lst = array();
	   foreach( array_keys($ary) as $k ){
	      $v = $ary[$k];
	      if (is_scalar($v)) {
	         $lst[] = $v;
	      } elseif (is_array($v)) {
	         $lst = array_merge( $lst,
	            $this->array_values_recursive($v)
	         );
	      }
	   }
	   return $lst;
	}
	####################################################################
	public function list_kardexes_status(){

		$list_kardexes_status = $this->model_inventories->get_list_table_enum_column_values("kardexes_status","kardex_status_value");

		$matches = array();
		if(isset($_REQUEST['term'])){			
			$matches = preg_grep("/".$_REQUEST['term']."/", $list_kardexes_status);			
		}		
		echo json_encode($matches);
	}	
	####################################################################
	public function kardex_save2()
	{
		if(isset($_REQUEST['btn_save'])) // verify if FOUND
		{
			$data_kardex_status["kardex_status_value"]= $_REQUEST["kardex_status_value"];
			$data_kardex_status["location_id"]= $_REQUEST["location_id"];
			$data_kardex_status["kardex_id"]= $_REQUEST["kardex_id"];
			$this->model_inventories->add_kardex_status($data_kardex_status);

			$view_data['kardex']= $this->model_inventories->get_kardex_by_id($_REQUEST['kardex_id']);
		}
		else{
			$view_data['kardex']= $this->model_inventories->get_kardex_by_id($_REQUEST['kardex_id']);
		}

		$view_data['list_kardexes_status'] = $this->model_inventories->get_list_table_enum_column_values("kardexes_status","kardex_status_value");
		$view_data['list_locations']= $this->model_inventories->get_list_locations();
		
		$this->load->view('template/header');
		$this->load->view('inventories/kardex_save2', $view_data);
		$this->load->view('template/footer');		
	}
	####################################################################
	public function kardex_save()
	{
		if(isset($_REQUEST['btn_search'])) {


			$this->model_inventories->get_inventory($_REQUEST["inventory_name"]);

			$data_inventory["inventory_mark"]= $_REQUEST["inventory_mark"];			
			$data_inventory["inventory_model"]= $_REQUEST["inventory_model"];

			$id_inventory = $this->model_inventories->add_inventory($data_inventory);


			$data_kardex["inventory_id"]= $id_inventory;
			$data_kardex["kardex_code"]= $_REQUEST["kardex_code"];
			$data_kardex["kardex_serial"]= $_REQUEST["kardex_serial"];			
			
			$id_kardex = $this->model_inventories->add_kardex($data_kardex);

			$data_kardex_status["kardex_status_value"]= $_REQUEST["kardex_status_value"];
			$data_kardex_status["location_id"]= $_REQUEST["location_id"];




			if($found){
				$view_data['found'] = 1;
			}
		}
		if(isset($_REQUEST['btn_save'])) // verify if FOUND
		{

			$data_inventory["inventory_name"]= $_REQUEST["inventory_name"];
			$data_inventory["inventory_mark"]= $_REQUEST["inventory_mark"];			
			$data_inventory["inventory_model"]= $_REQUEST["inventory_model"];

			$id_inventory = $this->model_inventories->add_inventory($data_inventory);


			$data_kardex["inventory_id"]= $id_inventory;
			$data_kardex["kardex_code"]= $_REQUEST["kardex_code"];
			$data_kardex["kardex_serial"]= $_REQUEST["kardex_serial"];			
			
			$id_kardex = $this->model_inventories->add_kardex($data_kardex);

			$data_kardex_status["kardex_status_value"]= $_REQUEST["kardex_status_value"];
			$data_kardex_status["location_id"]= $_REQUEST["location_id"];
			$data_kardex_status["kardex_id"]= $id_kardex;
			$this->model_inventories->add_kardex_status($data_kardex_status);
		}

		$list_kardexes_code = $this->model_inventories->get_list_kardexes_code();

		print_r($list_kardexes_code);

		$view_data['list_kardexes']= $this->model_inventories->get_list_kardexes();

		$view_data['list_kardexes_status'] = $this->model_inventories->get_list_table_enum_column_values("kardexes_status","kardex_status_value");

		$view_data['list_locations']= $this->model_inventories->get_list_locations();
		
		$this->load->view('template/header');
		$this->load->view('inventories/kardex_save', $view_data);
		$this->load->view('template/footer');		
	}
	####################################################################
	public function save_inventory()
	{
		if(isset($_REQUEST['post_title']))
		{

			$data["parent_id"]= $_REQUEST["project_id"];
			$data["post_title"]= $_REQUEST["post_title"];
			$data["post_content"]= $_REQUEST["post_content"];
			$data["post_type"]= "discussion";

			$this->model_posts->add_post($data);
		}

		$view_data['list_projects']= $this->model_posts->get_list_projects();

		$this->load->view('template/header');
		$this->load->view('posts/save_discussion', $view_data);
		$this->load->view('template/footer');

		print_r($this->model_posts->get_list_posts());		
	}
	
}