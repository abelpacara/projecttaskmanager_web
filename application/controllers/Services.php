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
      $this->load->helper(array('form', 'url','my_files'));
		$this->load->library('form_validation');
		$this->load->model('model_inventories');
	}
	####################################################################
	public function list_kardexes_by_location(){
        
            if($_REQUEST['location_id']){
                $list_kardexes_by_location = $this->model_inventories->get_list_kardexes_by_location($_REQUEST['location_id']);
                
                echo json_encode($list_kardexes_by_location);
            }
        }
        ####################################################################
	public function add_support(){

	   $image = $_POST['image']; //image in string format
	   //$id_maintenance = $_POST['maintenance_id']; //image in string format
	 
	   //decode the image
	   $decodedImage = base64_decode($image);		    		 
	   //upload the image
	   $path_directory = ".".$this->config->item("uri_maintenances_files")."/".$_POST['location_id'];

	   echo "PATH=".$path_directory;


    	create_directory($path_directory);
    	   	

	   file_put_contents($path_directory."/".$_POST['name']."_".$_POST['location_id'].".jpg", $decodedImage);


	   /*
		$name = "PHOTO"; //$_POST['name']; //image name
	   $image = $_POST['image']; //image in string format
	 
	   //decode the image
	   $decodedImage = base64_decode($image);
	 
	   //upload the image
	   file_put_contents($name.".jpg", $decodedImage);
		*/
 	}
	####################################################################
	public function list_countries(){
		
		$list_countries['worldpopulation'][] = array(
																"rank"=>"1",
																"country"=>"Bolivia",
																"population"=>"20000",
																"flag"=>"RYG",
														 );
		$list_countries['worldpopulation'][] = array(
																"rank"=>"2",
																"country"=>"Argentina",
																"population"=>"50000",
																"flag"=>"LW",
														 );
		$list_countries['worldpopulation'][] = array(
																"rank"=>"3",
																"country"=>"Brasil",
																"population"=>"70000",
																"flag"=>"YG",
														 );


		
		echo json_encode($list_countries);
	}

	####################################################################
	public function list_locations(){
		$list_locations = array();
		$this->model_inventories->generate_list_locations_tree($list_locations);
		$view_data['list_locations'] = $list_locations;
		echo json_encode($view_data);
	}
	####################################################################
	public function maintenance_add(){
		if(isset($_REQUEST['maintenance_save'])){	

			$list_id_kardexes = array();
			if(isset($_REQUEST['list_id_kardexes'])){
				$list_id_kardexes = $_REQUEST['list_id_kardexes'];	
			}

			
			
			$maintenance_data['location_id'] = $_REQUEST['location_id'];
			$maintenance_data['maintenance_description'] = $_REQUEST['maintenance_description'];

			list($day, $month, $year) = explode("/",$_REQUEST['maintenance_register_date']);

			$maintenance_data['maintenance_register_date'] = $year."-".$month."-".$day;

			$id_maintenance = $this->model_maintenances->maintenance_add($maintenance_data);

			/*********************************************/			 
		    $image = $_POST['image']; //image in string format
		 
		    //decode the image
		    $decodedImage = base64_decode($image);		    		 
		    //upload the image


		   $path_directory = ".".$this->config->item("uri_maintenances_files")."/".$id_maintenance;
	    	create_directory($path_directory);

	    	
	    	$destination_file_name = 
	    	$source_file_name = $_POST['image'];

		    file_put_contents($path_directory."/".$image['name'].".jpg", $decodedImage);
		   /**************************************************/
		
			for($i = 0; $i<count($list_id_kardexes); $i++){


				
				$kardex_status_data['kardex_id'] = $list_id_kardexes[$i];				
				$kardex_status_data['maintenance_id'] = $id_maintenance;
				$kardex_status_data['kardex_status_value'] = $_REQUEST['kardex_status_value_'.$list_id_kardexes[$i]];
				$kardex_status_data['kardex_status_register_date'] =  $year."-".$month."-".$year;


				$kardex_status_data['location_id'] = $_REQUEST['location_id_'.$list_id_kardexes[$i]];

			   $this->model_inventories->kardex_status_add($kardex_status_data);				   
			}
		}
	}







	#############################################################################
   private function upload_object_file_batch($pre_data, $parent_type_object="comment", & $array_messages = null, $user_role)
   {
      $quantity_files = $_REQUEST['quantity_files'];
            
      if($quantity_files>0)
      {
         $path_directory = ".".$this->config->item("uri_".$parent_type_object."_files")."/".$pre_data['parent_id'];
                           
         create_directory($path_directory);
         #$view_labels = $this->lang->line('coco_pm_header_view_labels');
         
         $total_filesize = 0;
         
         for($i=1;$i<=$quantity_files;$i++)
         {
            $source_file_name = 'file_'.$i;
            $total_filesize += $_FILES['file_'.$i]['size'];             
            
            if(isset($_FILES['file_'.$i]['name']) AND strcasecmp($_FILES['file_'.$i]['name'],"")!=0)            
            {
               $total_filesize += $_FILES['file_'.$i]['size']; 
               
               if($total_filesize <= $this->template->max_total_send_filesize)
               {
                  $destination_file_name = $_FILES['file_'.$i]['name'];
                  $this->template->upload_file($path_directory, $destination_file_name, $source_file_name, $array_messages);
               }
               else
               {   
                  #$array_messages[] = $msg = $view_labels['msg_filesize_part1'].
                  #                    $total_filesize.$view_labels['msg_filesize_part2'].
                  #                    $this->template->max_total_send_filesize.
                  #                    $total_filesize.$view_labels['msg_filesize_part3'];
                  
                  
                  
               }
            }
         }
      }
   }      


	####################################################################
	public function kardex_code_search(){
		header('Access-Control-Allow-Origin: *');		
		if($this->model_inventories->is_kardex_code_exists($_REQUEST['term'])){
			echo "Ya existe el codigo, intenta con otro";
		}
	}
	
	####################################################################
	public function list_inventories_models(){
		header('Access-Control-Allow-Origin: *');

		$matches = array();
		if(isset($_REQUEST['term'])){			
			$matches = $this->array_values_recursive( $this->model_inventories->get_list_table_column_search("inventories", "inventory_model", $_REQUEST['term']) );
		}		
		echo json_encode($matches);
	}
	####################################################################
	public function list_inventories_marks(){
		header('Access-Control-Allow-Origin: *');

		$matches = array();
		if(isset($_REQUEST['term'])){			
			$matches = $this->array_values_recursive( $this->model_inventories->get_list_table_column_search("inventories", "inventory_mark", $_REQUEST['term']) );	
		}
		echo json_encode($matches);
	}

	####################################################################
	public function kardex_data(){		
		header('Access-Control-Allow-Origin: *');

		$matches = array();
		if(isset($_REQUEST['kardex_code'])){			

			$matches = $this->model_inventories->get_kardex("kardex_code", $_REQUEST['kardex_code']);
		}
		echo json_encode($matches);
	}
	####################################################################
	public function list_inventories_categories(){
		header('Access-Control-Allow-Origin: *');

		$matches = array();
		if(isset($_REQUEST['term'])){			
			$matches = $this->array_values_recursive( $this->model_inventories->get_list_table_column_search("inventories_categories", "inventory_category_name", $_REQUEST['term']) );
		}		
		echo json_encode($matches);
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
	
}
