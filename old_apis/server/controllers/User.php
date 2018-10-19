<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class User extends REST_Controller
{
  public function __construct()
  {
      parent::__construct();
      $this->load->model('User_model');
      $this->load->library('curl');  
      $this->user_id=$this->checkAuthKey();
      //echo $this->user_id;exit;
      $this->check_user($this->user_id);
  }  
  public function fetch_categories()
  {
     $categories=$this->User_model->fetch_categories();
     $this->json_response(array("status"=>"1","msg"=>"Category Listing Successful","data"=>$categories));
  }
  public function delete_categories()
  {
    $category=$this->input->post('categories');
    $ret=$this->User_model->delete_category($category,$this->user_id);
    if($ret)
    {
      $this->json_response(array("status"=>"1","msg"=>"Category is Successfully deleted")); 
    }
    else
    {
    	$this->json_response(array("status"=>"0","msg"=>"Authentication Error")); 
    }
  }
  public function delete_location()
  {
      $location=$this->input->post('location');
      $ret=$this->User_model->delete_location($location,$this->user_id);	
      if($ret)
      {
        $this->json_response(array("status"=>"1","msg"=>"Location is Successfully deleted")); 
      }
      else
      {
      	$this->json_response(array("status"=>"0","msg"=>"Authentication Error")); 
      }
  }
  public function insert_categories()
  {
      $categories=$this->input->post('categories');
      $ret=$this->User_model->insert_categories($categories,$this->user_id);
      if($ret)
      {
        $this->json_response(array("status"=>"1","msg"=>"Category Inserted Successful"));
      }
      else
      {
        $this->json_response(array("status"=>"1","msg"=>"Authentication Error")); 
      }
  }
  public function insert_locations($locations,$user_id)
  {
      $locations=$this->input->post('locations');
      $ret=$this->User_model->insert_locations($locations,$this->user_id);
      if($ret)
      {
      	$categories=$this->User_model->fetch_categories();
        $this->json_response(array("status"=>"1","msg"=>"Locations is Successfully Inserted","data"=>$categories)); 
      }
      else
      {
        $this->json_response(array("status"=>"1","msg"=>"Authentication Error")); 
      }	

  }    

}

?>