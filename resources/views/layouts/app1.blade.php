<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Swap Near') }}</title>   
    <link rel="icon" href="{{ asset('public/images/swapnear_icon-01.png') }}" type="image/x-icon">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/flags.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/dd.css') }}" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('public/css/toastr.css') }}" rel="stylesheet"> 
	 <link rel="stylesheet" type="text/css" href="{{ asset('public/css/semantic.css') }}">
<!--<link href="{{ asset('public/css/jquery.typeahead.css') }}" rel="stylesheet">-->
	<link href="{{ asset('public/css/fileinput.min.css') }}" rel="stylesheet">
	
	

    <script src="{{asset('public/js/jquery.min.js')}}"></script>  
    <script src="{{asset('public/js/jquery.cookie.js')}}"></script>  
    <script src="{{asset('public/js/jquery.typeahead.js')}}"></script>  
    <script src="{{asset('public/js/newWaterfall.js')}}"></script> 
    <script src="{{asset('public/js/fileinput.min.js')}}"></script> 
    <script src="{{asset('public/js/theme.min.js')}}"></script> 
    <script src="{{asset('public/js/toastr.js')}}"></script> 
    
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7ymkb4fhvYTI-xSzbPfF9vPDnfrj86tY&libraries=places"></script>
    
    <script src="{{asset('public/js/myapp.js')}}"></script> 

<meta name="keyword" content=" Wannahelp, SwapNear, addValue,selling, buying, discussing, news, shopping, help, blog">    
<meta name="description" content="Wannahelp, SwapNear and addValue offers free local classified ads,news and your needs in India. SwapNear is the best and next generation of free online classifieds, ads,news and your needs in India. SwapNear provides a simple solution to the complications involved in selling, buying, discussing, news, shopping, help, blog near you."/>
<link rel="canonical" href="http://wannahelp.com/whapi/"/>
<meta property="og:locale" content="as-IN" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{$swap_detail[0]->title}}" />
<meta property="og:description" content="Wannahelp, SwapNear and addValue offers free local classified ads,news and your needs in India. SwapNear is the best and next generation of free online classifieds, ads,news and your needs in India. SwapNear provides a simple solution to the complications involved in selling, buying, discussing, news, shopping, help, blog near you." />
<meta property="og:url" content="http://wannahelp.com/whapi/" />
<meta property="og:site_name" content="wannahelp.com/whapi/" />
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
<meta name="twitter:description" content="Wannahelp, SwapNear and addValue offers free local classified ads,news and your needs in India. SwapNear is the best and next generation of free online classifieds, ads,news and your needs in India. SwapNear provides a simple solution to the complications involved in selling, buying, discussing, news, shopping, help, blog near you." />
<meta name="twitter:title" content="{{$swap_detail[0]->title}}" />
<meta name="twitter:site" content="wannahelp.com/whapi/" />
 @for ($i = 0; $i < count($images); $i++)
                                            
                                            @if ($i==0)
    
                                                <meta name="twitter:image" content="{{(new \App\Http\Controllers\Helper)->get_swap_image_loc()}}{{$images[$i]}}" />
                                            @else

                                                <meta name="twitter:image" content="{{(new \App\Http\Controllers\Helper)->get_swap_image_loc()}}{{$images[$i]}}" />
                                                
                                             @endif
                                            @endfor

<meta name="twitter:creator" content="@Swapnear" />





   
   
	
   
    <!--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<style>



.chat_send
{
 position:absolute;
 opacity:0.7;
 bottom:18px;
 right:14px;
}

.chatMsg { 
    outline: none !important;
    border-color: #719ECE;
    box-shadow: 0 0 10px #719ECE;
}

.inputGroup {
    background-color: #fff;
    display: block;
    margin: 10px 0;
    position: relative;

    label {
      padding: 12px 30px;
      width: 100%;
      display: block;
      text-align: left;
      color: #3C454C;
      cursor: pointer;
      position: relative;
      z-index: 2;
      transition: color 200ms ease-in;
      overflow: hidden;

      &:before {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        content: '';
        background-color: #5562eb;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%) scale3d(1, 1, 1);
        transition: all 300ms cubic-bezier(0.4, 0.0, 0.2, 1);
        opacity: 0;
        z-index: -1;
      }

      &:after {
        width: 32px;
        height: 32px;
        content: '';
        border: 2px solid #D1D7DC;
        background-color: #fff;
        background-image: url("data:image/svg+xml,%3Csvg width='32' height='32' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.414 11L4 12.414l5.414 5.414L20.828 6.414 19.414 5l-10 10z' fill='%23fff' fill-rule='nonzero'/%3E%3C/svg%3E ");
        background-repeat: no-repeat;
        background-position: 2px 3px;
        border-radius: 50%;
        z-index: 2;
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        transition: all 200ms ease-in;
      }
    }

    input:checked ~ label {
      color: #fff;

      &:before {
        transform: translate(-50%, -50%) scale3d(56, 56, 1);
        opacity: 1;
      }

      &:after {
        background-color: #54E0C7;
        border-color: #54E0C7;
      }
    }

    input {
      width: 32px;
      height: 32px;
      order: 1;
      z-index: 2;
      position: absolute;
      right: 30px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      visibility: hidden;
    }
  }




.container1 {
  bottom: 0px;
  right: 20px;
  width: 250px;
  position: fixed;
  z-index: 300;
  margin-left: 80%;
  border-top-right-radius: 3px;
  border-top-left-radius: 3px;
  font-family: 'tahoma';
  font-size: 12px;
}

/* message box header styles*/

.msg-wgt-header {
  background-color: #6D84B4;
  border: 1px solid rgba(0, 39, 121, 0.76);
  color: white;
  text-align: center;
  height: 28px;
}

.msg-wgt-header a {
  text-decoration: none;
  font-weight: bold;
  color: white;
  vertical-align: middle;
}

/* message box body styles*/

.msg-wgt-body {
  height: 270px;
  overflow-y: scroll;
}

.msg-wgt-body table {
  width: 100%;
}

.msg-row-container {
  border-bottom: 1px solid lightgray;
}

.msg-row-container td {
  border-bottom: 1px solid lightgray;
  padding: 3px 0 3px 2px;
}

.msg-row {
  width: 100%;
}

.message {
  margin-left: 40px;
}

/* Message box footer styles*/

.msg-wgt-footer {
  height: 50px;
}

.msg-wgt-footer textarea {
  width: 95%;
  font-family: 'tahoma';
  font-size: 13px;
  padding: 5px;
}

.user-label {
  font-size: 11px;
}

.msg-time {
  font-size: 10px;
  float: right;
  color: gray;
}

.avatar {
  width: 30px;
  height: 30px;
  float: left;
  background: url("/images/chat_avatar.png");
  border: 1px solid lightgray;
}

#searchclear {
    position: absolute;
    right: 30px;
    top: 64px;
    margin: auto;
    font-size: 14px;
    cursor: pointer;
    color: #636b6f;
}

#searchenter {
    position: absolute;
    right: 60px;
    top: 61px;
    margin: auto;
    font-size: 14px;
    cursor: pointer;
    color: #636b6f;
    font-weight: 600;
}

.numberCircle {
  border-radius: 50%;
  behavior: url(PIE.htc);
  /* remove if you don't care about IE8 */
  color: #3097D1;    
  padding: 4px;
  background: #fff;
  border: 2px solid #3097D1;
  
  text-align: center;
  font: 12px Arial, sans-serif;
}

.panel{
    margin-bottom: 0px;
}
.chat-window{
    bottom:0;
    position:fixed;
    float:right;
    margin-left:10px;
}
.chat-window > div > .panel{
    border-radius: 5px 5px 0 0;
}
.icon_minim{
    padding:2px 10px;
}
.msg_container_base{
  background: #e5e5e5;
  margin: 0;
  padding: 0 10px 10px;
  max-height:300px;
  overflow-x:hidden;
}
.top-bar {
  background: #666;
  color: white;
  padding: 10px;
  position: relative;
  overflow: hidden;
}
.msg_receive{
    padding-left:0;
    margin-left:0;
}
.msg_sent{
    padding-bottom:20px !important;
    margin-right:0;
}
.messages {
  background: white;
  padding: 10px;
  border-radius: 2px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
  max-width:100%;
}
.messages > p {
    font-size: 13px;
    margin: 0 0 0.2rem 0;
  }
.messages > time {
    font-size: 11px;
    color: #ccc;
}
.msg_container {
    padding: 10px;
    overflow: hidden;
    display: flex;
}


.wrapper > ul#results li {
  margin-bottom: 1px;
  background: #f9f9f9;
  padding: 20px;
  list-style: none;
}



.post_comment:hover .remove_icon {
  visibility: visible;
  opacity: 1;
}

.noti-box {
   
    width: 670px;
    border: 1px;
    border-style: inset;
    padding: 15px;
    margin: 25px;
    margin-top: 3px;
    border-color: #3cc0c7;
}

.ajax-loading-bc, .ajax-loading-sw, .ajax-loading-lv {
  text-align: center;
}

.tooltip {
    background-color:#000;
    border:1px solid #fff;
    padding:10px 15px;
    width:200px;
    display:none;
    color:#fff;
    text-align:left;
    font-size:12px;
 
    /* outline radius for mozilla/firefox only */
    -moz-box-shadow:0 0 10px #000;
    -webkit-box-shadow:0 0 10px #000;
}

.loginBtn {
  box-sizing: border-box;
  position: relative;
  /* width: 13em;  - apply for fixed size */
  margin: 0.2em;
  padding: 0 15px 0 46px;
  border: none;
  text-align: left;
  line-height: 34px;
  white-space: nowrap;
  border-radius: 0.2em;
  font-size: 16px;
  color: #FFF;
}
.loginBtn:before {
  content: "";
  box-sizing: border-box;
  position: absolute;
  top: 0;
  left: 0;
  width: 34px;
  height: 100%;
}



.loginBtn:focus {
  outline: none;
}
.loginBtn:active {
  box-shadow: inset 0 0 0 32px rgba(0,0,0,0.1);
}


/* Facebook */
.loginBtn--facebook {
  background-color: #4C69BA;
  background-image: linear-gradient(#4C69BA, #3B55A0);
  /*font-family: "Helvetica neue", Helvetica Neue, Helvetica, Arial, sans-serif;*/
  text-shadow: 0 -1px 0 #354C8C;
}
.loginBtn--facebook:before {
  border-right: #364e92 1px solid;
  background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_facebook.png') 6px 6px no-repeat;
}
.loginBtn--facebook:hover,
.loginBtn--facebook:focus {
  background-color: #5B7BD5;
  background-image: linear-gradient(#5B7BD5, #4864B1);
}


/* Google */
.loginBtn--google {
  /*font-family: "Roboto", Roboto, arial, sans-serif;*/
  background: #DD4B39;
}
.loginBtn--google:before {
  border-right: #BB3F30 1px solid;
  background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_google.png') 6px 6px no-repeat;
}
.loginBtn--google:hover,
.loginBtn--google:focus {
  background: #E74B37;
}
.tabs-left, .tabs-right {
  border-bottom: none;
  padding-top: 2px;
}
.tabs-left {
  border-right: 1px solid #ddd;
}
.tabs-right {
  border-left: 1px solid #ddd;
}
.tabs-left>li, .tabs-right>li {
  float: none;
  margin-bottom: 2px;
}
.tabs-left>li {
  margin-right: -1px;
}
.tabs-right>li {
  margin-left: -1px;
}
.tabs-left>li.active>a,
.tabs-left>li.active>a:hover,
.tabs-left>li.active>a:focus {
  border-bottom-color: #ddd;
  border-right-color: transparent;
}

.tabs-right>li.active>a,
.tabs-right>li.active>a:hover,
.tabs-right>li.active>a:focus {
  border-bottom: 1px solid #ddd;
  border-left-color: transparent;
}
.tabs-left>li>a {
  border-radius: 4px 0 0 4px;
  margin-right: 0;
  display:block;
}
.tabs-right>li>a {
  border-radius: 0 4px 4px 0;
  margin-right: 0;
}
.sideways {
  margin-top:50px;
  border: none;
  position: relative;
}
.sideways>li {
  height: 20px;
  width: 120px;
  margin-bottom: 100px;
}
.sideways>li>a {
  border-bottom: 1px solid #ddd;
  border-right-color: transparent;
  text-align: center;
  border-radius: 4px 4px 0px 0px;
}
.sideways>li.active>a,
.sideways>li.active>a:hover,
.sideways>li.active>a:focus {
  border-bottom-color: transparent;
  border-right-color: #ddd;
  border-left-color: #ddd;
}
.sideways.tabs-left {
  left: -50px;
}
.sideways.tabs-right {
  right: -50px;
}
.sideways.tabs-right>li {
  -webkit-transform: rotate(90deg);
  -moz-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  transform: rotate(90deg);
}
.sideways.tabs-left>li {
  -webkit-transform: rotate(-90deg);
  -moz-transform: rotate(-90deg);
  -ms-transform: rotate(-90deg);
  -o-transform: rotate(-90deg);
  transform: rotate(-90deg);
}

#waterfall { margin: 10px; }

#waterfall li {
  left: 0;
  top: 0;
  opacity: 0;
  transform: translateY(100px);
}

#waterfall li.show {
  opacity: 1;
  transform: translateY(0);
  transition: all 0.3s, top 1s;
}

#waterfall li > div {
  color: rgba(0,0,0,0.6);
  font-size: 32px;
  border-radius: 3px;
  margin: 10px;
  padding: 15px;
  background: rgb(255,255,255);
  border: 1px solid rgba(038, 191, 64, 0);
  transition: all 0.5s;
}

#waterfall li > div:hover {
  transform: translateY(-10px);
  border: 1px solid rgba(038, 191, 64, 1);
  box-shadow: 0 10px 15px rgba(038, 191, 64, 0.1);
  transition: all 0.3s;
}

.tick{
border:2px solid #3097D1;
  
  border-radius: 30px;
}


.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.cont:hover .image {
  opacity: 0.3;
}

.cont:hover .middle {
  opacity: 1;
}

.text {
  /*background-color: #4CAF50;*/
  color: white;
  font-size: 12px;
  margin-left:-7px;
  margin-bottom:30px;
   /* padding: 0px 7px;*/
}

@media only screen and (max-width: 600px)  {
    
#msg-wgt-body
{
    
   max-height: 240px !important;
    min-height: 100px !important;
}


    
}


.timeline-cover:hover{
    

    
}
.navbar-brand {
    float:left;
    width:100%;
    margin:0;
    padding: 16px 10px;
}

.city-btn{
    margin: 18px 0 0 20px;
    background-color: #000;
    border: none;
    color: #fff;
}
.city-btn:hover{
    color:#ccc;
}
}

.city-ul{
    float:left;
    width:100%;
}
.city-li{
    float:left;
    list-style:none;
}
.city-link{
    padding:10px;
}
.popup-content{
        padding: 4px 11px;
}
.pop-search{
    padding: 20px 0 0 0;
}
.pop-city{
    padding: 0 0 20px 0;
}
.pac-container
      {
        z-index: 1051 !important;
      }
.custom-search
{
   background: #1b1c1d !important;
    border: 1px solid #767676b3 !important;
    box-shadow: none !important;
    border-radius: 4px !important;
    color: #dadada !important;
    width: 55% !important;
    height: 28px !important;
    margin-top: 15px !important; 
}
/*header search section fix*/
.search_city_textbox{
position:relative !important; border-radius: 10px !important;border: 1px solid #999 !important;padding: 0px 0px 0px 22px !important;height: 21px !important;color: #d3d3d3 !important;margin-top: 18px !important;background-color:#323232 !important;
font-size:11px; outline:none;}
.location_icon{position: absolute;top: 17px;color: #d3d3d3; z-index:111111;
 }
