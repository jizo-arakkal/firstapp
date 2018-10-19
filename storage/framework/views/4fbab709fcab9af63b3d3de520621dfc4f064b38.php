<?php $__env->startSection('content'); ?>
<div class="container page_content_wrap">  
        
    <br><br>

    <div class="timeline">
        <?php if(Auth::user()->facebook_cover_pic!=""): ?>
        <div class="timeline-cover" style="background:url(<?php echo e(Auth::user()->facebook_cover_pic); ?>);background-position: center;background-size: cover;">
        <?php elseif(Auth::user()->cover_changed == 1): ?>
        <div class="timeline-cover" style="background:url(<?php echo e(Auth::user()->cover_pic); ?>);background-position: center;background-size: cover;">
        <?php else: ?>
        <div class="timeline-cover" style="background:url(<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/public/images/1030x360.png);background-position: center;background-size: cover;">
        <?php endif; ?>              

            <!--Timeline Menu for Large Screens-->
            <div class="timeline-nav-bar hidden-sm hidden-xs">
                <div class="row">
                  <div class="col-md-3">
                    <div class="profile-info">
                      <div class="cont">
                          
                          <?php if(Auth::user()->dp_changed == 1): ?>
                          <div class="image1"><img src="<?php echo e(Auth::user()->profile_pic); ?>" alt="" class="img-responsive profile-photo" /></div>
                          <?php else: ?>
                          
                        <div class="image"><img src="<?php echo e(Auth::user()->facebook_profile_dp); ?>" alt="" class="img-responsive profile-photo" /></div>
                        <?php endif; ?>
                       
                      </div>
                      <!--<h3 style="text-align:left"><?php echo e(Auth::user()->name); ?></h3>
                      <?php if($user_details!="" ): ?>
                            <?php if($user_details[0]->profession != ""): ?>
                            <p style="text-align:left" class="text-muted"><?php echo e($user_details[0]->profession); ?></p>
                            <?php else: ?>
                            <p style="text-align:left" class="text-muted"></p>
                            <?php endif; ?>
                      <?php else: ?>
                        <p style="text-align:left" class="text-muted"></p>
                      <?php endif; ?> -->
                    
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
                      <li style="padding-right:  45px;padding-top: 14px;">You have <?php echo e(count($update_data_followers)); ?> follower(s)</li>
                      <!-- <li><button class="btn-primary">Add Friend</button></li> -->
                    </ul>
                  </div>
                </div>
            </div><!--Timeline Menu for Large Screens End-->

              <!--Timeline Menu for Small Screens-->
            <div class="navbar-mobile hidden-lg hidden-md">
                <div class="profile-info">
                <?php if(Auth::user()->dp_changed == 1): ?>
                        <div class="img-responsive profile-photo"><img src="<?php echo e(Auth::user()->profile_pic); ?>" alt="" class="img-responsive profile-photo" /></div>
                        <?php elseif(Auth::user()->facebook_profile_dp != ""): ?>
                        
                        <div class="img-responsive profile-photo"><img src="<?php echo e(Auth::user()->facebook_profile_dp); ?>" alt="" class="img-responsive profile-photo" /></div>
                        <?php elseif(Auth::user()->google_profile_dp != ""): ?>
                        <div class="img-responsive profile-photo"><img src="<?php echo e(Auth::user()->google_profile_dp); ?>" alt="" class="img-responsive profile-photo" /></div>
                        <?php else: ?>
                        <div class="img-responsive profile-photo"><img src="public/images/profile.png" alt="" class="img-responsive profile-photo" /></div>
                        <?php endif; ?>
                 
                  
                   <!--  <?php if($user_details!=""): ?>
                       <!-- <?php if($user_details[0]->profession != ""): ?>
                        <p class="text-muted"><?php echo e($user_details[0]->profession); ?></p>
                        <?php else: ?>
                        <p class="text-muted"></p>
                        <?php endif; ?> -->
                   <!-- <?php else: ?>
                        <p class="text-muted"></p>
                    <?php endif; ?>   -->
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
                            
                            
                            <?php if($update_data_followers!= ""): ?>
                            <h4> Your Followers </h4>
                                <?php $__currentLoopData = $update_data_followers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $follower): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-sm-2">    
                                    <div class="friend-card">
                              	
                              	        <div class="card-info">
                              	            
                              	            
                              	            <?php if($follower[0]->dp_changed == 1): ?>
                                                <img src="<?php echo e($follower[0]->profile_pic); ?>" alt="" class="profile-photo-lg" />
                                            <?php elseif($follower[0]->facebook_profile_dp!= ''): ?>
                                                
                                                <img src="<?php echo e($follower[0]->facebook_profile_dp); ?>" alt="" class="profile-photo-lg" />
                                                
                                             <?php elseif($follower[0]->google_profile_dp!= ''): ?>
                                                
                                                <img src="<?php echo e($follower[0]->google_profile_dp); ?>" alt="" class="profile-photo-lg" />
                                                
                                            <?php else: ?>
                                                <img src="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/public/images/profile.png" alt="" class="profile-photo-lg" />
                                                
                                            <?php endif; ?>
                              	            
            
                                            
                                            <div class="friend-info">
                                               
                                  	            <h5><a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/user/<?php echo e($follower[0]->user_id); ?>" class="profile-link"><?php echo e($follower[0]->name); ?></a></h5>
                                  	            
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            
                            You have no followers!
                            
                            <?php endif; ?>
                            
                            
                            
            
                            
                        </div>

                    </div>
                    
                    <div role="tabpanel" class="tab-pane " id="following">
                       
                        <?php if(!empty($update_data_following)): ?>
                        <?php $__currentLoopData = $update_data_following; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $following): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           
                            <div class="col-sm-2">    
                                <div class="friend-card">
                          	
                          	        <div class="card-info"> 
                          	                <?php if($following[0]->dp_changed == 1): ?>
                                                <img src="<?php echo e($following[0]->profile_pic); ?>" alt="" class="profile-photo-lg" />
                                            <?php elseif($following[0]->facebook_profile_dp!= ''): ?>
                                                
                                                <img src="<?php echo e($following[0]->facebook_profile_dp); ?>" alt="" class="profile-photo-lg" />
                                            <?php else: ?>
                                                <img src="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/public/images/300x300.png" alt="" class="profile-photo-lg" />
                                                
                                            <?php endif; ?>
                                        <div class="friend-info">
                                           
                              	            <h5><a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/user/<?php echo e($following[0]->user_id); ?>" class="profile-link"><?php echo e($following[0]->name); ?></a></h5>
                              	            <p><?php echo e($following[0]->profession); ?></p>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            
                            You are not following anyone!    
                            <?php endif; ?>
                        
                        
                    </div>
                  
                  
                </div>
           
        </div>
        
            
            
          
        </div> <!--page contents End-->
        
        
    </div> <!--Timeline End-->
        
       
        
</div>
        














<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>