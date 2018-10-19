    
<?php $__env->startSection('content'); ?>
<style>
    .loader1111 {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
    
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes  spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<div class="container page_content_wrap">  
        
    <div class="page_data_wrap">
        <br><br>
        <h4 class="modal-title">Submit a Free Post</h4>
        <center style="margin-bottom: -20px;">
        <span class = "row"><label>Select Type</label>
            <span id="myRadioGroup1" class="inputGroup">
                <label class="radio inline" for="option1"><input type="radio" name="types" id="option1" value="Broadcast" checked><span>WannaHelp (PMIT)</span> </label>
                <label class="radio inline" for="option2"><input type="radio" name="types" id="option2" value="Swap"><span>SwapNear</span></label>
                <label class="radio inline" for="option3"><input type="radio" name="types" id="option3" value="LocalVocal"><span>AddValue</span></label>
             <!--<label for="option1" class="container123">Name<input class="radio_css" name="types" id="option1" value="Broadcast" checked="checked"><span class="checkmark"></span></label>-->
             <!--<label for="option2" class="container123">Name<input class="radio_css" name="types" id="option2" value="Swap"><span class="checkmark"></span></label>-->
             <!--<label for="option3" class="container123">Name<input class="radio_css" name="types" id="option3" value="LocalVocal"><span class="checkmark"></span></label>-->
             <!--<input  style="margin-left:15px;" type="radio" name="types" id="option2" value="Swap"  />&nbsp;<label for="option2">Swap</label>-->
             <!--<input  style="margin-left:15px;" type="radio" name="types" id="option3" value="LocalVocal"  />&nbsp;<label for="option3">LocalVocal</label>-->
             <!--<input  style="margin-left:15px;" type="radio" checked="checked" name="types" id="option1" value="Broadcast"  />&nbsp;<label for="option1">Broadcast</label>-->
             <!--<input  style="margin-left:15px;" type="radio" name="types" id="option2" value="Swap"  />&nbsp;<label for="option2">Swap</label>-->
             <!--<input  style="margin-left:15px;" type="radio" name="types" id="option3" value="LocalVocal"  />&nbsp;<label for="option3">LocalVocal</label>-->
             </span>
        </span>
        </center>
        <br><br>
        
            <div id="create_broadcast" style="display: block">        
            <form id="Broadcast-form" method="post" enctype='multipart/form-data'>
            <div class = "row">	
    		    <div class="col-md-3 "><span class="postfree-label"><b>Description&nbsp;&nbsp;&nbsp;</b></span> </div>
    		    <div class="col-md-6">
    		        <textarea name="description_bc" class="form-control" id="description_bc" style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7;resize: none;height: 70px;width:100%;" required></textarea>
    		    </div>
    		     <div class="col-md-3">
    		     <div id="pm-message_bc_desc"></div>
    		    </div>
		    </div>
		    
			<br><br>
			<div class = "row">	
			    <div class="col-lg-3">
		        <span class="postfree-label" ><b>Category</b></span> <br><br>
		    </div>
		     
		         
		    <div class="col-lg-9" style="margin-left:  -60px;">     
    		    <div id="slider_category_wrap_create" class="slider_category_wrap_create" style="z-index: 1;position:unset !important;">
                    <div class="slider_content_bottom" style="z-index:1;width: 97% !important;left:2%;right: 10%;background: white;"></div>
                    <div class="slider_content_bottom_content" style="z-index:1 !important;">
                        <div class="cat_full_wrap">
                            <div class="cat_scroll_arrow" id="cat_scroll_arrow_left">
                                <i  style="color:black;" class="fa fa-chevron-left"></i>
                            </div>
                            <div class="category_scroller_wrap category_scroller_wrap_bc">                
                                <ul class="category_scroller">
    								 
                                     <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php if($category->id != 1): ?>
    								 <li>
                                         <div class="cat_img_wrap">
                                             
                                            <div name="<?php echo e($category->id); ?>"><img id="bc<?php echo e($category->id); ?>" style="width: 52px;" onclick="choose_category_bc(<?php echo e($category->id); ?>)" src="<?php echo url('public/images/category/')?>/<?php echo e($category->logo_image); ?>"> 
                                            </div>
                                         </div>
                                         <p  style="color:black;"><?php echo e($category->category_title); ?></p>
                                     </li>
                                     <?php endif; ?>
    								 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     
                                 </ul>
                            </div>
                            <div class="cat_scroll_arrow" id="cat_scroll_arrow_right">
                                <i  style="color:black;" class="fa fa-chevron-right"></i>
                            </div> 
                            <div class="clearfix"></div>
                        </div>
    
    
                    </div>
                </div>
		    </div>
		   
		    
		</div>
		  <!-- <div  style="font-size: 2.5em;float:right;margin-right: 140px;" id="show_more_cat" onclick="show_more_cat()">+</div> -->
		<div id="pm-message_bc_cat"></div>
		  
		
		<br><br>
		<div class = "row">	                
		    <div class="col-md-3"><span class="postfree-label" ><b>Location</b> </span></div>
		    <div class="col-md-6"><input style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7;" id="pac-input-modal_bc" name="pac-input-modal_bc" type="text" class="form-control search_query" placeholder="Enter your place, Be Specific" required/></div>
		   
		</div>
		<div id="pm-message_bc_loc"></div>
		<input type="hidden" name="type" id="type" value="Broadcast">
        <br>
        
        <div class = "row">	                
		    <div class="col-md-3"><span class="postfree-label" ><b>Who should see this?</b> </span></div>
		    <div class="col-md-6">
		        <select class="form-control" id="sel1" style="border: 1px solid #3cc0c7;">
                <option value="public">Public</option>
                <option value="only_my_followers">Only My Followers</option>
                </select>
            </div>
		   
		</div>
		
        
        <div class="line"></div>
         <div id="pm-message_bc"></div>
        <br>
        
        <?php if(!Auth::user()): ?>
        <div class = "row">	                
        <div class="col-md-3"><span  class="postfree-label" ><b>Name</b> </span></div>
        <div class="col-md-6"><input style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7;" id="name" name="name" type="text" class="form-control search_query" placeholder="Your name" required/></div>
        
        </div>
        <br>
        <div class = "row">	                
        <div class="col-md-3"><span class="postfree-label" ><b>Mobile</b> </span></div>
        <div class="col-md-6"><input style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7;" id="mobile" name="mobile" type="text" class="form-control search_query" title="Enter your mobile number to recive OTP" placeholder="Enter your mobile number to recieve OTP" required/></div>
        
        </div>
        <br>
         <div class = "row">	                
        <div class="col-md-3"><span class="postfree-label" ><b>Your Location</b> </span></div>
        <div class="col-md-6"><input style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7;" id="pac-input-modal" name="city" type="text" class="form-control search_query" placeholder="Your current location" required/></div>
        
        </div>
        
        
        <?php endif; ?>
        
       
         <br>
       
		
		<button  style="float: right;"  type="submit" class="btn btn-primary submit">Free Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;
			<span style="float: right;margin-right: 20px;margin-top: 8px;font-weight: 600;color: #3cc0c7;"  onclick="showDiv()" ><i class="fa fa-bolt" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Boost</span>
		<br><br>
        </form>
        </div>
        
        <div id="create_swap" style="display:block">
          <form id="Swap-form" method="post" enctype='multipart/form-data'>  
        <div class = "row">	
		    <div class="col-md-3"><span class="postfree-label"><b>Caption&nbsp;&nbsp;&nbsp;</b></span> </div>
		    <div class="col-md-6"><textarea style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7;" name="caption_sw" id="caption_sw" style="resize: none;height:50px;width:300px" required></textarea></div>
		    </div>
		    <div class = "row">	
		    <div class="col-md-3"><span class="postfree-label" ><b>Description&nbsp;&nbsp;&nbsp;</b></span> </div>
		    <div class="col-md-6"><textarea style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7;" name="description_sw" id="desciption_sw" style="resize: none;height:85px;width:450px" required></textarea></div>
		    </div>
		    <br>
		    <div class = "row">	
		    <div class="col-md-3"><span class="postfree-label" ><b>Upload Images&nbsp;&nbsp;&nbsp;</b></span></div>
		    <div class="col-md-6"><!--<input  style="width: 50%;" name="s1_file" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload..."> -->
		    <input type="file" style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7; padding:5px 0 5px 5px; width: 100%;" name="s1_file[]" multiple>
		    </div>
		    </div>
		    <br>
			
		   <div class = "row">	
			    <div class="col-lg-3">
		            <span class="postfree-label" ><b>Category</b></span> <br><br>
		        </div>
		        
		        <div class="col-lg-9" style="margin-left:  -60px;">     
    		    <div id="slider_category_wrap_create" class="slider_category_wrap_create" style="z-index: 1;position:unset !important;">
                    <div class="slider_content_bottom" style="z-index:1;width: 97% !important;left: 2%;right: 10%;background: white;"></div>
                    <div class="slider_content_bottom_content" style="z-index:1 !important;">
                        <div class="cat_full_wrap">
                            <div class="cat_scroll_arrow" id="cat_scroll_arrow_left_sw">
                                <i  style="color:black;" class="fa fa-chevron-left"></i>
                            </div>
                            <div class="category_scroller_wrap category_scroller_wrap_sw">                
                                <ul class="category_scroller">
    								 
                                     <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php if($category->id != 1): ?>
    								 <li>
                                         <div class="cat_img_wrap">
                                             
                                            <div name="<?php echo e($category->id); ?>"><img id="sw<?php echo e($category->id); ?>" style="width: 52px;" onclick="choose_category_sw(<?php echo e($category->id); ?>)" src="<?php echo url('public/images/category/')?>/<?php echo e($category->logo_image); ?>"> 
                                            </div>
                                         </div>
                                         <p  style="color:black;"><?php echo e($category->category_title); ?></p>
                                     </li>
                                     <?php endif; ?>
    								 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     
                                 </ul>
                            </div>
                            <div class="cat_scroll_arrow" id="cat_scroll_arrow_right_sw">
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
		        <div class="col-md-3"><span class="postfree-label" ><b>Location</b> </span></div>
		        <div class="col-md-6"><input  class="form-control" style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7;" name="pac-input-modal_sw" id="pac-input-modal_sw" type="text" class="form-control search_query" placeholder="Search in your city" required /></div>
		   
		    </div>
		    <br/>
		    
		    
		    
		    
		   
		    
            
            
            
            
            
            
		    
		    <div class = "row">	                
		        <div class="col-md-3"><span class="postfree-label" ><b>Wishing to swap for</b> </span></div>
		        <div class="col-md-9">
    		        <span id="myRadioSwap">
                        <input style="margin-left: 35px;" type="radio" name="swap_option" value="Product/Price"  />&nbsp;Product/Price
                        <input style="margin-left: 35px;" type="radio" name="swap_option" value="Open"  />&nbsp;Open for anything
                        <input style="margin-left: 35px;" type="radio" name="swap_option" value="Free"  />&nbsp;Give it Away for Free
                    
                    </span>
                </div>     
             
            </div>
            </br>
            <div class = "row">
    		    <center>
    		        <div id="swap_area" style="display:block;">
                       <div class="col-md-5" style="margin-left: 100px;"><input style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7;important;" id="goods" name="goods" type="text" class="form-control search_query" placeholder="Enter Goods you wish to trade for" /></div> &nbsp;&nbsp;&nbsp;
                       <div class="col-md-5"><input id="price" style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7;important;" name="price" type="text" class="form-control search_query" placeholder="Sell for Price INR" /> </div>
                       
                    </div> 
    		    </center>
		  
		   
		    </div>
		    <input type="hidden" name="type" id="type" value="Swap">
		     <br>
		      
		    <div class="line"></div>
		    <div id="pm-message_sw"></div>
		    <br>
		    
		    <?php if(!Auth::user()): ?>
            <div class = "row">	                
            <div class="col-md-3"><span class="postfree-label" ><b>Name</b> </span></div>
            <div class="col-md-6"><input id="name" style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7;" name="name" type="text" class="form-control search_query" placeholder="Your name" required /></div>
            
            </div>
            <br>
            <div class = "row">	                
            <div class="col-md-3"><span  class="postfree-label" ><b>Mobile</b> </span></div>
            <div class="col-md-6"><input id="mobile" style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7;;" name="mobile" type="text" class="form-control search_query" title="Enter your mobile number to recive OTP" placeholder="Mobile Number" required /></div>
            
            </div>
            <br>
             <div class = "row">	                
            <div class="col-md-3"><span class="postfree-label" ><b>Your Location</b> </span></div>
            <div class="col-md-6"><input id="pac-input-modal" style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7;" name="city" type="text" class="form-control search_query" placeholder="Enter your current Location" required /></div>
            
            </div>
        
        
             <?php endif; ?>
        
       
             <br>
           
    		
    		<button  style="float: right;" type="submit" class="btn btn-primary submit">Submit</button>
    		<br><br>
            </form>
        </div>    
        
		<div id="create_localvocal" style="display: block">
		        <form id="LocalVocal-form" method="post" enctype='multipart/form-data'> 
    		 <div class = "row">	
		            <div class="col-md-3"><span class="postfree-label" ><b>Caption&nbsp;&nbsp;&nbsp;</b></span> </div>
		            <div class="col-md-6"><textarea style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7;" name="caption_lv" id="caption_lv" style="resize: none;height:50px;width:300px" required></textarea></div>
		        </div>
		        <div class = "row">	
		            <div class="col-md-3"><span class="postfree-label" ><b>Description&nbsp;&nbsp;&nbsp;</b></span> </div>
		            <div class="col-md-6 PreviewClass"><textarea style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7;" name="description_lv" id="description_lv" style="resize: none;height:85px;width:450px" required></textarea></div>
		        </div>
		        <br>
		        <div class = "row">	
		            <div class="col-md-3"><span class="postfree-label" ><b>Upload Images&nbsp;&nbsp;&nbsp;</b></span></div>
		            <div class="col-md-6">
		            <!--<input id="input-b3" style="width: 50%;" name="input-b3[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload..."> -->
		            <input style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7; padding:5px 0 5px 5px; width: 100%;" type="file" name="s1_file[]" multiple="multiple"></div>
		        </div>
			    <br>
		        
		    <div class = "row">	
			    <div class="col-lg-3">
		        <span class="postfree-label" ><b>Category</b></span> <br><br>
		        </div>
		     
		         
    		    <div class="col-lg-9" style="margin-left:  -60px;">     
        		    <div class="slider_category_wrap_create" style="z-index: 1;position:unset !important;">
                        <div class="slider_content_bottom" style="width: 97% !important;left: 2%;right: 10%;background: white;"></div>
                        <div class="slider_content_bottom_content">
                            <div class="cat_full_wrap">
                                <div class="cat_scroll_arrow" id="cat_scroll_arrow_left_lv">
                                    <i  style="color:black;" class="fa fa-chevron-left"></i>
                                </div>
                                <div class="category_scroller_wrap category_scroller_wrap_lv">                
                                    <ul class="category_scroller">
        								 
                                         <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <?php if($category->id != 1): ?>
        								 <li>
                                             <div class="cat_img_wrap">
                                                 
                                                <div name="<?php echo e($category->id); ?>"><img id="lv<?php echo e($category->id); ?>" style="width: 60px;" onclick="choose_category_lv(<?php echo e($category->id); ?>)" src="<?php echo url('public/images/category/')?>/<?php echo e($category->logo_image); ?>"> 
                                                </div>
                                             </div>
                                             <p  style="color:black;"><?php echo e($category->category_title); ?></p>
                                         </li>
                                         <?php endif; ?>
        								 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                         
                                     </ul>
                                </div>
                                <div class="cat_scroll_arrow" id="cat_scroll_arrow_right_lv">
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
	            <div class="col-md-3"><span class="postfree-label" ><b>Location</b> </span></div>
	            <div class="col-md-6"><input  style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7;" class="form-control" name="pac-input-modal_lv" id="pac-input-modal_lv" type="text" class="form-control search_query" placeholder="Search in your city" required /></div>
	   
	         </div>
		        
		        <div id="loaddiv"><div class="loader1111" style="  width: 79px;height: 79px;margin-left: 43%;margin-top: 1%;"></div></div>
		         
		    <br>
		    <div class="line"></div>
		    <br>
		    
		    <input type="hidden" name="type" id="type" value="LocalVocal">
		     <div id="pm-message_lv"></div>
		    <?php if(!Auth::user()): ?>
            <div class = "row">	                
            <div class="col-md-3"><span class="postfree-label" ><b>Name</b> </span></div>
            <div class="col-md-6"><input id="name" style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7;" name="name" type="text" class="form-control search_query" placeholder="Your name" required /></div>
            
            </div>
            <br>
            <div class = "row">	                
            <div class="col-md-3"><span class="postfree-label" ><b>Mobile</b> </span></div>
            <div class="col-md-6"><input id="mobile" style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7;" name="mobile" type="text" class="form-control search_query" title="Enter your mobile number to recive OTP" placeholder="Mobile Number" required /></div>
            
            </div>
            <br>
             <div class = "row">	                
            <div class="col-md-3"><span class="postfree-label" ><b>Your Location</b> </span></div>
            <div class="col-md-6"><input id="pac-input-modal" style="border: 1px solid #3cc0c7;border-left: 4px solid #3cc0c7;" name="city" type="text" class="form-control search_query" placeholder="Your Location" required /></div>
            
            </div>
        
        
            <?php endif; ?>
        
       
         <br>
       
		
		<button style="float: right;" type="submit" class="btn btn-primary submit">Submit</button> 
		<br><br>
		</form>
		</div>
        <input type="hidden" value="" name="new_post_id">
        <input type="hidden" value="0" name="is_boost_clicked">
        

        <form id="Pricing-form" method="post" enctype='multipart/form-data'> 
        <div id="pricing-container" class="pricing-container" style="display:none;">
		
		<ul class="pricing-list bounce-invert">
			<li>
				<ul class="pricing-wrapper" style="list-style-type: none;">
					<li data-type="monthly" class="is-visible">
						<header class="pricing-header">
							<h3>Basic</h3>
							<div class="price">
								<span class="currency"><i aria-hidden="true" class="fa fa-inr"></i></span>
								<span class="value">199</span>
								<!-- <span class="duration">mo</span> -->
							</div>
						</header>
						<div class="pricing-body">
							<ul class="pricing-features">
								<li>Boost <em>1</em> post</li>
								<li>Faster Responses</li>
								<li>Get ur post Highlighted</li>
								<li>Valdity <em>1</em> week</li>
							</ul>
						</div>
						<footer class="pricing-footer">
								<input style=" background-color: #3cc0c7;border: none;color: white;padding: 16px 32px;text-decoration: none;margin: 4px 2px;cursor: pointer;"  class="select" value="Select" id="1" type="Submit">
						</footer>
					</li>
					
				</ul>
			</li>
			<li class="exclusive">
				<ul class="pricing-wrapper" style="list-style-type: none;">
					<li data-type="monthly" class="is-visible">
						<header class="pricing-header">
							<h3>Premium</h3>
							<div class="price">
								<span class="currency"><i aria-hidden="true" class="fa fa-inr"></i></span>
								<span class="value">499</span>
								<!-- <span class="duration">mo</span>-->
							</div>
						</header>
						<div class="pricing-body">
							<ul class="pricing-features">
								<li>Boost <em>3</em> posts</li>
								<li>Faster Responses</li>
								<li>Get ur posts Highlighted</li>
								<li>Valdity <em>3</em> weeks</li>
							</ul>
						</div>
						<footer class="pricing-footer">
								<input style=" background-color: #3cc0c7;border: none;color: white;padding: 16px 32px;text-decoration: none;margin: 4px 2px;cursor: pointer;"  class="select" value="Select" id="2" type="Submit">
						</footer>
					</li>
					
				</ul>
			</li>
			<li>
				<ul class="pricing-wrapper" style="list-style-type: none;">
					<li data-type="monthly" class="is-visible">
						<header class="pricing-header">
							<h3>Platinum</h3>
							<div class="price">
								<span class="currency"><i aria-hidden="true" class="fa fa-inr"></i></span>
								<span class="value">999</span>
								<!-- <span class="duration">mo</span> -->
							</div>
						</header>
						<div class="pricing-body">
							<ul class="pricing-features">
								<li>Boost 20 posts</li>
								<li>Faster Responses</li>
								<li>Get ur posts Highlighted</li>
								<li>Valdity <em>1</em> month</li>
							</ul>
						</div>
						<footer class="pricing-footer">
							<input style=" background-color: #3cc0c7;border: none;color: white;padding: 16px 32px;text-decoration: none;margin: 4px 2px;cursor: pointer;"  class="select" value="Select" id="3" type="Submit">
						</footer>
					</li>
					
				</ul>
			</li>
		</ul>
	    </div>
    </form>
        
         </div>
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script>



jQuery(document).ready(function($){
	//hide the subtle gradient layer (.pricing-list > li::after) when pricing table has been scrolled to the end (mobile version only)
	checkScrolling($('.pricing-body'));
	$(window).on('resize', function(){
		window.requestAnimationFrame(function(){checkScrolling($('.pricing-body'))});
	});
	$('.pricing-body').on('scroll', function(){ 
		var selected = $(this);
		window.requestAnimationFrame(function(){checkScrolling(selected)});
	});

	function checkScrolling(tables){
		tables.each(function(){
			var table= $(this),
				totalTableWidth = parseInt(table.children('.pricing-features').width()),
		 		tableViewport = parseInt(table.width());
			if( table.scrollLeft() >= totalTableWidth - tableViewport -1 ) {
				table.parent('li').addClass('is-ended');
			} else {
				table.parent('li').removeClass('is-ended');
			}
		});
	}

	//switch from monthly to annual pricing tables
	bouncy_filter($('.pricing-container'));

	function bouncy_filter(container) {
		container.each(function(){
			var pricing_table = $(this);
			var filter_list_container = pricing_table.children('.pricing-switcher'),
				filter_radios = filter_list_container.find('input[type="radio"]'),
				pricing_table_wrapper = pricing_table.find('.pricing-wrapper');

			//store pricing table items
			var table_elements = {};
			filter_radios.each(function(){
				var filter_type = $(this).val();
				table_elements[filter_type] = pricing_table_wrapper.find('li[data-type="'+filter_type+'"]');
			});

			//detect input change event
			filter_radios.on('change', function(event){
				event.preventDefault();
				//detect which radio input item was checked
				var selected_filter = $(event.target).val();

				//give higher z-index to the pricing table items selected by the radio input
				show_selected_items(table_elements[selected_filter]);

				//rotate each pricing-wrapper 
				//at the end of the animation hide the not-selected pricing tables and rotate back the .pricing-wrapper
				
				if( !Modernizr.cssanimations ) {
					hide_not_selected_items(table_elements, selected_filter);
					pricing_table_wrapper.removeClass('is-switched');
				} else {
					pricing_table_wrapper.addClass('is-switched').eq(0).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {		
						hide_not_selected_items(table_elements, selected_filter);
						pricing_table_wrapper.removeClass('is-switched');
						//change rotation direction if .pricing-list has the .bounce-invert class
						if(pricing_table.find('.pricing-list').hasClass('bounce-invert')) pricing_table_wrapper.toggleClass('reverse-animation');
					});
				}
			});
		});
	}
	function show_selected_items(selected_elements) {
		selected_elements.addClass('is-selected');
	}

	function hide_not_selected_items(table_containers, filter) {
		$.each(table_containers, function(key, value){
	  		if ( key != filter ) {	
				$(this).removeClass('is-visible is-selected').addClass('is-hidden');

			} else {
				$(this).addClass('is-visible').removeClass('is-hidden is-selected');
			}
		});
	}
});
 $('#create_broadcast').show();
      $('#create_swap').hide();
      $('#create_localvocal').hide();
      
      
function showDiv() {
   document.getElementById('pricing-container').style.display = "block";
}      
function show_more_cat()
{
  document.getElementById('show_more_cat').style.display = "block";
    
}

      </script>






<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>