.search_city_textbox::-webkit-input-placeholder {color: #d3d3d3;}
.search_city_distance{border-radius: 10px !important;border: 1px solid #999 !important;padding: 0px 0 0 5px !important;height: 21px !important;color: #d3d3d3 !important;margin:18px 0px 0 2px !important;background-color:#323232 !important;
font-size:11px; outline:none;}
.city_search_button{
    padding: 1px 9px 0 9px !important;
    color:#d3d3d3;
    font-size:11px;
    background-color:#323232 !important;
    border-radius: 10px !important;
    border: 1px solid #999 !important;
    outline:none;
    margin:18px 0px 0 2px;
    height: 21px !important;
    padding:0 0 0 5px;
}
.search_city_section{
    padding:0 15px;
}
/*.create_post_toggle{*/
/*    padding: 8px 30px;background: #fff;outline: none;border-top: 1px solid #ccc;*/
/*    border-right: 1px solid #ccc;*/
/*    border-left: 1px solid #ccc;*/
/*    border-bottom: 1px solid #ccc;*/
/*}*/
/*.create_post_toggle:hover{*/
/*    padding: 8px 30px;background: #fff;outline: none;border-top: 1px solid #ccc;*/
/*    border-right: 1px solid #ccc;*/
/*    border-left: 1px solid #ccc;*/
/*    border-bottom: 2px solid #3cc0c7;*/
/*    color:#3cc0c7;*/
/*}*/
/* The container */
/*.container123 {*/
/*    display: block !important;*/
/*    position: relative !important;*/
/*    padding-left: 35px !important;*/
/*    margin-bottom: 12px !important;*/
/*    cursor: pointer !important;*/
/*    font-size: 22px !important;*/
/*    -webkit-user-select: none !important;*/
/*    -moz-user-select: none !important;*/
/*    -ms-user-select: none !important;*/
/*    user-select: none !important;*/
/*}*/

/* Hide the browser's default radio button */
/*.container123 .radio_css {*/
/*    position: absolute !important;*/
/*    opacity: 0 !important;*/
/*    cursor: pointer !important;*/
/*}*/

/* Create a custom radio button */
/*.checkmark {*/
/*    position: absolute !important;*/
/*    top: 0 !important;*/
/*    left: 0 !important;*/
/*    height: 25px !important;*/
/*    width: 25px !important;*/
/*    background-color: #eee !important;*/
/*    border-radius: 50% !important;*/
/*}*/

/* On mouse-over, add a grey background color */
/*.container123:hover .radio_css ~ .checkmark {*/
/*    background-color: #ccc !important;*/
/*}*/

/* When the radio button is checked, add a blue background */
/*.container123 .radio_css:checked ~ .checkmark {*/
/*    background-color: #2196F3 !important;*/
/*}*/

/* Create the indicator (the dot/circle - hidden when not checked) */
/*.checkmark:after {*/
/*    content: "" !important;*/
/*    position: absolute !important;*/
/*    display: none !important;*/
/*}*/

/* Show the indicator (dot/circle) when checked */
/*.container .radio_css:checked ~ .checkmark:after {*/
/*    display: block !important;*/
/*}*/

/* Style the indicator (dot/circle) */
/*.container123 .checkmark:after {*/
/* 	top: 9px !important;*/
/*	left: 9px !important;*/
/*	width: 8px !important;*/
/*	height: 8px !important;*/
/*	border-radius: 50% !important;*/
/*	background: white !important;*/
/*}*/
.inline{
  display: inline-block;
}
.inline + .inline{
  margin-left: 10px;
}
.radio{
  color:#3cc0c7;
  font-size:15px;
  position:relative;
}
.radio span{
    position: relative;
    padding-left: 40px;
    padding-top: 10px;
    padding-right: 12px;
    padding-bottom: 10px;
    border-radius: 35px;
    border: 1px solid #3cc0c7;
}
.radio span:after{
  content: '';
  width: 20px;
  height: 20px;
  border: 1px solid;
  position: absolute;
  left: 10px;
  top: 9px;
  border-radius:100%;
  -ms-border-radius:100%;
  -moz-border-radius:100%;
  -webkit-border-radius:100%;
  box-sizing:border-box;
  -ms-box-sizing:border-box;
  -moz-box-sizing:border-box;
  -webkit-box-sizing:border-box;
}
.radio input[type="radio"]{
   cursor: pointer; 
  position:absolute;
  width:100%;
  height:100%;
  z-index: 1;
  opacity: 0;
  filter: alpha(opacity=0);
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"
}
.radio input[type="radio"]:checked + span{
    background:#3cc0c7;
    color: #fff;
    border-radius: 35px; 
}
.radio input[type="radio"]:checked + span:before{
  content: '';
  width: 10px;
  height: 10px;
  position: absolute;
  background: #fff;
  left: 15px;
  top: 14px;
  border-radius:100%;
  -ms-border-radius:100%;
  -moz-border-radius:100%;
  -webkit-border-radius:100%;
}
::-webkit-file-upload-button {
  background:#3cc0c7;
  color:#fff;
  padding:8px;
  border:none;
  border-radius:35px;
  outline:none;
}
::-ms-browse {
  background:#3cc0c7;
  color:#fff;
  padding:8px;
  border:none;
  border-radius:35px;
  outline:none;
}
</style>
</head>
<body>    
<div id="app">
   
    <div id="top_location_selector" style="z-index:1">
        <a id="close_location_selector"><i class="fa fa-close"></i></a>
        <div class="top_location_selector_content">
            <br/>
             <br><br>
            <div class="search_by_location_wrap">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align:center;padding-top:10px;">
                   
                    <label>Select or type city</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <input id="pac-input-tp111" onkeypress="return change_location(event)" type="text" class="form-control search_query" placeholder="Select your city" />
                     <span id="searchenter">Submit</span>
                    <span id="searchclear" class="fa fa-times-circle"></span>
                </div>  
                <div class="clearfix"></div>                 
            </div><br/>
           <!-- <div class="search_by_pre_location_wrap">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                        <div class="pre_loc_items" onclick="getlocation('Bangalore')">
                            <div><img src="http://wannahelp.com/whapi/public/images/cities/Bangalore.png" alt="Bangalore" style="width: 142px;"></div>
                            <div onclick="getlocation('Bangalore')" class="pre_loc_name">
                                
                                Bangalore
                            </div>
                            <div class="clearfix"></div> 
                        </div>
                        <div class="clearfix"></div> 
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                        <div class="pre_loc_items" onclick="getlocation('Chennai')">
                            <div><img src="http://wannahelp.com/whapi/public/images/cities/Chennai.png" alt="Chennai" style="width: 142px;"></div>
                            <div onclick="getlocation('Chennai')" class="pre_loc_name">
                                    Chennai
                            </div>
                            <div class="clearfix"></div> 
                        </div>
                        <div class="clearfix"></div> 
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                        <div class="pre_loc_items" onclick="getlocation('Mumbai')">
                            <div><img src="http://wannahelp.com/whapi/public/images/cities/Mumbai.png" alt="Mumbai" style="width: 142px;"></div>
                            <div class="pre_loc_name">
                                Mumbai
                            </div>
                            <div class="clearfix"></div> 
                        </div>
                        <div class="clearfix"></div> 
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                        <div class="pre_loc_items" onclick="getlocation('Delhi')">
                            <div><img src="http://wannahelp.com/whapi/public/images/cities/Delhi.png" alt="Delhi" style="width: 142px;"></div>
                            <div class="pre_loc_name">
                                Delhi
                            </div>
                            <div class="clearfix"></div> 
                        </div>
                        <div class="clearfix"></div> 
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                        <div class="pre_loc_items" onclick="getlocation('Hyderabad')">
                            <div><img src="http://wannahelp.com/whapi/public/images/cities/Hyderabad.png" alt="Hyderabad" style="width: 142px;"></div>
                            <div class="pre_loc_name">
                                Hyderabad
                            </div>
                            <div class="clearfix"></div> 
                        </div>
                        <div class="clearfix"></div> 
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                        <div class="pre_loc_items" onclick="getlocation('Jaipur')">
                            <div><img src="http://wannahelp.com/whapi/public/images/cities/Jaipur.png" alt="Hyderabad" style="width: 142px;"></div>
                            <div class="pre_loc_name">
                                Jaipur
                            </div>
                            <div class="clearfix"></div> 
                        </div>
                        <div class="clearfix"></div> 
                    </div>
                    <div class="clearfix"></div> 
                </div>
                                     
            </div> -->
        </div>
        <div class="top_location_selector_bottom">
            Select City&nbsp;&nbsp;<i class="fa fa-chevron-up" aria-hidden="true"></i>
        </div>
    </div>
    
                <nav class="navbar navbar-default navbar-static-top top_black_header">
                  <div class="container">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                      </button>
                      <a class="navbar-brand" href="{{(new \App\Http\Controllers\Helper)->get_url()}}" style="width: 160px;"><img style="width: 100%; float: left;" src="{{asset('public/images/swapnear_logo-02.png')}}"></a>
                      <!-- Trigger/Open The Modal -->
                        <!--<input id="pac-input-tp" onkeypress="return change_location(event)" type="text" class="form-control search_query" placeholder="Select your city" style="width: 57% !important;margin-top: 10px;" />-->
                        <span><span class="location_icon">&nbsp;&nbsp;<i class="fa fa-map-marker"></i></span><input id="pac-input-tp" onkeypress="return change_location(event)" type="text" class="search_city_textbox" placeholder="Enter your city" />
                         <select id="search-distance" name="search-distance" class="search_city_distance">
                          <option value="2">Distance</option>
                          <option value="5">Within 5KM</option>
                          <option value="10">Within 10KM</option>
                          <option value="15">Within 15KM</option>
                          <option value="20">Within 20KM</option>
                          <option value="25">Within 25KM</option>
                        </select>
                        <button type="button" id="submit-search" class="city_search_button">Go</button></span>
                        
                        <!-- The Modal -->
                        <div id="myModal" class="modal">
                        
                          <!-- Modal content -->
                          <div class="modal-content popup-content">
                            <span class="close" style="font-size:32px;">&times;</span>
                                <div class="row pop-search"> 
                                    <div class="container">
                                        <form>
                                            <label>Select or type city</label>
                                            
                                            <span id="searchenter">Submit</span>
                                            <span id="searchclear" class="fa fa-times-circle"></span>
                                        </form>
                                    </div>
                                </div>
                                <div class="row pop-city" id="iconsdiv">
                                    <div class="container">
                                        <ul class="city-ul">
                                            <li class="city-li"><a href="#" class="city-link"><img src="http://wannahelp.com/whapi/public/images/cities/Bangalore.png" alt="Bangalore" style="width: 100px; height=100px; padding: 5px 0;"></a><p style="text-align:center;">bangalore</p></li>
                                            <li class="city-li"><a href="#" class="city-link"><img src="http://wannahelp.com/whapi/public/images/cities/Chennai.png" alt="Chennai" style="width: 100px; height=100px; padding: 5px 0;"></a><p style="text-align:center;">Chennai</p></li>
                                            <li class="city-li"><a href="#" class="city-link"><img src="http://wannahelp.com/whapi/public/images/cities/Mumbai.png" alt="Mumbai" style="width: 100px; height=100px; padding: 5px 0;"></a><p style="text-align:center;">Mumbai</p></li>
                                            <li class="city-li"><a href="#" class="city-link"><img src="http://wannahelp.com/whapi/public/images/cities/Delhi.png" alt="Delhi" style="width: 100px; height=100px; padding: 5px 0;"></a><p style="text-align:center;">Delhi</p></li>
                                            <li class="city-li"><a href="#" class="city-link"><img src="http://wannahelp.com/whapi/public/images/cities/Chennai.png" alt="Hyderabad" style="width: 100px; height=100px; padding: 5px 0;"></a><p style="text-align:center;">Hyderabad</p></li>
                                            <li class="city-li"><a href="#" class="city-link"><img src="http://wannahelp.com/whapi/public/images/cities/Jaipur.png" alt="Jaipur" style="width: 100px; height=100px; padding: 5px 0;"></a><p style="text-align:center;">Jaipur</p></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                      <ul class="nav navbar-nav navbar-right">
                        <!--<li class="search_city_section"><input id="pac-input-tp" onkeypress="return change_location(event)" type="text" class="search_city_textbox" /><span class="location_icon"><i class="fa fa-map-marker"></i></span>-->
                        <!-- <select id="search-distance" name="search-distance" class="search_city_distance">-->
                        <!--  <option value="2">Distance</option>-->
                        <!--  <option value="5">Within 5KM</option>-->
                        <!--  <option value="10">Within 10KM</option>-->
                        <!--  <option value="15">Within 15KM</option>-->
                        <!--  <option value="20">Within 20KM</option>-->
                        <!--  <option value="25">Within 25KM</option>-->
                        <!--</select>-->
                        <!--<button type="button" id="submit-search" class="city_search_button">Search&nbsp;<i class="fa fa-search"></i></button></li>-->
                        <li style=" padding-right:20px; "><button  style="margin-top: 11px;" onclick="navigate_create_post()"  class="btn btn-primary btn_slider_post_free" >POST FREE</a></button> </li>
                        <li style=""><a class="top_menu" style="margin-top: 3px;color:white;" href="{{(new \App\Http\Controllers\Helper)->get_url()}}" ><span style="font-size: 22px;" class="fa fa-home"></span>&nbsp;</a></li>
                        
                        @if(Auth::user())
                         <li>
                            <a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/notifications" style="margin-top: 3px;color: white;background: #000000;"><span style="font-size: 22px;" class="fa fa-globe"></span>&nbsp;<span id="number_of_notif" style="color:yellow;"></span></a>
                               <ul id="notifications" class="dropdown-menu" style="width: 250px;background: #000000;">
                             <div class="line"></div>       
                               <li><a style="color: white;background: #000000;" href="{{(new \App\Http\Controllers\Helper)->get_url()}}/notifications"><center style="font-size:10px">See All Notifications</center></a></li>  
                              </ul>
                          </li>
                        @endif
                        @if(Auth::user())
                          <li>
                            <a href="#" style="margin-top: 3px;color: white;background: #000000;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" style="font-size: 21px;"></i>, @if(Auth::user()->username!=""){{Auth::user()->username}} @else
                            {{Auth::user()->name}} &nbsp;@endif<span><img src="<?php echo url('public/images/')?>//down-arrow.png" alt="" /></span></a>
                              <ul class="dropdown-menu newsfeed-home" style="background: #000000;">
                                <li><a style="color: white;background: #000000;" href="{{(new \App\Http\Controllers\Helper)->get_url()}}/user/{{Auth::user()->user_id}}"><i class="fa fa-eye"></i>&nbsp; View Profile</a></li>
                                <li><a style="color: white;background: #000000;" href="{{(new \App\Http\Controllers\Helper)->get_url()}}/credits"><i class="fa fa-money"></i>&nbsp; Credits</a></li>
                                <li><a style="color: white;background: #000000;" href="{{(new \App\Http\Controllers\Helper)->get_url()}}/messages"><i class="fa fa-comment-o"></i>&nbsp; Messages</a></li>
                                 <li><a style="color: white;background: #000000;" href="{{(new \App\Http\Controllers\Helper)->get_url()}}/profile"><i class="fas fa-sliders-h"></i>&nbsp; Settings</a></li>
                                <li><a style="color: white;background: #000000;" href="{{(new \App\Http\Controllers\Helper)->get_url()}}/logout"><i class="fas fa-sign-out-alt"></i> &nbsp; Logout</a></li>
                              </ul>
                          </li>
                        @endif
                        
                        
                        <li style="margin-top:3px">
                            @if(Auth::user())
                                
                            @else
                                <a class="my_account_text" data-toggle="modal" onclick="show_login_form()"><span class="fa fa-user"></span>&nbsp;Login/Sign Up</a></li>
                            @endif
                        </li>
                    <li style="float:left; margin-left:13px"><button type="button" class="navbar-toggle collapsed top_download_btn" data-toggle="collapse" data-target="#app-navbar-collapse" style="font-size:11px; color:#fff;padding:0px 3px;">
                       Download App
                    </button></li>
                      </ul>
                      </div>
                    </div>
                </nav>
    
        <!--<!-- *****************Top Black Header Start************** -->
        <!--<nav class="navbar navbar-default navbar-static-top top_black_header">-->
        <!--    <div class="container">-->
        <!--        <div class="navbar-header">-->
        <!--            <img style="width: 150px;float: left;margin-top: 12px;margin-right: 35px;" src="{{asset('public/images/swapnear_logo-01.png')}}">-->
                    <!-- Collapsed Hamburger -->
        <!--            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">-->
        <!--                <span class="sr-only">Toggle Navigation</span>-->
        <!--                <span class="icon-bar"></span>                       -->
        <!--                <span class="icon-bar"></span>-->
        <!--            </button>-->
        <!--            <button type="button" class="navbar-toggle collapsed top_download_btn" data-toggle="collapse" data-target="#app-navbar-collapse" style="font-size:9px; color:#fff;padding:0px 3px;">-->
        <!--               Download App-->
        <!--            </button>-->
                    <!-- Branding Image -->
                    <!-- <a class="navbar-brand" href="{{ url('/') }}">
        <!--                {{ config('app.name', 'Wannahelp') }}-->
        <!--            </a> -->-->
        <!--            <a style="margin-top: 10px;" class="navbar-brand" id="open_location_selector">-->
        <!--                Select City&nbsp;&nbsp;<i class="fa fa-chevron-down" aria-hidden="true"></i>-->
        <!--            </a>-->
        <!--        </div>-->

        <!--        <div class="collapse navbar-collapse" id="app-navbar-collapse">-->
                    <!-- Left Side Of Navbar -->
                    
        <!--            <ul class="nav navbar-nav navbar-right  main-menu">-->
                           
                        <!-- <li style="margin-top: -3px;"><button onclick="show_modal()" class="btn btn-primary btn_slider_post_free pull-right" >POST FREE</button> </li>
        <!--                -->-->
        <!--                <li style=""><button  style="margin-top: 15px;" onclick="navigate_create_post()"  class="btn btn-primary btn_slider_post_free" >POST FREE</a></button> </li>-->
        <!--                <li style=""><a class="top_menu" style="margin-top: 3px;color:white;" href="{{(new \App\Http\Controllers\Helper)->get_url()}}" ><span style="font-size: 19px;" class="fa fa-home"></span>&nbsp;Home</a></li>-->
                        
        <!--                @if(Auth::user())-->
        <!--                 <li>-->
        <!--                    <a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/notifications" style="margin-top: 3px;color: white;background: #000000;"><span style="font-size: 19px;" class="fa fa-globe"></span>&nbsp;Notifications<span></span></a>-->
                              <!-- <ul id="notifications" class="dropdown-menu" style="width: 250px;background: #000000;">
                            <!-- <div class="line"></div>       -->
                              <!-- <li><a style="color: white;background: #000000;" href="{{(new \App\Http\Controllers\Helper)->get_url()}}/notifications"><center style="font-size:10px">See All Notifications</center></a></li>  
        <!--                      </ul> -->-->
        <!--                  </li>-->
        <!--                @endif-->
        <!--                @if(Auth::user())-->
        <!--                  <li>-->
        <!--                    <a href="#" style="margin-top: 3px;color: white;background: #000000;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome, @if(Auth::user()->username!=""){{Auth::user()->username}} @else-->
        <!--                    {{Auth::user()->name}} &nbsp;@endif<span><img src="<?php echo url('public/images/')?>//down-arrow.png" alt="" /></span></a>-->
        <!--                      <ul class="dropdown-menu newsfeed-home" style="background: #000000;">-->
        <!--                        <li><a style="color: white;background: #000000;" href="{{(new \App\Http\Controllers\Helper)->get_url()}}/user/{{Auth::user()->user_id}}"><i class="fa fa-eye"></i>&nbsp; View Profile</a></li>-->
        <!--                        <li><a style="color: white;background: #000000;" href="{{(new \App\Http\Controllers\Helper)->get_url()}}/credits"><i class="fa fa-money"></i>&nbsp; Credits</a></li>-->
                                <!--<li><a style="color: white;background: #000000;" href="{{(new \App\Http\Controllers\Helper)->get_url()}}/chat"><i class="fa fa-comment-o"></i>&nbsp; Messages</a></li> -->
        <!--                        <li><a style="color: white;background: #000000;" href="{{(new \App\Http\Controllers\Helper)->get_url()}}/messages"><i class="fa fa-comment-o"></i>&nbsp; Messages</a></li>-->
        <!--                         <li><a style="color: white;background: #000000;" href="{{(new \App\Http\Controllers\Helper)->get_url()}}/profile"><i class="fas fa-sliders-h"></i>&nbsp; Settings</a></li>-->
        <!--                        <li><a style="color: white;background: #000000;" href="{{(new \App\Http\Controllers\Helper)->get_url()}}/logout"><i class="fas fa-sign-out-alt"></i> &nbsp; Logout</a></li>-->
        <!--                      </ul>-->
        <!--                  </li>-->
        <!--                @endif-->
                        
                        
        <!--                <li style="margin-top:3px">-->
        <!--                    @if(Auth::user())-->
                                
        <!--                    @else-->
        <!--                        <a class="my_account_text" data-toggle="modal" onclick="show_login_form()"><span class="fa fa-user"></span>&nbsp;Login/Sign Up</a></li>-->
        <!--                    @endif-->
        <!--                </li>-->
        <!--            </ul>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</nav>-->
        <!-- *****************Top Black Header End************** -->
        <!-- ***************Register and login Pop up*************  -->    




    <!-- Modal -->
    
     <div class="modal fade" id="upload_cover" role="dialog">
        <div class="modal-dialog" style="top:10%;width: 55%;">
    
      <!-- Modal content-->
      <div class="modal-content">
          
          
		    <form id="upload_cover_form" method="post" enctype="multipart/form-data">      
		    <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Cover Picture</h4>
            </div>      
		     <div class="modal-body" style="overflow: visible;z-index: 5000;">
		   
		    <div class = "row">	
		        <div class="col-sm-4">
		            <span style="margin-left:50px"><b>Select Image &nbsp;&nbsp;&nbsp;</b></span>
		        </div>
		        <div class="col-sm-8">
		            <!--<input  style="width: 50%;" name="s1_file[]" type="file" class="file" data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload..."> -->
		            <input type="file" name="s1_file[]">
		        </div>
		    </div>
		    
		     <div id="message_savecover"></div>
			
		  
		   </div>
		   <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--  <button id="post" type="submit" class="btn btn-primary submit">
                    Post
                </button> -->
                <button type="submit" class="btn btn-primary submit">Submit</button>
                <!-- <input type="button" id="button">    -->
            </div>
            </form>
        </div>
      
    </div>
</div>
    
    
    <div class="modal fade" id="upload_dp" role="dialog">
        <div class="modal-dialog" style="top:10%;width: 55%;">
    
      <!-- Modal content-->
      <div class="modal-content">
         
		    <form id="upload_dp_form" method="post" enctype="multipart/form-data">      
		    <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Display Picture</h4>
            </div>      
		     <div class="modal-body" style="overflow: visible;z-index: 5000;">
		   
		    <div class = "row">	
		        <div class="col-sm-4">
		            <span style="margin-left:50px"><b>Select Image &nbsp;&nbsp;&nbsp;</b></span>
		        </div>
		        <div class="col-sm-8">
		            <!--<input  style="width: 50%;" name="s1_file[]" type="file" class="file" data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload..."> -->
		            <input type="file" name="s1_file[]">
		        </div>
		    </div>
		    
		     <div id="message_savedp"></div>
			
		  
		   </div>
		   <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--  <button id="post" type="submit" class="btn btn-primary submit">
                    Post
                </button> -->
                <button type="submit" class="btn btn-primary submit">Submit</button>
                <!-- <input type="button" id="button">    -->
            </div>
            </form>
        </div>
      
    </div>
</div>
 
 

  
<div class="modal fade" id="ReportPostModal" role="dialog" style="margin-top: 50px;">
    <div class="modal-dialog" style="width: 35%;">
    
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Report </h4>
            </div> 

            <form id="report_post" method="post" enctype='multipart/form-data'>
    
            <div class="modal-body" style="overflow: visible;z-index: 5000;">
    
               
               
                <span id="ReportGroup">
                <div class = "row">	      
                    <input style="margin-left: 35px;" type="radio" name="r_types" value="Seller not responding/phone unreachable"  />&nbsp;Seller not responding/phone unreachable
                </div>
                <br>
                <div class = "row">	      
                    <input style="margin-left: 35px;" type="radio" name="r_types" value="Post is duplicate"  />&nbsp;Post is duplicate
                </div>
                <br>
                <div class = "row">	      
                    <input style="margin-left: 35px;" type="radio" name="r_types" value="Wrong category"  />&nbsp;Wrong category
                </div>
                <br>
                <div class = "row">	      
                    <input style="margin-left: 35px;" type="radio" name="r_types" value="Offensive content"  />&nbsp;Offensive content
                </div>
                <br>
                <div class = "row">	      
                    <input style="margin-left: 35px;" type="radio" name="r_types" value="Fraud reason"  />&nbsp;Fraud reason
                </div>
                <br>
                </span>
                 <input type="hidden" id="post_id" name="post_id" id="type" value="">
                 <input type="hidden" id="r_type" name="r_type" id="type" value="">
                <div id="report_area" style="display:block;">
                    <textarea name="r_description" placeholder="Provide additional information which will be helpful in checking your report, if you want to get response from us please provide your e-mail address" id="r_description" style="resize: none;height:75px;width:445px"></textarea>
                </div>    
               
             
                
                
            </div> 
    
            <div class="modal-footer">
    
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary submit">Send</button>
            </div>
            
            </form>
    
    
        </div>
    
    </div>
    
</div>


<div class="modal fade" id="BoostPostModal" role="dialog" style="margin-top: 50px;">
    <div class="modal-dialog" style="width: 35%;">
    
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Boost </h4>
            </div> 

            <form id="boost_post" method="post" enctype='multipart/form-data'>
    
            <div class="modal-body" style="overflow: visible;z-index: 5000;">
    
               <input type="hidden" id="boost_post_id" name="boost_post_id" value=""> 
                <input type="hidden" id="boost_user_id" name="boost_user_id" value=""> 
               <center><b><i class="fa fa-money" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;Total Available Credits: <span id="rem_credits"></span></b></center>
               <br>
               <i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Existing Plan: <span id="plan_name"></span></b>
               <br>
                <i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;Valid for: <span id="validity"></span>
                <br><br>
               <center>Are you sure to Boost this post for <b>1 credit</b>?</center> 
               
             
                
                
            </div> 
    
            <div class="modal-footer">
    
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary submit">Boost</button>
            </div>
            
            </form>
    
    
        </div>
    
    </div>
    
</div>
  
  <div class="modal fade" id="EditPostModal_bc" role="dialog">
        <div class="modal-dialog" style="width: 55%;">
    
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
		          
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Post </h4>
           
                
                </div> 
            
            <!-- Broadcast Data -->
		    <div id="broadcast" style="display: block">
		    <form id="edit_post_bc" method="post" enctype='multipart/form-data'>
		    
             <div class="modal-body" style="overflow: visible;z-index: 5000;">
               
		    <div class = "row">	
		    <div class="col-sm-3"><span style="margin-left:50px"><b>Description&nbsp;&nbsp;&nbsp;</b></span> </div>
		    <div class="col-sm-4"><textarea name="description_bc" id="description_bc" style="resize: none;height: 75px;width: 480px;"></textarea></div>
		    </div>
			<br><br>
			
			<div class = "row">	
			    <div class="col-lg-3">
		        <span style="margin-left:50px"><b>Category</b></span> <br><br>
		        </div>
		     
		         
    		    <div class="col-lg-9" style="margin-left:  -30px;">     
        		    <div class="slider_category_wrap_create" style="z-index: 1;position:unset !important;">
                        <div class="slider_content_bottom" style="width: 97% !important;left: 2%;right: 10%;background: white;"></div>
                        <div class="slider_content_bottom_content">
                            <div class="cat_full_wrap">
                                <div class="cat_scroll_arrow" id="cat_scroll_arrow_left_bc_edit">
                                    <i  style="color:black;" class="fa fa-chevron-left"></i>
                                </div>
                                <div class="category_scroller_wrap category_scroller_wrap_bc_edit">                
                                    <ul class="category_scroller">
        								 
                                         @foreach($categories as $category)
                                          @if($category->id != 1)
        								 <li>
                                             <div class="cat_img_wrap">
                                                 
                                                <div name="{{$category->id}}"><img id="cat_bc{{$category->id}}" style="width: 60px;" onclick="edit_choose_category_bc({{$category->id}})" src="<?php echo url('public/images/category/')?>/{{$category->logo_image}}"> 
                                                </div>
                                             </div>
                                             <p  style="color:black;">{{$category->category_title}}</p>
                                         </li>
                                         @endif
        								 @endforeach
                                         
                                     </ul>
                                </div>
                                <div class="cat_scroll_arrow" id="cat_scroll_arrow_right_bc_edit">
                                    <i  style="color:black;" class="fa fa-chevron-right"></i>
                                </div> 
                                <div class="clearfix"></div>
                            </div>
        
        
                        </div>
                    </div>
    		    </div>
		    
		    </div>
		    <br><br>
			
		     
            
            <div class = "row">	                
		    <div class="col-sm-3"><span style="margin-left:50px"><b>Location</b> </span></div>
		    <div class="col-sm-4"><input id="pac-input-modal_bc_edit" name="pac-input-modal_bc" type="text" class="form-control search_query" placeholder="Search in your city" /></div>
		   
		    </div>
		    <br>
		    <div class="line"></div>
		    <br>
		   
		    <input type="hidden" name="edit_post_id_bc" id="edit_post_id_bc" value="">
		     <input type="hidden" name="type" id="type" value="Broadcast">
		     <br>
		   <div id="pm-edit_message_bc"></div>
		   
		   </div>
		   
		   <div class="modal-footer">
		      
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
                
                <button type="submit" class="btn btn-primary submit">Edit</button>
               
                <!-- <input type="button" id="button">    -->
            </div>
		   </form>
		   </div>
		    <!-- End of Broadcast Data -->

        
      </div>
      
    </div>
  </div>
  
  <div class="modal fade" id="EditPostModal_sw" role="dialog">
        <div class="modal-dialog" style="width: 55%;">
    
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
		          
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Post </h4>
           
                
                </div> 
            
            <!-- Broadcast Data -->
		    <div id="broadcast" style="display: block">
		    <form id="edit_post_sw" method="post" enctype="multipart/form-data">      
		        
		     <div class="modal-body" style="overflow: visible;z-index: 5000;">
		    
		    <div class = "row">	
		    <div class="col-sm-3"><span style="margin-left:50px"><b>Caption&nbsp;&nbsp;&nbsp;</b></span> </div>
		    <div class="col-sm-4"><textarea name="caption_sw" id="caption_sw" style="resize: none;height:50px;width:300px"></textarea></div>
		    </div>
		    <div class = "row">	
		    <div class="col-sm-3"><span style="margin-left:50px"><b>Description&nbsp;&nbsp;&nbsp;</b></span> </div>
		    <div class="col-sm-4"><textarea name="description_sw" id="description_sw" style="resize: none;height:85px;width:450px"></textarea></div>
		    </div>
		    <br>
		    <div class = "row">	
		    <div class="col-sm-3"><span style="margin-left:35px"><b>Upload Images&nbsp;&nbsp;&nbsp;</b></span></div>
		    <div class="col-sm-8"><!--<input  style="width: 50%;" name="s1_file" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload..."> -->
		    <input type="file" name="s1_file[]" multiple>
		    </div>
		    </div>
		    <br>
			
		   <br><br>
			
			<div class = "row">	
			    <div class="col-lg-3">
		        <span style="margin-left:50px"><b>Category</b></span> <br><br>
		        </div>
		     
		         
    		    <div class="col-lg-9" style="margin-left:  -30px;">     
        		    <div class="slider_category_wrap_create" style="z-index: 1;position:unset !important;">
                        <div class="slider_content_bottom" style="width: 97% !important;left: 2%;right: 10%;background: white;"></div>
                        <div class="slider_content_bottom_content">
                            <div class="cat_full_wrap">
                                <div class="cat_scroll_arrow" id="cat_scroll_arrow_left_sw_edit">
                                    <i  style="color:black;" class="fa fa-chevron-left"></i>
                                </div>
                                <div class="category_scroller_wrap category_scroller_wrap_sw_edit">                
                                    <ul class="category_scroller">
        								 
                                         @foreach($categories as $category)
                                          @if($category->id != 1)
        								 <li>
                                             <div class="cat_img_wrap">
                                                 
                                                <div name="{{$category->id}}"><img id="cat_sw{{$category->id}}" style="width: 60px;" onclick="edit_choose_category_sw({{$category->id}})" src="<?php echo url('public/images/category/')?>/{{$category->logo_image}}"> 
                                                </div>
                                             </div>
                                             <p  style="color:black;">{{$category->category_title}}</p>
                                         </li>
                                         @endif
        								 @endforeach
                                         
                                     </ul>
                                </div>
                                <div class="cat_scroll_arrow" id="cat_scroll_arrow_right_sw_edit">
                                    <i  style="color:black;" class="fa fa-chevron-right"></i>
                                </div> 
                                <div class="clearfix"></div>
                            </div>
        
        
                        </div>
                    </div>
    		    </div>
		    
		    </div>
		    <br><br>
            
            <div class = "row">	                
		    <div class="col-sm-3"><span style="margin-left:50px"><b>Location</b> </span></div>
		    <div class="col-sm-4"><input  class="form-control" name="pac-input-modal_sw" id="pac-input-modal_sw" type="text" class="form-control search_query" placeholder="Enter your location" /></div>
		   
		    </div>
		    <br>
		     <div class="row">
		        <div class="col-sm-12">
		            <span style="margin-left: 50px;"><b>Wishing to swap for</b></span> 
		            <span id="myRadioSwap"><input type="radio" name="swap_option" value="Product/Price" style="margin-left: 35px;">&nbsp;Product/Price
                        <input type="radio" name="swap_option" value="Open" style="margin-left: 35px;">&nbsp;Open for anything
                        <input type="radio" name="swap_option" value="Free" style="margin-left: 35px;">&nbsp;Give it Away for Free
                
                    </span>
                    </div>
                </div>
		   
		     <input type="hidden" name="type" id="type" value="Swap">
		     <input type="hidden" name="edit_post_id_sw" id="edit_post_id_sw" value="">
		     <br><br>
		   <div id="pm-edit_message_sw"></div>
		   </div>
		   
		   <div class="modal-footer">
		      
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
                
                <button type="submit" class="btn btn-primary submit">Edit</button>
               
                <!-- <input type="button" id="button">    -->
            </div>
		   </form>
		   </div>
		    <!-- End of Broadcast Data -->

        
      </div>
      
    </div>
  </div>
  
  
  <div class="modal fade" id="EditPostModal_lv" role="dialog">
        <div class="modal-dialog" style="width: 55%;">
    
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
		          
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Post </h4>
           
                
                </div> 
            
            <!-- Broadcast Data -->
		    <div id="broadcast" style="display: block">
		    <form id="edit_post_lv" method="post" enctype='multipart/form-data'>
		    
             <div class="modal-body" style="overflow: visible;z-index: 5000;">
               
		    <div class = "row">	
		    <div class="col-sm-3"><span style="margin-left:50px"><b>Description&nbsp;&nbsp;&nbsp;</b></span> </div>
		    <div class="col-sm-4"><textarea name="description" id="description" style="resize: none;height: 75px;width: 480px;"></textarea></div>
		    </div>
			<br><br>
			
			<div class = "row">	
			    <div class="col-lg-3">
		        <span style="margin-left:50px"><b>Category</b></span> <br><br>
		        </div>
		     
		         
    		    <div class="col-lg-9" style="margin-left:  -30px;">     
        		    <div class="slider_category_wrap_create" style="z-index: 1;position:unset !important;">
                        <div class="slider_content_bottom" style="width: 97% !important;left: 2%;right: 10%;background: white;"></div>
                        <div class="slider_content_bottom_content">
                            <div class="cat_full_wrap">
                                <div class="cat_scroll_arrow" id="cat_scroll_arrow_left_lv_edit">
                                    <i  style="color:black;" class="fa fa-chevron-left"></i>
                                </div>
                                <div class="category_scroller_wrap category_scroller_wrap_lv_edit">                
                                    <ul class="category_scroller">
        								 
                                         @foreach($categories as $category)
                                          @if($category->id != 1)
        								 <li>
                                             <div class="cat_img_wrap">
                                                 
                                                <div name="{{$category->id}}"><img id="cat_lv{{$category->id}}" style="width: 60px;" onclick="edit_choose_category_lv({{$category->id}})" src="<?php echo url('public/images/category/')?>/{{$category->logo_image}}"> 
                                                </div>
                                             </div>
                                             <p  style="color:black;">{{$category->category_title}}</p>
                                         </li>
                                         @endif
        								 @endforeach
                                         
                                     </ul>
                                </div>
                                <div class="cat_scroll_arrow" id="cat_scroll_arrow_right_lv_edit">
                                    <i  style="color:black;" class="fa fa-chevron-right"></i>
                                </div> 
                                <div class="clearfix"></div>
                            </div>
        
        
                        </div>
                    </div>
    		    </div>
		    
		    </div>
		    <br><br>
            
            <div class = "row">	                
		    <div class="col-sm-3"><span style="margin-left:50px"><b>Location</b> </span></div>
		    <div class="col-sm-4"><input id="pac-input-modal" name="pac-input-modal" type="text" class="form-control search_query" placeholder="Search in your city" /></div>
		   
		    </div>
		    <br>
		    <div class="line"></div>
		    <br>
		   
		    <input type="hidden" name="edit_post_id" id="edit_post_id" value="">
		     <input type="hidden" name="type" id="type" value="Broadcast">
		     <br>
		   <div id="pm-edit_message_bc"></div>
		   
		   </div>
		   
		   <div class="modal-footer">
		      
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
                
                <button type="submit" class="btn btn-primary submit">Edit</button>
               
                <!-- <input type="button" id="button">    -->
            </div>
		   </form>
		   </div>
		    <!-- End of Broadcast Data -->

        
      </div>
      
    </div>
  </div>
  
  
  
  
  <div class="modal fade" id="OtpModal" role="dialog" data-backdrop="static" data-keyboard="false" >
        <div class="modal-dialog" style="margin-top: 100px;width: 42%;">
    
      <!-- Modal content-->
      <div class="modal-content">
          
            <!-- Broadcast Data -->
		 
		    <form id="otp-verify-form" method="post" enctype='multipart/form-data'>
		    
             <div class="modal-body" style="overflow: visible;z-index: 5000;">
    		   
                
                <div class = "row">	     
                <img src="https://cdn2.iconfinder.com/data/icons/luchesa-part-3/128/SMS-512.png" class="img-responsive" style="width:180px; height:170px;margin:0 auto;"><br>
            
            <h3 class="text-center">Verify your mobile number</h3><br>
    		    
    		   <center> <input id="otp" name="otp" type="text" placeholder="Enter OTP" /><center>
    		   
    		    </div>
    		    
    		   <div id="message_otp"></div>
		   
		   </div>
		   
		   <div class="modal-footer">
		      
              
               
              
                <button type="submit" class="btn btn-primary">Submit</button>
               
               
            </div>
		   </form>
		  
		    <!-- End of Broadcast Data -->
		    
		    
		    <!-- Swap Data -->
		    
		 
		     
		    
		    
        
        
      </div>
      
    </div>
  </div>
  
  
  
<div class="modal fade" id="LoginPhone" role="dialog" >
    <div class="modal-dialog" style="margin-top: 100px;width: 42%;">
    
      <!-- Modal content-->
      <div class="modal-content">
          
            
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Login with phone & OTP</h4>
            </div>
		 
		    <form id="login-otp-form" method="post" enctype='multipart/form-data'>
		    
             <div class="modal-body" style="overflow: visible;z-index: 5000;">
    		   
                  <div class = "row">	     
              
                   
                    <center><label style="padding-top: 15px;padding-right: 40px;padding-bottom: 25px;" for="Mobile Number">Enter Mobile Number</label>
                   
                   <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="mobilenumber" type="text" name="mobilenumber" title="Enter Mobile Number" placeholder="Mobile Number"></center>
              
    		    </div>
    		   <div id="message_otp"></div>
    		   
    		   <center><button type="submit" class="btn btn-primary">Get OTP</button></center>
		   
		   </div>
		   
		  
		   </form>
		  

      </div>
      
    </div>
  </div>
  
  
  <!-- Registration Modal -->
  <div id="register_login_wrap" class="modal fade in" role="dialog"> 
          <div class="modal-dialog">
            
            <!-- Modal content-->
            <div class="modal-content"  style="background:transparent;">              
              <div class="modal-body">
                    <div class="reg-form-container">             
                          <!-- Register/Login Tabs-->
                          <div class="reg-options">
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#register" data-toggle="tab" aria-expanded="true">Register</a></li>
                              <li class=""><a href="#login" data-toggle="tab" aria-expanded="false">Login</a></li>
                            </ul><!--Tabs End-->
                          </div>
                          
                          <!--Registration Form Contents-->
                          <div class="tab-content">
                            <div class="tab-pane active" id="register">
                              <h3>Register Now !!!</h3>
                             
                              <!--Register Form-->
                              <form name="registration_form" id="registration_form" class="form-inline">
                                <div class="">
                                  
                                  <div class="form-group-popup">
                                    <label for="email" class="sr-only">User Name</label>
                                    <input id="username" class="form-control input-group-lg" type="text" name="username" title="Enter user name" placeholder="Your Username">
                                  </div>
                                  
                                  <div class="form-group-popup">
                                    <label for="email" class="sr-only">Email</label>
                                    <input id="email" class="form-control input-group-lg" type="text" name="email" title="Enter Email" placeholder="Your Email">
                                  </div>
                                  
                                  <div class="form-group-popup">
                                      <!-- <select name="countries" id="countries" style="width:300px;">
                                        <option value='91' data-image="public/images/msdropdown/icons/blank.gif" data-imagecss="flag ad" data-title="India">India</option>
                                       
                                        <option value='ag' data-image="public/images/msdropdown/icons/blank.gif" data-imagecss="flag ag" data-title="Antigua and Barbuda">Antigua and Barbuda</option>
                                      </select> -->
                                    <label for="Mobile Number" class="sr-only">Mobile Number</label>
                                    <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="mobile_number" class="form-control input-group-lg" type="text" name="mobile_number" title="Enter Mobile Number" placeholder="Mobile Number">
                                  </div>

                                  <div class="form-group-popup">
                                    <label for="password" class="sr-only">Password</label>
                                    <input id="password" class="form-control input-group-lg" type="password" name="password" title="Enter password" placeholder="Password">
                                  </div>

                                </div>                     

                              
                                
                              </form><!--Register Now Form Ends-->
                              <p><a href="#">Already have an account?</a></p>
                              <div id="message_register"></div>
                              
                              <center><button onclick="register()" class="btn btn-primary">Register Now</button></center>
                              <center>or</center>
                             <!-- <center> <a onclick="register_mobile()">Register via Mobile & OTP </a></center>
                               <center>or<center> -->
                              <a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/fb"><button class="loginBtn loginBtn--facebook">Sign in using Facebook</button></a>
                              <a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/google"><button class="loginBtn loginBtn--google">Sign in using Google</button></a>
                              
                            </div><!--Registration Form Contents Ends-->
                            
                            <!--Login-->
                            <div class="tab-pane" id="login">
                              <h3>Login</h3>
                              
                              
                              <!--Login Form-->
                              <form name="Login_form" id="Login_form" method="post" enctype='multipart/form-data'>
                                 <div class="row">
                                  <div class="form-group col-xs-12">
                                    <label for="my-email" class="sr-only">Email or Mobile Number</label>
                                    <input id="my-email" class="form-control input-group-lg" type="text" name="Email" title="Enter Email" placeholder="Your Email">
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-xs-12">
                                    <label for="my-password" class="sr-only">Password</label>
                                    <input id="my-password" class="form-control input-group-lg" type="password" name="password" title="Enter password" placeholder="Password">
                                  </div>
                                </div>
                                </form>
                              <p><a href="#">Forgot Password?</a></p>
                              <center><button onclick="login()" class="btn btn-primary">Login Now</button></center>
                             <br> 
                              <center><a onclick=show_login_phone_modal()>Login with phone & OTP</a></center>
                              <br>
                              
                              <a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/fb"><button class="loginBtn loginBtn--facebook">Login using Facebook</button></a>
                              <a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/google"><button class="loginBtn loginBtn--google">Login using Google</button></a>
                              <!--Login Form Ends--> 
                            </div>
                          </div>
                        </div>
              </div>             
            </div>

          </div>
        </div>
        
        <div id="register_mobile_wrap" class="modal fade in" role="dialog"> 
          <div class="modal-dialog">
            
            <!-- Modal content-->
            <div class="modal-content">
            
              <div class="modal-body">
                      <div class="reg-form-container">
                          <!-- Register/Login Tabs-->
                          
                          
                          
                              <h3>Register via Mobile & OTP !!!</h3>
                             
                              <!--Register Form-->
                              <form enctype='multipart/form-data' name="registration_mobile_form" id="registration_mobile_form">
                                <div class="">
                                  <div class="form-group-popup">
                                      <select name="countries" id="countries" style="width:300px;">
                                        <option value='91' data-image="public/images/msdropdown/icons/blank.gif" data-imagecss="flag ad" data-title="India">India</option>
                                       
                                        <option value='ag' data-image="public/images/msdropdown/icons/blank.gif" data-imagecss="flag ag" data-title="Antigua and Barbuda">Antigua and Barbuda</option>
                                      </select>
                                    <label for="Mobile Number" class="sr-only">Mobile Number</label>
                                    <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="mobilenumber" class="form-control input-group-lg" type="text" name="mobilenumber" title="Enter Mobile Number" placeholder="Mobile Number">
                                  </div>
                                  <div class="form-group-popup">
                                    <label for="firstname" class="sr-only">First Name</label>
                                    <input id="firstname" class="form-control input-group-lg" type="text" name="firstname" title="Enter first name" placeholder="First name">
                                  </div>

                                  <div class="form-group-popup">
                                    <label for="lastname" class="sr-only">Last Name</label>
                                    <input id="lastname" class="form-control input-group-lg" type="text" name="lastname" title="Enter last name" placeholder="Last name">
                                  </div>
                                  
                                  

                                  <div class="form-group-popup">
                                    <label for="password" class="sr-only">Password</label>
                                    <input id="password" class="form-control input-group-lg" type="password" name="password" title="Enter password" placeholder="Password">
                                  </div>

                                </div>                     

                              <p><a href="#">Already have an account?</a></p>
                              <div id="message_mobile_register"></div>
                              
                              <center><button type="submit" class="btn btn-primary">Get OTP</button></center>
                              <div id="otp_msg"></div>
                            </form>  
                               <div class="form-group-popup">
                                    <label for="password" class="sr-only">OTP</label>
                                    <input id="password" class="form-control input-group-lg" type="otp" name="otp" title="Enter OTP" placeholder="Enter OTP">
                                  </div>
                                <center><button onclick="verify_otp()" class="btn btn-primary">Register</button></center>
                            
                                </form><!--Register Now Form Ends-->
                            
                          
                    </div>    
              </div>             
            </div>

          </div>
        </div>
        
        
        @yield('content')

        <footer>
            <div class="footer_content1">
                <div class="container">
                    <div class="row">                        
                        <ul class="footer_links_top">
                            <li><button class="btn btn_download_ftr">Download App</button>&nbsp;&nbsp;</li>
                            <li><a href="">Home</a></li>
                            <li><a href="">About WannaHelp</a></li>
                            <li><a href="">Why Premium?</a></li>
                            <li><a href="">Terms of use</a></li>
                            <li><a href="">Privacy policy</a></li>
                            <li><a href="">Blog</a></li>
                            <li><a href="">Help & Contact us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--
            <div class="footer_content2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <img src="<?php echo url('public/images/wh_home_logo.png');?>">
                        </div> 
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <h4>Popular Search</h4>
                            <ul class="footer_links_btm">                                
                                <li><a href="">Honda city for sale</a></li>
                                
                                
                            </ul>
                        </div>  
                        <div class="col-lg-2col-md-2 col-sm-2 col-xs-12">
                            <h4>Popular Search</h4>
                            <ul class="footer_links_btm">                                
                                <li><a href="">Honda city for sale</a></li>
                               
                                
                            </ul>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <h4>Popular Search</h4>
                            <ul class="footer_links_btm">                                
                                <li><a href="">Honda city for sale</a></li>
                               
                                
                            </ul>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <h4>Popular Search</h4>
                            <ul class="footer_links_btm">                                
                                <li><a href="">Honda city for sale</a></li>
                               
                               
                            </ul>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <h4>Popular Search</h4>
                            <ul class="footer_links_btm">                                
                                <li><a href="">Honda city for sale</a></li>
                               
                                
                            </ul>
                        </div> 
                                                
                    </div>
                </div>
            </div>
            -->
        </footer>
		
	
	<div id="chat-container"></div>	
    </div> <!--   end of app>



    <!-- Scripts -->
     <script src="{{asset('public/js/semantic.js')}}"></script> 
    <script src="{{ asset('public/js/app.js') }}"></script>
    <script src="{{ asset('public/js/custom.js') }}"></script>
	<script src="{{asset('public/js/jquery.typeahead.js')}}"></script>
	<script src="{{asset('public/js/newWaterfall.js')}}"></script> 
	<script src="{{asset('public/js/jquery.cookie.js')}}"></script> 
	<script src="{{asset('public/js/jssocials.js')}}"></script> 
	<script src="{{asset('public/js/jquery.dd.min.js')}}"></script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
	<script async src="http://guteurls.de/guteurls.js" selector=".myP"></script>
	<script src="{{ asset('public/js/share.js') }}"></script>
	
	
	 <script src="https://www.gstatic.com/firebasejs/4.5.0/firebase.js"></script>
    <script>
        // Initialize Firebase
        var config = {
          apiKey: "{{ env('FIREBASE_APIKEY') }}",
          authDomain: "{{ env('FIREBASE_AUTHDOMAIN') }}",
          databaseURL: "{{ env('FIREBASE_DATABASEURL') }}",
          projectId: "{{ env('FIREBASE_PROJECT_ID') }}",
          storageBucket: "{{ env('FIREBASE_STORAGEBUCKET') }}",
          messagingSenderId: "{{ env('FIREBASE_MESSAGINGSENDER_ID') }}"
        };
        firebase.initializeApp(config);

        const database = firebase.database();
        
    </script>
     <script src="{{asset('public/js/myapp.js')}}"></script> 
     
     
     
     
     
    <script>
    
    $("#pac-input-tp").keyup(function(){
        
            if($("#pac-input-tp").val()=='')
            {
            document.cookie = "location=";
            //alert($("#pac-input-tp").val());
            }
             
    });
    $("#pac-input-btm").keyup(function(){
            if($("#pac-input-btm").val()=='')
            {
            document.cookie = "keyword=";
            //alert($("#pac-input-btm").val());
            }
             
    });
    
    $("#submit-search").click(function(){
        
        document.cookie = "page_bc=1";
      document.cookie = "page_sw=1";
      document.cookie = "page_lv=1";
        
        
        
         $("#results").empty();
       $("#waterfall_content").empty();
       $("#results_lv").empty();
        location33=$("#pac-input-tp").val();
        var i=getCookie("cat");
        document.cookie = "location="+location33;
        //alert(getCookie("location"));
        var distance=$("#search-distance").val();
        document.cookie = "distance="+distance;
        //$('.ajax-loading-bc').show();
        load_more(getCookie("page_bc"),'Broadcast',i,getCookie("keyword"),getCookie("location"),getCookie("distance")); //load content
        load_more(getCookie("page_sw"),'Swap',getCookie("cat"),getCookie("keyword"),getCookie("location"),distance);
        load_more(getCookie("page_lv"),'LocalVocal',getCookie("cat"),getCookie("keyword"),getCookie("location"),distance); //load content 
    
    
    
    }); 
     
    </script> 
     
     
     
     
     
     
     
     
    <script type="text/javascript">
    
    $('#user_credits_btn').hide();
    var baseurl = "wannahelp.com/whapi/";
    
    var numArray_bc = [];
    var edit_numArray_bc = [];
    var edit_numArray_sw = [];
    var edit_numArray_lv = [];
    var numArray_sw = [];
    var numArray_lv = [];
    var cat = [];
    
    $(document).ready(function() {
        $("#countries").msDropdown();
    })
    
    
      $(document).on('click', '.panel-heading span.icon_minim', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('focus', '.panel-footer input.chat_input', function (e) {
    var $this = $(this);
    if ($('#minim_chat_window').hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideDown();
        $('#minim_chat_window').removeClass('panel-collapsed');
        $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('click', '#new_chat', function (e) {
    var size = $( ".chat-window:last-child" ).css("margin-left");
     size_total = parseInt(size) + 400;
    alert(size_total);
    var clone = $( "#chat_window" ).clone().appendTo( "#app" );
    clone.css("margin-left", size_total);
});

$(document).on('click', '.icon_close', function (e) {
    //$(this).parent().parent().parent().parent().remove();
    $( ".chat-window" ).remove();
    //$( "#CV1819001452828" ).remove();
    //e.currentTarget.dataset.id;
    
});



function new_chat(id,type)
    {
     //vue1();
     $.ajax({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
             
            url: window.location.origin +"/whapi/new_chat",
           //type: 'POST',
            
            contentType: false,
            data: { 
                id: id,
                type: type
                 
            },
            success: function (result) {
                 
            //var result = '<firebase-messages user-id="PQ189810520811YR" conv-id="CV1811906195791" receptor-name="Shyam"></firebase-messages>';
            
                  // vue1(); 
                 $("#app").append(result);
                  vue1();
                  $('#waterfall_content').NewWaterfall();
            }
            
            
            
        });
        
     
    // return false;
     // vue1();
    }
    
    
    
    var code = {};
    $("select[name='month'] > option").each(function () {
        if(code[this.text]) {
            $(this).remove();
        } else {
            code[this.text] = this.value;
        }
    });
    
     var code = {};
    $("select[name='year'] > option").each(function () {
        if(code[this.text]) {
            $(this).remove();
        } else {
            code[this.text] = this.value;
        }
    });
    
     var code = {};
    $("select[name='day'] > option").each(function () {
        if(code[this.text]) {
            $(this).remove();
        } else {
            code[this.text] = this.value;
        }
    });
    
    
    $('#use_credit').change(function() {
         var value = $(this).val();
     if($(this).prop("checked") == true){    
         var value = $(this).val();
     //if(($(this).val())=="use_credit")
      $('#user_credits_btn_'+value).show();
     
     }
      else
       $('#user_credits_btn_'+value).hide();
        
    });
    
    //
    $('#follow').change(function(){
  // alert($(this).val());
        if($(this).prop("checked") == true){
            if(($(this).val())=="follow")
                var follow = 1;
            else if(($(this).val())=="comment")
                var comment = 0;
            
        }
        else if($(this).prop("checked") == false){
                   // alert("Checkbox is unchecked.");
                    if(($(this).val())=="follow")
                        var follow = 0;
                    else if(($(this).val())=="comment")
                        var comment = 1;    
        }
        
        
         $.ajax({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
             
            url: "saveprofile",
           // type: 'POST',
            
            contentType: false,
            data: { 
                follow: follow,
                comment:comment // < note use of 'this' here
               // password: $("#my-password").val()
            },
            success: function (result) {
                 // $('#register_login_wrap').modal('toggle');
                // $("#register_login_wrap").hide();
               // $('.modal-backdrop').remove();
               // $("#PostModal").show();    
                console.log(result);
                
            },
            
        });
        
        return false;
        
        
        
        
    });
    
  
    
    $("form#login-otp-form").submit(function(){
        
       var formData = new FormData($(this)[0]); 
       console.log($('#mobilenumber').val());
       $('<input>').attr({
            type: 'hidden',
            id: 'mobilenumber',
            name: 'mobilenumber',
            value: $('#mobilenumber').val()
        }).appendTo('form#otp-verify-form');
        $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        url: "send_otp",
        type: 'POST',
        data: formData,
        success: function (result) {

            if(result == "SMS Sent")
            {
                 $('#LoginPhone').modal('toggle');
                $('.modal-backdrop').remove();
                
                
                $('#OtpModal').modal('show');
                /*$('<input>').attr({
                type: 'hidden',
                id: 'foo',
                name: 'bar'
                }).appendTo('form');*/
                // $('.modal-backdrop').remove();
                //alert("successs");
              // window.location.reload();
              //  toastr.success('Successfuly Registered. Please verify your email address');
                }
            else
            {
               $( "#message_otp" ).empty();
               $('<span style="font-style:italic;color:red;"><br>'+result+'<br></span>').appendTo('#message_otp');
            }
        },
        cache: false,
        processData: false,
        async: false,
       
        contentType: false,
    });
        return false;
    }); 
    
     $("form#otp-verify-form").submit(function(){
        
       var formData = new FormData($(this)[0]); 
       
        $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        url: "verify_otp",
        type: 'POST',
        data: formData,
        success: function (result) {

            if(result == "ok")
            {
                $('#OtpModal').modal('hide');
                // $('.modal-backdrop').remove();
                //alert("successs");
               //var id = $('input[name="is_boost_clicked"]').val();
                // if(id == 0)
                    window.location = window.location.origin +"/whapi";
                //toastr.success('Success');
                
                toastr.success('Successfuly Registered. Please verify your email address');
                }
            else
            {
               $( "#message_otp" ).empty();
               $('<span style="font-style:italic;color:red;"><br>'+result+'<br></span>').appendTo('#message_otp');
            }
        },
        cache: false,
        processData: false,
        async: false,
       
        contentType: false,
    });
        return false;
    }); 
    
   
    $("form#basic-info").submit(function(){
        
       var formData = new FormData($(this)[0]); 
       
        $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        url: "savebasicbio",
        type: 'POST',
        data: formData,
        success: function (result) {
           
            if(result == "ok")
            {
                 toastr.success('Successfuly Updated');
                //$('#upload_dp').modal('hide');
                // $('.modal-backdrop').remove();
                //alert("successs");
               //window.location.reload();
                //toastr.success('Success');
                }
            else
            {
               
                toastr.error(result);// $( "#message_savedp" ).empty();
               // $('<span style="font-style:italic;color:red;">'+result+'</span>').appendTo('#message_savedp');
            }
        },
        cache: false,
        processData: false,
        async: false,
       
        contentType: false,
    });
        return false;
    }); 
    
    
    
    $("form#registration_mobile_form").submit(function(){
        
       var formData = new FormData($(this)[0]); 
       
        $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        url: "get_otp",
        type: 'POST',
        data: formData,
        success: function (result) {
            console.log(result);
            //alert(result);
            if(result == "ok")
            {
                //$('#upload_dp').modal('hide');
                // $('.modal-backdrop').remove();
                //alert("successs");
                $( "#otp_msg" ).empty();
               $('<span style="font-style:italic;color:green;"> <br> SMS Sent. Please enter the OTP below. </span>').appendTo('#otp_msg');
              // window.location.reload();
               // ..toastr.success('Success');
                }
            else
            {
               // $( "#message_savedp" ).empty();
               // $('<span style="font-style:italic;color:red;">'+result+'</span>').appendTo('#message_savedp');
            }
        },
        cache: false,
        processData: false,
        async: false,
       
        contentType: false,
    });
        return false;
    }); 
    
    
    
    
    $("form#update-pass").submit(function(){
        
       var formData = new FormData($(this)[0]); 
       
        $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        url:"saveupdatepassword",
        type: 'POST',
        data: formData,
        success: function (result) {
            console.log(result);
            //alert(result);
            /*if(result == "ok")
            {
                //$('#upload_dp').modal('hide');
                // $('.modal-backdrop').remove();
                alert("successs");
               window.location.reload();
                toastr.success('Success');
                }
            else
            {
               // $( "#message_savedp" ).empty();
               // $('<span style="font-style:italic;color:red;">'+result+'</span>').appendTo('#message_savedp');
            }*/
        },
        cache: false,
        processData: false,
        async: false,
       
        contentType: false,
    });
        return false;
    }); 
    
     $("form#report_post").submit(function(){

    var formData = new FormData($(this)[0]);

    //console.log(formData);
    $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        url: "../report_post",
        type: 'POST',
        data: formData,
        success: function (result) {
            console.log(result);
            
        },
        cache: false,
        processData: false,
        async: false,
       
        contentType: false,
    });
    
    return false;
    });
    
    
    $("form#upload_dp_form").submit(function(){
        
       var formData = new FormData($(this)[0]); 
       
        $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        url: window.location.origin +"/whapi/savedp",
        type: 'POST',
        data: formData,
        success: function (result) {
            console.log(result);
            if(result == "ok")
            {
                $('#upload_dp').modal('hide');
                 $('.modal-backdrop').remove();
                //alert("successs");
               window.location.reload();
                toastr.success('Success');
                }
            else
            {
                $( "#message_savedp" ).empty();
                $('<span style="font-style:italic;color:red;">'+result+'</span>').appendTo('#message_savedp');
            }
        },
        cache: false,
        processData: false,
        async: false,
       
        contentType: false,
    });
        return false;
    });    
        
    $("form#upload_cover_form").submit(function(){
        
       var formData = new FormData($(this)[0]); 
       
        $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        url: window.location.origin +"/whapi/savecover",
        type: 'POST',
        data: formData,
        success: function (result) {
            console.log(result);
            if(result == "ok")
            {
                $('#upload_cover').modal('hide');
                 $('.modal-backdrop').remove();
                //alert("successs");
               window.location.reload();
                toastr.success('Success');
                }
            else
            {
                $( "#message_savecover" ).empty();
                $('<span style="font-style:italic;color:red;">'+result+'</span>').appendTo('#message_savecover');
            }
        },
        cache: false,
        processData: false,
        async: false,
       
        contentType: false,
    });
        return false;
    });       
    
    $("form#Broadcast-form").submit(function(){

    var formData = new FormData($(this)[0]);
    //var type = $(".page_search_wrap_left_ul li.active").text();
    //var type = getCookie("post_type");
    
    var type = $("input[type='radio']:checked").val();
    if(type == "Broadcast")
    formData.append("cat", numArray_bc);
    else if(type == "Swap")
    formData.append("cat", numArray_sw);
    else if(type == "LocalVocal")
    formData.append("cat", numArray_lv);
    
    //console.log(formData);
    $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        //url: "../create_post",
        url: window.location.origin +"/whapi/create_post",
        type: 'POST',
        data: formData,
        success: function (result) {
            console.log(result);
            if(result['status'] == "ok")
            {
                $('input[name="new_post_id"]').val(result['id']);
                $('#PostModal').modal('hide');
                $('.modal-backdrop').remove();
                toastr.success('Successfuly Posted');
              //  $('#OtpModal').modal('show');
                //alert("successs");
                 var id = $('input[name="is_boost_clicked"]').val();
                 if(id == 0)
                    window.location = window.location.origin +"/whapi";
                //toastr.success('Success');
                }
                else if(result['status'] == "ok show otp")
            {
                $('#PostModal').modal('hide');
                $('.modal-backdrop').remove();
               
                $('#OtpModal').modal('show');
                //alert("successs");
                
                //toastr.success('Success');
                }
                
                
            else
            {
                if(type == "Broadcast")
                {   
                    
                     $( "#pm-message_bc" ).empty();
                    $('<span style="font-style:italic;color:red;">'+result+'</span>').appendTo('#pm-message_bc');
                   /* if(result == "Required: Location and Description")
                    {
                    $( "#pm-message_bc_loc" ).empty();
                    $( "#pm-message_bc_desc" ).empty();
                    $( "#pm-message_bc_cat" ).empty();
                    document.getElementById('pac-input-modal_bc').style.borderColor = "red";
                    $('<span style="font-style:italic;color:red;">Required</span>').appendTo('#pm-message_bc_loc');
                    $('<span style="font-style:italic;color:red;">Required</span>').appendTo('#pm-message_bc_desc');
                    }*/
                }else if(type == "Swap")    
                {    
                    $( "#pm-message_sw" ).empty();
                    $('<span style="font-style:italic;color:red;">'+result+'</span>').appendTo('#pm-message_sw');
                 }else if(type == "LocalVocal")     
                  {  
                      $( "#pm-message_lv" ).empty();
                      $('<span style="font-style:italic;color:red;">'+result+'</span>').appendTo('#pm-message_lv');
                  } 
            }
        },
        cache: false,
        processData: false,
        async: false,
       
        contentType: false,
    });
    
    return false;
    });
    
    $("form#Swap-form").submit(function(){

    var formData = new FormData($(this)[0]);
    //var type = $(".page_search_wrap_left_ul li.active").text();
    //var type = getCookie("post_type");
    
    var type = $("input[type='radio']:checked").val();
    if(type == "Broadcast")
    formData.append("cat", numArray_bc);
    else if(type == "Swap")
    formData.append("cat", numArray_sw);
    else if(type == "LocalVocal")
    formData.append("cat", numArray_lv);
    
    //console.log(formData);
    $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        //url: "../create_post",
        url: window.location.origin +"/whapi/create_post",
        type: 'POST',
        data: formData,
        success: function (result) {
            console.log(result);
            if(result['status'] == "ok")
            {
                $('#PostModal').modal('hide');
                $('.modal-backdrop').remove();
                toastr.success('Successfuly Posted');
              //  $('#OtpModal').modal('show');
                //alert("successs");
                window.location = window.location.origin +"/whapi";
                //toastr.success('Success');
                }
                else if(result['status'] == "ok show otp")
            {
                $('#PostModal').modal('hide');
                $('.modal-backdrop').remove();
               
                $('#OtpModal').modal('show');
                //alert("successs");
                
                //toastr.success('Success');
                }
                
                
            else
            {
                if(type == "Broadcast")
                {   
                    
                     $( "#pm-message_bc" ).empty();
                    $('<span style="font-style:italic;color:red;">'+result+'</span>').appendTo('#pm-message_bc');
                   /* if(result == "Required: Location and Description")
                    {
                    $( "#pm-message_bc_loc" ).empty();
                    $( "#pm-message_bc_desc" ).empty();
                    $( "#pm-message_bc_cat" ).empty();
                    document.getElementById('pac-input-modal_bc').style.borderColor = "red";
                    $('<span style="font-style:italic;color:red;">Required</span>').appendTo('#pm-message_bc_loc');
                    $('<span style="font-style:italic;color:red;">Required</span>').appendTo('#pm-message_bc_desc');
                    }*/
                }else if(type == "Swap")    
                {    
                    $( "#pm-message_sw" ).empty();
                    $('<span style="font-style:italic;color:red;">'+result+'</span>').appendTo('#pm-message_sw');
                 }else if(type == "LocalVocal")     
                  {  
                      $( "#pm-message_lv" ).empty();
                      $('<span style="font-style:italic;color:red;">'+result+'</span>').appendTo('#pm-message_lv');
                  } 
            }
        },
        cache: false,
        processData: false,
        async: false,
       
        contentType: false,
    });
    
    return false;
    });
    
     
    $("form#LocalVocal-form").submit(function(){

    var formData = new FormData($(this)[0]);
    //var type = $(".page_search_wrap_left_ul li.active").text();
    //var type = getCookie("post_type");
    
    var type = $("input[type='radio']:checked").val();
    if(type == "Broadcast")
    formData.append("cat", numArray_bc);
    else if(type == "Swap")
    formData.append("cat", numArray_sw);
    else if(type == "LocalVocal")
    formData.append("cat", numArray_lv);
    
    //console.log(formData);
    $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        //url: "../create_post",
        url: window.location.origin +"/whapi/create_post",
        type: 'POST',
        data: formData,
        success: function (result) {
            console.log(result);
            if(result['status'] == "ok")
            {
                $('#PostModal').modal('hide');
                $('.modal-backdrop').remove();
                toastr.success('Successfuly Posted');
              //  $('#OtpModal').modal('show');
                //alert("successs");
                window.location = window.location.origin +"/whapi";
                //toastr.success('Success');
                }
            else if(result['status'] == "ok show otp")
            {
                $('#PostModal').modal('hide');
                $('.modal-backdrop').remove();
               
                $('#OtpModal').modal('show');
                //alert("successs");
                
                //toastr.success('Success');
                }
                
                
            else
            {
                if(type == "Broadcast")
                {   
                    
                     $( "#pm-message_bc" ).empty();
                    $('<span style="font-style:italic;color:red;">'+result+'</span>').appendTo('#pm-message_bc');
                   /* if(result == "Required: Location and Description")
                    {
                    $( "#pm-message_bc_loc" ).empty();
                    $( "#pm-message_bc_desc" ).empty();
                    $( "#pm-message_bc_cat" ).empty();
                    document.getElementById('pac-input-modal_bc').style.borderColor = "red";
                    $('<span style="font-style:italic;color:red;">Required</span>').appendTo('#pm-message_bc_loc');
                    $('<span style="font-style:italic;color:red;">Required</span>').appendTo('#pm-message_bc_desc');
                    }*/
                }else if(type == "Swap")    
                {    
                    $( "#pm-message_sw" ).empty();
                    $('<span style="font-style:italic;color:red;">'+result+'</span>').appendTo('#pm-message_sw');
                 }else if(type == "LocalVocal")     
                  {  
                      $( "#pm-message_lv" ).empty();
                      $('<span style="font-style:italic;color:red;">'+result+'</span>').appendTo('#pm-message_lv');
                  } 
            }
        },
        cache: false,
        processData: false,
        async: false,
       
        contentType: false,
    });
    
    return false;
    });
    
    $("form#Pricing-form").submit(function(){
        $('input[name="is_boost_clicked"]').val(1);
         var type = $("input[type='radio']:checked").val();
    var form_name = type+"-form";
    $("#"+form_name).submit();
    window.scrollTo(0, 50);
    var id = $('input[name="new_post_id"]').val();
    
    if(id == "")
     window.scrollTo(0, 50);
    else
    boost_post_bc(id,type);
    //var formData = new FormData($(this)[0]);
    //var type = $(".page_search_wrap_left_ul li.active").text();
    //var type = getCookie("post_type");
    
    
    //console.log(formData);
  
    
    return false;
    });
    
    
     $("form#edit_post_bc").submit(function(){

    var formData = new FormData($(this)[0]);
    var type = $(".page_search_wrap_left_ul li.active").text();
    if(type == "Broadcast")
    formData.append("cat", edit_numArray_bc);
    /*else if(type == "Swap")
    formData.append("cat", numArray_sw);
    else if(type == "LocalVocal")
    formData.append("cat", numArray_lv);*/
    
    //console.log(formData);
    $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        url: "../editsave_post",
        type: 'POST',
        data: formData,
        success: function (result) {
            console.log(result);
            if(result == "Successfully Updated")
            {
                $('#EditPostModal_bc').modal('hide');
                $('.modal-backdrop').remove();
                window.location.reload();
               // $('#OtpModal').modal('show');
                //alert("successs");
                
                toastr.success('Success');
                }
            else
            {
                if(type == "Broadcast")
                {
                    $( "#pm-edit_message_bc" ).empty();
                    $('<span style="font-style:italic;color:red;">'+result+'</span>').appendTo('#pm-edit_message_bc');
                }
            }
        },
        cache: false,
        processData: false,
        async: false,
       
        contentType: false,
    });
    
    return false;
    });
    
    
    $("form#edit_post_sw").submit(function(){

    var formData = new FormData($(this)[0]);
    var type = $(".page_search_wrap_left_ul li.active").text();
    if(type == "Swap")
    formData.append("cat", edit_numArray_sw);
    /*else if(type == "Swap")
    formData.append("cat", numArray_sw);
    else if(type == "LocalVocal")
    formData.append("cat", numArray_lv);*/
    
    //console.log(formData);
    $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        url: "../editsave_post",
        type: 'POST',
        data: formData,
        success: function (result) {
            console.log(result);
            if(result == "Successfully Updated")
            {
                $('#EditPostModal_sw').modal('hide');
                $('.modal-backdrop').remove();
                window.location.reload();
               // $('#OtpModal').modal('show');
                //alert("successs");
                
                toastr.success('Success');
                }
            else
            {
                if(type == "Swap")    
                {    
                    $( "#pm-edit_message_sw" ).empty();
                    $('<span style="font-style:italic;color:red;">'+result+'</span>').appendTo('#pm-edit_message_sw');
                }
            }
        },
        cache: false,
        processData: false,
        async: false,
       
        contentType: false,
    });
    
    return false;
    });
    
    
    function edit_choose_category_bc(i)
    {
      //numArray[] = '';
      //console.log($(".quiz-answer.active").length);
      // console.log($(".quiz-answer.active").attr("data-answer"));
      //console.log($(".quiz-answer").attr("data-answer"));
      var num = i;
      var a = edit_numArray_bc.indexOf(num);
      if(a == -1){
       $("#cat_bc"+i).addClass("tick");
        edit_numArray_bc.push(num);
      }
     
      else
      {
      var index = edit_numArray_bc.indexOf(num);
      edit_numArray_bc.splice(index, 1);
      $("#cat_bc"+i).removeClass("tick");
      } 
      console.log("edit_numArray_bc: "+edit_numArray_bc);
      
    }
    function choose_category_bc(i)
    {
      //numArray[] = '';
      //console.log($(".quiz-answer.active").length);
      // console.log($(".quiz-answer.active").attr("data-answer"));
      //console.log($(".quiz-answer").attr("data-answer"));
      var num = i;
      var a = numArray_bc.indexOf(num);
      if(a == -1){
       $("#bc"+i).addClass("tick");
        numArray_bc.push(num);
      }
     
      else
      {
      var index = numArray_bc.indexOf(num);
      numArray_bc.splice(index, 1);
      $("#bc"+i).removeClass("tick");
      } 
      console.log("numArray_bc: "+numArray_bc);
      
    }
    
    function edit_choose_category_sw(i)
    {
      //numArray[] = '';
      //console.log($(".quiz-answer.active").length);
      // console.log($(".quiz-answer.active").attr("data-answer"));
      //console.log($(".quiz-answer").attr("data-answer"));
      var num = i;
      var a = edit_numArray_sw.indexOf(num);
      if(a == -1){
       $("#cat_sw"+i).addClass("tick");
        edit_numArray_sw.push(num);
      }
     
      else
      {
      var index = edit_numArray_sw.indexOf(num);
      edit_numArray_sw.splice(index, 1);
      $("#cat_sw"+i).removeClass("tick");
      } 
      console.log("edit_numArray_sw: "+edit_numArray_sw);
      
    }
    
    
    function choose_category_sw(i)
    {
      //numArray[] = '';
      //console.log($(".quiz-answer.active").length);
      // console.log($(".quiz-answer.active").attr("data-answer"));
      //console.log($(".quiz-answer").attr("data-answer"));
      var num = i;
      var a = numArray_sw.indexOf(num);
      if(a == -1){
       $("#sw"+i).addClass("tick");
        numArray_sw.push(num);
      }
     
      else
      {
      var index = numArray_sw.indexOf(num);
      numArray_sw.splice(index, 1);
      $("#sw"+i).removeClass("tick");
      } 
      console.log("NumArray_sw: "+numArray_sw);
      
    }
    
    function choose_category_lv(i)
    {
      //numArray[] = '';
      //console.log($(".quiz-answer.active").length);
      // console.log($(".quiz-answer.active").attr("data-answer"));
      //console.log($(".quiz-answer").attr("data-answer"));
      var num = i;
      var a = numArray_lv.indexOf(num);
      if(a == -1){
       $("#lv"+i).addClass("tick");
        numArray_lv.push(num);
      }
     
      else
      {
      var index = numArray_lv.indexOf(num);
      numArray_lv.splice(index, 1);
      $("#lv"+i).removeClass("tick");
      } 
      console.log("NumArray_lv: " +numArray_lv);
      
    }
    
    function show_registration_form()
    {
       //$("#PostModal").hide();  
        $('#PostModal').modal('toggle');
       $("#register_login_wrap").modal();  
        
    }
    
    function show_registration_login_form()
    {
       //$("#PostModal").hide();  
       // $('#PostModal').modal('toggle');
       $("#register_login_wrap").modal();  
        
    }
    
    
    function show_upload_dp_modal()
    {
      
       $("#upload_dp").modal();  
        
    }
    
     function navigate_create_post()
    {
        window.location = window.location.origin +"/whapi/createpost";
         $('#create_broadcast').show();
      $('#create_swap').hide();
      $('#create_localvocal').hide();
        
    }
    
    function show_login_form()
    {
       //$("#PostModal").hide();  
        
       $("#register_login_wrap").modal();  
        
    }
    
    
    function show_modal()
    {
     $(this).find("input,textarea,select").val('').end();   
     var type = $(".page_search_wrap_left_ul li.active").text();
     
     $("#PostModal").modal();
       $('#swap_area').hide();  
     if(type == "Broadcast")
      {
      
      $('#broadcast').show();
      $('#swap').hide();
      $('#localvocal').hide();
      }
      else if(type == "Swap")
      {
     
      $('#broadcast').hide();
      $('#swap').show();
      $('#localvocal').hide();
      }
      else if(type == "LocalVocal")
      {
     
      $('#broadcast').hide();
      $('#swap').hide();
      $('#localvocal').show();
      }
     
        
    }
    
    
    function report_post(post_id,type)
    {
         $('#r_type').val(type);
         $('#post_id').val(post_id);
         
         
         $('#report_area').hide();  
         $("#ReportPostModal").modal();
         
        
    }
    
    
    
    function follow_unfollow_user(user_id)
    {
   // var edit_numArray_bc = [];
     $.ajax({
        type: "GET",
        url: "../follow_unfollow_user",
        data: { 
            id: user_id,
         },
        success: function(result) {
         window.location.reload();  
         
        },
        error: function(result) {
            alert('error');
        }
    });
        
        return false;

    }
    
    function boost_post_bc(post_id_bc,type)
    {
      
      window.location='http://wannahelp.com/whapi/transaction?id='+post_id_bc+'&type='+type;
     
      

    }
    
    
     $("form#boost_post").submit(function(){

    var formData = new FormData($(this)[0]);
   // var type = $(".page_search_wrap_left_ul li.active").text();
   // if(type == "Broadcast")
   // formData.append("cat", edit_numArray_bc);
    /*else if(type == "Swap")
    formData.append("cat", numArray_sw);
    else if(type == "LocalVocal")
    formData.append("cat", numArray_lv);*/
    
    //console.log(formData);
    $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        url: "../boost_post",
        type: 'POST',
        data: formData,
        success: function (result) {
            console.log(result);
          
                $('#BoostPostModal_bc').modal('hide');
                $('.modal-backdrop').remove();
              
        },
        cache: false,
        processData: false,
        async: false,
       
        contentType: false,
    });
    
    return false;
    });
    
    
    function edit_post_bc(post_id_bc,type)
    {
   // var edit_numArray_bc = [];
     $.ajax({
        type: "GET",
        url: "../edit_post",
        data: { 
            //id: $(this).val(), // < note use of 'this' here
            id: post_id_bc,
           type:  type
           // location: location
        },
        success: function(result) {
           
         $("#EditPostModal_bc").modal();
         $('#edit_post_id_bc').val(post_id_bc);
         $(".modal-body #description_bc").val( result[0].description );
         $(".modal-body #pac-input-modal_bc_edit").val( result[0].location );
         
         //var cat = ;
         //row.split('|');
         var cat_array = result[0].cat_id.split(',');
        // console.log(cat_array);
         for(var i = 0; i < cat_array.length; i++)
         {
             cat_array[i] = parseInt(cat_array[i]);
             
             
            var num = cat_array[i];
            var a = edit_numArray_bc.indexOf(num);
            if(a == -1){
            $("#cat_bc"+i).addClass("tick");
            edit_numArray_bc.push(num);
           // edit_numArray_bc.push(cat_array[i]);
            }   
             
             
             $("#cat_bc"+cat_array[i]).addClass("tick"); 
         }
        // console.log(numArray_bc); 
         
         console.log("EDIT_NUMARRAY:" +edit_numArray_bc);
        // alert(result[0].description);
        },
        error: function(result) {
            alert('error');
        }
    });
        
        return false;

    }
    
    
    function edit_post_sw(post_id_sw,type)
    {
   // var edit_numArray_bc = [];
     $.ajax({
        type: "GET",
        url: "../edit_post",
        data: { 
            //id: $(this).val(), // < note use of 'this' here
            id: post_id_sw,
           type:  type
           // location: location
        },
        success: function(result) {
           
         $("#EditPostModal_sw").modal();
         $('#edit_post_id_sw').val(post_id_sw);
         $(".modal-body #caption_sw").val( result[0].title );
         $(".modal-body #description_sw").val( result[0].description );
         $(".modal-body #pac-input-modal_sw").val( result[0].location );
         
         //var cat = ;
         //row.split('|');
         var cat_array = result[0].cat_id.split(',');
        // console.log(cat_array);
         for(var i = 0; i < cat_array.length; i++)
         {
             cat_array[i] = parseInt(cat_array[i]);
             
             
            var num = cat_array[i];
            var a = edit_numArray_sw.indexOf(num);
            if(a == -1){
            $("#cat_sw"+i).addClass("tick");
            edit_numArray_sw.push(num);
           // edit_numArray_bc.push(cat_array[i]);
            }   
             
             
             $("#cat_sw"+cat_array[i]).addClass("tick"); 
         }
        // console.log(numArray_bc); 
         
         console.log("EDIT_NUMARRAY:" +edit_numArray_sw);
        // alert(result[0].description);
        },
        error: function(result) {
            alert('error');
        }
    });
        
        return false;

    }
    
    
    function edit_post_lv(post_id_lv,type)
    {
   // var edit_numArray_bc = [];
     $.ajax({
        type: "GET",
        url: "../edit_post",
        data: { 
            //id: $(this).val(), // < note use of 'this' here
            id: post_id_lv,
           type:  type
           // location: location
        },
        success: function(result) {
           
         $("#EditPostModal_lv").modal();
         $('#edit_post_id_lv').val(post_id_lv);
         $(".modal-body #description").val( result[0].description );
         $(".modal-body #pac-input-modal").val( result[0].location );
         
         //var cat = ;
         //row.split('|');
         var cat_array = result[0].cat_id.split(',');
        // console.log(cat_array);
         for(var i = 0; i < cat_array.length; i++)
         {
             cat_array[i] = parseInt(cat_array[i]);
             
             
            var num = cat_array[i];
            var a = edit_numArray_bc.indexOf(num);
            if(a == -1){
            $("#cat"+i).addClass("tick");
            edit_numArray_bc.push(num);
           // edit_numArray_bc.push(cat_array[i]);
            }   
             
             
             $("#cat"+cat_array[i]).addClass("tick"); 
         }
        // console.log(numArray_bc); 
         
         console.log("EDIT_NUMARRAY:" +edit_numArray_bc);
        // alert(result[0].description);
        },
        error: function(result) {
            alert('error');
        }
    });
        
        return false;

    }
    
    
  // NOT USED
    
    $('#post').click(function(e){ 
  
   // $('#PostModal').on('click','#post', function (e) {
        //var data = new FormData($("#swap-form")[0]);
        //alert(data);
        //var data = $('#swap-form').serialize();
        //var fd = new FormData($('form')[0]);
         //fd.append("date", '12121');
        //alert(JSON.stringify(fd));
       // for (var [key, value] of formData.entries()) { 
  //console.log(key, value);
//}
        //alert(JSON.stringify(formData));
        //alert(formData);
        // var formData = $(this).serialize();
        // console.log(formData);
        //console.log($('#pac-input-modal').val());
         //console.log($('#posttextarea').val());
         var desc = $('#posttextarea').val();
        var location = $('#pac-input-modal').val();
        var type = $('#type').val();
       // var photo = document.getElementById("input-b3");
        //console.log(photo);
        //var file = photo.files[0];
//console.log(file.fileName);
          //var input = $('#input-b3').val();
          //console.log(input.value);
        //var input = document.getElementById('#input-b3');
        //console.log(input.length);
        $.ajax({
        //type: "POST",
        url: "../create_post",
        processData: false,
        contentType: false,
        data: fd,
        //{ 
            //id: $(this).val(), // < note use of 'this' here
            //id: i,
           // type:  type,
            //location: location,
          //  desc:desc
       // },
        success: function(result) {
           
        if(result == "ok")
        {
        $('#PostModal').modal('hide');
        //alert("successs");
        }
        else
        {
            $( "#pm-message" ).empty();
            $('<span style="font-style:italic;color:red;">'+result+'</span>').appendTo('#pm-message');
        }
         
        
        
        
        },
        error: function(result) {
            alert('error');
        }
    });
         
         
        console.log(e);
    });
    
    if($.cookie("location") != "")
    {
        
     $('#open_location_selector').text($.cookie("location")); 
     $('#open_location_selector').append('&nbsp;&nbsp;<i aria-hidden="true" class="fa fa-chevron-down"></i>');
        $(".top_location_selector_bottom").html($.cookie("location")+' <i aria-hidden="true" class="fa fa-chevron-up"></i>');
     
    }
    
    function getlocation(i)
   {
       
      // alert(i);
       $('#top_location_selector').slideUp();
       $('#open_location_selector').text(i);
       $('#open_location_selector').append('&nbsp;&nbsp;<i aria-hidden="true" class="fa fa-chevron-down"></i>');
        $(".top_location_selector_bottom").html(i+' <i aria-hidden="true" class="fa fa-chevron-up"></i>');
       change_location("clicked");

   }
    
  /* function initialize() {
        var input = document.getElementById('pac-input1');
        var options = {
            types: ['(cities)'],
            componentRestrictions: {country: "in"}
        };
         var autocomplete = new google.maps.places.Autocomplete(input,options);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    
    
    function initialize() {
    var input = document.getElementById('pac-input');
    var options = {
        //types: ['(cities)'],
        componentRestrictions: {country: "in"}
    };
    var autocomplete = new google.maps.places.Autocomplete(input,options);
    
    }
    google.maps.event.addDomListener(window, 'load', initialize); */
    
    var input = document.getElementById('pac-input-tp');
   /* var options1 = {
        types: ['(regions)'],
        componentRestrictions: {country: "in"}
     };*/
    
    var autocomplete_tp = new google.maps.places.Autocomplete(input);
    /*
    var place = autocomplete1.getPlace();
   
   var lat = place.geometry.location.lat();
    var long  = place.geometry.location.lng();
     */
    var input1 = document.getElementById('pac-input-settings');
     var options1 = {
        //types: ['cities'],
        //componentRestrictions: {country: "in"}
     };
    var autocomplete = new google.maps.places.Autocomplete(input1,options1);
 
    /*var input= document.getElementById('pac-input-btm');
    var autocomplete = new google.maps.places.Autocomplete(input);*/
    
    var input_bc= document.getElementById('pac-input-modal_bc');
    var autocomplete_bc = new google.maps.places.Autocomplete(input_bc);
    
    
     var input= document.getElementById('pac-input-modal_sw');
    var autocomplete = new google.maps.places.Autocomplete(input);
    
     var input= document.getElementById('pac-input-modal_lv');
    var autocomplete = new google.maps.places.Autocomplete(input);
   
    
    
    
    //var autocomplete = new google.maps.places.Autocomplete(input); 
    var input_sw= document.getElementById('pac-input-modal_sw');
    var autocomplete_sw = new google.maps.places.Autocomplete(input_sw); 
    var input_lv= document.getElementById('pac-input-modal_lv');
    var autocomplete_lv = new google.maps.places.Autocomplete(input_lv); 
    
  
   $("#pac-input-btm").bind("change paste keyup", function() {
  // alert($(this).val()); 
});
   
  // $("button").click(function(e) {
  
  $("#searchclear").click(function(){
    $("#pac-input-tp").val('');
    change_location("clicked");
     document.getElementById("open_location_selector").text = 'Select city';
     $(".top_location_selector_bottom").html('Select City&nbsp;&nbsp;<i aria-hidden="true" class="fa fa-chevron-up"></i>'); 
    });
    
     $("#searchenter").click(function(){
    //$("#pac-input-tp").val('');
    var tb = document.getElementById("pac-input-tp");
    var location =  tb.value;  
    
    if(location == "")
    return 1; 
    
    change_location("clicked");
     document.getElementById("open_location_selector").text = location;
     $('#open_location_selector').append('&nbsp;&nbsp;<i aria-hidden="true" class="fa fa-chevron-down"></i>');
     $(".top_location_selector_bottom").html(location+'&nbsp;&nbsp;<i aria-hidden="true" class="fa fa-chevron-up"></i>'); 
      $(".top_location_selector_bottom").click();
    });
  
  
  
  function clear_keyword()
  {
      
  $("#pac-input-btm").val('');
   change_keyword('');
  }
  
  
  function change_search_text(e) {
    if (e.keyCode == 13 || e == "clicked") {
        
         var type = $(".page_search_wrap_left_ul li.active").text();
       document.cookie = "changed_type="+type;
       
        var tb = document.getElementById("pac-input-btm");
       change_keyword(tb.value);
      //alert("dewqrqr");
        return false;
    }
}

