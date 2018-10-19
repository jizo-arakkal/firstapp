<?php $__env->startSection('content'); ?>
<div class="container page_content_wrap">  
        
    <div class="page_data_wrap">
               
    <br> <br> 
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page_search_wrap_left">
    <ul class="nav nav-pills page_search_wrap_left_ul">
      <li class="active"><a id="type" onclick="active_tab_chat('tab_all_chat')" data-toggle="pill" href="#tab_all_chat">All</a></li>
      
      <li><a data-toggle="pill" onclick="active_tab_chat('tab_bc_chat')" href="#tab_bc_chat">Broadcast chat</a></li>
      
      <li><a data-toggle="pill" onclick="active_tab_chat('tab_sw_chat')" href="#tab_sw_chat">Swap chat</a></li>
    </ul>                
</div>
               
<div class="page_data_wrap">

        <div class="tab-content">
            <div id="tab_all_chat" class="tab-pane fade in active">
                
                <div id="app" class="ui main container" style="margin-top:65px;">
                    <div class="ui grid">
                        <div class="row">
                            <div class="three wide column">
                                <div class="ui vertical pointing menu">
                                    <h4 class="item ui header">
                                        Chat List  
                                    </h4>
                                    
                                    <?php $__currentLoopData = $chat_lists_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat_list_all): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($receptorUser == ""): ?>
                                       
                                         <a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/chat/<?php echo e($chat_list_all->conv_id); ?>" class="item">
                                            
                                          <img style="width:  70px;height: 70px;" src=<?php echo e($chat_list_all->picture); ?>>   
                                          <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo e($chat_list_all->user_name); ?></b></span>
                                        
                                        
                                         </a>
                                        <?php else: ?>
                                       
                                            <?php if($chat_list_all->conv_id == $receptorUser->conv_id): ?>
                                                 <a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/chat/<?php echo e($chat_list_all->conv_id); ?>" class="active item">
                                        <img style="width:  70px;height: 70px;" src=<?php echo e($chat_list_all->picture); ?>>  
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo e($chat_list_all->user_name); ?></b></span>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/chat/<?php echo e($chat_list_all->conv_id); ?>" class="item">
                                                    <img style="width:  70px;height: 70px;" src=<?php echo e($chat_list_all->picture); ?>>  
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo e($chat_list_all->user_name); ?></b></span>
                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
            
                            <div class="thirteen wide column">
                                <div class="ui segment" style="padding: 1.5em 1.5em;">
                                    <div class="ui comments" style="max-width: 100%;">
                                        
                                        <h4 class="ui dividing header">
                                        
                                           
                                             <?php if($chat == ""): ?>
                                             <i class="talk outline icon"></i> 
                                             Please select a conversation
                                             <?php endif; ?>
                                             <?php if($chat!=""): ?>
                                            <?php echo e($receptorUser->title); ?></h4>
                                        <firebase-messages user-id="<?php echo e(Auth::user()->user_id); ?>" conv-id="<?php echo e($chat->conv_id); ?>" receptor-name="<?php echo e($receptorUser->name); ?>"></firebase-messages>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
    

            </div>
            
            
            <div id="tab_bc_chat" class="tab-pane fade in">
                
                <div id="app" class="ui main container" style="margin-top:65px;">
                    <div class="ui grid">
                        <div class="row">
                            <div class="three wide column">
                                <div class="ui vertical pointing menu">
                                    <h4 class="item ui header">
                                        Chat List 
                                    </h4>
                                    
                                    <?php $__currentLoopData = $chat_lists_bc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat_list_bc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($receptorUser == ""): ?>
                                       
                                          <a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/chat/<?php echo e($chat_list_bc->conv_id); ?>" class="item"><img style="width:  70px;height: 70px;" src=<?php echo e($chat_list_bc->picture); ?>>   
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo e($chat_list_bc->user_name); ?></b></span>
                                         </a>
                                        <?php else: ?>
                                       
                                            <?php if($chat_list_bc->conv_id == $receptorUser->conv_id): ?>
                                                 <a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/chat/<?php echo e($chat_list_bc->conv_id); ?>" class="active item">
                                            <img style="width:  70px;height: 70px;" src=<?php echo e($chat_list_bc->picture); ?>>   
                                            
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo e($chat_list_bc->user_name); ?></b></span>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/chat/<?php echo e($chat_list_bc->conv_id); ?>" class="item">
                                           <img style="width:  70px;height: 70px;" src=<?php echo e($chat_list_bc->picture); ?>>             
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo e($chat_list_bc->user_name); ?></b></span>
                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
            
                            <div class="thirteen wide column">
                                <div class="ui segment" style="padding: 1.5em 1.5em;">
                                    <div class="ui comments" style="max-width: 100%;">
                                        
                                        <h4 class="ui dividing header">
                                        
                                           
                                             <?php if($chat == ""): ?>
                                             <i class="talk outline icon"></i> 
                                             Please select a conversation
                                             <?php endif; ?>
                                             <?php if($chat!=""): ?>
                                              <?php echo e($receptorUser->title); ?></h4>
                                        <firebase-messages user-id="<?php echo e(Auth::user()->user_id); ?>" conv-id="<?php echo e($chat->conv_id); ?>" receptor-name="<?php echo e($receptorUser->name); ?>"></firebase-messages>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
    

            </div>
            
            
            <div id="tab_sw_chat" class="tab-pane fade in">
                
                <div id="app" class="ui main container" style="margin-top:65px;">
                    <?php if(count($chat_lists_sw)==0): ?>
                                   <center><span> No chat history found </span></center>
                                    <?php else: ?>
                    <div class="ui grid">
                        <div class="row">
                            <div class="three wide column">
                                <div class="ui vertical pointing menu">
                                    
                                    <h4 class="item ui header">
                                        Chat List
                                    </h4>
                                    
                                    <?php $__currentLoopData = $chat_lists_sw; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat_list_sw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($receptorUser == ""): ?>
                                       
                                         <a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/chat/<?php echo e($chat_list_sw->conv_id); ?>" class="item">
                                             <img style="width:  70px;height: 70px;" src=<?php echo e($chat_list_bc->picture); ?>> 
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo e($chat_list_sw->user_name); ?></b></span>
                                         </a>
                                        <?php else: ?>
                                       
                                            <?php if($chat_list_sw->conv_id == $receptorUser->conv_id): ?>
                                                 <a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/chat/<?php echo e($chat_list_sw->conv_id); ?>" class="active item">
                                                     <img style="width:  70px;height: 70px;" src=<?php echo e($chat_list_bc->picture); ?>> 
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo e($chat_list_sw->user_name); ?></b></span>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/chat/<?php echo e($chat_list_sw->conv_id); ?>" class="item">  <img style="width:  70px;height: 70px;" src=<?php echo e($chat_list_bc->picture); ?>> 
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo e($chat_list_sw->user_name); ?>

                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </div>
                            </div>
            
                            <div class="thirteen wide column">
                                <div class="ui segment" style="padding: 1.5em 1.5em;">
                                    <div class="ui comments" style="max-width: 100%;">
                                        
                                        <h4 class="ui dividing header">
                                        
                                           
                                             <?php if($chat == ""): ?>
                                             <i class="talk outline icon"></i> 
                                             Please select a conversation
                                             <?php endif; ?>
                                             <?php if($chat!=""): ?>
                                              <?php echo e($receptorUser->title); ?></h4>
                                        <firebase-messages user-id="<?php echo e(Auth::user()->user_id); ?>" conv-id="<?php echo e($chat->conv_id); ?>" receptor-name="<?php echo e($receptorUser->name); ?>"></firebase-messages>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
    

            </div>
            
            
                        
            </div>
        </div>
                
    </div>
</div>

    
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>