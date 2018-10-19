<?php $__env->startSection('content'); ?>
<div class="container page_content_wrap">  
        
    <br><br>
   
    <div class="timeline">
        <?php if(Auth::user()->facebook_cover_pic!=""): ?>
        <div class="timeline-cover" style="background:url(<?php echo e(Auth::user()->facebook_cover_pic); ?>);background-position: center;background-size: cover;">
        <?php elseif(Auth::user()->cover_changed == 1): ?>
        <div class="timeline-cover" onclick="upload_cover()" style="background:url(<?php echo e(Auth::user()->cover_pic); ?>);background-position: center;background-size: cover;">
        <?php else: ?>
        <div class="timeline-cover" onclick="upload_cover()" style="background:url(<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/public/images/1030x360.png);background-position: center;background-size: cover;">
        <?php endif; ?>              

            <!--Timeline Menu for Large Screens-->
            <div class="timeline-nav-bar hidden-sm hidden-xs">
                <div class="row">
                  <div class="col-md-3">
                    <div class="profile-info">
                      <div class="cont">
                        <a style="color:white;text-decoration:none;" class="upload_dp" data-toggle="modal" onclick="show_upload_dp_modal()">
                        <?php if(Auth::user()->dp_changed == 1): ?>
                        <div class="image"><img src="<?php echo e(Auth::user()->profile_pic); ?>" alt="" class="img-responsive profile-photo" /></div>
                        <?php elseif(Auth::user()->facebook_profile_dp != ""): ?>
                        
                        <div class="image"><img src="<?php echo e(Auth::user()->facebook_profile_dp); ?>" alt="" class="img-responsive profile-photo" /></div>
                        <?php elseif(Auth::user()->google_profile_dp != ""): ?>
                        <div class="image"><img src="<?php echo e(Auth::user()->google_profile_dp); ?>" alt="" class="img-responsive profile-photo" /></div>
                        <?php else: ?>
                        <div class="image"><img src="public/images/profile.png" alt="" class="img-responsive profile-photo" /></div>
                        <?php endif; ?>
                        <!-- <div class="middle"><div class="text">Update Profile Picture</div></div> --></a>
                      </div>
                      <!-- <h3 style="text-align:left"><?php echo e(Auth::user()->name); ?></h3> -->
                      <!-- <?php if($user_details!="" && !empty($user_details)): ?>
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
                      <li><a class="active">Your Profile</a></li>
                      <!-- <li><a href="timeline-album.html">Album</a></li>
                      <li><a href="timeline-friends.html">Friends</a></li> -->
                    </ul>
                    <ul class="follow-me list-inline">
                      <li style="padding-right:  45px;padding-top: 14px;"> <a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/followers">Your followers</a></li>
                      <!-- <li><button class="btn-primary">Add Friend</button></li> -->
                    </ul>
                  </div>
                </div>
            </div><!--Timeline Menu for Large Screens End-->

              <!--Timeline Menu for Small Screens-->
            <div class="navbar-mobile hidden-lg hidden-md">
                <div class="profile-info">
                    
                 <?php if(Auth::user()->dp_changed == 1): ?>
                        <div class="image"><img src="<?php echo e(Auth::user()->profile_pic); ?>" alt="" class="img-responsive profile-photo" /></div>
                        <?php elseif(Auth::user()->facebook_profile_dp != ""): ?>
                        
                        <div class="image"><img src="<?php echo e(Auth::user()->facebook_profile_dp); ?>" alt="" class="img-responsive profile-photo" /></div>
                        <?php elseif(Auth::user()->google_profile_dp != ""): ?>
                        <div class="image"><img src="<?php echo e(Auth::user()->google_profile_dp); ?>" alt="" class="img-responsive profile-photo" /></div>
                        <?php else: ?>
                        <div class="image"><img src="public/images/profile.png" alt="" class="img-responsive profile-photo" /></div>
                        <?php endif; ?>
                  <h4><?php echo e(Auth::user()->name); ?></h4>
                    <?php if(!empty($user_details) && !is_null($user_details)): ?>
                        <?php if(!empty($user_details[0]->profession)): ?>
                        <p class="text-muted"><?php echo e($user_details[0]->profession); ?></p>
                        <?php else: ?>
                        <p class="text-muted"></p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="text-muted"></p>
                    <?php endif; ?>   
                </div>
                <div class="mobile-menu">
                  <ul class="list-inline">
                    <!-- <li><a href="timline.html">Timeline</a></li> -->
                    <li><a href="timeline-about.html" class="active">Your Profile</a></li>
                    <!-- <li><a href="timeline-album.html">Album</a></li>
                    <li><a href="timeline-friends.html">Friends</a></li> -->
                  </ul>
                  <button class="btn-primary">Add Friend</button>
                </div>
            </div><!--Timeline Menu for Small Screens End-->
        </div> <!--Timeline cover End-->
        
        
        
    <div id="page-contents">
            
        <div class="row">
            <div class="col-sm-3">
                <ul class="nav nav-tabs tabs-left" role="tablist">
                  <li role="presentation" class="active"><a href="#basic_info" aria-controls="home" role="tab" data-toggle="tab"><i class="fas fa-info"></i>&nbsp;&nbsp;&nbsp; Basic Information</a></li>
                  <li role="presentation"><a href="#settings" aria-controls="profile" role="tab" data-toggle="tab"><i class="fas fa-sliders-h"></i>&nbsp;&nbsp; Account Settings</a></li>
                  <li role="presentation"><a href="#change_password" aria-controls="messages" role="tab" data-toggle="tab"><i class="fas fa-unlock-alt"></i>&nbsp;&nbsp; Change Password</a></li>
                 <!-- <li role="presentation"><a target="_blank" href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/user/<?php echo e(Auth::user()->user_id); ?>"><i aria-hidden="true" class="fa fa-eye"></i> &nbsp; View Profile</a></li> -->
                  <!--<li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li> -->
                </ul>
             </div>
            <div class="col-sm-8">
                <div class="tab-content">
                    
                    <div role="tabpanel" class="tab-pane active" id="basic_info">
                        
                        <div class="edit-profile-container">
                            <div class="block-title">
                              <h4 class="grey"><i class="fas fa-info"></i>Basic information</h4>
                              <div class="line"></div>
                            </div>
                            <div class="edit-block">
                              <form name="basic-info" id="basic-info" class="form-inline">
                                <div class="row">
                                  <div class="form-group col-xs-6">
                                    <label for="firstname">First name</label>
                                    <?php if(Auth::user()->name==""): ?>
                                    <input id="firstname" class="form-control input-group-lg" type="text" name="firstname" title="Enter first name" placeholder="First name" value="" />
                                    <?php else: ?>
                                    <input id="firstname" class="form-control input-group-lg" type="text" name="firstname" title="Enter first name" placeholder="First name" value="<?php echo e(Auth::user()->name); ?>" />
                                    <?php endif; ?>
                                  </div>
                                  <div class="form-group col-xs-6">
                                    <label for="lastname" class="">Last name</label>
                                     <?php if(Auth::user()->last_name==""): ?>
                                    <input id="lastname" class="form-control input-group-lg" type="text" name="lastname" title="Enter last name" placeholder="Last name" value="" />
                                    <?php else: ?>
                                     <input id="lastname" class="form-control input-group-lg" type="text" name="lastname" title="Enter last name" placeholder="Last name" value="<?php echo e(Auth::user()->last_name); ?>" />
                                     <?php endif; ?>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-xs-12">
                                    <label for="email">My email</label>
                                    <?php if(Auth::user()->email==""): ?>
                                    <input id="email" class="form-control input-group-lg" type="text" name="email" title="Enter Email" placeholder="My Email" value="" />
                                    <?php else: ?>
                                    <input id="email" class="form-control input-group-lg" type="text" name="email" title="Enter Email" placeholder="My Email" value="<?php echo e(Auth::user()->email); ?>" />
                                  </div>
                                  <?php endif; ?>
                                </div>
                                <div class="row">
                                  <p class="custom-label"><strong>Date of Birth</strong></p>
                                  <div class="form-group col-sm-3 col-xs-6">
                                    <label for="month" class="sr-only"></label>
                                    <select class="form-control" name="day" id="day">
                                        
                                         <?php if($dd!=""): ?>
                                       <option value="<?php echo e($dd); ?>" selected><?php echo e($dd); ?></option>
                                       <?php else: ?>
                                      <option value="day" selected>Day</option>
                                      <?php endif; ?>
                                     
                                      <option value="01">1</option>
                                      <option value="02">2</option>
                                      <option value="03">3</option>
                                      <option value="04">4</option>
                                      <option value="05">5</option>
                                      <option value="06">6</option>
                                      <option value="07">7</option>
                                      <option value="08">8</option>
                                      <option value="09">9</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                      <option value="13">13</option>
                                      <option value="14">14</option>
                                      <option value="15">15</option>
                                      <option value="16">16</option>
                                      <option value="17">17</option>
                                      <option value="18">18</option>
                                      <option value="19">19</option>
                                      <option value="21">20</option>
                                      <option value="21">21</option>
                                      <option value="22">22</option>
                                      <option value="23">23</option>
                                      <option value="24">24</option>
                                      <option value="25">25</option>
                                      <option value="26">26</option>
                                      <option value="27">27</option>
                                      <option value="28">28</option>
                                      <option value="29">29</option>
                                      <option value="30">30</option>
                                      <option value="31">31</option>
                                    </select>
                                  </div>
                                  <div class="form-group col-sm-3 col-xs-6">
                                    <label for="month" class="sr-only"></label>
                                    <select class="form-control" name="month" id="month">
                                      
                                      <?php if($mm!=""): ?>
                                       <option value="<?php echo e($mm); ?>" selected><?php echo e($mm); ?></option>
                                       <?php else: ?>
                                      <option value="month" selected>Month</option>
                                      <?php endif; ?>
                                      <option value="01">01</option>
                                      <option value="02">02</option>
                                      <option value="03">03</option>
                                      <option value="04">04</option>
                                      <option value="05">05</option>
                                      <option value="06">06</option>
                                      <option value="07">07</option>
                                      <option value="08">08</option>
                                      <option value="09">09</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                    </select>
                                  </div>
                                  <div class="form-group col-sm-6 col-xs-12">
                                    <label for="year" class="sr-only"></label>
                                    <select class="form-control" name="year" id="year">
                                        
                                         <?php if($yyyy!=""): ?>
                                            <option value="<?php echo e($yyyy); ?>" selected><?php echo e($yyyy); ?></option>
                                        <?php else: ?>
                                             <option value="year" selected>Year</option>
                                        <?php endif; ?>
                                       
                                        <option value="1960">1960</option>
                                        <option value="1961">1961</option>
                                        <option value="1962">1962</option>
                                        <option value="1963">1963</option>
                                        <option value="1964">1964</option>
                                        <option value="1965">1965</option>
                                        <option value="1966">1966</option>
                                        <option value="1967">1967</option>
                                        <option value="1968">1968</option>
                                        <option value="1969">1969</option>
                                        <option value="1970">1970</option>
                                        
                                        <option value="1971">1971</option>
                                        <option value="1972">1972</option>
                                        <option value="1973">1973</option>
                                        <option value="1974">1974</option>
                                        <option value="1975">1975</option>
                                        <option value="1976">1976</option>
                                        <option value="1977">1977</option>
                                        <option value="1978">1978</option>
                                        <option value="1979">1979</option>
                                        
                                        <option value="1980">1980</option>
                                        <option value="1981">1981</option>
                                        <option value="1982">1982</option>
                                        <option value="1983">1983</option>
                                        <option value="1984">1984</option>
                                        <option value="1985">1985</option>
                                        <option value="1986">1986</option>
                                        <option value="1987">1987</option>
                                        <option value="1988">1988</option>
                                        <option value="1989">1989</option>
                                        <option value="1990">1990</option>
                                        <option value="1991">1991</option>
                                        <option value="1992">1992</option>
                                        <option value="1993">1993</option>
                                        <option value="1994">1994</option>
                                        <option value="1995">1995</option>
                                        <option value="1996">1996</option>
                                        <option value="1997">1997</option>
                                        <option value="1998">1998</option>
                                        <option value="1999">1999</option>
                                        <option value="2000">2000</option>
                                        <option value="2001">2001</option>
                                        <option value="2002">2002</option>
                                     
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group gender">
                                  <span class="custom-label"><strong>I am a: </strong></span>
                                  <?php if(Auth::user()->gender == ""): ?>
                                  <label class="radio-inline">
                                    <input type="radio" value="male" name="gender">Male
                                  </label>
                                  <label class="radio-inline">
                                    <input type="radio" value ="female" name="gender">Female
                                  </label>
                                  <?php elseif(Auth::user()->gender == "male"): ?>
                                  <label class="radio-inline">
                                    <input type="radio" value="male" name="gender" checked>Male
                                  </label>
                                  <label class="radio-inline">
                                    <input type="radio" value ="female" name="gender">Female
                                  </label>
                                   <?php elseif(Auth::user()->gender == "female"): ?>
                                  <label class="radio-inline">
                                    <input type="radio" value="male" name="gender" >Male
                                  </label>
                                  <label class="radio-inline">
                                    <input type="radio" value ="female" name="gender" checked>Female
                                  </label>
                                  
                                  <?php endif; ?>
                                </div>
                                <div class="row">
                                  <div class="form-group col-xs-6">
                                    <label for="city"> Current Location</label>
                                    <?php if(!empty($user_details) && !empty($user_details)): ?>
                                      <?php if(!empty($user_details[0]->current_location)): ?>
                                    <input id="pac-input-settings" class="form-control input-group-lg" type="text" name="city" title="Your location" placeholder="Your city" value="<?php echo e($user_details[0]->current_location); ?>"/>
                                    <?php else: ?>
                                    <input id="pac-input-settings" class="form-control input-group-lg" type="text" name="city" title="Your Location" placeholder="Your city" value=""/>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                  </div>
                                  <div class="form-group col-xs-6">
                                    <label for="profession"> My Profession</label>
                                    <?php if(!empty($user_details) && !empty($user_details)): ?>
                                        <?php if(!empty($user_details[0]->profession)): ?>
                                         <input id="profession" class="form-control input-group-lg" type="text" value="<?php echo e($user_details[0]->profession); ?>" name="profession" title="Enter profession" placeholder="Your profession" />
                                         <?php else: ?>
                                        <input id="profession" class="form-control input-group-lg" type="text" name="profession" title="Enter profession" placeholder="Your profession" />
                                        <?php endif; ?>
                                    <?php else: ?>
                                    <input id="profession" class="form-control input-group-lg" type="text" name="profession" title="Enter profession" placeholder="Your profession" />
                                    <?php endif; ?>
                                    <!-- value="New York" -->
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-xs-6">
                                    <label for="city">Mobile Number</label>
                                    <?php if(Auth::user()->mobile == ""): ?>
                                    <input id="mobile" class="form-control input-group-lg" type="text" name="mobile" title="Enter mobile number" placeholder="Your mobile number"/>
                                    <?php else: ?>
                                     <input id="mobile" class="form-control input-group-lg" type="text" name="mobile" title="Enter mobile number" placeholder="Your mobile number" value="<?php echo e(Auth::user()->mobile); ?>" />
                                     <?php endif; ?>
                                  </div>
                                  <div class="form-group col-xs-6">
                                    <!--  <label for="profession"> My Profession</label>
                                    <input id="profession" class="form-control input-group-lg" type="text" name="profession" title="Enter profession" placeholder="Your profession" />
                                              value="New York" -->
                                  </div>
                                </div>
                                
                                
                                
                                <div class="row">
                                  <div class="form-group col-xs-12">
                                    <label for="my-info">About me</label>
                                    <?php if(!empty($user_details)): ?> 
                                        <?php if(!empty($user_details[0]->about_me )): ?>
                                        <textarea id="aboutme" name="aboutme" class="form-control" placeholder="Describe yourself" rows="4" cols="400"><?php echo e($user_details[0]->about_me); ?></textarea>
                                        <?php else: ?>
                                        <textarea id="aboutme" name="aboutme" class="form-control" placeholder="Describe yourself" rows="4" cols="400"></textarea>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <textarea id="aboutme" name="aboutme" class="form-control" placeholder="Describe yourself" rows="4" cols="400"></textarea>
                                    <?php endif; ?> 
                                  </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                              </form>
                            </div>
                        </div>
                        
                        
                    </div>
                    
                    <div role="tabpanel" class="tab-pane " id="settings">
                        <div class="edit-profile-container">
                            <div class="block-title">
                                <h4 class="grey"><i class="fas fa-sliders-h"></i>Account Settings</h4>
                                <div class="line"></div>
                            </div>
                            <div class="edit-block">
                                <div class="settings-block">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <div class="switch-description">
                                                <div><strong>Enable follow me</strong></div>
                                                <p>Enable this if you want people to follow you</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="toggle-switch">
                                                <label class="switch">
                                                    <input name="follow" id="follow" value="follow" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                     </div>
                                </div>
                                <div class="line"></div>
                                <div class="settings-block">
                                    <div class="row">
                                      <div class="col-sm-9">
                                        <div class="switch-description">
                                          <div><strong>Send me notifications</strong></div>
                                          <p>Send me notification emails my friends like, share or message me</p>
                                        </div>
                                      </div>
                                      <div class="col-sm-3">
                                        <div class="toggle-switch">
                                          <label class="switch">
                                            <input type="checkbox" checked>
                                            <span class="slider round"></span>
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="line"></div>
                                <div class="settings-block">
                                    <div class="row">
                                      <div class="col-sm-9">
                                        <div class="switch-description">
                                          <div><strong>Text messages</strong></div>
                                          <p>Send me messages to my cell phone</p>
                                        </div>
                                      </div>
                                      <div class="col-sm-3">
                                        <div class="toggle-switch">
                                          <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="line"></div>
                                <div class="settings-block">
                                    <div class="row">
                                      <div class="col-sm-9">
                                        <div class="switch-description">
                                          <div><strong>LocalVocal Posts</strong></div>
                                          <p>Enable only my followers to comment on yours posts</p>
                                        </div>
                                      </div>
                                      <div class="col-sm-3">
                                        <div class="toggle-switch">
                                          <label class="switch">
                                            <input type="checkbox" name="comment" id="comment" value="comment">
                                            <span class="slider round"></span>
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="line"></div>
                                <div class="settings-block">
                                    <div class="row">
                                      <div class="col-sm-9">
                                        <div class="switch-description">
                                          <div><strong>Enable sound</strong></div>
                                          <p>You'll hear notification sound when someone sends you a private message</p>
                                        </div>
                                      </div>
                                      <div class="col-sm-3">
                                        <div class="toggle-switch">
                                          <label class="switch">
                                            <input name="sound" type="checkbox" checked>
                                            <span class="slider round"></span>
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                 <div class="line"></div>
                                <div class="settings-block">
                                    <div class="row">
                                      <div class="col-sm-9">
                                        <div class="switch-description">
                                          <div><strong>Share Phone Number</strong></div>
                                          <p>Buyers/Users will be able to contact you directly</p>
                                        </div>
                                      </div>
                                      <div class="col-sm-3">
                                        <div class="toggle-switch">
                                          <label class="switch">
                                            <input name="share_number" id="share_number" value="share_number" type="checkbox" checked>
                                            <span class="slider round"></span>
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                  
                  
                  
                  
                  
                  
                  
                    <div role="tabpanel" class="tab-pane" id="change_password">
                    
                    
                        <div class="edit-profile-container">
                            <div class="block-title">
                              <h4 class="grey"><i class="fas fa-unlock-alt"></i>Change Password</h4>
                              <div class="line"></div>
                            </div>
                            <div class="edit-block">
                              <form name="update-pass" id="update-pass" class="form-inline">
                                <div class="row">
                                  <div class="form-group col-xs-12">
                                    <label for="my-password">New password</label>
                                    <input id="my-password" class="form-control input-group-lg" type="password" name="new_password" title="Enter your new password" placeholder="Enter your new password"/>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-xs-12">
                                    <label>Confirm password</label>
                                    <input class="form-control input-group-lg" type="password" name="confirm_password" title="Confirm your password" placeholder="Confirm your password"/>
                                  </div>
                                </div>
                                <p><a href="#">Forgot Password?</a></p>
                                 <div id="message_savepassword"></div>
                                <button class="btn btn-primary">Update Password</button>
                              </form>
                            </div>
                        </div>
                    
                    
                    </div>
                  
                  
                  
                  
                    <!--<div role="tabpanel" class="tab-pane" id="settings">setting tabs</div> -->
                </div>
            </div>
        </div>
        
            
            
          
        </div> <!--page contents End-->
        
        
    </div> <!--Timeline End-->
        
       
        
</div>
        














<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>