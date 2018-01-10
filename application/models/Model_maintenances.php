<?php
class Model_Maintenances extends Model_Template
{ 
   function __construct(){
       parent::__construct();       
       $this->db->query("SET SESSION time_zone='-4:00'");
   }
   #######################################################   
   function get_list_maintenances($location_id=null, $maintenance_start_register_date="", $maintenance_end_register_date="", $level=0){

      //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
      if(isset($location_id) AND strcasecmp($location_id, "")!=0){
        $list_tree = array();
        $this->generate_list_locations_tree($list_tree, $location_id);

        $locations_ids = array();
        for($i=0; $i<count($list_tree); $i++){
          $locations_ids[] = $list_tree[$i]['id_location'];
        }
        $locations_ids[] = $location_id;
      }


      $this->db->trans_start();
      $this->db->select('*');
      $this->db->from('maintenances');
      $this->db->join('locations', "id_location=location_id");
      
      if(isset($maintenance_start_register_date) AND strcasecmp($maintenance_start_register_date, "")!=0
      AND isset($maintenance_end_register_date) AND strcasecmp($maintenance_end_register_date, "")!=0){

        $this->db->where("maintenance_register_date BETWEEN '".$maintenance_start_register_date."' AND '".$maintenance_end_register_date."'");
      }
            
      if(isset($location_id) AND strcasecmp($location_id, "")!=0){
            $this->db->where_in('location_id',$locations_ids);
      }
      //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%      
      $this->db->order_by('maintenance_register_date', "DESC");
      $query = $this->db->get();      

      $list_result = $query->result_array();
      $this->db->trans_complete();

      return $list_result;

      
   }
   #######################################################   
   function get_list_kardexes_by($maintenance_id){
      $this->db->select('*');            
      $this->db->from('kardexes_status');
      $this->db->join('maintenances', "id_maintenance=maintenance_id");
      $this->db->join('kardexes', "id_kardex=kardex_id");
      $this->db->join('locations', "id_location=kardexes_status.location_id");
      $this->db->join('inventories', "id_inventory=inventory_id");
      $this->db->join('inventories_categories', "id_inventory_category=inventory_category_id");      
      $this->db->where('maintenance_id', $maintenance_id);      

      
      $query = $this->db->get();
      return $query->result_array();
   }   
   #######################################################   
   function maintenance_add($data){
      $query = $this->db->insert('maintenances', $data);
      return $this->db->insert_id();
   }  
}