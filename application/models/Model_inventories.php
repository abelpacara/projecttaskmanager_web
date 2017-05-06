<?php
class Model_Inventories extends Model_Template
{ 
   function __construct(){
       parent::__construct();       
       $this->db->query("SET SESSION time_zone='-4:00'");
   }
   #######################################################   
   function get_list_kardexes_full(){
      $this->db->select('*');
      $this->db->from('kardexes');
      $this->db->join('inventories', 'id_inventory = inventory_id');
      $this->db->join('kardexes_status', 'id_kardex = kardex_id');      
      $this->db->join('inventories_categories', 'id_inventory_category = inventory_category_id');      
      $this->db->join('locations', 'id_location = location_id');      
      $this->db->group_by('id_kardex'); 

      $query = $this->db->get();

      echo "<br>".$this->db->last_query();

      return $query->result_array();
   }
   ###############################################################
   function generate_list_locations_tree(&$list_tree, $parent_id=null, $level=0)
   {
      $this->db->select("*");        
      $this->db->from("locations");     
      $this->db->where("parent_id", $parent_id);                  
      $query = $this->db->get();
      
      $list_result = $query->result_array();
            
      if(count($list_result)>0)
      {
         for($i=0;$i<count($list_result);$i++)
         {
            $row = $list_result[$i];
            $row['level']=$level;
            $list_tree[] = $row;

            $this->generate_list_locations_tree($list_tree, $list_result[$i]['id_location'], $level+1);
         }
      }
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
   function get_list_inventories(){

      $this->db->select('*');      
      $this->db->from('inventories');
      $this->db->join('inventories_categories', 'id_inventory_category = inventory_category_id');      

      $query = $this->db->get();
      return $query->result_array();
   }
   #######################################################   
   function get_list_found_kardexes($kardex_code="", $kardex_serial=""){
 

      $this->db->select('*');
      $this->db->from('kardexes');
      $this->db->join('inventories', 'id_inventory = inventory_id');
      $this->db->join('inventories_categories', 'id_inventory_category = inventory_category_id');      

      if(isset($kardex_code) AND strcasecmp($kardex_code, "")!=0){
        $this->db->like('kardex_code', $kardex_code);
      }

      if(isset($kardex_serial) AND strcasecmp($kardex_serial, "")!=0){
        $this->db->like('kardex_serial', $kardex_serial);
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
   
   #######################################################
   function get_list_locations(){
      $sql = "SELECT * FROM locations;";
      $query = $this->db->query($sql);
      return $query->result_array();
   }   
}