function change_location(e) {
    
    $("#iconsdiv").empty();
    
    if (e.keyCode == 13 || e == "clicked") {
        
        if(e == "clicked" )
        {
            
         var tb = document.getElementById("pac-input-tp");
    var location =  tb.value;    
     document.cookie = "location="+location;       
    //var loc  = $("#open_location_selector").text().trim();        
    //document.cookie = "location="+loc;
    }
    else
    {
    var tb = document.getElementById("pac-input-tp");
    var location =  tb.value;
   
    
    if(location.trim() == "")
    document.getElementById("open_location_selector").text = "Select city";
    else
    document.getElementById("open_location_selector").text =  location.trim();
    
    $('#open_location_selector').append('&nbsp;&nbsp;<i aria-hidden="true" class="fa fa-chevron-down"></i>');
    $(".top_location_selector_bottom").html (location.trim());
    $(".top_location_selector_bottom").click();
    document.cookie = "location="+tb.value;
    }
     document.cookie = "page_bc=1";
      document.cookie = "page_sw=1";
      document.cookie = "page_lv=1";
        var i = getCookie("cat");
     // alert(getCookie("location"));
      var type = $(".page_search_wrap_left_ul li.active").text();
         
       //if(type == "Broadcast")
        //{
        //page_bc++; //page number increment
        load_more(getCookie("page_bc"),'Broadcast',i,getCookie("keyword"),getCookie("location"),getCookie("distance"));
        //load_more(getCookie("page_bc"),'Broadcast',i,getCookie("keyword"),getCookie("location")); //load content  
        //var page = parseInt(getCookie("page_bc"));
        //page = page + 1;
       // document.cookie = "page_bc="+ page;
            
        //}
       // if(type == "Swap")
        //{
        //page_sw_cat++; //page number increment
        
        load_more(getCookie("page_sw"),'Swap',i,getCookie("keyword"),getCookie("location")); //load content  
          //var page = parseInt(getCookie("page_sw"));
        //}
        //if(type == "LocalVocal")
       // {
        //page_lv_cat++; //page number increment
        load_more(getCookie("page_lv"),'LocalVocal',i,getCookie("keyword"),getCookie("location")); //load content   
        //}
       
       $("#results").empty();
       $("#waterfall_content").empty();
       $("#results_lv").empty();
       
    return false;
    }
}
  
  
  function change_keyword(tb)
   {
       
      //var location =$("#pac-input-btm").val();
      //alert(tb+ 'Cat: '+getCookie("cat"));
      //var type = $(".page_search_wrap_left_ul li.active").text();
      var i = getCookie("cat");
      document.cookie = "cat="+i;
      document.cookie = "keyword="+tb;
      //alert(document.cookie);
     // alert(getCookie("cat"));
     // var x = alert(document.cookie);
     
      document.cookie = "page_bc=1";
      document.cookie = "page_sw=1";
      document.cookie = "page_lv=1";
      
    /* var page_bc_cat = 1;
      var page_sw_cat = 1;
      var page_lv_cat = 1;*/
       var type = $(".page_search_wrap_left_ul li.active").text();
         
       if(type == "Broadcast")
        {
        //page_bc++; //page number increment
        $("#results").empty();
        load_more(getCookie("page_bc"),'Broadcast',i,getCookie("keyword"),getCookie("location"),getCookie("distance"));
       // load_more(getCookie("page_bc"),'Broadcast',i,getCookie("keyword"),getCookie("location")); //load content  
        //var page = parseInt(getCookie("page_bc"));
        //page = page + 1;
       // document.cookie = "page_bc="+ page;
            
        }
        if(type == "Swap")
        {
            $("#waterfall_content").empty();
        //page_sw_cat++; //page number increment
        load_more(getCookie("page_sw"),'Swap',i,getCookie("keyword"),getCookie("location")); //load content  
          //var page = parseInt(getCookie("page_sw"));
        }
        if(type == "LocalVocal")
        {
            $("#results_lv").empty();
        //page_lv_cat++; //page number increment
        load_more(getCookie("page_lv"),'LocalVocal',i,getCookie("keyword"),getCookie("location")); //load content   
        }
       
       //$("#results").empty();
       //$("#waterfall_content").empty();
       //$("#results_lv").empty();
    
      
   }
   
  function show_login_phone_modal()
  {
       $('#register_login_wrap').modal('toggle');
        $('.modal-backdrop').remove();
         $('#LoginPhone').modal('show');
        
      
  }
   
   function register_mobile()
   {
       
        $('#register_login_wrap').modal('toggle');
        $('.modal-backdrop').remove();
        $('#register_mobile_wrap').show();
       
       //alert("reg_mobile");
       
   }
   
   function get_otp1()
   {
       return 1;
    //var formData = new FormData($(this)[0]);
  //  var uname = $("#username").val();
    var fname = $("#firstname").val();
    var lname =  $("#lastname").val();
    var email = $("#email").val();
    var password = $("#password").val();
     var mobile = $("#mobilenumber").val();
      
        //console.log(formData);
        $.ajax({
            
           url: "../get_otp",
           type: 'GET',
            
            contentType: false,
            data: {
               // username: uname,
                firstname: fname,
                lastname:  lname,
                mobile: mobile, // < note use of 'this' here
                password: password
            },
            success: function (result) {
               console.log(result);
                
            },
            
        });
        
        //return false;
   }
   
  
   function register()
    {
        
    //var formData = new FormData($(this)[0]);
    var uname = $("#username").val();
    var mobile = $("#mobile_number").val();
    var email = $("#email").val();
    var password = $("#password").val();
    //alert(mobile);
       // console.log(email);
        //console.log(password);
        //formData.append("cat", numArray_bc);
  
    
        //console.log(formData);
        $.ajax({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
             
            
              url: window.location.origin +"/whapi/register",
           // type: 'POST',
            
            contentType: false,
            data: {
                username: uname,
                mobile: mobile,
                email: email, // < note use of 'this' here
                password: password
            },
            success: function (result) {
                if(result == "Success")
                {
                    $('#register_login_wrap').modal('toggle');
                    // $("#register_login_wrap").hide();
                    $('.modal-backdrop').remove();
                    
                    $('#OtpModal').modal('show');
                    //window.location.reload();
                   // toastr.success("Registration Successful, Kindly verify the email");
                    //console.log(result);
                }
                else if(result == "Success but no mail")
                {
                    
                    $('#register_login_wrap').modal('toggle');
                    // $("#register_login_wrap").hide();
                    $('.modal-backdrop').remove();
                    window.location.reload();
                    toastr.warning("Registration Successful, But Verification email is not able to sent");   
                    
                    
                }
                else if(result == "Error")
                {
                    toastr.error("Error, Try Later");   
                    $('#register_login_wrap').modal('toggle');
                    // $("#register_login_wrap").hide();
                    $('.modal-backdrop').remove();
                    window.location.reload();

                }
                else
                {
                     $( "#message_register" ).empty();
                     $('<span style="font-style:italic;color:red;"><br>'+result+'<br></span>').appendTo('#message_register');
                }
                
            },
            
        });
        
        return false;
        
    }
   
   
   function login()
    {
    

        //var formData = new FormData($(this)[0]);
        var email = $("#my-email").val();
         var password = $("#my-password").val();
       // console.log(email);
        //console.log(password);
        //formData.append("cat", numArray_bc);
  
    
        //console.log(formData);
        $.ajax({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
             
            url: "login",
           // type: 'POST',
            
            contentType: false,
            data: { 
                email: $("#my-email").val(), // < note use of 'this' here
                password: $("#my-password").val()
            },
            success: function (result) {
                  $('#register_login_wrap').modal('toggle');
                // $("#register_login_wrap").hide();
                $('.modal-backdrop').remove();
                window.location.reload();
                $("#PostModal").show();
                 
                //console.log(result);
                
            },
            
        });
        
        return false;
        
    }
  
  
    
    
