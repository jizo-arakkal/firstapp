<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RestController;

class Broadcast extends Model
{   
    public function __construct()
    {
        $this->rest = new RestController();        
    }
    
    
    public function get_bc($user_id,$start,$end,$lat,$long,$categories,$location='',$search_keyword='')
    {
        
        //DB::enableQueryLog();
       //$where = array('blocked_by_admin'=>0,'user_status'=>1);
       $categories = (!empty($categories))?json_decode($categories):array();
       $cat_where = '';
       for ($i=0; $i < count($categories) ; $i++)
       { 
            if($i==count($categories)-1)
                $cat_where .= "FIND_IN_SET(".$categories[$i].",broadcasts.cat_id)"; 
            else 
                $cat_where .= "FIND_IN_SET(".$categories[$i].",broadcasts.cat_id) OR ";   
       }
       $cat_where = (!empty($cat_where))?'( '.$cat_where.' )':' 1=1 ';
       $rad_sel = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(broadcasts.latitude) ) * cos( radians( broadcasts.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(broadcasts.latitude))) ) AS distance';

        $rad_where = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(broadcasts.latitude) ) * cos( radians( broadcasts.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(broadcasts.latitude))) ) <= 20 ';
        
      
       $search_where = (!empty($search_keyword))?'(broadcasts.description like "%'.$search_keyword.'%"")':'1=1';
       if(!empty($location))
       {
          $qry_response = Broadcast::select('broadcasts.*','users.profile_picture','users.is_online','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp')
                            ->selectRaw($rad_sel)
                            ->join('users', 'users.user_id', '=', 'broadcasts.user_id')
                            ->whereRaw($cat_where)
                            ->whereRaw($search_where)
                            ->where('broadcasts.location','like','%'.$location.'%')
                            /*->where($where)*/
                            ->orderBy('distance','asc')
                            ->offset($start)
                            ->limit($end)
                            ->get();
       }
       else
       {
          $qry_response = Broadcast::select('broadcasts.*','users.profile_picture','users.is_online','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp')
                            ->selectRaw($rad_sel)
                            ->join('users', 'users.user_id', '=', 'broadcasts.user_id')
                            ->whereRaw($cat_where)
                            ->whereRaw($rad_where)
                            ->whereRaw($search_where)
                            /*->where($where)*/
                            ->orderBy('distance','asc')
                            ->offset($start)
                            ->limit($end)
                            ->get();
       }
       

        return $qry_response; 
        
    }
    

}