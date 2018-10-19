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
use App\Http\Models\Broadcast;
class BroadcastController extends Controller
{   
    public function __construct()
    {
    	$this->rest = new RestController();
    	$this->Smail = new MailController();
    	$this->s3 = new S3Controller();
    	//$this->user = new User();
    	$this->bc = new Broadcast();    	
    } 


    /*
    Function:
    
    
    */
    
   
    public function add_bc(Request $request)
    {   
       // return 1;
    	$user_id=$request->input('user_id');    	
		
		$description=$request->input('description');		
		$location=$request->input('location');
		$lat=$request->input('lat');
	  	$long=$request->input('long');	  	
	  	$categories=$request->input('categories');
	  	//return $categories;
	  	$categories = (!empty($categories))?json_decode($categories):array();
	  	
	  	$categories = implode(',', $categories);
	  	$bc_id=$this->rest->get_unique_bcid();
	  	
	  	//Check user id is valid
	  	if($this->rest->is_unique($this->rest->tbl_users,'user_id',$user_id)==1)
	  	{
	  		return response()->json(array('status'=>106,'message'=>'Invalid User Id')); 
	  	}	    	
	 	if(!empty($user_id) && !empty($lat) && !empty($long) && !empty($location))
		{		 	  
		  $values = array(
		  	'user_id'=> $user_id, 
		  	'broadcast_id'=> $bc_id,
		  	'description'=> $description,
		  	'cat_id'=> $categories,
		  	'location'=> $location,
		  	'latitude'=> $lat,
		  	'longitude'=> $long,
		  	'created_at' => date('Y-m-d y:i:s'),
		  	'updated_at' => date('Y-m-d y:i:s')
		  );		 
		  $sts = $this->rest->insert_values($this->rest->tbl_broadcasts,$values);
		  if($sts==1)
		  {
		     return response()->json(array('status'=>200,'message'=>'Success, Broadcast inserted.'));	
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

     
 public function get_bc(Request $request)
	{
	    //return 1;
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
			$user_details = $this->bc->get_bc($user_id,$start,$end,$lat,$long,$categories,$location,$search_keyword);
			return response()->json(array('status'=>200,'message'=>'Success','data'=>$user_details));		
		}
		else
		{
			return response()->json(array('status'=>104,'message'=>$this->rest->sts_104));
		}
	}
	
	
	
   
	// Get bc of particular user
	
	public function get_bc_user(Request $request)
    {
        $user_id=$request->input('user_idnew');
		$start=$request->input('start');
		$end=$request->input('end');
        if(!empty($user_id) && !empty($end))
		{
          $qry_response = Broadcast::select('broadcasts.*','users.is_online','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp')
                           
                            ->join('users', 'users.user_id', '=', 'broadcasts.user_id')
                            ->where('broadcasts.user_id','=',$user_id)
                            
                            ->orderBy('broadcasts.created_at','desc')
                            ->offset($start)
                            ->limit($end)
                            ->get();
       
       
      
        
        return response()->json(array('status'=>200,'message'=>'Success','data'=>$qry_response));
		}
		else
		{
		   	return response()->json(array('status'=>104,'message'=>$this->rest->sts_104)); 
		    
		}
		
    }
	
}