//});

function upload_cover()
{
    
 $("#upload_cover").modal();   
}


// Avoids collision during upload profile pic and cover pic
$(".timeline-cover a").click(function(e) {
  
   e.stopPropagation();
})
document.cookie = "cat=1";
document.cookie = "page_bc=1";
document.cookie = "page_sw=1";
document.cookie = "page-lv=1";
document.cookie = "keyword=";
//var page_bc = 1;
//var page_sw = 1;
//var page_lv = 1;//track user scroll as page number, right now page number is 1
var type = $(".page_search_wrap_left_ul li.active").text();
var loc = $( "#open_location_selector" ).text();
document.cookie = "location="+loc.trim();

if(getCookie("active_tab") == "tab_broadcast")
$('.nav-pills a[href="#tab_broadcast"]').tab('show');
else if(getCookie("active_tab") == "tab_swap")
$('.nav-pills a[href="#tab_swap"]').tab('show');
else if(getCookie("active_tab") == "tab_localvocal")
$('.nav-pills a[href="#tab_localvocal"]').tab('show');
 


//alert(document.cookie);
load_more(getCookie("page_bc"),"Broadcast",1,'',getCookie("location")); //initial content load
load_more(getCookie("page_bc"),"Swap",1,'',getCookie("location"));
load_more(getCookie("page_bc"),"LocalVocal",1,'',getCookie("location"));
$(window).scroll(function() { //detect page scroll

//var i = 1;
//alert($.cookie('i'));
    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
       // alert("aweqe");
        var type = $(".page_search_wrap_left_ul li.active").attr('datax');
        //var type = $(".page_search_wrap_left_ul li.active").text();
        //if user scrolled from top to bottom of the page
        if(type == "Broadcast")
        {
        
        var page = parseInt(getCookie("page_bc"));
        page =  page+1;
        document.cookie = "page_bc="+ page;
        //page_bc++; //page number increment
        load_more(getCookie("page_bc"),'Broadcast',getCookie("cat"),getCookie("keyword"),getCookie("location"),getCookie("distance"));
       // load_more(getCookie("page_bc"),'Broadcast',getCookie("cat"),getCookie("keyword"),getCookie("location")); //load content   
        }
        if(type == "Swap")
        {
        var page = parseInt(getCookie("page_sw"));
        page =  page+1;
        document.cookie = "page_sw="+ page;
        //page_sw++; //page number increment
        load_more(getCookie("page_sw"),'Swap',getCookie("cat"),getCookie("keyword"),getCookie("location")); //load content   
        }
        if(type == "LocalVocal")
        {
        var page = parseInt(getCookie("page_lv"));
        page =  page+1;
        document.cookie = "page_lv="+ page;
        //page_lv++; //page number increment
        load_more(getCookie("page_lv"),'LocalVocal',getCookie("cat"),getCookie("keyword"),getCookie("location")); //load content   
        }
    }
}); 
// i - category

