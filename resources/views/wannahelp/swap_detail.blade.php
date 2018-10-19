@extends('layouts.app')
@section('seo-meta')
@php
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
@endphp

<title>{{$swap_detail[0]->title}} - Swapnear.com</title>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="keyword" content="Wannahelp, SwapNear, addValue,selling, buying, discussing, news, shopping, help, blog">    
<meta name="description" content="Wannahelp, SwapNear and addValue offers free local classified ads,news and your needs in India. SwapNear is the best and next generation of free online classifieds, ads,news and your needs in India. SwapNear provides a simple solution to the complications involved in selling, buying, discussing, news, shopping, help, blog near you."/>
<link rel="canonical" href="{{ $actual_link }}"/>
<meta property="og:locale" content="as-IN" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{$swap_detail[0]->title}}" />
<meta property="og:description" content="{{$swap_detail[0]->title}},Wannahelp, SwapNear and addValue offers free local classified ads,news and your needs in India. SwapNear is the best and next generation of free online classifieds, ads,news and your needs in India. SwapNear provides a simple solution to the complications involved in selling, buying, discussing, news, shopping, help, blog near you." />
<meta property="og:url" content="{{ $actual_link }}" />
<meta property="og:site_name" content="{{ $actual_link }}" />
<meta property="article:publisher" content="https://www.facebook.com/wannahelp" />
<meta property="article:tag" content="Wannahelp" />
<meta property="article:tag" content="SwapNear" />
<meta property="article:tag" content="addValue" />
<meta property="article:tag" content="selling" />
<meta property="article:tag" content="buying" />
<meta property="article:tag" content="discussing" />
<meta property="article:tag" content="news" />
<meta property="article:tag" content="shopping" />
<meta property="article:tag" content="help" />
<meta property="article:tag" content="blog" />
<meta property="article:section" content="Swapnear" />
<meta property="article:published_time" content="2018-01-08T20:55:39+00:00" />

 @for ($i = 0; $i < count($images); $i++)
                                            
                                            @if ($i==0)
                                                <meta property="og:image" content="{{(new \App\Http\Controllers\Helper)->get_swap_image_loc()}}{{$images[$i]}}" />
                                            @else
                                                <meta property="og:image" content="{{(new \App\Http\Controllers\Helper)->get_swap_image_loc()}}{{$images[$i]}}" />
                                             @endif
                                            @endfor




 @for ($i = 0; $i < count($images); $i++)
                                            
                                            @if ($i==0)
    
                                                <meta property="og:image:secure_url" content="{{(new \App\Http\Controllers\Helper)->get_swap_image_loc()}}{{$images[$i]}}" />
                                            @else

                                                <meta property="og:image:secure_url" content="{{(new \App\Http\Controllers\Helper)->get_swap_image_loc()}}{{$images[$i]}}" />
                                             @endif
                                            @endfor



<meta property="og:image:width" content="850" />
<meta property="og:image:height" content="540" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:description" content="{{$swap_detail[0]->title}},Wannahelp, SwapNear and addValue offers free local classified ads,news and your needs in India. SwapNear is the best and next generation of free online classifieds, ads,news and your needs in India. SwapNear provides a simple solution to the complications involved in selling, buying, discussing, news, shopping, help, blog near you." />
<meta name="twitter:title" content="{{$swap_detail[0]->title}}" />
<meta name="twitter:site" content="{{ $actual_link }}" />
 @for ($i = 0; $i < count($images); $i++)
                                            
                                            @if ($i==0)
    
                                                <meta name="twitter:image" content="{{(new \App\Http\Controllers\Helper)->get_swap_image_loc()}}{{$images[$i]}}" />
                                            @else

                                                <meta name="twitter:image" content="{{(new \App\Http\Controllers\Helper)->get_swap_image_loc()}}{{$images[$i]}}" />
                                                
                                             @endif
                                            @endfor

