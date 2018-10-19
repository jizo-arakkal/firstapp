<?php
class Register_model extends CI_Model
{
  public function generateAuthKey()
{
  $key=md5(uniqid());

  while($this->db->query("select user_id from Users where authkey='$key'")->num_rows()>0)
  {
   $key=md5(uniqid());
  }
  return $key;
 
}


public function do_facebook_login($facebook_user_id,$name,$email,$gender,$facebook_cover_pic,$age,$facebook_profile_dp,$ostype,$device_id,$device_model)
{
if($this->db->query("select user_id from Users where facebook_user_id='$facebook_user_id' and user_type='facebook' and device_id='$device_id' and device_model='$device_model'and ostype='$ostype'")->num_rows()>0)
{
$this->db->query("update Users set name='$name',email='$email',gender='$gender',facebook_cover_pic='$facebook_cover_pic',facebook_profile_dp='$facebook_profile_dp',age='$age'  where facebook_user_id='$facebook_user_id' and user_type='facebook' and device_id='$device_id' and device_model='$device_model' and ostype='$ostype'");
$authkey=$this->db->query("select authkey from Users where facebook_user_id='$facebook_user_id' and user_type='facebook' and device_id='$device_id' and device_model='$device_model'and ostype='$ostype'")->row()->authkey;
return $authkey;
}
else
{
  $authkey=$this->generateAuthKey();
  $insert_array=array();
  $insert_array['facebook_user_id']=$facebook_user_id;
  $insert_array['name']=$name;
  $insert_array['email']=$email;
  $insert_array['gender']=$gender;
  $insert_array['facebook_cover_pic']=$facebook_cover_pic;
  $insert_array['facebook_profile_dp']=$facebook_profile_dp;
  $insert_array['age']=$age;
   $insert_array['user_type']='facebook';
   $insert_array['date_of_registation']=date('Y-m-d H:i:s');
   $insert_array['authkey']=$authkey;
    $insert_array['ostype']=$ostype;
  $insert_array['device_id']=$device_id;
    $insert_array['device_model']=$device_model;
  $this->db->insert("Users",$insert_array);
  return $authkey;
}
}
public function do_google_login($google_user_id,$name,$email,$ostype,$device_id,$device_model)
{


if($this->db->query("select user_id from Users where google_user_id='$google_user_id' and user_type='google' and device_id='$device_id' and device_model='$device_model'and ostype='$ostype'")->num_rows()>0)
{
$this->db->query("update Users set name='$name',email='$email'  where google_user_id='$google_user_id' and user_type='google' and device_id='$device_id' and device_model='$device_model' and ostype='$ostype'");
$authkey=$this->db->query("select authkey from Users where google_user_id='$google_user_id' and user_type='google' and device_id='$device_id' and device_model='$device_model'and ostype='$ostype'")->row()->authkey;
return $authkey;
}
else
{
  $authkey=$this->generateAuthKey();
  $insert_array=array();
  $insert_array['google_user_id']=$google_user_id;
  $insert_array['name']=$name;
  $insert_array['email']=$email;
  $insert_array['ostype']=$ostype;
  $insert_array['device_id']=$device_id;
    $insert_array['device_model']=$device_model;
   $insert_array['user_type']='google';
   $insert_array['date_of_registation']=date('Y-m-d H:i:s');
   $insert_array['authkey']=$authkey;
  $this->db->insert("Users",$insert_array);
  return $authkey;
}

}
public function otp_verification($ostype,$device_id,$device_model,$mobile,$otp,$country_code)
{
  $res=$this->db->query("select * from Users where mobile='$mobile'  and device_id='$device_id' and device_model='$device_model' and ostype='$ostype' and  otp='$otp' and otp_verify='0' and country_code='$country_code'")->num_rows();
 
  if($res>0)
  {
    $auth=$this->db->query("select authkey from Users where mobile='$mobile'  and device_id='$device_id' and device_model='$device_model' and ostype='$ostype' and  otp='$otp' and otp_verify='0'")->row()->authkey;
  $this->db->query("update Users set otp='' , otp_verify='1'  where mobile='$mobile'  and device_id='$device_id' and device_model='$device_model' and ostype='$ostype' and  otp='$otp' and otp_verify='0'");

  return $auth;
  }
  else
  {
    return false;
  }
}
public function mobile_auth_check($ostype,$device_id,$device_model,$mobile,$country_code,$current_authkey)
{

if($this->db->query("select * from Users where mobile='$mobile'  and otp_verify='1' and country_code='$country_code' and device_id='$device_id' and device_model='$device_model' and ostype='$ostype'")->num_rows()>0)
    {

$authkey_=$this->db->query("select authkey from Users where mobile='$mobile'  and otp_verify='1' and country_code='$country_code' and device_id='$device_id' and device_model='$device_model' and ostype='$ostype'")->row()->authkey;

if($authkey_!=$current_authkey)
{

return 'autherror';
}
    }
}
  public function register_by_mobile($ostype,$device_id,$device_model,$mobile,$otp,$country_code,$current_authkey)
  {
    $ret=$this->mobile_auth_check($ostype,$device_id,$device_model,$mobile,$country_code,$current_authkey);
    if($ret=='autherror')
    {
return $ret;
    }
    if($this->db->query("select * from Users where mobile='$mobile'  and otp_verify='1' and country_code='$country_code'")->num_rows()>0)
      {
 if($this->db->query("select * from Users where mobile='$mobile'  and otp_verify='1' and country_code='$country_code' and device_id='$device_id' and device_model='$device_model' and ostype='$ostype'")->num_rows()<=0)
 {

return 'failed';
 }
      }
    $res=$this->db->query("select * from Users where mobile='$mobile'  and email_verify='1' and   email!=''")->num_rows();
    $res_=$this->db->query("select * from Users where mobile='$mobile'  and otp_verify='1' and country_code='$country_code'")->num_rows();
    if($res>0 || $res_>0)
    {
      
return 'exists';
    }
    else
    {
      $insert_array=array();
      $insert_array['mobile']=$mobile;
      $insert_array['ostype']=$ostype;
      $insert_array['device_id']=$device_id;
      $insert_array['device_model']=$device_model;
      $insert_array['otp']=$otp;
      $insert_array['otp_verify']='0';
      $insert_array['date_of_registation']=date('Y-d-m H:i:s');
      $insert_array['blocked_by_admin']='0';
      $insert_array['country_code']=$country_code;
      $this->db->insert("Users",$insert_array);
      $id=$this->db->insert_id();
     
      if($id>0)
      {
$res=$this->db->query("delete from Users where ((mobile='$mobile'  and email_verify='0' and email!='') or (mobile='$mobile'  and otp_verify='0' and country_code='$country_code')) and user_id!='$id'");
   return $id;
      }
      else
      {
        return 'failed';
      }
    }
  }
  public function  get_key($email,$password)
  {
    return $this->db->query("select * from Users where (email='$email') and password='$password' and email_verify='1'")->row()->authkey;
  }
	public function do_login($username,$password,$ostype,$device_id,$device_model)
	{
//echo "select * from Users where (email='$username') and password='$password' and email_verify='0'";exit;
    $res_=$this->db->query("select * from Users where (email='$username') and password='$password' and email_verify='0' and device_id='$device_id' and device_model='$device_model'and ostype='$ostype'")->num_rows();
    if($res_>0)
    {
return 'link';
    }
		$res=$this->db->query("select * from Users where (email='$username') and password='$password' and email_verify='1' and device_id='$device_id' and device_model='$device_model'and ostype='$ostype'")->num_rows();
if($res>0)
{
return 'link1';
}
else
{
return 'link2';
}
	}
	public function verify_registration_link($key,$id)
	{
		if($this->db->query("select user_id from Users where email_verification_code='$key' and user_id='$id'")->num_rows()>0)
		{
			$email=$this->db->query("select email from Users where email_verification_code='$key' and user_id='$id'")->row()->email;

$this->db->query("update Users set email_verification_code='',email_verify='1' where user_id='$id' and email_verification_code='$key'");
$this->db->query("delete from  Users  where email='$email' and email_verify='0' and email_verification_code!=''");
return true;
		}
		return false;
	}
	public function check_existing_users($email,$username)
	{
		 $result_e=$this->db->query("select user_id from Users where email='$email' and  email_verify='1'")->num_rows();
     $result_u=$this->db->query("select user_id from Users where username='$username' and  email_verify='1'")->num_rows();
if($result_u>0)
{
return 'username';
}
if($result_e>0)
{
return 'email';
}
	}
   public function do_register($email,$username,$device_id,$device_model,$password,$ostype,$key)
   {
   	$insert_array=array();
   	$insert_array['username']=$username;
   	$insert_array['email']=$email;
   	
   	$insert_array['password']=$password;
   	$insert_array['ostype']=$ostype;
    $insert_array['device_model']=$device_model;
    $insert_array['device_id']=$device_id;

   	$insert_array['email_verify']='0';
   
   	$insert_array['otp_verify']='0';
   	$insert_array['email_verification_code']=$key;
   		
   			$insert_array['blocked_by_admin']='0';
    $insert_array['date_of_registation']=date('Y-d-m H:i:s');

   
    $this->db->insert("Users",$insert_array);
    $ret=$this->db->insert_id();
    if($ret>0)
    {
    $this->db->query("delete from Users where email='$email' and email_verify='0' and user_id!='$ret'");
    $this->db->query("delete from Users where username='$username' and email_verify='0' and user_id!='$ret'");
    }
   
    return $ret;
   }
}
?>