function load_more(page,p_type,i,keyword,location,distance=''){
    if(p_type == "")
     var type = $(".page_search_wrap_left_ul li.active").text();
     else
     {type = p_type;}
  $.ajax(
        {
            url: '?page=' + page,
            type: "get",
            datatype: "html",
            data:{
                type:  type,
                cat : i,
                keyword : keyword,
                location : location,
                distance : distance
                
            },
            beforeSend: function()
            {
                if(type == "Broadcast")   
                {
                //notify user if nothing to load
                $('.ajax-loading-bc').show();
                }
                if(type == "Swap")   
                {
                //notify user if nothing to load
                $('.ajax-loading-sw').show();
                }
                if(type == "LocalVocal")   
                {
                //notify user if nothing to load
                $('.ajax-loading-lv').show();
                }
            }
        })
        .done(function(data)
        {
            if(data.length == 0){
            console.log(data.length);
            if(type == "Broadcast")   
            {
            //notify user if nothing to load
            
            var check =  $('.ajax-loading-sw').html();
            
            
            if(page==1 )
             $('.ajax-loading-bc').html("No Results. Change Keyword or City for better results!");
            else
            $('.ajax-loading-bc').html("End of Results!");
            }
            if(type == "Swap" )   
            {
            if(page==1 || check == "<b>No Results. Change Keyword or City for better results! </b>")
            $('.ajax-loading-sw').html("<b>No Results. Change Keyword or City for better results! </b>");
            else
            //notify user if nothing to load
            $('.ajax-loading-sw').html("End of Results!");
            }
            if(type == "LocalVocal")   
            {
            if(page==1)
            $('.ajax-loading-lv').html("<b>No Results. Change Keyword or City for better results! </b>");
            else
            //notify user if nothing to load
            $('.ajax-loading-lv').html("End of Results!");
            }
            return;
            
            }
            
           
            if(type == "Broadcast")
            {
            $('.ajax-loading-bc').hide(); //hide loading animation once data is received
           
            $("#results").append(data);
           // $("#results").html(data);
            }
            if(type == "Swap")
            {
            $('.ajax-loading-sw').hide();
            $("#waterfall_content").append(data);//append data into #results element   
            }
            if(type == "LocalVocal")
            {
            $('.ajax-loading-lv').hide();
            $("#results_lv").append(data);
            }
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
              //alert('No response from server');
        });
 }
 
 function change_category(i)
  {
      
      document.cookie = "cat="+i;
        
     //  alert(getCookie("cat"));
     // var x = alert(document.cookie);
     
      document.cookie = "page_bc=1";
      document.cookie = "page_sw=1";
      document.cookie = "page_lv=1";
      
    /* var page_bc_cat = 1;
      var page_sw_cat = 1;
      var page_lv_cat = 1;*/
       var type = $(".page_search_wrap_left_ul li.active").attr('datax');
         
       if(type == "Broadcast")
        {
        //page_bc++; //page number increment
        load_more(getCookie("page_bc"),'Broadcast',i,getCookie("keyword"),getCookie("location"),getCookie("distance"));
        //load_more(getCookie("page_bc"),'Broadcast',i,getCookie("keyword"),getCookie("location")); //load content  
        //var page = parseInt(getCookie("page_bc"));
        //page = page + 1;
       // document.cookie = "page_bc="+ page;
            
        }
        if(type == "Swap")
        {
        //page_sw_cat++; //page number increment
        load_more(getCookie("page_sw"),'Swap',i,getCookie("keyword"),getCookie("location")); //load content  
          //var page = parseInt(getCookie("page_sw"));
        }
        if(type == "LocalVocal")
        {
        //page_lv_cat++; //page number increment
        load_more(getCookie("page_lv"),'LocalVocal',i,getCookie("keyword"),getCookie("location")); //load content   
        }
       
       $("#results").empty();
       $("#waterfall_content").empty();
       $("#results_lv").empty();
    
     for(var j=1;j<=9;j++)
     {
       $(".cat_img_wrap #cat"+j).removeClass("tick");   
         
     }
     $(".cat_img_wrap #cat"+i).addClass("tick"); 
   var type = $(".page_search_wrap_left_ul li.active").text();
    $.cookie('type', type);
    
    
    
   // var location =$("#pac-input-btm").val();
    //alert($.cookie('type'));
    //e.preventDefault();
    //console.log($(this).val());
    /*
    $.ajax({
        type: "GET",
        url: "show_selected_category",
        data: { 
            //id: $(this).val(), // < note use of 'this' here
            id: i,
            type:  $.cookie('type')
        },
        success: function(result) {
           
           if(type=="Broadcast")
                update_broadcast(result);
           else if(type=="Swap")
                update_swap(result);
           else if(type=="LocalVocal")
                update_localvocal(result);
           
        },
        error: function(result) {
            alert('error');
        }
    });*/
  }
 
 function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
 
 
