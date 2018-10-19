<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RestController;

class User extends Model
{
    
     public function __construct()
    {
        $this->rest = new RestController();        
    }
    
    public function select_users_row($values,$where)
    {
        return User::select($values)->where($where)->first();
    }
    public function update_fb_info($where,$values)
    {
    	$status = User::where($where)->update($values);
    	if($status)
    	{
    		$userdata = User::select('api_token','user_id')->where($where)->first();
    		return $userdata->api_token.'/'.$userdata->user_id;
    	}
    	else
    	{
    		return false;
    	}
    }
    public function update_user_get_token($where,$values)
    {
    	$status = User::where($where)->update($values);
    	if($status)
    	{
    		$userdata = User::select('api_token','user_id')->where($where)->first();
    		return $userdata->api_token.'/'.$userdata->user_id;
    	}
    	else
    	{
    		return false;
    	}
    }

    public function email_login($where)
    {
    	$user_details = User::select('api_token','email_verify','user_id')->where($where)->first();
    	if(!empty($user_details))
    	{
    		if($user_details->email_verify==1)
    		{
    			return $user_details->api_token.'/'.$user_details->user_id;
    		}
    		else
    		{
    			return 'need_email_verify';	
    		}
    	}
    	else
    	{
    		return 'invalid_details';
    	}
    }


    public function fetch_users($user_id,$start,$end,$all_users,$lat,$long,$categories)
    {
        
        
        //DB::enableQueryLog();
       //$where = array('blocked_by_admin'=>0,'user_status'=>1);
       $categories = (!empty($categories))?json_decode($categories):array();
       $cat_where = '';
       
      // dd(count($categories));
       for ($i=0; $i < count($categories) ; $i++)
       { 
            if($i==count($categories)-1)
                $cat_where .= "FIND_IN_SET(".$categories[$i].",broadcasts.cat_id)"; 
            else 
                $cat_where .= "FIND_IN_SET(".$categories[$i].",broadcasts.cat_id) OR ";   
       }
       
       
      // dd($cat_where);
       $cat_where = (!empty($cat_where))?'( '.$cat_where.' )':' 1=1 ';
       $rad_sel = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(broadcasts.latitude) ) * cos( radians( broadcasts.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(broadcasts.latitude))) ) AS distance';


        //dd( $rad_sel);
        $rad_where = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(broadcasts.latitude) ) * cos( radians( broadcasts.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(broadcasts.latitude))) ) <= 20 ';
     
     
    // dd($rad_where);
       $user_details = User::select('users.user_id','users.name','users.profile_picture','users.is_online','users.selected_categories','users.user_type','users.user_status','broadcasts.broadcast_id','broadcasts.description')
                            ->selectRaw($rad_sel)
                            ->leftJoin('broadcasts','broadcasts.user_id','=','users.user_id')
                            ->where('broadcasts.current_broadcast','=','1')
                            ->whereNotIn('user_id',$all_users)
                            ->orWhereRaw($cat_where)
                            ->orWhereRaw($rad_where)                       //->whereRaw($rad_where)
                            /*->where($where)*/
                            ->orderBy('distance','asc')
                            ->offset($start)
                            ->limit($end)
                            ->get();
        $result = array();
        //print_r( DB::getQueryLog());
        
      //dd($user_details);  
        
        foreach ($user_details as $value)
        {
           $profile = url('/public/images/profile/');
           $profile = $profile.'/default.png';
           $result[] = array('user_id'=>$value->user_id,'name'=>$value->name,'profile_picture'=>$profile,'is_online'=>$value->is_online,'selected_categories'=>explode(',', $value->selected_categories),'user_type'=>$value->user_type,'broadcast_id'=>$value->broadcast_id,'description'=>$value->description,'user_status'=>$value->user_status); 
        }
        return $result; 
        
    }  

    public function search_users($user_id,$location,$categories,$start,$end,$lat,$long,$users_not_in)
    {
        //DB::enableQueryLog();
       //$where = array('blocked_by_admin'=>0,'user_status'=>1);
       $categories = (!empty($categories))?json_decode($categories):array();
       $cat_where = '';
       for ($i=0; $i < count($categories) ; $i++)
       { 
            if($i==count($categories)-1)
                $cat_where .= "FIND_IN_SET(".$categories[$i].",selected_categories)"; 
            else 
                $cat_where .= "FIND_IN_SET(".$categories[$i].",selected_categories) OR ";   
       }
       $cat_where = (!empty($cat_where))?'( '.$cat_where.' )':' 1=1 ';
       $rad_sel = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(latitude) ) * cos( radians( longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(latitude))) ) AS distance';
       $user_details = User::select('user_id','name','profile_picture','is_online','selected_categories','user_type','user_status')
                            ->selectRaw($rad_sel)                            
                            ->whereNotIn('user_id',$users_not_in)                            
                            ->where('location','like',$location)                          
                            ->orderBy('distance','asc')
                            ->offset($start)
                            ->limit($end)
                            ->get();
        $result = array();
        //print_r( DB::getQueryLog());
        foreach ($user_details as $value)
        {
           $profile = url('/public/images/profile/');
           $profile = $profile.'/default.png';
           $result[] = array('user_id'=>$value->user_id,'name'=>$value->name,'profile_picture'=>$profile,'is_online'=>$value->is_online,'selected_categories'=>explode(',', $value->selected_categories),'user_type'=>$value->user_type,'user_status'=>$value->user_status); 
        }
        return $result; 
        
    } 

}

