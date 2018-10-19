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
                          <a style="color:white;text-decoration:none;" class="upload_dp" data-toggle="modal">
                          @if(Auth::user()->dp_changed == 1)
                          <div class="image1"><img src="{{Auth::user()->profile_pic}}" alt="" class="img-responsive profile-photo" /></div>
                          @else
                          
                        <div class="image1"><img src="{{Auth::user()->facebook_profile_dp}}" alt="" class="img-responsive profile-photo" /></div>
                        @endif
                        </a>
                      </div>
                      <!-- <h3 style="text-align:left">{{Auth::user()->name}}</h3>
                       @if($user_details!="" )
                            @if($user_details[0]->profession != "")
                            <p style="text-align:left" class="text-muted">{{$user_details[0]->profession}}</p>
                            @else
                            <p style="text-align:left" class="text-muted"></p>
                            @endif
                      @else
                        <p style="text-align:left" class="text-muted"></p>
                      @endif
                    -->
                    </div>
                  </div>
                  <div class="col-md-9">
                    <ul class="list-inline profile-menu">
                      <!-- <li><a href="timeline.html">Timeline</a></li> -->
                      <li><a class="active">{{Auth::user()->name}}</a></li>
                      <!-- <li><a href="timeline-album.html">Album</a></li>
                      <li><a href="timeline-friends.html">Friends</a></li> -->
                    </ul>
                    <ul class="follow-me list-inline">
                      <!-- <li style="padding-right:  45px;padding-top: 14px;">You have 1,299 followers</li> -->
                      <!-- <li><button class="btn-primary">Add Friend</button></li> -->
                    </ul>
                  </div>
                </div>
            </div><!--Timeline Menu for Large Screens End-->

              <!--Timeline Menu for Small Screens-->
            <div class="navbar-mobile hidden-lg hidden-md">
                <div class="profile-info">
                    
                    
                  <img src="http://placehold.it/300x300" alt="" class="img-responsive profile-photo" />
                  <h4>{{Auth::user()->name}}</h4>
                    @if($user_details!="")
                       <!-- @if($user_details[0]->profession != "")
                        <p class="text-muted">{{$user_details[0]->profession}}</p>
                        @else
                        <p class="text-muted"></p>
                        @endif -->
                    @else
                        <p class="text-muted"></p>
                    @endif   
                </div>
                <div class="mobile-menu">
                  <ul class="list-inline">
                    <!-- <li><a href="timline.html">Timeline</a></li> -->
                    <li><a href="timeline-about.html" class="active">Edit Profile</a></li>
                    <!-- <li><a href="timeline-album.html">Album</a></li>
                    <li><a href="timeline-friends.html">Friends</a></li> -->
                  </ul>
                  <button class="btn-primary">Add Friend</button>
                </div>
            </div><!--Timeline Menu for Small Screens End-->
        </div> <!--Timeline cover End-->
        
        <br><br>
        
        <span style="margin-left:  25px;font-weight: 600;"> Your Notifications </span>
      
   
        
        
        
        <div id="page-contents">
          <div class="row">
            
            <div class="col-md-8">
            @if(empty($user_notifications) || $user_notifications == '' || $user_notifications == NULL)
            You have no new notifications
            @endif
            @foreach($user_notifications as $user_noti)
            
            
                <div id={{$user_noti->id}}>
                    <div class="noti-box">
                        @if($user_noti->dp_changed == 1)
                         <img class="profile-photo-sm" style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src={{$user_noti->profile_pic}}>&nbsp;&nbsp;
                        @elseif($user_noti->facebook_profile_dp != NULL)
                          <img class="profile-photo-sm" style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src={{$user_noti->facebook_profile_dp}}>&nbsp;&nbsp;
                        @elseif($user_noti->google_profile_dp != NULL)
                          <img class="profile-photo-sm" style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src={{$user_noti->google_profile_dp}}>&nbsp;&nbsp;
                        @else
                         <img class="profile-photo-sm" style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src="<?php echo url('images/profile.png');?>">
                        @endif
                        
                        
                        &nbsp;&nbsp;&nbsp; {{$user_noti->message}} 
                        
                           
                        @php
                        
                            $result = mb_substr($user_noti->link_id, 0, 2);
                       
                        @endphp
                            @if($result=='SW')
                            
                            
                        <i onclick=trash({{$user_noti->id}}) class="fas fa-trash-alt" style="float:  right;margin-top: 13px;"></i>
                        
                         <a target="_blank" href="{{(new \App\Http\Controllers\Helper)->get_url()}}/swap/{{$user_noti->link_id}}/{{$user_noti->from_user_id}}/1">
                            <i class="fa fa-eye" style="float:  right;margin-top: 13px;padding-right: 20px;"></i>
                        </a> 
                            
                             @elseif($result=='LV')
                            
                            
                        <i onclick=trash({{$user_noti->id}}) class="fas fa-trash-alt" style="float:  right;margin-top: 13px;"></i>
                        
                         <a target="_blank" href="{{(new \App\Http\Controllers\Helper)->get_url()}}/lv/{{$user_noti->link_id}}">
                            <i class="fa fa-eye" style="float:  right;margin-top: 13px;padding-right: 20px;"></i>
                        </a> 
                            @endif
                    </div>       
                </div>
            
            @endforeach
              
            </div>
            <div style="margin-left:-22px;" class="col-md-4 static">
              
              <div class="lv_right_ad_wrap"></div>
              <div class="lv_right_ad_wrap"></div>
              
            </div>
          </div>
        </div>
        
        
    </div> <!--Timeline End-->
        
       
        
</div>
        














@endsection