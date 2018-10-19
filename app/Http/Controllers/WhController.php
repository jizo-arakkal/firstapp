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
class WhController extends Controller
{   
    public function __construct()
    {
    	$this->rest = new RestController();
    	$this->Smail = new MailController();
    	$this->user = new User();    	
    }  



    
	public function fetch_users(Request $request)
	{
	    
	 
	    
	    
	    
		$user_id=$request->input('user_idnew');
		// dd($user_id);
		
		
		$start=$request->input('start');
		$end=$request->input('end');
	//	dd($end);
		
		$all_users=$request->input('all_users');
		$categories=$request->input('categories');
		
		
		
		$start = (empty($start))?0:$start;
		if(!empty($user_id) && !empty($end))
		{
			$location_info = $this->rest->select_row($this->rest->tbl_users,array('user_id'=>$user_id),array('location','latitude','longitude'));
			$lat = '';
			$long = '';
			if(!empty($location_info))
			{
				$lat = $location_info->latitude;
				$long = $location_info->longitude;
			}
			$all_users = (!empty($all_users))?json_decode($all_users):array($user_id);
			//$all_users[] = $user_id;
			//dd($lat);
			
			
			$user_details = $this->user->fetch_users($user_id,$start,$end,$all_users,$lat,$long,$categories);
			return response()->json(array('status'=>200,'message'=>'Success','data'=>$user_details));		
		}
		else
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
	}

	// Search users by location
	public function search_users(Request $request)
	{
		$user_id=$request->input('user_id');
		$location=$request->input('location');		
		$categories=$request->input('categories');
		$start=$request->input('start');
		$end=$request->input('end');		
		if(!empty($user_id) && !empty($location))
		{
			$location_info = $this->rest->select_row($this->rest->tbl_users,array('user_id'=>$user_id),array('location','latitude','longitude'));
			$lat = 0;
			$long = 0;
			if(!empty($location_info))
			{
				$lat = $location_info->latitude;
				$long = $location_info->longitude;
			}
			$users_not_in = array($user_id);
			$user_details = $this->user->search_users($user_id,$location,$categories,$start,$end,$lat,$long,$users_not_in);
			return response()->json(array('status'=>200,'message'=>'Success','data'=>$user_details));		
		}
		else
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
	}

	
	
}



