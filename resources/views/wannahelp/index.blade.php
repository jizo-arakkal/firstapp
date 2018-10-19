@extends('layouts.app')
@section('content')


<div class="home_image_slider_wrap">
            <div id="myCarousel" class="carousel slide home_slider" data-ride="carousel">
              <div class="slider_content_top">
               
                 <div class="clearfix"></div>
              </div>
              <div class="clearfix"></div>
              <div class="slider_content_middle" style="z-index: 1;">
                   <button class="btn" style="padding:0px; border:none;background:none;"><img src="<?php echo url('images/app_store_btn.png');?>"></button>
                   <button class="btn" style="padding:0px; border:none;background:none;"><img src="<?php echo url('images/play_store_btn.png');?>"></button>
              </div>
              <div class="clearfix"></div>

              <div class="slider_category_wrap" style="z-index: 1;">
                  <div class="slider_content_bottom">                 
                  </div>
                  <div class="slider_content_bottom_content">
                     <div class="cat_full_wrap" style="margin-top: 10px;">
                       <div class="cat_scroll_arrow" id="cat_scroll_arrow_left">
                            <i class="fa fa-chevron-left"></i>
                         </div>
                         <div class="category_scroller_wrap">                
                             <ul class="category_scroller">
								 
                                 @foreach($categories as $category)
								 <li>
                                     <div class="cat_img_wrap">
                                         
                                        <div name="{{$category->id}}" onclick="change_category({{$category->id}})"><img id="cat{{$category->id}}" src="<?php echo url('images/category/')?>/{{$category->logo_image}}"> 
                                        </div>
                                        <p>{{$category->category_title}}</p>
                                     </div>
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
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 page_search_wrap_left">
                            <ul class="nav nav-pills page_search_wrap_left_ul">
                              <li onclick="active_tab1('Broadcast')" class="active" datax="Broadcast"><a id="type" data-toggle="pill" href="#tab_broadcast">WannaHelp (PMIT)</a></li>
                              <li datax="Swap"><a onclick="active_tab1('Swap')" data-toggle="pill" href="#tab_swap">SwapNear</a></li>
                              <li datax="LocalVocal"><a onclick="active_tab1('Localvocal')" data-toggle="pill" href="#tab_localvocal">AddValue</a></li>
                            </ul>                
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 page_search_wrap_right">
                            <div class="input-group">
                                <input id="pac-input-btm" type="text" class="form-control search_query" onkeypress="return change_search_text(event)" placeholder="Keyword Search" style="outline:none;" />
                                <span class="input-group-btn">
                                    <a onclick="clear_keyword()" class="btn btn_search" style="color:#E9967A; background: transparent;">
                                        <span class="fa fa-times-circle"></span>
                                    </a>
                                    <button onclick="change_search_text('clicked')" class="btn btn_search " type="button" style="outline:none;" >
                                    Search
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>


                  </div>
              </div>

              <div class="clearfix"></div>
              <!-- Wrapper for slides -->
              <div class="carousel-inner">

                <div class="item active">
                  <p class="slider_slogan">Make your life easy 1</p>
                  <img src="<?php echo url('/images/camera1.jpg');?>" alt="Los Angeles">
                </div>

               <!--  <div class="item">
                  <p class="slider_slogan">Make your life easy 2</p>
                  <img src="<?php //echo url('/images/camera2.jpg');?>" alt="Chicago">
                </div>

                <div class="item">
                  <p class="slider_slogan">Make your life easy 3</p>
                  <img src="<?php //echo url('/images/camera3.jpg');?>" alt="New York">
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

<div class="container page_content_wrap">  


    
        
    <div class="page_data_wrap">

        <div class="tab-content">
            <div id="tab_broadcast" class="tab-pane fade in active">                 
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top_ad_column">
                     
                 </div>
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_right_0 padding_left_0">
					@foreach($paid_broadcasts as $paid_broadcast)
                     <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                         <div class="top_user_listing">
                             <div class="wh_profile_pic_top">
                                 @if($paid_broadcast->is_online)
                                <span class="wh_profile_pic_top_active">
                                    <i class="fa fa-circle"></i>
                                </span>
                                @endif
                                <img src="<?php echo url('images/profile.png');?>">
                             </div>
                             <div class="wh_brdcast">
                                {{$paid_broadcast->description}}
                             </div>
                             <div class="wh_name_chat">
                                 <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                     <p><i class="fa fa-diamond" aria-hidden="true" style="color: #3cc0c7;"></i>&nbsp;{{$paid_broadcast->name}}</p>
                                     <p class="distance">{{$paid_broadcast->location}}</p>
                                 </div>
                                 <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 padding_right_0">
                                    <button class="btn btn-chat pull-right col-xs-12">CHAT</button>
                                 </div>
                                 <div class="clearfix"></div>
                             </div>
                             <div class="clearfix"></div>
                         </div>
                     </div>
					 @endforeach
                    
                 </div>

                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                     
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top_ad_column">
                         
                     </div> 
                     
				 
					<div class="broadcast_content"></div>
					 
                     
                      <div id="results"><!-- results appear here --></div>
                     <div class="ajax-loading-bc"><img src="http://wannahelp.com/whapi/images/loading.gif" /></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top_ad_column" 
                      style="margin:50px 0px;">
                         
                     </div>


                     <div class="clearfix"></div>
                </div>
          
            </div>

            <div id="tab_swap" class="tab-pane fade">
                <div id="waterfall_content">
                  
                    
                </div>
                 <div class="ajax-loading-sw"><img src="http://wannahelp.com/whapi/images/loading.gif" /></div>
                <div class="swap_content"></div>
                
               
            </div>

            <div id="tab_localvocal" class="tab-pane fade">
            
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_right_0 padding_left_0">
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="float:  right;">
                        <!--<div class="lv_suggestions_wrap">
                            <h4>SUGGESTIONS FOR YOU</h4>
                            <ul class="suggestion_ul">
                                @foreach($sugg_users as $sugg_users)
                                <li>
                                   <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                       <img class="sugg_pic" src="<?php echo url('images/profile.png');?>">
                                   </div>
                                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                      <p class="sugg_name">{{$sugg_users->name}}</p>
                                      <p class="sugg_place">{{$sugg_users->location}}</p>
                                   </div>
                                   <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                      <button class="btn btn_send_req"><i class="fa fa-user-plus" aria-hidden="true"></i></button>
                                   </div>
                                   <div class="clearfix"></div>
                                </li>
                                @endforeach
                                <li>
                                    <a href="">SEE ALL</a>
                                </li>
                            </ul>
                        </div> -->
                         <div class="lv_right_ad_wrap">
                            
                        </div>
                        <div class="lv_right_ad_wrap">
                            
                        </div>

                        <div class="lv_right_ad_wrap">
                            
                        </div>

                    </div>
                    
                    <div class="localvocal_content">
                        
                     
                        
                    </div>
                     <div id="results_lv"><!-- results appear here --></div>
                    
                    <div class="clearfix"></div>
                    <div class="ajax-loading-lv"><img src="http://wannahelp.com/whapi/images/loading.gif" /></div>
                    
                </div>
            </div>
            
      </div>
        <div class="clearfix"></div>
    </div>

    <div class="clearfix"></div> 
</div>

    <div class="clearfix"></div>
</div>



    
	



@endsection