function update_broadcast(result)
{
    var bc_tagstring = '';
    for (var i = 0; i < result.length; i++) 
    {
    bc_tagstring += '<div class="btm_user_listing_wrap">';                    
    bc_tagstring += '<div class="btm_user_listing">';
    bc_tagstring += '<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">';
    bc_tagstring += '<div class="wh_profile_pic_btm">';
    bc_tagstring += '<span class="wh_profile_pic_top_active">';
    bc_tagstring += '<i class="fa fa-circle"></i>';
    bc_tagstring += '</span>';
    bc_tagstring += '<img src="public/images/profile.png">';
    bc_tagstring += '</div>';
    bc_tagstring += '<p class="distance"></p>';
    bc_tagstring += '</div>';
    bc_tagstring += '<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">';
    bc_tagstring += '<div class="wh_name_btm">';
    bc_tagstring += '<p><i class="fa fa-diamond" aria-hidden="true" style="color: #3cc0c7;"></i><a target="_blank" href="{{(new \App\Http\Controllers\Helper)->get_url()}}/user/'+result[i].user_id+'">&nbsp;'+ result[i].name+'</p>';
    bc_tagstring += '</div>';
    bc_tagstring += '<div class="wh_brdcast_btm">';
    bc_tagstring += result[i].description;
    bc_tagstring += '</div>';
    bc_tagstring += '</div>';
    bc_tagstring += '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">';
    bc_tagstring += '<button class="btn btn-chat-btm pull-right col-lg-12 col-md-12 col-sm-12 col-xs-12">CHAT</button>';
    bc_tagstring += '<div class="clearfix"></div>';
    bc_tagstring += '</div>';
    
    bc_tagstring += '<div class="clearfix"></div>';
    bc_tagstring += '</div>';
    bc_tagstring += '<div class="clearfix"></div>';
    bc_tagstring += '</div>';
    }
    $( ".broadcast_content" ).empty();
    $(".broadcast_content").append(bc_tagstring);
}


    function update_swap(result)
    {
        console.log(result);
    //$('#waterfall').NewWaterfall();  
    var sw_tagstring = '';
    sw_tagstring += '<ul id="waterfall_updated" style="list-style:none">';
    for (var i = 0; i < result.length; i++) 
    {
    sw_tagstring +='<li>';
    //console.log(result[i].name);
    sw_tagstring +='<div class="swap_list_item sw_normal_item">';
    sw_tagstring +='<div class="swap_list_item_top">';
    
    
    if(result[i].for_price!=null && result[i].for_goods!=null)
    {
    sw_tagstring +='<span class="price_tag">Rs.'+ result[i].for_price +' or '+ result[i].for_goods +'</span>';
    }
    else if(result[i].for_price!=null && result[i].for_goods==null)
    {
      sw_tagstring +='<span class="price_tag">Rs.'+ result[i].for_price +'</span>';   
        
    }
     if(result[i].for_price==null && result[i].for_goods!=null)
    {
    sw_tagstring +='<span class="price_tag">'+ result[i].for_goods +'</span>';
    }
    
    
    
    //sw_tagstring +='<img src="public/images/mobile2.png">';
    //sw_tagstring +='<img src="public/images/mobile2.png">';
    
     sw_tagstring +='<img src="{{(new \App\Http\Controllers\Helper)->get_swap_image_loc()}}'+result[i].image+'" alt="">';
                                            
    
    sw_tagstring +='</div>';
    sw_tagstring +='<div class="swap_list_item_btm">';
    sw_tagstring +='<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 swap_prof_pic_wrap">';
    sw_tagstring +='<span class="swap_prof_online_batch"><i class="fa fa-circle"></i></span>';
    sw_tagstring +='<img src="public/images/profile.png">';
    sw_tagstring +='<p>'+result[i].location+'</p>';
    sw_tagstring +='</div>';
    sw_tagstring +='<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 swap_title_wrap">';
    sw_tagstring +='<h4><a target="_blank" href="{{(new \App\Http\Controllers\Helper)->get_url()}}/swap/'+result[i].swap_id+'">'+result[i].title+'</a></h4>';
    sw_tagstring +='<p>'+result[i].ago+'</p>';
    sw_tagstring +='</div>';
    sw_tagstring +='<div class="clearfix"></div>';
    sw_tagstring +='</div>';
    sw_tagstring +='</div>';
    
    sw_tagstring +='</li>';
    }
    sw_tagstring +='</ul>'; 
    $( ".swap_content" ).empty();
    $(".swap_content").append(sw_tagstring);
    $("#waterfall_content").slideUp();
   // $('#waterfall_updated').NewWaterfall();
    $('#waterfall_updated').NewWaterfall();
       
   }
   
   
   function update_localvocal(result)
   {
       
    var lv_tagstring = '';
   // console.log(result);
    for (var i = 0; i < result.length; i++) 
    {
    lv_tagstring += '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">';
    lv_tagstring += '<div class="lv_post_list">';
    lv_tagstring += '<div class="lv_post_list_top">';
    lv_tagstring += '<div class="col-lg-10 col-md-10 col-sm-10 col-xs-8 lv_post_name">';
    lv_tagstring += '<img src="public/images/profile.png">&nbsp;&nbsp;'+result[i].name;
    lv_tagstring += '</div>';
    lv_tagstring += '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 lv_post_time">';
    lv_tagstring += result[i].ago;
    lv_tagstring += '</div>';
    lv_tagstring += '<div class="clearfix"></div>';
    lv_tagstring += '</div>';
    lv_tagstring += '<div class="lv_post_list_thumb">';
    lv_tagstring += '<img src="{{(new \App\Http\Controllers\Helper)->get_lv_image_loc()}}'+result[i].image+'">';
    lv_tagstring += '</div>';
    lv_tagstring += '<div class="lv_post_list_text">';
    lv_tagstring += result[i].description;
    lv_tagstring += '</div>';
    
    if(result[i].total_comments[0].count == 0)
    {
    lv_tagstring += '<div class="lv_post_list_view_cmts">';
    lv_tagstring += 'no comments yet';
    lv_tagstring += '</div>';
    }
    else
    {
    lv_tagstring += '<div class="lv_post_list_view_cmts">';
    lv_tagstring += 'View all ' + result[i].total_comments[0].count +' comments';
    lv_tagstring += '</div>';
    }
   /* lv_tagstring += '<div class="lv_post_list_cmts_wrap">';
    lv_tagstring += '<div class="lv_post_list_cmts_list">';
    lv_tagstring += '<span class="cmts_name">Dre Parker</span>&nbsp;&nbsp;';
    lv_tagstring += '<span class="cmts_text">Around 53 companies of the paramilitary forces and 50,000 personnel of the Haryana Police have also been deployed in view of law and order situation in Haryana and Punjab.</span>';
    lv_tagstring += '</div>';
    lv_tagstring += '</div>';*/
    lv_tagstring += '<div class="lv_post_list_btm">';
    lv_tagstring += '<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 lv_post_like">';
    lv_tagstring += '<i class="fa fa-heart"></i>&nbsp;&nbsp;12k';
    lv_tagstring += '</div>';
    lv_tagstring += '<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 lv_post_cmt">';
    lv_tagstring += '<i class="fa fa-comment-o" aria-hidden="true"></i>&nbsp;&nbsp;2k';
    lv_tagstring += '</div>';
    lv_tagstring += '<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 lv_post_share">';
    lv_tagstring += '<i class="fa fa-share" aria-hidden="true"></i>';
    lv_tagstring += '</div>';
    lv_tagstring += '<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 pull-right lv_post_morebtns">';                                    
    lv_tagstring += '<div class="dropdown">';
    lv_tagstring += '<button class="btn" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>';
    lv_tagstring += '<ul class="dropdown-menu">';
    lv_tagstring += '<li><a href="#">Report</a></li>';              
    lv_tagstring += '</ul>';
    lv_tagstring += '</div>';
    
    lv_tagstring += '</div>';
    lv_tagstring += '<div class="clearfix"></div>';
    lv_tagstring += '</div>';
    lv_tagstring += '<div class="clearfix"></div>';
    lv_tagstring += '</div>';
    
    lv_tagstring += '</div>';
   }   
    $( ".localvocal_content" ).empty();
    $(".localvocal_content").append(lv_tagstring);   
       
       
   }
   
  
    
    $("input[name$='types']").click(function() {
        var type = $(this).val();

       if(type == "Broadcast")
      {
      document.cookie = "post_type="+type;          
      $('#create_broadcast').show();
      $('#create_swap').hide();
      $('#create_localvocal').hide();
      }
      else if(type == "Swap")
      {
      document.cookie = "post_type="+type;    
      $('#create_broadcast').hide();
      $('#swap_area').hide(); 
      $('#create_swap').show();
      $('#create_localvocal').hide();
      }
      else if(type == "LocalVocal")
      {
      document.cookie = "post_type="+type;    
      $('#create_broadcast').hide();
      $('#create_swap').hide();
      $('#create_localvocal').show();
      }
    });
    
    $("input[name$='r_types']").click(function() {
    

      
      $('#report_area').show();
      
    
      
    });
    
    /*
    Description: Create Post Modal. 
                 Sell for Price and Goods will be shown or hidden
    
    */
     $("input[name$='swap_option']").click(function() {
    

      if ($(this).val() == 'Product/Price') 
            $('#swap_area').show();
      else
      $('#swap_area').hide();
      
    });
    
    
    function trash(id)
    
    {
        
        //alert(id);
        $("#"+id).remove();
        
    }
    
    $('#plan_type').change(function() {
    if (this.value == 'basic') {
        $('#validity1').html('1 Week');
        $('#credits').html('1');
        $('#amount').html('199');
        $('#total_amount').val('199');
        $('#udf1').val('Basic');
        $('#plan_coupon_code').val('Basic');
        //alert(this.value);
        $('#display_bt2').show();
    } else if (this.value == 'platinum') {
        $('#validity1').html('1 Month');
        $('#credits').html('20');
        $('#amount').html('999');
        $('#display_bt1').show();
        $('#total_amount').val('999');
        $('#udf1').val('Platinum');
        $('#plan_coupon_code').val('Platinum');
    }
    else if (this.value == 'premium') {
        $('#validity1').html('3 Weeks');
        $('#credits').html('3');
        $('#amount').html('399');
        $('#display_bt1').show();
        $('#total_amount').val('399');
        $('#udf1').val('Premium');
        $('#plan_coupon_code').val('Premium');
    }
});

    function use_credits(id,plan_name)
   {
       
       alert(id);
       
        $.ajax({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
             
            url: window.location.origin +"/whapi/use_credit",
           //type: 'POST',
            
            contentType: false,
            data: { 
                post_id: id,
                plan_name: plan_name,
               // comment:comment 
            },
            success: function (result) {
           
             window.location = window.location.origin +"/whapi";
           
            },
            
        });
        
        
     //   return false;
       
   }
   function savecomment(e,id) {
    if (e.keyCode == 13) {
        var tb = document.getElementById("cmt_LV"+id);
        var comment  = tb.value;
        var post_id = "LV"+id;
        
          $.ajax({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
             
            url: window.location.origin +"/whapi/save_comment",
           //type: 'POST',
            
            contentType: false,
            data: { 
                post_id: post_id,
                comment:comment 
            },
            success: function (result) {
                // $("#"+ post_id).append('<div class="lv_post_list_cmts_list"> <span class="cmts_name">'+result+' </span>&nbsp;&nbsp;<span class="cmts_text">'+comment+'</span> </div>');
             var tag_string ='';
             tag_string += '<div class="post-comment" style="display:inline-flex;margin: 10px auto;">';
             
             
            if(result['image'] == "default")
            tag_string += '<img style="margin-right: 10px;" src="http://placehold.it/300x300" alt="" class="profile-photo-sm" />';
            else
             tag_string +='<img style="margin-right: 10px;" src="'+result['image']+'" alt="" class="profile-photo-sm" />';
             
             tag_string +='<p><a href="timeline.html" class="profile-link">'+result['name']+' </a>'
             
             tag_string +='<i class="em em-laughing"></i> '+comment+' </p> </div><br/></div>';
             
             $("#"+ post_id).append(tag_string);
             $("#"+ post_id).show();
             document.getElementById("cmt_LV"+id).value = "";
                /*$("#"+ post_id).append('<div class="post-comment" style="display:inline-flex;margin: 10px auto;"><img style="margin-right: 10px;" src="http://placehold.it/300x300" alt="" class="profile-photo-sm" /><p><a href="timeline.html" class="profile-link">'+result+' </a><i class="em em-laughing"></i> '+comment+' </p> </div><br/></div>');*/
            },
            
        });
        
        
        return false;
    }
}

