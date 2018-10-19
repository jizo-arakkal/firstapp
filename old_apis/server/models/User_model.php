<?php
class User_model extends CI_Model
{
 public function delete_category($category,$user_id)
{
if($this->db->query("select user_id from Users where user_id='$user_id'")->num_rows()<=0)
    {
return false;
    }

    $categories_=explode(',',$category);
   
    foreach($categories_ as $cat)
    {
if($cat!='')
{


$this->db->query("delete from User_categories where user_id='$user_id' and category_id='$cat'");	


}
    }
    
    return true;

}

 public function delete_location($location,$user_id)
{
	if($this->db->query("select user_id from Users where user_id='$user_id'")->num_rows()<=0)
    {
return false;
    }
    $locations_=explode('-',$location);
    foreach($locations_ as $loc)
    {
if($loc!='')
{


$this->db->query("delete from User_locations where user_id='$user_id' and location='$loc'");	


}
    }
    
    return true;

}
	public function fetch_categories()
	{
		$res= $this->db->query("select * from categories where blocked_by_admin='0'")->result_array();
		$arr=array();
		foreach($res as $key=>$rs)
		{
          $rs['image_path']=base_url().'assets/category_images/';
          $arr[$key]=$rs;
		}
		return $arr;
	}

	public function insert_categories($categories,$user_id)
	{
    if($this->db->query("select user_id from Users where user_id='$user_id'")->num_rows()<=0)
    {
return false;
    }
    $categories_=explode(',',$categories);
    foreach($categories_ as $cat)
    {
if($cat!='')
{

if($this->db->query("select id from User_categories where user_id='$user_id' and category_id='$cat'")->num_rows()>0)
{

}
else
{
$insert=array();
$insert['user_id']=$user_id;
$insert['category_id']=$cat;
$this->db->insert('User_categories',$insert);	
}

}
    }
    
    return true;
	}

		public function insert_locations($locations,$user_id)
	{
    if($this->db->query("select user_id from Users where user_id='$user_id'")->num_rows()<=0)
    {
return false;
    }
    $locations_=explode('-',$locations);
    foreach($locations_ as $loc)
    {
if($loc!='')
{

if($this->db->query("select id from User_locations where user_id='$user_id' and location='$loc'")->num_rows()>0)
{

}
else
{
$insert=array();
$insert['user_id']=$user_id;
$insert['location']=$loc;
$this->db->insert('User_locations',$insert);	
}

}
    }
    
    return true;
	}
}
?>