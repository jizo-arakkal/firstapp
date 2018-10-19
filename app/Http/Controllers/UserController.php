<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\RestController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use config;
use Response;
use App\Http\Models\User;
use App\Http\Models\UserDetail;
use App\Http\Models\Chat;
use App\Http\Models\Broadcast;
use App\Http\Models\Swap;
class UserController extends Controller
{   
    public function __construct()
    {
    	$this->rest = new RestController();
    	$this->Smail = new MailController();
    	$this->user = new User();    	
    	$this->s3 = new S3Controller();
    }
    
    public function register_email(Request $request)
    { 
    	$api_token = $request->header('apitoken');      
    	if($api_token!=$this->rest->register_api_token)
    	{
    		return response()->json(array('status'=>103,'message'=>$this->rest->sts_103));
    	}
		$email=$request->input('email');
		$username=$request->input('username'); 
		$password=$request->input('password');
		$os_type=$request->input('os_type');
		$device_id=$request->input('device_id');
		$device_modal=$request->input('device_modal');

		if(empty($email) || empty($username) || empty($password) || empty($os_type) || empty($device_id) || empty($device_modal) || $email=='NA' || $username=='NA' || $password=='NA' || $os_type=='NA' || $device_id=='NA' || $device_modal=='NA')
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
		else
		{
			if($this->rest->is_unique($this->rest->tbl_users,'email',$email)==0)
			{
				return response()->json(array('status'=>105,'message'=>$email.' '.$this->rest->sts_105));
			}
			else
			{
				$email_verification_code = str_random(8);				
				$values = array(
					'user_id'=> $this->rest->get_unique_userid(),
					'email' => $email,
					'username' => $username,
					'password' => $password,
					'os_type' => $os_type,
					'device_id' => $device_id,
					'device_modal' => $device_modal,
					'email_verification_code' => $email_verification_code, 
					'api_token' => $this->rest->get_unique_token(),
					'register_via' => 'EMAIL'
				);
				if($this->rest->insert_values($this->rest->tbl_users,$values))
				{
					$data['name']='';
			    	$data['email']=$email; 
			    	$data['email_token']=$email_verification_code;
					if($this->Smail->sendCustomMail($data))
					{
						return response()->json(array('status'=>200,'message'=>'Success, Kindly verify the email'));
					}
					else
						return response()->json(array('status'=>200,'message'=>'Success, But Verification email is not able to sent.'));
				}
				else
				{
					return response()->json(array('status'=>200,'message'=>'Error, Try later'));
				}
			}
		}
    }

    public function register_mobile(Request $request)
    { 
    	$api_token = $request->header('apitoken');      
    	if($api_token!=$this->rest->register_api_token)
    	{
    		return response()->json(array('status'=>103,'message'=>$this->rest->sts_103));
    	}

		$mobile=$request->input('mobile');
		$country_code=$request->input('country_code'); 		
		$os_type=$request->input('os_type');
		$device_id=$request->input('device_id');
		$device_modal=$request->input('device_modal');

		if(empty($mobile) || empty($country_code) || empty($os_type) || empty($device_id) || empty($device_modal) || $mobile=='NA' || $country_code=='NA' || $os_type=='NA' || $device_id=='NA' || $device_modal=='NA')
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
		else
		{
			if($this->rest->is_unique($this->rest->tbl_users,'mobile',$mobile)==0)
			{
				$otp = $this->rest->get_otp();
				$where =  array('mobile'=>$mobile);
				$values =  array(
					'country_code' => $country_code,									
					'os_type' => $os_type,
					'device_id' => $device_id,
					'device_modal' => $device_modal,
					'otp' => $otp,
					'otp_verify' => 0
				);
				$api_token = $this->user->update_user_get_token($where,$values);
				if($api_token!=false)
				{
					$msg = 'Thanks for registering with WannaHelp. Your OTP is '.$otp;
					if($this->rest->send_sms($country_code,$mobile,$msg))
					{
						return response()->json(array('status'=>200,'message'=>'Success, Kindly verify the otp'));
					}
					else
					{
						return response()->json(array('status'=>200,'message'=>'Success, But OTP is not able to sent.'));	
					}
				}
				else
				{
					return response()->json(array('status'=>106,'message'=>$this->rest->sts_106));
				}
				return response()->json(array('status'=>105,'message'=>$mobile.' '.$this->rest->sts_105));
			}			
			else
			{
				$otp = $this->rest->get_otp();
				$values = array(
					'user_id'=> $this->rest->get_unique_userid(),
					'mobile' => $mobile,
					'country_code' => $country_code,
					'os_type' => $os_type,					
					'otp' => $otp,
					'otp_verify' => 0,
					'device_id' => $device_id,
					'device_modal' => $device_modal,
					'api_token' => $this->rest->get_unique_token(),
					'register_via' => 'MOBILE'
				);
				if($this->rest->insert_values($this->rest->tbl_users,$values))
				{
					$msg = 'Thanks for registering with WannaHelp. Your OTP is '.$otp;
					if($this->rest->send_sms($country_code,$mobile,$msg))
					{
						return response()->json(array('status'=>200,'message'=>'Success, Kindly verify the otp'));
					}
					else
					{
						return response()->json(array('status'=>200,'message'=>'Success, But OTP is not able to sent.'));	
					}					
				}
				else
				{
					return response()->json(array('status'=>200,'message'=>'Success, Kindly verify the email'));
				}
			}


		}
    }

