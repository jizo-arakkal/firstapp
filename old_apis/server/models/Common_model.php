<?php
class Common_model extends CI_Model
{
	public function get_email_config()
	{
		return $this->db->query("select * from email_config")->result_array();
	}
	public function get_sms_credintials()
	{
		$res=$this->db->query("select * from sms_credintials")->row();
		return $res;
	}
	public  function checkAuthKey($authKey,$mobile,$email)
	 {
	 	if($mobile!='')
	 	{
	 		$res=$this->db->query("select user_id from Users where authkey='$authKey' and mobile='$mobile'")->result_array();
if(count($res)>0)
{
	$rr=$this->db->query("select user_id from Users where authkey='$authKey' and mobile='$mobile'")->row()->user_id;
return $rr;
}
else
{
return false;	
}
	 	}
	 	else if($email!='')
	 	{
	 		$res=$this->db->query("select user_id from Users where authkey='$authKey' and email='$email'")->result_array();
if(count($res)>0)
{
	$rr=$this->db->query("select user_id from Users where authkey='$authKey' and email='$email'")->row()->user_id;
return $rr;
}
else
{
return false;	
}
	 	}
	 	else
	 	{
	 		return false;
	 	}


}

public function generateAuthKey($ret='')
{
	$key=md5(uniqid());

	while($this->db->query("select user_id from Users where authkey='$key'")->num_rows()>0)
	{
   $key=md5(uniqid());
	}
	if($ret=='')
	{

	}
	else
	{
		$this->db->query("update Users set authkey='$key' where user_id='$ret'");

	}
}
}
?>