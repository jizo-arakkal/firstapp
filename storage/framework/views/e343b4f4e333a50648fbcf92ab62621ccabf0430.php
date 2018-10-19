<?php $__env->startSection('content'); ?>

<br><br><br>
<div class="container page_content_wrap"> 
<div class="timeline">
  
    
        <?php if($user_details[0]->facebook_cover_pic!=""): ?>
        <div class="timeline-cover" style="background:url(<?php echo e($user_details[0]->facebook_cover_pic); ?>);background-position: center;background-size: cover;">
        <?php elseif($user_details[0]->cover_changed == 1): ?>
        <div class="timeline-cover" style="background:url(<?php echo e($user_details[0]->cover_pic); ?>);background-position: center;background-size: cover;">
        <?php else: ?>
        <div class="timeline-cover" style="background:url(<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/public/images/1030x360.png);background-position: center;background-size: cover;">
        <?php endif; ?> 
        
             
                      

            <!--Timeline Menu for Large Screens-->
            <div class="timeline-nav-bar hidden-sm hidden-xs">
                <div class="row">
                  <div class="col-md-3">
                    <div class="profile-info">
                      <div class="cont">
                            
                            
                                <?php if($user_details[0]->dp_changed == 1): ?>
                                <div class="image1"><img src="<?php echo e($user_details[0]->profile_pic); ?>" alt="" class="img-responsive profile-photo" /></div>
                                <?php elseif($user_details[0]->facebook_profile_dp!= ''): ?>
                                
                                <div class="image1"><img src="<?php echo e($user_details[0]->facebook_profile_dp); ?>" alt="" class="img-responsive profile-photo" /></div>
                                <?php else: ?>
                                <div class="image1"><img src="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/public/images/300x300.png" alt="" class="img-responsive profile-photo" /></div>
                                
                                <?php endif; ?>
                         <!--   
                        <div class="middle"><div class="text"><a style="color:white;text-decoration:none;" class="upload_dp" data-toggle="modal" onclick="show_upload_dp_modal()">Update Profile Picture</a></div></div> -->
                      </div>
                      
                    </div>
                  </div>
                  <div class="col-md-9" style="margin-top: 6px;">
                    <ul class="list-inline profile-menu">
                      <!-- <li><a href="timeline.html">Timeline</a></li> -->
                      <li><a class="active"><?php echo e($user_details[0]->name); ?>'s Profile</a></li>
                      <!-- <li><a href="timeline-album.html">Album</a></li>
                      <li><a href="timeline-friends.html">Friends</a></li> -->
                    </ul>
                    <ul class="follow-me list-inline">
                        
                        <li style="padding-right:  45px;padding-top: 14px;">
                           
                           
                           <?php if(Auth::user() && Auth::user()->user_id == $user_details[0]->user_id ): ?>
                           <b>Credits :  <?php echo e($user_details[0]->rem_credits); ?> </b>
                           <?php endif; ?>
                            
                           
                        </li>
                        
                      <li style="padding-right:  45px;padding-top: 14px;">
                           
                           
                           <?php if(Auth::user() && Auth::user()->user_id == $user_details[0]->user_id ): ?>
                           <a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/followers">
                           <?php endif; ?>
                            <?php echo e($user_details[0]->followers_count); ?> people following  
                            <?php if($user_details[0]->gender): ?> him
                            <?php elseif($user_details[0]->gender == "female"): ?> her
                            <?php else: ?> 
                            <?php endif; ?>
                            <?php if(Auth::user() && Auth::user()->user_id == $user_details[0]->user_id ): ?>
                           </a>
                           <?php endif; ?> 
                           
                        </li>
                        <?php if(Auth::user() && Auth::user()->user_id != $user_details[0]->user_id ): ?>
                            <?php if($user_details[0]->is_it == 0): ?>
                          <li><button style="padding: 7px 25px;border: none;font-weight: 600;border-radius: 14px;" onclick="follow_unfollow_user('<?php echo e($user_details[0]->user_id); ?>')" class="btn-primary">Follow</button>
                          </li>
                          <?php elseif($user_details[0]->is_it == 1): ?>
                          <li><button style="padding: 7px 25px;border: none;font-weight: 600;border-radius: 14px;" onclick="follow_unfollow_user('<?php echo e($user_details[0]->user_id); ?>')" class="btn-primary">Unfollow</button>
                          </li>
                          <?php endif; ?>
                          
                      
                        <?php endif; ?>  
                        
                        <?php if(!Auth::user()): ?>
                           <li><button style="padding: 7px 25px;border: none;font-weight: 600;border-radius: 14px;" onclick="show_login_form()" class="btn-primary">Follow</button>
                          </li>
                        <?php endif; ?>    
                    
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
            <li style="padding-right: 60px;"><a data-toggle="pill" href="#tab_swap_profile">Swap  <span class="numberCircle"><?php echo e(count($user_swap)); ?></span></a></li>
            <li style=""><a data-toggle="pill" href="#tab_localvocal_profile">LocalVocal <span class="numberCircle"><?php echo e(count($user_localvocal)); ?></span></a></li>
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
            <h4>About <?php echo e($user_details[0]->name); ?></h4>
            <br>
            <br>
            <?php if($user_details[0]->profession == "" && $user_details[0]->current_location == "" && $user_details[0]->about_me == ""): ?>
            
            <center><span><b>No Information to show!</b></span></center>
            
            <?php endif; ?>
            
               <?php if($user_details[0]->profession!= ""): ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"> 
                    Profession:
                    </div>
                    
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"> 
                    <b><?php echo e($user_details[0]->profession); ?></b>
                    </div>  
                </div>
                <?php endif; ?>
            <br><br>
               <?php if($user_details[0]->current_location!= ""): ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"> 
                    Current Location:
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                    <b><?php echo e($user_details[0]->current_location); ?></b>
                    </div>  
                </div>
                <?php endif; ?>
            <br><br>
               <?php if($user_details[0]->about_me!= ""): ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"> 
                    About me:
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                    <b><?php echo e($user_details[0]->about_me); ?></b>
                    </div>  
                </div>
                <?php endif; ?>    
                
            </div>    
            <div id="tab_broadcast_profile" class="tab-pane fade">
                <br>
                <h4>CURRENT BROADCAST:</h4>
                
                <div class="broadcast_content">
                    <?php if(count($user_current_broadcast)>0): ?>
                    <?php $__currentLoopData = $user_current_broadcast; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_bt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="btm_user_listing_wrap">                    
                        <div class="btm_user_listing">
                            <?php if(Auth::user()): ?>
                            <div class="dropdown" style="float:right">
                                <button type="button" data-toggle="dropdown" class="btn" aria-expanded="false"><i aria-hidden="true" class="fa fa-ellipsis-h"></i></button> 
                                <ul class="dropdown-menu">
                                    <?php if(Auth::user()->user_id == $user_bt->user_id ): ?>
                                    <li><a onclick="edit_post_bc('<?php echo e($user_bt->broadcast_id); ?>','Broadcast')"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit</a></li>
                                   
                                    <li><a style="color:  #3097D1;font-weight:600;" onclick="boost_post_bc('<?php echo e($user_bt->broadcast_id); ?>','Broadcast')"><i class="fa fa-bolt" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Boost</a></li>
                                   
                                    
                                    <?php else: ?>
                                    <li><a onclick="report_post('<?php echo e($user_bt->broadcast_id); ?>','Broadcast')">Report</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                    <div class="wh_profile_pic_btm">
                                    <?php if($user_bt->is_online == 1): ?>    
                                        <span class="wh_profile_pic_top_active">
                                        <i class="fa fa-circle"></i>
                                    </span>
                                    <?php endif; ?>
                                    
                                    <?php if($user_bt->dp_changed == 1): ?>
                                     <img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src=<?php echo e($user_bt->profile_pic); ?>>&nbsp;&nbsp;
                                    <?php elseif($user_bt->facebook_profile_dp != NULL): ?>
                                      <img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src=<?php echo e($user_bt->facebook_profile_dp); ?>>&nbsp;&nbsp;
                                    <?php elseif($user_bt->google_profile_dp != NULL): ?>
                                      <img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src=<?php echo e($user_bt->google_profile_dp); ?>>&nbsp;&nbsp;
                                    <?php else: ?>
                                     <img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src="<?php echo url('public/images/profile.png');?>">
                                    <?php endif; ?>
                                    
                                   
                                    
                                    
                                    
                                    
                                    </div>
                                <p class="distance"><?php echo e($user_bt->location); ?></p>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                 <div class="wh_name_btm">
                                    <p><?php echo e($user_details[0]->name); ?></p>
                                 </div>
                                 <div class="wh_brdcast_btm">
                                     <?php echo e($user_bt->description); ?>

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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 <?php else: ?>
                <br><br>
                <center><b>User has no Broadcast yet.</b></center>
                <br>
                <?php endif; ?>
            </div>
            <?php if(Auth::user()): ?>
            <?php if($user_id ==  Auth::user()->user_id): ?>
            <br>
                <h4>OLD BROADCAST:</h4>
                
                <div class="broadcast_content">
                    
                    <?php if(count($user_old_broadcast)>0): ?>
                    <?php $__currentLoopData = $user_old_broadcast; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_bt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="btm_user_listing_wrap">                    
                        <div class="btm_user_listing">
                            <?php if(Auth::user()): ?>
                            <div class="dropdown" style="float:right">
                                <button type="button" data-toggle="dropdown" class="btn" aria-expanded="false"><i aria-hidden="true" class="fa fa-ellipsis-h"></i></button> 
                                <ul class="dropdown-menu">
                                    <?php if(Auth::user()->user_id == $user_bt->user_id ): ?>
                                    <li><a onclick="edit_post_bc('<?php echo e($user_bt->broadcast_id); ?>','Broadcast')"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Edit</a></li>
                                    <li><a onclick="make_bc_current('<?php echo e($user_bt->broadcast_id); ?>')">Set as Current</a></li>
                                    <!-- <?php if($user_details[0]->rem_credits > 0): ?> -->
                                    <li><a style="color:  #3097D1;font-weight:600;" onclick="boost_post_bc('<?php echo e($user_bt->broadcast_id); ?>','Broadcast')"><i class="fa fa-bolt" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Boost</a></li>
                                    <!--<?php endif; ?> -->
                                    <?php else: ?>
                                    <li><a onclick="report_post('<?php echo e($user_bt->broadcast_id); ?>','Broadcast')">Report</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                    <div class="wh_profile_pic_btm">
                                    <?php if($user_bt->is_online == 1): ?>    
                                        <span class="wh_profile_pic_top_active">
                                        <i class="fa fa-circle"></i>
                                    </span>
                                    <?php endif; ?>
                                    
                                    <?php if($user_bt->dp_changed == 1): ?>
                                     <img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src=<?php echo e($user_bt->profile_pic); ?>>&nbsp;&nbsp;
                                    <?php elseif($user_bt->facebook_profile_dp != NULL): ?>
                                      <img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src=<?php echo e($user_bt->facebook_profile_dp); ?>>&nbsp;&nbsp;
                                    <?php elseif($user_bt->google_profile_dp != NULL): ?>
                                      <img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src=<?php echo e($user_bt->google_profile_dp); ?>>&nbsp;&nbsp;
                                    <?php else: ?>
                                     <img style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src="<?php echo url('public/images/profile.png');?>">
                                    <?php endif; ?>
                                    
                                   
                                    
                                    
                                    
                                    
                                    </div>
                                <p class="distance"><?php echo e($user_bt->location); ?></p>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                 <div class="wh_name_btm">
                                    <p><?php echo e($user_details[0]->name); ?></p>
                                 </div>
                                 <div class="wh_brdcast_btm">
                                     <?php echo e($user_bt->description); ?>

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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                <br><br>
                <center><b>You have no other Broadcasts.</b></center>
                <br>
                <?php endif; ?>
                
            </div>
            
            <?php endif; ?>
                <?php endif; ?>
            </div>
            
            
            <div id="tab_swap_profile" class="tab-pane fade">
                <div class="swap_content">
                        <br><br><br>
                   
                        <ul id="waterfall_content_profile" style="list-style:none"> 
                            <?php if(count($user_swap)>0): ?>
                            <?php $__currentLoopData = $user_swap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $swap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                        
                            <div class="swap_list_item sw_normal_item">
        						<div class="swap_list_item_top">
        						    
        						     <?php if($swap->for_price != "" && $swap->for_goods != ""): ?> 
                                        <span style="z-index: 1;" class="price_tag"><i class="fa fa-inr" aria-hidden="true"></i>&nbsp; <?php echo e($swap->for_price); ?> or <?php echo e($swap->for_goods); ?></span>
                                   <?php elseif($swap->for_price == "" && $swap->for_goods != ""): ?>
                                        <span style="z-index: 1;" class="price_tag"><?php echo e($swap->for_goods); ?></span>
                                    <?php elseif($swap->for_price != "" && $swap->for_goods == ""): ?>
                                        <span style="z-index: 1;" class="price_tag"><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;<?php echo e($swap->for_price); ?></span>
                                     <?php elseif($swap->for_any == 1): ?>
                                        <span style="z-index: 1;" class="price_tag">&nbsp;Open for Anything</span>
                                    <?php elseif($swap->for_free == 1): ?>
                                        <span style="z-index: 1;" class="price_tag">&nbsp;For Free</span>        
                                    <?php endif; ?>
        						    
        						        
                                    <div class="sw_detail_thumb">                            
                                        <div class="swap_slider" style="margin:0px 0px;">
                                            <div id="carousel-custom<?php echo e($swap->swap_id); ?>" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-outer">
                                                    <!-- Wrapper for slides -->
                                                    <div class="carousel-inner">
                                                        
                                                        <?php for($i = 0; $i < count($swap->image); $i++): ?>
                                                        
                                                        <?php if($i==0): ?>
                                                        
                                                         <div class="item active">
                                                            <a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/swap/<?php echo e($swap->temp_title); ?>-<?php echo e($swap->swap_id); ?>"><img style="height:auto !important;" src="<?php echo e((new \App\Http\Controllers\Helper)->get_swap_image_loc()); ?><?php echo e($swap->image[$i]); ?>" alt=""></a>
                                                        </div>
                                                       
                                                        <?php else: ?>
                                                        <div class="item">
                                                            <a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/swap/<?php echo e($swap->temp_title); ?>-<?php echo e($swap->swap_id); ?>"><img style="height:auto !important;" src="<?php echo e((new \App\Http\Controllers\Helper)->get_swap_image_loc()); ?><?php echo e($swap->image[$i]); ?>" alt=""></a>
                                                        </div>
                                                         <?php endif; ?>
                                                        <?php endfor; ?>
                                                        
                                                        
                                                       
                                                    </div>  
                                                    <?php if(count($swap->image) > 1): ?>
                                                    <!-- Controls -->
                                                    <a class="left carousel-control" href="#carousel-custom<?php echo e($swap->swap_id); ?>" data-slide="prev">
                                                        <span class="fa fa-chevron-left"></span>
                                                    </a>
                                                    <a class="right carousel-control" href="#carousel-custom<?php echo e($swap->swap_id); ?>" data-slide="next">
                                                        <span class="fa fa-chevron-right"></span>
                                                    </a>
                                                    <?php endif; ?>
                                                </div>                            
                                                <!-- Indicators -->
                                                
            
                                            </div>
                                         </div>
                                     </div
        								
        								
        								
        								
        								
        								
        								
        								
        						</div>
        						<div class="swap_list_item_btm">
        							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 swap_prof_pic_wrap">
        							     <?php if($swap->is_online == 1): ?>    
        								    <span class="swap_prof_online_batch"><i class="fa fa-circle"></i></span>
        								<?php endif; ?>
        								
        								<?php if($swap->dp_changed == 1): ?>
                                            <img src=<?php echo e($swap->profile_pic); ?>>&nbsp;&nbsp;
                                        <?php elseif($swap->google_profile_dp != NULL): ?>
                                            <img src=<?php echo e($swap->google_profile_dp); ?>>&nbsp;&nbsp;
                                        <?php elseif($swap->facebook_profile_dp != NULL): ?>
                                            <img src=<?php echo e($swap->facebook_profile_dp); ?>>&nbsp;&nbsp;
                                        <?php else: ?>
                                            <img src="<?php echo url('public/images/profile.png');?>">&nbsp;&nbsp;
                                        <?php endif; ?>
        								
        								
        								
        								<p><?php echo e($swap->location); ?>  </p>
        							</div>
        							<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 swap_title_wrap">
        							    <?php if(Auth::user()): ?>
        							    <div class="dropdown" style="float:right">
                                                <button type="button" data-toggle="dropdown" class="btn" aria-expanded="false"><i aria-hidden="true" class="fa fa-ellipsis-h"></i></button> 
                                                <ul class="dropdown-menu">
                                                    <?php if(Auth::user()->user_id == $swap->user_id ): ?>
                                                   <!-- <?php if($user_details[0]->rem_credits > 0): ?> -->
                                                    <li><a style="color:  #3097D1;font-weight:600;" onclick="boost_post_bc('<?php echo e($swap->swap_id); ?>','Swap')"><i class="fa fa-bolt" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Boost</a></li>
                                                   <!-- <?php endif; ?>  -->
                                                    <li><a onclick="edit_post_sw('<?php echo e($swap->swap_id); ?>','Swap')">Edit</a></li>
                                                    <?php else: ?>
                                                    <li><a onclick="report_post('<?php echo e($swap->swap_id); ?>','Swap')">Report</a></li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>    
        									<h4><a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/swap/<?php echo e($swap->temp_title); ?>-<?php echo e($swap->swap_id); ?>"><?php echo e($swap->title); ?></a></h4>
        									
        									<p>Updated : 5 hours ago</p>
        									
        							</div>
        							<div class="clearfix"></div>
        						</div>
                            </div>
                        
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                    <br><br>
                                    <center><b>User has no Swap yet.</b></center>
                                    <br>
                            <?php endif; ?>
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
                    <?php $__currentLoopData = $user_localvocal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_lv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="lv_post_list">
                            <div class="lv_post_list_top">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-8 lv_post_name">
                                    
                                    <?php if($user_lv->dp_changed == 1): ?>
                                    <img src=<?php echo e($user_lv->profile_pic); ?>>&nbsp;&nbsp;
                                    <?php elseif($user_lv->google_profile_dp != NULL): ?>
                                    <img src=<?php echo e($user_lv->google_profile_dp); ?>>&nbsp;&nbsp;
                                    <?php elseif($user_lv->facebook_profile_dp != NULL): ?>
                                    <img src=<?php echo e($user_lv->facebook_profile_dp); ?>>&nbsp;&nbsp;
                                    <?php else: ?>
                                    <img src="<?php echo url('public/images/profile.png');?>">&nbsp;&nbsp;
                                    <?php endif; ?>
                                    
                                    
                                   <?php echo e($user_lv->name); ?>

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
                                            
                                            <?php if($j == 0): ?>
                                             <div class="item active">
                                                <img src="<?php echo e((new \App\Http\Controllers\Helper)->get_lv_image_loc()); ?><?php echo e($user_lv->images[$j]); ?>" alt="">
                                            </div>
                                           
                                          <?php else: ?>
                                            <div class="item">
                                                <img src="<?php echo e((new \App\Http\Controllers\Helper)->get_lv_image_loc()); ?><?php echo e($user_lv->images[$j]); ?>" alt="">
                                            </div>
                                            <?php endif; ?>
                                            
                                            <?php
                                           }
                                            ?>
                                           
                                        </div>            
                                        <!-- Controls -->
                                        <?php if(count($user_lv->images) > 1): ?>
                                        <a class="left carousel-control" href="#carousel-custom" data-slide="prev">
                                            <span class="fa fa-chevron-left"></span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-custom" data-slide="next">
                                            <span class="fa fa-chevron-right"></span>
                                        </a>
                                        <?php endif; ?>
                                    </div>                            
                                    <!-- Indicators -->
                                    

                                </div>
                             </div>
                        </div>
                            <div class="lv_post_list_text">
                                <b><?php echo e($user_lv->title); ?></b>
                                <br>
                                <br>
                                 <?php echo e($user_lv->description); ?>

                            </div>
                            <div class="lv_post_list_view_cmts">
                                 View all <?php echo e(count($user_lv->comments)); ?> comments
                            </div>
                            <div id="<?php echo e($user_lv->lv_id); ?>" class="lv_post_list_cmts_wrap">
                                <?php $__currentLoopData = $user_lv->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <div class="post-comment" id="1" style="display:inline-flex;margin: 10px auto;">
                                     
                                    <?php if($comment->dp_changed == 1): ?>
                                    <img style="margin-right: 10px;" class="profile-photo-sm" src=<?php echo e($comment->profile_pic); ?>>&nbsp;&nbsp;
                                    <?php elseif($comment->google_profile_dp != NULL): ?>
                                    <img style="margin-right: 10px;" class="profile-photo-sm" src=<?php echo e($comment->google_profile_dp); ?>>&nbsp;&nbsp;
                                    <?php elseif($comment->facebook_profile_dp != NULL): ?>
                                    <img style="margin-right: 10px;" class="profile-photo-sm" src=<?php echo e($comment->facebook_profile_dp); ?>>&nbsp;&nbsp;
                                    <?php else: ?>
                                    <img style="margin-right: 10px;" class="profile-photo-sm" src="<?php echo url('public/images/profile.png');?>">&nbsp;&nbsp;
                                    <?php endif; ?>
                                     <p><a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>\user\<?php echo e($comment->user_id); ?>" class="profile-link"><?php echo e($comment->name); ?> </a><i class="em em-laughing"></i> <?php echo e($comment->comment); ?> </p>
                                    
                                   
                                    </div> 
                                    
                                    <br/>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 
                                 
                            </div>
                            <?php if(Auth::user()): ?>
                            
                             <div class="post-comment" style="display:inline-flex;margin: 10px auto;">
                             <?php if(Auth::user()->dp_changed == 1): ?>
                                <img style="margin-left: 22px;margin-right: 10px;" class="profile-photo-sm" src=<?php echo e(Auth::user()->profile_pic); ?>>&nbsp;&nbsp;
                                <?php elseif(Auth::user()->google_profile_dp != NULL): ?>
                                <img style="margin-left: 22px;margin-right: 10px;" class="profile-photo-sm" src=<?php echo e(Auth::user()->google_profile_dp); ?>>&nbsp;&nbsp;
                                <?php elseif(Auth::user()->facebook_profile_dp != NULL): ?>
                                <img style="margin-left: 22px;margin-right: 10px;" class="profile-photo-sm" src=<?php echo e(Auth::user()->facebook_profile_dp); ?>>&nbsp;&nbsp;
                                <?php else: ?>
                                <img style="margin-left: 22px;margin-right: 10px;" class="profile-photo-sm" src="<?php echo url('public/images/profile.png');?>">&nbsp;&nbsp;
                            <?php endif; ?>

                             <input onkeypress="return savecomment(event,<?php echo e($user_lv->id); ?>)" id="cmt_<?php echo e($user_lv->lv_id); ?>" style="width:570px !important" type="text" placeholder="Post a comment" class="form-control"></div>
                            <?php endif; ?>
                            <div class="lv_post_list_btm">
                                <div onclick="like_unlike_lv(<?php echo e($user_lv->id); ?>)" class="col-lg-2 col-md-2 col-sm-3 col-xs-4 lv_post_like<?php echo e($user_lv->lv_id); ?>">
                                
                            		<?php if($user_lv->like_status == "liked"): ?>
                            			<i style="color:#ed474f !important" class="fa fa-heart"></i>&nbsp;&nbsp;<?php echo e($user_lv->likes_count); ?>

                            		<?php else: ?>
                            			<i style="color:unset !important;" class="fa fa-heart"></i>&nbsp;&nbsp;<?php echo e($user_lv->likes_count); ?>

                            		<?php endif; ?>
                                </div>
                                
                                <div onclick="show_comments()" class="col-lg-2 col-md-2 col-sm-3 col-xs-4 lv_post_cmt">
                            		<i class="fa fa-comment-o" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo e(count($user_lv->comments)); ?>

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
                            		 <li><a onclick="report_post('<?php echo e($user_lv->lv_id); ?>','LocalVocal')">Report</a></li>              
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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                </div>
            </div> <!-- End LV -->
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div> 
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>