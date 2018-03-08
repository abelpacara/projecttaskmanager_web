<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locations extends CI_Controller {
	####################################################################
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		
		$this->load->model('model_locations');
		$this->load->model('model_template');

		$this->load->helper(array('form', 'url'));
		$this->load->helper("my_views");
		$this->load->helper("my_dates");
		$this->load->library('form_validation');
		$this->load->library('ciqrcode');
	}
	####################################################################
	public function office_add(){
		
		$location_id = "";
		if(isset($_REQUEST['location_id'])){
           $location_id = $_REQUEST['location_id'];
		}

		if(isset($_REQUEST['btn_save'])){			
			$data['office_name'] = $_POST['office_name'];
			$data['office_shortname'] = $_POST['office_shortname'];
			$data['office_description'] = $_POST['office_description'];

			$this->model_locations->office_add($data);
		}

		
		$view_data['list_offices'] = $this->model_locations->get_list_offices();
	

		$view_data['location_id'] = $location_id;

		$this->load->view('template/header');
		$this->load->view('locations/office_add', $view_data);
		$this->load->view('template/footer');
	}
	####################################################################
	public function location_add(){
		
		$location_id = "";
		if(isset($_REQUEST['location_id'])){
           $location_id = $_REQUEST['location_id'];
		}

		if(isset($_REQUEST['btn_save'])){

			if(isset($_POST['location_id']) AND strcasecmp($_POST['location_id'],"")!=0){
				$data['parent_id'] = $_POST['location_id'];	
			}			

			$data['location_name'] = $_POST['location_name'];
			$data['location_description'] = $_POST['location_description'];

			$this->model_locations->location_add($data);
		}


		$office_id = 2;



		$list_locations = array();
		$this->model_template->generate_list_locations_tree($list_locations, $office_id);
		$view_data['list_locations'] = $list_locations;



		$view_data['office'] = $this->model_locations->get_office($office_id);		

		$view_data['location_id'] = $location_id;

		$this->load->view('template/header');
		$this->load->view('locations/location_add', $view_data);
		$this->load->view('template/footer');
	}
}