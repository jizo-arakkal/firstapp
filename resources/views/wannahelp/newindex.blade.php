@extends('layouts.app')
@section('content')

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
                                <span class="wh_profile_pic_top_active">
                                    <i class="fa fa-circle"></i>
                                </span>
                                <img src="<?php echo url('images/profile.png');?>">
                             </div>
                             <div class="wh_brdcast">
                                I am looking for cheap and best web development company in fraser town, interest call me at 9876543210
                             </div>
                             <div class="wh_name_chat">
                                 <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                     <p><i class="fa fa-diamond" aria-hidden="true" style="color: #3cc0c7;"></i>&nbsp;{{$paid_broadcast->name}}</p>
                                     <p class="distance">Bangalore/2.5Km</p>
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

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top_ad_column" 
                      style="margin:50px 0px;">
                         
                     </div>


                     <div class="clearfix"></div>
                </div>

            </div>

            <div id="tab_swap" class="tab-pane fade">
                <div id="waterfall_content">
                    <ul id="waterfall" style="list-style:none"> 
                        @foreach($swaps as $swap)
                        <li>
                    
                        <div class="swap_list_item sw_normal_item">
    						<div class="swap_list_item_top">
    							<span class="price_tag">Rs.5000 or Iphone 6s</span>
    								<img src="<?php echo url('images/mobile1.png');?>">
    						</div>
    						<div class="swap_list_item_btm">
    							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 swap_prof_pic_wrap">
    								<span class="swap_prof_online_batch"><i class="fa fa-circle"></i></span>
    								<img src="<?php echo url('images/profile.png');?>">
    								<p>Bangalore</p>
    							</div>
    							<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 swap_title_wrap">
    									<h4><a href="<?php echo url('swap_detail')?>">{{$swap->title}}</a></h4>
    									<p>Updated : 5 hours ago</p>
    							</div>
    							<div class="clearfix"></div>
    						</div>
                        </div>
                    
                        </li>
                        @endforeach
                    </ul> 
                </div>
                <div class="swap_content"></div>
               
            </div>

            <div id="tab_localvocal" class="tab-pane fade">
            
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_right_0 padding_left_0">
                    
                    <div class="localvocal_content"></div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="float:  right;">
                        <div class="lv_suggestions_wrap">
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
        <div class="clearfix"></div>
    </div>

    <div class="clearfix"></div> 
</div>


<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 chat_window">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading" id="accordion">
                        <span class="fa fa-comment"></span> Dre parker
                        <div class="btn-group pull-right">
                            <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                <span class="fa fa-chevron-down"></span>
                            </a>
                        </div>
                    </div>
                <div class="panel-collapse collapse" id="collapseOne">
                    <div class="panel-body">
                        <ul class="chat">
                            <li class="left clearfix"><span class="chat-img pull-left">
                                <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                            </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
                                            <span class="fa fa-time"></span>12 mins ago</small>
                                    </div>
                                    <p>
                                        dhdfghdghd
                                    </p>
                                </div>
                            </li>
                            <li class="right clearfix"><span class="chat-img pull-right">
                                <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                            </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <small class=" text-muted"><span class="fa fa-time"></span>13 mins ago</small>
                                        <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                    </div>
                                    <p>
                                        fhfg
                                    </p>
                                </div>
                            </li>
                            <li class="left clearfix"><span class="chat-img pull-left">
                                <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                            </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
                                            <span class="fa fa-time"></span>14 mins ago</small>
                                    </div>
                                    <p>
                                        jfhjg
                                    </p>
                                </div>
                            </li>
                            <li class="right clearfix"><span class="chat-img pull-right">
                                <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                            </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <small class=" text-muted"><span class="fa fa-time"></span>15 mins ago</small>
                                        <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                    </div>
                                    <p>
                                        fjfgj
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <div class="input-group">
                            <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                            <span class="input-group-btn">
                                <button class="btn btn-warning btn-sm" id="btn-chat">
                                    Send</button>
                            </span>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    <div class="clearfix"></div>
</div>


    
	



@endsection
