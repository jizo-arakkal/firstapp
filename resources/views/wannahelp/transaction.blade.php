    @extends('layouts.app')
@section('content')
<div class="container page_content_wrap">  
        
    <div class="page_data_wrap">
        
    <br><br><br>
            @if(!empty($credits))
            <h3>My Credits</h3>
            @foreach($credits as $credit)
                @if($credit->rem_credits > 0)
             
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top_ad_column" style="padding-top:20px">
              
            
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><b>Plan Name</b></div> 
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><b>Available Credits</b></div> 
                    
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><br></div> 
                    @if($credit->plan_name == "")
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><em>No Valid Plan</em></div> 
                    @else
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><em>{{$credit->plan_name}}</em></div> 
                    @endif
            
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">{{$credit->rem_credits}}</div> 
   
                    <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 checkboxes">
                            <input type="checkbox" value="{{$credit->plan_name}}" id="use_credit"/>&nbsp;&nbsp;Use this existing credit 
    
     
        
                    </div> -->
                     @if($credit->rem_credits > 0)
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div style="float:right;" id="user_credits_btn_{{$credit->plan_name}}">
                        <input type="button" class="btn btn-primary" onclick="use_credits('{{$post_id}}','{{$credit->plan_name}}')" value="Use this {{$credit->plan_name}} Credit" />
                    </div>  
                     </div> 
                     @endif  
     
      
                </div>
                
                @endif
            @endforeach
        @endif    
        
      
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_right_0 padding_left_0">
        <h3>Buy Credits</h3>
         <h4>My AD</h4>
            <br>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <label for="city">Title</label> 
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <label for="city">Plan</label> 
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                    <label for="city">Credits</label> 
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <label for="city">Validity</label> 
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <label for="city">Amount</label> 
                </div>
            </div>
            
            <br>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    @if($post_details[0]['type'] == "Broadcast")
                    <label for="title">{{$post_details[0]['description']}}</label> 
                    @else
                    <label for="title">{{$post_details[0]['title']}}</label> 
                    @endif
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                   <select id="plan_type" name="plan_type">
                      <option value="basic">Basic</option>
                      <option value="premium">Premium</option>
                      <option value="platinum">Platinum</option>
                    </select>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                    <span id="credits">1</span> 
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <span id="validity1">1 week</span> 
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <span id="amount">199</span> <span id="coupon_result"></span>
                </div>
            </div>
      <br><br>    
    </div>
    
   
        
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_right_0 padding_left_0">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="float: right;">
            
            <div class="lv_right_ad_wrap" style="border-color: #2579AA !important;">
                <br><br>
                <center><b>Reedem Voucher</b></center>
                <br><br>
                <center>Do you have coupon code?</center>
                <br>
                <center><input type="text" name="coupon_code" id="coupon_code"></center>
                <input type="hidden" name="plan_coupon_code" id="plan_coupon_code" value="Basic">
                  <br>
                <center><input value="Redeem" type="button" onclick="validate_coupon()"></center>
                <br>
            </div>
            
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        
            <form enctype='multipart/form-data' method="post" id="payuForm" name="payuForm">
           
            <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
            <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
            <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
            <input type="hidden" id="total_amount" name="amount" value="<?php echo $amount ?>" />
            <input type="hidden" name="furl" value="<?php echo $surl ?>" />
            <input type="hidden" name="surl" value="<?php echo $furl ?>" />
            <input type="hidden" name="productinfo" value="<?php echo $productinfo ?>" />
            <input type="hidden" id="udf1" name="udf1" value="Basic" /> 
            <input type="hidden" name="udf2" value="" /> 
            <input type="hidden" name="udf3" value="" /> 
            <input type="hidden" name="udf4" value="" /> 
            <input type="hidden" name="udf5" value="" />
            
            <input type="hidden" name="pg" value="" /> 
            <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
            
            
            
            <div class="features">
                <h3>Features: </h3>
                <span id="basic_features">
                <ul>
                <br>
                <li>Highlights your Post</li>
                <br>
                <li>Faster Responses</li>
                <br>
                <li>Validity: One Month</li>
                <br>
                </ul>
                </span>
            </div>    
            
           
             <h3>Transaction Details</h3>
            <br>
            @if(Auth::user()->name!="")
           
                    <input id="firstname" type="hidden" name="firstname" placeholder="Your name"  value="{{Auth::user()->name}}" class="form-control input-group-lg">
               
            @else
            <div class="row">
                <div class="form-group col-xs-6">
                    <label for="city">First Name*</label> 
                    <input id="firstname" type="hidden" name="firstname" placeholder="Your name"  value="" class="form-control input-group-lg" required>
                </div>
            </div>
             <br>
            @endif
           
             @if(Auth::user()->email!="")
           
                    <input id="email" type="hidden" name="email" value="{{Auth::user()->email}}" placeholder="Enter your email" class="form-control input-group-lg">
               
              @else
              
              <div class="row">
                <div class="form-group col-xs-6">
                    <label for="city">Email*</label> 
                    <input id="email" type="text" name="email" value="" placeholder="Enter your email" class="form-control input-group-lg" required>
                </div>
             </div>
             <br>
              @endif
            
            <div class="row">
            @if(Auth::user())
            
                @if(Auth::user()->mobile!="")
                
                <input id="phone" value="{{Auth::user()->mobile}}" type="hidden" name="phone" placeholder="Your mobile number" class="form-control input-group-lg">
                
                @else
                 <div class="form-group col-xs-6"><label for="city">Mobile Number*</label> <input id="phone" value="" type="text" name="phone" placeholder="Your mobile number" class="form-control input-group-lg" required></div>
                @endif
            @elseif(!Auth::user() || Auth::user()->mobile== "" )
              <div class="form-group col-xs-6"><label for="city">Mobile Number*</label> <input id="phone" value="" type="text" name="phone" placeholder="Your mobile number" class="form-control input-group-lg"></div>
            @endif 
             </div>

            <span><em>* All field are Required</em></span>
            <br>
            
            <br>
            
            
            <input type="submit" class="btn btn-primary" value="Proceed" />
            
            
            
            </form>
            <br/>
        </div>
    </div>
        
        
</div>
</div>

<div id="new_form" name="new_form"></div>

@endsection