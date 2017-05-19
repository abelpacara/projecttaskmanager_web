<?php
class Model_Maintenances extends Model_Template
{ 
   function __construct(){
       parent::__construct();       
       $this->db->query("SET SESSION time_zone='-4:00'");
   }
   #######################################################   
   function get_list_maintenances($location_id=""){

      $this->db->select('*');            
      $this->db->from('maintenances');
      $this->db->join('locations', "id_location=location_id");
      if(isset($location_id) AND strcasecmp($location_id, "")!=0){
        $this->db->where('location_id', $location_id);  
      }

      $query = $this->db->get();

      return $query->result_array();
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