function make_bc_current(id) {
    
    
     $.ajax({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
             
             url: window.location.origin +"/whapi/make_bc_current",
           //type: 'POST',
            
            contentType: false,
            data: { 
               broadcast_id: id,
               // comment:comment 
            },
            success: function (result) {
            
            window.location.reload();
            },
            
        });
   
}
   
  
  window.setInterval(function(){
  console.log("Running");
  var notification_counter=0;
   $.ajax({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
             
             url: window.location.origin +"/whapi/check_noti",
           //type: 'POST',
            
            contentType: false,
            data: { 
               // post_id: post_id,
               // comment:comment 
            },
            success: function (result) {
                //console.log(result.count);
                if(result.count!=0)
                {
                    if(notification_counter!=result.count)
                    {
                        notification_counter=result.count;
                       // open_chat_latest(1824510364648,2,'TA1824302012224FN');
                    }
                    $("#number_of_notif").text(result.count);
                }
            $('<div class="line"></div><li><span style="color:  white;font-size:  12px;"><center>'+result[0].message+'</center></span></li>').prependTo('#notifications');
               // alert(result);
            },
            
        });
  
  
 
}, 250000);





function show_comments(id)
{
    var lv_id = "LV"+id;
    //alert(lv_id);
    
    
    var check_shown = document.getElementById(lv_id).style.display;
    
    if(check_shown == "none")
    {
        
    $('#'+lv_id).css('display','block');
    }
    else
    {
    $('#'+lv_id).css('display','none');
   
    }
}
    
    
    function like_unlike_lv(id)
    {
        
     var lv_id = "LV"+id;
     
     
     $.ajax({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
             
            url: window.location.origin +"/whapi/like_unlike_lv",
           //type: 'POST',
            
            contentType: false,
            data: { 
                lv_id: lv_id,
                 
            },
            success: function (result) {
                $(".lv_post_like"+ lv_id).empty();
                if(result.status == "liked")
                {
                 $(".lv_post_like"+ lv_id).append('<i style="color:#ed474f !important" class="fa fa-heart"></i>&nbsp;&nbsp '+ result.likes_count);
                }
                else 
                {
                 
                  $(".lv_post_like"+ lv_id).append('<i style="color:unset !important" class="fa fa-heart"></i>&nbsp;&nbsp '+ result.likes_count);
                }
                // $("#"+ post_id).append('<div class="lv_post_list_cmts_list"> <span class="cmts_name">'+result+' </span>&nbsp;&nbsp;<span class="cmts_text">'+comment+'</span> </div>');
            
                /*$("#"+ post_id).append('<div class="post-comment" style="display:inline-flex;margin: 10px auto;"><img style="margin-right: 10px;" src="http://placehold.it/300x300" alt="" class="profile-photo-sm" /><p><a href="timeline.html" class="profile-link">'+result+' </a><i class="em em-laughing"></i> '+comment+' </p> </div><br/></div>');*/
            },
            
        });
     
    // return false;
        
    }
    
    $('#waterfall_content').NewWaterfall();
    $('#waterfall_content_profile').NewWaterfall();
        var autocomplete;
        function initAutocomplete()
        {          
             autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('search_by_location1')),
            {types: ['geocode']});

        }       
        function geolocate()
        {
            if (navigator.geolocation)
            {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    var circle = new google.maps.Circle({
                        center: geolocation,
                        radius: position.coords.accuracy
                    });
                    autocomplete.setBounds(circle.getBounds());
                });
            }
        }  
        
    
    function active_tab1(tab_type)
  {
      if(tab_type=="Broadcast")
      document.cookie = "active_tab=tab_broadcast";
      else if(tab_type=="Swap")
      document.cookie = "active_tab=tab_swap";
      else if(tab_type=="Localvocal")
      document.cookie = "active_tab=tab_localvocal";
      
      
      
      document.cookie = active_tab=tab_broadcast;
      // alert(getCookie("changed_type"));
       
       if(tab_type == getCookie("changed_type"))
       $("#pac-input-btm").val(getCookie("keyword"));
       
       else
       $("#pac-input-btm").val('');
      
  }
  
  
  function validate_coupon()
  {
      
      
      var coupon_code = $('#coupon_code').val();
      var plan_name = $('#plan_coupon_code').val();
      
       $.ajax({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
             
            url: window.location.origin +"/whapi/validate_coupon",
          // type: 'POST',
          
            contentType: false,
           data: { 
                coupon_code: coupon_code,
                plan_name: plan_name,
             
            },
            success: function (result) {
                if(result.error == "")
                {
                    $('#amount').html(result.amount);
                    $('#total_amount').val(result.amount);
                    $( "#coupon_result" ).empty();
                    $('<center><span style="font-style:italic;color: green;font-weight: 600;"><i class="fa fa-check" aria-hidden="true"></i>'+result.code+' successfuly added!</span></center>').appendTo('#coupon_result');
                }
                else
                {
                    alert("Invalid Coupon Code");
                    
                }
                
                }    
      
      
      
  });
  return false;
  }
  
  
  $("#payuForm").submit(function(e) {
      
         var formData = new FormData($(this)[0]); 
          $.ajax({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
             
            url: window.location.origin +"/whapi/navigate_payment",
           type: 'POST',
          
            contentType: false,
            data: formData,
            success: function (result) {
            var url = 'https://sandboxsecure.payu.in/_payment';
           // var url = 'https://secure.payu.in/_payment';
            var form = $('<form id="payu" name="payu" action="' + url + '" method="post">' +
            '<input type="hidden" name="hash" value="' + result.hash + '" />' +
            '<input type="hidden" name="surl" value="' + result.surl + '" />' +
            '<input type="hidden" name="furl" value="' + result.furl + '" />' +
            '<input type="hidden" name="txnid" value="' + result.txnid + '" />' +
            '<input type="hidden" name="amount" value="' + result.amount + '" />' +
            '<input type="hidden" name="productinfo" value="' + result.productinfo + '" />' +
            '<input type="hidden" name="firstname" value="' + result.firstname + '" />' +
            '<input type="hidden" name="email" value="' + result.email + '" />' +
            '<input type="hidden" name="phone" value="' + result.phone + '" />' +
            '<input type="hidden" name="udf1" value="' + result.udf1 + '" />' +
            '<input type="hidden" name="key" value="' + result.key + '" />' +
              '<input type="hidden" name="service_provider" value="' + result.service_provider + '" />' +
            '</form>');
            //$('body').append(form);
             $(form).appendTo('#new_form');
           //  var payuForm = document.forms.payu;
            form.submit();
             //  var payuForm = document.forms.payuForm;
             //  payuForm.submit();
            },
              cache: false,
        processData: false,
        async: false,
            
        });
         return false;
      
  });
  
  
      function open_chat1(id,type) {
    $.ajax({
             headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            url: window.location.origin +"/whapi/open_chat1",
            //type: 'POST',
            data: 
            {
                type_id: id,
                type: type,
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
   
   function sendmsg()
   {
       var id = event.target.id;
       var chatMsg_attr_id = "chatMsg_" + id;
       //alert(id);
        var message = document.getElementById(chatMsg_attr_id).value;
        message = message.trim();
        
        // Check if the message is not empty
        if (message.length !== 0) {
            send_message(message,chatMsg_attr_id);
            event.preventDefault();
            document.getElementById(chatMsg_attr_id).value = "";
        } else {
            //alert('Provide a message to send!');
            document.getElementById(chatMsg_attr_id).value = "";
        }
   }
   
   function send_message(message,chatMsg_attr_id) {
    //var message_id = document.getElementById("type_id").value;
  $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: window.location.origin +"/whapi/send_messages",
    // method: 'post',
    data: { message: message,
            chatMsg_attr_id: chatMsg_attr_id

    },
    success: function(data) {
      $('#chatMsg').val('');
      get_messages(message,chatMsg_attr_id);
       var messageBody = document.querySelector('#msg-wgt-body');
       messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
      //setInterval( function() { get_messages(message,message_id); }, 500 );
    }
  });
}

function get_messages(message,chatMsg_attr_id) {
  $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: window.location.origin +"/whapi/get_messages",

    data: { message: message,
            chatMsg_attr_id: chatMsg_attr_id

    },
    success: function(data) {
      $('.msg-wgt-body'+data['conv_id']).html(data['content']);
      var messageBody = document.querySelector('#msg-wgt-body');
       messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;

    }
  });
}
   
   
    function sendmsg_all()
   {
       var id = event.target.id;
       var chatMsg_attr_id = "chatMsg_" + id;
       //alert(id);
        var message = document.getElementById(chatMsg_attr_id).value;
        message = message.trim();
        
        // Check if the message is not empty
        if (message.length !== 0) {
            send_message_all(message,chatMsg_attr_id);
            event.preventDefault();
            document.getElementById(chatMsg_attr_id).value = "";
        } else {
            //alert('Provide a message to send!');
            document.getElementById(chatMsg_attr_id).value = "";
        }
   }
   
   function send_message_all(message,chatMsg_attr_id) {
    //var message_id = document.getElementById("type_id").value;
  $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: window.location.origin +"/whapi/send_messages",
    // method: 'post',
    data: { message: message,
            chatMsg_attr_id: chatMsg_attr_id

    },
    success: function(data) {
      $('#chatMsg').val('');
      get_messages_all(message,chatMsg_attr_id);
       var messageBody = document.querySelector('#msg-wgt-body_all');
       messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
      //setInterval( function() { get_messages(message,message_id); }, 500 );
    }
  });
}

