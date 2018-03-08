<?php
class Model_locations extends Model_Template
{ 
   function __construct(){
       parent::__construct();       
       $this->db->query("SET SESSION time_zone='-4:00'");
   }
   #######################################################
   function get_office($office_id=""){   
   	if(isset($office_id)){
   		$sql = "SELECT * FROM `offices` WHERE id_office='".$office_id."';";
	      $query = $this->db->query($sql);
	      return $query->row_array();	
   	}
      return null;
   }

   #######################################################
   function location_add($data){   
      $query = $this->db->insert('locations', $data);
      return $this->db->insert_id();
   }
   #######################################################
   function get_list_offices(){   
      $sql = "SELECT * FROM `offices`;";
      $query = $this->db->query($sql);
      return $query->result_array();
   }
   #######################################################
   function office_add($data){   
      $query = $this->db->insert('offices', $data);
      return $this->db->insert_id();
   }
}