    public function verify_otp(Request $request)
    {
    	$api_token = $request->header('apitoken');      
    	if($api_token!=$this->rest->register_api_token)
    	{
    		return response()->json(array('status'=>103,'message'=>$this->rest->sts_103));
    	}

    	$mobile=$request->input('mobile');
		$country_code=$request->input('country_code'); 		
		$os_type=$request->input('os_type');
		$device_id=$request->input('device_id');
		$device_modal=$request->input('device_modal');
		$otp=$request->input('otp');

    	$where = array(
    		'mobile' => $mobile,
    		'country_code' => $country_code,
    		'os_type' => $os_type,
    		'device_id' => $device_id,
    		'device_modal' => $device_modal,    		
    		'otp' => $otp
    	);

		if(empty($mobile) || empty($country_code) || empty($os_type) || empty($device_id) || empty($device_modal) || empty($otp) || $mobile=='NA' || $country_code=='NA' || $os_type=='NA' || $device_id=='NA' || $device_modal=='NA' || $otp=='NA')
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
		else
		{	
			$user_details = $this->user->select_users_row(array('api_token','user_id'),$where);
			if(!empty($user_details))
			{ 
				$this->rest->update_values($this->rest->tbl_users,array('user_id'=>$user_details->api_token),array('user_status'=>1,'otp_verify'=>1));
				return response()->json(array('status'=>200,'message'=>'Success','data'=>array('api_token'=>$user_details->api_token,'user_id'=>$user_details->user_id)));
			}			
			else
			{
				return response()->json(array('status'=>107,'message'=>$this->rest->sts_107));
			}
		}
    }

    public function register_gmail(Request $request)
    { 
    	$api_token = $request->header('apitoken');      
    	if($api_token!=$this->rest->register_api_token)
    	{
    		return response()->json(array('status'=>103,'message'=>$this->rest->sts_103));
    	}

		$google_userid=$request->input('userID');
		$name=$request->input('name');
		$email=$request->input('email'); 		
		$os_type=$request->input('os_type');
		$device_id=$request->input('device_id');
		$device_modal=$request->input('device_modal');

		if(empty($google_userid) || empty($name) || $google_userid=='NA' || $name=='NA')
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
		else
		{			
			if($this->rest->is_unique($this->rest->tbl_users,'google_user_id',$google_userid)==0)
			{
				$where =  array('google_user_id'=>$google_userid);
				$values =  array(
					'name' => $name,
					'email' => $email,					
					'os_type' => $os_type,
					'device_id' => $device_id,
					'device_modal' => $device_modal
				);
				$api_token = $this->user->update_user_get_token($where,$values);
				if($api_token!=false)
				{
				    
				    //dd($api_token);
					$details = explode('/', $api_token);
					return response()->json(array('status'=>200,'message'=>'Success','data'=>array('apitoken'=>$details[0],'user_id'=>$details[1])));
					
				}
				else
				{
					return response()->json(array('status'=>106,'message'=>$this->rest->sts_106));
				}
			}			
			else
			{	
			    $uniqu_user_id=$this->rest->get_unique_userid();
			    
			    $unique_token=$this->rest->get_unique_token();
				$values = array(
					'user_id'=> $uniqu_user_id,
					'google_user_id' => $google_userid,
					'name' => $name,					
					'email' => $email,
					'os_type' => $os_type,					
					'device_id' => $device_id,
					'device_modal' => $device_modal,
					'api_token' => $unique_token,
					'register_via' => 'GMAIL'
				);
				if($this->rest->insert_values($this->rest->tbl_users,$values))
				{	
					return response()->json(array('status'=>200,'message'=>'Success','data'=>array('apitoken'=>$unique_token,'user_id'=>$uniqu_user_id)));					
				}
				else
				{
					return response()->json(array('status'=>200,'message'=>'Success, Kindly verify the email'));
				}
			}
		}
    }