function get_messages_all(message,chatMsg_attr_id) {
  $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: window.location.origin +"/whapi/get_messages",

    data: { message: message,
            chatMsg_attr_id: chatMsg_attr_id

    },
    success: function(data) {
     // $('.msg-wgt-body'+data['conv_id']).html(data['content']);
      $('.msg-wgt-body_all').html(data['content']);
      var messageBody = document.querySelector('#msg-wgt-body_all');
       messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;

    }
  });
}
   
     function sendmsg_bc()
   {
       var id = event.target.id;
       var chatMsg_attr_id = "chatMsg_" + id;
       //alert(id);
        var message = document.getElementById(chatMsg_attr_id).value;
        message = message.trim();
        
        // Check if the message is not empty
        if (message.length !== 0) {
            send_message_bc(message,chatMsg_attr_id);
            event.preventDefault();
            document.getElementById(chatMsg_attr_id).value = "";
        } else {
            //alert('Provide a message to send!');
            document.getElementById(chatMsg_attr_id).value = "";
        }
   }
   
   function send_message_bc(message,chatMsg_attr_id) {
    //var message_id = document.getElementById("type_id").value;
  $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: window.location.origin +"/whapi/send_messages",
    // method: 'post',
    data: { message: message,
            chatMsg_attr_id: chatMsg_attr_id

    },
    success: function(data) {
      $('#chatMsg').val('');
      get_messages_bc(message,chatMsg_attr_id);
       var messageBody = document.querySelector('#msg-wgt-body_bc');
      messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
      //setInterval( function() { get_messages(message,message_id); }, 500 );
    }
  });
}

function get_messages_bc(message,chatMsg_attr_id) {
  $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: window.location.origin +"/whapi/get_messages",

    data: { message: message,
            chatMsg_attr_id: chatMsg_attr_id

    },
    success: function(data) {
     // $('.msg-wgt-body'+data['conv_id']).html(data['content']);
      $('.msg-wgt-body_bc').html(data['content']);
     

    }
  });
}
   
    function sendmsg_sw()
   {
       var id = event.target.id;
       var chatMsg_attr_id = "chatMsg_" + id;
       //alert(id);
        var message = document.getElementById(chatMsg_attr_id).value;
        message = message.trim();
        
        // Check if the message is not empty
        if (message.length !== 0) {
            send_message_sw(message,chatMsg_attr_id);
            event.preventDefault();
            document.getElementById(chatMsg_attr_id).value = "";
        } else {
            //alert('Provide a message to send!');
            document.getElementById(chatMsg_attr_id).value = "";
        }
   }
   
   function send_message_sw(message,chatMsg_attr_id) {
    //var message_id = document.getElementById("type_id").value;
  $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: window.location.origin +"/whapi/send_messages",
    // method: 'post',
    data: { message: message,
            chatMsg_attr_id: chatMsg_attr_id

    },
    success: function(data) {
      $('#chatMsg').val('');
      get_messages_sw(message,chatMsg_attr_id);
       var messageBody = document.querySelector('#msg-wgt-body_sw');
       messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
      //setInterval( function() { get_messages(message,message_id); }, 500 );
    }
  });
}

function get_messages_sw(message,chatMsg_attr_id) {
  $.ajax({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: window.location.origin +"/whapi/get_messages",

    data: { message: message,
            chatMsg_attr_id: chatMsg_attr_id

    },
    success: function(data) {
     // $('.msg-wgt-body'+data['conv_id']).html(data['content']);
      $('.msg-wgt-body_sw').html(data['content']);
      //var messageBody = document.querySelector('#msg-wgt-body_all');
      // messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;

    }
  });
}
 
  
    
        // Get the modal
        var modal = document.getElementById('myModal');
        
        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");
        
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        
        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }
        
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
        
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        
        @yield('script')
</script>  

    
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcccXd0gKthu5d0q1-YDFRt74LylCIBRE&libraries=places&callback=initAutocomplete"></script>-->
</body>
</html>