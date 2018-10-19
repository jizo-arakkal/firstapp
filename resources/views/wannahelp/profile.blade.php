@extends('layouts.app')
@section('content')

<br><br><br>
<div class="container page_content_wrap"> 
<div class="timeline">
  
    
        @if($user_details[0]->facebook_cover_pic!="")
        <div class="timeline-cover" style="background:url({{$user_details[0]->facebook_cover_pic}});background-position: center;background-size: cover;">
        @elseif($user_details[0]->cover_changed == 1)
        <div class="timeline-cover" style="background:url({{$user_details[0]->cover_pic}});background-position: center;background-size: cover;">
        @else
        <div class="timeline-cover" style="background:url({{(new \App\Http\Controllers\Helper)->get_url()}}/images/1030x360.png);background-position: center;background-size: cover;">
        @endif 
        
             
                      

            <!--Timeline Menu for Large Screens-->
            <div class="timeline-nav-bar hidden-sm hidden-xs">
                <div class="row">
                  <div class="col-md-3">
                    <div class="profile-info">
                      <div class="cont">
                            
                            
                                @if($user_details[0]->dp_changed == 1)
                                <div class="image1"><img src="{{$user_details[0]->profile_pic}}" alt="" class="img-responsive profile-photo" /></div>
                                @elseif($user_details[0]->facebook_profile_dp!= '')
                                
                                <div class="image1"><img src="{{$user_details[0]->facebook_profile_dp}}" alt="" class="img-responsive profile-photo" /></div>
                                @else
                                <div class="image1"><img src="{{(new \App\Http\Controllers\Helper)->get_url()}}/images/300x300.png" alt="" class="img-responsive profile-photo" /></div>
                                
                                @endif
                         <!--   
                        <div class="middle"><div class="text"><a style="color:white;text-decoration:none;" class="upload_dp" data-toggle="modal" onclick="show_upload_dp_modal()">Update Profile Picture</a></div></div> -->
                      </div>
                      
                    </div>
                  </div>
                  <div class="col-md-9" style="margin-top: 6px;">
                    <ul class="list-inline profile-menu">
                      <!-- <li><a href="timeline.html">Timeline</a></li> -->
                      <li><a class="active">{{$user_details[0]->name}}'s Profile</a></li>
                      <!-- <li><a href="timeline-album.html">Album</a></li>
                      <li><a href="timeline-friends.html">Friends</a></li> -->
                    </ul>
                    <ul class="follow-me list-inline">
                        
                        <li style="padding-right:  45px;padding-top: 14px;">
                           
                           
                           @if(Auth::user() && Auth::user()->user_id == $user_details[0]->user_id )
                           <b>Credits :  {{ $user_details[0]->rem_credits }} </b>
                           @endif
                            
                           
                        </li>
                        
                      <li style="padding-right:  45px;padding-top: 14px;">
                           
                           
                           @if(Auth::user() && Auth::user()->user_id == $user_details[0]->user_id )
                           <a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/followers">
                           @endif
                            {{ $user_details[0]->followers_count }} people following  
                            @if($user_details[0]->gender) him
                            @elseif($user_details[0]->gender == "female") her
                            @else 
                            @endif
                            @if(Auth::user() && Auth::user()->user_id == $user_details[0]->user_id )
                           </a>
                           @endif 
                           
                        </li>
                        @if(Auth::user() && Auth::user()->user_id != $user_details[0]->user_id )
                            @if($user_details[0]->is_it == 0)
                          <li><button style="padding: 7px 25px;border: none;font-weight: 600;border-radius: 14px;" onclick="follow_unfollow_user('{{$user_details[0]->user_id}}')" class="btn-primary">Follow</button>
                          </li>
                          @elseif($user_details[0]->is_it == 1)
                          <li><button style="padding: 7px 25px;border: none;font-weight: 600;border-radius: 14px;" onclick="follow_unfollow_user('{{$user_details[0]->user_id}}')" class="btn-primary">Unfollow</button>
                          </li>
                          @endif
                          
                      
                        @endif  
                        
                        @if(!Auth::user())
                           <li><button style="padding: 7px 25px;border: none;font-weight: 600;border-radius: 14px;" onclick="show_login_form()" class="btn-primary">Follow</button>
                          </li>
                        @endif    
                    
                    </ul>
                  </div>
                  <br><br><br>
                </div>
            </div><!--Timeline Menu for Large Screens End-->

              <!--Timeline Menu for Small Screens-->
            
        </div> <!--Timeline cover End-->
    </div>    
