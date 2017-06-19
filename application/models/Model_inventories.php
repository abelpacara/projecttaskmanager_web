<?php
class Model_Inventories extends Model_Template
{ 
   function __construct(){
       parent::__construct();       
       $this->db->query("SET SESSION time_zone='-4:00'");
   }
   /**
   *get too last kardex status 
   */
   #######################################################   
   function get_list_kardexes_full($location_id="", $kardex_code="", $kardex_serial="", $kardex_status_value=""){
      $sql_where=" ";
      $sql_where_counter =0;

      
      //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
      if(isset($location_id) AND strcasecmp(trim($location_id),"")!=0){
        $sql_where_counter++;
        if($sql_where_counter>1){
          $sql_where .= " AND ";            
        }


         $list_tree = array();
        $this->generate_list_locations_tree($list_tree, $location_id);

        $string_locations_ids = "";
        for($i=0; $i<count($list_tree); $i++){
          $string_locations_ids .= $list_tree[$i]['id_location'].", ";

        }
        $string_locations_ids .= $location_id;

        $sql_where .= " id_location IN (".$string_locations_ids.") ";
      }

      //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
      if(isset($kardex_code) AND strcasecmp(trim($kardex_code),"")!=0){
        $sql_where_counter++;
        if($sql_where_counter>1){
          $sql_where .= " AND ";            
        }

        $sql_where .= " kardex_code LIKE '%".$kardex_code."%' ";
      }

      if(isset($kardex_serial) AND strcasecmp(trim($kardex_serial),"")!=0){
        $sql_where_counter++;
        if($sql_where_counter>1){
          $sql_where .= " AND ";            
        }

        $sql_where .= " kardex_serial LIKE '%".$kardex_serial."%' ";
      }

      if(isset($kardex_status_value) AND strcasecmp(trim($kardex_status_value),"")!=0){
        $sql_where_counter++;
        if($sql_where_counter>1){
          $sql_where .= " AND ";            
        }

        $sql_where .= " kardex_status_value='".$kardex_status_value."' ";
      }
      #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
      $sql_where_exists = "";
      if(strcasecmp(trim($sql_where),"")!=0){
        $sql_where_exists = " WHERE ".$sql_where;
      }

      $sql = "SELECT  *
              FROM (SELECT m1.*
                    FROM kardexes_status m1 LEFT JOIN kardexes_status m2
                     ON (m1.kardex_id = m2.kardex_id AND m1.id_kardex_status < m2.id_kardex_status)
                    WHERE m2.id_kardex_status IS NULL) AS kardexes_status_aux

              JOIN kardexes ON (id_kardex = kardexes_status_aux.kardex_id)
              JOIN inventories ON id_inventory = inventory_id
              JOIN locations ON id_location = location_id
              JOIN inventories_categories ON id_inventory_category = inventory_category_id
              ".$sql_where_exists."
              ORDER BY kardexes_status_aux.id_kardex_status DESC";


      $query = $this->db->query($sql);
      return $query->result_array();
   }
   
