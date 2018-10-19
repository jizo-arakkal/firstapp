@extends('layouts.app')
@section('content')
<div class="container page_content_wrap">  
        
    <br><br>

    <div class="timeline">
        @if(Auth::user()->facebook_cover_pic!="")
        <div class="timeline-cover" style="background:url({{Auth::user()->facebook_cover_pic}});background-position: center;background-size: cover;">
        @elseif(Auth::user()->cover_changed == 1)
        <div class="timeline-cover" style="background:url({{Auth::user()->cover_pic}});background-position: center;background-size: cover;">
        @else
        <div class="timeline-cover" style="background:url({{(new \App\Http\Controllers\Helper)->get_url()}}/images/1030x360.png);background-position: center;background-size: cover;">
        @endif              

            <!--Timeline Menu for Large Screens-->
            <div class="timeline-nav-bar hidden-sm hidden-xs">
                <div class="row">
                  <div class="col-md-3">
                    <div class="profile-info">
                      <div class="cont">
                          
                          @if(Auth::user()->dp_changed == 1)
                          <div class="image1"><img src="{{Auth::user()->profile_pic}}" alt="" class="img-responsive profile-photo" /></div>
                          @else
                          
                        <div class="image"><img src="{{Auth::user()->facebook_profile_dp}}" alt="" class="img-responsive profile-photo" /></div>
                        @endif
                       
                      </div>
                      <!--<h3 style="text-align:left">{{Auth::user()->name}}</h3>
                      @if($user_details!="" )
                            @if($user_details[0]->profession != "")
                            <p style="text-align:left" class="text-muted">{{$user_details[0]->profession}}</p>
                            @else
                            <p style="text-align:left" class="text-muted"></p>
                            @endif
                      @else
                        <p style="text-align:left" class="text-muted"></p>
                      @endif -->
                    
                    </div>
                  </div>
                  <div class="col-md-9">
                    <ul class="list-inline profile-menu">
                      <!-- <li><a href="timeline.html">Timeline</a></li> -->
                      <li><a class="active">Followers/Following</a></li>
                      <!-- <li><a href="timeline-album.html">Album</a></li>
                      <li><a href="timeline-friends.html">Friends</a></li> -->
                    </ul>
                    <ul class="follow-me list-inline">
                      <li style="padding-right:  45px;padding-top: 14px;">You have {{count($update_data_followers)}} follower(s)</li>
                      <!-- <li><button class="btn-primary">Add Friend</button></li> -->
                    </ul>
                  </div>
                </div>
            </div><!--Timeline Menu for Large Screens End-->

              <!--Timeline Menu for Small Screens-->
            <div class="navbar-mobile hidden-lg hidden-md">
                <div class="profile-info">
                @if(Auth::user()->dp_changed == 1)
                        <div class="img-responsive profile-photo"><img src="{{Auth::user()->profile_pic}}" alt="" class="img-responsive profile-photo" /></div>
                        @elseif(Auth::user()->facebook_profile_dp != "")
                        
                        <div class="img-responsive profile-photo"><img src="{{Auth::user()->facebook_profile_dp}}" alt="" class="img-responsive profile-photo" /></div>
                        @elseif(Auth::user()->google_profile_dp != "")
                        <div class="img-responsive profile-photo"><img src="{{Auth::user()->google_profile_dp}}" alt="" class="img-responsive profile-photo" /></div>
                        @else
                        <div class="img-responsive profile-photo"><img src="images/profile.png" alt="" class="img-responsive profile-photo" /></div>
                        @endif
                 
                  
                   <!--  @if($user_details!="")
                       <!-- @if($user_details[0]->profession != "")
                        <p class="text-muted">{{$user_details[0]->profession}}</p>
                        @else
                        <p class="text-muted"></p>
                        @endif -->
                   <!-- @else
                        <p class="text-muted"></p>
                    @endif   -->
                </div>
                <!-- <div class="mobile-menu">
                  <ul class="list-inline">
                    <!-- <li><a href="timline.html">Timeline</a></li> -->
                    <!-- <li><a href="timeline-about.html" class="active">Edit Profile</a></li> -->
                    <!-- <li><a href="timeline-album.html">Album</a></li>
                    <li><a href="timeline-friends.html">Friends</a></li> -->
                  <!--</ul>
                  <button class="btn-primary">Add Friend</button>
                </div> -->
            </div><!--Timeline Menu for Small Screens End-->
        </div> <!--Timeline cover End-->
        
      
        
    <div id="page-contents">
            
        <div class="row">
            <div class="col-sm-3">
                <ul class="nav nav-tabs tabs-left" role="tablist">
                  <li role="presentation" class="active"><a href="#followers" aria-controls="followers" role="tab" data-toggle="tab">Followers</a></li>
                  <li role="presentation"><a href="#following" aria-controls="following" role="tab" data-toggle="tab">Following</a></li>
                  
                </ul>
             </div>
          
                <div class="tab-content">
                    
                    <div role="tabpanel" class="tab-pane active" id="followers">
                        <div class="row" style="margin-left: 15px !important;margin-right: -127px !important;">
                            
                            
                            @if($update_data_followers!= "")
                            <h4> Your Followers </h4>
                                @foreach($update_data_followers as $follower)
                                <div class="col-sm-2">    
                                    <div class="friend-card">
                              	
                              	        <div class="card-info">
                              	            
                              	            
                              	            @if($follower[0]->dp_changed == 1)
                                                <img src="{{$follower[0]->profile_pic}}" alt="" class="profile-photo-lg" />
                                            @elseif($follower[0]->facebook_profile_dp!= '')
                                                
                                                <img src="{{$follower[0]->facebook_profile_dp}}" alt="" class="profile-photo-lg" />
                                                
                                             @elseif($follower[0]->google_profile_dp!= '')
                                                
                                                <img src="{{$follower[0]->google_profile_dp}}" alt="" class="profile-photo-lg" />
                                                
                                            @else
                                                <img src="{{(new \App\Http\Controllers\Helper)->get_url()}}/images/profile.png" alt="" class="profile-photo-lg" />
                                                
                                            @endif
                              	            
            
                                            
                                            <div class="friend-info">
                                               
                                  	            <h5><a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/user/{{$follower[0]->user_id}}" class="profile-link">{{$follower[0]->name}}</a></h5>
                                  	            
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                @endforeach
                            @else
                            
                            You have no followers!
                            
                            @endif
                            
                            
                            
            
                            
                        </div>

                    </div>
                    
                    <div role="tabpanel" class="tab-pane " id="following">
                       
                        @if(!empty($update_data_following))
                        @foreach($update_data_following as $following)
                           
                            <div class="col-sm-2">    
                                <div class="friend-card">
                          	
                          	        <div class="card-info"> 
                          	                @if($following[0]->dp_changed == 1)
                                                <img src="{{$following[0]->profile_pic}}" alt="" class="profile-photo-lg" />
                                            @elseif($following[0]->facebook_profile_dp!= '')
                                                
                                                <img src="{{$following[0]->facebook_profile_dp}}" alt="" class="profile-photo-lg" />
                                            @else
                                                <img src="{{(new \App\Http\Controllers\Helper)->get_url()}}/images/300x300.png" alt="" class="profile-photo-lg" />
                                                
                                            @endif
                                        <div class="friend-info">
                                           
                              	            <h5><a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/user/{{$following[0]->user_id}}" class="profile-link">{{$following[0]->name}}</a></h5>
                              	            <p>{{$following[0]->profession}}</p>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            @endforeach
                        @else
                            
                            You are not following anyone!    
                            @endif
                        
                        
                    </div>
                  
                  
                </div>
           
        </div>
        
            
            
          
        </div> <!--page contents End-->
        
        
    </div> <!--Timeline End-->
        
       
        
</div>
        














@endsection