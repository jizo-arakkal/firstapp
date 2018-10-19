<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response;
use Illuminate\Support\Facades\Log;
use App\Http\Models\User;
use App\Http\Models\UserDetail;
use App\Http\Models\Localvocal;
use App\Http\Models\Broadcast;
use App\Http\Models\Swap;
use App\Http\Models\Message;

// use App\Broadcast;
use DB;
use OAuth;
use Redirect;
use Auth;
use DateTime;
use Hash;
use Share;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        
    	$this->rest = new RestController();
    	$this->Smail = new MailController();
    	$this->s3 = new S3Controller();
    	$this->user = new User();
    	$this->bc = new Broadcast();    	
    } 
    
    function get_neighbouring_data($lat,$long,$dist)
    {
        $results = DB::table('broadcasts')
                        ->select('broadcasts.*')
                        ->get();
                        
        $array1=array();
        $array2=array();
        // Return all results as per Requirement
        
        foreach ($results as $row) 
        {
       
                
            $to_latitude= $row->latitude;
            $to_longitude= $row->longitude;
            $location= $row->location;
            //   $latFrom = deg2rad(9.9385818);
            //   $lonFrom = deg2rad(76.180345);
               $latFrom = deg2rad($lat);
              $lonFrom = deg2rad($long);
              $latTo = deg2rad($to_latitude);
              $lonTo = deg2rad($to_longitude);
            
              $latDelta = $latTo - $latFrom;
              $lonDelta = $lonTo - $lonFrom;
              $earthRadius = 6371000;
              $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
              $result= $angle * $earthRadius/1000;
             // array_push($array1,$row->id);
              //dd($result);
              if($result<$dist)
              {
                  
                  array_push($array1,$row->id);
                
              }
        }
                
        return $array1;
    }
