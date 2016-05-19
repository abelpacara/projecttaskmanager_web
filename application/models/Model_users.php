<?php
class Model_Users extends Model_Template
{ 
   function __construct()
   {
       parent::__construct();       
       $this->db->query("SET SESSION time_zone='-4:00'");
   }
  ##########################################################
  function get_id_user($email, $password){
      $query = $this->db->query("SELECT users.id_user FROM users
        WHERE user_email='".$email."' AND user_password='".$password."';");

      if ($query->num_rows() > 0){

          $row = $query->row(); 
          return $row->id_user;
      }    
      return NULL;
   }
   ##########################################################
   function add_user($data){
   	//$this->db->set("post_register_date","NOW()",FALSE);
   	
    $this->db->insert("users",$data);
    return $this->db->insert_id();
   }
}