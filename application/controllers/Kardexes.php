<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kardexes extends CI_Controller {
	####################################################################
	public function __construct(){
		parent::__construct();
      $this->load->library('session');
      $this->load->model('model_template');
      $this->load->model('model_kardexes');
      $this->load->helper(array('form', 'url'));
      $this->load->helper("my_views");
      $this->load->helper("my_dates");
		$this->load->library('form_validation');
		$this->load->library('ciqrcode');
	}
	####################################################################
	public function index(){
		redirect("./kardexes/kardex_manager");
	}
   ####################################################################
	public function kardex_malformed(){
		if(isset($_REQUEST['btn_save'])){

			$id_inventory_category = NULL;
			$inventory_category = $this->model_kardexes->get_inventory_category_by($_REQUEST['inventory_category_name']);
			if( count($inventory_category)>0 ){
				$id_inventory_category = $inventory_category['id_inventory_category'];
			}
			else{
				$inventory_category_data['inventory_category_name'] = $_REQUEST['inventory_category_name'];
				$id_inventory_category = $this->model_kardexes->inventory_category_add($inventory_category_data);
			}

			$id_inventory = NULL;			
			$inventory = $this->model_kardexes->get_inventory_by($id_inventory_category, $_REQUEST['inventory_mark'], $_REQUEST['inventory_model']);
			if( count($inventory)>0 ){
				$id_inventory = $inventory['id_inventory'];
			}
			else{
				$inventory_data['inventory_mark'] = $_REQUEST['inventory_mark'];
				$inventory_data['inventory_model'] = $_REQUEST['inventory_model'];
				$inventory_data['inventory_category_id'] = $id_inventory_category;
				$id_inventory = $this->model_kardexes->inventory_add($inventory_data);				
			}

			$kardex_data['kardex_code'] = $_REQUEST['kardex_code'];
			$kardex_data['kardex_serial'] = $_REQUEST['kardex_serial'];
			$kardex_data['inventory_id'] = $id_inventory;
			$id_kardex = $this->model_kardexes->kardex_add($kardex_data);

			$kardex_status_data['location_id'] = $_REQUEST['location_id'];
			$kardex_status_data['kardex_status_value'] = $_REQUEST['kardex_status_value'];
			$kardex_status_data['kardex_status_description'] = $_REQUEST['kardex_status_description'];
			

			list($day, $month, $year) = explode("/", $_REQUEST['kardex_status_register_date']);
			$kardex_status_data['kardex_status_register_date'] = $year."-".$month."-".$day;

			$kardex_status_data['kardex_id'] = $id_kardex;
			$this->model_kardexes->kardex_status_add($kardex_status_data);
		}


		 /* $list_locations_tree = array();      
      $this->model_kardexes->generate_list_locations_tree($list_locations_tree);
      $view_data['list_locations_tree'] = $list_locations_tree;*/

      $view_data['list_locations'] = $this->model_kardexes->get_list_locations();
      $view_data['kardex_status_register_date'] = date('d/m/Y', strtotime($this->model_kardexes->get_system_time()) );

		$view_data['list_kardexes_status_values'] = $this->model_kardexes->get_list_table_enum_column_values("kardexes_status","kardex_status_value");

		$view_data['list_kardexes_full'] = $this->model_kardexes->get_list_kardexes_full();

		$this->load->view('template/header');
		$this->load->view('kardexes/kardex_malformed', $view_data);
		$this->load->view('template/footer');

	} 
        
      ####################################################################
	public function kardex_delete(){
		if(isset($_REQUEST['kardex_id'])) // verify if FOUND
		{
			$this->model_kardexes->kardexes_status_delete($_REQUEST['kardex_id']);
			$this->model_kardexes->kardex_delete($_REQUEST['kardex_id']);

			redirect("./kardexes/kardex_add");		
		}
                
	   if(isset($_REQUEST['kardex_id'])){
		}
	}
   ####################################################################
	public function kardex_save(){
		if(isset($_REQUEST['btn_save'])) // verify if FOUND
		{
			$data_kardex["kardex_code"]= $_REQUEST["kardex_code"];

			$data_kardex["kardex_serial"]= $_REQUEST["kardex_serial"];

			$kardex_status_register_date = spanish_date_format_to_mysql($_REQUEST['kardex_status_register_date']);

			$data_kardex["kardex_start_date"]= $kardex_status_register_date;

			
			$data_kardex_status['kardex_status_register_date'] = $kardex_status_register_date;
			$data_kardex_status["location_id"] = $location_id = $_REQUEST["location_id"];
                        
                        
			$this->model_kardexes->kardex_status_first_update($data_kardex_status, $_REQUEST["kardex_id"]);
			
			$this->model_kardexes->kardex_update($data_kardex, $_REQUEST["kardex_id"]);

			redirect("./kardexes/kardex_manager");
		}
                
	    if(isset($_REQUEST['kardex_id'])){

	        $view_data['kardex']= $this->model_kardexes->get_kardex_by_id($_REQUEST['kardex_id']);

	        $view_data['list_kardexes_status'] = $this->model_kardexes->get_list_table_enum_column_values("kardexes_status","kardex_status_value");
	        

	        $list_locations = array();
                $this->model_kardexes->generate_list_locations_tree($list_locations);
                $view_data['list_locations'] = $list_locations;



                $view_data['kardex_status_first'] = $kardex_status_first = $this->model_kardexes->get_kardex_status_first_by($_REQUEST['kardex_id']);
                
                $view_data['list_kardexes_by_location'] = $this->model_kardexes->get_list_kardexes_by_location($kardex_status_first['location_id']);
                
                

	        $view_data['list_kardexes_status']= $this->model_kardexes->get_list_kardexes_status($_REQUEST['kardex_id']);		

	        $view_data['list_purchases'] = $this->model_kardexes->get_list_purchases();

	        $this->load->view('template/header');
	        $this->load->view('kardexes/kardex_save', $view_data);
	        $this->load->view('template/footer');
	    }
	}
	####################################################################
	public function kardex_manager(){
		if(isset($_REQUEST['btn_save'])){

			$id_inventory_category = NULL;
			$inventory_category = $this->model_kardexes->get_inventory_category_by($_REQUEST['inventory_category_name']);
			if( count($inventory_category)>0 ){
				$id_inventory_category = $inventory_category['id_inventory_category'];
			}
			else{
				$inventory_category_data['inventory_category_name'] = $_REQUEST['inventory_category_name'];
				$id_inventory_category = $this->model_kardexes->inventory_category_add($inventory_category_data);
			}

			$id_inventory = NULL;			
			$inventory = $this->model_kardexes->get_inventory_by($id_inventory_category, $_REQUEST['inventory_mark'], $_REQUEST['inventory_model']);
			if( count($inventory)>0 ){
				$id_inventory = $inventory['id_inventory'];
			}
			else{
				$inventory_data['inventory_mark'] = $_REQUEST['inventory_mark'];
				$inventory_data['inventory_model'] = $_REQUEST['inventory_model'];
				$inventory_data['inventory_category_id'] = $id_inventory_category;
				$id_inventory = $this->model_kardexes->inventory_add($inventory_data);				
			}

			$kardex_data['kardex_code'] = $_REQUEST['kardex_code'];
			$kardex_data['kardex_serial'] = $_REQUEST['kardex_serial'];
			$kardex_data['inventory_id'] = $id_inventory;
			$id_kardex = $this->model_kardexes->kardex_add($kardex_data);

			$kardex_status_data['location_id'] = $_REQUEST['location_id'];
			$kardex_status_data['kardex_status_value'] = $_REQUEST['kardex_status_value'];
			$kardex_status_data['kardex_status_description'] = $_REQUEST['kardex_status_description'];
			

			list($day, $month, $year) = explode("/", $_REQUEST['kardex_status_register_date']);
			$kardex_status_data['kardex_status_register_date'] = $year."-".$month."-".$day;

			$kardex_status_data['kardex_id'] = $id_kardex;
			$this->model_kardexes->kardex_status_add($kardex_status_data);
		}


		 /* $list_locations_tree = array();      
      $this->model_kardexes->generate_list_locations_tree($list_locations_tree);
      $view_data['list_locations_tree'] = $list_locations_tree;*/

      $view_data['list_locations'] = $this->model_kardexes->get_list_locations();
      $view_data['kardex_status_register_date'] = date('d/m/Y', strtotime($this->model_kardexes->get_system_time()) );

		$view_data['list_kardexes_status_values'] = $this->model_kardexes->get_list_table_enum_column_values("kardexes_status","kardex_status_value");

		$view_data['list_kardexes_full'] = $this->model_kardexes->get_list_kardexes_full();

		$this->load->view('template/header');
		$this->load->view('kardexes/kardex_manager', $view_data);
		$this->load->view('template/footer');

	}
	####################################################################
	public function report_form(){

		if(isset($_REQUEST['btn_generate'])){
			$this->report($_REQUEST['location_id'], 
								isset($_REQUEST['maintenance_start_register_date'])? NULL: spanish_date_to_mysql( $_REQUEST['maintenance_start_register_date'] ), 
								isset($_REQUEST['maintenance_end_register_date'])? NULL: spanish_date_to_mysql( $_REQUEST['maintenance_end_register_date'] ) );
		}

		$list_locations = array();
		$this->model_kardexes->generate_list_locations_tree($list_locations);
		$view_data['list_locations'] = $list_locations;


		$this->load->view('template/header');
		$this->load->view('kardexes/report_form', $view_data);
		$this->load->view('template/footer');
	}
	####################################################################
	function report($location_id, $maintenance_start_register_date, $maintenance_end_register_date){
		$this->load->library('Pdf');
	
		$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "REPORTE GENERAL DE KARDEX DE EQUIPOS";
		/*
		$obj_pdf->SetTitle($title);
		$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
		$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$obj_pdf->SetDefaultMonospacedFont('helvetica');
		$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$obj_pdf->SetFont('helvetica', '', 9);
		$obj_pdf->setFontSubsetting(false);
		*/
		//$obj_pdf->AddPage('L', 'A4');
		$obj_pdf->AddPage('L', 'A4');
		
		ob_start();

		?>
		

		<div id="logo_container" style="width: 200px; height: 100px">
	      <a class="navbar-brand" href="#">
	      	<img id="logo" src='<?php echo base_url("public/images/logo.png");?>'/>
	      </a>
      </div>
			<h1>REPORTE GENERAL DE KARDEX DE EQUIPOS</h1>
		<?php
		$list_kardexes_full = $this->model_kardexes->get_list_kardexes_full($location_id);
		?>
		<table border="1">			
			<tr bgcolor="#cccccc">
				<th width="3%" rowspan="2" style="text-align: center; font-weight: bold;">#</th>
				<th width="12%" rowspan="2" style="text-align: center; font-weight: bold;">Categoria</th>
				<th width="12%" rowspan="2" style="text-align: center; font-weight: bold;">Marca</th>
				<th width="12%" rowspan="2" style="text-align: center; font-weight: bold;">Modelo</th>
				<th width="12%" rowspan="2" style="text-align: center; font-weight: bold;">Codigo</th>
				<th width="12%" rowspan="2" style="text-align: center; font-weight: bold;">Serial</th>
				<th width="25%" colspan="3" style="text-align: center; font-weight: bold;">Ultimo Estado</th>				
			</tr>
			<tr  bgcolor="#cccccc">				
				<th>Estado</th>
				<th>Localidad</th>
				<th>Fecha</th>
			</tr>

			<?php
			for($i=0; $i<count($list_kardexes_full); $i++){?>
				<tr>
					<td><?php echo $i+1 ?></td>
					<td><?php echo $list_kardexes_full[$i]['inventory_category_name'] ?></td>
					<td><?php echo $list_kardexes_full[$i]['inventory_mark'] ?></td>
					<td><?php echo $list_kardexes_full[$i]['inventory_model'] ?></td>
					<td><?php echo $list_kardexes_full[$i]['kardex_code'] ?></td>
					<td><?php echo $list_kardexes_full[$i]['kardex_serial'] ?></td>		

					<td><?php echo $list_kardexes_full[$i]['kardex_status_value'] ?></td>
					<td><?php echo $list_kardexes_full[$i]['location_name'] ?></td>
					<td><?php echo date("d-m-Y", strtotime($list_kardexes_full[$i]['kardex_status_register_date'])) ?></td>
				</tr>
			<?php
			}
			?>
		</table>



			<?php


		    // we can have any view part here like HTML, PHP etc
		    $content = ob_get_contents();
			ob_end_clean();


		$obj_pdf->writeHTML($content, true, false, true, false, '');
		$obj_pdf->Output('output.pdf', 'I');


   }
	####################################################################
	public function qr_generate(){
		//header("Content-Type: image/png");
		$params['data'] = 'This is a text to encode become QR Code';
		$this->ciqrcode->generate($params);
	}
	
	####################################################################
	public function kardex_view(){
		$list_found_kardexes = array();
		if(isset($_REQUEST['btn_search'])){			
			$list_found_kardexes = $this->model_kardexes->get_list_found_kardexes($_REQUEST['kardex_code'], $_REQUEST['kardex_serial']);
		}
		
		$view_data['list_found_kardexes'] = $list_found_kardexes;

		$this->load->view('template/header');
		$this->load->view('kardexes/kardex_search', $view_data);
		$this->load->view('template/footer');
	}
	####################################################################
	public function kardex_status_save(){
		if(isset($_REQUEST['btn_save'])) // verify if FOUND
		{
			$data_kardex_status["kardex_status_value"]= $_REQUEST["kardex_status_value"];

			$data_kardex_status["kardex_status_description"]= $_REQUEST["kardex_status_description"];
			$data_kardex_status["kardex_status_register_date"]= spanish_date_format_to_mysql($_REQUEST["kardex_status_register_date"]);

			$data_kardex_status["location_id"]= $_REQUEST["location_id"];
			$data_kardex_status["kardex_id"]= $_REQUEST["kardex_id"];
			$this->model_kardexes->kardex_status_add($data_kardex_status);
		}
		
		if(isset($_REQUEST['kardex_id'])){
			$view_data['kardex_id'] = $_REQUEST['kardex_id'];
	 	}

		$view_data['kardex'] = $this->model_kardexes->get_kardex_by_id($_REQUEST['kardex_id']);

		$view_data['list_kardexes_status_values'] = $this->model_kardexes->get_list_table_enum_column_values("kardexes_status","kardex_status_value");
		

		$list_locations = array();
      $this->model_kardexes->generate_list_locations_tree($list_locations);
      $view_data['list_locations'] = $list_locations;


      $view_data['kardex_status_register_date'] = date('d/m/Y', strtotime($this->model_kardexes->get_system_time()) );


		$view_data['list_kardexes_status'] = $this->model_kardexes->get_list_kardexes_status($_REQUEST['kardex_id']);

		$this->load->view('template/header');
		$this->load->view('kardexes/kardex_status_save', $view_data);
		$this->load->view('template/footer');		
	}	
	####################################################################
	public function kardex_search(){		
		
		$list_found_kardexes = array();
		$kardex_code = "";
		$kardex_serial = "";
		$location_id = "";
		$kardex_status_value = "";

		$inventory_category_name = "";
		$inventory_mark = "";
		$inventory_model = "";

		if(isset($_REQUEST['btn_search'])){
			$view_data['kardex_code'] = $kardex_code = $_REQUEST['kardex_code'];
			$view_data['kardex_serial'] = $kardex_serial = $_REQUEST['kardex_serial'];

			$view_data['inventory_category_name'] = $inventory_category_name = $_REQUEST['inventory_category_name'];
			$view_data['inventory_mark'] = $inventory_mark = $_REQUEST['inventory_mark'];
			$view_data['inventory_model'] = $inventory_model = $_REQUEST['inventory_model'];

			$view_data['location_id'] = $location_id = $_REQUEST['location_id'];
			$view_data['kardex_status_value'] = $kardex_status_value = $_REQUEST['kardex_status_value'];
			
		}

		$view_data['list_kardexes_status_values'] = $this->model_kardexes->get_list_table_enum_column_values("kardexes_status","kardex_status_value");
		
		$list_locations = array();
      $this->model_kardexes->generate_list_locations_tree($list_locations);
      $view_data['list_locations'] = $list_locations;

		$view_data['list_found_kardexes'] = $this->model_kardexes->get_list_kardexes_full($location_id, $kardex_code, $kardex_serial, $kardex_status_value, $inventory_category_name, $inventory_mark, $inventory_model);
		 

		

		$this->load->view('template/header');
		$this->load->view('kardexes/kardex_search', $view_data);
		$this->load->view('template/footer');
	}
	
	####################################################################
	public function list_kardexes_code(){		
		header('Access-Control-Allow-Origin: *');

		$matches = array();
		if(isset($_REQUEST['term'])){			
			$matches = $this->array_values_recursive( $this->model_kardexes->list_kardexes_code($_REQUEST['term']) );
		}		
		echo json_encode($matches);
	}
	####################################################################
	public function list_inventories_categories(){		
		header('Access-Control-Allow-Origin: *');

		$matches = array();
		if(isset($_REQUEST['term'])){			
			$matches = $this->array_values_recursive( $this->model_kardexes->get_list_inventories_categories_by($_REQUEST['term']) );
		}		
		echo json_encode($matches);
	}
	####################################################################
	public function list_kardexes_status(){

		$list_kardexes_status = $this->model_kardexes->get_list_table_enum_column_values("kardexes_status","kardex_status_value");

		$matches = array();
		if(isset($_REQUEST['term'])){			
			$matches = preg_grep("/".$_REQUEST['term']."/", $list_kardexes_status);			
		}		
		echo json_encode($matches);
	}	
	
	####################################################################
	public function kardex_add()
	{
		$location_id = "";
    	if(isset($_REQUEST['location_id'])){
           $location_id = $_REQUEST['location_id'];
           $view_data['list_kardexes_by_location'] = $this->model_kardexes->get_list_kardexes_by_location($location_id);
		}

		if(isset($_REQUEST['btn_save'])){

			$id_inventory_category = NULL;
			$inventory_category = $this->model_kardexes->get_inventory_category_by($_REQUEST['inventory_category_name']);

			
			

			if( count($inventory_category)>0 ){
				$id_inventory_category = $inventory_category['id_inventory_category'];				
			}
			else{
				$inventory_category_data['inventory_category_name'] = $_REQUEST['inventory_category_name'];
				$id_inventory_category = $this->model_kardexes->inventory_category_add($inventory_category_data);
			}

			$id_inventory = NULL;
			$inventory = $this->model_kardexes->get_inventory_by($id_inventory_category, $_REQUEST['inventory_mark'], $_REQUEST['inventory_model']);
			if( count($inventory)>0 ){
				$id_inventory = $inventory['id_inventory'];
			}
			else{
								
				$inventory_data['inventory_mark'] = $_REQUEST['inventory_mark'];
				$inventory_data['inventory_model'] = $_REQUEST['inventory_model'];
				$inventory_data['inventory_category_id'] = $id_inventory_category;				
				$id_inventory = $this->model_kardexes->inventory_add($inventory_data);				
			}

			$kardex_data['kardex_code'] = $_REQUEST['kardex_code'];
			$kardex_data['kardex_serial'] = $_REQUEST['kardex_serial'];
			$kardex_data['kardex_description'] = $_REQUEST['kardex_description'];
			$kardex_data['parent_id'] = $_REQUEST['parent_id'];
                        $kardex_data['purchase_item_id'] = $_REQUEST['purchase_item_id'];
                        
			$kardex_data['inventory_id'] = $id_inventory;

			$kardex_status_register_date = spanish_date_format_to_mysql($_REQUEST['kardex_status_register_date']);
			$kardex_data['kardex_start_date'] = $kardex_status_register_date;

			$id_kardex = $this->model_kardexes->kardex_add($kardex_data);

			$kardex_status_data['location_id'] = $_REQUEST['location_id'];
			$kardex_status_data['kardex_status_value'] = $_REQUEST['kardex_status_value'];
			$kardex_status_data['kardex_status_register_date'] = $kardex_status_register_date;

			$kardex_status_data['kardex_id'] = $id_kardex;
			$this->model_kardexes->kardex_status_add($kardex_status_data);
		}


		 /* $list_locations_tree = array();      
      $this->model_kardexes->generate_list_locations_tree($list_locations_tree);
      $view_data['list_locations_tree'] = $list_locations_tree;*/

      

      $view_data['location_id'] = $location_id;

      $list_locations = array();
      $this->model_kardexes->generate_list_locations_tree($list_locations);
      $view_data['list_locations'] = $list_locations;

      $view_data['kardex_status_register_date'] = date('d/m/Y', strtotime($this->model_kardexes->get_system_time()) );

		$view_data['list_kardexes_status_values'] = $this->model_kardexes->get_list_table_enum_column_values("kardexes_status","kardex_status_value");

		$view_data['list_kardexes_full'] = $this->model_kardexes->get_list_kardexes_full($location_id);


		$view_data['list_purchases'] = $this->model_kardexes->get_list_purchases();


		$this->load->view('template/header');
		$this->load->view('kardexes/kardex_add', $view_data);
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
			$this->model_kardexes->inventory_add($data);
		}

		$view_data['list_inventories_categories']= $this->model_kardexes->get_list_inventories_categories();
		$view_data['list_inventories']= $this->model_kardexes->get_list_inventories();

		$this->load->view('template/header');
		$this->load->view('kardexes/inventory_add', $view_data);
		$this->load->view('template/footer');

	}
	
	####################################################################
	public function inventory_category_add()
	{
		if(isset($_REQUEST['btn_save'])){

			
			$data['inventory_category_name'] = $_REQUEST['inventory_category_name'];			
			$data['inventory_category_description'] = $_REQUEST['inventory_category_description'];
			$this->model_kardexes->inventory_category_add($data);
		}

		$view_data['list_inventories_categories']= $this->model_kardexes->get_list_inventories_categories();		

		$this->load->view('template/header');
		$this->load->view('kardexes/inventory_category_add', $view_data);
		$this->load->view('template/footer');

	}
	
}