    public function register_facebook(Request $request)
    { 
    	$api_token = $request->header('apitoken');      
    	if($api_token!=$this->rest->register_api_token)
    	{
    		return response()->json(array('status'=>103,'message'=>$this->rest->sts_103));
    	}

		$facebook_userid=$request->input('id');
		$name=$request->input('name');
		$email=$request->input('email');
		$gender=$request->input('gender');
		$facebook_cover_pic=$request->input('facebook_cover_pic');
		$age= ($request->input('age')=='NA')?0:$request->input('age');
		$facebook_profile_dp=$request->input('facebook_profile_dp');
		$os_type=$request->input('os_type');
		$device_id=$request->input('device_id');
		$device_modal=$request->input('device_modal');

		if(empty($facebook_userid) || empty($name) || $facebook_userid=='NA' || $name=='NA')
		{			
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
		else
		{
			if($this->rest->is_unique($this->rest->tbl_users,'facebook_user_id',$facebook_userid)==0)
			{
				$where =  array('facebook_user_id'=>$facebook_userid);
				$values =  array(
					'name' => $name,
					'email' => $email,
					'gender' => $gender,
					'facebook_cover_pic' => $facebook_cover_pic,
					'os_type' => $os_type,
					'device_id' => $device_id,
					'device_modal' => $device_modal
				);
				$api_token = $this->user->update_fb_info($where,$values);
				if($api_token!=false)
				{
					$details = explode('/', $api_token);
					return response()->json(array('status'=>200,'message'=>'Success','data'=>array('apitoken'=>$details[0],'user_id'=>$details[1])));
				}
				else
				{
					return response()->json(array('status'=>106,'message'=>$this->rest->sts_106));
				}				
			}			
			else
			{	
			    $api_token = $this->rest->get_unique_token();
			    $user_id = $this->rest->get_unique_userid();			
				$values = array(
					'user_id'=> $user_id,
					'facebook_user_id' => $facebook_userid,
					'gender' => $gender,
					'age' => $age,
					'facebook_cover_pic' => $facebook_cover_pic,
					'facebook_profile_dp' => $facebook_profile_dp,
					'name' => $name,					
					'email' => $email,
					'os_type' => $os_type,					
					'device_id' => $device_id,
					'device_modal' => $device_modal,
					'api_token' => $api_token,
					'register_via' => 'FB'
				);
				$res = $this->rest->insert_values($this->rest->tbl_users,$values);
				if($res==true)
				{
					return response()->json(array('status'=>200,'message'=>'Success, You can use WannaHelp now, Cheers!','data'=>array('apitoken'=>$api_token,'user_id'=>$user_id)));			
				}
				else
				{
					return response()->json(array('status'=>107,'message'=>$this->rest->sts_107));
				}
			}
		}
    }

    public function login_email(Request $request)
    {
       $email=$request->input('email');
       $password=$request->input('password');       
       $os_type=$request->input('os_type');
       $device_id=$request->input('device_id');
       $device_modal=$request->input('device_modal'); 

       if($email=='NA' || $password=='NA' || empty($email) || empty($password))
       {
          return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
       }
       $where = array(
	       	'email' 	=> $email,
	       	'password'	=> $password,
	       	'os_type'   => $os_type,
	       	'device_id'	=> $device_id,
	       	'device_modal'	=> $device_modal
       );
       $res=$this->user->email_login($where);
       if($res=='invalid_details')
       {
          return response()->json(array('status'=>106,'message'=>$this->rest->sts_106));
       }
       else if($res=='need_email_verify')
       {
          return response()->json(array('status'=>108,'message'=>$this->rest->sts_108));
       }
       else
       {
       	  $details = explode('/', $res);
          return response()->json(array('status'=>200,'message'=>'Success','data'=>array('apitoken'=>$details[0],'user_id'=>$details[1])));
       }
    }
    
    
    public function follow_unfollow_user(Request $request)
	{
	   // return 1;
	    $user_id = $request->input('user_id');
        $follow_user_id = $request->input('id');
       
        
         $follow_user_detail = DB::table($this->rest->tbl_users)->select('followers')->where('user_id',$follow_user_id)->get()->first();
         //return $follow_user_detail;
         $user_detail = DB::table($this->rest->tbl_users)->select('following')->where('user_id',$user_id)->get()->first();
         
         
          if(!empty($follow_user_detail) && !empty($user_detail))
        {
           $user_followers_array = (!empty($follow_user_detail->followers))? json_decode($follow_user_detail->followers):array();
           $user_following_array = (!empty($user_detail->following))? json_decode($user_detail->following):array();
           

           // update followers coloum
           
           $update_data_followers = array();   
          //return $user_followers_array;
           $is_it = 0;
           foreach ($user_followers_array as $followers)
           {
              
              if($followers->user_id==$user_id)
                  $is_it = 1;
              else
                $update_data_followers[] = $followers;
           } 
           //return $is_it;
           
            if($is_it===1)
           {
             $user_followers_array = $update_data_followers; 
            
           }
           else
           {
            $user_followers_array[] = array('user_id'=>$user_id,'date_time'=>date('Y-m-d h:i:s'));             
                     
           }   
          // return $user_followers_array;
           $user_followers_array = json_encode($user_followers_array);
           $status = DB::table($this->rest->tbl_users)->where('user_id',$follow_user_id)->update(array('followers'=>$user_followers_array));
           
           
           
            // update following coloum
           
           $update_data_following = array();          
           $is_it = 0;
           foreach ($user_following_array as $following)
           {
              if($following->user_id==$follow_user_id)
                  $is_it = 1;
              else
                $update_data_following[] = $following;
           } 
           //return $is_it;
           
            if($is_it===1)
           {
             $user_following_array = $update_data_following; 
             
           }
           else
           {
            $user_following_array[] = array('user_id'=>$follow_user_id,'date_time'=>date('Y-m-d h:i:s'));             
                     
           }   
          // return $user_followers_array;
           $user_following_array = json_encode($user_following_array);
           $status1 = DB::table($this->rest->tbl_users)->where('user_id',$user_id)->update(array('following'=>$user_following_array));
          
           if($status>=1 && $status1>=1)
           {

             return response()->json(array('status'=>200,'message'=>'Success'));
           }
           else
           {
            return response()->json(array('status'=>107,'message'=>$this->rest->sts_107));
           }                            
           
           
           
           
        }
      //return $user_followers_array;  
        
    }
    
    
    public function following_followers_list(Request $request)
    {
        $user_id = $request->input('user_id');
        $update_data_followers = array(); 
        $update_data_following = array(); 
        
         $follow_user_detail = DB::table($this->rest->tbl_users)->select('followers','following')->where('user_id',$user_id)->get()->first();
          
          if(!empty($follow_user_detail))
        {
           $user_followers_array = (!empty($follow_user_detail->followers))? json_decode($follow_user_detail->followers):array();
           $user_following_array = (!empty($follow_user_detail->following))? json_decode($follow_user_detail->following):array();
           
 
         
           foreach ($user_followers_array as $followers)
           {
              
              $update_data_followers[] = $followers->user_id;
            } 
        
           foreach ($user_following_array as $following)
           {
              
              $update_data_following[] = $following->user_id;
            }                        
        
        $list[] = ["following"=>$update_data_following,"followers"=> $update_data_followers];
        
        return response()->json(array('status'=>200,'message'=>'Success','data'=>$list));    
            
        }
       else
       {
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
       }
         
    }
	
    
    
    public function getprofiledetails(Request $request)
	{
	
	$user_id=$request->input('user_idnew');
	$api_token = $request->header('apitoken');  
	$loggedin_user_id= User::where('api_token',	$api_token)->pluck('user_id');
	$dob = User::where('user_id',$user_id)->pluck('dob');
    $yyyy ='';
    $mm = '';
    $dd = '';
    if($dob[0]!=NULL || $dob[0]!="") 
    {
        $dob_arr = explode("-",$dob[0]);
        $yyyy = $dob_arr[0];
        $mm = $dob_arr[1];
        $dd = $dob_arr[2];
     }
	
	//return $user_id;
	$qry_response = User::select('users.*','user_details.*')
                            ->where('users.user_id',$user_id)
                            ->leftjoin('user_details', 'user_details.user_id', '=', 'users.user_id')
                            ->get();
    $qry_response[0]->city ="";
    if($qry_response[0]->location != "")
    {
    $location = explode(",",$qry_response[0]->location);     
    $qry_response[0]->city =  $location[0];        
    }
      
                            
    $qry_response[0] ->dd = $dd;
    $qry_response[0] ->mm = $mm;
    $qry_response[0] ->yyyy = $yyyy;
    
     $swap_count = DB::table('swaps')
        ->where('user_id','=',$user_id)
		
        ->count(); 
        
    $lv_count = DB::table('localvocals')
        ->where('user_id','=',$user_id)
	
        ->count(); 
        
     $follow_user_detail = DB::table($this->rest->tbl_users)->select('followers','following')->where('user_id',$user_id)->get()->first();
     
   
           $user_followers_array = (!empty($follow_user_detail->followers))? json_decode($follow_user_detail->followers):array();
           $user_following_array = (!empty($follow_user_detail->following))? json_decode($follow_user_detail->following):array();
           
           
           $is_it = "Follow";
           foreach ($user_followers_array as $followers)
           {
              
              if($followers->user_id==	$loggedin_user_id[0])
                  $is_it = "following";
              
           } 
           //return $is_it;
         $qry_response[0]->followStatus = $is_it;     
        $qry_response[0]->followersCount =  count($user_followers_array)  ;
        $qry_response[0]->followingCount =  count($user_following_array );
     
      $qry_response[0]->swapCount = $swap_count;  
      $qry_response[0]->localVocalCount = $lv_count;  
    if(!empty($qry_response))
	{ 
		return response()->json(array('status'=>200,'message'=>'Success','data'=>$qry_response));
	}			
	else
	{
		return response()->json(array('status'=>107,'message'=>$this->rest->sts_107));
	}

	
	} 
    
    public function get_categories(Request $request)
    {    	
    	$categories_details = $this->rest->get_categories();    	
    	return response()->json(array('status'=>200,'message'=>'Success','data'=>$categories_details));
    }

    public function insert_categories(Request $request)
	{
		$user_id=$request->input('user_id');		
		if(!empty($request->input('categories')))
		{
		  $category= implode(',', json_decode($request->input('categories')));	  
		  $values = array(
		  	'selected_categories'=> $category
		  );		 
		  $where = array('user_id'=>$user_id);	 
		  if($this->rest->update_values($this->rest->tbl_users,$where,$values)==true)
		  {		  	
		     return response()->json(array('status'=>200,'message'=>'Success, Categories are inserted.'));	
		  }
		  else
		  {		  	 
		     return response()->json(array('status'=>107,'message'=>$this->rest->sts_107)); 
		  }
		}
		else
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}	  
	}