</div>
<div class="page_search_wrap" style="margin-top: -40px;">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 page_search_wrap_left" style="margin-left: 325px;">
        <ul class="nav nav-pills">
             <li style="padding-right: 60px;" class="active"><a id="type" data-toggle="pill" href="#tab_personal_info_profile">Personal Information</a></li>
            <li style="padding-right: 60px;"><a id="type" data-toggle="pill" href="#tab_broadcast_profile">Broadcast</a></li>
            <li style="padding-right: 60px;"><a data-toggle="pill" href="#tab_swap_profile">Swap  <span class="numberCircle">{{count($user_swap)}}</span></a></li>
            <li style=""><a data-toggle="pill" href="#tab_localvocal_profile">LocalVocal <span class="numberCircle">{{count($user_localvocal)}}</span></a></li>
        </ul>   
        
        <!-- <ul class="nav nav-pills page_search_wrap_left_ul">
            <li class="active"><a id="type" data-toggle="pill" href="#tab_personal_info_profile">Personal Information</a></li>
            <li class=""><a id="type" data-toggle="pill" href="#tab_broadcast_profile">Broadcast</a></li>
            <li><a data-toggle="pill" href="#tab_swap_profile">Swap</a></li>
            <li class=""><a data-toggle="pill" href="#tab_localvocal_profile">LocalVocal</a></li>
        </ul> -->
    </div>
    <!--
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 page_search_wrap_right">

</div> -->
<div class="clearfix"></div>
</div>

