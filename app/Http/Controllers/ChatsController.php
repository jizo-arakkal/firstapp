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
use App\Http\Models\Chat;

//use App\Broadcast;
use DB;
use OAuth;
use Redirect;
use Auth;
use DateTime;
use Hash;

class ChatsController extends Controller
{

 public function __construct()
    {
        //$this->middleware('auth');
        
    	$this->rest = new RestController();
    	$this->Smail = new MailController();
    	$this->s3 = new S3Controller();
    	$this->user = new User();
    	$this->bc = new Broadcast();
    	
    //	$ip = $_SERVER['REMOTE_ADDR'];
    //	$geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip;
       // $addrDetailsArr = unserialize(file_get_contents($geopluginURL));
       // if(empty($addrDetailsArr['geoplugin_city']))
         $this->location_from_ip = "Select City";
        //  else
      //  $this->location_from_ip = $addrDetailsArr['geoplugin_city'];
    } 
    
    public function new_chat1()
    {
        
    $temp_bc_id = Input::get( 'id' );
    $bc_id = "BC".$temp_bc_id;
    $user_id = Auth::user()->user_id;
    $bc_details_id = DB::table('broadcasts')->where('broadcast_id',$bc_id)->pluck('user_id');
    $bc_details_desc = DB::table('broadcasts')->where('broadcast_id',$bc_id)->pluck('description');
    //return $bc_details;
    $bc_user_id = $bc_details_id[0];
    
    $bc_desc = $bc_details_desc[0];
    $messages_oneway =  DB::table('messages')
                ->where('type_id',$bc_id)
                ->where('from_user_id',$user_id)
                ->where('to_user_id',$bc_user_id)
                ->count();
    $messages_otherway =  DB::table('messages')
                ->where('type_id',$bc_id)
                ->where('from_user_id',$bc_user_id)
                ->where('to_user_id',$user_id)
                ->count();
    if($messages_oneway == 0 && $messages_otherway == 0)
    {
    $conv_id = $this->get_unique_conv_id();
    }
    else
    {
        //return "exist";
     $pluck_conv_id =  DB::table('messages')
                //->pluck('conv_id')
                ->where('type_id',$bc_id)
                ->where('from_user_id',$bc_user_id)
                ->where('to_user_id',$user_id)
                ->first();
        $conv_id = $pluck_conv_id->conv_id;      
        if($conv_id == "")
        
        {
            
           $pluck_conv_id =  DB::table('messages')
                //->pluck('conv_id')
                ->where('type_id',$bc_id)
                ->where('from_user_id',$user_id)
                ->where('to_user_id',$bc_user_id)
                ->first();  
            
            
        }
         $conv_id = $pluck_conv_id->conv_id;  
    
        
    }
    //return $conv_id;
    $temp_conv_id = substr($conv_id,2);
    //return $conv_id;
    $bc_user_details = DB::table('users')
                ->select('users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
                ->where('user_id',$bc_user_id)
                ->get();
    
    $user_details = DB::table('users')
                ->select('users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
                ->where('user_id',$user_id)
                ->get();
                
    $messages =  DB::table('messages')
                ->select('messages.*')
                ->where('conv_id',$conv_id)
                ->where('type_id',$bc_id)
                ->get();           
                
    $mess_count = count($messages);            
                
    //return $bc_user_details[0]->name;			
    $chat_string = "";
    $chat_string.= '<div class="row chat-window col-xs-5 col-md-3" id="'.$conv_id.'" style="z-index:1;margin-left:10px;">';
    $chat_string.= '<div class="col-xs-12 col-md-12">';
    $chat_string.= '<div class="panel panel-default">';
    $chat_string.= '<div class="panel-heading top-bar">';
    $chat_string.= '<div class="col-md-8 col-xs-8">';
    $chat_string.= '<h3 class="panel-title"><span class="fa fa-commenting"></span> '.$bc_desc.' </h3>';
    $chat_string.= '</div>';
    $chat_string.= '<div class="col-md-4 col-xs-4" style="text-align: right;">';
    $chat_string.= '<a><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>';
    $chat_string.= '<a ><span class="glyphicon glyphicon-remove icon_close" data-id="'.$conv_id.'"></span></a>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    $temp_new_conv_id = $conv_id.'_cont';
    $chat_string.= '<div id="'.$temp_new_conv_id.'" class="panel-body msg_container_base">';
    
    foreach($messages as $msg)
    {
    
    
    if($msg->from_user_id == $bc_user_id)   
    {
    $chat_string.= '<div class="row msg_container base_receive">';
    $chat_string.= '<div class="col-md-2 col-xs-2 avatar">';
    $chat_string.= '<img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">';
    $chat_string.= '</div>';
    $chat_string.= '<div class="col-md-10 col-xs-10">';
    $chat_string.= '<div class="messages msg_receive">';
    $chat_string.= '<p>'.$msg->message.'</p>';
    $chat_string.= '<time datetime="2009-11-13T20:00">'.$bc_user_details[0]->name.'• 51 min</time>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    }
    else
    {
    $chat_string.= '<div class="row msg_container base_sent">';
    $chat_string.= '<div class="col-xs-10 col-md-10">';
    $chat_string.= '<div class="messages msg_sent">';
    $chat_string.= '<p>'.$msg->message.'</p>';
    $chat_string.= '<time datetime="2009-11-13T20:00">'.$user_details[0]->name.' • 51 min</time>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    $chat_string.= '<div class="col-md-2 col-xs-2 avatar">';
    $chat_string.= '<img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    
    }
        
    }
    $chat_string.= '</div>';
    $chat_string.= '<div class="panel-footer">';
    $chat_string.= '<div class="input-group">';
    $chat_string.= '<input id="'.$temp_conv_id.'" type="text" class="form-control input-sm chat_input" placeholder="Write your message here..." />';
    $chat_string.= '<span class="input-group-btn">';
    $chat_string.= '<button onclick="send_message('.$temp_conv_id.','.$temp_bc_id.')"class="btn btn-primary btn-sm" id="btn-chat">Send</button>';
    $chat_string.= '</span>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    return $chat_string;
    }
    
    
    public function new_chat()
    {
   
    $temp_bc_id = Input::get( 'id' );
     $type = Input::get( 'type' );
    if($type == 1)
    {
    $bc_id = "BC".$temp_bc_id;
    $bc_user_id_pluck = DB::table('broadcasts')->where('broadcast_id',$bc_id)->pluck('user_id');
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
    
     $chat =  $this->hasChatWith($bc_user_id,$bc_id,$type);
     
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
    $chat_string = "";
    $chat_string.= '<div class="row chat-window col-xs-5 col-md-3" id="'.$conv_id.'" style="z-index:1;margin-left:10px;">';

    $chat_string.= '<div class="col-xs-12 col-md-12">';
    $chat_string.= '<div class="panel panel-default">';
    $chat_string.= '<div class="panel-heading top-bar">';
    $chat_string.= '<div class="col-md-10 col-xs-10">';
    $chat_string.= '<h3 class="panel-title"><span class="fa fa-commenting"></span> '.$bc_desc.' </h3>';
    $chat_string.= '</div>';
    $chat_string.= '<div class="col-md-2 col-xs-2" style="text-align: right;">';
    $chat_string.= '<a><span style="font-size:  10px;" id="minim_chat_window" class="fa fa-window-minimize icon_minim"></span></a>';
    $chat_string.= '<a ><span class="fa fa-times icon_close" data-id="'.$conv_id.'"></span></a>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    $temp_new_conv_id = $conv_id.'_cont';
    $chat_string.= '<div id="'.$conv_id.'" class="panel-body" style="overflow-y: unset !important;padding:0px !important;height:auto !important">';
    
  // $chat_string.= '<h3 class="ui dividing header"><i class="talk outline icon"></i> Conversaci贸n con test</h3>';
    $chat_string.= '<firebase-messages user-id="'.Auth::user()->user_id.'" conv-id="'.$conv_id.'" receptor-name="'. $bc_user_name.'"></firebase-messages>';
    
    $chat_string.= '</div>';
    
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
  //  $chat_string ='<firebase-messages user-id="PQ189810520811YR" conv-id="CV1811906195791" receptor-name="Shyam"></firebase-messages>';
    return $chat_string;
    }
    
    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
      return Message::with('user')->get();
    }
    
    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function send_message()
    {
        //$message = $request->input('msg');
        $temp_conv_id  = Input::get('conv_id');
        $recd_conv_id = "CV".$temp_conv_id;
       $message  = Input::get('msg');
       $type_id  = Input::get('type_id');
       $bc_id = "BC".$type_id;
       //return $message;
        $from_user_id = Auth::user()->user_id;
        
        
        
        $pluck_to_user_id = DB::table('broadcasts')->where('broadcast_id',$bc_id)->pluck('user_id');
        //$to_user_id = Input::get('')
        $to_user_id = $pluck_to_user_id[0];
        
        if($from_user_id == $to_user_id)
        {
            $msg_details = DB::table('messages')
            ->select('messages.from_user_id','messages.to_user_id')
            ->where('conv_id',$recd_conv_id)
            ->first();
            //return $msg_details->from_user_id;
            if($msg_details->from_user_id == $to_user_id)
            $to_user_id = $msg_details->to_user_id;
            else
            $to_user_id = $msg_details->from_user_id;
            
        }
        
        $user_details = DB::table('users')
            ->select('users.name','users.dp_changed','users.profile_pic','users.google_profile_dp','users.facebook_profile_dp','users.is_online')
            ->where('user_id',Auth::user()->user_id)
            ->get();
        
        // check if already exsits
        
        
        $messages_oneway =  DB::table('messages')
                ->where('type_id',$bc_id)
                ->where('from_user_id',$from_user_id)
                ->where('to_user_id',$to_user_id)
                ->count();
        $messages_otherway =  DB::table('messages')
                    ->where('type_id',$bc_id)
                    ->where('from_user_id',$to_user_id)
                    ->where('to_user_id',$from_user_id)
                    ->count();
        if($messages_oneway == 0 && $messages_otherway == 0)
        {
        $conv_id = $recd_conv_id;
        }
        else
        {
            //return "exist";
         $pluck_conv_id =  DB::table('messages')
                    //->pluck('conv_id')
                    ->where('type_id',$bc_id)
                    ->where('from_user_id',$from_user_id)
                    ->where('to_user_id',$to_user_id)
                    ->first();
            $conv_id = $pluck_conv_id->conv_id;      
            if($conv_id == "")
            
            {
                
               $pluck_conv_id =  DB::table('messages')
                    //->pluck('conv_id')
                    ->where('type_id',$bc_id)
                    ->where('from_user_id',$to_user_id)
                    ->where('to_user_id',$from_user_id)
                    ->first();  
                
                
            }
             $conv_id = $pluck_conv_id->conv_id;  
        
            
        }
        // return $conv_id;
        
        
        $values_message = array(
    	  	'from_user_id'=> Auth::user()->user_id,
    	  	'to_user_id'=> $to_user_id, 
    	  	'message'=> $message,
    	  	'type_id'=> $bc_id,
    	  	'conv_id'=> $conv_id,
    	  	'created_at' => date('Y-m-d y:i:s'),
    	  	'updated_at' => date('Y-m-d y:i:s')
             );
            //print_r($values_sw);
        $sts = $this->rest->insert_values($this->rest->tbl_messages,$values_message);
        
        if($sts == 1)
            {
            $chat_string = "";
            $chat_string.= '<div class="row msg_container base_sent">';
            $chat_string.= '<div class="col-xs-10 col-md-10">';
            $chat_string.= '<div class="messages msg_sent">';
            $chat_string.= '<p>'.$message.'</p>';
            $chat_string.= '<time datetime="2009-11-13T20:00">'.$user_details[0]->name.' • 51 min</time>';
            $chat_string.= '</div>';
            $chat_string.= '</div>';
            $chat_string.= '<div class="col-md-2 col-xs-2 avatar">';
            $chat_string.= '<img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">';
            $chat_string.= '</div>';
            $chat_string.= '</div>';
            //return ['status' => 'Message Sent!'];
            }
            return $chat_string;    
            }
    
    public function get_unique_conv_id()
    	{				
    		$conv_id = 'CV'.date('yzhis');
    		$conv_id .= rand(00,99);	
    		$result = DB::table('messages')->where('conv_id',$conv_id)->first();
    		if(!empty($result)) $this->get_unique_conv_id();	
    		return $conv_id;
    	}
    	
    	
    public function load_chat_window()
    {				
	$conv_ids =  DB::table('messages')
        ->select('messages.conv_id')
        ->where('to_user_id',Auth::user()->user_id)
        ->where('is_read',0)
        ->distinct()
        ->get();
        
        
     // return $messages;  
        
      // [{"conv_id":"CV1810693174895"}]  
      
      $chat_string='';
    foreach($conv_ids as $conv_id)
    {
        
        $messages =  DB::table('messages')
        ->select('messages.*')
        ->where('conv_id',$conv_id->conv_id)
        
        ->get();
        
         $user_name =  DB::table('users')
        ->select('users.name')
        ->where('user_id',$messages[0]->to_user_id)
        
        ->get();
        
        $from_user_name =  $user_name[0]->name;
        $to_user_name = Auth::user()->name;
        
        
         $mess_count = count($messages);      
         
         for($i=0;$i<$mess_count;$i++)
   {
    $chat_string.= '<div class="row chat-window col-xs-5 col-md-3" id="'.$conv_id.'" style="z-index:1;margin-left:10px;">';
    $chat_string.= '<div class="col-xs-12 col-md-12">';
    $chat_string.= '<div class="panel panel-default">';
    $chat_string.= '<div class="panel-heading top-bar">';
    $chat_string.= '<div class="col-md-8 col-xs-8">';
    $chat_string.= '<h3 class="panel-title"><span class="fa fa-commenting"></span> '.$bc_desc.' </h3>';
    $chat_string.= '</div>';
    $chat_string.= '<div class="col-md-4 col-xs-4" style="text-align: right;">';
    $chat_string.= '<a><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>';
    $chat_string.= '<a ><span class="glyphicon glyphicon-remove icon_close" data-id="'.$conv_id.'"></span></a>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    $temp_new_conv_id = $conv_id.'_cont';
    $chat_string.= '<div id="'.$temp_new_conv_id.'" class="panel-body msg_container_base">';
    
    foreach($messages as $msg)
    {
    
    
    if($msg->from_user_id == Auth::user()->id)   
    {
        
    $chat_string.= '<div class="row msg_container base_sent">';
    $chat_string.= '<div class="col-xs-10 col-md-10">';
    $chat_string.= '<div class="messages msg_sent">';
    $chat_string.= '<p>'.$msg->message.'</p>';
    $chat_string.= '<time datetime="2009-11-13T20:00">'.$from_user_name.' • 51 min</time>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    $chat_string.= '<div class="col-md-2 col-xs-2 avatar">';
    $chat_string.= '<img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    
    }
    else
    {
    
    $chat_string.= '<div class="row msg_container base_receive">';
    $chat_string.= '<div class="col-md-2 col-xs-2 avatar">';
    $chat_string.= '<img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">';
    $chat_string.= '</div>';
    $chat_string.= '<div class="col-md-10 col-xs-10">';
    $chat_string.= '<div class="messages msg_receive">';
    $chat_string.= '<p>'.$msg->message.'</p>';
    $chat_string.= '<time datetime="2009-11-13T20:00">'.$to_user_name.'• 51 min</time>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    
    }
        
    }
    $chat_string.= '</div>';
    $chat_string.= '<div class="panel-footer">';
    $chat_string.= '<div class="input-group">';
    $chat_string.= '<input id="'.$temp_conv_id.'" type="text" class="form-control input-sm chat_input" placeholder="Write your message here..." />';
    $chat_string.= '<span class="input-group-btn">';
    $chat_string.= '<button onclick="send_message('.$temp_conv_id.','.$temp_bc_id.')"class="btn btn-primary btn-sm" id="btn-chat">Send</button>';
    $chat_string.= '</span>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    		
    	}
        
        
       // return $from_user_name. $to_user_name;
     // return $messages;  
        
    //  $messages[0]->description = DB::table('broadcasts')->where('broadcast_id',$msg->type_id)->pluck('description'); 
    }
    //return $messages;
    
    

   // [{"id":"2","type":"broadcast","type_id":"BC189811011349","from_user_id":"PQ189810520811YR","to_user_id":"KS189810505654XN","message":"I am fine, Thanks","conv_id":"CV1810693174895","is_read":"0","created_at":"2018-04-13 12:33:42","updated_at":"2018-04-13 12:33:42","description":["Looking for Web Developer"]}]
    
    
    $mess_count = count($messages);         
    //$mess_count;
    
    //return $bc_user_details[0]->name;			
    
    //for
      $chat_string = "";           
    
   for($i=0;$i<$mess_count;$i++)
   {
    $chat_string.= '<div class="row chat-window col-xs-5 col-md-3" id="'.$conv_id.'" style="z-index:1;margin-left:10px;">';
    $chat_string.= '<div class="col-xs-12 col-md-12">';
    $chat_string.= '<div class="panel panel-default">';
    $chat_string.= '<div class="panel-heading top-bar">';
    $chat_string.= '<div class="col-md-8 col-xs-8">';
    $chat_string.= '<h3 class="panel-title"><span class="fa fa-commenting"></span> '.$bc_desc.' </h3>';
    $chat_string.= '</div>';
    $chat_string.= '<div class="col-md-4 col-xs-4" style="text-align: right;">';
    $chat_string.= '<a><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>';
    $chat_string.= '<a ><span class="glyphicon glyphicon-remove icon_close" data-id="'.$conv_id.'"></span></a>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    $temp_new_conv_id = $conv_id.'_cont';
    $chat_string.= '<div id="'.$temp_new_conv_id.'" class="panel-body msg_container_base">';
    
    foreach($messages as $msg)
    {
    
    
    if($msg->from_user_id == $bc_user_id)   
    {
    $chat_string.= '<div class="row msg_container base_receive">';
    $chat_string.= '<div class="col-md-2 col-xs-2 avatar">';
    $chat_string.= '<img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">';
    $chat_string.= '</div>';
    $chat_string.= '<div class="col-md-10 col-xs-10">';
    $chat_string.= '<div class="messages msg_receive">';
    $chat_string.= '<p>'.$msg->message.'</p>';
    $chat_string.= '<time datetime="2009-11-13T20:00">'.$bc_user_details[0]->name.'• 51 min</time>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    }
    else
    {
    $chat_string.= '<div class="row msg_container base_sent">';
    $chat_string.= '<div class="col-xs-10 col-md-10">';
    $chat_string.= '<div class="messages msg_sent">';
    $chat_string.= '<p>'.$msg->message.'</p>';
    $chat_string.= '<time datetime="2009-11-13T20:00">'.$user_details[0]->name.' • 51 min</time>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    $chat_string.= '<div class="col-md-2 col-xs-2 avatar">';
    $chat_string.= '<img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    
    }
        
    }
    $chat_string.= '</div>';
    $chat_string.= '<div class="panel-footer">';
    $chat_string.= '<div class="input-group">';
    $chat_string.= '<input id="'.$temp_conv_id.'" type="text" class="form-control input-sm chat_input" placeholder="Write your message here..." />';
    $chat_string.= '<span class="input-group-btn">';
    $chat_string.= '<button onclick="send_message('.$temp_conv_id.','.$temp_bc_id.')"class="btn btn-primary btn-sm" id="btn-chat">Send</button>';
    $chat_string.= '</span>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    $chat_string.= '</div>';
    		
    	}

}


public function usersChat($convId = "")
    {
        
        $categories = DB::table('categories')
		//	->where('blocked_by_admin','=','0')
			->select('category_title','logo_image','id')
			->get();
        $receptorUser = Chat::where('conv_id', $convId)->first();
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
           
             $chat_lists_all = Chat::where('user_id1', '=', Auth::user()->user_id)
            ->orWhere('user_id2', Auth::user()->user_id)
            ->get();
            
            $chat_lists_bc = Chat::Where('type', "Broadcast")
            ->where('user_id1', '=', Auth::user()->user_id)
            ->orWhere('user_id2', Auth::user()->user_id)
            
            ->get();
            
            $chat_lists_sw = Chat::Where('type','Swap')
                ->where('user_id1', '=', Auth::user()->user_id)
            ->orWhere('user_id2', Auth::user()->user_id)
          
            ->get();
            //return $chat_lists_sw;
            if(count($chat_lists_sw) == 0 )
            {
               
                $chat_lists_sw = Chat::where('user_id2', '=', Auth::user()->user_id)
            
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
            $location_from_ip = $this->location_from_ip;
            return view('wannahelp.chat', compact('receptorUser', 'chat', 'chat_lists_all', 'chat_lists_bc', 'chat_lists_sw','location_from_ip','categories'));
            
            
        }else {
           
            
            $chat_lists_all = Chat::where('user_id1', '=', Auth::user()->user_id)
            ->orWhere('user_id2', Auth::user()->user_id)
            ->get();
            
            
            $chat_lists_bc = Chat::Where('type', "Broadcast")
            ->where('user_id1', '=', Auth::user()->user_id)
            ->orWhere('user_id2', Auth::user()->user_id)
            //->
            ->get();
            
            $chat_lists_sw = Chat:: Where('type','Swap')
                ->where('user_id1', '=', Auth::user()->user_id)
            ->orWhere('user_id2', Auth::user()->user_id)
          
            ->get();
           // return $chat_lists_sw;
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
            $location_from_ip = $this->location_from_ip;
          //return $receptorUser->id;
           $receptor_id = $receptorUser->user_id1;
          if($receptor_id == Auth::user()->user_id)
          {
              $receptor_id = $receptorUser->user_id2;
          }
         // return $receptor_id;
            $chat = $this->hasChatWith($receptor_id,$receptorUser->type_id,""); 
           $location_from_ip = $this->location_from_ip;
            //return $chat;
            return view('wannahelp.chat', compact('receptorUser', 'chat', 'chat_lists_all','location_from_ip','chat_lists_bc','chat_lists_sw','categories'));
        }
    }

    public function hasChatWith($userId,$bc_id,$type)
    {
       // return $bc_id;
        $chat = Chat::where('user_id1', Auth::user()->user_id)
        ->where("type_id",$bc_id)
            ->where('user_id2', $userId)
            ->orWhere('user_id1', $userId)
            ->where('user_id2', Auth::user()->user_id)
            ->where("type_id",$bc_id)
            ->get();
       //return $chat;
        if(!$chat->isEmpty()){
            
             $chat = Chat::where('user_id1', Auth::user()->user_id)
            ->where('user_id2', $userId)
            ->orWhere('user_id1', $userId)
            ->where('user_id2', Auth::user()->user_id)
            ->where("type_id",$bc_id)
            ->get();
            
        //    $conv_id = $chat[0];
           // $update = DB::raw('UPDATE `chats` SET update_at=now();');
            
            return $chat->first();
        }else{
            
            
            $conv_id = $this->get_unique_conv_id();
            return $this->createChat(Auth::user()->user_id, $userId,$conv_id,$bc_id,$type);
            
        }
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
    
    
    
    
   
     

}
