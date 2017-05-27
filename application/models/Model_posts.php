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

<<<<<<< HEAD
   function get_list_activities($user_id){

      $sql_user = "";


      $query = $this->db->query("SELECT * FROM
            (
            (SELECT posts.*, 
                projects.post_content AS project_content,
                forums.post_content AS forum_content  
         FROM posts 
               JOIN posts AS projects ON projects.id_post=posts.project_id
               JOIN posts AS forums ON forums.id_post=posts.forum_id   
               WHERE (posts.post_type='comment' OR  posts.post_type='forum')
                AND posts.user_id='".$user_id."'
                AND projects.user_id='".$user_id."'
                AND forums.user_id='".$user_id."'

               ORDER BY posts.post_date DESC, posts.post_register_date DESC)
         UNION
         (
             SELECT posts.*,                    
                   projects.post_content AS project_content,
                   NULL AS forum_content  
                                 FROM posts 
      JOIN posts AS projects ON projects.id_post=posts.project_id      
      WHERE posts.post_type='forum'
        AND posts.user_id='".$user_id."'
        AND projects.user_id='".$user_id."'                           

      ORDER BY posts.post_date DESC, posts.post_register_date DESC)) AS tablex
      ORDER BY tablex.id_post DESC");         
      return $query->result_array();
   }
=======
   function get_list_projects(){

    $query = $this->db->query("SELECT * FROM posts WHERE post_type='project';");         
      return $query->result_array();
   }
   function get_list_discussions(){

    $query = $this->db->query("SELECT * FROM posts WHERE post_type='discussion';");         
      return $query->result_array();
   }

   function get_list_posts(){
>>>>>>> origin/feature/INVENTARIOS

   function get_list_projects($user_id){
      $query = $this->db->query("SELECT * FROM posts 
      WHERE post_type='project' AND user_id='".$user_id."'
      ORDER BY post_date DESC, post_register_date DESC;");         
      return $query->result_array();
   }

   function get_list_forums($user_id){
      $query = $this->db->query("SELECT forums.id_post AS id_forum, projects.id_post AS id_project, forums.post_title AS forum_title, projects.post_title AS project_title 
      FROM posts forums
      JOIN  posts projects ON forums.parent_id = projects.id_post
      WHERE forums.post_type='forum'  AND projects.user_id='".$user_id."'
      ORDER BY forums.parent_id");         
      return $query->result_array();
   }

   function get_list_posts(){
      $query = $this->db->query("SELECT * FROM posts       
      ORDER BY post_date DESC, post_register_date DESC;");         
      return $query->result_array();
   }
}