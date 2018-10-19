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
                          <a style="color:white;text-decoration:none;" class="upload_dp" data-toggle="modal">
                          <?php if(Auth::user()->dp_changed == 1): ?>
                          <div class="image1"><img src="<?php echo e(Auth::user()->profile_pic); ?>" alt="" class="img-responsive profile-photo" /></div>
                          <?php else: ?>
                          
                        <div class="image1"><img src="<?php echo e(Auth::user()->facebook_profile_dp); ?>" alt="" class="img-responsive profile-photo" /></div>
                        <?php endif; ?>
                        </a>
                      </div>
                      <!-- <h3 style="text-align:left"><?php echo e(Auth::user()->name); ?></h3>
                       <?php if($user_details!="" ): ?>
                            <?php if($user_details[0]->profession != ""): ?>
                            <p style="text-align:left" class="text-muted"><?php echo e($user_details[0]->profession); ?></p>
                            <?php else: ?>
                            <p style="text-align:left" class="text-muted"></p>
                            <?php endif; ?>
                      <?php else: ?>
                        <p style="text-align:left" class="text-muted"></p>
                      <?php endif; ?>
                    -->
                    </div>
                  </div>
                  <div class="col-md-9">
                    <ul class="list-inline profile-menu">
                      <!-- <li><a href="timeline.html">Timeline</a></li> -->
                      <li><a class="active"><?php echo e(Auth::user()->name); ?></a></li>
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
                  <h4><?php echo e(Auth::user()->name); ?></h4>
                    <?php if($user_details!=""): ?>
                       <!-- <?php if($user_details[0]->profession != ""): ?>
                        <p class="text-muted"><?php echo e($user_details[0]->profession); ?></p>
                        <?php else: ?>
                        <p class="text-muted"></p>
                        <?php endif; ?> -->
                    <?php else: ?>
                        <p class="text-muted"></p>
                    <?php endif; ?>   
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
            <?php if(empty($user_notifications) || $user_notifications == '' || $user_notifications == NULL): ?>
            You have no new notifications
            <?php endif; ?>
            <?php $__currentLoopData = $user_notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_noti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            
                <div id=<?php echo e($user_noti->id); ?>>
                    <div class="noti-box">
                        <?php if($user_noti->dp_changed == 1): ?>
                         <img class="profile-photo-sm" style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src=<?php echo e($user_noti->profile_pic); ?>>&nbsp;&nbsp;
                        <?php elseif($user_noti->facebook_profile_dp != NULL): ?>
                          <img class="profile-photo-sm" style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src=<?php echo e($user_noti->facebook_profile_dp); ?>>&nbsp;&nbsp;
                        <?php elseif($user_noti->google_profile_dp != NULL): ?>
                          <img class="profile-photo-sm" style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src=<?php echo e($user_noti->google_profile_dp); ?>>&nbsp;&nbsp;
                        <?php else: ?>
                         <img class="profile-photo-sm" style="border-radius: 40px;border-width: 1px;border-color: #3cc0c7;border-style: solid;" src="<?php echo url('public/images/profile.png');?>">
                        <?php endif; ?>
                        
                        
                        &nbsp;&nbsp;&nbsp; <?php echo e($user_noti->message); ?> 
                        
                           
                        <?php
                        
                            $result = mb_substr($user_noti->link_id, 0, 2);
                       
                        ?>
                            <?php if($result=='SW'): ?>
                            
                            
                        <i onclick=trash(<?php echo e($user_noti->id); ?>) class="fas fa-trash-alt" style="float:  right;margin-top: 13px;"></i>
                        
                         <a target="_blank" href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/swap/<?php echo e($user_noti->link_id); ?>/<?php echo e($user_noti->from_user_id); ?>/1">
                            <i class="fa fa-eye" style="float:  right;margin-top: 13px;padding-right: 20px;"></i>
                        </a> 
                            
                             <?php elseif($result=='LV'): ?>
                            
                            
                        <i onclick=trash(<?php echo e($user_noti->id); ?>) class="fas fa-trash-alt" style="float:  right;margin-top: 13px;"></i>
                        
                         <a target="_blank" href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/lv/<?php echo e($user_noti->link_id); ?>">
                            <i class="fa fa-eye" style="float:  right;margin-top: 13px;padding-right: 20px;"></i>
                        </a> 
                            <?php endif; ?>
                    </div>       
                </div>
            
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
            </div>
            <div style="margin-left:-22px;" class="col-md-4 static">
              
              <div class="lv_right_ad_wrap"></div>
              <div class="lv_right_ad_wrap"></div>
              
            </div>
          </div>
        </div>
        
        
    </div> <!--Timeline End-->
        
       
        
</div>
        














<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>