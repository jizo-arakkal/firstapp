@extends('layouts.app')
@section('content')
<div class="container page_content_wrap">  
        
    <div class="page_data_wrap">
               
    <br><br>      
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_right_0 padding_left_0">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="lv_post_list">
                            <div class="lv_post_list_top">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-8 lv_post_name">
                                    
                                    @if($lv_detail[0]->dp_changed == 1)
                                    <img src={{$lv_detail[0]->profile_pic}}>&nbsp;&nbsp;
                                    @elseif($lv_detail[0]->google_profile_dp != NULL)
                                    <img src={{$lv_detail[0]->google_profile_dp}}>&nbsp;&nbsp;
                                    @elseif($lv_detail[0]->facebook_profile_dp != NULL)
                                    <img src={{$lv_detail[0]->facebook_profile_dp}}>&nbsp;&nbsp;
                                    @else
                                    <img src="<?php echo url('images/profile.png');?>">&nbsp;&nbsp;
                                    @endif
                                    
                                    
                                    {{$lv_detail[0]->name}}
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 lv_post_time">
                                    
                                    
                                    
                                @php    
                                 $str='';                              
                                $datetime1 = new DateTime($lv_detail[0]->created_at);
                                $datetime2 = new DateTime();
                                $interval = $datetime1->diff($datetime2);
                                if($interval->d != 0)
                                {
                                $string = $interval->d > 1 ? " days ago" : " day ago";
                                $str = $interval->d.$string;
                                }
                                elseif($interval->d == 0)
                                {
                                     if($interval->h != 0)
                                     {
                                        $string = $interval->h > 1 ? " hours ago" : " hour ago";
                                        $str = $interval->h .$string;
                                     }
                                     else if($interval->m != 0)
                                     {
                                        $string = $interval->m > 1 ? " minutes ago" : " minute ago";
                                        $str = $interval->m .$string;
                                     }
                                     else
                                     {
                                        $string = $interval->s > 1 ? " seconds ago" : " second ago";
                                        $str = $interval->s .$string;
                                     }
                                }
                                
                                    
                                @endphp    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    {{$str}}
                                </div>
                                <div class="clearfix"></div>
                            </div>
                           <div class="sw_detail_thumb">                            
                            <div class="swap_slider" style="margin:0px 0px;">
                                <div id="carousel-custom" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-outer">
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner">
                                            
                                            @for ($i = 0; $i < count($images); $i++)
                                            
                                            @if ($i==0)
                                            
                                             <div class="item active">
                                                <img src="{{(new \App\Http\Controllers\Helper)->get_lv_image_loc()}}{{$images[$i]}}" alt="">
                                            </div>
                                           
                                            @else
                                            <div class="item">
                                                <img src="{{(new \App\Http\Controllers\Helper)->get_lv_image_loc()}}{{$images[$i]}}" alt="">
                                            </div>
                                             @endif
                                            @endfor
                                            
                                            
                                           
                                        </div>            
                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#carousel-custom" data-slide="prev">
                                            <span class="fa fa-chevron-left"></span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-custom" data-slide="next">
                                            <span class="fa fa-chevron-right"></span>
                                        </a>
                                    </div>                            
                                    <!-- Indicators -->
                                    

                                </div>
                             </div>
                        </div>
                            <div class="lv_post_list_text">
                                 {{$lv_detail[0]->description}}
                            </div>
                            <div class="lv_post_list_view_cmts">
                                 View all {{count($comments)}} comments
                            </div>
                            <div id="{{$lv_detail[0]->lv_id}}" class="lv_post_list_cmts_wrap">
                                @foreach($comments as $comment)
                                 <div class="post-comment" id={{$comment->id}} style="display:inline-flex;margin: 10px auto;">
                                     
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

                             <input onkeypress="return savecomment(event,{{$lv_id}})" id="cmt_{{$lv_detail[0]->lv_id}}" style="width:570px !important" type="text" placeholder="Post a comment" class="form-control"></div>
                            @endif
                            <div class="lv_post_list_btm">
                                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 lv_post_like">
                                    <i class="fa fa-heart"></i>&nbsp;&nbsp;{{$likes_count}}
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 lv_post_cmt">
                                    <i class="fa fa-comment-o" aria-hidden="true"></i>&nbsp;&nbsp;{{$comments_count}}
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 lv_post_share">
                                    <i class="fa fa-share" aria-hidden="true"></i>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 pull-right lv_post_morebtns">                                    
                                    <div class="dropdown">
                                      <button class="btn" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                                      <ul class="dropdown-menu">
                                        <li><a href="#">Report</a></li>              
                                      </ul>
                                    </div>

                                </div>
                                 <div class="clearfix"></div>
                            </div>
                             <div class="clearfix"></div>
                        </div>
                        
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="lv_suggestions_wrap">
                            <h4>SUGGESTIONS FOR YOU</h4>
                            <ul class="suggestion_ul">
                                <li>
                                   <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                       <img class="sugg_pic" src="<?php echo url('images/profile.png');?>">
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                      <p class="sugg_name">Dre parker</p>
                                      <p class="sugg_place">Bangalore</p>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                      <button class="btn btn_send_req"><i class="fa fa-user-plus" aria-hidden="true"></i></button>
                                   </div>
                                   <div class="clearfix"></div>
                                </li>
                                <li>
                                   <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                       <img class="sugg_pic" src="<?php echo url('images/profile.png');?>">
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                      <p class="sugg_name">Dre parker</p>
                                      <p class="sugg_place">Bangalore</p>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                      <button class="btn btn_send_req"><i class="fa fa-user-plus" aria-hidden="true"></i></button>
                                   </div>
                                   <div class="clearfix"></div>
                                </li>
                                <li>
                                   <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                       <img class="sugg_pic" src="<?php echo url('images/profile.png');?>">
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                      <p class="sugg_name">Dre parker</p>
                                      <p class="sugg_place">Bangalore</p>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                      <button class="btn btn_send_req"><i class="fa fa-user-plus" aria-hidden="true"></i></button>
                                   </div>
                                   <div class="clearfix"></div>
                                </li>
                                <li>
                                    <a href="">SEE ALL</a>
                                </li>
                            </ul>
                        </div>

                        <div class="lv_right_ad_wrap">
                            
                        </div>

                        <div class="lv_right_ad_wrap">
                            
                        </div>

                    </div>
                    <div class="clearfix"></div>
                </div>


    </div>
</div>










@endsection