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
      $this->load->helper("my_views");
		$this->load->library('form_validation');
		$this->load->library('ciqrcode');
	}
	
	####################################################################
	public function qr_generate(){
		//header("Content-Type: image/png");
		$params['data'] = 'This is a text to encode become QR Code';
		$this->ciqrcode->generate($params);
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
	public function kardex_status_save()
	{
		if(isset($_REQUEST['btn_save'])) // verify if FOUND
		{
			$data_kardex_status["kardex_status_value"]= $_REQUEST["kardex_status_value"];
			$data_kardex_status["location_id"]= $_REQUEST["location_id"];
			$data_kardex_status["kardex_id"]= $_REQUEST["kardex_id"];
			$this->model_inventories->kardex_status_add($data_kardex_status);
		}
		
		$view_data['kardex'] = $this->model_inventories->get_kardex_by_id($_REQUEST['kardex_id']);

		$view_data['list_kardexes_status_values'] = $this->model_inventories->get_list_table_enum_column_values("kardexes_status","kardex_status_value");
		$view_data['list_locations']= $this->model_inventories->get_list_locations();

		$view_data['list_kardexes_status'] = $this->model_inventories->get_list_kardexes_status();
		
		$this->load->view('template/header');
		$this->load->view('inventories/kardex_status_save', $view_data);
		$this->load->view('template/footer');		
	}	
	####################################################################
	public function kardex_search(){		
		
		$list_found_kardexes = array();
		$kardex_code = "";
		$kardex_serial = "";
		if(isset($_REQUEST['btn_search'])){
			$kardex_code = $_REQUEST['kardex_code'];
			$kardex_serial = $_REQUEST['kardex_serial'];
		}
		$view_data['list_found_kardexes'] = $this->model_inventories->get_list_found_kardexes($kardex_code, $kardex_serial);
		 

		

		$this->load->view('template/header');
		$this->load->view('inventories/kardex_search', $view_data);
		$this->load->view('template/footer');
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
	public function list_kardexes_status(){

		$list_kardexes_status = $this->model_inventories->get_list_table_enum_column_values("kardexes_status","kardex_status_value");

		$matches = array();
		if(isset($_REQUEST['term'])){			
			$matches = preg_grep("/".$_REQUEST['term']."/", $list_kardexes_status);			
		}		
		echo json_encode($matches);
	}	
	####################################################################
	public function kardex_save()
	{
		if(isset($_REQUEST['btn_save'])) // verify if FOUND
		{
			$data_kardex["kardex_code"]= $_REQUEST["kardex_code"];
			$data_kardex["kardex_serial"]= $_REQUEST["kardex_serial"];
			$this->model_inventories->save_kardex($data_kardex, $_REQUEST["kardex_id"]);
		}

		$view_data['kardex']= $this->model_inventories->get_kardex_by_id($_REQUEST['kardex_id']);
		
		
		$view_data['list_kardexes_status'] = $this->model_inventories->get_list_table_enum_column_values("kardexes_status","kardex_status_value");
		$view_data['list_locations']= $this->model_inventories->get_list_locations();

		$view_data['list_kardexes']= $this->model_inventories->get_list_kardexes();		
		
		$this->load->view('template/header');
		$this->load->view('inventories/kardex_save', $view_data);
		$this->load->view('template/footer');		
	}
	####################################################################
	public function kardex_add()
	{
		if(isset($_REQUEST['btn_save'])){

			$id_inventory_category = NULL;
			$inventory_category = $this->model_inventories->get_inventory_category_by($_REQUEST['inventory_category_name']);
			if( count($inventory_category)>0 ){
				$id_inventory_category = $inventory_category['id_inventory_category'];
			}
			else{
				$inventory_category_data['category_inventory_name'] = $_REQUEST['inventory_category_name'];
				$id_inventory_category = $this->model_inventories->inventory_category_add($inventory_category_data);
			}

			$id_inventory = NULL;			
			$inventory = $this->model_inventories->get_inventory_by($_REQUEST['inventory_mark'], $_REQUEST['inventory_model']);
			if( count($inventory)>0 ){
				$id_inventory = $inventory['id_inventory'];
			}
			else{
				$inventory_data['inventory_mark'] = $_REQUEST['inventory_mark'];
				$inventory_data['inventory_model'] = $_REQUEST['inventory_model'];
				$inventory_data['inventory_category_id'] = $id_inventory_category;
				$id_inventory = $this->model_inventories->inventory_add($inventory_data);				
			}

			$kardex_data['kardex_code'] = $_REQUEST['kardex_code'];
			$kardex_data['kardex_serial'] = $_REQUEST['kardex_serial'];
			$kardex_data['inventory_id'] = $id_inventory;
			$id_kardex = $this->model_inventories->kardex_add($kardex_data);

			$kardex_status_data['location_id'] = $_REQUEST['location_id'];
			$kardex_status_data['kardex_status_value'] = $_REQUEST['kardex_status_value'];
			$kardex_status_data['kardex_status_description'] = $_REQUEST['kardex_status_description'];
			$kardex_status_data['kardex_id'] = $id_kardex;
			$this->model_inventories->kardex_status_add($kardex_status_data);
		}


		  $list_locations_tree = array();      
      $this->model_inventories->generate_list_locations_tree($list_locations_tree);
      $view_data['list_locations_tree'] = $list_locations_tree;


		$view_data['list_kardexes_status_values'] = $this->model_inventories->get_list_table_enum_column_values("kardexes_status","kardex_status_value");

		$view_data['list_kardexes_full'] = $this->model_inventories->get_list_kardexes_full();

		$this->load->view('template/header');
		$this->load->view('inventories/kardex_add', $view_data);
		$this->load->view('template/footer');

	}
	####################################################################
	public function inventory_add()
	{
		if(isset($_REQUEST['btn_save'])){

			$data['inventory_category_id'] = $_REQUEST['inventory_category_id'];
			$data['inventory_mark'] = $_REQUEST['inventory_mark'];
			$data['inventory_model'] = $_REQUEST['inventory_model'];
			$data['inventory_description'] = $_REQUEST['inventory_description'];
			$this->model_inventories->inventory_add($data);
		}

		$view_data['list_inventories_categories']= $this->model_inventories->get_list_inventories_categories();
		$view_data['list_inventories']= $this->model_inventories->get_list_inventories();

		$this->load->view('template/header');
		$this->load->view('inventories/inventory_add', $view_data);
		$this->load->view('template/footer');

	}
	
	####################################################################
	public function inventory_category_add()
	{
		if(isset($_REQUEST['btn_save'])){

			
			$data['inventory_category_name'] = $_REQUEST['inventory_category_name'];			
			$data['inventory_category_description'] = $_REQUEST['inventory_category_description'];
			$this->model_inventories->inventory_category_add($data);
		}

		$view_data['list_inventories_categories']= $this->model_inventories->get_list_inventories_categories();		

		$this->load->view('template/header');
		$this->load->view('inventories/inventory_category_add', $view_data);
		$this->load->view('template/footer');

	}
	
}