function get_neighbouring_swap_data($lat,$long,$dist)
    {
        //dd($lat.'-'.$long.'-'.$dist);
        $results = DB::table('swaps')
                        ->select('swaps.*')
                        ->get();
                        
        $array1=array();
        $array2=array();
        // Return all results as per Requirement
        
        foreach ($results as $row) 
        {
       
                
            $to_latitude= $row->latitude;
            $to_longitude= $row->longitude;
            $location= $row->location;
            //   $latFrom = deg2rad(9.9385818);
            //   $lonFrom = deg2rad(76.180345);
               $latFrom = deg2rad($lat);
              $lonFrom = deg2rad($long);
              $latTo = deg2rad($to_latitude);
              $lonTo = deg2rad($to_longitude);
            
              $latDelta = $latTo - $latFrom;
              $lonDelta = $lonTo - $lonFrom;
              $earthRadius = 6371000;
              $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
              $result= $angle * $earthRadius/1000;
             // array_push($array1,$row->id);
              //dd($result);
              if($result<$dist)
              {
                  
                  array_push($array1,$row->id);
                
              }
        }
                
        return $array1;
        //dd($array1);
    }
    function get_neighbouring_localvocal_data($lat,$long,$dist)
    {
        //dd($lat.'-'.$long.'-'.$dist);
        $results = DB::table('localvocals')
                        ->select('localvocals.*')
                        ->get();
                        
        $array1=array();
        $array2=array();
        // Return all results as per Requirement
        
        foreach ($results as $row) 
        {
       
                
            $to_latitude= $row->latitude;
            $to_longitude= $row->longitude;
            $location= $row->location;
            //   $latFrom = deg2rad(9.9385818);
            //   $lonFrom = deg2rad(76.180345);
               $latFrom = deg2rad($lat);
              $lonFrom = deg2rad($long);
              $latTo = deg2rad($to_latitude);
              $lonTo = deg2rad($to_longitude);
            
              $latDelta = $latTo - $latFrom;
              $lonDelta = $lonTo - $lonFrom;
              $earthRadius = 6371000;
              $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
              $result= $angle * $earthRadius/1000;
             // array_push($array1,$row->id);
              //dd($result);
              if($result<$dist)
              {
                  
                  array_push($array1,$row->id);
                
              }
        }
                
        return $array1;
    }
    public function index(Request $request)
    {   
        //return  "The time is " . date("h:i:sa");
        //return $request->type;
        	$ip = $_SERVER['REMOTE_ADDR'];
        //	http://freegeoip.net/{format}/{ip_or_hostname}
        $type = $request->input('type');
         $cat = $request->input('cat');
         $keyword = $request->input('keyword');
         $location = $request->input('location');
         $dist = $request->input('distance');
         if($dist=='')
         {
             $dist=5;
         }
         //dd($location);
         if($location == "Select City")
            $location = "";
         //return $location;
         if(!empty($location))
        {
         // return $location;
         $data = $this->get_latlong_from_loc($location);
       
       
       $lat = $data['lat'];
        $long = $data['long'];
        
         //return $lat;   
        }
         else
         {
      
        $data = $this->locate();
        
        
       // 12.9538477,77.3507369,10z
        
        $lat = $data['latitude'];
        $long = $data['longitude'];
        //dd($lat);
         }
        // description like '%$keyword%'"
        $search_where_bc = "description like '%$keyword%'";
        
        //return $lat;
        
        
        $search_where_sw = "description like '%".$keyword."%' OR title like '%$keyword%'";
        //$search_where_sw = "";
        $search_where_lv = "description like '%$keyword%' OR title like '%$keyword%'";
        




        $rad_sel_sw = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(swaps.latitude) ) * cos( radians( swaps.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(swaps.latitude))) ) AS distance';
        $rad_where_sw = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(swaps.latitude) ) * cos( radians( swaps.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(swaps.latitude))) ) <= 1 ';
    
        $rad_sel_lv = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(localvocals.latitude) ) * cos( radians( localvocals.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(localvocals.latitude))) ) AS distance';
        $rad_where_lv = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(localvocals.latitude) ) * cos( radians( localvocals.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(localvocals.latitude))) ) <= 1 ';
      
         
         if(empty($cat) || $cat == 1 || $cat == "")
         {
         $cat_where_bc = '1=1';
         $cat_where_sw = '1=1';
         $cat_where_lv = '1=1';
         }
         else
         {
        
         
         $cat_where_bc = "find_in_set(".$cat.",broadcasts.cat_id)" ;
          $cat_where_sw = "find_in_set(".$cat.",swaps.cat_id)" ;
          //return $cat_where_sw;
           $cat_where_lv = "find_in_set(".$cat.",localvocals.cat_id)" ;
         }
        //return $rad_sel;
      if(!empty($location))
      {
          
        
               $array1= $this->get_neighbouring_data($lat,$long,$dist);

            if(Auth::user())
            {
          
                        
                        
                $broadcasts = DB::table('broadcasts')
        			->select('broadcasts.*', 'users.name', 'users.last_name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
        		//	->selectRaw($rad_sel_bc)
                    ->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
                     //->Where('descrption', 'like', '"%' . $keyword . '%"')
                       ->whereRaw($search_where_bc)
                      //->whereRaw($rad_where_bc)
                       ->whereRaw($cat_where_bc)
                      ->where('broadcasts.user_id', '<>', Auth::user()->user_id)
                      ->where('broadcasts.current_broadcast', '=', 1)
                      ->whereIn('broadcasts.id',$array1)
                        // ->orderBy('distance','asc')
                     
                    //->Where('name', 'like', '%' . Input::get('name') . '%')->get();
                     ->paginate(5);
                    //->get();
                     //dd($broadcasts);
                         
                 
                 
                 
            }
            else
            {
              
                 $broadcasts = DB::table('broadcasts')
        			->select('broadcasts.*', 'users.name', 'users.last_name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
        		//	->selectRaw($rad_sel_bc)
                    ->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
                    // ->Where('descrption', 'like', '"%' . $keyword . '%"')
                       ->whereRaw($search_where_bc)
                      //->whereRaw($rad_where_bc)
                       ->whereRaw($cat_where_bc)
                      //->where('broadcasts.user_id', '<>', Auth::user()->user_id)
                      ->whereIn('broadcasts.id',$array1)
                      ->where('broadcasts.current_broadcast', '=', 1)
                        // ->orderBy('distance','asc')
                     
                    //->Where('name', 'like', '%' . Input::get('name') . '%')->get();
                     ->paginate(5);
                    //->get();
                     //dd($broadcasts);
                
          
                
                
                
            }

    
      }
      else
      {
            $array1= $this->get_neighbouring_data($lat,$long,$dist);
            if(Auth::user())
            {  
                $broadcasts = DB::table('broadcasts')
    			->select('broadcasts.*', 'users.name', 'users.last_name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
    		//	->selectRaw($rad_sel_bc)
                ->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
                // ->Where('descrption', 'like', '"%' . $keyword . '%"')
                   ->whereRaw($search_where_bc)
                  //->whereRaw($rad_where_bc)
                   ->whereRaw($cat_where_bc)
                  ->where('broadcasts.user_id', '<>', Auth::user()->user_id)
                  ->whereIn('broadcasts.id',$array1)
                  ->where('broadcasts.current_broadcast', '=', 1)
                    // ->orderBy('distance','asc')
                 
                //->Where('name', 'like', '%' . Input::get('name') . '%')->get();
                 ->paginate(5);
                //->get();
                 //dd($broadcasts);
            }
            else
            {
                $broadcasts = DB::table('broadcasts')
    			->select('broadcasts.*', 'users.name', 'users.last_name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
    		//	->selectRaw($rad_sel_bc)
                ->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
                // ->Where('descrption', 'like', '"%' . $keyword . '%"')
                   ->whereRaw($search_where_bc)
                  //->whereRaw($rad_where_bc)
                   ->whereRaw($cat_where_bc)
                 // ->where('broadcasts.user_id', '<>', Auth::user()->user_id)
                  ->whereIn('broadcasts.id',$array1)
                  ->where('broadcasts.current_broadcast', '=', 1)
                    // ->orderBy('distance','asc')
                 
                //->Where('name', 'like', '%' . Input::get('name') . '%')->get();
                 ->paginate(5);
                //->get();
                 //dd($broadcasts);
                 
            }
      }   
       
       $html=''; 
         foreach ($broadcasts as $broadcast) {
            $html.='<div class="btm_user_listing_wrap">';
            $html.= '<div class="btm_user_listing">';
            $html.= '<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">';
            $html.= ' <div class="wh_profile_pic_btm">';
            if($broadcast->is_online == 1)
            {
            $html.= '<span class="wh_profile_pic_top_active">';
            $html.= '<i class="fa fa-circle"></i>';
            $html.= '</span>';
            }
            
            $str = $broadcast->location;
            $arr = explode(",",$str);
            $str1 = implode("-",$arr);
            $arr1 = explode(" ",$str1);
            $str2 = implode("-",$arr1);
            $arr2 = explode("--",$str2);
            
            if (isset($arr2[2]) && !empty($arr2[3])) {
                $full_location = $arr2[2]."-".$arr2[3];    
            }else{  
                $full_location = implode("-",$arr2);
            }
            
            $namer=$broadcast->name.".".$broadcast->last_name."-".$full_location;
            $html.= '<a href='.Helper::get_url().'/user/'.$broadcast->user_id.'/'.$namer.'>';
            
            if($broadcast->dp_changed == 1)
            $html.= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$broadcast->profile_pic.'></a>';
            elseif($broadcast->facebook_profile_dp != NULL)
            $html.= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$broadcast->facebook_profile_dp.'></a>';
            elseif($broadcast->google_profile_dp != NULL)
            $html.= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$broadcast->google_profile_dp.'></a>';
            else
            $html.= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src="images/profile.png"></a>';
            
            $html.= '</div>';
            
            $html.= '<p class="distance">';
            $loc_arr = explode(",",$broadcast->location);
            
            if(count($loc_arr)>=2)
            {
            $location_new = $loc_arr[0].",".$loc_arr[1];
            $html.= $location_new.'</p>';
            }
            else
            $html.= $loc_arr[0].'</p>';
            
            $html.= '</div>';
            $html.= '<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">';
            $html.= '<div class="wh_name_btm">';
            $str = $broadcast->location;
            $arr = explode(",",$str);
            $str1 = implode("-",$arr);
            $arr1 = explode(" ",$str1);
            $str2 = implode("-",$arr1);
            $arr2 = explode("--",$str2);
            
            if (isset($arr2[2]) && !empty($arr2[3])) {
                $full_location = $arr2[2]."-".$arr2[3];    
            }else{  
                $full_location = implode("-",$arr2);
            }
            
            $namer=$broadcast->name.".".$broadcast->last_name."-".$full_location;
            $html.= '<a href='.Helper::get_url().'/user/'.$broadcast->user_id.'/'.$namer.'>';
            $html.= '<p>'.$broadcast->name.'</p>';
            $html.= '</a>';
            $html.= '</div>';
            $html.= '<div class="wh_brdcast_btm">';
            $html.= $broadcast->description;
            $html.= '</div>';
            $html.= '</div>';
             $temp_id = substr($broadcast->broadcast_id,2);
            $html.= '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">';
            if(Auth::user())
            //$html.= '<button onclick="new_chat('.$temp_id.',1)" class="btn btn-chat-btm pull-right col-lg-12 col-md-12 col-sm-12 col-xs-12">CHAT</button>';
            $html.= '<button id="open_chat" onclick="open_chat1('.$temp_id.',1)" class="btn btn-chat-btm pull-right col-lg-12 col-md-12 col-sm-12 col-xs-12">CHAT</button>';
            else
            $html.= '<button onclick="show_login_form()" class="btn btn-chat-btm pull-right col-lg-12 col-md-12 col-sm-12 col-xs-12">CHAT</button>';
            $html.= '<div class="clearfix"></div>';
            $html.= '</div>';

            $html.= '<div class="clearfix"></div>';
            $html.= '</div>';
            $html.= '<div class="clearfix"></div>';
            $html.= '</div>';
            
        }
       // return $broadcasts;
       
        if ($request->ajax() && $type == "Broadcast") {
          
            return $html;
        }
        
        
        
        
        
        if(!empty($location))
        
        {
        
         if($request->input('keyword')=='')
         {
            $arrayswap=$this->get_neighbouring_swap_data($lat,$long,$dist);
            
            
              
           // dd($arrayswap);
        $swaps = DB::table('swaps')
			->select('swaps.*', 'users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
		    	->whereIn('swaps.id',$arrayswap)
		    //	->whereRaw($search_where_sw)
		    	
// 		    	->whereRaw($search_where_sw)
			
 			->whereRaw($cat_where_sw)
		->leftJoin('users', 'swaps.user_id', '=', 'users.user_id')
		    
		
            
            //->orderBy('distance','asc')
            ->paginate(5); 
            
         }
         else
         {
             $arrayswap=$this->get_neighbouring_swap_data($lat,$long,$dist);
               $swaps = DB::table('swaps')
			->select('swaps.*', 'users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
			
		    	->whereIn('swaps.id',$arrayswap)
		    	->whereRaw($search_where_sw)
		    	
// 		    	->whereRaw($search_where_sw)
			
 			->whereRaw($cat_where_sw)
		    ->leftJoin('users', 'swaps.user_id', '=', 'users.user_id')
		    
		
            
            //->orderBy('distance','asc')
            ->paginate(5); 
         }
            
            
            
            

            
       
        }
        else
        {
            $arrayswap=$this->get_neighbouring_swap_data($lat,$long,$dist);
           // dd($arrayswap);
        $swaps = DB::table('swaps')
			->select('swaps.*', 'users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
		
		
		    /////->whereRaw($search_where_sw)
			
			/////->whereRaw($cat_where_sw)
			->whereIn('swaps.id',$arrayswap)
            ->leftJoin('users', 'swaps.user_id', '=', 'users.user_id')
            //->orderBy('distance','asc')
            ->paginate(5); 
            //dd($swaps);
            //dd('qweqwe');
        }
        
        $sw_tagstring  = '';
       $current_date = date('Y-m-d H:i:s', time());
       //dd($swaps);
        foreach ($swaps as $swap) 
	    {
	    $loc_arr = explode(",",$swap->location);
        if(count($loc_arr)>2)
        $location = $loc_arr[0]." ".$loc_arr[1];     
	     $temp_title = preg_replace('/\s+/', '-', $location.'-'.$swap->title);    
        $sw_tagstring.='<li>';
     
        $sw_tagstring.='<div class="swap_list_item sw_normal_item">';
        $sw_tagstring.='<div class="swap_list_item_top">';
        
        
        if($swap->for_price!=null && $swap->for_goods!=null)
        {
        $sw_tagstring.='<span style="z-index: 1;" class="price_tag"><i aria-hidden="true" class="fa fa-inr"></i>&nbsp;'.$swap->for_price.' or '. $swap->for_goods .'</span>';
        }
        else if($swap->for_price!=null && $swap->for_goods==null)
        {
          $sw_tagstring.='<span style="z-index: 1;" class="price_tag"><i aria-hidden="true" class="fa fa-inr"></i>&nbsp;'. $swap->for_price .'</span>';   
            
        }
         else if($swap->for_price==null && $swap->for_goods!=null)
        {
        $sw_tagstring.='<span style="z-index: 1;" class="price_tag">'. $swap->for_goods .'</span>';
        }
        else if($swap->for_any == 1)
        {
          $sw_tagstring.='<span style="z-index: 1;" class="price_tag">Open for Anything</span>';   
        }
        else if($swap->for_free == 1)
        {
            
          $sw_tagstring.='<span style="z-index: 1;" class="price_tag">For Free</span>';
        }
        $img_arr = explode(",",$swap->images);
        //$image = $img_arr[0];
        
        
            $str = $swap->location;
            $arr = explode(",",$str);
            $str1 = implode("-",$arr);
            $arr1 = explode(" ",$str1);
            $str2 = implode("-",$arr1);
            $arr2 = explode("--",$str2);
            
            if (isset($arr2[2]) && !empty($arr2[3])) {
                $full_location = $arr2[2]."-".$arr2[3];    
            }else{  
                $full_location = implode("-",$arr2);
            }
            
            $swap_title_str = $swap->title;
            $swap_title_arr = explode(" ",$swap_title_str);
            $swap_title_str1 = implode("-",$swap_title_arr);
            
        
        
        
        $sw_tagstring .='<a href='.Helper::get_url().'/swap/'.strtolower($swap->swap_id).'-'.$swap_title_str1.'-'.$full_location.'-'.strtolower($swap->swap_id).'>';
        $sw_tagstring .= '<div class="sw_detail_thumb">';                            
        $sw_tagstring .= '<div class="swap_slider" style="margin:0px 0px;">';
        $sw_tagstring .= '<div id="carousel-custom'.$swap->swap_id.'" class="carousel slide" data-ride="carousel">';
        $sw_tagstring .= '<div class="carousel-outer">';
        
        $sw_tagstring .= '<div class="carousel-inner">';
        
        for ($i = 0; $i < count($img_arr); $i++)
        {
            if ($i==0)
            {
                $sw_tagstring .= '<div class="item active">';
                //$lv_tagstring .= '<img src="{{(new \App\Http\Controllers\Helper)->get_lv_image_loc()}}{{$images[$i]}}" alt="">';
                $sw_tagstring .='<img style="height: auto !important;"  src='.Helper::get_swap_image_loc().$img_arr[$i].' alt="">';
                $sw_tagstring .= '</div>';
            }
            else
            {
                $sw_tagstring .= '<div class="item">';
                //$lv_tagstring .= '<img src="{{(new \App\Http\Controllers\Helper)->get_lv_image_loc()}}{{$images[$i]}}" alt="">';
                $sw_tagstring .='<img style="height: auto !important;" src='.Helper::get_swap_image_loc().$img_arr[$i].' alt="">';
                $sw_tagstring .= '</div>';
            }
        }
    
        $sw_tagstring .= '</div>';            
        if(count($img_arr) > 1)
        {
        $sw_tagstring .= '<a class="left carousel-control" href="#carousel-custom'.$swap->swap_id.'" data-slide="prev">';
        $sw_tagstring .= '<span class="fa fa-chevron-left"></span>';
        $sw_tagstring .= '</a>';
        $sw_tagstring .= '<a class="right carousel-control" href="#carousel-custom'.$swap->swap_id.'" data-slide="next">';
        $sw_tagstring .= '<span class="fa fa-chevron-right"></span>';
        $sw_tagstring .= '</a>';
        }
        $sw_tagstring .= '</div>';                            
        
        
        
        $sw_tagstring .= '</div>';
        $sw_tagstring .= '</div>';
        $sw_tagstring .= '</div>';
        
        $sw_tagstring .= '</a>';
        
        
       /* 
        
         $sw_tagstring .='<a target="_blank" href='.Helper::get_url().'/swap/'.$temp_title.'-'.$swap->swap_id.'>';
        $sw_tagstring .='<img src='.Helper::get_swap_image_loc().$image.' alt="">';
        $sw_tagstring .= '</a>';
                                                
        
        
        */
        
        
        
        
        
        $sw_tagstring .='</div>';
        $sw_tagstring .='<div class="swap_list_item_btm">';
        $sw_tagstring .='<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 swap_prof_pic_wrap">';
        if($swap->is_online == 1)
        {
        $sw_tagstring .='<span class="swap_prof_online_batch"><i class="fa fa-circle"></i></span>';
        }
        
        
        /*$sw_tagstring .='<img src="images/profile.png">';*/
        
        $sw_tagstring .= '<a href='.Helper::get_url().'/user/'.$swap->user_id.'>';
            
        if($swap->dp_changed == 1)
        $sw_tagstring .= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$swap->profile_pic.'></a>';
        elseif($swap->facebook_profile_dp != NULL)
       $sw_tagstring .= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$swap->facebook_profile_dp.'></a>';
        elseif($swap->google_profile_dp != NULL)
        $sw_tagstring .= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$swap->google_profile_dp.'></a>';
        else
        $sw_tagstring .= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src="images/profile.png"></a>';
            
        //return $swap->location;
        $loc_arr = explode(",",$swap->location);
        if(count($loc_arr)>=2)
        {
        $location_new = $loc_arr[0].",".$loc_arr[1];
        $sw_tagstring.= '<p>'.$location_new.'</p>';
        }
        else
        $sw_tagstring.= '<p>'.$loc_arr[0].'</p>';
        //return $location;
        
        //$sw_tagstring .='<p>'.$swap->location.'</p>';
        $sw_tagstring .='</div>';
        $sw_tagstring .='<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 swap_title_wrap">';
       // $sw_tagstring .='<h4><a target="_blank" href='.Helper::get_swap_image_loc().$swap->swap_id.'>'.$swap->title.'</a></h4>';
       
       
       
       
      // $temp_title = $swap_title;
       $sw_tagstring .='<h4><a href='.Helper::get_url().'/swap/'.$temp_title.'-'.$swap->swap_id.'>'.$swap->title.'</a></h4>';
        
        
        $datetime1 = new DateTime($swap->created_at);
        $datetime2 = new DateTime($current_date);
        $interval = $datetime1->diff($datetime2);
        if($interval->d != 0)
        {
        $string = $interval->d > 1 ? " days ago" : " day ago";
        $swap->ago = $interval->d.$string;
        }
        elseif($interval->d == 0)
        {
             if($interval->h != 0)
             {
                $string = $interval->h > 1 ? " hours ago" : " hour ago";
                $swap->ago = $interval->h .$string;
             }
             else if($interval->m != 0)
             {
                $string = $interval->m > 1 ? " minutes ago" : " minute ago";
                $swap->ago = $interval->m .$string;
             }
             else
             {
                $string = $interval->s > 1 ? " seconds ago" : " second ago";
                $swap->ago = $interval->s .$string;
             }
        }
        
        
        $sw_tagstring .='<p>'.$swap->ago.'</p>';
        if($swap->is_paid == 1)
        $sw_tagstring.='<br/><span style="color:  yellow;background:  none;border-style:  solid;padding:  3px;border-width:  1px;float: right;"><i class="fa fa-star" aria-hidden="true"></i>&nbsp;&nbsp;<b>Sponsored</b></span>';
        
        //$ago = 1;
        //$sw_tagstring .='<p>'.$ago.'</p>';
        $sw_tagstring .='</div>';
        $sw_tagstring .='<div class="clearfix"></div>';
        $sw_tagstring .='</div>';
        $sw_tagstring .='</div>';
        
        $sw_tagstring .='</li>';
        }
         //return $sw_tagstring;
         //return $sw_tagstring;   
         if ($request->ajax() && $type == "Swap") {
            
            //return 1;
           return $sw_tagstring;
        }
    
    /*if($keyword =="")
    {
    $localvocals = DB::table('localvocals')
			->select('localvocals.*', 'users.name','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online','users.dp_changed')
			->whereRaw($cat_where_lv)
			 ->whereRaw($search_where_lv)
            ->leftJoin('users', 'localvocals.user_id', '=', 'users.user_id')
            ->paginate(5); 
    }
    else
    {*/
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
      if(!empty($location))
        
        {
        
         if($request->input('keyword')=='')
         {
                   $arraylocalvocal=$this->get_neighbouring_localvocal_data($lat,$long,$dist);
    $localvocals = DB::table('localvocals')
			->select('localvocals.*', 'users.name','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online','users.dp_changed')
		
		    ->whereIn('localvocals.id',$arraylocalvocal)
		    ////->whereRaw($search_where_lv)
		   ->whereRaw($cat_where_lv)
		    ->whereIn('localvocals.id',$arraylocalvocal)
            ->leftJoin('users', 'localvocals.user_id', '=', 'users.user_id')
           // ->orderBy('distance','asc')
            ->paginate(5); 
            
         }
         else
         {
                   $arraylocalvocal=$this->get_neighbouring_localvocal_data($lat,$long,$dist);
    $localvocals = DB::table('localvocals')
			->select('localvocals.*', 'users.name','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online','users.dp_changed')
		
		    ->whereIn('localvocals.id',$arraylocalvocal)
		    ->whereRaw($search_where_lv)
		    ->whereRaw($cat_where_lv)
		    ->whereIn('localvocals.id',$arraylocalvocal)
            ->leftJoin('users', 'localvocals.user_id', '=', 'users.user_id')
           // ->orderBy('distance','asc')
            ->paginate(5); 
         }
            
            
            
            

            
       
        }
        else
        {
          
             $arraylocalvocal=$this->get_neighbouring_localvocal_data($lat,$long,$dist);
    $localvocals = DB::table('localvocals')
			->select('localvocals.*', 'users.name','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online','users.dp_changed')
		
		    ->whereIn('localvocals.id',$arraylocalvocal)
		    ////->whereRaw($search_where_lv)
		   //// ->whereRaw($cat_where_lv)
		    ->whereIn('localvocals.id',$arraylocalvocal)
            ->leftJoin('users', 'localvocals.user_id', '=', 'users.user_id')
           // ->orderBy('distance','asc')
            ->paginate(5); 
          
          
        }
    
    
    
    
    
    
    
    
    
    
    
    
//      $arraylocalvocal=$this->get_neighbouring_localvocal_data($lat,$long,$dist);
//     $localvocals = DB::table('localvocals')
// 			->select('localvocals.*', 'users.name','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online','users.dp_changed')
		
// 		    ->whereIn('localvocals.id',$arraylocalvocal)
// 		    ////->whereRaw($search_where_lv)
// 		   //// ->whereRaw($cat_where_lv)
// 		    ->whereIn('localvocals.id',$arraylocalvocal)
//             ->leftJoin('users', 'localvocals.user_id', '=', 'users.user_id')
//           // ->orderBy('distance','asc')
//             ->paginate(5); 


            //dd($arraylocalvocal);
    //}
            
    $lv_tagstring = '';
    $current_date = date('Y-m-d H:i:s', time());
    foreach ($localvocals as $localvocal) 
    {
    
    
    $lv_details = DB::table($this->rest->tbl_lv_like_share)->select('like_count','like_details')->where('lv_id',$localvocal->lv_id)->get()->first();
        //return var_dump($lv_details);
        if(!empty($lv_details))
        {
        //return "inside";
           $like_details = (!empty($lv_details->like_details))? json_decode($lv_details->like_details):array();
          // return $like_details;
           $update_data = array();          
           $is_it = 0;
           $localvocal->likes_count = count($like_details);
          
          if(Auth::user())
          {
           foreach ($like_details as $value)
           {
              if($value->user_id==Auth::user()->user_id)
                  $is_it = 1;
            
           }                       
           if($is_it===1)
           {
            
              $localvocal->like_status = "liked";
           }
           else
           {
            
             $localvocal->like_status = "none";
           }   
          }
          else
           $localvocal->like_status = "none";
                           
           
        }
        else
        {
             $localvocal->likes_count = 0;
             $localvocal->like_status = "none";
        }
    
    
    $comments = DB::table($this->rest->tbl_lv_comments)->select('lv_comments.user_id','lv_comments.comment','lv_comments.created_at','users.is_online','users.name','users.google_profile_dp','users.facebook_profile_dp','users.is_online','users.dp_changed','users.profile_pic')
                            ->where('lv_comments.lv_id',$localvocal->lv_id)
                            ->join('users', 'users.user_id', '=', 'lv_comments.user_id')  
                            ->limit(4)
                            ->orderBy('lv_comments.id')
                            ->get();

    $lv_tagstring .= '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">';
    $lv_tagstring .= '<div class="lv_post_list">';
    $lv_tagstring .= '<div class="lv_post_list_top">';
    $lv_tagstring .= '<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 lv_post_name">';
    
    
    
     if($localvocal->dp_changed == 1)
        $lv_tagstring .= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$localvocal->profile_pic.'></a>';
        elseif($localvocal->facebook_profile_dp != NULL)
       $lv_tagstring .= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$localvocal->facebook_profile_dp.'></a>';
        elseif($localvocal->google_profile_dp != NULL)
        $lv_tagstring .= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$localvocal->google_profile_dp.'></a>';
        else
        $lv_tagstring .= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src="images/profile.png"></a>';
    
    
   /* $lv_tagstring .= '<img src="images/profile.png">&nbsp;&nbsp;';*/
     $str = $localvocal->location;
            $arr = explode(",",$str);
            $str1 = implode("-",$arr);
            $arr1 = explode(" ",$str1);
            $str2 = implode("-",$arr1);
            $arr2 = explode("--",$str2);
            
            if (isset($arr2[2]) && !empty($arr2[3])) {
                $full_location = $arr2[2]."-".$arr2[3];    
            }else{  
                $full_location = implode("-",$arr2);
            }
            
            $swap_title_str = $localvocal->title;
            $swap_title_arr = explode(" ",$swap_title_str);
            $swap_title_str1 = implode("-",$swap_title_arr);
            
            
    
    $lv_tagstring .= '<a href='.Helper::get_url().'/lv/'.$localvocal->lv_id.'/'.$swap_title_str1.','.$full_location.'>';
    $lv_tagstring .='&nbsp;&nbsp;'.$localvocal->name;
     $lv_tagstring .= '</a>';
    $lv_tagstring .= '</div>';
    $lv_tagstring .= '<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 lv_post_time">';
     $loc_arr = explode(",",$localvocal->location);
     if(count($loc_arr)>=2)
     $localvocal->location = $loc_arr[0].",".$loc_arr[1];
     else
     $localvocal->location = $loc_arr[0];
     $lv_tagstring .= '<b><i style="color:  red;" class="fa fa-location-arrow" aria-hidden="true"></i>&nbsp;&nbsp;'.$localvocal->location.'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $datetime1 = new DateTime($localvocal->created_at);
    $datetime2 = new DateTime($current_date);
    $interval = $datetime1->diff($datetime2);
    if($interval->d != 0)
    {
    $string = $interval->d > 1 ? " days ago" : " day ago";
    $localvocal->ago = $interval->d.$string;
    }
    elseif($interval->d == 0)
    {
         if($interval->h != 0)
         {
            $string = $interval->h > 1 ? " hours ago" : " hour ago";
            $localvocal->ago = $interval->h .$string;
         }
         else if($interval->m != 0)
         {
            $string = $interval->m > 1 ? " minutes ago" : " minute ago";
            $localvocal->ago = $interval->m .$string;
         }
         else
         {
            $string = $interval->s > 1 ? " seconds ago" : " second ago";
            $localvocal->ago = $interval->s .$string;
         }
    }
    
    $lv_tagstring .= $localvocal->ago;
    //$lv_tagstring .= 1;
    $lv_tagstring .= '</div>';
    $lv_tagstring .= '<div class="clearfix"></div>';
    $lv_tagstring .= '</div>';
    /*$lv_tagstring .= '<div class="lv_post_list_thumb">';
    $img_arr = explode(",",$localvocal->images);
    $image = $img_arr[0];*/
    
    
    $str = $localvocal->location;
            $arr = explode(",",$str);
            $str1 = implode("-",$arr);
            $arr1 = explode(" ",$str1);
            $str2 = implode("-",$arr1);
            $arr2 = explode("--",$str2);
            
            if (isset($arr2[2]) && !empty($arr2[3])) {
                $full_location = $arr2[2]."-".$arr2[3];    
            }else{  
                $full_location = implode("-",$arr2);
            }
            
            $swap_title_str = $localvocal->title;
            $swap_title_arr = explode(" ",$swap_title_str);
            $swap_title_str1 = implode("-",$swap_title_arr);
            
            
    
    
    $image = explode(",",$localvocal->images);
    $lv_tagstring .= '<a href='.Helper::get_url().'/lv/'.$localvocal->lv_id.'/'.$swap_title_str1.','.$full_location.'>';
    $lv_tagstring .= '<div class="sw_detail_thumb">';                            
    $lv_tagstring .= '<div class="swap_slider" style="margin:0px 0px;">';
    $lv_tagstring .= '<div id="carousel-custom'.$localvocal->lv_id.'" class="carousel slide" data-ride="carousel">';
    $lv_tagstring .= '<div class="carousel-outer">';
    
    $lv_tagstring .= '<div class="carousel-inner">';
    
    for ($i = 0; $i < count($image); $i++)
    {
        
        $ext = pathinfo($image[$i], PATHINFO_EXTENSION);
        
        
       // $path_info = pathinfo('/foo/bar/baz.bill');

      //  $filename=$path_info['extension'];
        
       // (string)($image[$i]);
       
        $file_ext = $ext;//end(explode(".", $filename));
        
            	$accepted_image_formats = array('png','PNG','jpg','JPG','jpeg','JPEG','gif','GIF');
                		$accepted_video_formats = array('mp4','MP4','3gp','3GP','FLV','flv','WMV','wmv','AVI','avi');
                		$is_valid_image = array(); // 1 means available , 0 means not available
                		$is_valid_video = array();
        			//$ext = pathinfo($_FILES[$filename]['name'][$i],PATHINFO_EXTENSION );
        			if(in_array($file_ext, $accepted_image_formats))
        			{
        				$is_valid_image[] = 1;
        			}
        			else
        			{
        				$is_valid_image[] = 0;				
        			}
        			if(in_array($ext, $accepted_video_formats))
        			{
        				$is_valid_video[] = 1;
        			}
        			else
        			{
        				$is_valid_video[] = 0;				
        			}
        			
                    if(!in_array(0,$is_valid_image))
            		{
            			$return_values['type'] = 'image';
            		}
            		else if(!in_array(0,$is_valid_video))
            		{
            			$return_values['type'] = 'video';	
            		}
            		else
            		{
            			$return_values['type'] = 'invalid';	
            		}
        
        
        
        
        
        
   
        
        
        
        
        
        if ($i==0)
        {
            $lv_tagstring .= '<div class="item active">';
            
            if($return_values['type']=='image')
            {
                $lv_tagstring .='<img style="height: 100% !important;" src='.Helper::get_lv_image_loc().$image[$i].' alt="">';
            }
            elseif($return_values['type']=='video')
            {
                $lv_tagstring .='<video title="" poster="" controls="">';
                $lv_tagstring .='<source src="'.Helper::get_lv_image_loc().$image[$i].'" type="video/mp4">';
                    $lv_tagstring .='Your browser does not support the video tag.';
                $lv_tagstring .='</video>';
            }
            
            //$lv_tagstring .= '<img src="{{(new \App\Http\Controllers\Helper)->get_lv_image_loc()}}{{$images[$i]}}" alt="">';
            
            $lv_tagstring .= '</div>';
        }
        else
        {
            $lv_tagstring .= '<div class="item">';
            //$lv_tagstring .= '<img src="{{(new \App\Http\Controllers\Helper)->get_lv_image_loc()}}{{$images[$i]}}" alt="">';
            //$lv_tagstring .='<img style="height: 100% !important;" src='.Helper::get_lv_image_loc().$image[$i].' alt="">';
            if($return_values['type']=='image')
            {
                $lv_tagstring .='<img style="height: 100% !important;" src='.Helper::get_lv_image_loc().$image[$i].' alt="">';
            }
            elseif($return_values['type']=='video')
            {
                $lv_tagstring .='<video title="" poster="" controls="">';
                $lv_tagstring .='<source src="'.Helper::get_lv_image_loc().$image[$i].'" type="video/mp4">';
                    $lv_tagstring .='Your browser does not support the video tag.';
                $lv_tagstring .='</video>';
            }
            $lv_tagstring .= '</div>';
        }
    }

    $lv_tagstring .= '</div>';            
    if(count($image) > 1)
    {
    $lv_tagstring .= '<a class="left carousel-control" href="#carousel-custom'.$localvocal->lv_id.'" data-slide="prev">';
    $lv_tagstring .= '<span class="fa fa-chevron-left"></span>';
    $lv_tagstring .= '</a>';
    $lv_tagstring .= '<a class="right carousel-control" href="#carousel-custom'.$localvocal->lv_id.'" data-slide="next">';
    $lv_tagstring .= '<span class="fa fa-chevron-right"></span>';
    $lv_tagstring .= '</a>';
    }
    $lv_tagstring .= '</div>';                            
    
    
    
    $lv_tagstring .= '</div>';
    $lv_tagstring .= '</div>';
    $lv_tagstring .= '</div>';
    
    $lv_tagstring .= '</a>';
    
    
    
    
    
    
    
    /*
    $lv_tagstring .= '<a target="_blank" href='.Helper::get_url().'/lv/'.$localvocal->lv_id.'>';
    
    $lv_tagstring .= '<img src='.Helper::get_lv_image_loc().$image.'></a>';
    $lv_tagstring .= '</div>';*/
    $lv_tagstring .= '<div class="lv_post_list_text">';
    $lv_tagstring .= '<b>'.$localvocal->title.'</b><br><br>';
    $lv_tagstring .= $localvocal->description;
    $lv_tagstring .= '</div>';
    $count_lv_comments =  DB::select( DB::raw("SELECT COUNT(*) as count FROM lv_comments c where  c.lv_id = '".$localvocal->lv_id."'"));
    $localvocal->total_comments = $count_lv_comments;
    if($count_lv_comments[0]->count == 0)
    {
    $lv_tagstring .= '<div class="lv_post_list_view_cmts">';
    $lv_tagstring .= 'no comments yet';
    $lv_tagstring .= '</div>';
    }
    else
    {
    //$lv_tagstring .= '<div class="lv_post_list_view_cmts">';
    //$lv_tagstring .= 'View all ' . count($localvocal->total_comments[0]) .' comments';
    //$lv_tagstring .= 'View all ' .  $count_lv_comments[0]->count .' comments';
    //$lv_tagstring .= '</div>';
    }
    $lv_tagstring .= '<div style="display:none;" id="'.$localvocal->lv_id.'" class="lv_post_list_cmts_wrap">';
    foreach($comments as $comment)
    {
        
        
     $lv_tagstring .= '<div class="post-comment" style="display:inline-flex;margin: 10px auto;">';
     
     
     if($comment->dp_changed == 1)
        $lv_tagstring .= '<img style="margin-right: 10px;" src="'.$comment->profile_pic.'" alt="" class="profile-photo-sm" />';
     
     elseif($comment->facebook_profile_dp != NULL)
        $lv_tagstring .= '<img style="margin-right: 10px;" src="'.$comment->facebook_profile_dp.'" alt="" class="profile-photo-sm" />';
      
     elseif($comment->google_profile_dp != NULL)

        $lv_tagstring .= '<img style="margin-right: 10px;" src=""'.$comment->google_profile_dp.'" alt="" class="profile-photo-sm" />';

    else
       $lv_tagstring .= '<img style="margin-right: 10px;" src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />';
       
       
      $lv_tagstring .= '<p><a class="profile-link" href='.Helper::get_url().'/user/'.$comment->user_id.'>';
      
      $lv_tagstring .= $comment->name;
      $lv_tagstring .='</a>';
     
     $lv_tagstring .='<i class="em em-laughing"></i>&nbsp;&nbsp;&nbsp;'.$comment->comment.'</p>';
     
     
     $lv_tagstring .= '</div></br>';
     
      
     
        
   /* $lv_tagstring .= '<div class="lv_post_list_cmts_list">';
    $lv_tagstring .= '<span class="cmts_name">'.$comment->name.'</span>&nbsp;&nbsp;';
    $lv_tagstring .= '<span class="cmts_text">'.$comment->comment.'</span>';
    $lv_tagstring .= '</div>';*/
    }
    
    
    $lv_tagstring .= '</div>';
    $temp_id = substr($localvocal->lv_id,2);
    if(Auth::user())                
    {
    //$lv_tagstring .= '<div class="lv_post_list_cmts_list">';
    
    //$lv_tagstring .= '<img src="http://placehold.it/300x300" alt="" class="profile-photo-sm">&nbsp;&nbsp;&nbsp;'.Auth::user()->name;

   
    
   // $lv_tagstring .= '<input onkeypress="return savecomment(event,'.$temp_id.')" id="cmt_'.$localvocal->lv_id.'" type="text" class="form-control" placeholder="Post a comment">';
  // $lv_tagstring .= '<input onkeypress="return runScript(event)" id="cmt_'.$localvocal->lv_id.'" type="text" class="form-control" placeholder="Post a comment">';
  
  
  
    $lv_tagstring .= '<div class="post-comment" style="display:inline-flex;margin: 10px auto;">';
    
    
     if(Auth::user()->dp_changed == 1)
        $lv_tagstring .= '<img class="profile-photo-sm" style="margin-left: 23px;margin-right: 12px;border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.Auth::user()->profile_pic.'></a>';
        elseif(Auth::user()->facebook_profile_dp != NULL)
       $lv_tagstring .= '<img class="profile-photo-sm" style="margin-left: 23px;margin-right: 12px;border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.Auth::user()->facebook_profile_dp.'></a>';
        elseif(Auth::user()->google_profile_dp != NULL)
        $lv_tagstring .= '<img class="profile-photo-sm" style="margin-left: 23px;margin-right: 12px;border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.Auth::user()->google_profile_dp.'></a>';
        else
        $lv_tagstring .= '<img class="profile-photo-sm" style="margin-left: 23px;margin-right: 12px;border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src="images/profile.png">';
    
    
   // $lv_tagstring .= '<img style="margin-left: 22px;margin-right: 10px;" src="http://placehold.it/300x300" alt="" class="profile-photo-sm">';
    $lv_tagstring .= '<input onkeypress="return savecomment(event,'.$temp_id.')" id="cmt_'.$localvocal->lv_id.'" style="width:570px !important" type="text" placeholder="Post a comment" class="form-control"></div>';
    
 
    
    //$lv_tagstring .= '</div>';
    }
    
    
    $lv_tagstring .= '<div class="lv_post_list_btm">';
    $lv_tagstring .= '<div onclick="like_unlike_lv('.$temp_id.')" class="col-lg-2 col-md-2 col-sm-3 col-xs-4 lv_post_like'.$localvocal->lv_id.'">';
   //return $localvoca
    if($localvocal->like_status == "liked")
    $lv_tagstring .= '<i style="color:#ed474f !important" class="fa fa-heart"></i>&nbsp;&nbsp;'.$localvocal->likes_count;
    else
    $lv_tagstring .= '<i style="color:unset !important;" class="fa fa-heart"></i>&nbsp;&nbsp;'.$localvocal->likes_count;
    
    $lv_tagstring .= '</div>';
    $temp_id = substr($localvocal->lv_id,2);
    $lv_tagstring .= '<div onclick="show_comments('.$temp_id.')" class="col-lg-2 col-md-2 col-sm-3 col-xs-4 lv_post_cmt">';
    $lv_tagstring .= '<i class="fa fa-comment-o" aria-hidden="true"></i>&nbsp;&nbsp;'.$count_lv_comments[0]->count;
    $lv_tagstring .= '</div>';
    $lv_tagstring .= '<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 lv_post_share">';
     $lv_tagstring .= '<div class="dropdown">';
    $lv_tagstring .= '<button class="btn" type="button" data-toggle="dropdown"><i class="fa fa-share" aria-hidden="true"></i></button>';
    
    
     $lv_tagstring .= '<ul class="dropdown-menu">';
    $lv_tagstring .= "<li>";
   
    $lv_tagstring .= Share::page(Helper::get_url()."/lv/".$localvocal->lv_id, $localvocal->title)->facebook() ->twitter() 	->googlePlus()	->linkedin('Extra linkedin summary can be passed here');
    $lv_tagstring .= "</li>";              
    $lv_tagstring .= '</ul>';
      $lv_tagstring .= '</div>';
    
    $lv_tagstring .= '</div>';
    $lv_tagstring .= '<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 pull-right lv_post_morebtns">';                                    
    $lv_tagstring .= '<div class="dropdown">';
    $lv_tagstring .= '<button class="btn" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>';
    $lv_tagstring .= '<ul class="dropdown-menu">';
    $lv_tagstring .= '<li><a href="#">Report</a></li>';              
    $lv_tagstring .= '</ul>';
    $lv_tagstring .= '</div>';
    
    $lv_tagstring .= '</div>';
    $lv_tagstring .= '<div class="clearfix"></div>';
    $lv_tagstring .= '</div>';
    $lv_tagstring .= '<div class="clearfix"></div>';
    $lv_tagstring .= '</div>';
 
    $lv_tagstring .= '</div>';
    }    
    
    if ($request->ajax() && $type == "LocalVocal") {
            
            //return 1;
           return $lv_tagstring;
        }
    //$location = file_get_contents('http://freegeoip.net/json/'.$_SERVER['REMOTE_ADDR']);
    //$parsedJson  = json_decode($location);
    
   // $ip_city = $parsedJson->city;
    //$latitude = 12.9972;
   // $longitude = 77.6143;
    
    //$geocodeFromLatLong = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=false'); 
    //$output = json_decode($geocodeFromLatLong);
    //$status = $output->status;
    //$address = ($status=="OK")?$output->results[1]->formatted_address:'';
    
    //return $address;
        
     // $val =  $this->getlocation($parsedJson->latitude,$parsedJson->longitude);
     // return $val;
        //return count($location);
       // Log::info("hello");
       /* $hash = Hash::make("27");
        $rd = DB::table('users')
            ->where('id', 11)
            ->update(['password' => $hash]);*/
           // return;
        
       // $pass = Hash::make(Input::get("password",""));
        
       // $db =  DB::select( DB::raw("UPDATE `users` SET `password` = '1' WHERE `users`.`id` = '11';")); 
        
        
       // UPDATE `users` SET `password` = '3210' WHERE `users`.`id` = 11;
        
   /* $userdata = array(
        'id'     => 11,
        'password'  => 27,
        );
*/
    // attempt to do the login
   /* if (Auth::attempt($userdata)) {

        //return Auth::user()->id;
       // return "Success";
        //echo 'SUCCESS!';

    } else {        
       // return "Failed";
        // validation not successful, send back to form 
        //return Redirect::to('login');

    }*/
		
    	$data = array(); 

		//$broadcasts = Broadcast::all();
		//return $broadcasts;
		
		
		
		
		
        if(Auth::user())
        {
		$paid_broadcasts = DB::table('broadcasts')
			->select('broadcasts.*', 'users.is_online','users.name','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp')
			->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
			->where('is_paid',1)
			->where('broadcasts.user_id', '<>', Auth::user()->user_id)
			//->selectRaw($rad_sel_bc)
                
            ->where('broadcasts.current_broadcast',1)
            
                // ->whereRaw($rad_where_bc)
            //->orderBy('distance','asc')
            
            ->limit(4)
            ->get();
        }
        else
        {
         $paid_broadcasts = DB::table('broadcasts')
			->select('broadcasts.*', 'users.is_online','users.name','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp')
			->where('is_paid',1)
			 ->where('broadcasts.current_broadcast',1)
			// ->where('broadcasts.user_id', '<>', Auth::user()->user_id)
            ->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
            ->limit(4)
            ->get();  
            
        }
        
        foreach($paid_broadcasts as $paid_broadcast)
        {
             $loc_arr = explode(",",$paid_broadcast->location);
            
            if(count($loc_arr)>2)
            $paid_broadcast->location = $loc_arr[0].",".$loc_arr[1];
            
        }
	//	return $paid_broadcasts;
		
		/*Broadcast::where('is_paid','=','1')
			->select('broadcasts.*', 'users.name')
			->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
			->inRandomOrder()
			->limit(2)
			->get();*/
		
		/*$broadcasts = DB::table('broadcasts')
			->select('broadcasts.*', 'users.name')
            ->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
            //->Where('name', 'like', '%' . Input::get('name') . '%')->get();
           ->paginate(8);
        //return $broadcasts;
        
        //return $broadcasts;
        
        $swaps = DB::table('swaps')
			->select('swaps.*', 'users.name')
            ->leftJoin('users', 'swaps.user_id', '=', 'users.user_id')
            ->get(); 
         //return $swaps;       
            
         $localvocals = DB::table('localvocals')
			->select('localvocals.*', 'users.name')
            ->leftJoin('users', 'localvocals.user_id', '=', 'users.user_id')
            ->get();  */
            
        //return $localvocals;
        
        if(!Auth::user())
        {
        $Auth_user_id = "";    
        }
        else
        {
        $Auth_user_id = Auth::user()->user_id;
        }
        $sugg_users = DB::table('users')
			->select('users.*')
			->where('name','<>',null)
			->where('user_id','<>',$Auth_user_id)
			->inRandomOrder()
			->limit(3)
            //->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
            ->get();
       
        //return $sugg_users;    
            
		
		
		
		//Log::info('Showing user profile for user: ');
		
		
		$categories = DB::table('categories')
		//	->where('blocked_by_admin','=','0')
			->select('category_title','logo_image','id')
		//	->where('id','<>',1)
			->get();
			
		$user_notifications = 0;
		if(Auth::user())
		$user_notifications = DB::table('user_notifications')
			->where('to_user_id','=',Auth::user()->user_id)
			->where('is_shown','=',0)
	        ->count();	
			
		//return $categories;	
        return view('wannahelp.index',['title'=>'Wannahelp Home','categories'=>$categories,'broadcasts'=>$broadcasts,'paid_broadcasts'=>$paid_broadcasts,'swaps'=>$swaps,'localvocals'=>$localvocals,'sugg_users'=>$sugg_users,'user_notifications'=>$user_notifications]);
    }
    
    
    public function show_selected_category()
    {
    //echo $dd;
    $cat_id = Input::get("id");
    $type = Input::get("type");
    $location = Input::get("location");
    if($type == "Broadcast")
        $table_name = "broadcasts";
    else if($type == "Swap")
        $table_name = "swaps";
    else if($type == "LocalVocal")
        $table_name = "localvocals";
    else
        return "error";
    
   // $broadcasts = DB::table($table_name)
            //->select(DB::raw('select * from broadcasts'))
			//->select('users.name')
            //->leftJoin('users', $table_name'.user_id', '=', 'users.user_id')
            //->get();
    
     //$broadcasts = DB::select( DB::raw("SELECT $table_name.*,users.nme FROM $table_name ,users LEFT JOIN users ON $table_name.user_id = users.user_id where find_in_set($cat_id,cat_id) <> 0 "));
     
   /* $data = DB::select( DB::raw("SELECT t.*,u.name FROM $table_name t 
   LEFT JOIN users u ON t.user_id = u.user_id 
    
   where find_in_set($cat_id,t.cat_id) <> 0 AND t.location LIKE '%$location%' ")); */
     
     
     /* $data = DB::select( DB::raw("SELECT t.*,u.name FROM $table_name t 
   LEFT JOIN users u ON t.user_id = u.user_id 
    where find_in_set($cat_id,t.cat_id) <> 0 AND t.location LIKE '%$location%' ORDER BY t.created_at DESC; ")); */
    //$table_name = ""
    $data = DB::table($table_name)
            //->select(DB::raw('select * from broadcasts'))
			//->select('users.name')
            ->leftJoin('users', $table_name.'.user_id', '=', 'users.user_id')
            ->whereRaw("find_in_set($cat_id,$table_name.cat_id)")
            ->paginate(1);
    if($table_name == "Broadcast")
    {
        
    $broadcasts = $data; 
    foreach ($broadcasts as $broadcast) {
            $html.='<div class="btm_user_listing_wrap">';
            $html.= '<div class="btm_user_listing">';
            $html.= '<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">';
            $html.= ' <div class="wh_profile_pic_btm">';
            $html.= '<span class="wh_profile_pic_top_active">';
            $html.= '<i class="fa fa-circle"></i>';
            $html.= '</span>';
            $html.= '<img src="images/profile.png">';
            $html.= '</div>';
            $html.= '<p class="distance">';
            $html.= $broadcast->location.'</p>';
            $html.= '</div>';
            $html.= '<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">';
            $html.= '<div class="wh_name_btm">';
            $html.= '<p><i class="fa fa-diamond" aria-hidden="true" style="color: #3cc0c7;"></i>&nbsp;'.$broadcast->name.'</p>';
            $html.= '</div>';
            $html.= '<div class="wh_brdcast_btm">';
            $html.= $broadcast->description;
            $html.= '</div>';
            $html.= '</div>';
            $html.= '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">';
            $html.= '<button class="btn btn-chat-btm pull-right col-lg-12 col-md-12 col-sm-12 col-xs-12">CHAT</button>';
            $html.= '<div class="clearfix"></div>';
            $html.= '</div>';

            $html.= '<div class="clearfix"></div>';
            $html.= '</div>';
            $html.= '<div class="clearfix"></div>';
            $html.= '</div>';
            
        }
        
       
        if ($request->ajax() && $type == "Broadcast") {
            return $html;
        }        
            
    }        
   // return $broadcasts;
   // $array = $data->paginate(5);
    //return $array();
  
   //return $data;
   
   //where find_in_set($cat_id,t.cat_id) <> 0 AND t.location LIKE '%$location%' ")); 
     
    /* $data = DB::select( DB::raw("SELECT c.*,t.*,u.name FROM $table_name t 
    LEFT JOIN lv_comments c ON t.lv_id = c.lv_id
    LEFT JOIN users u ON t.user_id = u.user_id 
    where find_in_set($cat_id,t.cat_id) <> 0 AND t.location LIKE '%$location%' ")); */
     
     $current_date = date('Y-m-d H:i:s', time());
     
   //return $date;
     
    /* $datetime1 = new DateTime('2016-11-30 03:55:06');//start time
    $datetime2 = new DateTime('2016-11-30 11:55:06');//end time
    $interval = $datetime1->diff($datetime2);
    return $interval->format('%Y years %m months %d days %H hours %i minutes %s seconds');*/
     
     //JOIN lv_comments c ON t.lv_id = c.lv_id 
    for($i=0;$i<count($data);$i++)
    {
        if($type == "LocalVocal")
        {
        $count_lv_comments =  DB::select( DB::raw("SELECT COUNT(*) as count FROM lv_comments c where  c.lv_id = '".$data[$i]->lv_id."'"));
        $data[$i]->total_comments = $count_lv_comments;
        }
        $datetime1 = new DateTime($data[$i]->created_at);
        $datetime2 = new DateTime($current_date);
        $interval = $datetime1->diff($datetime2);
        if($interval->d != 0)
        {
        $string = $interval->d > 1 ? " days ago" : " day ago";
        $data[$i]->ago = $interval->d.$string;
        }
        elseif($interval->d == 0)
        {
             if($interval->h != 0)
             {
                $string = $interval->h > 1 ? " hours ago" : " hour ago";
                $data[$i]->ago = $interval->h .$string;
             }
             else if($interval->m != 0)
             {
                $string = $interval->m > 1 ? " minutes ago" : " minute ago";
                $data[$i]->ago = $interval->m .$string;
             }
             else
             {
                $string = $interval->s > 1 ? " seconds ago" : " second ago";
                $data[$i]->ago = $interval->s .$string;
             }
        }
        // $data[$i]->ago = $interval->d;
        
        // $data[$i]->ago = 
        // ->format('%Y years %m months %d days %H hours %i minutes %s seconds')
        $date_arr = explode(" ",$data[$i]->updated_at);
        //return $data[$i]->updated_at;
        $data[$i]->updated_at = $date_arr[0];
        
        if($type != "Broadcast")
        {
            $img_arr = explode(",",$data[$i]->images);
            $data[$i]->image = $img_arr[0];
        }
        
         
    } 
        
        
        
        
        
    return $data;
    }
    
    
    
    public function show_selected_location()
    {
    //echo $dd;
    //$cat_id = Input::get("id");
    $type = Input::get("type");
    $location = Input::get("location");
    $loc_arr = explode(",",$location);
    $trimmed_array =  array_map('trim',$loc_arr);
    //return $loc_arr;
    if($type == "Broadcast")
        $table_name = "broadcasts";
    else if($type == "Swap")
        $table_name = "swaps";
    else if($type == "LocalVocal")
        $table_name = "localvocals";
    else
        return "error";
    
   // $broadcasts = DB::table($table_name)
            //->select(DB::raw('select * from broadcasts'))
			//->select('users.name')
            //->leftJoin('users', $table_name'.user_id', '=', 'users.user_id')
            //->get();
    
     //$broadcasts = DB::select( DB::raw("SELECT $table_name.*,users.nme FROM $table_name ,users LEFT JOIN users ON $table_name.user_id = users.user_id where find_in_set($cat_id,cat_id) <> 0 "));
    /*$count = count($trimmed_array);
    $final_array = array();
    if($count == 2)
    $final_array[] = $trimmed_array[0];
    else if($count == 3)
    array_push($final_array,$trimmed_array[0],$trimmed_array[1]);
    else if($count == 4)
    array_push($final_array,$trimmed_array[0],$trimmed_array[1],$trimmed_array[2]);
    else if($count == 5)
    array_push($final_array,$trimmed_array[0],$trimmed_array[1],$trimmed_array[2],$trimmed_array[3]);
    
    //else
   // return $final_array;
   $array = implode("','",$final_array);
  // return $array;*/
    $data = DB::select( DB::raw("SELECT t.*,u.name FROM $table_name t LEFT JOIN users u ON t.user_id = u.user_id where t.description LIKE '%$location%' ")); 
    
    for($i=0;$i<count($data);$i++)
    {
        if($type == "LocalVocal")
        {
            $count_lv_comments =  DB::select( DB::raw("SELECT COUNT(*) as count FROM lv_comments c where  c.lv_id = '".$data[$i]->lv_id."'"));
            $data[$i]->total_comments = $count_lv_comments;
        }  
        if($type != "Broadcast")
        {
            $img_arr = explode(",",$data[$i]->images);
            $data[$i]->image = $img_arr[0];
        }
        
        
    }
    
    return $data;
    }

    public function swap_detail($item,$messaged_user_id='')
    {
        
        
       $pos = strpos($item, "SW");
       $pos = strripos($item, "SW");
       $id_unsorted = substr($item,$pos);
       $id = strtoupper($id_unsorted);
        $temp_id = substr($id,2);
       $swap_detail = DB::table('swaps')
        ->where('swap_id','=',$id)
		->select('swaps.*', 'users.name','users.email_verify','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp','users.is_online','users.created_at')
        ->leftJoin('users', 'swaps.user_id', '=', 'users.user_id','users.created_at')
        ->get(); 
        
        if($messaged_user_id!='')
        {
            $update_user_notifications = DB::table('user_notifications')
                        ->where('link_id',$id)
                        ->where('from_user_id',$messaged_user_id)
                        ->where('to_user_id', Auth::user()->user_id)
                        ->update(['is_shown' => 1]);
        }
    
        
       // return count($swap_detail);
       $current_date = date('Y-m-d H:i:s', time());
       $d1 = new DateTime($current_date);
       
       
       
       $d2 = new DateTime($swap_detail[0]->created_at);
        
       $diff = $d2->diff($d1);
       $d = $diff->d; 
       $m = $diff->m;
       $y = $diff->y;
       //return $d.$m.$y;
       if($m == 0)
       {
       if($d == 0)
            $d=1;
       $since = $d. " days";
       
       }
       
       if($m > 0 )
       {
           
           $since = $m. " months & ".$d. " days";
           
       }
       
       if($y > 0 )
       {
           
           $since = $y. " years & ".$m. " months";
           
       }
       
       
       $swap_detail[0]->since =  $since;
        
            
           $swap_location = $swap_detail[0]->location;
           //$user_location = "Coimbatore, Tamil Nadu, India";
           $user_location = "Hebbal,Bengaluru";
           // $dist = $this->get_distance($swap_location,$user_location);
            $swap_detail[0]->distance =  "11km";
        
     
        $images = $swap_detail[0]->images;
        
        $images_arr_swap =  explode(",",$images);
        //return $swap_detail;
       	$categories = DB::table('categories')
		//	->where('blocked_by_admin','=','0')
			->select('category_title','logo_image','id')
			->get();
		$cat_id = $swap_detail[0]->cat_id;
		/*
		$cat_arr_swap = explode(",",$cat_id);
		
		 $search_where_find_set_swap_sugg = "";
		 for($i=0;$i<count($cat_arr_swap);$i++)
         {
		 $search_where_find_set_swap_sugg .= "find_in_set(".$cat_id.",swaps.cat_id)";
		 if($i != count($cat_arr_swap)-1)
             {
                 $search_where_find_set_swap_sugg .= " OR ";
             }
         }
		*/
        //return $swap_detail[0]->cat_id;
        // description like '%$keyword%'"
       // $search_where_sugg_swaps = "description like '%$swap_detail[0]->location%'";
        
         $loc_arr_swap = explode(",",$swap_detail[0]->location);
          $search_where_swap_sugg = "location like";
         for($i=0;$i<count($loc_arr_swap);$i++)
         {
             $loc_arr_swap[$i] = ltrim($loc_arr_swap[$i]);
             $search_where_swap_sugg .= "'%$loc_arr_swap[$i]%'";
             if($i != count($loc_arr_swap)-1)
             {
                 $search_where_swap_sugg .= " OR ";
             }
             
         }
        
		$sugg_swaps = DB::table('swaps')
			->select('swaps.*')
			->where('swaps.swap_id','<>',$swap_detail[0]->swap_id)
			//->orwhereRaw($search_where_find_set_swap_sugg)
			->orwhereRaw( $search_where_swap_sugg)
			->inRandomOrder()
			->limit(4)
			//->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
            ->get();    
       
        for($i=0;$i<count($sugg_swaps);$i++)
        {
            
        $temp_title = preg_replace('/\s+/', '-', $sugg_swaps[$i]->title);    
        $sugg_swaps[$i]->temp_title = $temp_title;
        $images_arr =  explode(",",$sugg_swaps[$i]->images);
        if($images_arr[0] == '')
        $sugg_swaps[$i]->image = Helper::get_url()."/images/no-image-available.png";
        else
        $sugg_swaps[$i]->image = Helper::get_swap_image_loc().$images_arr[0];
        $sugg_swaps[$i]->short_desc = substr($sugg_swaps[$i]->description,0,77).'...';
        
        }
       //return $swap_detail;
		//return $sugg_swaps;	
       return view('wannahelp.swap_detail',['title'=>'Wannahelp Swap','sugg_swaps'=>$sugg_swaps,'categories'=>$categories,'swap_detail'=>$swap_detail,'images'=>$images_arr_swap,'temp_id'=>$temp_id]);   
    }
    
    
    
     public function localvocal_detail($item)
    {
       $pos = strpos($item, "LV");
       $pos = strripos($item, "LV");
       $id_unsorted = substr($item,$pos);
       $id = strtoupper($id_unsorted);
      // return $id;
       $lv_detail = DB::table('localvocals')
        ->where('lv_id','=',$id)
		->select('localvocals.*', 'users.name','users.email_verify','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp','users.is_online')
        ->leftJoin('users', 'users.user_id', '=', 'localvocals.user_id')
        ->get(); 
        
        
        
          $update_user_notifications = DB::table('user_notifications')
                        ->where('link_id',$id)
                        ->where('to_user_id', Auth::user()->user_id)
                        ->update(['is_shown' => 1]);
        
        
        
        //return $lv_detail;
        $lv_id = substr($lv_detail[0]->lv_id,2);
        $comments = DB::table($this->rest->tbl_lv_comments)->select('lv_comments.user_id','lv_comments.comment','lv_comments.id','lv_comments.created_at','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp','users.is_online','users.name')
                            ->where('lv_comments.lv_id',$lv_detail[0]->lv_id)
                            ->join('users', 'users.user_id', '=', 'lv_comments.user_id')  
                            ->orderby('lv_comments.id')
                            ->get();
       
        
        $comments_count = count($comments);   
        
        $lv_like_details = DB::table($this->rest->tbl_lv_like_share)->select('like_count','like_details')->where('lv_id',$lv_detail[0]->lv_id)->first();
        //return var_dump($lv_details);
        if(!empty($lv_like_details))
        {
            //return "inside";
           $like_details = (!empty($lv_like_details->like_details))? json_decode($lv_like_details->like_details):array();
          // return $like_details;
           $update_data = array();          
           $is_it = 0;
           $likes_count = count($like_details);
          
          if(Auth::user())
          {
           foreach ($like_details as $value)
           {
              if($value->user_id==Auth::user()->user_id)
              $is_it = 1;
            
           }                       
           if($is_it===1)
           {
              $like_status = "liked";
           }
           else
           {
            
             $like_status = "none";
           }   
          }
          else
           $like_status = "none";
                           
           
        }
        else
        {
             $likes_count = 0;
             $like_status = "none";
        }
        
           $lv_location = $lv_detail[0]->location;
           //$user_location = "Coimbatore, Tamil Nadu, India";
           //$user_location = "Hebbal,Bengaluru";
            //$dist = $this->get_distance($lv_location,$user_location);
            //$swap_detail[0]->distance =  $dist;
        
     
        $images = $lv_detail[0]->images;
        
        $images_arr =  explode(",",$images);
        //return $swap_detail;
       	$categories = DB::table('categories')
		//	->where('blocked_by_admin','=','0')
			->select('category_title','logo_image','id')
			->get();
			
       return view('wannahelp.lv_detail',['title'=>'Wannahelp Swap','lv_id'=>$lv_id,'categories'=>$categories,'likes_count'=>$likes_count,'like_status'=>$like_status,'comments_count'=>$comments_count,'comments'=>$comments,'lv_detail'=>$lv_detail,'images'=>$images_arr]);   
    }
    
    
    /*
    Function: show_user_profile
    Parameter: user id
    */
    
     public function show_user_profile($id)
     
    {
       $lv_images_arr = array();
       
       $user_id = $id;
       
       $user_details = DB::table('users')
        ->where('users.user_id','=',$id)
		->select('users.*','user_details.*')
        ->leftjoin('user_details', 'user_details.user_id', '=', 'users.user_id')
        ->get(); 
       
        $user_detail = DB::table($this->rest->tbl_users)
        ->select('followers')
        ->where('user_id',$id)->get()
        ->first();
        
         $is_it = 0;
        if(!empty($user_detail))
        {
           $user_followers_array = (!empty($user_detail->followers))? json_decode($user_detail->followers):array();
       
          // $update_data_followers = array();   
          $user_details[0]->followers_count = count($user_followers_array);
          
          if(Auth::user())
          {
           foreach ($user_followers_array as $followers)
           {
              
              if($followers->user_id==Auth::user()->user_id)
                  $is_it = 1;
              
           } 
          }
          
        }   
        $user_details[0]->is_it = $is_it;
        
        //return $is_it;
        
        $credits = DB::table('credits_summary')->where('user_id',$id)
            ->select('rem_credits')
        	->orderBy('id','desc')
	        ->first();
        //return 1;
        //return $credits
        if($credits=="")
        {
           //  return 13;
         $user_details[0]->rem_credits = 0;
        }
         else
         {
              //return 12;
        $rem_credits = $credits->rem_credits;    
        $user_details[0]->rem_credits = $rem_credits;
         }
          //$user_details[0]->rem_credits = 3;
        //return $user_details;
         $user_current_broadcast = DB::table('broadcasts')
        ->where('broadcasts.current_broadcast',1)
        ->where('broadcasts.user_id','=',$id)
		->select('broadcasts.*','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp','users.is_online')
        ->leftJoin('users', 'users.user_id', '=', 'broadcasts.user_id')
		->orderBy('broadcasts.created_at','desc')
        ->get(); 
        
        foreach($user_current_broadcast as $user_current_bt)
        {
            
            $loc_arr = explode(",",$user_current_bt->location);
            if(count($loc_arr)>2)
            $user_current_bt->location = $loc_arr[0].",".$loc_arr[1];
            
        }
        
        $user_old_broadcast = DB::table('broadcasts')
        ->where('broadcasts.current_broadcast',0)
        ->where('broadcasts.user_id','=',$id)
		->select('broadcasts.*','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp','users.is_online')
        ->leftJoin('users', 'users.user_id', '=', 'broadcasts.user_id')
		->orderBy('broadcasts.created_at','desc')
        ->get(); 
        
         foreach($user_old_broadcast as $user_old_bt)
        {
            
            $loc_arr = explode(",",$user_old_bt->location);
            if(count($loc_arr)>2)
            $user_old_bt->location = $loc_arr[0].",".$loc_arr[1];
            
        }
        
        
        //return $user_broadcast;
        
        //return $broadcast_time;
       /* $date = date('Y-m-d H:i:s', time());
        return $date;*/
        // 2018-02-08 14:03:22 1518098508
        
        
        
        //$date = date('Y-m-d H:i:s', time());
        //return $hourdiff = round((strtotime($date) - strtotime($user_broadcast[0]))/3600, 1);
        /*
        
        
        
        //return $date;
        //return $broadcast_time;
        
        $datetime1 = new DateTime($broadcast_time[0]);//start time
        $datetime2 = new DateTime($date);//end time
        $interval = $datetime1->diff($datetime2);
        
        return ( $date - $broadcast_time[0])/60;
        //return $datetime1;
        
        $datetime1 = $broadcast_time[0];//start time
        $datetime2 =$date;//end time
        //return $datetime1.$datetime2;
        $interval = $datetime1->diff($datetime2);
       //return $interval;
        */
        $user_swap = DB::table('swaps')
        ->where('swaps.user_id','=',$id)
		->select('swaps.*','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp','users.is_online')
        ->leftJoin('users', 'users.user_id', '=', 'swaps.user_id')
		->orderBy('swaps.created_at','desc')
        ->get(); 
        
         
         
         foreach ($user_swap as $swap) 
	    {
	     $swap->temp_title = preg_replace('/\s+/', '-', $swap->title); 
	     
	     $img_arr = explode(",",$swap->images);
	     
	     $swap->image = $img_arr;
	     
	     
	     $loc_arr = explode(",",$swap->location);
         if(count($loc_arr)>2)
         $swap->location = $loc_arr[0].",".$loc_arr[1];

	    }
        
        
        $user_localvocal = DB::table('localvocals')
        ->where('localvocals.user_id','=',$id)
        ->select('localvocals.*','users.name','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp','users.is_online')
        ->leftJoin('users', 'users.user_id', '=', 'localvocals.user_id')
		
	    ->orderBy('localvocals.created_at','desc')
        ->get(); 
        
        
        //return $user_localvocal;
            
            
      
        
        foreach($user_localvocal as $user_lv)
        {
        $temp_id = substr($user_lv->lv_id,2);
        $user_lv->id = $temp_id;
        $loc_arr = explode(",",$user_lv->location);
        if(count($loc_arr)>2)
        $user_lv->location = $loc_arr[0].",".$loc_arr[1];
        
        $img_arr = explode(",",$swap->images);
        
        $user_lv->image = $img_arr;  
            
        $lv_details = DB::table($this->rest->tbl_lv_like_share)->select('like_count','like_details')->where('lv_id',$user_lv->lv_id)->get()->first();
        //return var_dump($lv_details);
        if(!empty($lv_details))
        {
        //return "inside";
           $like_details = (!empty($lv_details->like_details))? json_decode($lv_details->like_details):array();
          // return $like_details;
           $update_data = array();          
           $is_it = 0;
          $user_lv->likes_count = count($like_details);
           foreach ($like_details as $value)
           {
              if($value->user_id==$id)
                  $is_it = 1;
            
           }                       
           if($is_it===1)
           {
            
              $user_lv->like_status = "liked";
           }
           else
           {
            
             $user_lv->like_status = "none";
           }   

                           
           
        } 
         $img_arr = explode(",",$user_lv->images);
        $user_lv->images = $img_arr;
        //return $user_localvocal;  
        $user_lv->comments = DB::table($this->rest->tbl_lv_comments)->select('lv_comments.user_id','lv_comments.comment','lv_comments.created_at','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp','users.is_online','users.name')
                            ->where('lv_comments.lv_id',$user_lv->lv_id)
                            ->join('users', 'users.user_id', '=', 'lv_comments.user_id')                            
                            ->get();
        $temp_id = substr($user_lv->lv_id,2);
        $user_lv->id = $temp_id;
        
        }
        //return $user_localvocal;
        
        
         //return $user_localvocal;
        
        
        for($i=0;$i<count($user_localvocal);$i++)
        {
       // return $user_localvocal[0]->created_at;
         $date_arr = explode(" ",$user_localvocal[$i]->created_at);
         //return $user_localvocal;
         $user_localvocal[$i]->created_at = $date_arr[0];
        // if($i==0)
       //return $date_arr[0];
         $lv_images = $user_localvocal[$i]->images;
        
        
        //array_push($lv_images_arr,explode(",",$lv_images));
        
         
        }
        
         
        
        //return $lv_images_arr;
        //return $user_localvocal;
        
        $localvocal_comments = DB::table('lv_comments')
        ->leftJoin('localvocals', 'lv_comments.lv_id', '=', 'localvocals.lv_id')
        //->leftJoin('users', 'localvocals.user_id', '=', 'users.user_id')
        ->leftJoin('users', 'lv_comments.user_id', '=', 'users.user_id')
        ->where('localvocals.user_id','=',$id)
		->select('localvocals.*','lv_comments.*','users.name as NAME')
		//->where ('localvocals')
        ->get(); 
        
         //return $localvocal_comments;
        	$categories = DB::table('categories')
		//	->where('blocked_by_admin','=','0')
			->select('category_title','logo_image','id')
			->get();
			
			//$result = array_merge($user_broadcast,$user_swap, $user_localvocal);
			//return $result;
			//return $user_broadcast;
//	return $user_details;	
       return view('wannahelp.profile',['title'=>'Wannahelp Swap','user_details'=>$user_details,'categories'=>$categories,'user_current_broadcast'=>$user_current_broadcast,'user_old_broadcast'=>$user_old_broadcast,'user_localvocal'=>$user_localvocal,'lv_images_arr'=>$lv_images_arr,'user_swap'=>$user_swap,'user_id'=>$user_id]);  
    }
    
    
    public function create_post()
    {
        $sts_otp = "";
        if(!Auth::user())
        {
            $name = Input::get( 'name' );
            $mobile = Input::get( 'mobile' );
            $city = Input::get( 'city' );
            if($name == "" || $mobile == "" || $city == "")
		        return "Required: Name";
		     $mobile_count = DB::table('users')->where('mobile',$mobile)->count();
		     /*if($mobile_count != 0)
		         return "Mobile number is already registered. Please Login";*/
		      $sts_otp = $this->register_from_post($name,$mobile,$city);  
		     if($sts_otp!="Success")
		        return $sts_otp;
		     
        }
      
        $type = Input::get( 'type' );
         $goods = Input::get( 'goods' );
         $price = Input::get( 'price' );
         $swap_option = Input::get( 'swap_option' );
         
         if($swap_option == "Open")
         {
          $any = 1;
          $free = 0;   
             
         }
         elseif(($swap_option == "Free"))
         {
          $any = 0;
          $free = 1;   
             
         }
         else
         {
          $any = 0;
          $free = 0;   
             
         }
         //$price = Input::get( 'price' );
        //return $type;
         //OK
        $categories = Input::get( 'cat' );
        //$desc = $_POST['desc'];
        //return $desc;
        $desc_bc = Input::get( 'description_bc' );
       
        $location_bc = Input::get( 'pac-input-modal_bc' );
       
       
       $desc_sw = Input::get( 'description_sw' );
       
        $location_sw = Input::get( 'pac-input-modal_sw' );
        
        $desc_lv = Input::get( 'description_lv' );
       
        $location_lv = Input::get( 'pac-input-modal_lv' );
       
       
        
        
        
        //For broadcast, images are not available.
        if($type!="Broadcast")
        {
    	$total = array();
    	$total = count($_FILES['s1_file']['name']);
        }
    	if($type=="Swap")
    	{
    	    $swap_id=$this->rest->get_unique_swapid();
    	    $title = Input::get( 'caption_sw' );
    	    if($location_sw == "" && $title == "")
    		return "Required: Location and Caption";
    		else if($location_sw == "")
    		return "Required: Location";
    		else if($title == "")
    		return "Required: Caption";
    		else if($categories == "")
    		return "Required: Categories";
            else if($swap_option == "")
    		return "Required: Options";
    		else if($swap_option == "Product/Price" && $goods == "")
    		return "Required: Enter Goods you wish to trade for";
    		else if($swap_option == "Product/Price" && $price == "")
    		return "Required: Enter Price";
    		
    		
    		else
    		{
                $address = $location_sw; 
                $prepAddr = str_replace(' ','+',$address);
                $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?key=AIzaSyD7ymkb4fhvYTI-xSzbPfF9vPDnfrj86tY&address='.$prepAddr.'&sensor=false');
                $output= json_decode($geocode);
                $lat = $output->results[0]->geometry->location->lat;
                $long = $output->results[0]->geometry->location->lng;
    	    
        	    if($_FILES['s1_file']['name'][0] == "")
        	    {
        	        return "Add atleast one Image. Max:4";
        	    }
        	    else if($total>=5)
        	    {
        	      return "Number of images uploaded exceeded the limit. Max:4 Images" ;
        	    }
        	    else
        	    {
        	   
        	        $upload_data = $this->s3->upload_multiple_files('','s1_file','swap','thumb'); 
        	        //return print_r($upload_data);
        	        if($upload_data['error']=='YES')
	  		        {	  			
	  			        return "Invalid File Format. Please select again";
	  		        }
	  		        else
	  		        {	  			
	  			        foreach ($upload_data['files'] as $row)
		  		        {
		  			        if($row['error']==NULL)
		  				        $images[] = $row['filename'];	
		  				        //return count($upload_data['files']);
		  		        }	
	  		        }	  	
        	        // Validation Success;
        	        $images = implode(',', $images);
        	        $values_sw = array(
        		  	'user_id'=> Auth::user()->user_id,
        		  	'swap_id'=> $swap_id, 
        		  	'title'=> $title,
        		  	'description'=> $desc_sw,
        		  	'images'=> $images,
        		  	'cat_id'=> $categories,
        		  	'location'=> $location_sw,
        		  	'latitude'=> $lat,
        		  	'longitude'=> $long,
        		  	// change 
        		  	'for_goods'=> $goods,
        		  	'for_services'=> NULL,
        		  	'for_price'=> $price,
        		  	'for_any'=> $any,
        		  	'for_free'=> $free,
        		  	'status'=>0,
        		  	// change end
        		  	
        		  	'created_at' => date('Y-m-d y:i:s'),
        		  	'updated_at' => date('Y-m-d y:i:s')
    		         );
    		        //print_r($values_sw);
    		        $sts = $this->rest->insert_values($this->rest->tbl_swaps,$values_sw);
    		        $result = [];
                    $result['id'] = $swap_id;
    		        if($sts==1 && $sts_otp == "Success")
                    {
                        $result['status'] = "ok show otp";
                        return $result;	
                    }
                    else if($sts==1)
                    {
                        $result['status'] = "ok";
                        return $result;	
                       // return "ok";	
                    }
                    else
                    {
                        $result['status'] = "Failed";
                        return $result;	
                        //return "Failed"; 
                    }
        	    }
    	    
    	    }
    	}
    	else if($type=="Broadcast")
    	{
    	    if($location_bc == "" && $desc_bc == "")
		        return "Required: Location and Description";
	    	else if($location_bc == "")
		        return "Required: Location";
		    else if($desc_bc == "")
		        return "Required: Description";
		    else if($categories == "")
    		    return "Required: Categories";
		    else
		    {   
		        $bc_id=$this->rest->get_unique_bcid();
                $address = $location_bc; 
                $prepAddr = str_replace(' ','+',$address);
                $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?key=AIzaSyD7ymkb4fhvYTI-xSzbPfF9vPDnfrj86tY&address='.$prepAddr.'&sensor=false');
                $output= json_decode($geocode);
                
                
                $lat = $output->results[0]->geometry->location->lat;
                $long = $output->results[0]->geometry->location->lng;
                
                
                $latitude = $lat;
                $longitude = $long;
                
                
                 $values_bc = array(
        		  	'user_id'=> Auth::user()->user_id, 
        		  	'broadcast_id'=> $bc_id,
        		  	'description'=> $desc_bc,
        		  	'cat_id'=> $categories,
        		  	'current_broadcast'=> 1,
        		  	'location'=> $location_bc,
        		  	'latitude'=> $latitude,
        		  	'longitude'=> $longitude,
        		  	'created_at' => date('Y-m-d y:i:s'),
        		  	'updated_at' => date('Y-m-d y:i:s')
        		  );		
                
    		        //print_r($values_sw);
    		        $sts = $this->rest->insert_values($this->rest->tbl_broadcasts,$values_bc);
    		         $update_otherway = DB::table('broadcasts')
                        ->where('broadcast_id','<>',$bc_id)
                        ->where('user_id', Auth::user()->user_id)
                        ->update(['current_broadcast' => 0]);
                    $result = [];
                    $result['id'] = $bc_id;
    		        if($sts==1 && $sts_otp == "Success")
                    {
                        $result['status'] = "ok show otp";
                        return $result;	
                    }
                    else if($sts==1)
                    {
                        $result = [];
                        $result['id'] = $bc_id;
                        $result['status'] = "ok";
                        return $result;	
                    }
                    else
                    {
                        $result['status'] = "Failed";
                        return $result; 
                    }
        	    
        	}
        	
        	
    	}
    	else if($type=="LocalVocal")
    	{
    	    $lv_id=$this->rest->get_unique_lvid();
    	    $title = Input::get( 'caption_lv' );
    	    if($location_lv == "" && $title == "")
    		return "Required: Location and Caption";
    		else if($location_lv == "")
    		return "Required: Location";
    		else if($title == "")
    		return "Required: Caption";
    		else if($categories == "")
    		return "Required: Categories";
    		else
    		{
                $address = $location_lv; 
                $prepAddr = str_replace(' ','+',$address);
                $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?key=AIzaSyD7ymkb4fhvYTI-xSzbPfF9vPDnfrj86tY&address='.$prepAddr.'&sensor=false');
                $output= json_decode($geocode);
                $lat = $output->results[0]->geometry->location->lat;
                $long = $output->results[0]->geometry->location->lng;
    	    
        	    if($_FILES['s1_file']['name'][0] == "")
        	    {
        	        return "Add atleast one Image. Max:4";
        	    }
        	    else if($total>=5)
        	    {
        	      return "Number of images uploaded exceeded the limit. Max:4 Images" ;
        	    }
        	    else
        	    {
        	   
        	        $upload_data = $this->s3->upload_multiple_files('','s1_file','lv','thumb'); 
        	        //return print_r($upload_data);
        	        if($upload_data['error']=='YES')
	  		        {	  			
	  			        return "Invalid File Format. Please select again";
	  		        }
	  		        else
	  		        {	  			
	  			        foreach ($upload_data['files'] as $row)
		  		        {
		  			        if($row['error']==NULL)
		  				        $images[] = $row['filename'];	
		  				        //return count($upload_data['files']);
		  		        }	
	  		        }	  	
        	        // Validation Success;
        	        $images = implode(',', $images);
        	        
        	        $values_lv = array(
        		  	'user_id'=> Auth::user()->user_id,
        		  	'lv_id'=> $lv_id, 
        		  	'title'=> $title,
        		  	'description'=> $desc_lv,
        		  	'images'=> $images,
        		  	'cat_id'=> $categories,
        		  	'location'=> $location_lv,
        		  	'latitude'=> $lat,
        		  	'longitude'=> $long,
        		  	// change 
        		  	'public'=> 0,
		  	        'followers'=> 1,	
		  	        'last_activity' => '',
		  	        'last_activity_user_id' => '',
        		  	// change end
        		  	'status' => 1,
        		  	'created_at' => date('Y-m-d y:i:s'),
        		  	'updated_at' => date('Y-m-d y:i:s')
    		         );
    		        //print_r($values_sw);
    		        $sts = $this->rest->insert_values($this->rest->tbl_localvocals,$values_lv);
    		        
    		        
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
                      }
                      else
                      {
                          return "Failed";
                      }
    		         $result = [];
                    $result['id'] = $lv_id;
    		        if($sts == 1 && $status == 1 && $sts_otp == "Success")
                    {
                        $result['status'] = "ok show otp";
                        return $result;	
                    }
                    else if($sts==1)
                    {
                       $result['status'] = "ok";
                        return $result;		
                    }
                    else
                    {
                        $result['status'] = "Failed";
                        return $result;	
                    }
        	    }
    	    
    	    }
        	
        	
    	}
        // Auth check
    	
    }
	
	
	public function get_credits_count()
	{
	
	$credits = DB::table('credits_summary')->where('user_id',Auth::user()->user_id)->select('rem_credits','plan_name')
	->orderBy('id','desc')
	->first();
	$data = array();
	if($credits == "")
	{
	 $data = "";   
	}
	else
	{
    	$data['rem_credits'] = $credits->rem_credits;
    	if($credits->plan_name == "Basic")
    	{
    	    $validity = "7 Days";
    	}
    	elseif($credits->plan_name == "Platinum")
    	{
    	    $validity = "21 Days";
    	    
    	}
    	else
    	{
    	    $validity = "30 Days"; 
    	}
    	$data['plan_name'] = $credits->plan_name;
    	$data['validity'] = $validity;
           // $rem_credits = $credits[0];  
	}
	if(Auth::user())
        $data['user_id'] = Auth::user()->user_id;
    else
        $data['user_id'] = "";
        
    return $data;
	}
	
	public function use_credit()
	{ 
	    //return "Insoie";
	    $post_id = Input::get( 'post_id' );
	     $plan_name = Input::get( 'plan_name' );
	    $user_id = Auth::user()->user_id;
	    
	    
	   $data = DB::table('credits_summary')
			->select('credits_summary.*')
            ->where('user_id','=',$user_id)
            ->where('plan_name','=',$plan_name)
            ->orderBy('id','desc')
	        ->first();
	    
	    $credits_id =  $data->txn_id;
	    $current_date_initial = date('Y-m-d H:i:s', time());
	    $current_date = strtotime($current_date_initial);
	    //return $current_date;
	    if($data->plan_name == "Basic")
	    $days = 7;
	    elseif($data->plan_name == "Premium")
	    $days= 21;
	    elseif($data->plan_name == "Platinum")
	    $days= 30;
	    
	    
	    $new_date = strtotime("+".$days." day", $current_date);
	    $new_date = date('Y-m-d H:i:s', $new_date);
	    //return $new_date;
	    
	    $avail_credits =  $data->rem_credits;
	    //return
	    $rem_credits = $avail_credits - 1;
	    
	    
	    if($avail_credits > 0)
	    {
	    $sts = DB::table('credits_transaction')->insert(
        ['txn_id' => $credits_id, 'type_id' => $post_id,'user_id' => $user_id,'valid_from' => $current_date_initial,'valid_until' => $new_date]
        );
        
        
        $sts = DB::table('credits_summary')
		                ->where('txn_id', $credits_id)
                        
                        ->update(['rem_credits' => $rem_credits,'updated_at' =>$current_date_initial]);
                        
       if( substr($post_id,0,2) == "BC") 
	        {
	        $update_paid_column = DB::table('broadcasts')
	        ->where('broadcast_id',$post_id)
	        ->update(['is_paid' => 1]);
	            
	        } 
	        else if(substr($post_id,0,2) == "SW")
	        {
	        $update_paid_column = DB::table('swaps')
	        ->where('swap_id',$post_id)
	        ->update(['is_paid' => 1]);
	            
	        }           
        
	    }
	   // return $post_id.$type;
	   // return view('wannahelp.settings',['title'=>'Wannahelp Swap','categories'=>$categories,'dd'=>$dd,'mm'=>$mm,'yyyy'=>$yyyy,'user_details'=>$user_details]);  
	    
	    
	}
	
	
	public function edit_post()
	{
	    $post_id = Input::get( 'id' );
	    $type = Input::get( 'type' );
	    
	    if($type == "Broadcast")
	    {
	    $data = DB::table('broadcasts')
			->select('broadcasts.*')
            ->where('broadcast_id','=',$post_id)
            ->get();
	    }
	    if($type == "Swap")
	    {
	    $data = DB::table('swaps')
			->select('swaps.*')
            ->where('swap_id','=',$post_id)
            ->get();
	    }
	    if($type == "LocalVocal")
	    {
	    $data = DB::table('localvocals')
			->select('localvocals.*')
            ->where('localvocal_id','=',$post_id)
            ->get();
	    }
	   // return $post_id.$type;
	   // return view('wannahelp.settings',['title'=>'Wannahelp Swap','categories'=>$categories,'dd'=>$dd,'mm'=>$mm,'yyyy'=>$yyyy,'user_details'=>$user_details]);  
	    return $data;
	}
	
	public function editsave_post()
	{
	    //return Auth::user()->user_id;
	    $post_id_bc = Input::get( 'edit_post_id_bc' );
	     $post_id_sw = Input::get( 'edit_post_id_sw' );
	    $type = Input::get( 'type' );
	    $cat = Input::get( 'cat' );
	    $desc_bc = Input::get( 'description_bc');
	    $location_bc = Input::get( 'pac-input-modal_bc');
	    
	    $desc_sw = Input::get( 'description_sw');
	    //$caption_sw = Input::get( 'caption_sw');
	    $location_sw = Input::get( 'pac-input-modal_sw');
	    
	  //  return "inside";
	   if($type=="Broadcast")
    	{
    	    if($location_bc == "" && $desc_bc == "")
		        return "Required: Location and Description";
	    	else if($location_bc == "")
		        return "Required: Location";
		    else if($desc_bc == "")
		        return "Required: Description"; 
		    else if($cat == "")
		        return "Required: Category ";
		    else
		    {
		      
		    $sts = DB::table('broadcasts')
		        ->where('broadcast_id', $post_id_bc)
                ->where('user_id', Auth::user()->user_id)
                ->update(['cat_id' => $cat,'description' => "$desc_bc",'location' => "$location_bc"]);
             //return $sts;   
            if($sts == 1)
                return "Successfully Updated";
            else
                return "Something went wrong";   
		      
		      
		      
		   }
		  
    	}
    	else if ($type == "Swap")
    	{
    	    
    	     $title = Input::get( 'caption_sw' );
    	    if($location_sw == "" && $title == "")
    		    return "Required: Location and Caption";
    		else if($location_sw == "")
    		    return "Required: Location";
    		else if($title == "")
    		    return "Required: Caption";
    		else if($desc_sw == "")
    		    return "Required: desc";
    		else
    		{
    		    
    		    if($type!="Broadcast")
                {
    	            $total = array();
    	            $total = count($_FILES['s1_file']['name']);
                }
                
    		    if($_FILES['s1_file']['name'][0] == "")
        	    {
        	        return "Add atleast one Image. Max:4";
        	    }
        	    else if($total>=5)
        	    {
        	      return "Number of images uploaded exceeded the limit. Max:4 Images" ;
        	    }
        	    else
        	    {
        	        
        	         $upload_data = $this->s3->upload_multiple_files('','s1_file','swap','thumb'); 
        	        //return print_r($upload_data);
        	        if($upload_data['error']=='YES')
	  		        {	  			
	  			        return "Invalid File Format. Please select again";
	  		        }
	  		        else
	  		        {	  			
	  			        foreach ($upload_data['files'] as $row)
		  		        {
		  			        if($row['error']==NULL)
		  				        $images[] = $row['filename'];	
		  				        //return count($upload_data['files']);
		  		        }	
	  		        }	  	
        	        // Validation Success;
        	        $images = implode(',', $images);
        	        
        	        $sts = DB::table('swaps')
		                ->where('swap_id', $post_id_sw)
                        ->where('user_id', Auth::user()->user_id)
                        ->update(['title' => $title,'images' => $images,'cat_id' => $cat,'description' => "$desc_sw",'location' => "$location_sw"]);
                 //return $sts;   
                if($sts == 1)
                    return "Successfully Updated";
                else
                    return "Something went wrong"; 
        	        
        	    }
    		}
    	    
    	}
    	
	   
	   // return $post_id.$type;
	   // return view('wannahelp.settings',['title'=>'Wannahelp Swap','categories'=>$categories,'dd'=>$dd,'mm'=>$mm,'yyyy'=>$yyyy,'user_details'=>$user_details]);  
	   // return "ok";

	
	}
	
	
	public function report_post()
	{
	    
	    return "ok";
	}
	
	
	
	public function getprofiledetails()
	{
	    $categories = DB::table('categories')
		//	->where('blocked_by_admin','=','0')
			->select('category_title','logo_image','id')
			->get();
			
		 $dob = User::where('user_id',Auth::user()->user_id)->pluck('dob');
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
		 
		  $user_details = UserDetail::where('user_id',Auth::user()->user_id)->select('about_me','current_location','profession')->get();
	    return view('wannahelp.settings',['title'=>'Wannahelp Profile Page','categories'=>$categories,'dd'=>$dd,'mm'=>$mm,'yyyy'=>$yyyy,'user_details'=>$user_details]);  
	    
	}
	
	
		public function show_create_post()
	{
	    $categories = DB::table('categories')
		//	->where('blocked_by_admin','=','0')
			->select('category_title','logo_image','id')
			->get();
			
		 
	    return view('wannahelp.createpost',['title'=>'Wannahelp Profile Page','categories'=>$categories]);  
	    
	}
	
	public function setprofiledetails()
	{
	    // default 1 for allow_comment
	    // 0 only followers can comment, 1 all can comment
	    
	      // default 1 for allow_follow
	    // 1 allow followers, 0 dont allow followers
	    
	    
	    $follow = Input::get('follow');
	    $comment = Input::get('comment');
	    //return $comment;
	    //return $follow;
	    if($follow != '' )
	        $sts = DB::table('users')
            ->where('user_id', Auth::user()->user_id)
            ->update(['allow_follow' => $follow]);
        else if($comment != '' )  
            $sts = DB::table('users')->where('user_id', Auth::user()->user_id)->update(['allow_comment' => $comment]);
            //return $comment;
        
        
        if($sts==1)
        {
            return "ok";	
        }
        else
        {
            return "Failed"; 
        }
	    
	    //return DB::table('orders')->where('finalized', 1)->exists();
	    
	}

		public function search_results(Request $request)
        	{
        	    
        	    $search_query = $request->search_query;
        	    $search_distance = $request->search_distance;
        	    
        	   //Following Find the Longitude and Latitude
        	    
        	    $location_bc = $search_query;
                $address = $location_bc; 
                $prepAddr = str_replace(' ','+',$address);
                $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?key=AIzaSyD7ymkb4fhvYTI-xSzbPfF9vPDnfrj86tY&address='.$prepAddr.'&sensor=false');
                $output= json_decode($geocode);
                $from_lat = $output->results[0]->geometry->location->lat;
                $from_long = $output->results[0]->geometry->location->lng;
                // return $long;
                
                // return $from_lat;
                // return $from_long;
                
                // Take all data and send all data to search_results Function
                
                $results = DB::table('broadcasts')
                ->select('broadcasts.*')
                ->get();
                
                // Return all results as per Requirement
                
                    foreach ($results as $row) {
                    $to_latitude= $row->latitude;
                    $to_longitude= $row->longitude;
                    $swap_id= $row->broadcast_id;
                    $title= $row->location;
                    $location= $row->location;
                      $latFrom = deg2rad($from_lat);
                      $lonFrom = deg2rad($from_long);
                      $latTo = deg2rad($to_latitude);
                      $lonTo = deg2rad($to_longitude);
                    
                      $latDelta = $latTo - $latFrom;
                      $lonDelta = $lonTo - $lonFrom;
                      $earthRadius = 6371000;
                      $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                        cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
                      $result= $angle * $earthRadius/1000;
                      if($result<5){
                      echo "Distance->".$result.","."Swap Id->".$swap_id.","."title->".$title."Location->".$location."<br>";
                      }
                }
        	}
        	
    
    
    
    
    
    
    
    
    public function search_index(Request $request)
    {   
        //return  "The time is " . date("h:i:sa");
        //return $request->type;
        	$ip = $_SERVER['REMOTE_ADDR'];
        //	http://freegeoip.net/{format}/{ip_or_hostname}
        $type = $request->input('type');
         $cat = $request->input('cat');
         $keyword = $request->input('keyword');
         $location = $request->input('location');
         if($location == "Select City")
            $location = "";
         //return $location;
         if(!empty($location))
        {
         // return $location;
         $data = $this->get_latlong_from_loc($location);
       
       
       $lat = $data['lat'];
        $long = $data['long'];
        
         //return $lat;   
        }
         else
         {
      
        $data = $this->locate();
        $lat = $data['latitude'];
        $long = $data['longitude'];
         }
        // description like '%$keyword%'"
        $search_where_bc = "description like '%$keyword%'";
        
        //return $lat;
        
        
        $search_where_sw = "description like '%".$keyword."%' OR title like '%$keyword%'";
        //$search_where_sw = "";
        $search_where_lv = "description like '%$keyword%' OR title like '%$keyword%'";
        
        //$search_where = (!empty($keyword))?'(broadcasts.description like "%'.$keyword.'%"")':'1=1';
        //$search_where = "broadcasts.description like '%$keyword%'";
        $rad_sel_bc = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(broadcasts.latitude) ) * cos( radians( broadcasts.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(broadcasts.latitude))) ) AS distance';
        $rad_where_bc = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(broadcasts.latitude) ) * cos( radians( broadcasts.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(broadcasts.latitude))) ) <= 20 ';
       
        $rad_sel_sw = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(swaps.latitude) ) * cos( radians( swaps.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(swaps.latitude))) ) AS distance';
        $rad_where_sw = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(swaps.latitude) ) * cos( radians( swaps.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(swaps.latitude))) ) <= 20 ';
    
        $rad_sel_lv = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(localvocals.latitude) ) * cos( radians( localvocals.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(localvocals.latitude))) ) AS distance';
        $rad_where_lv = '( 6371 * acos( cos( radians('.$lat.') ) * cos( radians(localvocals.latitude) ) * cos( radians( localvocals.longitude) - radians('.$long.') ) + sin( radians('.$lat.') ) * sin( radians(localvocals.latitude))) ) <= 20 ';
      
         
         if(empty($cat) || $cat == 1 || $cat == "")
         {
         $cat_where_bc = '1=1';
         $cat_where_sw = '1=1';
         $cat_where_lv = '1=1';
         }
         else
         {
        
         
         $cat_where_bc = "find_in_set(".$cat.",broadcasts.cat_id)" ;
          $cat_where_sw = "find_in_set(".$cat.",swaps.cat_id)" ;
          //return $cat_where_sw;
           $cat_where_lv = "find_in_set(".$cat.",localvocals.cat_id)" ;
         }
        //return $rad_sel;
      if(!empty($location))
      {
            if(Auth::user())
            {
          
              $broadcasts = Broadcast::select('broadcasts.*', 'users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
        			->selectRaw($rad_sel_bc)
                    ->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
                      ->whereRaw($search_where_bc)
                    //  ->where('broadcasts.location','like','%'.$location.'%')
                      ->where('broadcasts.current_broadcast',1)
                       ->whereRaw($cat_where_bc)
                       ->where('broadcasts.user_id', '<>', Auth::user()->user_id)
                        
                      ->orderBy('distance','asc')
                    //->Where('name', 'like', '%' . Input::get('name') . '%')->get();
                   ->paginate(5);   
                 //  return $broadcasts;
            }
            else
            {
                $broadcasts = Broadcast::select('broadcasts.*', 'users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
        			->selectRaw($rad_sel_bc)
                    ->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
                      ->whereRaw($search_where_bc)
                    //  ->where('broadcasts.location','like','%'.$location.'%')
                      ->where('broadcasts.current_broadcast',1)
                       ->whereRaw($cat_where_bc)
                       //->where('broadcasts.user_id', '<>', Auth::user()->user_id)
                      ->orderBy('distance','asc')
                    //->Where('name', 'like', '%' . Input::get('name') . '%')->get();
                   ->paginate(5);  
                
                
                
            }

        /*   
            $broadcasts = DB::table('broadcasts')
			->select('broadcasts.*', 'users.*')
			->selectRaw($rad_sel)
            ->leftJoin('users', 'broacasts.user_id', '=', 'users.user_id')
              ->whereRaw($search_where)
              ->where('broadcasts.location','like','%'.$location.'%')
             ->whereRaw("find_in_set($cat,brodadcasts.cat_id)")
              ->orderBy('distance','asc')
            //->Where('name', 'like', '%' . Input::get('name') . '%')->get();
           ->get();  */
      }
      else
      {
        //return "inside";    
        if(Auth::user())
        {
        $broadcasts = DB::table('broadcasts')
			->select('broadcasts.*', 'users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
			->selectRaw($rad_sel_bc)
            ->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
            //->Where('descrption', 'like', '"%' . $keyword . '%"')
              ->whereRaw($search_where_bc)
              ->whereRaw($rad_where_bc)
               ->whereRaw($cat_where_bc)
               ->where('broadcasts.user_id', '<>', Auth::user()->user_id)
            ->orderBy('distance','asc')
             
            //->Where('name', 'like', '%' . Input::get('name') . '%')->get();
           ->paginate(5);
        }
        else
        {
           $broadcasts = DB::table('broadcasts')
			->select('broadcasts.*', 'users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
			->selectRaw($rad_sel_bc)
            ->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
            //->Where('descrption', 'like', '"%' . $keyword . '%"')
              ->whereRaw($search_where_bc)
              ->whereRaw($rad_where_bc)
               ->whereRaw($cat_where_bc)
              //   ->where('broadcasts.user_id', '<>', Auth::user()->user_id)
            ->orderBy('distance','asc')
             
            //->Where('name', 'like', '%' . Input::get('name') . '%')->get();
           ->paginate(5);  
        }
      }   
            $html=''; 
         foreach ($broadcasts as $broadcast) {
            $html.='<div class="btm_user_listing_wrap">';
            $html.= '<div class="btm_user_listing">';
            $html.= '<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">';
            $html.= ' <div class="wh_profile_pic_btm">';
            if($broadcast->is_online == 1)
            {
            $html.= '<span class="wh_profile_pic_top_active">';
            $html.= '<i class="fa fa-circle"></i>';
            $html.= '</span>';
            }
            
            $html.= '<a href='.Helper::get_url().'/user/'.$broadcast->user_id.'>';
            
            if($broadcast->dp_changed == 1)
            $html.= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$broadcast->profile_pic.'></a>';
            elseif($broadcast->facebook_profile_dp != NULL)
            $html.= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$broadcast->facebook_profile_dp.'></a>';
            elseif($broadcast->google_profile_dp != NULL)
            $html.= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$broadcast->google_profile_dp.'></a>';
            else
            $html.= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src="images/profile.png"></a>';
            
            $html.= '</div>';
            
            $html.= '<p class="distance">';
            $loc_arr = explode(",",$broadcast->location);
            
            if(count($loc_arr)>=2)
            {
            $location_new = $loc_arr[0].",".$loc_arr[1];
            $html.= $location_new.'</p>';
            }
            else
            $html.= $loc_arr[0].'</p>';
            
            $html.= '</div>';
            $html.= '<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">';
            $html.= '<div class="wh_name_btm">';
            $html.= '<a href='.Helper::get_url().'/user/'.$broadcast->user_id.'>';
            $html.= '<p>'.$broadcast->name.'</p>';
            $html.= '</a>';
            $html.= '</div>';
            $html.= '<div class="wh_brdcast_btm">';
            $html.= $broadcast->description;
            $html.= '</div>';
            $html.= '</div>';
             $temp_id = substr($broadcast->broadcast_id,2);
            $html.= '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">';
            if(Auth::user())
            //$html.= '<button onclick="new_chat('.$temp_id.',1)" class="btn btn-chat-btm pull-right col-lg-12 col-md-12 col-sm-12 col-xs-12">CHAT</button>';
            $html.= '<button id="open_chat" onclick="open_chat1('.$temp_id.',1)" class="btn btn-chat-btm pull-right col-lg-12 col-md-12 col-sm-12 col-xs-12">CHAT</button>';
            else
            $html.= '<button onclick="show_login_form()" class="btn btn-chat-btm pull-right col-lg-12 col-md-12 col-sm-12 col-xs-12">CHAT</button>';
            $html.= '<div class="clearfix"></div>';
            $html.= '</div>';

            $html.= '<div class="clearfix"></div>';
            $html.= '</div>';
            $html.= '<div class="clearfix"></div>';
            $html.= '</div>';
            
        }
       // return $broadcasts;
       
        if ($request->ajax() && $type == "Broadcast") {
          
            return $html;
        }
        
        if(!empty($location))
        
        {
            //return 1;
            $swaps = DB::table('swaps')
			->select('swaps.*', 'users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
			->selectRaw($rad_sel_sw)
		
			->whereRaw($rad_where_sw)
			->whereRaw($search_where_sw)
			->whereRaw($cat_where_sw)
            ->leftJoin('users', 'swaps.user_id', '=', 'users.user_id')
            ->orderBy('distance','asc')
            //->get();
            ->paginate(5); 
            //return $swaps;
        }
        else
        {
        $swaps = DB::table('swaps')
			->select('swaps.*', 'users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
			->selectRaw($rad_sel_sw)
		
		    ->whereRaw($search_where_sw)
			->whereRaw($rad_where_sw)
			->whereRaw($cat_where_sw)
            ->leftJoin('users', 'swaps.user_id', '=', 'users.user_id')
            ->orderBy('distance','asc')
            ->paginate(5); 
        }
        
        $sw_tagstring  = '';
       $current_date = date('Y-m-d H:i:s', time());
        foreach ($swaps as $swap) 
	    {
	    $loc_arr = explode(",",$swap->location);
        if(count($loc_arr)>2)
        $location = $loc_arr[0]." ".$loc_arr[1];     
	     $temp_title = preg_replace('/\s+/', '-', $location.'-'.$swap->title);    
        $sw_tagstring.='<li>';
     
        $sw_tagstring.='<div class="swap_list_item sw_normal_item">';
        $sw_tagstring.='<div class="swap_list_item_top">';
        
        
        if($swap->for_price!=null && $swap->for_goods!=null)
        {
        $sw_tagstring.='<span style="z-index: 1;" class="price_tag"><i aria-hidden="true" class="fa fa-inr"></i>&nbsp;'.$swap->for_price.' or '. $swap->for_goods .'</span>';
        }
        else if($swap->for_price!=null && $swap->for_goods==null)
        {
          $sw_tagstring.='<span style="z-index: 1;" class="price_tag"><i aria-hidden="true" class="fa fa-inr"></i>&nbsp;'. $swap->for_price .'</span>';   
            
        }
         else if($swap->for_price==null && $swap->for_goods!=null)
        {
        $sw_tagstring.='<span style="z-index: 1;" class="price_tag">'. $swap->for_goods .'</span>';
        }
        else if($swap->for_any == 1)
        {
          $sw_tagstring.='<span style="z-index: 1;" class="price_tag">Open for Anything</span>';   
        }
        else if($swap->for_free == 1)
        {
            
          $sw_tagstring.='<span style="z-index: 1;" class="price_tag">For Free</span>';
        }
        $img_arr = explode(",",$swap->images);
        //$image = $img_arr[0];
        
        
        
        $sw_tagstring .='<a href='.Helper::get_url().'/swap/'.strtolower($temp_title).'-'.strtolower($swap->swap_id).'>';
        $sw_tagstring .= '<div class="sw_detail_thumb">';                            
        $sw_tagstring .= '<div class="swap_slider" style="margin:0px 0px;">';
        $sw_tagstring .= '<div id="carousel-custom'.$swap->swap_id.'" class="carousel slide" data-ride="carousel">';
        $sw_tagstring .= '<div class="carousel-outer">';
        
        $sw_tagstring .= '<div class="carousel-inner">';
        
        for ($i = 0; $i < count($img_arr); $i++)
        {
            if ($i==0)
            {
                $sw_tagstring .= '<div class="item active">';
                //$lv_tagstring .= '<img src="{{(new \App\Http\Controllers\Helper)->get_lv_image_loc()}}{{$images[$i]}}" alt="">';
                $sw_tagstring .='<img style="height: auto !important;"  src='.Helper::get_swap_image_loc().$img_arr[$i].' alt="">';
                $sw_tagstring .= '</div>';
            }
            else
            {
                $sw_tagstring .= '<div class="item">';
                //$lv_tagstring .= '<img src="{{(new \App\Http\Controllers\Helper)->get_lv_image_loc()}}{{$images[$i]}}" alt="">';
                $sw_tagstring .='<img style="height: auto !important;" src='.Helper::get_swap_image_loc().$img_arr[$i].' alt="">';
                $sw_tagstring .= '</div>';
            }
        }
    
        $sw_tagstring .= '</div>';            
        if(count($img_arr) > 1)
        {
        $sw_tagstring .= '<a class="left carousel-control" href="#carousel-custom'.$swap->swap_id.'" data-slide="prev">';
        $sw_tagstring .= '<span class="fa fa-chevron-left"></span>';
        $sw_tagstring .= '</a>';
        $sw_tagstring .= '<a class="right carousel-control" href="#carousel-custom'.$swap->swap_id.'" data-slide="next">';
        $sw_tagstring .= '<span class="fa fa-chevron-right"></span>';
        $sw_tagstring .= '</a>';
        }
        $sw_tagstring .= '</div>';                            
        
        
        
        $sw_tagstring .= '</div>';
        $sw_tagstring .= '</div>';
        $sw_tagstring .= '</div>';
        
        $sw_tagstring .= '</a>';
        
        
       /* 
        
         $sw_tagstring .='<a target="_blank" href='.Helper::get_url().'/swap/'.$temp_title.'-'.$swap->swap_id.'>';
        $sw_tagstring .='<img src='.Helper::get_swap_image_loc().$image.' alt="">';
        $sw_tagstring .= '</a>';
                                                
        
        
        */
        
        
        
        
        
        $sw_tagstring .='</div>';
        $sw_tagstring .='<div class="swap_list_item_btm">';
        $sw_tagstring .='<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 swap_prof_pic_wrap">';
        if($swap->is_online == 1)
        {
        $sw_tagstring .='<span class="swap_prof_online_batch"><i class="fa fa-circle"></i></span>';
        }
        
        
        /*$sw_tagstring .='<img src="images/profile.png">';*/
        
        $sw_tagstring .= '<a href='.Helper::get_url().'/user/'.$swap->user_id.'>';
            
        if($swap->dp_changed == 1)
        $sw_tagstring .= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$swap->profile_pic.'></a>';
        elseif($swap->facebook_profile_dp != NULL)
       $sw_tagstring .= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$swap->facebook_profile_dp.'></a>';
        elseif($swap->google_profile_dp != NULL)
        $sw_tagstring .= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$swap->google_profile_dp.'></a>';
        else
        $sw_tagstring .= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src="images/profile.png"></a>';
            
        //return $swap->location;
        $loc_arr = explode(",",$swap->location);
        if(count($loc_arr)>=2)
        {
        $location_new = $loc_arr[0].",".$loc_arr[1];
        $sw_tagstring.= '<p>'.$location_new.'</p>';
        }
        else
        $sw_tagstring.= '<p>'.$loc_arr[0].'</p>';
        //return $location;
        
        //$sw_tagstring .='<p>'.$swap->location.'</p>';
        $sw_tagstring .='</div>';
        $sw_tagstring .='<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 swap_title_wrap">';
       // $sw_tagstring .='<h4><a target="_blank" href='.Helper::get_swap_image_loc().$swap->swap_id.'>'.$swap->title.'</a></h4>';
       
       
       
       
      // $temp_title = $swap_title;
       $sw_tagstring .='<h4><a href='.Helper::get_url().'/swap/'.$temp_title.'-'.$swap->swap_id.'>'.$swap->title.'</a></h4>';
        
        
        $datetime1 = new DateTime($swap->created_at);
        $datetime2 = new DateTime($current_date);
        $interval = $datetime1->diff($datetime2);
        if($interval->d != 0)
        {
        $string = $interval->d > 1 ? " days ago" : " day ago";
        $swap->ago = $interval->d.$string;
        }
        elseif($interval->d == 0)
        {
             if($interval->h != 0)
             {
                $string = $interval->h > 1 ? " hours ago" : " hour ago";
                $swap->ago = $interval->h .$string;
             }
             else if($interval->m != 0)
             {
                $string = $interval->m > 1 ? " minutes ago" : " minute ago";
                $swap->ago = $interval->m .$string;
             }
             else
             {
                $string = $interval->s > 1 ? " seconds ago" : " second ago";
                $swap->ago = $interval->s .$string;
             }
        }
        
        
        $sw_tagstring .='<p>'.$swap->ago.'</p>';
        if($swap->is_paid == 1)
        $sw_tagstring.='<br/><span style="color:  yellow;background:  none;border-style:  solid;padding:  3px;border-width:  1px;float: right;"><i class="fa fa-star" aria-hidden="true"></i>&nbsp;&nbsp;<b>Sponsored</b></span>';
        
        //$ago = 1;
        //$sw_tagstring .='<p>'.$ago.'</p>';
        $sw_tagstring .='</div>';
        $sw_tagstring .='<div class="clearfix"></div>';
        $sw_tagstring .='</div>';
        $sw_tagstring .='</div>';
        
        $sw_tagstring .='</li>';
        }
         //return $sw_tagstring;
         //return $sw_tagstring;   
         if ($request->ajax() && $type == "Swap") {
            
            //return 1;
           return $sw_tagstring;
        }
    
    /*if($keyword =="")
    {
    $localvocals = DB::table('localvocals')
			->select('localvocals.*', 'users.name','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online','users.dp_changed')
			->whereRaw($cat_where_lv)
			 ->whereRaw($search_where_lv)
            ->leftJoin('users', 'localvocals.user_id', '=', 'users.user_id')
            ->paginate(5); 
    }
    else
    {*/
    $localvocals = DB::table('localvocals')
			->select('localvocals.*', 'users.name','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online','users.dp_changed')
			->selectRaw($rad_sel_lv)
            ->whereRaw($rad_where_lv)
		    
		    ->whereRaw($search_where_lv)
		    ->whereRaw($cat_where_lv)
            ->leftJoin('users', 'localvocals.user_id', '=', 'users.user_id')
            ->orderBy('distance','asc')
            ->paginate(5); 
    //}
            
    $lv_tagstring = '';
    $current_date = date('Y-m-d H:i:s', time());
    foreach ($localvocals as $localvocal) 
    {
    
    
    $lv_details = DB::table($this->rest->tbl_lv_like_share)->select('like_count','like_details')->where('lv_id',$localvocal->lv_id)->get()->first();
        //return var_dump($lv_details);
        if(!empty($lv_details))
        {
        //return "inside";
           $like_details = (!empty($lv_details->like_details))? json_decode($lv_details->like_details):array();
          // return $like_details;
           $update_data = array();          
           $is_it = 0;
           $localvocal->likes_count = count($like_details);
          
          if(Auth::user())
          {
           foreach ($like_details as $value)
           {
              if($value->user_id==Auth::user()->user_id)
                  $is_it = 1;
            
           }                       
           if($is_it===1)
           {
            
              $localvocal->like_status = "liked";
           }
           else
           {
            
             $localvocal->like_status = "none";
           }   
          }
          else
           $localvocal->like_status = "none";
                           
           
        }
        else
        {
             $localvocal->likes_count = 0;
             $localvocal->like_status = "none";
        }
    
    
    $comments = DB::table($this->rest->tbl_lv_comments)->select('lv_comments.user_id','lv_comments.comment','lv_comments.created_at','users.is_online','users.name','users.google_profile_dp','users.facebook_profile_dp','users.is_online','users.dp_changed','users.profile_pic')
                            ->where('lv_comments.lv_id',$localvocal->lv_id)
                            ->join('users', 'users.user_id', '=', 'lv_comments.user_id')  
                            ->limit(4)
                            ->orderBy('lv_comments.id')
                            ->get();

    $lv_tagstring .= '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">';
    $lv_tagstring .= '<div class="lv_post_list">';
    $lv_tagstring .= '<div class="lv_post_list_top">';
    $lv_tagstring .= '<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 lv_post_name">';
    
    
    
     if($localvocal->dp_changed == 1)
        $lv_tagstring .= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$localvocal->profile_pic.'></a>';
        elseif($localvocal->facebook_profile_dp != NULL)
       $lv_tagstring .= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$localvocal->facebook_profile_dp.'></a>';
        elseif($localvocal->google_profile_dp != NULL)
        $lv_tagstring .= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$localvocal->google_profile_dp.'></a>';
        else
        $lv_tagstring .= '<img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src="images/profile.png"></a>';
    
    
   /* $lv_tagstring .= '<img src="images/profile.png">&nbsp;&nbsp;';*/
    $lv_tagstring .= '<a href='.Helper::get_url().'/user/'.$localvocal->user_id.'>';
    $lv_tagstring .='&nbsp;&nbsp;'.$localvocal->name;
     $lv_tagstring .= '</a>';
    $lv_tagstring .= '</div>';
    $lv_tagstring .= '<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 lv_post_time">';
     $loc_arr = explode(",",$localvocal->location);
     if(count($loc_arr)>=2)
     $localvocal->location = $loc_arr[0].",".$loc_arr[1];
     else
     $localvocal->location = $loc_arr[0];
     $lv_tagstring .= '<b><i style="color:  red;" class="fa fa-location-arrow" aria-hidden="true"></i>&nbsp;&nbsp;'.$localvocal->location.'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $datetime1 = new DateTime($localvocal->created_at);
    $datetime2 = new DateTime($current_date);
    $interval = $datetime1->diff($datetime2);
    if($interval->d != 0)
    {
    $string = $interval->d > 1 ? " days ago" : " day ago";
    $localvocal->ago = $interval->d.$string;
    }
    elseif($interval->d == 0)
    {
         if($interval->h != 0)
         {
            $string = $interval->h > 1 ? " hours ago" : " hour ago";
            $localvocal->ago = $interval->h .$string;
         }
         else if($interval->m != 0)
         {
            $string = $interval->m > 1 ? " minutes ago" : " minute ago";
            $localvocal->ago = $interval->m .$string;
         }
         else
         {
            $string = $interval->s > 1 ? " seconds ago" : " second ago";
            $localvocal->ago = $interval->s .$string;
         }
    }
    
    $lv_tagstring .= $localvocal->ago;
    //$lv_tagstring .= 1;
    $lv_tagstring .= '</div>';
    $lv_tagstring .= '<div class="clearfix"></div>';
    $lv_tagstring .= '</div>';
    /*$lv_tagstring .= '<div class="lv_post_list_thumb">';
    $img_arr = explode(",",$localvocal->images);
    $image = $img_arr[0];*/
    
    
    $image = explode(",",$localvocal->images);
    $lv_tagstring .= '<a href='.Helper::get_url().'/lv/'.$localvocal->lv_id.'>';
    $lv_tagstring .= '<div class="sw_detail_thumb">';                            
    $lv_tagstring .= '<div class="swap_slider" style="margin:0px 0px;">';
    $lv_tagstring .= '<div id="carousel-custom'.$localvocal->lv_id.'" class="carousel slide" data-ride="carousel">';
    $lv_tagstring .= '<div class="carousel-outer">';
    
    $lv_tagstring .= '<div class="carousel-inner">';
    
    for ($i = 0; $i < count($image); $i++)
    {
        if ($i==0)
        {
            $lv_tagstring .= '<div class="item active">';
            //$lv_tagstring .= '<img src="{{(new \App\Http\Controllers\Helper)->get_lv_image_loc()}}{{$images[$i]}}" alt="">';
            $lv_tagstring .='<img style="height: 100% !important;" src='.Helper::get_lv_image_loc().$image[$i].' alt="">';
            $lv_tagstring .= '</div>';
        }
        else
        {
            $lv_tagstring .= '<div class="item">';
            //$lv_tagstring .= '<img src="{{(new \App\Http\Controllers\Helper)->get_lv_image_loc()}}{{$images[$i]}}" alt="">';
            $lv_tagstring .='<img style="height: 100% !important;" src='.Helper::get_lv_image_loc().$image[$i].' alt="">';
            $lv_tagstring .= '</div>';
        }
    }

    $lv_tagstring .= '</div>';            
    if(count($image) > 1)
    {
    $lv_tagstring .= '<a class="left carousel-control" href="#carousel-custom'.$localvocal->lv_id.'" data-slide="prev">';
    $lv_tagstring .= '<span class="fa fa-chevron-left"></span>';
    $lv_tagstring .= '</a>';
    $lv_tagstring .= '<a class="right carousel-control" href="#carousel-custom'.$localvocal->lv_id.'" data-slide="next">';
    $lv_tagstring .= '<span class="fa fa-chevron-right"></span>';
    $lv_tagstring .= '</a>';
    }
    $lv_tagstring .= '</div>';                            
    
    
    
    $lv_tagstring .= '</div>';
    $lv_tagstring .= '</div>';
    $lv_tagstring .= '</div>';
    
    $lv_tagstring .= '</a>';
    
    
    
    
    
    
    
    /*
    $lv_tagstring .= '<a target="_blank" href='.Helper::get_url().'/lv/'.$localvocal->lv_id.'>';
    
    $lv_tagstring .= '<img src='.Helper::get_lv_image_loc().$image.'></a>';
    $lv_tagstring .= '</div>';*/
    $lv_tagstring .= '<div class="lv_post_list_text">';
    $lv_tagstring .= '<b>'.$localvocal->title.'</b><br><br>';
    $lv_tagstring .= $localvocal->description;
    $lv_tagstring .= '</div>';
    $count_lv_comments =  DB::select( DB::raw("SELECT COUNT(*) as count FROM lv_comments c where  c.lv_id = '".$localvocal->lv_id."'"));
    $localvocal->total_comments = $count_lv_comments;
    if($count_lv_comments[0]->count == 0)
    {
    $lv_tagstring .= '<div class="lv_post_list_view_cmts">';
    $lv_tagstring .= 'no comments yet';
    $lv_tagstring .= '</div>';
    }
    else
    {
    //$lv_tagstring .= '<div class="lv_post_list_view_cmts">';
    //$lv_tagstring .= 'View all ' . count($localvocal->total_comments[0]) .' comments';
    //$lv_tagstring .= 'View all ' .  $count_lv_comments[0]->count .' comments';
    //$lv_tagstring .= '</div>';
    }
    $lv_tagstring .= '<div style="display:none;" id="'.$localvocal->lv_id.'" class="lv_post_list_cmts_wrap">';
    foreach($comments as $comment)
    {
        
        
     $lv_tagstring .= '<div class="post-comment" style="display:inline-flex;margin: 10px auto;">';
     
     
     if($comment->dp_changed == 1)
        $lv_tagstring .= '<img style="margin-right: 10px;" src="'.$comment->profile_pic.'" alt="" class="profile-photo-sm" />';
     
     elseif($comment->facebook_profile_dp != NULL)
        $lv_tagstring .= '<img style="margin-right: 10px;" src="'.$comment->facebook_profile_dp.'" alt="" class="profile-photo-sm" />';
      
     elseif($comment->google_profile_dp != NULL)

        $lv_tagstring .= '<img style="margin-right: 10px;" src=""'.$comment->google_profile_dp.'" alt="" class="profile-photo-sm" />';

    else
       $lv_tagstring .= '<img style="margin-right: 10px;" src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />';
       
       
      $lv_tagstring .= '<p><a class="profile-link" href='.Helper::get_url().'/user/'.$comment->user_id.'>';
      
      $lv_tagstring .= $comment->name;
      $lv_tagstring .='</a>';
     
     $lv_tagstring .='<i class="em em-laughing"></i>&nbsp;&nbsp;&nbsp;'.$comment->comment.'</p>';
     
     
     $lv_tagstring .= '</div></br>';
     
      
     
        
   /* $lv_tagstring .= '<div class="lv_post_list_cmts_list">';
    $lv_tagstring .= '<span class="cmts_name">'.$comment->name.'</span>&nbsp;&nbsp;';
    $lv_tagstring .= '<span class="cmts_text">'.$comment->comment.'</span>';
    $lv_tagstring .= '</div>';*/
    }
    
    
    $lv_tagstring .= '</div>';
    $temp_id = substr($localvocal->lv_id,2);
    if(Auth::user())                
    {
    //$lv_tagstring .= '<div class="lv_post_list_cmts_list">';
    
    //$lv_tagstring .= '<img src="http://placehold.it/300x300" alt="" class="profile-photo-sm">&nbsp;&nbsp;&nbsp;'.Auth::user()->name;

   
    
   // $lv_tagstring .= '<input onkeypress="return savecomment(event,'.$temp_id.')" id="cmt_'.$localvocal->lv_id.'" type="text" class="form-control" placeholder="Post a comment">';
  // $lv_tagstring .= '<input onkeypress="return runScript(event)" id="cmt_'.$localvocal->lv_id.'" type="text" class="form-control" placeholder="Post a comment">';
  
  
  
    $lv_tagstring .= '<div class="post-comment" style="display:inline-flex;margin: 10px auto;">';
    
    
     if(Auth::user()->dp_changed == 1)
        $lv_tagstring .= '<img class="profile-photo-sm" style="margin-left: 23px;margin-right: 12px;border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.Auth::user()->profile_pic.'></a>';
        elseif(Auth::user()->facebook_profile_dp != NULL)
       $lv_tagstring .= '<img class="profile-photo-sm" style="margin-left: 23px;margin-right: 12px;border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.Auth::user()->facebook_profile_dp.'></a>';
        elseif(Auth::user()->google_profile_dp != NULL)
        $lv_tagstring .= '<img class="profile-photo-sm" style="margin-left: 23px;margin-right: 12px;border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.Auth::user()->google_profile_dp.'></a>';
        else
        $lv_tagstring .= '<img class="profile-photo-sm" style="margin-left: 23px;margin-right: 12px;border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src="images/profile.png">';
    
    
   // $lv_tagstring .= '<img style="margin-left: 22px;margin-right: 10px;" src="http://placehold.it/300x300" alt="" class="profile-photo-sm">';
    $lv_tagstring .= '<input onkeypress="return savecomment(event,'.$temp_id.')" id="cmt_'.$localvocal->lv_id.'" style="width:570px !important" type="text" placeholder="Post a comment" class="form-control"></div>';
    
 
    
    //$lv_tagstring .= '</div>';
    }
    
    
    $lv_tagstring .= '<div class="lv_post_list_btm">';
    $lv_tagstring .= '<div onclick="like_unlike_lv('.$temp_id.')" class="col-lg-2 col-md-2 col-sm-3 col-xs-4 lv_post_like'.$localvocal->lv_id.'">';
   //return $localvoca
    if($localvocal->like_status == "liked")
    $lv_tagstring .= '<i style="color:#ed474f !important" class="fa fa-heart"></i>&nbsp;&nbsp;'.$localvocal->likes_count;
    else
    $lv_tagstring .= '<i style="color:unset !important;" class="fa fa-heart"></i>&nbsp;&nbsp;'.$localvocal->likes_count;
    
    $lv_tagstring .= '</div>';
    $temp_id = substr($localvocal->lv_id,2);
    $lv_tagstring .= '<div onclick="show_comments('.$temp_id.')" class="col-lg-2 col-md-2 col-sm-3 col-xs-4 lv_post_cmt">';
    $lv_tagstring .= '<i class="fa fa-comment-o" aria-hidden="true"></i>&nbsp;&nbsp;'.$count_lv_comments[0]->count;
    $lv_tagstring .= '</div>';
    $lv_tagstring .= '<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 lv_post_share">';
     $lv_tagstring .= '<div class="dropdown">';
    $lv_tagstring .= '<button class="btn" type="button" data-toggle="dropdown"><i class="fa fa-share" aria-hidden="true"></i></button>';
    
    
     $lv_tagstring .= '<ul class="dropdown-menu">';
    $lv_tagstring .= "<li>";
   
    $lv_tagstring .= Share::page(Helper::get_url()."/lv/".$localvocal->lv_id, $localvocal->title)->facebook() ->twitter() 	->googlePlus()	->linkedin('Extra linkedin summary can be passed here');
    $lv_tagstring .= "</li>";              
    $lv_tagstring .= '</ul>';
      $lv_tagstring .= '</div>';
    
    $lv_tagstring .= '</div>';
    $lv_tagstring .= '<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 pull-right lv_post_morebtns">';                                    
    $lv_tagstring .= '<div class="dropdown">';
    $lv_tagstring .= '<button class="btn" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>';
    $lv_tagstring .= '<ul class="dropdown-menu">';
    $lv_tagstring .= '<li><a href="#">Report</a></li>';              
    $lv_tagstring .= '</ul>';
    $lv_tagstring .= '</div>';
    
    $lv_tagstring .= '</div>';
    $lv_tagstring .= '<div class="clearfix"></div>';
    $lv_tagstring .= '</div>';
    $lv_tagstring .= '<div class="clearfix"></div>';
    $lv_tagstring .= '</div>';
 
    $lv_tagstring .= '</div>';
    }    
    
    if ($request->ajax() && $type == "LocalVocal") {
            
            //return 1;
           return $lv_tagstring;
        }
    //$location = file_get_contents('http://freegeoip.net/json/'.$_SERVER['REMOTE_ADDR']);
    //$parsedJson  = json_decode($location);
    
   // $ip_city = $parsedJson->city;
    //$latitude = 12.9972;
   // $longitude = 77.6143;
    
    //$geocodeFromLatLong = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=false'); 
    //$output = json_decode($geocodeFromLatLong);
    //$status = $output->status;
    //$address = ($status=="OK")?$output->results[1]->formatted_address:'';
    
    //return $address;
        
     // $val =  $this->getlocation($parsedJson->latitude,$parsedJson->longitude);
     // return $val;
        //return count($location);
       // Log::info("hello");
       /* $hash = Hash::make("27");
        $rd = DB::table('users')
            ->where('id', 11)
            ->update(['password' => $hash]);*/
           // return;
        
       // $pass = Hash::make(Input::get("password",""));
        
       // $db =  DB::select( DB::raw("UPDATE `users` SET `password` = '1' WHERE `users`.`id` = '11';")); 
        
        
       // UPDATE `users` SET `password` = '3210' WHERE `users`.`id` = 11;
        
   /* $userdata = array(
        'id'     => 11,
        'password'  => 27,
        );
*/
    // attempt to do the login
   /* if (Auth::attempt($userdata)) {

        //return Auth::user()->id;
       // return "Success";
        //echo 'SUCCESS!';

    } else {        
       // return "Failed";
        // validation not successful, send back to form 
        //return Redirect::to('login');

    }*/
		
    	$data = array(); 

		//$broadcasts = Broadcast::all();
		//return $broadcasts;
		
		
		
		
		
        if(Auth::user())
        {
		$paid_broadcasts = DB::table('broadcasts')
			->select('broadcasts.*', 'users.is_online','users.name','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp')
			->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
			->where('is_paid',1)
			->where('broadcasts.user_id', '<>', Auth::user()->user_id)
			//->selectRaw($rad_sel_bc)
                
            ->where('broadcasts.current_broadcast',1)
            
                // ->whereRaw($rad_where_bc)
            //->orderBy('distance','asc')
            
            ->limit(4)
            ->get();
        }
        else
        {
         $paid_broadcasts = DB::table('broadcasts')
			->select('broadcasts.*', 'users.is_online','users.name','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp')
			->where('is_paid',1)
			 ->where('broadcasts.current_broadcast',1)
			// ->where('broadcasts.user_id', '<>', Auth::user()->user_id)
            ->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
            ->limit(4)
            ->get();  
            
        }
        
        foreach($paid_broadcasts as $paid_broadcast)
        {
             $loc_arr = explode(",",$paid_broadcast->location);
            
            if(count($loc_arr)>2)
            $paid_broadcast->location = $loc_arr[0].",".$loc_arr[1];
            
        }
	//	return $paid_broadcasts;
		
		/*Broadcast::where('is_paid','=','1')
			->select('broadcasts.*', 'users.name')
			->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
			->inRandomOrder()
			->limit(2)
			->get();*/
		
		/*$broadcasts = DB::table('broadcasts')
			->select('broadcasts.*', 'users.name')
            ->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
            //->Where('name', 'like', '%' . Input::get('name') . '%')->get();
           ->paginate(8);
        //return $broadcasts;
        
        //return $broadcasts;
        
        $swaps = DB::table('swaps')
			->select('swaps.*', 'users.name')
            ->leftJoin('users', 'swaps.user_id', '=', 'users.user_id')
            ->get(); 
         //return $swaps;       
            
         $localvocals = DB::table('localvocals')
			->select('localvocals.*', 'users.name')
            ->leftJoin('users', 'localvocals.user_id', '=', 'users.user_id')
            ->get();  */
            
        //return $localvocals;
        
        if(!Auth::user())
        {
        $Auth_user_id = "";    
        }
        else
        {
        $Auth_user_id = Auth::user()->user_id;
        }
        $sugg_users = DB::table('users')
			->select('users.*')
			->where('name','<>',null)
			->where('user_id','<>',$Auth_user_id)
			->inRandomOrder()
			->limit(3)
            //->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
            ->get();
       
        //return $sugg_users;    
            
		
		
		
		//Log::info('Showing user profile for user: ');
		
		
		$categories = DB::table('categories')
		//	->where('blocked_by_admin','=','0')
			->select('category_title','logo_image','id')
		//	->where('id','<>',1)
			->get();
			
		$user_notifications = 0;
		if(Auth::user())
		$user_notifications = DB::table('user_notifications')
			->where('to_user_id','=',Auth::user()->user_id)
			->where('is_shown','=',0)
	        ->count();	
			
		//return $categories;	
        return view('wannahelp.index',['title'=>'Wannahelp Home','categories'=>$categories,'broadcasts'=>$broadcasts,'paid_broadcasts'=>$paid_broadcasts,'swaps'=>$swaps,'localvocals'=>$localvocals,'sugg_users'=>$sugg_users,'user_notifications'=>$user_notifications]);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
	public function saveupdatepassword()
	{
	    //27
	  //  $old_password = Input::get( 'old_password' );
	 // return gettype($old_password);
	   // $hashed_old = Hash::make($old_password);
	    
	    $new_password = Input::get( 'new_password' );
	    $confirm_password = Input::get( 'confirm_password' );
	    
	    if($new_password != $confirm_password)
	    {
	        return "Password Mismatch. Please try again!";
	    }   
	   else
	   {
	       
	        $hashed_old = Hash::make($new_password);
	        $sts = DB::table('users')
                ->where('user_id', Auth::user()->user_id)
                ->update(['password' => $hashed_old]);
            if($sts == 1)
                return "Successfully Updated.";
            else
                return "Something went wrong.";
	        
	        
	   }
	   /*
	    $hashed_user_password = (string)User::where('user_id',Auth::user()->user_id)->pluck('password');
	    return gettype($hashed_user_password);
	    $hashed = "'".$hashed_user_password."'";
	     $non = "'".$old_password."'";
	    $hashed_old = Hash::make($old_password);
	    
	    //if(Hash::check($old_password, '$2y$10$y/XE5zHeAKOQea/IaaNM6eRqGcBBwIMWiIZAXgLnLPXSTU95oqste'))
	    if(Hash::check($old_password, $hashed_user_password))
	    return "same";
	   // if($hashed_user_password ==  $hashed_old)
	     else
	   return "different";
	   
	    return $user_password;
	    //return $old_password.$new_password.$confirm_password;
	    
	    //$sts = DB::table('users')
           // ->where('user_id', Auth::user()->user_id)
           // ->update(['profile_pic' => $file_loc,'dp_changed' => 1]);
           // return;
	    
	    /*if($sts == 1)
	    return "ok";
	    else
	    return "Something went wrong. Please try again.";*/
	    
	    //return $file_loc;
	}
	
	public function savebasicbio()
	{
	    $firstname = Input::get( 'firstname' );
	    $lastname = Input::get( 'lastname' );
	    $email = Input::get( 'email' );
	    $day = Input::get( 'day' );
	    $month = Input::get( 'month' );
	    $year = Input::get( 'year' );
	    $mobile = Input::get( 'mobile');
	    $gender = Input::get( 'gender');
	    if($year == "year" || $month == "month" || $day == "day")
	    $dob = NULL;
	    else
	    $dob = $year."-".$month."-".$day;
	    
	    $aboutme = Input::get( 'aboutme');
	    $profession = Input::get( 'profession');
	    $city = Input::get( 'city');
	    
	    // return $firstname.$lastname.$email.$gender.$day.$month.$year.$profession.$city.$mobile.$aboutme;
	    $sts = DB::table('users')
            ->where('user_id', Auth::user()->user_id)
            ->update(['name' => $firstname,'last_name' => $lastname,'email' => $email,'dob' => $dob,'mobile' => $mobile,'gender' => $gender]);
           // return;
	     $sts1 = DB::table('user_details')
            ->where('user_id', Auth::user()->user_id)
            ->update(['current_location' => $city,'profession' => $profession,'about_me' => $aboutme]);
           
	    if($sts == 0 || $sts == 1 && $sts1 == 1 || $sts1 == 0 )
	    return "ok";
	    else
	    return "Something went wrong. Please try again.";
	    
	    //return $file_loc;
	}
	
	
	public function savedp()
	{
	    
	    
	   $total = count($_FILES['s1_file']['name']);
	  // return $_FILES['s1_file']['name'];
	   
	   
	   if($_FILES['s1_file']['name'][0] == "")
	    {
	        return "Select a profile picture. ";
	    }
	    
	     $upload_data = $this->s3->upload_multiple_files('','s1_file','profile_pic','thumb'); 
        //return print_r($upload_data);
        if($upload_data['error']=='YES')
          {	  			
  	        return "Invalid File Format. Please select again";
          }
          else
          {	  			
  	        foreach ($upload_data['files'] as $row)
  	        {
  		        if($row['error']==NULL)
  			        $images[] = $row['filename'];	
  			        //return count($upload_data['files']);
  	        }
  	        
  	        //return "ok";
          }	
	    //return $images;
	    $file_loc = Helper::get_profile_pic_image_loc().$images[0];
	    
	    $update_pic = DB::table('users')
            ->where('user_id', Auth::user()->user_id)
            ->update(['profile_pic' => $file_loc,'dp_changed' => 1]);
           // return;
	    
	    if($update_pic == 1)
	    return "ok";
	    else
	    return "Something went wrong. Please try again.";
	    
	    //return $file_loc;
	}
	
	
		public function savecover()
	{
	    
	    
	   $total = count($_FILES['s1_file']['name']);
	  // return $_FILES['s1_file']['name'];
	   
	   
	   if($_FILES['s1_file']['name'][0] == "")
	    {
	        return "Select a cover picture. ";
	    }
	    
	     $upload_data = $this->s3->upload_multiple_files('','s1_file','cover_pic','thumb'); 
        //return print_r($upload_data);
        if($upload_data['error']=='YES')
          {	  			
  	        return "Invalid File Format. Please select again";
          }
          else
          {	  			
  	        foreach ($upload_data['files'] as $row)
  	        {
  		        if($row['error']==NULL)
  			        $images[] = $row['filename'];	
  			        //return count($upload_data['files']);
  	        }
  	        
  	        //return "ok";
          }	
	    //return $images;
	    $file_loc = Helper::get_cover_pic_image_loc().$images[0];
	    
	    $update_pic = DB::table('users')
            ->where('user_id', Auth::user()->user_id)
            ->update(['cover_pic' => $file_loc,'cover_changed' => 1]);
           // return;
	    
	    if($update_pic == 1)
	    return "ok";
	    else
	    return "Something went wrong. Please try again.";
	    
	    //return $file_loc;
	}
	
	
	public function send_otp()
    {
        $otp = $this->rest->get_otp();
        $mobile = Input::get('mobilenumber');
        if($mobile == "")
            return "Enter the mobile mumber";
        $country_code = 91;
        $mobile_count = DB::table('users')->where('mobile',$mobile)->count();
        if($mobile_count == 0)
        {
            return "not registered";
        }
        else
        {
        $rd = DB::table('users')
            ->where('mobile', $mobile)
            ->update(['otp' => $otp]);
        
      
        //$email = Input::get('email');
       
		
		$msg = 'Thanks for registering with WannaHelp. Your OTP is '.$otp;
//	return $this->rest->send_sms($country_code,$mobile,$msg);
    		if($this->rest->send_sms($country_code,$mobile,$msg))
    		{
    		    return "SMS Sent";
    		}
    		else
    		{
    		    return "SMS Not Sent";
    		}
		
        } 
        
    }   
    
    public function make_bc_current()
    {
        
      $bc_id = Input::get('broadcast_id');  
      
       $update_oneway = DB::table('broadcasts')
            ->where('broadcast_id',$bc_id)
            ->where('user_id', Auth::user()->user_id)
            ->update(['current_broadcast' => 1]);
            
        $update_otherway = DB::table('broadcasts')
            ->where('broadcast_id','<>',$bc_id)
            ->where('user_id', Auth::user()->user_id)
            ->update(['current_broadcast' => 0]);
    if( $update_oneway == 1 && $update_otherway == 1 )
        return "Successfully Updated";   
    else
        return "Error";
            
        
    }   
	
	public function register()
    {
        /*$email = Input::get('email');
        $password = Input::get('password');
        $hashed_password = Hash::make($password);
        $userdata = array(
                        'email'     => $email,
                        'password'  => $hashed_password
                    );
    	if(Auth::attempt($userdata))
    	    return "true";
    	    else
    	    return "false";*/

       
        $browserAgent = $_SERVER['HTTP_USER_AGENT'];
        //return $browserAgent;
        $mobile = Input::get('mobile');
        $country_code = "91";
        $username = Input::get('username');
        $email = Input::get('email');
        $password = Input::get('password');
        $hashed_password = Hash::make($password);
        $email_count = DB::table('users')->where('email',$email)->count();
        $username_count = DB::table('users')->where('username',$username)->count();
        $mobile_count = DB::table('users')->where('mobile',$mobile)->count();
        
        $email_verification_code = str_random(8);
        $otp = $this->rest->get_otp();
        $user_id = $this->rest->get_unique_userid();			
		$values = array(
			'user_id'=> $user_id,
			'email' => $email,
			'mobile' => $mobile,
			'username' => $username,
			'password' => $hashed_password,
			'os_type' => 'Web',
			'device_id' => $browserAgent,
			'otp' => $otp,
			'otp_verify' => 0,
			'device_modal' => NULL,
			'email_verification_code' => $email_verification_code, 
		//	'api_token' => $this->rest->get_unique_token(),
			'register_via' => 'MOBILE',
			'followers' => '',
			'following' => ''
		);
        
        $values_user_details = array(
			'user_id'=> $user_id,
			'about_me' => NULL,
			'profession' => NULL,
			'current_location' => NULL
		    );
            
           
        
        
        if($username == "" || $password == "" || $email == "" || $mobile == "")
        {
        return "Please enter all the fields!";
        }
        else
        {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return "Invalid email format"; 
            }
            if($email_count!= 0){
                return "Email Already Registered. Please Login";   
            }
            if($username_count!= 0){
                return "User name already taken. Please enter a new username";   
            }
            if($mobile_count!= 0){
                return "Mobile number is already registered. Please Login";   
            }
            
            if($this->rest->insert_values($this->rest->tbl_users,$values) && $this->rest->insert_values($this->rest->tbl_user_details,$values_user_details))
				{
					$msg = 'Thanks for registering with WannaHelp. Your OTP is '.$otp;
					$data['name']='';
			    	$data['email']=$email; 
			    	$data['email_token']=$email_verification_code;
			    	$userdata = array(
                        'email'     => $email,
                        'password'  => $password,
                    );
			    	if(Auth::attempt($userdata))
			    	{
			    	    
    			    	if($this->Smail->sendCustomMail($data) && $this->rest->send_sms($country_code,$mobile,$msg))
    					{
    						return "Success";
    					}
    					else
    					{
    						return "Success but no sms";
    					}
			    	    

			    	}

					
				}
				else
				{
					return "error";
					//response()->json(array('status'=>200,'message'=>'Error, Try later'));""
				}
            
            
            return "ok";    
            
        }
       // return 1;
        
        
        
        
        $userdata = array(
        'email'     => $email,
        'password'  => $password,
        );
        
        $categories = DB::table('categories')
		//	->where('blocked_by_admin','=','0')
			->select('category_title','logo_image','id')
			->get();
		$paid_broadcasts = DB::table('broadcasts')
			->select('broadcasts.*', 'users.name')
            ->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
            ->limit(4)
            ->get();
		//return $paid_broadcasts;
		
		/*Broadcast::where('is_paid','=','1')
			->select('broadcasts.*', 'users.name')
			->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
			->inRandomOrder()
			->limit(2)
			->get();*/
		
		$broadcasts = DB::table('broadcasts')
			->select('broadcasts.*', 'users.name')
            ->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
            ->get();
        //return $broadcasts;
        
        
        $swaps = DB::table('swaps')
			->select('swaps.*', 'users.name')
            ->leftJoin('users', 'swaps.user_id', '=', 'users.user_id')
            ->get(); 
         //return $swaps;       
            
         $localvocals = DB::table('localvocals')
			->select('localvocals.*', 'users.name')
            ->leftJoin('users', 'localvocals.user_id', '=', 'users.user_id')
            ->get();  
            
        //return $localvocals;
        
            
        $sugg_users = DB::table('users')
			->select('users.*')
			->where('name','<>',null)
			->inRandomOrder()
			->limit(3)
            //->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
            ->get();	
			
			
         if (Auth::attempt($userdata)) {
             
             return "ok";
             //return redirect()->action('HomeController@index');
             //return \App::make('redirect')->refresh()->with('flash_success', 'Thank you,!');
             //return redirect()->route('/');
               return redirect('/');
           //  return Redirect::to('/');
            //return view('layouts.app',['title'=>'Wannahelp Home','categories'=>$categories,'broadcasts'=>$broadcasts,'paid_broadcasts'=>$paid_broadcasts,'swaps'=>$swaps,'localvocals'=>$localvocals,'sugg_users'=>$sugg_users]);   
            //return Redirect::back()->with('message','Operation Successful !');
        //return Auth::user()->id;
        // return "Success";
        //echo 'SUCCESS!';

    } else {        
        return "Failed";
        // validation not successful, send back to form 
        //return Redirect::to('login');

    }
        
       // return $email;
        //return view('index',['title'=>'Wannahelp Login']);   
    }
	
	
	function register_from_post($name,$mobile,$city)
	{
	    
        $browserAgent = $_SERVER['HTTP_USER_AGENT'];
        //return $browserAgent;
       
        $country_code = "91";
        $password = "27";
        $email = Input::get('email');
       
        $hashed_password = Hash::make($password);

          $mobile_count = DB::table('users')->where('mobile',$mobile)->count();
		    
        $email_verification_code = str_random(8);
        $otp = $this->rest->get_otp();
        
	    $values = array(
			'user_id'=> $this->rest->get_unique_userid(),
			'name'  =>  $name,
			
			'mobile' => $mobile,
			
			'password' => $hashed_password,
			'os_type' => 'Web',
			'device_id' => $browserAgent,
			'otp' => $otp,
			'otp_verify' => 0,
			'device_modal' => NULL,
			'email_verification_code' => $email_verification_code, 
		//	'api_token' => $this->rest->get_unique_token(),
			'register_via' => 'MOBILE',
			'followers' => '',
			'following' => ''
	        );
        
		 $userdata = array(
            'mobile'     => $mobile,
            'password'  => $password
        );
        //return $mobile_count;
        $msg = 'Thanks for registering with WannaHelp. Your OTP is '.$otp;
		 if($mobile_count==0)
        {
    		if($this->rest->insert_values($this->rest->tbl_users,$values))
    		{
    		     $get_id = DB::table('users')
                    ->where('mobile', $mobile)
                    ->pluck('id');
                    
    				if(Auth::loginUsingId($get_id[0]))
    			    	{
    			    	    
        			    	if($this->rest->send_sms($country_code,$mobile,$msg))
        					{
        						return "Success";
        					}
        					else
        					{
        						return "Success but no mail";
        					}
    			    	    
    
    			    	}
    			    else
    			        return "Auth Fails";
    			    	
    		}
    		else
    		{
    		return "Something went wrong, Try again";
    		}
        }
        else
        {
            //return 1;
            $update_otp = DB::table('users')
            ->where('mobile', $mobile)
            ->update(['otp' => $otp,'otp_verify' => 0]);
           if($update_otp == 1)
    		{
    				$get_id = DB::table('users')
                    ->where('mobile', $mobile)
                    ->pluck('id');
                    
    				if(Auth::loginUsingId($get_id[0]))
    			    	{
    			    	    
        			    	if($this->rest->send_sms($country_code,$mobile,$msg))
        					{
        						return "Success";
        					}
        					else
        					{
        						return "Success but no mail";
        					}
    			    	    
    
    			    	}
    			    else
    			        return "Auth Fails";
    			    	
    		}
    		else
    		{
    		return "Something went wrong, Try again";
    		} 
        }
        
	}
	
	public function verify_otp()
    {
         $entered_otp = Input::get('otp');
          $mobile = Input::get('mobilenumber');
          if(Auth::user())
        {
        $otp = User::where('user_id',Auth::user()->user_id)->pluck('otp');
        }
        else
         $otp = User::where('mobile',$mobile)->pluck('otp');
        
        //return $entered_otp."--".$otp;
        $otp = $otp[0];
        if($entered_otp == $otp)
        {
            
             $rd = DB::table('users')
            ->where('mobile',$mobile)
            ->update(['otp_verify' => 1]);
            
            if(Auth::user())
            {
              //  return 1;
            $rd = DB::table('users')
            ->where('user_id', Auth::user()->user_id)
            ->update(['otp_verify' => 1]);
                return "ok";
            }
            
            $userdata = array(
            'mobile'     => $mobile,
            'password'   => 27
            );  
            
            $hash = Hash::make("27");
             $old_password = User::where('mobile',$mobile)->pluck('password');
             $rd = DB::table('users')->where('mobile',$mobile)->update(['password' =>$hash]);
             

            if (Auth::attempt($userdata)) 
            {
             $rd = DB::table('users')->where('mobile',$mobile)->update(['password' => $old_password[0]]);    
           
                return "ok";
            }
            
        }
        else
        return "Incorrect OTP, Try again.";
    }
	
	
	public function follow_unfollow_user()
    {
        $follow_user_id = Input::get('id');
        $user_id = Auth::user()->user_id;
        
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

             return "ok";
           }
           else
           {
             return "Something went wrong";
           }                            
           
           
           
           
        }
      //return $user_followers_array;  
        
    }
	
	
	 function like_unlike_lv()
    {        
        
        $lv_id = Input::get('lv_id');
        $user_id = Auth::user()->user_id;
        $lv_details = DB::table($this->rest->tbl_lv_like_share)->select('like_count','like_details')->where('lv_id',$lv_id)->get()->first();
        //return var_dump($lv_details);
        if(!empty($lv_details))
        {
        //return "inside";
           $like_details = (!empty($lv_details->like_details))? json_decode($lv_details->like_details):array();
          // return $like_details;
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
              $result['likes_count'] = $like_count;
              $result['status'] = "disliked";
           }
           else
           {
             $like_details[] = array('user_id'=>$user_id,'date_time'=>date('Y-m-d h:i:s'));             
             $like_count = $lv_details->like_count+1;    
             $result['likes_count'] = $like_count;
             $result['status'] = "liked";
           }   

           $like_details = json_encode($like_details);
           $status = DB::table($this->rest->tbl_lv_like_share)->where('lv_id',$lv_id)->update(array('like_details'=>$like_details,'like_count'=>$like_count));
           if($status>=1)
           {
             $data = array('last_activity'=>'like','last_activity_user_id'=>$user_id,'updated_at'=>date('Y-m-d h:i:s'));
             $this->rest->update_values($this->rest->tbl_localvocals,array('lv_id'=>$lv_id),$data);
             return $result;
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
	
	
	
	public function save_comment()
    {
      // return 1;
        $user_id = Auth::user()->user_id;
        $comment = Input::get('comment');
        $post_id = Input::get('post_id');
        
         $post_user_id = LocalVocal::where('lv_id',$post_id)->pluck('user_id');
         
         $post_user_name = User::where('user_id',$post_user_id[0])->pluck('name'); //$post_user_id[0]
         $message = Auth::user()->name ." has commented on your LocalVocal Post";
         //return $message;
        $save_noti = $this->save_user_noti($user_id,$post_user_id[0],$post_id,$message);
       // return $comment;
        $values_lv_comments = array(
        		  	'user_id'=> $user_id,
        		  	'lv_id'=> $post_id, 
        		  	'comment'=> $comment, 
        		  	'hide'=> 0,
        		  	'is_delete' => 0,
        		  	       		  	
        		  	'created_at' => date('Y-m-d y:i:s')
        		  	
    		         );
        //return 
        $sts = $this->rest->insert_values($this->rest->tbl_lv_comments,$values_lv_comments);
        $values_arr = [];
        $values_arr['name'] = Auth::user()->name;
        
        if(Auth::user()->dp_changed == 1)
        $values_arr['image'] = Auth::user()->profile_pic;
        elseif(Auth::user()->facebook_profile_dp != NULL)
         $values_arr['image'] = Auth::user()->facebook_profile_dp; 
         elseif(Auth::user()->google_profile_dp != NULL)
         $values_arr['image'] = Auth::user()->google_profile_dp; 
         else
         $values_arr['image'] = 'default';

        
         if($sts == 1)
         {
            
             return $values_arr;
         }
         else
            return "error";
        
    }
	
	
	public function following_followers_list()
    {
        $user_id = Input::get('id');
        $update_data_followers = array(); 
        $update_data_following = array(); 
           
       // return Auth::user()->user_id;
         $follow_user_detail = DB::table($this->rest->tbl_users)->select('followers','following')->where('user_id',Auth::user()->user_id)->get()->first();
        // return $follow_user_detail;
          if(!empty($follow_user_detail))
        {
           $user_followers_array = (!empty($follow_user_detail->followers))? json_decode($follow_user_detail->followers):array();
           $user_following_array = (!empty($follow_user_detail->following))? json_decode($follow_user_detail->following):array();
           
           
          
     
           
           foreach ($user_followers_array as $followers)
           {
            $update_data_followers[] = DB::table($this->rest->tbl_users)
            ->select('users.user_id','users.name','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp','user_details.profession')
            ->where('users.user_id',$followers->user_id)
            ->leftjoin('user_details', 'user_details.user_id', '=', 'users.user_id')
            ->get();
             
             // $update_data_followers[] = $followers->user_id;
            } 
            //return $update_data_followers;
           foreach ($user_following_array as $following)
           {
              
              
             $update_data_following[] = DB::table($this->rest->tbl_users)
            ->select('users.user_id','users.name','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp','user_details.profession')
            ->where('users.user_id',$following->user_id)
            ->leftjoin('user_details', 'user_details.user_id', '=', 'users.user_id')
            ->get();
              
              //$update_data_following[] = $following->user_id;
            }
          // return $update_data_following;
        }
       
         $list[] = ["following"=>$update_data_following,"followers"=> $update_data_followers];
         
         $categories = DB::table('categories')
		//	->where('blocked_by_admin','=','0')
			->select('category_title','logo_image','id')
			->get();
			
			$user_details = UserDetail::where('user_id',Auth::user()->user_id)->select('about_me','profession')->get();
			//return $user_details;
        //return $list;
         // $update_data_following = json_encode($update_data_following);
        //return $update_data_following;
        //return $update_data_followers;
      // return Auth::user()->user_id;
         return view('wannahelp.followers',['title'=>'Wannahelp Followers Page','list'=>$list,'user_details'=>$user_details,'categories'=>$categories,'update_data_following'=>$update_data_following,'update_data_followers'=>$update_data_followers]); 
    }
	
	
	public function show_noti()
    {
    //$user_id = Input::get('user_id');
    $user_notifications = DB::table('user_notifications')
     ->leftjoin('users', 'users.user_id', '=', 'user_notifications.from_user_id')
			->where('to_user_id','=',Auth::user()->user_id)
			//->where('is_shown','=',0)
			->where('is_hide','=',0)
			->select('user_notifications.*','users.name','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp')
			->orderBy('created_at','desc')
			->get();
	
		$user_details = UserDetail::where('user_id',Auth::user()->user_id)->select('about_me','profession')->get();		
	
     $categories = DB::table('categories')
		//	->where('blocked_by_admin','=','0')
			->select('category_title','logo_image','id')
			->get();
	
    return view('wannahelp.notifications',['title'=>'Wannahelp Notifications Page','categories'=>$categories,'user_notifications'=>$user_notifications,'user_details'=>$user_details]);       
        
        
    //return $user_notifications;
        
    }
	
	public function check_noti()
    {
    $user_id = Input::get('user_id');
    $user_notifications['notification_detalis'] = DB::table('user_notifications')
			->where('to_user_id','=',Auth::user()->user_id)
			->where('is_shown','=',0)
			->select('message','from_user_id','id','link_id')
			->limit(5)
			->orderBy('created_at','desc')
			->get();
	$user_notifications['count']=DB::table('user_notifications')
			->where('to_user_id','=',Auth::user()->user_id)
			->where('is_shown','=',0)->count();
	//$update_sts = DB::table('user_notifications')
              //  ->where('to_user_id', Auth::user()->user_id)
               // ->update(['is_shown' => 1]);	
           
        
        
    return $user_notifications;
        
    }
	
	public function save_user_noti($from_user_id,$to_user_id,$post_id,$message)
	{
	 $values_user_notification = array(
        		  	'from_user_id'=> $from_user_id,
        		  	'to_user_id'=> $to_user_id, 
        		  	'link_id' => $post_id,
        		  	'message'=> $message, 
        		  	'created_at' => date('Y-m-d y:i:s'),
        		  	'updated_at' => date('Y-m-d y:i:s')
        		  	
    		         );
        
        $sts = $this->rest->insert_values($this->rest->tbl_user_notifications,$values_user_notification);   
	    
	    
	}
	
	public function login()
    {
        //return 1;
        $email = Input::get('email');
        $password = Input::get('password');
        $userdata = array(
        'email'     => $email,
        'password'  => $password,
        );
         $userdata1 = array(
        'mobile'     => $email,
        'password'  => $password,
        );
        //return $email.$password;
        $categories = DB::table('categories')
		//	->where('blocked_by_admin','=','0')
			->select('category_title','logo_image','id')
			->get();
		$paid_broadcasts = DB::table('broadcasts')
			->select('broadcasts.*', 'users.name')
            ->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
            ->limit(4)
            ->get();
		//return $paid_broadcasts;
		
		/*Broadcast::where('is_paid','=','1')
			->select('broadcasts.*', 'users.name')
			->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
			->inRandomOrder()
			->limit(2)
			->get();*/
		
		$broadcasts = DB::table('broadcasts')
			->select('broadcasts.*', 'users.name')
            ->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
            ->get();
        //return $broadcasts;
        
        
        $swaps = DB::table('swaps')
			->select('swaps.*', 'users.name')
            ->leftJoin('users', 'swaps.user_id', '=', 'users.user_id')
            ->get(); 
         //return $swaps;       
            
         $localvocals = DB::table('localvocals')
			->select('localvocals.*', 'users.name')
            ->leftJoin('users', 'localvocals.user_id', '=', 'users.user_id')
            ->get();  
            
        //return $localvocals;
        
            
        $sugg_users = DB::table('users')
			->select('users.*')
			->where('name','<>',null)
			->inRandomOrder()
			->limit(3)
            //->leftJoin('users', 'broadcasts.user_id', '=', 'users.user_id')
            ->get();	
			
			
         if (Auth::attempt($userdata)) {
             
            // return "sucesss";
             
             //return redirect()->action('HomeController@index');
             //return \App::make('redirect')->refresh()->with('flash_success', 'Thank you,!');
             //return redirect()->route('/');
               return redirect('/');
           //  return Redirect::to('/');
            //return view('layouts.app',['title'=>'Wannahelp Home','categories'=>$categories,'broadcasts'=>$broadcasts,'paid_broadcasts'=>$paid_broadcasts,'swaps'=>$swaps,'localvocals'=>$localvocals,'sugg_users'=>$sugg_users]);   
            //return Redirect::back()->with('message','Operation Successful !');
        //return Auth::user()->id;
        // return "Success";
        //echo 'SUCCESS!';

    } else if(Auth::attempt($userdata1))
    {
        
        
    }
    
    else {        
        return "Failed";
        // validation not successful, send back to form 
        //return Redirect::to('login');

    }
        
       // return $email;
        //return view('index',['title'=>'Wannahelp Login']);   
    }
	
	
	public function loginWithFacebook() {
	
		// get data from input
		$code = Input::get( 'code' );
		
		// get fb service
		//$fb = OAuth::consumer( 'Facebook','http://localhost/wannahelp_web/');
		$fb = OAuth::consumer( 'Facebook','');
		
		// check if code is valid
		
		// if code is provided get user data and sign in
		if ( !empty( $code ) ) {
			
			// This was a callback request from facebook, get the token
			$token = $fb->requestAccessToken( $code );
			//var_dump($token);
			// Send a request with it
			$result = json_decode( $fb->request( 'me?fields=email,birthday,hometown,picture.type(large),cover,name' ), true );
			$name =  $result['name'];
			$facebook_id = $result['id'];
			//var_dump($result);
			
			/*********************
			Profile Picture Check
			*********************/
			
			if(isset($result['picture']))
		    {
			    $is_profile_pic = $result['picture']['data']['is_silhouette'];
			
    			if($is_profile_pic == false)
    			{
    			$facebook_profile_dp = $result['picture']['data']['url'];
    			}
		    }
		    else
			$facebook_profile_dp = NULL;
		
			/**********************
			Email Check
			***********************/
			
			if(isset($result['email']))
		    {
			$email = $result['email'];
		    }
		    else
		    $email = NULL;
		    
		    /**********************
			Cover Pic Check
			***********************/
		    if(isset($result['cover']))
		    {
			$facebook_cover_pic = $result['cover']['source'];
		    }
			else
			$facebook_cover_pic = NULL;
			
			//return $facebook_cover_pic;	
				
		    $email_count = DB::table('users')->where('email',$email)->count();	
		    /*if($email_count == 0)
		        return "new user";
		    else
		        return "exisiting user";*/
		//	$message = 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
		//	echo $message. "<br/>";
			
			//Var_dump
			//display whole array().
			//dd($result);
			
			 //$name = $result['name'];
			 if($email_count != 0)
			 {
			 $user_id = DB::table('users')->where('email',$email)->pluck('id');
			 
			 //return $user_id[0];
			    if(Auth::loginUsingId($user_id)){
			        return redirect('/');
                }
                
                
                /*else
                {
                    return "AUTH Fails";
			    }*/
		    }
		    else
		    {
		       
		    // New user
		    
		    
		     $browserAgent = $_SERVER['HTTP_USER_AGENT'];
            //return $browserAgent;
            
            
            
        
            $email_verification_code = str_random(8);
		   $user_id = $this->rest->get_unique_userid();
		    
		    $values = array(
			'user_id'=> $user_id,
			'name' => $name,
			'facebook_profile_dp' => $facebook_profile_dp, 
			'facebook_cover_pic' => $facebook_cover_pic, 
			'facebook_user_id' => $facebook_id,
			'email' => $email,
			'mobile' => NULL,
			'username' => NULL,
			'password' => NULL,
			'os_type' => 'Web',
			'device_id' => $browserAgent,
			'otp' => NULL,
			'otp_verify' => 0,
			'device_modal' => NULL,
			'email_verification_code' => $email_verification_code, 
		//	'api_token' => $this->rest->get_unique_token(),
			'register_via' => 'FACEBOOK',
			'followers' => '',
			'following' => ''
		    );
		    
		    
		     $values_user_details = array(
			'user_id'=> $user_id,
			'about_me' => NULL,
			'profession' => NULL,
			'current_location' => NULL
		    );
            $sts = $this->rest->insert_values($this->rest->tbl_users,$values);
            $sts1 = $this->rest->insert_values($this->rest->tbl_user_details,$values_user_details);
		    if( $sts == 1 && $sts1 == 1 )
				{
					
					$data['name']=$name;
			    	$data['email']=$email; 
			    	$data['email_token']=$email_verification_code;
			    	$user_id = DB::table('users')->where('email',$email)->pluck('id');
			 
			        //return $user_id[0];
			        if(Auth::loginUsingId($user_id)){
			        
			        
    			        if($this->Smail->sendCustomMail($data))
    			        {
    			            
    			           return redirect('/');  
    			            
    			            
    			        }
    			        
    			        else
    			        
    			        {
    			            
    			            return "Cant Send mail";
    			        }

			        }
			    	
				}	
				else
				{
				    
				    return "cant insert new user";
				}
		        
		        
		        
		        
		        
		        
		        
		        
		    } //else
		    
		}  
		// if not ask for permission first
		else {
			// get fb authorization
			$url = $fb->getAuthorizationUri();
			
			// return to facebook login url
			 return Redirect::to( (string)$url );
		}

	}

	
	public function loginWithGoogle() {

		// get data from input
		$code = Input::get( 'code' );
		
		// get google service
		//$googleService = OAuth::consumer( 'Google','http://localhost/wannahelp_web/' );
		$googleService = OAuth::consumer( 'Google','');
		
		// check if code is valid
		
		// if code is provided get user data and sign in
		if ( !empty( $code ) ) {
		
			// This was a callback request from google, get the token
			$token = $googleService->requestAccessToken( $code );
			
			// Send a request with it
			$result = json_decode( $googleService->request( 'https://www.googleapis.com/plus/v1/people/me' ), true );
			
			//$accesstoken = 'Your unique Google user id is: ' . print_r($token);
			
			//	echo $accesstoken;
			
			//DB::enableQueryLog();
			
			//$message = 'Your unique Google user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
			//echo $message. "<br/>";
			
			//return dd($result);
			
			
			$email= $result['emails'][0]['value'];
			//return $email;
			$google_id = $result['id'];
			
			if(isset($result['image']))
		    {
		    
			if($result['image']['isDefault'] == true)
			    $google_profile_dp = NULL;
			else
			    $google_profile_dp = $result['image']['url'];
		    }
		    else
		        $google_profile_dp = NULL;
		    
			if(isset($result['gender']))    
			    $gender = $result['gender'];
			else
			    $gender = NULL;
			
			if(isset($result['birthday']))    
			    $dob = $result['birthday'];
			else
			    $dob = NULL;
			
			if(isset($result['name']['givenName']))    
			    $name = $result['name']['givenName'];
			else
			    $name = NULL;
			
			if(isset($result['name']['familyName']))    
			    $last_name = $result['name']['familyName'];
			else
			    $last_name = NULL;
			
			if(isset($result['cover']))  
			{
			    if(isset($result['cover']['coverPhoto']['url']))
			    {
			    $google_cover_pic = $result['cover']['coverPhoto']['url'];
			    }
			}
			   // $google_cover_pic = $result['cover']['coverPhoto']['url'];
			else
			    $google_cover_pic = NULL;
			
			$email_count = DB::table('users')->where('email',$email)->count();	
		    
			//return 1;
			
			if($email_count != 0)
			 {
			 $user_id = DB::table('users')->where('email',$email)->pluck('id');
			 
			 //return $user_id[0];
			    if(Auth::loginUsingId($user_id)){
			        return redirect('/');
                }
                
                
                /*else
                {
                    return "AUTH Fails";
			    }*/
		    }
		    else
		    {
		       
		    // New user
		    
		    
		     $browserAgent = $_SERVER['HTTP_USER_AGENT'];
            //return $browserAgent;
            
            
            
        
            $email_verification_code = str_random(8);
		   $user_id = $this->rest->get_unique_userid();
		    
		    $values = array(
			'user_id'=> $user_id,
			'name' => $name,
			'google_profile_dp' => $google_profile_dp, 
			//'google_cover_pic' => $google_cover_pic, 
			'google_user_id' => $google_id,
			'email' => $email,
			'mobile' => NULL,
			'username' => NULL,
			'password' => NULL,
			'os_type' => 'Web',
			'device_id' => $browserAgent,
			'otp' => NULL,
			'otp_verify' => 0,
			'device_modal' => NULL,
			'email_verification_code' => $email_verification_code, 
		//	'api_token' => $this->rest->get_unique_token(),
			'register_via' => 'GOOGLE',
			'followers' => '',
			'following' => ''
		    );
		    
		    
		     $values_user_details = array(
			'user_id'=> $user_id,
			'about_me' => NULL,
			'profession' => NULL,
			'current_location' => NULL
		    );
            $sts = $this->rest->insert_values($this->rest->tbl_users,$values);
            $sts1 = $this->rest->insert_values($this->rest->tbl_user_details,$values_user_details);
            //return "Status is " .$sts1;
		    if( $sts == 1 && $sts1 == 1 )
				{
					
					$data['name']=$name;
			    	$data['email']=$email; 
			    	$data['email_token']=$email_verification_code;
			    	$user_id = DB::table('users')->where('email',$email)->pluck('id');
			 
			        //return $user_id[0];
			        if(Auth::loginUsingId($user_id)){
			        
			        
    			        if($this->Smail->sendCustomMail($data))
    			        {
    			            
    			           return redirect('/');  
    			            
    			            
    			        }
    			        
    			        else
    			        
    			        {
    			            
    			            return "Cant Send mail";
    			        }

			        }
			    	
				}	
				else
				{
				    
				    return "cant insert new user";
				}
		        
		        
		    } //else
		    
				
		}
		// if not ask for permission first
		else {
			// get googleService authorization
			$url = $googleService->getAuthorizationUri();
			
			// return to google login url
			return Redirect::to( (string)$url );
		}
	}

    
    function get_latlong_from_loc($location1)
    {
    $address = $location1; 
    //return $location1;
    $prepAddr = str_replace(' ','+',$address);
    $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?key=AIzaSyD7ymkb4fhvYTI-xSzbPfF9vPDnfrj86tY&address='.$prepAddr.'&sensor=false');
    $output= json_decode($geocode);
   //return $output;
    $data = array();
    $data['lat'] = $output->results[0]->geometry->location->lat;
    $data['long'] = $output->results[0]->geometry->location->lng; 
    return $data;
        
    }

    function get_distance($location1,$location2)
    {
        
   
    $address = $location1; 
    $prepAddr = str_replace(' ','+',$address);
    $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
    $output= json_decode($geocode);
    $point1_lat = $output->results[0]->geometry->location->lat;
    $point1_long = $output->results[0]->geometry->location->lng; 
    
    
    $address = $location2; 
    $prepAddr = str_replace(' ','+',$address);
    $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
    $output= json_decode($geocode);
    $point2_lat = $output->results[0]->geometry->location->lat;
    $point2_long = $output->results[0]->geometry->location->lng; 
    
    return $this->distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 1);
    
    
    // $point2_lat = 13.0253949;
    //$point2_long = 77.5971096;
    // 13.0253949 77.5971096
    //
    //return $lat;
    
        
        
    }
    
    
    
	function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 1) {
	// Calculate the distance in degrees
    	$degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));
     
    	// Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
    	switch($unit) {
    		case 'km':
    			$distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
    			break;
    		case 'mi':
    			$distance = $degrees * 69.05482; // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)
    			break;
    		case 'nmi':
    			$distance =  $degrees * 59.97662; // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)
    	}
    	return round($distance, $decimals);
    }
    
    function getlocation($latitude,$longitude)
    {
        
    $geolocation = $latitude.','.$longitude;
$request = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.$geolocation.'&sensor=false'; 
$file_contents = file_get_contents($request);
$json_decode = json_decode($file_contents);
if(isset($json_decode->results[0])) {
    $response = array();
    foreach($json_decode->results[0]->address_components as $addressComponet) {
        if(in_array('political', $addressComponet->types)) {
                $response[] = $addressComponet->long_name; 
        }
    }

    if(isset($response[0])){ $first  =  $response[0];  } else { $first  = 'null'; }
    if(isset($response[1])){ $second =  $response[1];  } else { $second = 'null'; } 
    if(isset($response[2])){ $third  =  $response[2];  } else { $third  = 'null'; }
    if(isset($response[3])){ $fourth =  $response[3];  } else { $fourth = 'null'; }
    if(isset($response[4])){ $fifth  =  $response[4];  } else { $fifth  = 'null'; }

    if( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth != 'null' ) {
       echo $first;  //address
        echo "<br/>City:: ".$second;
        echo "<br/>State:: ".$fourth;
        echo "<br/>Country:: ".$fifth;
    }
    else if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth != 'null' && $fifth == 'null'  ) {
        echo $first;
        echo "<br/>City:: ".$second;
        echo "<br/>State:: ".$third;
        echo "<br/>Country:: ".$fourth;
    }
    else if ( $first != 'null' && $second != 'null' && $third != 'null' && $fourth == 'null' && $fifth == 'null' ) {
        echo "<br/>City:: ".$first;
        echo "<br/>State:: ".$second;
        echo "<br/>Country:: ".$third;
    }
    else if ( $first != 'null' && $second != 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null'  ) {
        echo "<br/>State:: ".$first;
        echo "<br/>Country:: ".$second;
    }
    else if ( $first != 'null' && $second == 'null' && $third == 'null' && $fourth == 'null' && $fifth == 'null'  ) {
        echo "<br/>Country:: ".$first;
    }
  }    
        
        
    }
    
    function locate($ip = null) {
		
		global $_SERVER;
		
    $host = 'http://www.geoplugin.net/php.gp?ip={IP}&base_currency={CURRENCY}';
		
	//the default base currency
	$currency = 'USD';
	
	//initiate the geoPlugin vars
	$ip = null;
$city = null;
	$region = null;
$areaCode = null;
	$dmaCode = null;
	$countryCode = null;
	$countryName = null;
	$continentCode = null;
	$latitude = null;
	 $longitude = null;
	 $currencyCode = null;
	 $currencySymbol = null;
	 $currencyConverter = null;
		
		if ( is_null( $ip ) ) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
	//	dd($_SERVER['REMOTE_ADDR']);
		$host = str_replace( '{IP}', $ip, $host );
		$host = str_replace( '{CURRENCY}', $currency, $host );
		
		//dd($host);
	
		
		
		
// 		$geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?key=AIzaSyD7ymkb4fhvYTI-xSzbPfF9vPDnfrj86tY&address='.$abc.'&sensor=false');
//                 $output= json_decode($geocode);
//                 $from_lat = $output->results[0]->geometry->location->lat;
//                 $from_long = $output->results[0]->geometry->location->lng;
		
		
		
		$data = array();
		
		$response = $this->fetch($host);
		//dd($response);
		$data = unserialize($response);
		
		$data = unserialize($response);
		
		//set the geoPlugin vars
		
		$location['latitude'] = $data['geoplugin_latitude'];
		$location['longitude'] = $data['geoplugin_longitude'];
		
		
		
		//set the geoPlugin vars
		//$abc=$this->get_client_ip();
// 		$location['latitude'] = $from_lat;
// 		$location['longitude'] = $from_long;
		
		return $location;
		
	}
    
    
    

    
    
    function fetch($host) {

		if ( function_exists('curl_init') ) {
						
			//use cURL to fetch data
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $host);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, 'geoPlugin PHP Class v1.0');
			$response = curl_exec($ch);
			curl_close ($ch);
			
		} else if ( ini_get('allow_url_fopen') ) {
			
			//fall back to fopen()
			$response = file_get_contents($host, 'r');
			
		} else {

			trigger_error ('geoPlugin class Error: Cannot retrieve data. Either compile PHP with cURL support or enable allow_url_fopen in php.ini ', E_USER_ERROR);
			return;
		
		}
		
		return $response;
	}

    function test()
    {
    
    return $this->rest->send_sms(91,8870729280,"hi");
    /*
        $latitude=12.9833;
        $longitude=77.5833;
        $val =  $this->getlocation($latitude,$longitude);
        return $val;*/
       /* 
        $location = file_get_contents('http://freegeoip.net/json/'.$_SERVER['REMOTE_ADDR']);
        print_r($location);
        
        
        {"ip":"115.99.4.99","country_code":"IN","country_name":"India","region_code":"KA","region_name":"Karnataka","city":"Bengaluru","zip_code":"560046","time_zone":"Asia/Kolkata","latitude":12.9833,"longitude":77.5833,"metro_code":0}
        */
        
    }
    
    function save_transaction()
    {
     // return Redirect::to('/');
  // return 1;
    
    
    $plan_name = $_POST['udf1'];
    
    if($plan_name == "Basic")
    {
    $total_credits = 1;
    $rem_credits = 1;
    }
    else if($plan_name == "Premium")
    {
    $total_credits = 3;
    $rem_credits = 3;
    }
    else if($plan_name == "Platinum")
    {
    $total_credits = 20;
    $rem_credits = 20;
    }
    $user_id = Auth::user()->user_id;
    $mode = $_POST['mode'];
    $productinfo = $_POST['productinfo'];
    $txn_id = $_POST['txnid'];
    $status = $_POST['status'];
    $amount = $_POST['amount'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $error_Message = $_POST['error_Message'];
    if(empty($_POST['name_on_card']))
    {
        $sts = DB::table('credits_summary')->insert([
        'user_id' => $user_id,
        'txn_id' => $txn_id, 
        'plan_name' => $plan_name, 
      
        'productinfo' => $productinfo,
        'status' => $status,
        'mode' => $mode,
        'amount' => $amount,
        'first_name' => $firstname,
        'email' => $email,
        'phone' => $phone,
        'error_Message' => $error_Message
    ]);
    
        return redirect('/');  
    }
    $name_on_card = $_POST['name_on_card'];
    $bank_ref_num = $_POST['bank_ref_num'];
    $bankcode = $_POST['bankcode'];
    $cardnum = $_POST['cardnum'];
    $payuMoneyId = $_POST['payuMoneyId'];
    $discount = $_POST['discount'];
    $net_amount_debit= $_POST['net_amount_debit'];
    
    
    $sts = DB::table('credits_summary')->insert([
        'user_id' => $user_id,
        'txn_id' => $txn_id, 
        'plan_name' => $plan_name, 
        'total_credits' =>  $total_credits,
        'rem_credits' =>  $rem_credits,
        'productinfo' => $productinfo,
        'status' => $status,
        'mode' => $mode,
        'amount' => $amount,
        'first_name' => $firstname,
        'email' => $email,
        'phone' => $phone,
        'error_Message' => $error_Message,
        'name_on_card' => $name_on_card,
        'bank_ref_num' => $bank_ref_num,
        'bankcode' => $bankcode,
        'cardnum' => $cardnum,
        'payuMoneyId' => $payuMoneyId,
        'discount' => $discount,
        'net_amount_debit' => $net_amount_debit
    ]);
    
     $categories = DB::table('categories')
		//	->where('blocked_by_admin','=','0')
			->select('category_title','logo_image','id')
			->get();
    return redirect('/');  
      return view('wannahelp.payment_status',['title'=>'Wannahelp','categories'=>$categories]);       
    /*
    mihpayid74201modeCCstatussuccessunmappedstatuscapturedkeycU9CgzR0txnid1648-149986amount199.0addedon2018-05-17 16:48:44productinfoPayment made for SaleemfirstnameSaleemlastnameaddress1address2citystatecountryzipcodeemaileorbsolutions@gmail.comphone9663767007udf1udf2udf3udf4udf5udf6udf7udf8udf9udf10hash55b3629d56121a08ae6d2b7b54e1238ba26b1f60ca31579848b32287bf413f6e02a733173f499d20e53daad92e2c8d9c23ce4390b8aa93abab0ca6fbd3efcf95field1242335field2117536field320180517field4MCfield5676749954726field600field70field83DSfield9 Verification of Secure Hash Failed: E700 -- Approved -- Transaction Successful -- Unable to be determined--E000PG_TYPEAXISPGencryptedPaymentId9B2569E0AE37DB10CDBBA1F3F91B0725bank_ref_num242335bankcodeCCerrorE000error_MessageNo Errorname_on_cardTestcardnum401200XXXXXX1112cardhashThis field is no longer supported in postback params.amount_split{"PAYU":"199.0"}payuMoneyId149986discount0.00net_amount_debit199
    mode
    status
    amount
    addedon
    productinfo
    firstname
    lastname
    address1
    address2
    city
    state
    country
    zipcode
    email
    phone
    
    
    */
    echo "<table>";
    foreach ($_POST as $key => $value) {
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";
        
    }
    echo "</table>";
    
        
    }
    
    
      public function validate_coupon()
     
    {
     $code = Input::get( 'coupon_code' );
     $plan = Input::get( 'plan_name' );
    // return $code;
   // $type = 1;
    $data = "";
    if($code=="HAPPY50")
    {
       
        if($plan == "Basic")
        $amount = 199/2;
        else if($plan == "Premium")
        $amount = 399/2;
        else if($plan == "Platinum")
        $amount = 999/2;
        $data['amount'] = (int)$amount;
        $data['code'] = $code;
        $data['error'] = "";
        return $data;
    }
    else
    {
        $data['amount'] = "";
        $data['error'] = 1;
        return $data;
    } 
        
    }    
    
    
    public function navigate_payment()
     
    {
        //$MERCHANT_KEY = "cU9CgzR0";
       //$SALT = "Qr27OKa6U1";
        $SALT="LqLswWFXL8";
       // $SALT = "eCwWELxi";
        //$PAYU_BASE_URL = 'https://secure.payu.in/_payment';
        $PAYU_BASE_URL = "https://sandboxsecure.payu.in";
        //$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        foreach($_POST as $key => $value) {    
            $posted[$key] = $value; 
        }
       // $posted['udf1'] = "Basic";
        //$udf1 = "type=basic";
        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|||||||||";
        $hashVarsSeq = explode('|', $hashSequence);
        $hash_string = '';	
    	foreach($hashVarsSeq as $hash_var) {
          $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
          $hash_string .= '|';
        }

        $hash_string .= $SALT;
       // return $hash_string;

        $hash = strtolower(hash('sha512', $hash_string));
        //return $hash;
        $action = $PAYU_BASE_URL . '/_payment';
        $data = array();
         $data['hash_string'] = $hash_string;
        $data['url'] = $action;
        $data['hash'] = $hash;
        //return $posted['amount'];
        $data['amount'] = $posted['amount'];
         $data['udf1'] = $posted['udf1'];
        $data['txnid'] = $posted['txnid'];
        $data['surl'] = $posted['surl'];
        $data['furl'] = $posted['furl'];
        $data['email'] = $posted['email'];
        $data['phone'] = $posted['phone'];
        $data['firstname'] = $posted['firstname'];
        $data['productinfo'] = $posted['productinfo'];
        //$data['key'] = "gtKFFx";
        $data['key'] = "5WF2Wi7C";
        $data['service_provider'] = "payu_paisa";        
        return $data;
    }    
    
      public function credits_summary()
     
    {
       
       $credits = DB::table('credits_summary')->where('user_id',Auth::user()->user_id)
            ->select('credits_summary.*')
        	->orderBy('id','desc')
	        ->get();
	   $transactions =   DB::table('credits_transaction')->where('user_id',Auth::user()->user_id)
            ->select('credits_transaction.*')
        	->orderBy('id','desc')
	        ->get(); 
	   foreach($transactions as $transaction)
	   {
	      
	      if( substr($transaction->type_id,0,2) == "BC") 
	        {
	        $title = DB::table('broadcasts')
	        ->where('broadcast_id',$transaction->type_id)
            ->pluck('description');
	            
	        } 
	        else if(substr($transaction->type_id,0,2) == "SW")
	        {
	          $title = DB::table('swaps')
	        ->where('swap_id',$transaction->type_id)
            ->pluck('title');
	            
	        }    
	            
	        
	        
	        //return $title;
	   $transaction->title = $title[0];     
	   }
	    
	   // return $transactions;
	    $categories = DB::table('categories')
		//	->where('blocked_by_admin','=','0')
			->select('category_title','logo_image','id')
			->get();
			
	        
	    return view('wannahelp.credits_summary',['title'=>'Wannahelp','transactions'=>$transactions,'credits'=>$credits,'categories'=>$categories]);       
	  // return $transactions;     
       
    }    
    
    public function transaction_summary()
     
    {
       
       $MERCHANT_KEY = "5WF2Wi7C";
       //$MERCHANT_KEY = "gtKFFx";
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
         //$PAYU_BASE_URL = "https://sandboxsecure.payu.in";
         $PAYU_BASE_URL = "https://secure.payu.in/_payment";
      
       $post_id = Input::get( 'id' );
      // return $post_id;
        $type = Input::get( 'type' );
       // $post_id = "BC189811011349";    
       // $type = substr($post_id,0,2);
       // return $type;
        if($type == "Broadcast")
            $post_details = Broadcast::where('broadcast_id',$post_id)->select('description')->get();
        elseif ($type == "Swap")
            $post_details = Swap::where('swap_id',$post_id)->select('title','images')->get();
         //return $post_details;
         $post_details[0]['type']= $type;
         //return $post_details;
         
         
     
      $credits1 = DB::table('credits_summary')->where('user_id',Auth::user()->user_id)
            ->select('rem_credits','plan_name')
        	->orderBy('id','desc')
	        ->get();
        //return 1;
        //return $credits()
        foreach($credits1 as $credits)
        {
        if($credits1=="")
        {
           //  return 13;
         $credits->rem_credits = 0;
         $credits->plan_name = "";
        }
         else
         {
              //return 12;
        $credits->rem_credits = $credits->rem_credits;   
        $credits->plan_name = $credits->plan_name;
        //$user_details[0]->rem_credits = $rem_credits;
         }
        }
        //return $credits1;
        // Merchant Key and Salt as provided by Payu.
        
        		// For Sandbox Mode
        //$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode
        
        $action = '';
        
        $posted = array();
        if(!empty($_POST)) {
            //print_r($_POST);
          foreach($_POST as $key => $value) {    
            $posted[$key] = $value; 
        	
          }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
 
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
   //   return $posted['key'].$posted['txnid'].$posted['amount'].$posted['firstname'].$posted['email'].$posted['phone'].$posted['productinfo'].$posted['surl'].$posted['furl'].$posted['service_provider'];
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    //return $hash;
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
   //return $hash;
  $action = $PAYU_BASE_URL . '/_payment';
}
     
        $categories = DB::table('categories')
        //	->where('blocked_by_admin','=','0')
        ->select('category_title','logo_image','id')
        ->get();
        
        $amount = 199;
        $productinfo = "Payment by ".Auth::user()->name.". and ID is ".Auth::user()->user_id;
		$surl = "http://wannahelp.com/whapi/save_transaction";
		$furl = "http://wannahelp.com/whapi/save_transaction";
       return view('wannahelp.transaction',['credits'=>$credits1,'title'=>'Wannahelp Swap','post_id'=>$post_id,'post_details'=>$post_details,'surl'=>$surl,'furl'=>$furl,'productinfo'=>$productinfo,'amount'=>$amount,'action'=>$action,'txnid'=>$txnid,'hash'=>$hash,'MERCHANT_KEY'=>$MERCHANT_KEY,'categories'=>$categories]);  
    }
    
    
    public function open_chat1()
    {   

        //$individual_id = Input::get('individual_id');
        
        //type_id
        $type_id = Input::get('type_id');
        //return $type_id;
        $type = Input::get( 'type' );
        //return 1;
        if($type == 1)
        {
        $type_id = "BC".$type_id;
        $bc_user_id_pluck = DB::table('broadcasts')->where('broadcast_id',$type_id)->pluck('user_id');
        $bc_user_id = $bc_user_id_pluck[0];
        //return $bc_user_id;
        $bc_user_name_pluck = DB::table('users')->where('user_id',$bc_user_id)->pluck('name');
        $bc_user_name = $bc_user_name_pluck[0];
        
        $bc_details_desc = DB::table('broadcasts')->where('broadcast_id',$type_id)->pluck('description');
        $bc_desc = $bc_details_desc[0];
        
        }
        
        if($type == 2)
        {
        $type_id = "SW".$type_id;
        $bc_user_id_pluck = DB::table('swaps')->where('swap_id',$type_id)->pluck('user_id');
        $bc_user_id = $bc_user_id_pluck[0];
        //return $bc_user_id;
        $bc_user_name_pluck = DB::table('users')->where('user_id',$bc_user_id)->pluck('name');
        $bc_user_name = $bc_user_name_pluck[0];
        
        $bc_details_desc = DB::table('swaps')->where('swap_id',$type_id)->pluck('title');
        $bc_desc = $bc_details_desc[0];
        
        }
        //return $bc_desc;
        
     
        $to_user_id = $bc_user_id;


        // get details
        //$post_owner = User::where('id', $user_id1)->first();

        //return $post_owner;

        //$type_id1= $user_id1[1];
        $from_user_id = Auth::user()->user_id;
        
        $conv_id = $this->get_conv_id($from_user_id,$to_user_id,$type_id);
        
      // return $conv_id;

       
        $messages = DB::table('messages')
        ->select('messages.*')
        //->whereIn('from_id', array($from_user_id,$to_user_id))
       // ->whereIn('to_id', array($from_user_id,$to_user_id))
        ->Where('conv_id', $conv_id)
        ->orderBy('messages.id')
        ->get();
       
       //return $messages;
      
            

        $chat_window = '<div class="chat-window" id="'.$conv_id.'_'.$type_id.'" style="background:white;border: 1px solid lightgray;right:0;max-width: 250px;min-width: 250px;">';
        $chat_window .= '<div class="msg-wgt-header" id="msg-he" style="background-color:#3cc0c7 !important;border:none !important;" >';
        $chat_window .= '<span style="font-size:12px">'.$bc_details_desc[0].'</span>';
         $chat_window .= '<a ><span style="float: right;margin-top: 5px;margin-right: 15px;" class="fa fa-times icon_close" data-id="'.$conv_id.'"></span></a>';
        $chat_window .= '</div>';
       
        $chat_window .= '<div id="msg-wgt-body" class="msg-wgt-body'.$conv_id.'" style="background:white;border: 1px solid lightgray;overflow-y: auto;overflow-x: hidden;
    max-height: 300px;min-height: 300px;">';
        $chat_window .= '<table style="width: 100%;">';
    
    
        $chat_window .= '<span style="margin-left: 25px;">';
    
    //return $messages;
        if(!$messages->isEmpty())
        {
            foreach( $messages as $post )
            {
                
                 $user_details = DB::table('users')
        			->select('users.is_online','users.name','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp')
        			->where('user_id', $post->from_user_id)
                    ->first();  
                //return $user_details;
                $chat_window .= '<tr class="msg-row-container">';
                $chat_window .= '<td>';
                $chat_window .= '<div class="msg-row">';
                
                
                //$chat_window .= '<div class="avatar">';
                
                if($user_details->dp_changed == 1)
                $chat_window .= '<img class="avatar" style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$user_details->profile_pic.'></a>';
                elseif($user_details->facebook_profile_dp != NULL)
                $chat_window .= '<img class="avatar" style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$user_details->facebook_profile_dp.'></a>';
                elseif($user_details->google_profile_dp != NULL)
                $chat_window .= '<img class="avatar" style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$user_details->google_profile_dp.'></a>';
                else
                $chat_window .= '<img class="avatar" style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src="images/profile.png"></a>';
                
                
               // $chat_window .= '</div>';
                
                
                
                $chat_window .= '<div class="message">';
                $chat_window .= '<span class="user-label">';
                //$chat_window .= '<a href="#" style="color: #6D84B4;">';
                
               
                $chat_window .= $user_details->name;
                //$chat_window .= '</a>';
                $chat_window .= ' <span class="msg-time">';
                //echo time_elapsed_string($post->created_at);
                $chat_window .= $this->time_elapsed_string($post->created_at);
                $chat_window .= '</span>';
                $chat_window .= '</span>';
                $chat_window .= '<br/>';
                $chat_window .= $post->message;
                $chat_window .= '</div>';
                $chat_window .= '</div>';
                $chat_window .= '</td>';
                $chat_window .= '</tr>';
                
            }
        }
        else
        {
            //return "inside else";
    
            $chat_window .= "No chat messages available!";
             $chat_window .= '</span>';
    
    
        }    
    
         $chat_window .= '</table>';
         $chat_window .= '</div>';
         $chat_window .= '<div class="msg-wgt-footer">';
         $chat_window .= '<textarea class="chatMsg" id="chatMsg_'.$conv_id.'_'.$type_id.'" placeholder="Type your message"></textarea>';
         $chat_window .= '<button onclick="sendmsg()" id="'.$conv_id.'_'.$type_id.'" class="chat_send">Send</button>';
         $chat_window .= '</div>';
         $chat_window .= '</div>';
         return $chat_window;


    }
    
    function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
    
     function get_conv_id($from_user_id,$to_user_id,$type_id){
         
         
          $chat = Message::where('from_user_id', $from_user_id)
                //->where("type_id",$bc_id)
            ->where('to_user_id', $to_user_id)
            ->orWhere('from_user_id', $to_user_id)
            ->where('to_user_id', $from_user_id)
            ->where("type_id",$type_id)
            ->pluck('conv_id');
      // return $chat;
        if(!$chat->isEmpty()){
            
             $chat = Message::where('from_user_id', $from_user_id)
            ->where('to_user_id', $to_user_id)
            ->orWhere('from_user_id', $to_user_id)
            ->where('to_user_id', $from_user_id)
            ->where("type_id",$type_id)
            ->pluck('conv_id');
            
        //    $conv_id = $chat[0];
           // $update = DB::raw('UPDATE `chats` SET update_at=now();');
            
            return $chat[0];
        }else{
            
            
            $conv_id = $this->get_unique_conv_id();
           return $conv_id;
            
        }
       
  
         
     }
     
    
    public function open_chat_latest()
    {   

        //$individual_id = Input::get('individual_id');
        
        //type_id
        $type_id = Input::get('type_id');
        //return $type_id;
        $type = Input::get( 'type' );
        $sender_id = Input::get( 'sender_id' );
        
        

        
        
        
        
        //return 1;
        if($type == 1)
        {
        $type_id = "BC".$type_id;
        $bc_user_id_pluck = DB::table('broadcasts')->where('broadcast_id',$type_id)->pluck('user_id');
        $bc_user_id = $bc_user_id_pluck[0];
        //return $bc_user_id;
        $bc_user_name_pluck = DB::table('users')->where('user_id',$bc_user_id)->pluck('name');
        $bc_user_name = $bc_user_name_pluck[0];
        
        $bc_details_desc = DB::table('broadcasts')->where('broadcast_id',$type_id)->pluck('description');
        $bc_desc = $bc_details_desc[0];
        
        }
        
        if($type == 2)
        {
        $type_id = "SW".$type_id;
        $bc_user_id_pluck = DB::table('swaps')->where('swap_id',$type_id)->pluck('user_id');
        $bc_user_id = $bc_user_id_pluck[0];
        //return $bc_user_id;
        $bc_user_name_pluck = DB::table('users')->where('user_id',$bc_user_id)->pluck('name');
        $bc_user_name = $bc_user_name_pluck[0];
        
        $bc_details_desc = DB::table('swaps')->where('swap_id',$type_id)->pluck('title');
        $bc_desc = $bc_details_desc[0];
        
        }
        //return $bc_desc;
        
     
        $to_user_id = $bc_user_id;


        // get details
        //$post_owner = User::where('id', $user_id1)->first();

        //return $post_owner;

        //$type_id1= $user_id1[1];
        $from_user_id = Auth::user()->user_id;
        
        $conv_id = $this->get_conv_id($sender_id,$from_user_id,$type_id);
        
      // return $conv_id;

       
        $messages = DB::table('messages')
        ->select('messages.*')
        //->whereIn('from_id', array($from_user_id,$to_user_id))
       // ->whereIn('to_id', array($from_user_id,$to_user_id))
        ->Where('conv_id', $conv_id)
        ->orderBy('messages.id')
        ->get();
       
       //return $messages;
      
            

        $chat_window = '<div class="chat-window" id="'.$conv_id.'_'.$type_id.'" style="background:white;border: 1px solid lightgray;right:0;max-width: 250px;min-width: 250px;">';
        $chat_window .= '<div class="msg-wgt-header" id="msg-he" style="background-color:#3cc0c7 !important;border:none !important;" >';
        $chat_window .= '<span style="font-size:12px">'.$bc_details_desc[0].'</span>';
         $chat_window .= '<a ><span style="float: right;margin-top: 5px;margin-right: 15px;" class="fa fa-times icon_close" data-id="'.$conv_id.'"></span></a>';
        $chat_window .= '</div>';
       
        $chat_window .= '<div id="msg-wgt-body" class="msg-wgt-body'.$conv_id.'" style="background:white;border: 1px solid lightgray;overflow-y: auto;overflow-x: hidden;
    max-height: 300px;min-height: 300px;">';
        $chat_window .= '<table style="width: 100%;">';
    
    
        $chat_window .= '<span style="margin-left: 25px;">';
    
    //return $messages;
        if(!$messages->isEmpty())
        {
            foreach( $messages as $post )
            {
                
                 $user_details = DB::table('users')
        			->select('users.is_online','users.name','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp')
        			->where('user_id', $post->from_user_id)
                    ->first();  
                //return $user_details;
                $chat_window .= '<tr class="msg-row-container">';
                $chat_window .= '<td>';
                $chat_window .= '<div class="msg-row">';
                
                
                //$chat_window .= '<div class="avatar">';
                
                if($user_details->dp_changed == 1)
                $chat_window .= '<img class="avatar" style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$user_details->profile_pic.'></a>';
                elseif($user_details->facebook_profile_dp != NULL)
                $chat_window .= '<img class="avatar" style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$user_details->facebook_profile_dp.'></a>';
                elseif($user_details->google_profile_dp != NULL)
                $chat_window .= '<img class="avatar" style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$user_details->google_profile_dp.'></a>';
                else
                $chat_window .= '<img class="avatar" style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src="images/profile.png"></a>';
                
                
               // $chat_window .= '</div>';
                
                
                
                $chat_window .= '<div class="message">';
                $chat_window .= '<span class="user-label">';
                //$chat_window .= '<a href="#" style="color: #6D84B4;">';
                
               
                $chat_window .= $user_details->name;
                //$chat_window .= '</a>';
                $chat_window .= ' <span class="msg-time">';
                //echo time_elapsed_string($post->created_at);
                $chat_window .= $this->time_elapsed_string($post->created_at);
                $chat_window .= '</span>';
                $chat_window .= '</span>';
                $chat_window .= '<br/>';
                $chat_window .= $post->message;
                $chat_window .= '</div>';
                $chat_window .= '</div>';
                $chat_window .= '</td>';
                $chat_window .= '</tr>';
                
            }
        }
        else
        {
            //return "inside else";
    
            $chat_window .= "No chat messages available!";
             $chat_window .= '</span>';
    
    
        }    
    
         $chat_window .= '</table>';
         $chat_window .= '</div>';
         $chat_window .= '<div class="msg-wgt-footer">';
         $chat_window .= '<textarea class="chatMsg" id="chatMsg_'.$conv_id.'_'.$type_id.'" placeholder="Type your message"></textarea>';
         $chat_window .= '<button onclick="sendmsg()" id="'.$conv_id.'_'.$type_id.'" class="chat_send">Send</button>';
         $chat_window .= '</div>';
         $chat_window .= '</div>';
         return $chat_window;


    }
    
     
      public function send_messages()
    {
        $message = Input::get('message');
        $chatMsg_attr_id = Input::get('chatMsg_attr_id'); // type_id
        $from_user_id = Auth::user()->user_id;
        
        $arr = explode("_",$chatMsg_attr_id);
        $conv_id = $arr[1];
        $type_id = $arr[2];
        
        if(substr($type_id,0,2) == "BC")
        {
        $to_user_id = DB::table('broadcasts')
        ->select('broadcasts.*')
        ->where('broadcast_id', $type_id)
        
        ->pluck('user_id');
        $type="Broadcast";
        }
        else
        {
           $to_user_id = DB::table('swaps')
        ->select('swaps.*')
        ->where('swap_id', $type_id)
        
        ->pluck('user_id'); 
        $type="Swap";
        }
        
       // to is 1
        
        $to_user_id = $to_user_id[0];

    
         $sts = DB::table('messages')->insertGetId(
        ['to_user_id' => $to_user_id, 'from_user_id' => $from_user_id,'message' => $message,'conv_id' => $conv_id,'type_id' => $type_id,'type'=>$type]
        );
        
        //dd($sts);
        
        //$sts->id
        
        
        
        
         $user_id = Auth::user()->user_id;
        //$comment = Input::get('comment');
        $post_id = $type_id;//Input::get('post_id');
        
       //  $post_user_id = LocalVocal::where('lv_id',$post_id)->pluck('user_id');
         
         $post_user_name = User::where('user_id',$to_user_id)->pluck('name'); //$post_user_id[0]
         $message = Auth::user()->name ." has messaged on your swapnear Post";
         //return $message;
        $save_noti = $this->save_user_noti($user_id,$to_user_id,$post_id,$message);
        //dd($post_id);
        
      //  return 1;
        
        // $posts = DB::table('posts')
        // ->select('posts.*')
        // ->where('id','<>',Auth::user()->id)
        // ->get();
        //    // return $posts;
        // return view('home',['posts'=>$posts]);
    }
    
    public function get_unique_conv_id()
    	{				
    		$conv_id = 'CV'.date('yzhis');
    		$conv_id .= rand(00,99);	
    		$result = DB::table('messages')->where('conv_id',$conv_id)->first();
    		if(!empty($result)) $this->get_unique_conv_id();	
    		return $conv_id;
    	}
    	
    	public function get_messages()
    	{
    	    
    	    $message = Input::get('message');
    	    $chatMsg_attr_id = Input::get('chatMsg_attr_id');
    	    
    	    $arr = explode("_",$chatMsg_attr_id);
            $conv_id = $arr[1];
            $type_id = $arr[2];
            
            if(substr($type_id,0,2) == "BC")
            {
            //$type_id = "BC".$type_id;
            $bc_user_id_pluck = DB::table('broadcasts')->where('broadcast_id',$type_id)->pluck('user_id');
            $bc_user_id = $bc_user_id_pluck[0];
            //return $bc_user_id;
            $bc_user_name_pluck = DB::table('users')->where('user_id',$bc_user_id)->pluck('name');
            $bc_user_name = $bc_user_name_pluck[0];
            
            $bc_details_desc = DB::table('broadcasts')->where('broadcast_id',$type_id)->pluck('description');
            $bc_desc = $bc_details_desc[0];
            
            }
            
            if(substr($type_id,0,2) == "SW")
            {
            //$type_id = "BC".$type_id;
            $bc_user_id_pluck = DB::table('swaps')->where('swap_id',$type_id)->pluck('user_id');
            $bc_user_id = $bc_user_id_pluck[0];
            //return $bc_user_id;
            $bc_user_name_pluck = DB::table('users')->where('user_id',$bc_user_id)->pluck('name');
            $bc_user_name = $bc_user_name_pluck[0];
            
            $bc_details_desc = DB::table('swaps')->where('swap_id',$type_id)->pluck('title');
            $bc_desc = $bc_details_desc[0];
            
            }
            
            $to_user_id = $bc_user_id;


            // get details
            //$post_owner = User::where('id', $user_id1)->first();
    
            //return $post_owner;
    
            //$type_id1= $user_id1[1];
            $from_user_id = Auth::user()->user_id;
            
            $conv_id = $this->get_conv_id($from_user_id,$to_user_id,$type_id);
            
          // return $conv_id;
    
           
            $messages = DB::table('messages')
            ->select('messages.*')
            //->whereIn('from_id', array($from_user_id,$to_user_id))
           // ->whereIn('to_id', array($from_user_id,$to_user_id))
            ->Where('conv_id', $conv_id)
            ->orderBy('messages.id')
            ->get();
    	
            $chat_window = '<table style="width: 100%;">';
        
        
            $chat_window .= '<span style="margin-left: 25px;">';
        
            //return $messages;
            if(!$messages->isEmpty())
            {
                foreach( $messages as $post )
                {
                    
                 $user_details = DB::table('users')
        			->select('users.is_online','users.name','users.dp_changed','users.profile_pic','users.facebook_profile_dp','users.google_profile_dp')
        			->where('user_id', $post->from_user_id)
                    ->first();  
                //return $user_details;
                $chat_window .= '<tr class="msg-row-container">';
                $chat_window .= '<td>';
                $chat_window .= '<div class="msg-row">';
                
                
                //$chat_window .= '<div class="avatar">';
                
                if($user_details->dp_changed == 1)
                    $chat_window .= '<img class="avatar" style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$user_details->profile_pic.'></a>';
                elseif($user_details->facebook_profile_dp != NULL)
                    $chat_window .= '<img class="avatar" style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$user_details->facebook_profile_dp.'></a>';
                elseif($user_details->google_profile_dp != NULL)
                    $chat_window .= '<img class="avatar" style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src='.$user_details->google_profile_dp.'></a>';
                else
                    $chat_window .= '<img class="avatar" style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src="images/profile.png"></a>';

                $chat_window .= '<div class="message">';
                $chat_window .= '<span class="user-label">';
                //$chat_window .= '<a href="#" style="color: #6D84B4;">';
                
               
                $chat_window .= $user_details->name;
                //$chat_window .= '</a>';
                $chat_window .= ' <span class="msg-time">';
                $chat_window .= $this->time_elapsed_string($post->created_at);
                $chat_window .= '</span>';
                $chat_window .= '</span>';
                $chat_window .= '<br/>';
                $chat_window .= $post->message;
                $chat_window .= '</div>';
                $chat_window .= '</div>';
                $chat_window .= '</td>';
                $chat_window .= '</tr>';
                
            }
            $chat_window .= '</div>';
        }
        else
        {
            //return "inside else";
    
            $chat_window .= "No chat messages available!";
             $chat_window .= '</span>';
    
    
        }    
    
         $chat_window .= '</table>';
         
         $data = [];
         $data['conv_id'] = $conv_id;
         $data['content'] = $chat_window;
         
         return $data;
    	}
    	
    	
    	public function usersChat($convId = "")
    {
        
        $categories = DB::table('categories')
		//	->where('blocked_by_admin','=','0')
			->select('category_title','logo_image','id')
			->get();
        $receptorUser = Message::where('conv_id', $convId)->get();
        
        
        
        
        foreach($receptorUser as $rU)
        {
            if($rU->type == "Broadcast")
            {    
                $broadcasts = User::select('users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
        			
                    //->leftJoin('broadcasts', 'users.user_id', '=', 'broadcasts.user_id')
                    ->where('users.user_id',$rU->from_user_id)
                    ->get();
                    //return $broadcasts;
                  //  return $rU;
                  
                  
                $rU->user_name = $broadcasts[0]->name;
                //return $rU;
                if($broadcasts[0]->dp_changed == 1)
                    $rU->picture= $broadcasts[0]->profile_pic;
                elseif($broadcasts[0]->facebook_profile_dp != NULL)
                    $rU->picture== $broadcasts[0]->facebook_profile_dp;
                elseif($broadcasts[0]->google_profile_dp != NULL)
                    $rU->picture== $broadcasts[0]->google_profile_dp;
                else
                    $rU->picture== 'images/profile.png';    
                    
                $title = Broadcast::where('broadcast_id',$rU->type_id)->pluck('description');
                $rU->title = $title[0];
            }
            else if($rU->type == "Swap")      
            {
                
                $broadcasts = User::select('users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
        			
                    ->leftJoin('swaps', 'users.user_id', '=', 'swaps.user_id')
                    ->where('swaps.swap_id',$rU->type_id)
                    ->get(); 
                $rU->user_name = $broadcasts[0]->name;
                     
                if($broadcasts[0]->dp_changed == 1)
                    $rU->picture= $broadcasts[0]->profile_pic;
                elseif($broadcasts[0]->facebook_profile_dp != NULL)
                    $rU->picture== $broadcasts[0]->facebook_profile_dp;
                elseif($broadcasts[0]->google_profile_dp != NULL)
                    $rU->picture== $broadcasts[0]->google_profile_dp;
                else
                    $rU->picture== 'images/profile.png';    
                $title = Swap::where('swap_id',$rU->type_id)->pluck('title');
                $rU->title = $title[0];    
            }
        }
       
       //return $receptorUser;
       
        $chat_lists_all = Message::where('from_user_id', '=', Auth::user()->user_id)
            ->orWhere('to_user_id', Auth::user()->user_id)
            ->groupBy('conv_id')
            ->get();
            //return $chat_lists_all;
            
            $chat_lists_bc =  Message::where(function($query){
                $query->where('from_user_id', Auth::user()->user_id)
                ->orWhere('to_user_id', Auth::user()->user_id);
            })
            ->where('type', "Broadcast")
            ->groupBy('conv_id')
            ->get();
           //return $chat_lists_bc;
            
           $chat_lists_sw =  Message::where(function($query){
                $query->where('from_user_id', Auth::user()->user_id)
                ->orWhere('to_user_id', Auth::user()->user_id);
            })
            ->where('type', "Swap")
            ->groupBy('conv_id')
            ->get();
            
            
           
            //return $chat_lists_sw;
            if(count($chat_lists_sw) == 0 )
            {
               
                $chat_lists_sw = Chat::where('user_id2', '=', Auth::user()->user_id)
            
                    ->Where('type',"Swap")
                    ->get();
                
            }
            
            //return $chat_lists_all;
            foreach($chat_lists_all as $chat_list)
            {
                if($chat_list->type == "Broadcast")
                {
                 $broadcasts = User::select('broadcasts.description','users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
			
                    ->leftJoin('broadcasts', 'users.user_id', '=', 'broadcasts.user_id')
                    ->where('broadcasts.broadcast_id',$chat_list->type_id)
                    ->get();
                
                
                
                $chat_list->title = $broadcasts[0]->description;
                $chat_list->user_name = $broadcasts[0]->name;
                
                 if($broadcasts[0]->dp_changed == 1)
                $chat_list->picture= $broadcasts[0]->profile_pic;
                elseif($broadcasts[0]->facebook_profile_dp != NULL)
                $chat_list->picture== $broadcasts[0]->facebook_profile_dp;
                elseif($broadcasts[0]->google_profile_dp != NULL)
                 $chat_list->picture== $broadcasts[0]->google_profile_dp;
                else
                 $chat_list->picture== 'images/profile.png'; 
               
                } 
                
                if($chat_list->type == "Swap")
                {
                $broadcasts = User::select('swaps.title','users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
			
                    ->leftJoin('swaps', 'users.user_id', '=', 'swaps.user_id')
                    ->where('swaps.swap_id',$chat_list->type_id)
                    ->get();     
                $chat_list->title = $broadcasts[0]->title;
                $chat_list->user_name = $broadcasts[0]->name;
                 if($broadcasts[0]->dp_changed == 1)
                $chat_list->picture= $broadcasts[0]->profile_pic;
                elseif($broadcasts[0]->facebook_profile_dp != NULL)
                $chat_list->picture== $broadcasts[0]->facebook_profile_dp;
                elseif($broadcasts[0]->google_profile_dp != NULL)
                 $chat_list->picture== $broadcasts[0]->google_profile_dp;
                else
                 $chat_list->picture== 'images/profile.png'; 
                
                
                    
                } 
                
            }
            //return $chat_lists_all;
            
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
                 $chat_list->picture== 'images/profile.png'; 
                
                
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
                 $chat_list->picture== 'images/profile.png'; 
                
                
                    
                } 
                
            }
           //return $chat_lists_all;
            return view('wannahelp.messages', compact('receptorUser', 'chat', 'chat_lists_all','location_from_ip','chat_lists_bc','chat_lists_sw','categories'));
      
    }
    
    function doLogout(){
        Auth::logout();
        //Session::flush();
        return Redirect::to('/');
    }
}