<meta name="twitter:creator" content="@Swapnear" />
@endsection
@section('content')
<div class="container page_content_wrap">  
        
    <div class="page_data_wrap">
                <br><br>
                <b><a href="{{(new \App\Http\Controllers\Helper)->get_url()}}"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Back</a></b>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_right_0 padding_left_0">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

                    <div class="sw_detail_wrap">
                        <div class="sw_detail_top">                            
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 sw_detail_title">
                                {{$swap_detail[0]->title}}<br>
                                <span><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;&nbsp;10 hrs ago</span>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 sw_detail_location">
                                <p><i class="fa fa-map-marker"></i>&nbsp;&nbsp;{{$swap_detail[0]->distance}} km away</p>
                                <p>{{$swap_detail[0]->location}}</p>
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
                                                <center><img style="width:auto;" src="{{(new \App\Http\Controllers\Helper)->get_swap_image_loc()}}{{$images[$i]}}" alt=""></center>
                                            </div>
                                           
                                            @else
                                            <div class="item">
                                                <center><img style="width:auto;" src="{{(new \App\Http\Controllers\Helper)->get_swap_image_loc()}}{{$images[$i]}}" alt=""></center>
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
                                    <div style="height:100px;">
                                        <ol class="carousel-indicators mCustomScrollbar" style="border:#b5b9b7 solid 1px;">              
                                             @for ($i = 0; $i < count($images); $i++)
                                        
                                            <li data-target="#carousel-custom" data-slide-to="{{$i}}" class="active">
                                                <img src="{{(new \App\Http\Controllers\Helper)->get_swap_image_loc()}}{{$images[$i]}}" alt="">
                                            </li>    
                                            
                                            @endfor
                                            
                                        </ol>
                                    </div>

                                </div>
                             </div>
                        </div>

                        <div class="sw_detail_info">
                             <!--<table class="table table-bordered">
                                 <thead>
                                     <tr>
                                         <th>Brand</th>
                                         <th>Modal</th>
                                         <th>Year</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <td>Bajaj</td>
                                         <td>Pulsar</td>
                                         <td>2010</td>
                                     </tr>
                                 </tbody>
                             </table> -->

                             <div class="sw_detail_desc">
                                {{$swap_detail[0]->description}}

                            </div>

                            <p class="sw_total_views"><i class="fa fa-eye"></i>&nbsp;&nbsp;2000 views</p>
                        </div>
                         <div class="clearfix"></div>
                    </div>
                     
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="sw_detail_price">
                       
                        @if($swap_detail[0]->for_price != "" && $swap_detail[0]->for_goods != "") 
                            <i class="fa fa-inr" aria-hidden="true"></i>&nbsp; {{$swap_detail[0]->for_price}} or {{$swap_detail[0]->for_goods}}
                       @elseif($swap_detail[0]->for_price == "" && $swap_detail[0]->for_goods != "")
                            {{$swap_detail[0]->for_goods}}
                        @elseif($swap_detail[0]->for_price != "" && $swap_detail[0]->for_goods == "")
                            <i class="fa fa-inr" aria-hidden="true"></i>&nbsp; {{$swap_detail[0]->for_price}}
                        @elseif($swap_detail[0]->for_any == 1)
                            Open for Anything
                        @elseif($swap_detail[0]->for_free == 1)
                            <i class="fa fa-inr" aria-hidden="true"></i>&nbsp;For Free    
                        @endif 
                        
                                                
                      
                    </div>
                    <div class="sw_detail_user_wrap">                        
                        <div class="sw_detail_name">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-sm-3">
                                @if($swap_detail[0]->is_online == 1)
                                 <span class="online_indiacator"><i class="fa fa-circle" aria-hidden="true"></i></span>
                                 @endif
                                
                                 @if($swap_detail[0]->dp_changed == 1)
                                    <img src={{$swap_detail[0]->profile_pic}}>&nbsp;&nbsp;
                                    @elseif($swap_detail[0]->google_profile_dp != NULL)
                                    <img src={{$swap_detail[0]->google_profile_dp}}>&nbsp;&nbsp;
                                    @elseif($swap_detail[0]->facebook_profile_dp != NULL)
                                    <img src={{$swap_detail[0]->facebook_profile_dp}}>&nbsp;&nbsp;
                                    @else
                                    <img src="<?php echo url('images/profile.png');?>">&nbsp;&nbsp;
                                    @endif
                                
                                 
                              
                                
                                
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-sm-9">
                                {{$swap_detail[0]->name}}
                            </div>
                            <div class="clearfix"></div>
                        </div> 
                        
                        <center style="padding-top:  5px;padding-bottom: 10px;"><span style="color: lightseagreen;font-size:12px;">(Active since {{$swap_detail[0]->since}})</span></center>
                        <center><a href="{{(new \App\Http\Controllers\Helper)->get_url()}}\user\{{$swap_detail[0]->user_id}}"> <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;View Profile</a></center>
                       <!-- <div class="profile_verfied">  
                        @if($swap_detail[0]->email_verify == 1)
                            <i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;Profile verified
                        @else
                            <i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;Profile not verified
                        
                        @endif
                        </div> -->
                    </div>
                    @if(Auth::user())
                    <div class="chat_btn_wrap">
                           <button onclick="open_chat1({{$temp_id}},2)" class="btn btn-primary">CHAT</button>
                    </div>                   
                    @else
                    <div class="chat_btn_wrap">
                           <button onclick="show_login_form()" class="btn btn-primary">CHAT</button>
                    </div>
                    @endif
                    <div class="lv_right_ad_wrap">
                        
                    </div>

                    <div class="lv_right_ad_wrap">
                        
                    </div>

                </div>
                <div class="clearfix"></div>
            </div>




            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="sw_detail_other_prod">                     
                        <div class="well well-sm">
                            <strong>You may like</strong>
                            
                        </div>
                        <div id="products" class="products row list-group">
                            @foreach($sugg_swaps as $sugg_swap)
                            <div class="item col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="thumbnail">
                                    
                                    <img style="height: 150px;" src="{{$sugg_swap->image}}" alt="">
                                    
                                    <div class="caption">
                                        <h4 class="group inner list-group-item-heading">
                                            <a href="{{(new \App\Http\Controllers\Helper)->get_url()}}\swap\{{$sugg_swap->temp_title}}-{{$sugg_swap->swap_id}}" class="profile-link">
                                                {{$sugg_swap->title}}
                                            </a>    
                                        </h4>
                                        <p class="group inner list-group-item-text">
                                            {{$sugg_swap->short_desc}}
                                          </p>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12">
                                               <span style="font-size: 12px;font-weight: 600;">
                                                    @if($sugg_swap->for_price != "" && $sugg_swap->for_goods != "") 
                                                   <i class="fa fa-inr" aria-hidden="true"></i>&nbsp;Rs. {{$sugg_swap->for_price}} or {{$sugg_swap->for_goods}}
                                                   @elseif($sugg_swap->for_price == "" && $sugg_swap->for_goods != "")
                                                   {{$sugg_swap->for_goods}}
                                                    @elseif($sugg_swap->for_price != "" && $sugg_swap->for_goods == "")
                                                    <i class="fa fa-inr" aria-hidden="true"></i>&nbsp;Rs. {{$sugg_swap->for_price}}
                                                    @endif
                                               </span>
                                            </div>                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                            
                        </div>
                    </div> 
                 </div>
            



        </div>
    </div>