    public function delete_categories(Request $request)
	{
		$category=$request->input('categories');		
		$user_id=$request->input('user_id');		
		if(!empty($category))
		{
			$user_details = $this->rest->select_row($this->rest->tbl_users,array('user_id'=>$user_id),'selected_categories');		
				
			if(!empty($user_details))
			{
				$selected_categories = explode(',', $user_details->selected_categories);
				$category = json_decode($category);				
				$final_cat = array_diff($selected_categories,$category);				
				$final_cat =  implode(',', $final_cat);						
				if($this->rest->update_values($this->rest->tbl_users,array('user_id'=>$user_id),array('selected_categories'=>$final_cat)))
				{
					 return response()->json(array('status'=>200,'message'=>'Success, Categories are deleted.'));
				}
				else
				{
					return response()->json(array('status'=>107,'message'=>$this->rest->sts_107));
				}
			}	

		}
		else
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
	}

	public function insert_location(Request $request)
	{
	  	$location=$request->input('location');
	  	$lat=$request->input('lat');
	  	$long=$request->input('long');	  	
	  	$user_id=$request->input('user_id');
	 	if(!empty($location) && !empty($user_id) && !empty($lat) && !empty($long))
		{		 	  
		  $values = array(
		  	'location'=> $location,
		  	'latitude'=> $lat,
		  	'longitude'=> $long
		  );
		  $where =  array('user_id'=>$user_id);	 
		  $sts = $this->rest->update_values($this->rest->tbl_users,$where,$values);		 
		  if($sts==1)
		  {
		     return response()->json(array('status'=>200,'message'=>'Success, Location inserted.'));	
		  }
		  else
		  {
		     return response()->json(array('status'=>107,'message'=>$this->rest->sts_107)); 
		  }
		}
		else
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}

	}

	public function fetch_users(Request $request)
	{
		$user_id=$request->input('user_id');
		$start=$request->input('start');
		$end=$request->input('end');
		$all_users=$request->input('all_users');
		$categories=$request->input('categories');
		$start = (empty($start))?0:$start;
		if(!empty($user_id) && !empty($end))
		{
			$location_info = $this->rest->select_row($this->rest->tbl_broadcasts,array('user_id'=>$user_id),array('location','latitude','longitude'));
			$lat = '';
			$long = '';
			if(!empty($location_info))
			{
				$lat = $location_info->latitude;
				$long = $location_info->longitude;
			}
			$all_users = (!empty($all_users))?json_decode($all_users):array();
			$all_users[] = $user_id;
			$user_details = $this->user->fetch_users($user_id,$start,$end,$all_users,$lat,$long,$categories);
			return response()->json(array('status'=>200,'message'=>'Success','data'=>$user_details));		
		}
		else
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
	}

	public function insert_users(Request $request)
	{
		$name=$request->input('name');
		$email=$request->input('email');
		$password=$request->input('password');
		$os_type=$request->input('os_type');
		$device_id=$request->input('device_id');
		$device_modal=$request->input('device_modal');
	  	$location=$request->input('location');
	  	$lat=$request->input('lat');
	  	$long=$request->input('long');	  	
	  	$user_id=$this->rest->get_unique_userid();
	 	if(!empty($email) && !empty($user_id) && !empty($lat) && !empty($long))
		{		 	  
		  $values = array(
		  	'user_id'=> $user_id,
		  	'name'=> $name,
		  	'email'=> $email,
		  	'password'=> $password,
		  	'os_type'=> $os_type,
		  	'device_id'=> $device_id,
		  	'device_modal'=> $device_modal,
		  	'location'=> $location,
		  	'latitude'=> $lat,
		  	'longitude'=> $long,
		  	'email_verify' => 1,
		  	'selected_categories' => '1,2,4,3,6,7',		  	
		  	'api_token' => $this->rest->get_unique_token()
		  );		 
		  $sts = $this->rest->insert_values($this->rest->tbl_users,$values);		 
		  if($sts==1)
		  {
		     return response()->json(array('status'=>200,'message'=>'Success, User inserted.'));	
		  }
		  else
		  {
		     return response()->json(array('status'=>107,'message'=>$this->rest->sts_107)); 
		  }
		}
		else
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}

	}   
	
	
	public function savebasicbio(Request $request)
	{
	    $user_id=$request->input('user_id');
	    $firstname = $request->input( 'firstname' );
	    $lastname = $request->input( 'lastname' );
	    $email = $request->input( 'email' );
	    $day = $request->input( 'day' );
	    $month = $request->input( 'month' );
	    $year = $request->input( 'year' );
	    $mobile = $request->input( 'mobile');
	    $gender = $request->input( 'gender');
	    $dob = $request->input( 'dob');
	    //$dob = $year."-".$month."-".$day;
	    
	    $aboutme = $request->input( 'aboutme');
	    $profession = $request->input( 'profession');
	    $city = $request->input( 'city');
	    
	    // return $firstname.$lastname.$email.$gender.$day.$month.$year.$profession.$city.$mobile.$aboutme;
	    $sts = DB::table('users')
            ->where('user_id', $user_id)
            ->update(['name' => $firstname,'last_name' => $lastname,'email' => $email,'dob' => $dob,'mobile' => $mobile,'gender' => $gender]);
           // return;
	     $sts1 = DB::table('user_details')
            ->where('user_id', $user_id)
            ->update(['current_location' => $city,'profession' => $profession,'about_me' => $aboutme]);
           
	    if($sts == 0 || $sts == 1 && $sts1 == 1 || $sts1 == 0 )
	    {
	        return response()->json(array('status'=>200,'message'=>'Success, Profile Updated.'));
	    }
	    else
	    {
	        return response()->json(array('status'=>107,'message'=>$this->rest->sts_107));    
	    }
	    
	    //return $file_loc;
	}
	
	
	public function savedp(Request $request)
	{
	    $user_id=$request->input('user_id'); 
	    $images = array();	  	
	  	if ($request->hasFile('image_dp')) 
	  	{
            $upload_data = $this->s3->upload_multiple_files('','image_dp','profile_pic','thumb'); 
             //return print_r($upload_data);
            if($upload_data['error']=='YES')
            {	  			
  	        return response()->json(array('status'=>109,'message'=>$this->rest->sts_109));
            }
            else
            {	  			
      	        foreach ($upload_data['files'] as $row)
      	        {
      		        if($row['error']==NULL)
      			        $images[] = $row['filename'];	
      			        //return count($upload_data['files']);
      	        }
      	        $file_loc = Helper::get_profile_pic_image_loc().$images[0];
    	    
    	        $update_pic = DB::table('users')
                ->where('user_id', $user_id)
                ->update(['profile_pic' => $file_loc,'dp_changed' => 1]);
               // return;
               
               if($update_pic == 1)
    	            return response()->json(array('status'=>200,'message'=>'Success, Profile Image Updated.'));
    	        else
    	        return response()->json(array('status'=>107,'message'=>$this->rest->sts_107)); 
      	        
  	        
            }	
	  	}
	   else
	    return response()->json(array('status'=>107,'message'=>"No Input image")); 
	    
	    
	    
	    
	    //return $file_loc;
	}
	
	
	public function savecover(Request $request)
	{
	    $user_id=$request->input('user_id'); 
	    $images = array();	  	
	  	if ($request->hasFile('image_cover')) 
	  	{
            $upload_data = $this->s3->upload_multiple_files('','image_cover','cover_pic','thumb'); 
             //return print_r($upload_data);
            if($upload_data['error']=='YES')
            {	  			
  	        return response()->json(array('status'=>109,'message'=>$this->rest->sts_109));
            }
            else
            {	  			
  	        foreach ($upload_data['files'] as $row)
  	        {
  		        if($row['error']==NULL)
  			        $images[] = $row['filename'];	
  			        //return count($upload_data['files']);
  	        }
  	        
  	         //return $images;
	    $file_loc = Helper::get_cover_pic_image_loc().$images[0];
	    
	    $update_pic = DB::table('users')
            ->where('user_id', $user_id)
            ->update(['cover_pic' => $file_loc,'cover_changed' => 1]);
           // return;
	    
	    if($update_pic == 1)
	     return response()->json(array('status'=>200,'message'=>'Success, Cover Image Updated.'));
	    else
	        return response()->json(array('status'=>107,'message'=>$this->rest->sts_107)); 
  	        
  	        
          }	
	  	}
	   
	    else
	    {
	        
	        return response()->json(array('status'=>107,'message'=>"No Input image")); 
	    }
	    
	    //return $file_loc;
	}
	
     public function new_chat(Request $request)
    {
    $user_id=$request->input('user_id');
    $bc_id = $request->input( 'id' );
     $type = $request->input( 'type' );
    if($type == 1)
    {
   // $bc_id = "BC".$temp_bc_id;
    $bc_user_id_pluck = DB::table('broadcasts')->where('broadcast_id',$bc_id)->pluck('user_id');
    //return 1;
    $bc_user_id = $bc_user_id_pluck[0];
    
    $bc_user_name_pluck = DB::table('users')->where('user_id',$bc_user_id)->pluck('name');
    $bc_user_name = $bc_user_name_pluck[0];
    
    $bc_details_desc = DB::table('broadcasts')->where('broadcast_id',$bc_id)->pluck('description');
    $bc_desc = $bc_details_desc[0];
    }
    else if ($type == 2)
    {
     $bc_id = "SW".$temp_bc_id;
    $bc_user_id_pluck = DB::table('swaps')->where('swap_id',$bc_id)->pluck('user_id');
    $bc_user_id = $bc_user_id_pluck[0];
    //return $bc_user_id;
    $bc_user_name_pluck = DB::table('users')->where('user_id',$bc_user_id)->pluck('name');
    $bc_user_name = $bc_user_name_pluck[0];
    
    $bc_details_desc = DB::table('swaps')->where('swap_id',$bc_id)->pluck('title');
    $bc_desc = $bc_details_desc[0];
        
        
    }
    
    
    //$type="Broadcast";
    //$user_id = Auth::user()->user_id;
    
    
    //return $bc_details;
    
     $chat =  $this->hasChatWith($user_id,$bc_user_id,$bc_id,$type);
     
    // return $chat;
     $conv_id = $chat->conv_id;
     //return $conv_id;
     //return $chat->conv_id;
     //return $chat;
    
    /*
    
    {
    "id":7,
    "user_id1":"PQ189810520811YR",
    "user_id2":"KS189810505654XN",
    "conv_id":"CV1811205474612",
    "type_id":"BC189802000328",
    "type":"Broadcast"
    }
    */
    
    $chat_string= '<firebase-messages user-id="'.$user_id.'" conv-id="'.$conv_id.'" receptor-name="'. $bc_user_name.'"></firebase-messages>';

  //  $chat_string ='<firebase-messages user-id="PQ189810520811YR" conv-id="CV1811906195791" receptor-name="Shyam"></firebase-messages>';
    return $chat_string;
    }
    
    public function usersChat(Request $request)
    {
        $user_id=$request->input('user_id');
        $convId=$request->input('conv_id');
       
        $receptorUser = Chat::where('conv_id', $convId)->first();
       // return $receptorUser;
       // return $receptorUser->type_id;
        if($receptorUser!= null)
        {
         if($receptorUser->type == "Broadcast")
            {
        $title = Broadcast::where('broadcast_id',$receptorUser->type_id)->pluck('description');
        //return $title;
               $receptorUser->title = $title[0]; 
                
                
            }
            else if($receptorUser->type == "Swap")
            
            {
                
                 $title = Swap::where('swap_id',$receptorUser->type_id)->pluck('title');
                 // return $title;
               $receptorUser->title = $title[0]; 
            }
        }
       // return $receptorUser;
        if($receptorUser == null) {
           
             $chat_lists_all = Chat::where('user_id1', '=', $user_id)
            ->orWhere('user_id2', $user_id)
            ->get();
            
            $chat_lists_bc = Chat::Where('type', "Broadcast")
            ->where('user_id1', '=', $user_id)
            ->orWhere('user_id2',$user_id)
            
            ->get();
            
            $chat_lists_sw = Chat::Where('type','Swap')
                ->where('user_id1', '=', $user_id)
            ->orWhere('user_id2', $user_id)
          
            ->get();
            //return $chat_lists_sw;
            if(count($chat_lists_sw) == 0 )
            {
               
                $chat_lists_sw = Chat::where('user_id2', '=', $user_id)
            
                    ->Where('type',"Swap")
                    ->get();
                
            }
            
           //return $chat_lists_bc;
             foreach($chat_lists_all as $chat_list)
            {
                if($chat_list->type == "Broadcast")
                {
                $broadcasts = User::select('users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
			
                    ->leftJoin('broadcasts', 'users.user_id', '=', 'broadcasts.user_id')
                    ->where('broadcasts.broadcast_id',$chat_list->type_id)
                    ->get();     
           
                $chat_list->user_name = $broadcasts[0]->name;
                if($broadcasts[0]->dp_changed == 1)
                $chat_list->picture= $broadcasts[0]->profile_pic;
                elseif($broadcasts[0]->facebook_profile_dp != NULL)
                $chat_list->picture== $broadcasts[0]->facebook_profile_dp;
                elseif($broadcasts[0]->google_profile_dp != NULL)
                 $chat_list->picture== $broadcasts[0]->google_profile_dp;
                else
                 $chat_list->picture== 'public/images/profile.png'; 
                
                
               
                }
               // return $chat_lists_all;
                
                if($chat_list->type == "Swap")
                {
               $broadcasts = User::select('users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
			
                    ->leftJoin('swaps', 'users.user_id', '=', 'swaps.user_id')
                    ->where('swaps.swap_id',$chat_list->type_id)
                    ->get();     
           
                $chat_list->user_name = $broadcasts[0]->name;
                
                
                if($broadcasts[0]->dp_changed == 1)
                $chat_list->picture= $broadcasts[0]->profile_pic;
                elseif($broadcasts[0]->facebook_profile_dp != NULL)
                $chat_list->picture== $broadcasts[0]->facebook_profile_dp;
                elseif($broadcasts[0]->google_profile_dp != NULL)
                 $chat_list->picture== $broadcasts[0]->google_profile_dp;
                else
                 $chat_list->picture== 'public/images/profile.png'; 
                    
                } 
                
            }
            
             foreach($chat_lists_bc as $chat_list)
            {
                if($chat_list->type == "Broadcast")
                {
                /*$title = Broadcast::where('broadcast_id',$chat_list->type_id)->pluck('description');
                $chat_list->desc = $title[0];  */  
                
                 $broadcasts = User::select('users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
			
                    ->leftJoin('broadcasts', 'users.user_id', '=', 'broadcasts.user_id')
                    ->where('broadcasts.broadcast_id',$chat_list->type_id)
                    ->get();     
           
                $chat_list->user_name = $broadcasts[0]->name;
                
                 if($broadcasts[0]->dp_changed == 1)
                $chat_list->picture= $broadcasts[0]->profile_pic;
                elseif($broadcasts[0]->facebook_profile_dp != NULL)
                $chat_list->picture== $broadcasts[0]->facebook_profile_dp;
                elseif($broadcasts[0]->google_profile_dp != NULL)
                 $chat_list->picture== $broadcasts[0]->google_profile_dp;
                else
                 $chat_list->picture== 'public/images/profile.png'; 
                
                    
                    
                } 
                
               
                
            }
            //return $chat_lists_bc;
            
             foreach($chat_lists_sw as $chat_list)
            {
                
                
                if($chat_list->type == "Swap")
                {
                $broadcasts = User::select('users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
			
                    ->leftJoin('swaps', 'users.user_id', '=', 'swaps.user_id')
                    ->where('swaps.swap_id',$chat_list->type_id)
                    ->get();     
           
                $chat_list->user_name = $broadcasts[0]->name;
                
                
                 if($broadcasts[0]->dp_changed == 1)
                $chat_list->picture= $broadcasts[0]->profile_pic;
                elseif($broadcasts[0]->facebook_profile_dp != NULL)
                $chat_list->picture== $broadcasts[0]->facebook_profile_dp;
                elseif($broadcasts[0]->google_profile_dp != NULL)
                 $chat_list->picture== $broadcasts[0]->google_profile_dp;
                else
                 $chat_list->picture== 'public/images/profile.png';  
                    
                } 
                
            }
          // return $chat_lists_sw;
            $chat="";
            //return $chat_lists;
            //$location_from_ip = $this->location_from_ip;
            $result = array();
             $result[] = array('receptorUser'=>$receptorUser,'chat'=>$chat,'chat_lists_all'=>$chat_lists_all, 'chat_lists_bc'=>$chat_lists_bc, 'chat_lists_sw'=>$chat_lists_sw);
           
            return $result;
            
        }else {
           
            
            $chat_lists_all = Chat::where('user_id1', '=', $user_id)
            ->orWhere('user_id2', $user_id)
            ->get();
            
            
            $chat_lists_bc = Chat::Where('type', "Broadcast")
            ->where('user_id1', '=', $user_id)
            ->orWhere('user_id2', $user_id)
            //->
            ->get();
            
            $chat_lists_sw = Chat:: Where('type','Swap')
                ->where('user_id1', '=', $user_id)
            ->orWhere('user_id2', $user_id)
          
            ->get();
           // return $chat_lists_sw;
            if(count($chat_lists_sw) == 0 )
            {
               
                $chat_lists_sw = Chat::where('user_id2', '=', $user_id)
            
                    ->Where('type',"Swap")
                    ->get();
                
            }
            
            //return $chat_lists_all;
            foreach($chat_lists_all as $chat_list)
            {
                if($chat_list->type == "Broadcast")
                {
                 $broadcasts = User::select('users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
			
                    ->leftJoin('broadcasts', 'users.user_id', '=', 'broadcasts.user_id')
                    ->where('broadcasts.broadcast_id',$chat_list->type_id)
                    ->get();
                
                
                
           
                $chat_list->user_name = $broadcasts[0]->name;
                
                 if($broadcasts[0]->dp_changed == 1)
                $chat_list->picture= $broadcasts[0]->profile_pic;
                elseif($broadcasts[0]->facebook_profile_dp != NULL)
                $chat_list->picture== $broadcasts[0]->facebook_profile_dp;
                elseif($broadcasts[0]->google_profile_dp != NULL)
                 $chat_list->picture== $broadcasts[0]->google_profile_dp;
                else
                 $chat_list->picture== 'public/images/profile.png'; 
               
                } 
                
                if($chat_list->type == "Swap")
                {
                $broadcasts = User::select('users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
			
                    ->leftJoin('swaps', 'users.user_id', '=', 'swaps.user_id')
                    ->where('swaps.swap_id',$chat_list->type_id)
                    ->get();     
           
                $chat_list->user_name = $broadcasts[0]->name;
                 if($broadcasts[0]->dp_changed == 1)
                $chat_list->picture= $broadcasts[0]->profile_pic;
                elseif($broadcasts[0]->facebook_profile_dp != NULL)
                $chat_list->picture== $broadcasts[0]->facebook_profile_dp;
                elseif($broadcasts[0]->google_profile_dp != NULL)
                 $chat_list->picture== $broadcasts[0]->google_profile_dp;
                else
                 $chat_list->picture== 'public/images/profile.png'; 
                
                
                    
                } 
                
            }
            
             foreach($chat_lists_bc as $chat_list)
            {
                if($chat_list->type == "Broadcast")
                {
                /*$title = Broadcast::where('broadcast_id',$chat_list->type_id)->pluck('description');
                $chat_list->desc = $title[0];    */
                
                $broadcasts = User::select('users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
			
                    ->leftJoin('broadcasts', 'users.user_id', '=', 'broadcasts.user_id')
                    ->where('broadcasts.broadcast_id',$chat_list->type_id)
                    ->get();     
           
                $chat_list->user_name = $broadcasts[0]->name;
                 if($broadcasts[0]->dp_changed == 1)
                $chat_list->picture= $broadcasts[0]->profile_pic;
                elseif($broadcasts[0]->facebook_profile_dp != NULL)
                $chat_list->picture== $broadcasts[0]->facebook_profile_dp;
                elseif($broadcasts[0]->google_profile_dp != NULL)
                 $chat_list->picture== $broadcasts[0]->google_profile_dp;
                else
                 $chat_list->picture== 'public/images/profile.png'; 
                
                
                } 
                
               
                
            }
            
             foreach($chat_lists_sw as $chat_list)
            {
                
                
                if($chat_list->type == "Swap")
                {
                 $broadcasts = User::select('users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
			
                    ->leftJoin('swaps', 'users.user_id', '=', 'swaps.user_id')
                    ->where('swaps.swap_id',$chat_list->type_id)
                    ->get();     
           
                $chat_list->user_name = $broadcasts[0]->name;
                 if($broadcasts[0]->dp_changed == 1)
                $chat_list->picture= $broadcasts[0]->profile_pic;
                elseif($broadcasts[0]->facebook_profile_dp != NULL)
                $chat_list->picture== $broadcasts[0]->facebook_profile_dp;
                elseif($broadcasts[0]->google_profile_dp != NULL)
                 $chat_list->picture== $broadcasts[0]->google_profile_dp;
                else
                 $chat_list->picture== 'public/images/profile.png'; 
                
                
                    
                } 
                
            }
          //  $location_from_ip = $this->location_from_ip;
          //return $receptorUser->id;
           $receptor_id = $receptorUser->user_id1;
          if($receptor_id == $user_id)
          {
              $receptor_id = $receptorUser->user_id2;
          }
         // return $receptor_id;
            $chat = $this->hasChatWith($user_id,$receptor_id,$receptorUser->type_id,""); 
           //$location_from_ip = $this->location_from_ip;
            //return $chat;
           
            $result = array();
             $result[] = array('receptorUser'=>$receptorUser,'chat'=>$chat,'chat_lists_all'=>$chat_lists_all, 'chat_lists_bc'=>$chat_lists_bc, 'chat_lists_sw'=>$chat_lists_sw);
           
            return $result;
        }
    }

    public function hasChatWith($user_id,$userId,$bc_id,$type)
    {
       // return $bc_id;
        $chat = Chat::where('user_id1', $user_id)
        ->where("type_id",$bc_id)
            ->where('user_id2', $userId)
            ->orWhere('user_id1', $userId)
            ->where('user_id2', $user_id)
            ->where("type_id",$bc_id)
            ->get();
       //return $chat;
        if(!$chat->isEmpty()){
            
             $chat = Chat::where('user_id1', $user_id)
            ->where('user_id2', $userId)
            ->orWhere('user_id1', $userId)
            ->where('user_id2', $user_id)
            ->where("type_id",$bc_id)
            ->get();
            
        //    $conv_id = $chat[0];
           // $update = DB::raw('UPDATE `chats` SET update_at=now();');
            
            return $chat->first();
        }else{
            
            
            $conv_id = $this->get_unique_conv_id();
            return $this->createChat($user_id, $userId,$conv_id,$bc_id,$type);
            
        }
    }
    
     public function get_unique_conv_id()
    	{				
    		$conv_id = 'CV'.date('yzhis');
    		$conv_id .= rand(00,99);	
    		$result = DB::table('messages')->where('conv_id',$conv_id)->first();
    		if(!empty($result)) $this->get_unique_conv_id();	
    		return $conv_id;
    	}

    public function createChat($userId1, $userId2,$conv_id,$bc_id,$type)
    {
        //return $userId2;
        
         /* $values_chats = array(
            'user_id1' => $userId1,
            'user_id2' => $userId2,
            'conv_id'  => $conv_id,
            'type_id'  => $bc_id,
            'type'     => "Broadcast"
          );
        //return 
        $sts = $this->rest->insert_values($this->rest->tbl_chats,$values_chats);*/
        if($type == 1)
       $id = DB::table('chats')-> insert(['user_id1' => $userId1,'user_id2' => $userId2,'conv_id'  => $conv_id,'type_id'  => $bc_id,'type'     => "Broadcast"]);
        if($type == 2)
        $id = DB::table('chats')-> insert(['user_id1' => $userId1,'user_id2' => $userId2,'conv_id'  => $conv_id,'type_id'  => $bc_id,'type'     => "Swap"]);
        
         $chat = Chat::where('user_id1', $userId1)
            ->where('user_id2', $userId2)
            ->orWhere('user_id1', $userId2)
            ->where('user_id2', $userId1)
            ->where("type_id",$bc_id)
            ->get();
        return $chat->first();
    
    }
    
	/*
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
	}*/

	

	
}



