<?php
class Model_Inventories extends Model_Template
{ 
   function __construct(){
       parent::__construct();       
       $this->db->query("SET SESSION time_zone='-4:00'");
   }
   #######################################################   
   function get_list_found_kardexes($kardex_code="", $kardex_serial=""){

      $sql_search ="";
      if(isset($kardex_code) AND strcasecmp($kardex_code, "")!=0){
        $sql_search = " kardex_code ='".$kardex_code."' ";
      }
      $sql_search ="";
      if(strcasecmp($sql_search, "")!=0){
        $sql_search .= " AND ";
      }

      if(isset($kardex_serial) AND strcasecmp($kardex_serial, "")!=0){
        $sql_search .= " kardex_serial ='".$kardex_serial."' ";
      }

      if(strcasecmp($sql_search, "")!=0){
        $sql_search = " WHERE  ".$sql_search;
      }


      $sql = "SELECT * FROM kardexes 
              LEFT JOIN (inventories_categories, inventories) 
              ON (id_inventory_category = inventory_category_id AND id_inventory=inventory_id)
              ".$sql_search;

      $query = $this->db->query($sql);
      return $query->result_array();
   }
   #######################################################   
   function get_kardex_status_by_id($kardex_status_id){
      $sql = "SELECT * FROM kardexes 
              LEFT JOIN (inventories_categories, inventories) 
              ON (id_inventory_category = inventory_category_id AND id_inventory=inventory_id)
              WHERE id_kardex='".$kardex_status_id."'";

      echo $sql;
      $query = $this->db->query($sql);
      return $query->row_array();
   }
   #######################################################   
   function get_kardex_by_id($kardex_id){
      $sql = "SELECT * FROM kardexes 
              LEFT JOIN (inventories_categories, inventories) 
              ON (id_inventory_category = inventory_category_id AND id_inventory=inventory_id)
              WHERE id_kardex='".$kardex_id."'";

      echo $sql;
      $query = $this->db->query($sql);
      return $query->row_array();
   }
   #######################################################   
   function get_kardex($column_name, $search_value){
      $sql = "SELECT * FROM kardexes WHERE ".$column_name."='".$search_value."';";
      $query = $this->db->query($sql);
      return $query->row_array();
   }
   #######################################################
   function get_list_kardexes_code($search_value){
      return $this->get_list_table_column_search("kardexes", "kardex_code", $search_value);
   }
   
   #######################################################
   function get_list_kardexes_status(){
      $sql = "SELECT * FROM kardexes 
              LEFT JOIN (inventories_categories, inventories, kardexes_status, locations)  
              ON (id_inventory_category = inventory_category_id
                AND id_inventory = inventory_id
                AND id_kardex = kardex_id
                AND id_location = location_id);";
      $query = $this->db->query($sql);
      return $query->result_array();
   }
   #######################################################
   function add_kardex_status($data){
      $query = $this->db->insert('kardexes_status', $data);
      return $this->db->insert_id();
      
   }
   #######################################################
   function add_kardex($data){
      $query = $this->db->insert('kardexes', $data);
      return $this->db->insert_id();      
   }
   #######################################################
   function add_inventory($data){
      $query = $this->db->insert('inventories', $data);
      return $this->db->insert_id();
   }
   #######################################################
   function get_list_locations(){
      $sql = "SELECT * FROM locations;";
      $query = $this->db->query($sql);
      return $query->result_array();
   }   
}