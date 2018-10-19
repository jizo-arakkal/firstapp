<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\RestController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\S3Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use config;
use Response;
use Image;
use App\Http\Models\User;
use App\Http\Models\Swap;
class SwapController extends Controller
{   
    public function __construct()
    {
    	$this->rest = new RestController();
    	$this->Smail = new MailController();
    	$this->s3 = new S3Controller();
    	$this->user = new User();
    	$this->swap = new Swap();    	
    } 

    public function add_swap(Request $request)
    {   
    	$user_id=$request->input('user_id');    	
		$title=$request->input('title');
		$description=$request->input('description');		
		$location=$request->input('location');
		$lat=$request->input('lat');
	  	$long=$request->input('long');
	  	$for_goods=$request->input('for_goods');
	  	$for_services=$request->input('for_services');
	  	$for_price=$request->input('for_price');
	  	$for_any=$request->input('for_any');
	  	$for_free=$request->input('for_free');
	  	$categories=$request->input('categories');
	  	$categories = (!empty($categories))?json_decode($categories):array();
	  	$categories = implode(',', $categories);
	  	$swap_id=$this->rest->get_unique_swapid();
	  	$images = array();	 	
	  
	  	if ($request->hasFile('images')) 
	  	{
	  		//var_dump($_FILES['images']['name']); exit;
	  		/*$fil = implode(',', ); 
	  		$this->rest->test_api_data($fil); */ 		
	  		$upload_data = $this->s3->upload_multiple_files('','images','swap','thumb');  		 
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
		  		}	
	  		}	  		
	  	}	  	
	  	$images = implode(',', $images);
	  	$for_any = (empty($for_any) OR $for_any==NULL)?0:$for_any;
	  	$for_free = (empty($for_free) OR $for_free==NULL)?0:$for_free;	  
	  	//Check user id is valid
	  	if($this->rest->is_unique($this->rest->tbl_users,'user_id',$user_id)==1)
	  	{
	  		return response()->json(array('status'=>106,'message'=>'Invalid User Id')); 
	  	}	    	
	 	if(!empty($title) && !empty($user_id) && !empty($lat) && !empty($long) && !empty($location))
		{		 	  
		  $values = array(
		  	'user_id'=> $user_id, 
		  	'swap_id'=> $swap_id, 
		  	'title'=> $title,
		  	'description'=> $description,
		  	'images'=> $images,
		  	'cat_id'=> $categories,
		  	'location'=> $location,
		  	'latitude'=> $lat,
		  	'longitude'=> $long,
		  	'for_goods'=> $for_goods,
		  	'for_services'=> $for_services,
		  	'for_price'=> $for_price,
		  	'for_any'=> $for_any,
		  	'for_free'=> $for_free,
		  	'status'=> 0,
		  	'created_at' => date('Y-m-d y:i:s')
		  );		 
		  $sts = $this->rest->insert_values($this->rest->tbl_swaps,$values);

		  if($sts==1)
		  {
		     return response()->json(array('status'=>200,'message'=>'Success, Swap inserted.'));	
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

    public function get_swap(Request $request)
	{
		$user_id=$request->input('user_id');
		$start=$request->input('start');
		$end=$request->input('end');
		//$swap_ids=$request->input('swap_ids');
		$categories=$request->input('categories');
		$location=$request->input('location');
		$search_keyword=$request->input('search_keyword');
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
			$swap_ids = (!empty($swap_ids))?json_decode($swap_ids):array();			
			$user_details = $this->swap->get_swap($user_id,$start,$end,$lat,$long,$categories,$location,$search_keyword);
			return response()->json(array('status'=>200,'message'=>'Success','data'=>$user_details));		
		}
		else
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
	}
	
	
	// Get swaps of particular user
	
	public function get_swap_user(Request $request)
    {
        $user_id=$request->input('user_idnew');
		$start=$request->input('start');
		$end=$request->input('end');
        if(!empty($user_id) && !empty($end))
		{
          $qry_response = Swap::select('swaps.swap_id','swaps.user_id','swaps.title','swaps.description','swaps.images','swaps.cat_id','swaps.location','swaps.for_goods','swaps.for_services','swaps.for_price','swaps.for_any','swaps.for_free','swaps.created_at','users.is_online','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp')
                           
                            ->join('users', 'users.user_id', '=', 'swaps.user_id')
                            ->where('swaps.user_id','=',$user_id)
                            
                            ->orderBy('swaps.created_at','desc')
                            ->offset($start)
                            ->limit($end)
                            ->get();
       
       //return $qry_response;
        $result = array();
        //print_r( DB::getQueryLog());
        foreach ($qry_response as $value)
        {
           $image_path = $this->rest->get_aws_baseurl().'swap/';
           $thumb_path = $this->rest->get_aws_baseurl().'swap/thumb/';
          // $category_list = $this->rest->select_by_wherein($this->rest->tbl_swaps,$fields,'id',explode(',', $value->cat_id));
          
           $images = explode(',', $value->images);
           $result[] = array('swap_id'=>$value->swap_id,'user_id'=>$value->user_id,'dp_changed'=>$value->dp_changed,'facebook_profile_dp'=>$value->facebook_profile_dp,'google_profile_dp'=>$value->google_profile_dp,'profile_pic'=>$value->profile_pic,'is_online'=>$value->is_online,'title'=>$value->title,'description'=>$value->description,'images'=>$images,'thumbs'=>$images[0],'image_path'=>$image_path,'thumb_path'=>$thumb_path,'cat_id'=>explode(',', $value->cat_id),'location'=>$value->location,'for_goods'=>$value->for_goods,'for_services'=>$value->for_services,'for_price'=>$value->for_price,'for_any'=>$value->for_any,'for_free'=>$value->for_free,'created_at'=>$value->created_at->diffForHumans(),'distance'=>number_format($value->distance,2).' Km'); 
        }
        return response()->json(array('status'=>200,'message'=>'Success','data'=>$result));
		}
		else
		{
		   	return response()->json(array('status'=>104,'message'=>$this->rest->sts_104)); 
		    
		}
		
    }


	public function get_swap_detail(Request $request)
	{
		$user_id=$request->input('user_id');	
		$swap_id=$request->input('swap_id');		
		if(!empty($user_id) && !empty($swap_id))
		{
			//Check user id is valid
		  	if($this->rest->is_unique($this->rest->tbl_users,'user_id',$user_id)==1)
		  	{
		  		return response()->json(array('status'=>106,'message'=>'Invalid User Id')); 
		  	}	
		  	$location_info = $this->rest->select_row($this->rest->tbl_users,array('user_id'=>$user_id),array('location','latitude','longitude'));
			$lat = '';
			$long = '';
			if(!empty($location_info))
			{
				$lat = $location_info->latitude;
				$long = $location_info->longitude;
			}	
			$response = $this->swap->get_swap_detail($swap_id,$lat,$long);
			return response()->json(array('status'=>200,'message'=>'Success','data'=>$response));		
		}
		else
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
	}

	/*public function search_swap(Request $request)
	{
		$user_id=$request->input('user_id');
		$start=$request->input('start');
		$end=$request->input('end');
		$location=$request->input('location');
		$search_keyword=$request->input('search_keyword');
		$categories=$request->input('categories');
		$start = (empty($start))?0:$start;
		if(!empty($user_id) && !empty($end) && !empty($location))
		{
			$location_info = $this->rest->select_row($this->rest->tbl_users,array('user_id'=>$user_id),array('location','latitude','longitude'));
			$lat = 0;
			$long = 0;
			if(!empty($location_info))
			{
				$lat = $location_info->latitude;
				$long = $location_info->longitude;
			}					
			$response_details = $this->swap->get_swap($user_id,$start,$end,$lat,$long,$categories,$location,$search_keyword);
			return response()->json(array('status'=>200,'message'=>'Success','data'=>$response_details));		
		}
		else
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
	}*/
	public function get_swap_feedback_types(Request $request)
	{
		$user_id=$request->input('user_id');			
		if(!empty($user_id))
		{
			if($this->rest->is_unique($this->rest->tbl_users,'user_id',$user_id)==1)
		  	{
		  		return response()->json(array('status'=>106,'message'=>'Invalid User Id')); 
		  	}		  	
			$response = $this->rest->select_row($this->rest->tbl_config_values,array('key_term'=>'swap_feedback_types'),array('value'));				
			$types = (!empty($response->value))?json_decode($response->value):array();
			return response()->json(array('status'=>200,'message'=>'Success','data'=>$types));
		}
		else
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
	}

	function report_swap(Request $request)
	{	
		$user_id=$request->input('user_id');	
		$swap_id=$request->input('swap_id');
		$type=$request->input('type');
		$remark=$request->input('remark');		
		if(!empty($user_id) && !empty($swap_id) && !empty($type))
		{
			//Check user id is valid
		  	if($this->rest->is_unique($this->rest->tbl_users,'user_id',$user_id)==1)
		  	{
		  		return response()->json(array('status'=>106,'message'=>'Invalid User Id')); 
		  	}
		  	$swap_detail = $this->rest->select_row($this->rest->tbl_swaps_report,array('swap_id'=>$swap_id,'user_id'=>$user_id),array('id'));		  	
		  	if(!empty($swap_detail))
		  	{
		  		return response()->json(array('status'=>200,'message'=>'You have already reported')); 
		  	}
		  	else
		  	{
		  		$response = $this->rest->insert_values($this->rest->tbl_swaps_report,array('swap_id'=>$swap_id,'user_id'=>$user_id,'type'=>$type,'remark'=>$remark,'created_at'=>date('Y-m-d h:i:s')));
		  		if($response)
		  			return response()->json(array('status'=>200,'message'=>'Success, Reported successfully','data'=>array()));
		  		else
		  			return response()->json(array('status'=>107,'message'=>$this->rest->sts_107,'data'=>array()));
		  	}
					
		}
		else
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
	}

	public function get_swap_suggestion(Request $request)
	{
		$user_id=$request->input('user_id');
		$swap_id=$request->input('swap_id');		
		if(!empty($user_id) && !empty($swap_id))
		{
			$location_info = $this->rest->select_row($this->rest->tbl_users,array('user_id'=>$user_id),array('location','latitude','longitude'));
			$lat = '';
			$long = '';
			$location = '';
			if(!empty($location_info))
			{
				$lat = $location_info->latitude;
				$long = $location_info->longitude;
				$location = $location_info->location;
			}					
			$response = $this->swap->get_swap_suggestion($user_id,$swap_id,$lat,$long,$location);
			return response()->json(array('status'=>200,'message'=>'Success','data'=>$response));		
		}
		else
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
	}
	
	
}



