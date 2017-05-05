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
			$this->model_inventories->add_kardex_status($data_kardex_status);
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

			$data['inventory_category_id'] = $_REQUEST['inventory_category_id'];
			$data['inventory_mark'] = $_REQUEST['inventory_mark'];
			$data['inventory_model'] = $_REQUEST['inventory_model'];
			$data['inventory_descripcion'] = $_REQUEST['inventory_descripcion'];
			$this->model_inventories->inventory_category_add($data);
		}

		$view_data['list_kardexes']= $this->model_inventories->get_list_kardexes();

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