<div class="container page_content_wrap" style="margin-top: -6px;">  

        
    <div class="page_data_wrap">

        <div class="tab-content">
            <div id="tab_personal_info_profile" class="tab-pane fade in active">                 <br>
            <h4>About {{$user_details[0]->name}}</h4>
            <br>
            <br>
            @if($user_details[0]->profession == "" && $user_details[0]->current_location == "" && $user_details[0]->about_me == "")
            
            <center><span><b>No Information to show!</b></span></center>
            
            @endif
            
               @if($user_details[0]->profession!= "")
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"> 
                    Profession:
                    </div>
                    
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"> 
                    <b>{{$user_details[0]->profession}}</b>
                    </div>  
                </div>
                @endif
            <br><br>
               @if($user_details[0]->current_location!= "")
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"> 
                    Current Location:
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                    <b>{{$user_details[0]->current_location}}</b>
                    </div>  
                </div>
                @endif
            <br><br>
               @if($user_details[0]->about_me!= "")
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"> 
                    About me:
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                    <b>{{$user_details[0]->about_me}}</b>
                    </div>  
                </div>
                @endif    
                
            </div>    
            <div id="tab_broadcast_profile" class="tab-pane fade">
                <br>
                <h4>CURRENT BROADCAST:</h4>
                
                <div class="broadcast_content">
                    @if(count($user_current_broadcast)>0)
                    @foreach($user_current_broadcast as $user_bt)
                    <div class="btm_user_listing_wrap">                    
                        <div class="btm_user_listing">
                            @if(Auth::user())
                            <div class="dropdown" style="float:right">
                                <button type="button" data-toggle="dropdown" class="btn" aria-expanded="false"><i aria-hidden="true" class="fa fa-ellipsis-h"></i></button> 
                                <ul class="dropdown-menu">
                                    @if(Auth::user()->user_id == $user_bt->user_id )
                                    <li><a onclick="edit_post_bc('{{$user_bt->broadcast_id}}','Broadcast')"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit</a></li>
                                   
                                    <li><a style="color:  #3097D1;font-weight:600;" onclick="boost_post_bc('{{$user_bt->broadcast_id}}','Broadcast')"><i class="fa fa-bolt" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Boost</a></li>
                                   
                                    
                                    @else
                                    <li><a onclick="report_post('{{$user_bt->broadcast_id}}','Broadcast')">Report</a></li>
                                    @endif
                                </ul>
                            </div>
                            @endif
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                    <div class="wh_profile_pic_btm">
                                    @if($user_bt->is_online == 1)    
                                        <span class="wh_profile_pic_top_active">
                                        <i class="fa fa-circle"></i>
                                    </span>
                                    @endif
                                    
                                    @if($user_bt->dp_changed == 1)
                                     <img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src={{$user_bt->profile_pic}}>&nbsp;&nbsp;
                                    @elseif($user_bt->facebook_profile_dp != NULL)
                                      <img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src={{$user_bt->facebook_profile_dp}}>&nbsp;&nbsp;
                                    @elseif($user_bt->google_profile_dp != NULL)
                                      <img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src={{$user_bt->google_profile_dp}}>&nbsp;&nbsp;
                                    @else
                                     <img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src="<?php echo url('images/profile.png');?>">
                                    @endif
                                    
                                   
                                    
                                    
                                    
                                    
                                    </div>
                                <p class="distance">{{$user_bt->location}}</p>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                 <div class="wh_name_btm">
                                    <p>{{$user_details[0]->name}}</p>
                                 </div>
                                 <div class="wh_brdcast_btm">
                                     {{$user_bt->description}}
                                 </div>
                                </div>
                                <!-- <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <button class="btn btn-chat-btm pull-right col-lg-12 col-md-12 col-sm-12 col-xs-12">CHAT</button>
                                    <div class="clearfix"></div>
                                </div> -->

                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                     <div class="clearfix"></div>
                </div>
                @endforeach
                 @else
                <br><br>
                <center><b>User has no Broadcast yet.</b></center>
                <br>
                @endif
            </div>
            @if(Auth::user())
            @if($user_id ==  Auth::user()->user_id)
            <br>
                <h4>OLD BROADCAST:</h4>
                
                <div class="broadcast_content">
                    
                    @if(count($user_old_broadcast)>0)
                    @foreach($user_old_broadcast as $user_bt)
                    <div class="btm_user_listing_wrap">                    
                        <div class="btm_user_listing">
                            @if(Auth::user())
                            <div class="dropdown" style="float:right">
                                <button type="button" data-toggle="dropdown" class="btn" aria-expanded="false"><i aria-hidden="true" class="fa fa-ellipsis-h"></i></button> 
                                <ul class="dropdown-menu">
                                    @if(Auth::user()->user_id == $user_bt->user_id )
                                    <li><a onclick="edit_post_bc('{{$user_bt->broadcast_id}}','Broadcast')"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit</a></li>
                                    <li><a onclick="make_bc_current('{{$user_bt->broadcast_id}}')">Set as Current</a></li>
                                    <!-- @if($user_details[0]->rem_credits > 0) -->
                                    <li><a style="color:  #3097D1;font-weight:600;" onclick="boost_post_bc('{{$user_bt->broadcast_id}}','Broadcast')"><i class="fa fa-bolt" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Boost</a></li>
                                    <!--@endif -->
                                    @else
                                    <li><a onclick="report_post('{{$user_bt->broadcast_id}}','Broadcast')">Report</a></li>
                                    @endif
                                </ul>
                            </div>
                            @endif
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                    <div class="wh_profile_pic_btm">
                                    @if($user_bt->is_online == 1)    
                                        <span class="wh_profile_pic_top_active">
                                        <i class="fa fa-circle"></i>
                                    </span>
                                    @endif
                                    
                                    @if($user_bt->dp_changed == 1)
                                     <img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src={{$user_bt->profile_pic}}>&nbsp;&nbsp;
                                    @elseif($user_bt->facebook_profile_dp != NULL)
                                      <img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src={{$user_bt->facebook_profile_dp}}>&nbsp;&nbsp;
                                    @elseif($user_bt->google_profile_dp != NULL)
                                      <img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src={{$user_bt->google_profile_dp}}>&nbsp;&nbsp;
                                    @else
                                     <img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src="<?php echo url('images/profile.png');?>">
                                    @endif
                                    
                                   
                                    
                                    
                                    
                                    
                                    </div>
                                <p class="distance">{{$user_bt->location}}</p>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                 <div class="wh_name_btm">
                                    <p>{{$user_details[0]->name}}</p>
                                 </div>
                                 <div class="wh_brdcast_btm">
                                     {{$user_bt->description}}
                                 </div>
                                </div>
                                <!-- <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <button class="btn btn-chat-btm pull-right col-lg-12 col-md-12 col-sm-12 col-xs-12">CHAT</button>
                                    <div class="clearfix"></div>
                                </div> -->

                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                     <div class="clearfix"></div>
                </div>
                @endforeach
                @else
                <br><br>
                <center><b>You have no other Broadcasts.</b></center>
                <br>
                @endif
                
            </div>
            
            @endif
                @endif
            </div>
            
            
            <div id="tab_swap_profile" class="tab-pane fade">
                <div class="swap_content">
                        <br><br><br>
                   
                        <ul id="waterfall_content_profile" style="list-style:none"> 
                            @if(count($user_swap)>0)
                            @foreach($user_swap as $swap)
                            <li>
                        
                            <div class="swap_list_item sw_normal_item">
        						<div class="swap_list_item_top">
        						    
        						     @if($swap->for_price != "" && $swap->for_goods != "") 
                                        <span style="z-index: 1;" class="price_tag"><i class="fa fa-inr" aria-hidden="true"></i>&nbsp; {{$swap->for_price}} or {{$swap->for_goods}}</span>
                                   @elseif($swap->for_price == "" && $swap->for_goods != "")
                                        <span style="z-index: 1;" class="price_tag">{{$swap->for_goods}}</span>
                                    @elseif($swap->for_price != "" && $swap->for_goods == "")
                                        <span style="z-index: 1;" class="price_tag"><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;{{$swap->for_price}}</span>
                                     @elseif($swap->for_any == 1)
                                        <span style="z-index: 1;" class="price_tag">&nbsp;Open for Anything</span>
                                    @elseif($swap->for_free == 1)
                                        <span style="z-index: 1;" class="price_tag">&nbsp;For Free</span>        
                                    @endif
        						    
        						        
                                    <div class="sw_detail_thumb">                            
                                        <div class="swap_slider" style="margin:0px 0px;">
                                            <div id="carousel-custom{{$swap->swap_id}}" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-outer">
                                                    <!-- Wrapper for slides -->
                                                    <div class="carousel-inner">
                                                        
                                                        @for ($i = 0; $i < count($swap->image); $i++)
                                                        
                                                        @if ($i==0)
                                                        
                                                         <div class="item active">
                                                            <a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/swap/{{$swap->temp_title}}-{{$swap->swap_id}}"><img style="height:auto !important;" src="{{(new \App\Http\Controllers\Helper)->get_swap_image_loc()}}{{$swap->image[$i]}}" alt=""></a>
                                                        </div>
                                                       
                                                        @else
                                                        <div class="item">
                                                            <a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/swap/{{$swap->temp_title}}-{{$swap->swap_id}}"><img style="height:auto !important;" src="{{(new \App\Http\Controllers\Helper)->get_swap_image_loc()}}{{$swap->image[$i]}}" alt=""></a>
                                                        </div>
                                                         @endif
                                                        @endfor
                                                        
                                                        
                                                       
                                                    </div>  
                                                    @if(count($swap->image) > 1)
                                                    <!-- Controls -->
                                                    <a class="left carousel-control" href="#carousel-custom{{$swap->swap_id}}" data-slide="prev">
                                                        <span class="fa fa-chevron-left"></span>
                                                    </a>
                                                    <a class="right carousel-control" href="#carousel-custom{{$swap->swap_id}}" data-slide="next">
                                                        <span class="fa fa-chevron-right"></span>
                                                    </a>
                                                    @endif
                                                </div>                            
                                                <!-- Indicators -->
                                                
            
                                            </div>
                                         </div>
                                     </div
        								
        								
        								
        								
        								
        								
        								
        								
        						</div>
        						<div class="swap_list_item_btm">
        							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 swap_prof_pic_wrap">
        							     @if($swap->is_online == 1)    
        								    <span class="swap_prof_online_batch"><i class="fa fa-circle"></i></span>
        								@endif
        								
        								@if($swap->dp_changed == 1)
                                            <img src={{$swap->profile_pic}}>&nbsp;&nbsp;
                                        @elseif($swap->google_profile_dp != NULL)
                                            <img src={{$swap->google_profile_dp}}>&nbsp;&nbsp;
                                        @elseif($swap->facebook_profile_dp != NULL)
                                            <img src={{$swap->facebook_profile_dp}}>&nbsp;&nbsp;
                                        @else
                                            <img src="<?php echo url('images/profile.png');?>">&nbsp;&nbsp;
                                        @endif
        								
        								
        								
        								<p>{{$swap->location}}  </p>
        							</div>
        							<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 swap_title_wrap">
        							    @if(Auth::user())
        							    <div class="dropdown" style="float:right">
                                                <button type="button" data-toggle="dropdown" class="btn" aria-expanded="false"><i aria-hidden="true" class="fa fa-ellipsis-h"></i></button> 
                                                <ul class="dropdown-menu">
                                                    @if(Auth::user()->user_id == $swap->user_id )
                                                   <!-- @if($user_details[0]->rem_credits > 0) -->
                                                    <li><a style="color:  #3097D1;font-weight:600;" onclick="boost_post_bc('{{$swap->swap_id}}','Swap')"><i class="fa fa-bolt" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Boost</a></li>
                                                   <!-- @endif  -->
                                                    <li><a onclick="edit_post_sw('{{$swap->swap_id}}','Swap')">Edit</a></li>
                                                    @else
                                                    <li><a onclick="report_post('{{$swap->swap_id}}','Swap')">Report</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        @endif    
        									<h4><a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/swap/{{$swap->temp_title}}-{{$swap->swap_id}}">{{$swap->title}}</a></h4>
        									
        									<p>Updated : 5 hours ago</p>
        									
        							</div>
        							<div class="clearfix"></div>
        						</div>
                            </div>
                        
                            </li>
                            @endforeach
                            @else
                                    <br><br>
                                    <center><b>User has no Swap yet.</b></center>
                                    <br>
                            @endif
                        </ul> 
                    
                
                </div>
               
            </div>

            <div id="tab_localvocal_profile" class="tab-pane fade">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_right_0 padding_left_0">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="float:right;">
                        

                        <div class="lv_right_ad_wrap">
                            
                        </div>

                        <div class="lv_right_ad_wrap">
                            
                        </div>

                    </div>
                    <?php $i=0;?>
                    @foreach($user_localvocal as $user_lv)
                    
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="lv_post_list">
                            <div class="lv_post_list_top">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-8 lv_post_name">
                                    
                                    @if($user_lv->dp_changed == 1)
                                    <img src={{$user_lv->profile_pic}}>&nbsp;&nbsp;
                                    @elseif($user_lv->google_profile_dp != NULL)
                                    <img src={{$user_lv->google_profile_dp}}>&nbsp;&nbsp;
                                    @elseif($user_lv->facebook_profile_dp != NULL)
                                    <img src={{$user_lv->facebook_profile_dp}}>&nbsp;&nbsp;
                                    @else
                                    <img src="<?php echo url('images/profile.png');?>">&nbsp;&nbsp;
                                    @endif
                                    
                                    
                                   {{$user_lv->name}}
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 lv_post_time">
                                    10 hrs ago
                                </div>
                                <div class="clearfix"></div>
                            </div>
                           <div class="sw_detail_thumb">                            
                            <div class="swap_slider" style="margin:0px 0px;">
                                <div id="carousel-custom" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-outer">
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner">
                                            
                                           <?php
                                           for($j=0;$j<count($user_lv->images);$j++)
                                           {
                                           ?>                                           
                                            
                                            @if($j == 0)
                                             <div class="item active">
                                                <img src="{{(new \App\Http\Controllers\Helper)->get_lv_image_loc()}}{{$user_lv->images[$j]}}" alt="">
                                            </div>
                                           
                                          @else
                                            <div class="item">
                                                <img src="{{(new \App\Http\Controllers\Helper)->get_lv_image_loc()}}{{$user_lv->images[$j]}}" alt="">
                                            </div>
                                            @endif
                                            
                                            <?php
                                           }
                                            ?>
                                           
                                        </div>            
                                        <!-- Controls -->
                                        @if(count($user_lv->images) > 1)
                                        <a class="left carousel-control" href="#carousel-custom" data-slide="prev">
                                            <span class="fa fa-chevron-left"></span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-custom" data-slide="next">
                                            <span class="fa fa-chevron-right"></span>
                                        </a>
                                        @endif
                                    </div>                            
                                    <!-- Indicators -->
                                    

                                </div>
                             </div>
                        </div>
                            <div class="lv_post_list_text">
                                <b>{{$user_lv->title}}</b>
                                <br>
                                <br>
                                 {{$user_lv->description}}
                            </div>
                            <div class="lv_post_list_view_cmts">
                                 View all {{count($user_lv->comments)}} comments
                            </div>
                            <div id="{{$user_lv->lv_id}}" class="lv_post_list_cmts_wrap">
                                @foreach($user_lv->comments as $comment)
                                 <div class="post-comment" id="1" style="display:inline-flex;margin: 10px auto;">
                                     
                                    @if($comment->dp_changed == 1)
                                    <img style="margin-right: 10px;" class="profile-photo-sm" src={{$comment->profile_pic}}>&nbsp;&nbsp;
                                    @elseif($comment->google_profile_dp != NULL)
                                    <img style="margin-right: 10px;" class="profile-photo-sm" src={{$comment->google_profile_dp}}>&nbsp;&nbsp;
                                    @elseif($comment->facebook_profile_dp != NULL)
                                    <img style="margin-right: 10px;" class="profile-photo-sm" src={{$comment->facebook_profile_dp}}>&nbsp;&nbsp;
                                    @else
                                    <img style="margin-right: 10px;" class="profile-photo-sm" src="<?php echo url('images/profile.png');?>">&nbsp;&nbsp;
                                    @endif
                                     <p><a href="{{(new \App\Http\Controllers\Helper)->get_url()}}\user\{{$comment->user_id}}" class="profile-link">{{$comment->name}} </a><i class="em em-laughing"></i> {{$comment->comment}} </p>
                                    
                                   
                                    </div> 
                                    
                                    <br/>
                                 @endforeach
                                 
                                 
                            </div>
                            @if(Auth::user())
                            
                             <div class="post-comment" style="display:inline-flex;margin: 10px auto;">
                             @if(Auth::user()->dp_changed == 1)
                                <img style="margin-left: 22px;margin-right: 10px;" class="profile-photo-sm" src={{Auth::user()->profile_pic}}>&nbsp;&nbsp;
                                @elseif(Auth::user()->google_profile_dp != NULL)
                                <img style="margin-left: 22px;margin-right: 10px;" class="profile-photo-sm" src={{Auth::user()->google_profile_dp}}>&nbsp;&nbsp;
                                @elseif(Auth::user()->facebook_profile_dp != NULL)
                                <img style="margin-left: 22px;margin-right: 10px;" class="profile-photo-sm" src={{Auth::user()->facebook_profile_dp}}>&nbsp;&nbsp;
                                @else
                                <img style="margin-left: 22px;margin-right: 10px;" class="profile-photo-sm" src="<?php echo url('images/profile.png');?>">&nbsp;&nbsp;
                            @endif

                             <input onkeypress="return savecomment(event,{{$user_lv->id}})" id="cmt_{{$user_lv->lv_id}}" style="width:570px !important" type="text" placeholder="Post a comment" class="form-control"></div>
                            @endif
                            <div class="lv_post_list_btm">
                                <div onclick="like_unlike_lv({{$user_lv->id}})" class="col-lg-2 col-md-2 col-sm-3 col-xs-4 lv_post_like{{$user_lv->lv_id}}">
                                
                            		@if($user_lv->like_status == "liked")
                            			<i style="color:#ed474f !important" class="fa fa-heart"></i>&nbsp;&nbsp;{{$user_lv->likes_count}}
                            		@else
                            			<i style="color:unset !important;" class="fa fa-heart"></i>&nbsp;&nbsp;{{$user_lv->likes_count}}
                            		@endif
                                </div>
                                
                                <div onclick="show_comments()" class="col-lg-2 col-md-2 col-sm-3 col-xs-4 lv_post_cmt">
                            		<i class="fa fa-comment-o" aria-hidden="true"></i>&nbsp;&nbsp;{{count($user_lv->comments)}}
                                </div>
                                <!-- <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 lv_post_share">
                            		<div class="dropdown">
                            			<button class="btn" type="button" data-toggle="dropdown"><i class="fa fa-share" aria-hidden="true"></i></button>
                            			<ul class="dropdown-menu">
                            				<li>
                            				    <?php
                            				Share::page((new \App\Http\Controllers\Helper)->get_url())->facebook() ->twitter() 	->googlePlus()	->linkedin('Extra linkedin summary can be passed here');
                            				    ?>
                            				</li>              
                            			</ul>
                            		</div>
                                
                                </div> -->
                                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 pull-right lv_post_morebtns">                                    
                            		<div class="dropdown">
                            			<button class="btn" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                            			<ul class="dropdown-menu">
                            		 <li><a onclick="report_post('{{$user_lv->lv_id}}','LocalVocal')">Report</a></li>              
                            			</ul>
                            		</div>
                                
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        
                    </div>
                    
                    <div class="clearfix"></div>
                    <?php $i++; ?>
                    @endforeach
                    
                </div>
            </div> <!-- End LV -->
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div> 
</div>


@endsection
