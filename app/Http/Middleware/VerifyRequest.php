<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard; 
use Illuminate\Support\Facades\DB; 
use Response;
use Config;  
class VerifyRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */        
    public function __construct(){        
        $this->sts_103 = config('constants.response_codes.103');
        $this->sts_401 = config('constants.response_codes.401');
        $this->tbl_users = config('constants.table.users'); 
    }
    public function handle($request, Closure $next)
    {
        $api_token = $request->header('apitoken');
        if(!isset($api_token)){ 
          return response()->json(array('status'=>401,'message'=>$this->sts_401)); 
        }
        else
        {            
            $user_details = DB::table($this->tbl_users)->select('user_id')->where('api_token',$api_token)->first();           
            if(empty($user_details)){
                return response()->json(array('status'=>103,'message'=>$this->sts_103));
            }
            $request->merge(['user_id' => $user_details->user_id]);            
             
        }
        return $next($request);
    }
    
}
