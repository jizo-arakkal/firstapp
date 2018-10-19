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
use App\Http\Models\Localvocal;
class LvController extends Controller
{   
    public function __construct()
    {
    	$this->rest = new RestController();
    	$this->Smail = new MailController();
    	$this->s3 = new S3Controller();
    	$this->user = new User();
    	$this->lv = new Localvocal();    	
    } 

    public function add_lv(Request $request)
    {   
    	$user_id=$request->input('user_id');    	
		$title=$request->input('title');
		$description=$request->input('description');		
		$location=$request->input('location');
		$lat=$request->input('lat');
	  	$long=$request->input('long');	  	
	  	$categories=$request->input('categories');
	  	$public=$request->input('public');
	  	$followers=$request->input('followers');
	  	$categories = (!empty($categories))?json_decode($categories):array();
	  	$categories = implode(',', $categories);
	  	$lv_id=$this->rest->get_unique_lvid();
	  	$images = array();	  	
	  	if ($request->hasFile('images')) 
	  	{
	  		//$fil = implode(',', $_FILES['images']['name']);
	  		//$this->rest->test_api_data($fil);
	  		$upload_data = $this->s3->upload_multiple_files('','images','lv','thumb');  		 
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
	  	//echo 'test';  	
	  	$images = implode(',', $images);	  	
	  	//Check user id is valid
	  	if($this->rest->is_unique($this->rest->tbl_users,'user_id',$user_id)==1)
	  	{
	  		return response()->json(array('status'=>106,'message'=>'Invalid User Id')); 
	  	}	    	
	 	if(!empty($title) && !empty($user_id) && !empty($lat) && !empty($long) && !empty($location))
		{		 	  
		  $values = array(
		  	'user_id'=> $user_id, 
		  	'lv_id'=> $lv_id, 
		  	'title'=> $title,
		  	'description'=> $description,
		  	'images'=> $images,
		  	'cat_id'=> $categories,
		  	'location'=> $location,
		  	'latitude'=> $lat,
		  	'longitude'=> $long,
		  	'public'=> $public,
		  	'followers'=> 1,	
		  	'last_activity'=> '',
		  	'last_activity_user_id'=> '',
		  	'status'=> 1,
		  	'public'=> 0,
		  	'created_at' => date('Y-m-d y:i:s')
		  );		 
		  $sts = $this->rest->insert_values($this->rest->tbl_localvocals,$values);
		  if($sts==1)
		  {
		     return response()->json(array('status'=>200,'message'=>'Success, Localvocal inserted.'));	
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

    public function get_lv(Request $request)
	{
		$user_id=$request->input('user_idnew');
		//dd($user_id);
		$start=$request->input('start');
		$end=$request->input('end');		
		$categories=$request->input('categories');
		//dd($end);
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
					
			$user_details = $this->lv->get_lv($user_id,$start,$end,$lat,$long,$categories);
			//dd("ssdfsf");
			return response()->json(array('status'=>200,'message'=>'Success','data'=>$user_details));		
		}
		else
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
	}

	public function get_lv_detail(Request $request)
	{
		$user_id=$request->input('user_id');	
		$lv_id=$request->input('lv_id');	
		
		if(!empty($user_id) && !empty($lv_id))
		{		
			$response = $this->lv->get_lv_detail($lv_id,$user_id);
			return response()->json(array('status'=>200,'message'=>'Success','data'=>$response));		
		}
		else
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
	}
	public function like_lv(Request $request)
	{	
		$user_id=$request->input('user_id');
		//dd($user_id);
		
		$lv_id=$request->input('lv_id');
		//dd($lv_id);
		if(!empty($user_id) && !empty($lv_id))
		{
			$is_valid = $this->lv->check_lv_extra_info($lv_id);
			
			if($is_valid==="invalid_id")	
				return response()->json(array('status'=>106,'message'=>'Invalid lv Id'));
			elseif($is_valid==false)
				return response()->json(array('status'=>107,'message'=>$this->rest->sts_107));							
			$response = $this->lv->like_lv($lv_id,$user_id);			
			if($response=='liked')
			{
				return response()->json(array('status'=>200,'message'=>'Success','data'=>$response));
			}			
			elseif($response==false)
			{
				return response()->json(array('status'=>107,'message'=>$this->rest->sts_107));
			}
			elseif($response=='unliked')
			{
			    return response()->json(array('status'=>200,'message'=>'Success','data'=>'unliked'));
			}
		}
		else
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
	}

	public function share_lv(Request $request)
	{
		$user_id=$request->input('user_id');	
		$lv_id=$request->input('lv_id');		
		if(!empty($user_id) && !empty($lv_id))
		{
			$is_valid = $this->lv->check_lv_extra_info($lv_id);			
			if($is_valid==="invalid_id")	
				return response()->json(array('status'=>106,'message'=>'Invalid lv Id 2'));
			elseif($is_valid==false)
				return response()->json(array('status'=>107,'message'=>$this->rest->sts_107));					
			$response = $this->lv->share_lv($lv_id,$user_id);			
			if($response===2)
			{
				return response()->json(array('status'=>200,'message'=>'You have shared already','data'=>''));
			}
			elseif($response==true)
			{
				return response()->json(array('status'=>200,'message'=>'Success','data'=>$response));
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

	public function view_lv(Request $request)
	{
		$user_id=$request->input('user_id');	
		$lv_id=$request->input('lv_id');		
		if(!empty($user_id) && !empty($lv_id))
		{
			$is_valid = $this->lv->check_lv_extra_info($lv_id);			
			
			if($is_valid==="invalid_id")	
				return response()->json(array('status'=>106,'message'=>'Invalid lv Id 2'));
			elseif($is_valid==false)
				return response()->json(array('status'=>107,'message'=>$this->rest->sts_107));					
			$response = $this->lv->view_lv($lv_id,$user_id);					
			if($response===2)
			{
				return response()->json(array('status'=>200,'message'=>'You have viewed already','data'=>''));
			}
			elseif($response==true)
			{
				return response()->json(array('status'=>200,'message'=>'Success','data'=>$response));
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

	public function comment_lv(Request $request)
	{
		$user_id=$request->input('user_id');	
		$lv_id=$request->input('lv_id');
		$comment=$request->input('comment');		
		if(!empty($user_id) && !empty($lv_id) && !empty($comment))
		{							
			$response = $this->rest->insert_values($this->rest->tbl_lv_comments,array('lv_id'=>$lv_id,'user_id'=>$user_id,'comment'=>$comment,'created_at'=>date('Y-m-d h:i:s')));						
			if($response==true)
			{
				return response()->json(array('status'=>200,'message'=>'Success','data'=>array()));
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

	public function get_lv_comment(Request $request)
	{
	    
	    $user_id=$request->input('user_id');
	  //  dd($request->input('user_id'));
	    
	    
		$lv_id=$request->input('llv_id');
		
		
		//$user_id='KS189810505654XN';//$request->input('lv_id');			
		if(!empty($user_id) && !empty($lv_id))
		{							
			$response = $this->lv->get_lv_comment($lv_id);
			return response()->json(array('status'=>200,'message'=>'Success','data'=>$response));					
		}
		else
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
	}
	
	// Get lv of particular user
	
	public function get_lv_user(Request $request)
    {
        $user_id=$request->input('user_id');
		$start=$request->input('start');
		$end=$request->input('end');
        if(!empty($user_id) && !empty($end))
		{
          $qry_response = LocalVocal::select('localvocals.*','users.is_online','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp')
                           
                            ->join('users', 'users.user_id', '=', 'localvocals.user_id')
                            ->where('localvocals.user_id','=',$user_id)
                            
                            ->orderBy('localvocals.created_at','desc')
                            ->offset($start)
                            ->limit($end)
                            ->get();
       
       
        $result = array();
        //print_r( DB::getQueryLog());
        foreach ($qry_response as $value)
        {
           $image_path = $this->rest->get_aws_baseurl().'lv/';
           $thumb_path = $this->rest->get_aws_baseurl().'lv/thumb/';
           $images = explode(',', $value->images);
           $views = $this->lv->get_activity_count($value->lv_id,'view_count');
           $likes = $this->lv->get_activity_count($value->lv_id,'like_count');
           $is_liked = $this->lv->check_user_like($value->lv_id,$user_id);
           $last_activity = array('type'=>$value->last_activity,'user_id'=>$value->last_activity_user_id,'name'=>$value->last_activity_username,'date'=>$value->updated_at); 
           $result[] = array('lv_id'=>$value->lv_id,'user_id'=>$value->user_id,'name'=>$value->name,'dp_changed'=>$value->dp_changed,'facebook_profile_dp'=>$value->facebook_profile_dp,'google_profile_dp'=>$value->google_profile_dp,'profile_pic'=>$value->profile_pic,'is_online'=>$value->is_online,'title'=>$value->title,'description'=>$value->description,'images'=>$images,'thumbs'=>$images[0],'image_path'=>$image_path,'thumb_path'=>$thumb_path,'cat_id'=>explode(',', $value->cat_id),'location'=>$value->location,'created_at'=>$value->created_at->diffForHumans(), 'views'=>$views ,'likes'=>$likes,'is_liked'=>$is_liked ,'last_activity' =>$last_activity);
        }
        return response()->json(array('status'=>200,'message'=>'Success','data'=>$result));
		}
		else
		{
		   	return response()->json(array('status'=>104,'message'=>$this->rest->sts_104)); 
		    
		}
		
    }
    
    
    public function delete_lv_comment(Request $request)
	{	
		$user_id=$request->input('user_id');	
		$lv_id=$request->input('lv_id');
        $comment_id=$request->input('comment_id');	
	    
	    if(!empty($user_id) && !empty($lv_id) && !empty($comment_id))
		{							
			$response = $this->lv->delete_lv_comment($comment_id,$user_id,$lv_id);
			return response()->json(array('status'=>200,'message'=>'Success','data'=>$response));					
		}
		else
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
	    
	}
	
}



