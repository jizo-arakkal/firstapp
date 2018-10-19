<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RestController;

class Swap extends Model
{   
    public function __construct()
    {
        $this->rest = new RestController();        
    }
    public function get_swap($user_id,$start,$end,$lat,$long,$categories,$location='',$search_keyword='')
    {
        //DB::enableQueryLog();
       //$where = array('blocked_by_admin'=>0,'user_status'=>1);
       $categories = (!empty($categories))?json_decode($categories):array();
       $cat_where = '';
       for ($i=0; $i < count($categories) ; $i++)
       { 
            if($i==count($categories)-1)
                $cat_where .= "FIND_IN_SET(".$categories[$i].",swaps.cat_id)"; 
            else 
                $cat_where .= "FIND_IN_SET(".$categories[$i].",swaps.cat_id) OR ";   
       }
       $cat_where = (!empty($cat_where))?'( '.$cat_where.' )':' 1=1 ';
       $rad_sel = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(swaps.latitude) ) * cos( radians( swaps.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(swaps.latitude))) ) AS distance';

        $rad_where = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(swaps.latitude) ) * cos( radians( swaps.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(swaps.latitude))) ) <= 20 ';
       $search_where = (!empty($search_keyword))?'(swaps.title like "%'.$search_keyword.'%"")':'1=1';
       if(!empty($location))
       {
          $qry_response = Swap::select('swaps.swap_id','swaps.user_id','swaps.title','swaps.description','swaps.images','swaps.cat_id','swaps.location','swaps.for_goods','swaps.for_services','swaps.for_price','swaps.for_any','swaps.for_free','swaps.created_at','users.is_online','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp')
                            ->selectRaw($rad_sel)
                            ->join('users', 'users.user_id', '=', 'swaps.user_id')
                            ->whereRaw($cat_where)
                            ->whereRaw($search_where)
                            ->where('swaps.location','like',$location)
                            /*->where($where)*/
                            ->orderBy('distance','asc')
                            ->offset($start)
                            ->limit($end)
                            ->get();
       }
       else
       {
          $qry_response = Swap::select('swaps.swap_id','swaps.user_id','swaps.title','swaps.description','swaps.images','swaps.cat_id','swaps.location','swaps.for_goods','swaps.for_services','swaps.for_price','swaps.for_any','swaps.for_free','swaps.created_at','users.is_online','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp')
                            ->selectRaw($rad_sel)
                            ->join('users', 'users.user_id', '=', 'swaps.user_id')
                            ->whereRaw($cat_where)
                            ->whereRaw($rad_where)
                            ->whereRaw($search_where)
                            /*->where($where)*/
                            ->orderBy('distance','asc')
                            ->offset($start)
                            ->limit($end)
                            ->get();
       }
       
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
        return $result; 
        
    }

    public function get_swap_detail($swap_id,$lat,$long)
    {
       //DB::enableQueryLog();  
       $rad_sel = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(swaps.latitude) ) * cos( radians( swaps.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(swaps.latitude))) ) AS distance';     
       $qry_response = Swap::select('swaps.swap_id','swaps.user_id','swaps.title','swaps.description','swaps.images','swaps.cat_id','swaps.location','swaps.for_goods','swaps.for_services','swaps.for_price','swaps.for_any','swaps.for_free','swaps.created_at','users.profile_picture','users.is_online','users.name','users.mobile')
                            ->selectRaw($rad_sel)
                            ->where('swap_id',$swap_id)
                            ->join('users', 'users.user_id', '=', 'swaps.user_id')
                            ->get();
        //print_r( DB::getQueryLog());
        $result = array();       
        foreach($qry_response as $value)
        {
           $image_path = $this->rest->get_aws_baseurl().'swap/';
           $thumb_path = $this->rest->get_aws_baseurl().'swap/thumb/';
           $images = explode(',', $value->images);
           $view_count = 0;
           $result = array('swap_id'=>$value->swap_id,'user_id'=>$value->user_id,'name'=>$value->name,'mobile'=>$value->mobile,'profile_picture'=>$value->profile_picture,'is_online'=>$value->is_online,'title'=>$value->title,'description'=>$value->description,'images'=>$images,'thumbs'=>$images[0],'image_path'=>$image_path,'thumb_path'=>$thumb_path,'cat_id'=>explode(',', $value->cat_id),'location'=>$value->location,'for_goods'=>$value->for_goods,'for_services'=>$value->for_services,'for_price'=>$value->for_price,'for_any'=>$value->for_any,'for_free'=>$value->for_free,'created_at'=>$value->created_at->diffForHumans(),'view_count'=>$view_count,'distance'=>number_format($value->distance,2).'Km away'); 
        }
        return $result;         
    }

    function get_swap_suggestion($user_id,$swap_id,$lat,$long,$location)
    {    
       $rad_sel = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(swaps.latitude) ) * cos( radians( swaps.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(swaps.latitude))) ) AS distance';

       $rad_where = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(swaps.latitude) ) * cos( radians( swaps.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(swaps.latitude))) ) <= 20 ';
      
       $qry_response = Swap::select('swaps.swap_id','swaps.user_id','swaps.title','swaps.description','swaps.images','swaps.cat_id','swaps.location','swaps.for_goods','swaps.for_services','swaps.for_price','swaps.for_any','swaps.for_free','swaps.created_at','users.profile_picture','users.is_online')
                            ->selectRaw($rad_sel)
                            ->join('users', 'users.user_id', '=', 'swaps.user_id')
                            ->whereRaw($rad_where)
                            ->whereNotIn('swap_id', array($swap_id))
                            ->orderBy('distance','asc')
                            ->offset(0)
                            ->limit(4)
                            ->get();       
        $result = array();
        //print_r( DB::getQueryLog());
        foreach ($qry_response as $value)
        {
           $image_path = $this->rest->get_aws_baseurl().'swap/';
           $thumb_path = $this->rest->get_aws_baseurl().'swap/thumb/';          
           $images = explode(',', $value->images);
           $result[] = array('swap_id'=>$value->swap_id,'user_id'=>$value->user_id,'profile_picture'=>$value->profile_picture,'is_online'=>$value->is_online,'title'=>$value->title,'description'=>$value->description,'images'=>$images,'thumbs'=>$images[0],'image_path'=>$image_path,'thumb_path'=>$thumb_path,'cat_id'=>explode(',', $value->cat_id),'location'=>$value->location,'for_goods'=>$value->for_goods,'for_services'=>$value->for_services,'for_price'=>$value->for_price,'for_any'=>$value->for_any,'for_free'=>$value->for_free,'created_at'=>$value->created_at->diffForHumans(),'distance'=>number_format($value->distance,2).' Km'); 
        }
        return $result; 

    }

}

