<?php
class Model_Posts extends Model_Template
{ 
   function __construct()
   {
       parent::__construct();       
       $this->db->query("SET SESSION time_zone='-4:00'");
   }
   function add_post($data){
   	$this->db->set("post_register_date","NOW()",FALSE);
   	
      $this->db->insert("posts",$data);
      return $this->db->insert_id();
   }

   function get_list_posts(){

   	$query = $this->db->query("SELECT * FROM posts;");         
      return $query->result_array();
   }
}