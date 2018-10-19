<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Config;
use Response;
class RestController extends Controller
{    
    public function __construct(){
        $this->register_api_token = config('constants.registration.api_token');
        $this->sts_103 = config('constants.response_codes.103');
    	$this->sts_104 = config('constants.response_codes.104');
    	$this->sts_105 = config('constants.response_codes.105');
    	$this->sts_106 = config('constants.response_codes.106');
    	$this->sts_107 = config('constants.response_codes.107');
    	$this->sts_108 = config('constants.response_codes.108');
    	$this->sts_109 = config('constants.response_codes.109');
        $this->sts_401 = config('constants.response_codes.401');

        //Table names
        $this->tbl_users = config('constants.table.users');
        $this->tbl_user_details = config('constants.table.user_details');
        $this->tbl_categories = config('constants.table.categories');
        $this->tbl_config_values = config('constants.table.config_values');
        $this->tbl_broadcasts = config('constants.table.broadcasts');
        $this->tbl_swaps = config('constants.table.swaps');
        $this->tbl_localvocals = config('constants.table.localvocals'); 
        $this->tbl_swaps_report = config('constants.table.swaps_report');
        $this->tbl_lv_like_share = config('constants.table.lv_like_share');
        $this->tbl_lv_comments = config('constants.table.lv_comments');  
        $this->tbl_user_notifications = config('constants.table.user_notifications');  
    }

    public function test_api_data($txt)
    {
    	$myfile = fopen("test.txt", "w");
    	//print_r($myfile);    	
    	fwrite($myfile, $txt);
    	fclose($myfile);
    }
    public function get_unique_userid()
	{
		$userid  = chr(rand(65,90)).chr(rand(65,90));		
		$userid .= date('yzhis');
		$userid .= rand(00,99);		
		$userid  .= chr(rand(65,90)).chr(rand(65,90));
		return $userid;
	}
	
	public function get_unique_bcid()
	{				
		$broadcastid = 'BC'.date('yzhis');
		$broadcastid .= rand(00,99);	
		$result = DB::table($this->tbl_broadcasts)->where('broadcast_id',$broadcastid)->first();
		if(!empty($result)) $this->get_unique_bcid();	
		return 	$broadcastid;
	}

	public function get_unique_swapid()
	{				
		$swapid = 'SW'.date('yzhis');
		$swapid .= rand(00,99);	
		$result = DB::table($this->tbl_swaps)->where('swap_id',$swapid)->first();
		if(!empty($result)) $this->get_unique_swapid();	
		return $swapid;
	}

	public function get_unique_lvid()
	{				
		$lvid = 'LV'.date('yzhis');
		$lvid .= rand(00,99);	
		$result = DB::table($this->tbl_localvocals)->where('lv_id',$lvid)->first();
		if(!empty($result)) $this->get_unique_lvid();	
		return $lvid;
	}

	public function get_otp()
	{			
		return rand(1111,9999);
	}

	public function get_unique_token()
	{
		$token = chr(rand(65,90)).md5(uniqid(rand(), true)).chr(rand(65,90));
		$result = DB::table($this->tbl_users)->where('api_token',$token)->first();
		if(!empty($result)) $this->get_unique_token();		
		return strtoupper($token);
	}

	public function is_unique($table,$field,$value)
	{
		$result = DB::table($table)->where($field, $value)->first();		
		return (!empty($result))?0:1;
	}

	public function insert_values($table,$values)
	{
		return DB::table($table)->insert($values);		
	}

	public function select_row($table,$where,$fields)
	{
		return DB::table($table)->select($fields)->where($where)->first();	
	}

	public function select_by_where($table,$where,$fields)
	{
		return DB::table($table)->select($fields)->where($where)->get();	
	}
	public function select_by_wherein($table,$fields,$where_field,$where_values)
	{
		return DB::table($table)->select($fields)->whereIn($where_field,$where_values)->get();	
	}

	public function get_categories()
	{		
		$categories_details = DB::table($this->tbl_categories)->select('id','category_title','category_description','bg_image','logo_image')->where(array('status'=>1))->get();
		$categories = array();
		$path = url('/public/images/category/');	
		foreach ($categories_details as $value)
    	{
    		$categories[] = array(
    			'id'=> $value->id,
    			'category_title' => $value->category_title,
    			'category_description' => $value->category_description,
    			'bg_image' => $path.'/'.$value->bg_image,
    			'logo_image' => $path.'/'.$value->logo_image 
    		);	
    	}
    	return $categories;
	}

	public function update_values($table,$where,$values)
	{
		//DB::enableQueryLog();
		$status = DB::table($table)->where($where)->update($values);		
		//print_r(DB::getQueryLog());
		return ($status>=0)?1:0;			
	}

	public function get_aws_baseurl()
	{
		$response = '';
		$sms_details = DB::table('config_values')->where('key_term','aws_baseurl')->first();
      	$response = $sms_details->value;      	
      	return $response;
	}

	public function get_sms_credentials()
	{
		$response = array();
		$sms_details = DB::table('config_values')->where('key_term','sms_username')->first();
      	$response['username'] = $sms_details->value;
      	$sms_details = DB::table('config_values')->where('key_term','sms_password')->first();
      	$response['password'] = $sms_details->value;
      	return $response;
	}
	
	function send_sms($country_code,$mobile,$msg)
	{
	  
		$credentials = $this->get_sms_credentials();
		$msg_api_username=$credentials['username'];
		$msg_api_pwd=$credentials['password'];
		$mobile=$country_code.$mobile;		
		$msg=urlencode($msg);
		//$var="?user=".$msg_api_username."&password=".$msg_api_pwd."&senderid=WANHLP&channel=TRANS&DCS=0&flashsms=0&number=".$mobile."&text=".$msg."&route=8";
		$var="?username=".$msg_api_username."&password=".$msg_api_pwd."&senderid=SWAPNR&channel=TRANS&DCS=0&flashsms=0&number=".$mobile."&message=".$msg."&route=1";
		
	 //  $url="http://mysmsshop.in/http-api.php?username=eorb10064&password=orb@1006#&senderid=WANHEL&route=1&number=918870729280&message=hello there";
		

		//return $var;
		//$url="http://websms.mysmsshop.com/api/mt/SendSMS".$var;
		$url="http://mysmsshop.in/http-api.php".$var;
		$ch=curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		$response = curl_exec($ch);
		$response_array =  json_decode($response);	
	//return $response;
		curl_close ($ch);
	//	if(isset($response_array->ErrorCode) && $response_array->ErrorCode=='000')		
			return true;		
	//	else	
		//	return false;		
	}



}