   #######################################################
   function inventory_category_add($data){
      $query = $this->db->insert('inventories_categories', $data);
      return $this->db->insert_id();      
   }
   #######################################################   
   function get_inventory_by($inventory_mark, $inventory_model){
      $this->db->select('*');      
      $this->db->from('inventories');
      $this->db->where('inventory_mark', $inventory_mark);
      $this->db->where('inventory_model', $inventory_model);

      $query = $this->db->get();
      return $query->row_array();
   }
   #######################################################   
   function get_inventory_category_by($inventory_category){
      $this->db->select('*');      
      $this->db->from('inventories_categories');
      $this->db->where('inventory_category_name', $inventory_category);

      $query = $this->db->get();
      return $query->row_array();
   }
   #######################################################   
   function is_kardex_code_exists($kardex_code_search){
      $this->db->select('*');      
      $this->db->from('kardexes');
      $this->db->where('kardex_code', $kardex_code_search);

      $query = $this->db->get();
      $row = $query->row_array();

      if(count($row)>0){
        return TRUE;
      }
      return FALSE;
   }
   #######################################################   
   function get_list_inventories_categories_by($term_search){

      $this->db->select('*');      
      $this->db->from('inventories_categories');
      $this->db->like('inventory_category_name', $term_search);

      $query = $this->db->get();
      return $query->result_array();
   }
   #######################################################   
   function get_list_inventories(){

      $this->db->select('*');      
      $this->db->from('inventories');
      $this->db->join('inventories_categories', 'id_inventory_category = inventory_category_id');      

      $query = $this->db->get();
      return $query->result_array();
   }
   #######################################################   
   function get_list_found_kardexes($kardex_code="", $kardex_serial="", $location_id){
 

      $this->db->select('*');
      $this->db->from('kardexes');
      $this->db->join('inventories', 'id_inventory = inventory_id');

      $this->db->join('inventories', 'id_inventory = inventory_id');

      $this->db->join('inventories_categories', 'id_inventory_category = inventory_category_id');      

      if(isset($kardex_code) AND strcasecmp($kardex_code, "")!=0){
        $this->db->like('kardex_code', $kardex_code);
      }

      if(isset($kardex_serial) AND strcasecmp($kardex_serial, "")!=0){
        $this->db->like('kardex_serial', $kardex_serial);
      }

      if(isset($kardex_serial) AND strcasecmp($kardex_serial, "")!=0){
        $this->db->where('location_id', $location_id);
      }

      $query = $this->db->get();

      return $query->result_array();

   }
   #######################################################   
   function get_kardex_status_by_id($kardex_status_id){
      $sql = "SELECT * FROM kardexes 
              LEFT JOIN (inventories_categories, inventories) 
              ON (id_inventory_category = inventory_category_id AND id_inventory=inventory_id)
              WHERE id_kardex='".$kardex_status_id."'";

      $query = $this->db->query($sql);
      return $query->row_array();
   }
   #######################################################   
   function get_list_kardexes(){
      $this->db->select('*');
      $this->db->from('kardexes');
      $this->db->join('inventories', 'id_inventory = inventory_id');
      $this->db->join('inventories_categories', 'id_inventory_category = inventory_category_id');      

      $query = $this->db->get();

      return $query->result_array();
   }
   #######################################################   
   function get_kardex_by_id($kardex_id){
      $sql = "SELECT * FROM kardexes 
              LEFT JOIN (inventories_categories, inventories) 
              ON (id_inventory_category = inventory_category_id AND id_inventory=inventory_id)
              WHERE id_kardex='".$kardex_id."'";

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
      $sql = "SELECT kardexes_status.*, locations.* FROM kardexes 
              LEFT JOIN (inventories_categories, inventories, kardexes_status, locations)  
              ON (id_inventory_category = inventory_category_id
                AND id_inventory = inventory_id
                AND id_kardex = kardex_id
                AND id_location = location_id)
              ORDER BY kardex_status_register_date DESC;";
      $query = $this->db->query($sql);
      return $query->result_array();
   }
   #######################################################
   function kardex_status_add($data){
      $query = $this->db->insert('kardexes_status', $data);
      return $this->db->insert_id();      
   }
   #######################################################
   function save_kardex($data, $kardex_id){
      $query = $this->db->update('kardexes', $data, "id_kardex=".$kardex_id);
      return $this->db->insert_id();      
   }
   #######################################################
   function kardex_add($data){
      $query = $this->db->insert('kardexes', $data);
      return $this->db->insert_id();      
   }
   #######################################################
   function inventory_add($data){
      $query = $this->db->insert('inventories', $data);
      return $this->db->insert_id();
   }
   #######################################################   
   function get_list_inventories_categories(){

      $this->db->select('*');            
      $this->db->from('inventories_categories');      

      $query = $this->db->get();
      return $query->result_array();
   }
   
}