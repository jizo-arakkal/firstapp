<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RestController;

class Localvocal extends Model
{   
    public function __construct()
    {
        $this->rest = new RestController();        
    }
    public function get_lv($user_id,$start,$end,$lat,$long,$categories)
    {
        //DB::enableQueryLog();
       //$where = array('blocked_by_admin'=>0,'user_status'=>1);
       $categories = (!empty($categories))?json_decode($categories):array();
       $cat_where = '';
       for ($i=0; $i < count($categories) ; $i++)
       { 
            if($i==count($categories)-1)
                $cat_where .= "FIND_IN_SET(".$categories[$i].",localvocals.cat_id)"; 
            else 
                $cat_where .= "FIND_IN_SET(".$categories[$i].",localvocals.cat_id) OR ";   
       }
       $cat_where = (!empty($cat_where))?'( '.$cat_where.' )':' 1=1 ';
       $rad_sel = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(localvocals.latitude) ) * cos( radians( localvocals.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(localvocals.latitude))) ) AS distance';

        $rad_where = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(localvocals.latitude) ) * cos( radians( localvocals.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(localvocals.latitude))) ) <= 20 ';
     
     //dd($rad_where);
     
       $qry_response = Localvocal::select('localvocals.lv_id','localvocals.user_id','localvocals.title','localvocals.description','localvocals.images','localvocals.cat_id','localvocals.location','localvocals.created_at','users.facebook_profile_dp','users.google_profile_dp','users.dp_changed','users.profile_pic','users.is_online','users.name','lau.name as last_activity_username','localvocals.last_activity_user_id','localvocals.updated_at','localvocals.last_activity')
                           // ->selectRaw($rad_sel)
                            ->join('users', 'users.user_id', '=', 'localvocals.user_id')
                            ->leftjoin('users as lau', 'lau.user_id', '=', 'localvocals.last_activity_user_id')
                            ->whereRaw($cat_where)
                          //  ->whereRaw($rad_where)
                           // ->whereRaw('status=1')
                            /*->where($where)*/
                           // ->orderBy('distance','asc')
                            ->offset($start)
                            ->limit($end)
                            ->get();
                            
        //dd($qry_response);
        $result = array();
        //print_r( DB::getQueryLog());
        foreach ($qry_response as $value)
        {
           $image_path = $this->rest->get_aws_baseurl().'lv/';
           $thumb_path = $this->rest->get_aws_baseurl().'lv/thumb/';
           $views = $this->get_activity_count($value->lv_id,'view_count');
           $likes = $this->get_activity_count($value->lv_id,'like_count');
           $is_liked = $this->check_user_like($value->lv_id,$user_id);
           $last_activity = array('type'=>$value->last_activity,'user_id'=>$value->last_activity_user_id,'name'=>$value->last_activity_username,'date'=>$value->updated_at); 
                               
           //$category_list = $this->rest->select_by_wherein($this->rest->tbl_localvocals,$fields,'id',explode(',', $value->cat_id));
           $images = explode(',', $value->images);
           $result[] = array('lv_id'=>$value->lv_id,'user_id'=>$value->user_id,'name'=>$value->name,'dp_changed'=>$value->dp_changed,'facebook_profile_dp'=>$value->facebook_profile_dp,'google_profile_dp'=>$value->google_profile_dp,'profile_pic'=>$value->profile_pic,'is_online'=>$value->is_online,'title'=>$value->title,'description'=>$value->description,'images'=>$images,'thumbs'=>$images[0],'image_path'=>$image_path,'thumb_path'=>$thumb_path,'cat_id'=>explode(',', $value->cat_id),'location'=>$value->location,'created_at'=>$value->created_at->diffForHumans(),'distance'=>number_format($value->distance,2).' Km' , 'views'=>$views ,'likes'=>$likes,'is_liked'=>$is_liked ,'last_activity' =>$last_activity); 
        }
        return $result;
        
    }

    public function get_lv_detail($lv_id,$user_id)
    {
       $qry_response = Localvocal::select('localvocals.lv_id','localvocals.user_id','localvocals.title','localvocals.description','localvocals.images','localvocals.cat_id','localvocals.location','localvocals.created_at','users.profile_picture','users.is_online','users.name','lau.name as last_activity_username','localvocals.last_activity_user_id','localvocals.updated_at','localvocals.last_activity')
                            ->where('localvocals.lv_id',$lv_id)
                            ->join('users', 'users.user_id', '=', 'localvocals.user_id')
                            ->leftjoin('users as lau', 'lau.user_id', '=', 'localvocals.last_activity_user_id')
                            ->get();
        $result = array();       
        foreach ($qry_response as $value)
        {
           $image_path = $this->rest->get_aws_baseurl().'lv/';
           $thumb_path = $this->rest->get_aws_baseurl().'lv/thumb/';
           $images = explode(',', $value->images);
           $views = $this->get_activity_count($value->lv_id,'view_count');
           $likes = $this->get_activity_count($value->lv_id,'like_count');
           $is_liked = $this->check_user_like($value->lv_id,$user_id);
           $last_activity = array('type'=>$value->last_activity,'user_id'=>$value->last_activity_user_id,'name'=>$value->last_activity_username,'date'=>$value->updated_at); 
           $result = array('lv_id'=>$value->lv_id,'user_id'=>$value->user_id,'name'=>$value->name,'profile_picture'=>$value->profile_picture,'is_online'=>$value->is_online,'title'=>$value->title,'description'=>$value->description,'images'=>$images,'thumbs'=>$images[0],'image_path'=>$image_path,'thumb_path'=>$thumb_path,'cat_id'=>explode(',', $value->cat_id),'location'=>$value->location,'created_at'=>$value->created_at->diffForHumans(), 'views'=>$views ,'likes'=>$likes,'is_liked'=>$is_liked ,'last_activity' =>$last_activity); 
        }
        return $result; 
        
    }    

    function check_lv_extra_info($lv_id)
    {
       //DB::enableQueryLog();      
       $lv_details = DB::table($this->rest->tbl_localvocals)->select('lv_id')->where('lv_id',$lv_id)->get()->first();
       //print_r($lv_details);
       if(!empty($lv_details))
       {
          $lv_extra_details = DB::table($this->rest->tbl_lv_like_share)->select('like_count','like_details')->where('lv_id',$lv_id)->get()->first();
          if(empty($lv_extra_details))
          {
            $data = array(
              'lv_id'=>$lv_id,
              'like_count'=>0,
              'like_details'=>'',
              'share_count'=>0,
              'share_details'=>'',
              'view_count' => 0,
              'view_details' => ''
             );
             $status = DB::table($this->rest->tbl_lv_like_share)->insert($data);
             if($status)
             {
               return true;
             }
             else
             {
               return false;
             }
          }
          else
          {
              return true;
          }           
       }
       else
       {
          return "invalid_id";
       }
    }

    function like_lv($lv_id,$user_id)
    {        
        
        
        $all_ready_like=0; 
        
        $lv_details = DB::table($this->rest->tbl_lv_like_share)->select('like_count','like_details')->where('lv_id',$lv_id)->get()->first();
        if(!empty($lv_details))
        {
           $like_details = (!empty($lv_details->like_details))? json_decode($lv_details->like_details):array();
           $update_data = array();          
           $is_it = 0;
           foreach ($like_details as $value)
           {
              if($value->user_id==$user_id)
                  $is_it = 1;
              else
                $update_data[] = $value;
           }                       
           if($is_it===1)
           {
             $like_details = $update_data; 
             if($lv_details->like_count>0)            
              $like_count = $lv_details->like_count-1;
              $all_ready_like=1;
           }
           else
           {
             $like_details[] = array('user_id'=>$user_id,'date_time'=>date('Y-m-d h:i:s'));             
             $like_count = $lv_details->like_count+1;             
           }   

           $like_details = json_encode($like_details);
           $status = DB::table($this->rest->tbl_lv_like_share)->where('lv_id',$lv_id)->update(array('like_details'=>$like_details,'like_count'=>$like_count));
           if($status>=1)
           {
             $data = array('last_activity'=>'like','last_activity_user_id'=>$user_id,'updated_at'=>date('Y-m-d h:i:s'));
             $this->rest->update_values($this->rest->tbl_localvocals,array('lv_id'=>$lv_id),$data);
             if($all_ready_like==1)
             {
                 return 'unliked';
             }
             return 'liked';
           }
           else
           {
             return false;
           }                            
           
        }       
    }
    
    function share_lv($lv_id,$user_id)
    {        
        $lv_details = DB::table($this->rest->tbl_lv_like_share)->select('share_count','share_details')->where('lv_id',$lv_id)->get()->first();
        if(!empty($lv_details))
        {
           $share_details = (!empty($lv_details->share_details))?json_decode($lv_details->share_details):array();           
           $is_it = 0;
           foreach ($share_details as $value)
           {
              if($value->user_id==$user_id)
                  $is_it = 1;
           }                       
           if($is_it==1) return 2;                               
           $share_details[] = array('user_id'=>$user_id,'date_time'=>date('Y-m-d h:i:s'));
           $lv_details->share_details = $share_details;
           $share_count = $lv_details->share_count+1;
           $share_details = json_encode($share_details);
           $status = DB::table($this->rest->tbl_lv_like_share)->where('lv_id',$lv_id)->update(array('share_details'=>$share_details,'share_count'=>$share_count));
           if($status>=1)
           {
             return true;
           }
           else
           {
             return false;
           }
        }
       
    }

    function view_lv($lv_id,$user_id)
    {        
        $lv_details = DB::table($this->rest->tbl_lv_like_share)->select('view_count','view_details')->where('lv_id',$lv_id)->get()->first();
        if(!empty($lv_details))
        {
           $view_details = (!empty($lv_details->view_details))?json_decode($lv_details->view_details):array();           
           $is_it = 0;
           foreach ($view_details as $value)
           {
              if($value->user_id==$user_id)
                  $is_it = 1;
           }                       
           if($is_it===1) return 2;                               
           $view_details[] = array('user_id'=>$user_id,'date_time'=>date('Y-m-d h:i:s'));
           $lv_details->view_details = $view_details;
           $view_count = $lv_details->view_count+1;
           $view_details = json_encode($view_details);
           $status = DB::table($this->rest->tbl_lv_like_share)->where('lv_id',$lv_id)->update(array('view_details'=>$view_details,'view_count'=>$view_count));           
           if($status>=1)
           {            
             $data = array('last_activity'=>'view','last_activity_user_id'=>$user_id,'updated_at'=>date('Y-m-d h:i:s'));
             $this->rest->update_values($this->rest->tbl_localvocals,array('lv_id'=>$lv_id),$data);
             return true;
           }
           else
           {
             return false;
           }
        }
       
    }

    function get_activity_count($lv_id,$field)
    {
       $result = DB::table($this->rest->tbl_lv_like_share)->select($field)->where('lv_id',$lv_id)->first();
       if(!empty($result))
          return $result->$field;
        else
          return 0;
    }

    function check_user_like($lv_id,$user_id)
    {
      $result = DB::table($this->rest->tbl_lv_like_share)->select('like_details')->where('lv_id',$lv_id)->first();
      if(!empty($result))
      {
         $like_details = (!empty($result->like_details))? json_decode($result->like_details):array();                
         $is_it = 0;
         foreach ($like_details as $value)
         {
            if($value->user_id==$user_id)
                return 1;            
         }
         return 0;
      }
      else
          return 0;
    }

    function get_lv_comment($lv_id)
    {
       $qry_response = DB::table($this->rest->tbl_lv_comments)->select('lv_comments.user_id','lv_comments.comment','lv_comments.created_at','users.facebook_profile_dp','users.google_profile_dp','users.dp_changed','users.profile_pic','users.is_online','users.name')
                            ->where('lv_comments.lv_id',$lv_id)
                            ->join('users', 'users.user_id', '=', 'lv_comments.user_id')                            
                            ->get();
        //return $qry_response;                    
        $result = array();       
        foreach ($qry_response as $value)
        {
           $image_path = $this->rest->get_aws_baseurl().'profile/';
           $thumb_path = $this->rest->get_aws_baseurl().'profile/thumb/';
           //$images = $value->profile_picture;          
           $result[] = array('user_id'=>$value->user_id,'name'=>$value->name,'dp_changed'=>$value->dp_changed,'facebook_profile_dp'=>$value->facebook_profile_dp,'google_profile_dp'=>$value->google_profile_dp,'profile_pic'=>$value->profile_pic,'is_online'=>$value->is_online,'comment'=>$value->comment,'image_path'=>$image_path,'thumb_path'=>$thumb_path,'created_at'=>$value->created_at); 
        }
        return $result;
    }


    function delete_lv_comment($comment_id,$user_id,$lv_id)
    {
        
        
        $status = DB::table($this->rest->tbl_lv_comments)
        ->where('id', '=', $comment_id)
        ->where ('lv_id', '=', $lv_id)
        ->where('user_id', '=', $user_id)
        ->update(array('is_delete'=>1));
        
        if($status>=1)
           {
            
             return "Comment Deleted";
           }
           else
           {
               
               return "Something went wrong, Can't delete comment";
           }
           
    }
    
    
}