<script>
var url_last_param = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
if(url_last_param==1)
{
    
    var URI = window.location.href,
    parts = URI.split('/'),
    lastPart = parts.pop() == '' ? parts[parts.length - 1] : parts.pop();
    
    
    
   
    //alert(lastPart);
    
    open_chat_latest(1824510364648,2,'TA1824302012224FN');









   
}


 function open_chat_latest(id,type,sender_id) {
    $.ajax({
             headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            url: window.location.origin +"/whapi/open_chat_latest",
            //type: 'POST',
            data: 
            {
                type_id: id,
                type: type,
                sender_id:sender_id,
            },
            success: function (result) {
                    $( ".chat-window" ).remove();
              // var clone = $("#chat-container").append(result);
                      //alert(result);
                      
                   //  $("#chat-container").append(result);
                     
                      
                      var size = $( ".chat-container:last-child" ).css("right");
                      size_total = parseInt(size) + 400;
                    //  var clone = $("#chat-container").append(result);
                     //var clone = $( ".chat-window" ).clone().appendTo( "#chat-container" );
                     var clone = $("#chat-container").append(result);
                      clone.css("right", size_total);
                      //  $(".container1").empty();
                        //$(result).appendTo('#chat-container');
                         var messageBody = document.querySelector('#msg-wgt-body');
                      messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                   
            },
            
        });
       return false; 
    
    }
   
</script> 
@endsection




     
 




