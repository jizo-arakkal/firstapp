<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Wannahelp') }}</title>   
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/custom.css') }}" rel="stylesheet">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="{{ asset('public/css/jquery.typeahead.css') }}" rel="stylesheet">
    <script src="{{asset('public/js/jquery.min.js')}}"></script>  
    <script src="{{asset('public/js/jquery.cookie.js')}}"></script>  
    <script src="{{asset('public/js/jquery.typeahead.js')}}"></script>  
    <script src="{{asset('public/js/newWaterfall.js')}}"></script> 
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7ymkb4fhvYTI-xSzbPfF9vPDnfrj86tY&libraries=places"></script>
   
   
	
   
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>


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
</style>
</head>
<body>    
    <div id="app">
	
	
	
	
        <div id="top_location_selector">
            <a id="close_location_selector"><i class="fa fa-close"></i></a>
            <div class="top_location_selector_content">
                <br/>
                 

				 <div class="search_by_location_wrap">
                     <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align:center;padding-top:10px;">
                        <label>Select or type city</label>
                     </div>
                     <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        
						

						<input id="pac-input-tp" type="text" class="form-control search_query" placeholder="TOPSearch in your city" />

					
					</div>  
                     <div class="clearfix"></div>                 
                 </div><br/>
                 <div class="search_by_pre_location_wrap">
                     <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                            <div class="pre_loc_items" onclick="getlocation('Chennai')">
                                <div class="pre_loc_img">
                                    
                                </div>
                                <div class="pre_loc_name">
                                    Bangalore
                                </div>
                                <div class="clearfix"></div> 
                            </div>
                            <div class="clearfix"></div> 
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                            <div class="pre_loc_items" onclick="getlocation('Chennai')">
                                <div class="pre_loc_img">
                                    
                                </div>
                                <div onclick="getlocation('Chennai')" class="pre_loc_name">
                                    Chennai
                                </div>
                                <div class="clearfix"></div> 
                            </div>
                            <div class="clearfix"></div> 
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                            <div class="pre_loc_items" onclick="getlocation('Mumbai')">
                                <div class="pre_loc_img">
                                    
                                </div>
                                <div class="pre_loc_name">
                                    Mumbai
                                </div>
                                <div class="clearfix"></div> 
                            </div>
                            <div class="clearfix"></div> 
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                            <div class="pre_loc_items" onclick="getlocation('Delhi')">
                                <div class="pre_loc_img">
                                    
                                </div>
                                <div class="pre_loc_name">
                                    Delhi
                                </div>
                                <div class="clearfix"></div> 
                            </div>
                            <div class="clearfix"></div> 
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                            <div class="pre_loc_items" onclick="getlocation('Kolkata')">
                                <div class="pre_loc_img">
                                    
                                </div>
                                <div class="pre_loc_name">
                                    Kolkata
                                </div>
                                <div class="clearfix"></div> 
                            </div>
                            <div class="clearfix"></div> 
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                            <div class="pre_loc_items" onclick="getlocation('Cochin')">
                                <div class="pre_loc_img">
                                    
                                </div>
                                <div class="pre_loc_name">
                                    Cochin
                                </div>
                                <div class="clearfix"></div> 
                            </div>
                            <div class="clearfix"></div> 
                        </div>

                        <div class="clearfix"></div> 
                     </div>
                                     
                 </div>
            </div>
            <div class="top_location_selector_bottom">
                Bangalore&nbsp;&nbsp;<i class="fa fa-chevron-up" aria-hidden="true"></i>
            </div>
        </div>
        <!-- *****************Top Black Header Start************** -->
        <nav class="navbar navbar-default navbar-static-top top_black_header">
            <div class="container">
                <div class="navbar-header">
                    
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>                       
                        <span class="icon-bar"></span>
                    </button>
                    <button type="button" class="navbar-toggle collapsed top_download_btn" data-toggle="collapse" data-target="#app-navbar-collapse" style="font-size:9px; color:#fff;padding:0px 3px;">
                       Download App
                    </button>
                    <!-- Branding Image -->
                    <!-- <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Wannahelp') }}
                    </a> -->
                    <a class="navbar-brand" id="open_location_selector">
                        Bangalore&nbsp;&nbsp;<i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="my_account_text" data-toggle="modal" data-target="#register_login_wrap"><span class="fa fa-user"></span>&nbsp;My Account</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- *****************Top Black Header End************** -->
        <!-- ***************Register and login Pop up*************  -->    



        <!-- Modal -->
        <div id="register_login_wrap" class="modal fade" role="dialog" style="z-index: 1000000;"> 
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
                                    <label for="firstname" class="sr-only">First Name</label>
                                    <input id="firstname" class="form-control input-group-lg" type="text" name="firstname" title="Enter first name" placeholder="First name">
                                  </div>

                                  <div class="form-group-popup">
                                    <label for="lastname" class="sr-only">Last Name</label>
                                    <input id="lastname" class="form-control input-group-lg" type="text" name="lastname" title="Enter last name" placeholder="Last name">
                                  </div>

                                  <div class="form-group-popup">
                                    <label for="email" class="sr-only">Email</label>
                                    <input id="email" class="form-control input-group-lg" type="text" name="Email" title="Enter Email" placeholder="Your Email">
                                  </div>

                                  <div class="form-group-popup">
                                    <label for="password" class="sr-only">Password</label>
                                    <input id="password" class="form-control input-group-lg" type="password" name="password" title="Enter password" placeholder="Password">
                                  </div>

                                </div>                     

                              
                                
                              </form><!--Register Now Form Ends-->
                              <p><a href="#">Already have an account?</a></p>
                              <button class="btn btn-primary">Register Now</button>
                            </div><!--Registration Form Contents Ends-->
                            
                            <!--Login-->
                            <div class="tab-pane" id="login">
                              <h3>Login</h3>
                              <p class="text-muted">Log into your account</p>
                              
                              <!--Login Form-->
                              <form name="Login_form" id="Login_form">
                                 <div class="row">
                                  <div class="form-group col-xs-12">
                                    <label for="my-email" class="sr-only">Email</label>
                                    <input id="my-email" class="form-control input-group-lg" type="text" name="Email" title="Enter Email" placeholder="Your Email">
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-xs-12">
                                    <label for="my-password" class="sr-only">Password</label>
                                    <input id="my-password" class="form-control input-group-lg" type="password" name="password" title="Enter password" placeholder="Password">
                                  </div>
                                </div>
                              </form><!--Login Form Ends--> 
                              <p><a href="#">Forgot Password?</a></p>
                              <button class="btn btn-primary">Login Now</button>
                            </div>
                          </div>
                        </div>
              </div>             
            </div>

          </div>
        </div>
         
        <div class="home_image_slider_wrap">
            <div id="myCarousel" class="carousel slide home_slider" data-ride="carousel">
              <div class="slider_content_top">
                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 slider_content_top_left">
                     <img src="<?php echo url('public/images/wh_home_logo.png');?>" style="">
                 </div>
                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 slider_content_top_right">
                    <button class="btn btn-primary btn_slider_post_free pull-right" data-toggle="modal" data-target="#myModal">POST FREE</button> 
                 </div>
                 <div class="clearfix"></div>
              </div>
              <div class="clearfix"></div>
              <div class="slider_content_middle">
                   <button class="btn" style="padding:0px; border:none;background:none;"><img src="<?php echo url('public/images/app_store_btn.png');?>"></button>
                   <button class="btn" style="padding:0px; border:none;background:none;"><img src="<?php echo url('public/images/play_store_btn.png');?>"></button>
              </div>
              <div class="clearfix"></div>

              <div class="slider_category_wrap">
                  <div class="slider_content_bottom">                 
                  </div>
                  <div class="slider_content_bottom_content">
                     <div class="cat_full_wrap">
                       <div class="cat_scroll_arrow" id="cat_scroll_arrow_left">
                            <i class="fa fa-chevron-left"></i>
                         </div>
                         <div class="category_scroller_wrap">                
                             <ul class="category_scroller">
								 
                                 @foreach($categories as $category)
								 <li>
                                     <div class="cat_img_wrap">
                                         
                                        <div name="{{$category->id}}" onclick="change_category({{$category->id}})"><img src="<?php echo url('public/images/category/')?>/{{$category->logo_image}}"> 
                                        </div>
                                     </div>
                                     <p>{{$category->category_title}}</p>
                                 </li>
								 @endforeach
                                 
                             </ul>
                         </div>
                         <div class="cat_scroll_arrow" id="cat_scroll_arrow_right">
                            <i class="fa fa-chevron-right"></i>
                         </div> 
                          <div class="clearfix"></div>
                     </div>

                     <div class="page_search_wrap">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 page_search_wrap_left">
                            <ul class="nav nav-pills page_search_wrap_left_ul">
                              <li class="active"><a id="type" data-toggle="pill" href="#tab_broadcast">Broadcast</a></li>
                              <li><a data-toggle="pill" href="#tab_swap">Swap</a></li>
                              <li><a data-toggle="pill" href="#tab_localvocal">LocalVocal</a></li>
                            </ul>                
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 page_search_wrap_right">
                            <div class="input-group">
                                <input id="pac-input-btm" type="text" class="form-control search_query" placeholder="Search in your city" />
                                <span class="input-group-btn">
                                    <button onclick="update_location()" class="btn btn_search" type="button">
                                        <span class="fa fa-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>


                  </div>
              </div>

              <div class="clearfix"></div>
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner">

                <div class="item active">
                  <p class="slider_slogan">Make your life easy 1</p>
                  <img src="<?php echo url('/public/images/camera1.jpg');?>" alt="Los Angeles">
                </div>

               <!--  <div class="item">
                  <p class="slider_slogan">Make your life easy 2</p>
                  <img src="<?php //echo url('/public/images/camera2.jpg');?>" alt="Chicago">
                </div>

                <div class="item">
                  <p class="slider_slogan">Make your life easy 3</p>
                  <img src="<?php //echo url('/public/images/camera3.jpg');?>" alt="New York">
                </div> -->
              </div>

              <!-- Left and right controls -->
              <!-- <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
              </a> -->
            </div>
        </div>
        
        
        
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Post</h4>
        </div>
        <div class="modal-body">
           <div class="col-sm-4"><label><input type="radio" name="type" value="Broadcast">&nbsp;&nbsp;Broadcast</label></div>  
		   <div class="col-sm-4"><label><input type="radio" name="type" value="Swap">&nbsp;&nbsp;Swap</label></div>
		   <div class="col-sm-4"><label><input type="radio" name="type" value="LocalVocal">&nbsp;&nbsp;LocalVocal</label></div>
		   <br><br><br>
		   <div id="broadcast" style="display: none">
			
			<div class="col-sm-12"><span style="float:  inherit;">Description&nbsp;&nbsp;&nbsp;</span> <textarea style="resize: none;height:50px;width:440px"></textarea></div> 
			<br><br>
			<div class="col-sm-12">Category <input type="text" hidden="true"/> </div>
			<div class="col-sm-12">Location <input type="text" hidden="true"/> </div>
		    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                            </ul>
                        </div>  
                        <div class="col-lg-2col-md-2 col-sm-2 col-xs-12">
                            <h4>Popular Search</h4>
                            <ul class="footer_links_btm">                                
                                <li><a href="">Honda city for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <h4>Popular Search</h4>
                            <ul class="footer_links_btm">                                
                                <li><a href="">Honda city for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <h4>Popular Search</h4>
                            <ul class="footer_links_btm">                                
                                <li><a href="">Honda city for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <h4>Popular Search</h4>
                            <ul class="footer_links_btm">                                
                                <li><a href="">Honda city for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                                <li><a href="">Iphone 7s for sale</a></li>
                            </ul>
                        </div> 
                                                
                    </div>
                </div>
            </div>
        </footer>
		
		
    </div>



    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}"></script>
    <script src="{{ asset('public/js/custom.js') }}"></script>
	<script src="{{asset('public/js/jquery.typeahead.js')}}"></script>
	<script src="{{asset('public/js/newWaterfall.js')}}"></script> 
	<script src="{{asset('public/js/jquery.cookie.js')}}"></script> 
	 
	 
    <script type="text/javascript">
    
    var baseurl = "wannahelp.com/whapi";
    
    $(function() {
    $('input[name="type"]').on('click', function() {
        if ($(this).val() == 'Broadcast') {
            $('#broadcast').show();
        }
        else {
            $('#broadcast').hide();
        }
    });
});
    
    
    function getlocation(i)
   {
       
      // alert(i);
       $('#top_location_selector').slideUp();
       $('#open_location_selector').text(i);
       $('#open_location_selector').append('&nbsp;&nbsp;<i aria-hidden="true" class="fa fa-chevron-down"></i>');

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
    var autocomplete = new google.maps.places.Autocomplete(input);
 
    var input= document.getElementById('pac-input-btm');
    var autocomplete = new google.maps.places.Autocomplete(input); 
    
   
   $("#pac-input-btm").bind("change paste keyup", function() {
  // alert($(this).val()); 
});
   
  // $("button").click(function(e) {
  
  function update_location()
   {
      var location =$("#pac-input-btm").val();
      var type = $(".page_search_wrap_left_ul li.active").text();
      $.cookie('type', type);
      $.ajax({
        type: "GET",
        url: "show_selected_location",
        data: { 
            //id: $(this).val(), // < note use of 'this' here
            //id: i,
            type:  $.cookie('type'),
            location: location
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
    });
      
      
      
   }
  
  function change_category(i)
  {
   var type = $(".page_search_wrap_left_ul li.active").text();
    $.cookie('type', type);
    var location =$("#pac-input-btm").val();
    //alert($.cookie('type'));
    //e.preventDefault();
    //console.log($(this).val());
    
    $.ajax({
        type: "GET",
        url: "show_selected_category",
        data: { 
            //id: $(this).val(), // < note use of 'this' here
            id: i,
            type:  $.cookie('type')
        },
        success: function(result) {
           
           //if(type=="Broadcast")
                update_broadcast(result);
           //else if(type=="Swap")
                update_swap(result);
           //else if(type=="LocalVocal")
                update_localvocal(result);
           
        },
        error: function(result) {
            alert('error');
        }
    });
  }
    
    
//});

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
    bc_tagstring += '<p><i class="fa fa-diamond" aria-hidden="true" style="color: #3cc0c7;"></i>&nbsp;'+ result[i].name+'</p>';
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
    //$('#waterfall').NewWaterfall();  
    var sw_tagstring = '';
    sw_tagstring += '<ul id="waterfall_updated" style="list-style:none">';
    for (var i = 0; i < result.length; i++) 
    {
    sw_tagstring +='<li>';
    
    sw_tagstring +='<div class="swap_list_item sw_normal_item">';
    sw_tagstring +='<div class="swap_list_item_top">';
    sw_tagstring +='<span class="price_tag">Rs.5000 or Iphone 6s</span>';
    sw_tagstring +='<img src="public/images/mobile2.png">';
    sw_tagstring +='</div>';
    sw_tagstring +='<div class="swap_list_item_btm">';
    sw_tagstring +='<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 swap_prof_pic_wrap">';
    sw_tagstring +='<span class="swap_prof_online_batch"><i class="fa fa-circle"></i></span>';
    sw_tagstring +='<img src="public/images/profile.png">';
    sw_tagstring +='<p>Bangalore</p>';
    sw_tagstring +='</div>';
    sw_tagstring +='<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 swap_title_wrap">';
    sw_tagstring +='<h4><a href=""></a></h4>';
    sw_tagstring +='<p>Updated : 5 hours ago</p>';
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
    $('#waterfall_updated').NewWaterfall();
    $('#waterfall_updated').NewWaterfall();
       
   }
   
   
   function update_localvocal(result)
   {
       
    var lv_tagstring = '';
    
    for (var i = 0; i < result.length; i++) 
    {
    lv_tagstring += '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">';
    lv_tagstring += '<div class="lv_post_list">';
    lv_tagstring += '<div class="lv_post_list_top">';
    lv_tagstring += '<div class="col-lg-10 col-md-10 col-sm-10 col-xs-8 lv_post_name">';
    lv_tagstring += '<img src="public/images/profile.png">&nbsp;&nbsp;Dre Parker';
    lv_tagstring += '</div>';
    lv_tagstring += '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 lv_post_time">';
    lv_tagstring += '10 hrs ago';
    lv_tagstring += '</div>';
    lv_tagstring += '<div class="clearfix"></div>';
    lv_tagstring += '</div>';
    lv_tagstring += '<div class="lv_post_list_thumb">';
    lv_tagstring += '<img src="public/images/post.jpg">';
    lv_tagstring += '</div>';
    lv_tagstring += '<div class="lv_post_list_text">';
    lv_tagstring += 'CHANDIGARH: Army columns moved into Panchkula early on Friday as scores of Dera Sacha Sauda followers gathered in the town ahead of a court verdict in a rape case against the sect chief Gurmeet Ram Rahim Singh. Around 53 companies of the paramilitary forces and 50,000 personnel of the Haryana Police have also been deployed in view of law and order situation in Haryana and Punjab. Amid heavy security, the 50-year-old Dera head left the sect-headquarters at Sirsa, about 260km from Chandigarh, at about 9am.';
    lv_tagstring += '</div>';
    lv_tagstring += '<div class="lv_post_list_view_cmts">';
    lv_tagstring += 'View all 10012 comments';
    lv_tagstring += '</div>';
    lv_tagstring += '<div class="lv_post_list_cmts_wrap">';
    lv_tagstring += '<div class="lv_post_list_cmts_list">';
    lv_tagstring += '<span class="cmts_name">Dre Parker</span>&nbsp;&nbsp;';
    lv_tagstring += '<span class="cmts_text">Around 53 companies of the paramilitary forces and 50,000 personnel of the Haryana Police have also been deployed in view of law and order situation in Haryana and Punjab.</span>';
    lv_tagstring += '</div>';
    lv_tagstring += '</div>';
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
   
    
    $('#waterfall').NewWaterfall();
    
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

    </script>
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcccXd0gKthu5d0q1-YDFRt74LylCIBRE&libraries=places&callback=initAutocomplete"></script>-->
</body>
</html>
