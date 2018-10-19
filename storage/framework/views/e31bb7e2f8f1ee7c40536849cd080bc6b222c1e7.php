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
                                       
                                        
                                            
                                          <img style="width:  70px;height: 70px;" src=<?php echo e($chat_list_all->picture); ?>>   
                                          <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo e($chat_list_all->user_name); ?></b></span>
                                        
                                        
                                         
                                        <?php else: ?>
                                       
                                            <?php if($chat_list_all->conv_id == 1): ?>
                                                 <a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/messages/<?php echo e($chat_list_all->conv_id); ?>" class="active item">
                                        <img style="width:  70px;height: 70px;" src=<?php echo e($chat_list_all->picture); ?>>  
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo e($chat_list_all->user_name); ?></b></span>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/messages/<?php echo e($chat_list_all->conv_id); ?>" class="item">
                                                    <img style="width:  70px;height: 70px;" src=<?php echo e($chat_list_all->picture); ?>>  
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo e($chat_list_all->user_name); ?></b></span>
                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
            
                            <div class="thirteen wide column">
                                <div class="ui segment" style="margin-left: 70px;padding: 1.5em 1.5em;min-height: 400px;">
                                    <?php if(count($receptorUser) == 0): ?>
                                            Select one from the chat list
                                            <?php else: ?>
                                            <b><?php echo e($receptorUser[0]->title); ?></b></br>
                                    <div class="ui comments" style="max-width: 100%; overflow-y: auto;overflow-x: hidden;max-height: 390px;">
                                        
                                        
                                        <div id="'.$conv_id.'_'.$type_id.'" style="background:white;border: 1px solid lightgray;">
                                            
                                            <div id="msg-wgt-body_all" class="msg-wgt-body_all" style="height:310px !important;"> 
                                            
                                            
                                           <table style="width:100%;max-height: 390px;">
                                            <?php $__currentLoopData = $receptorUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="msg-row-container">
                                            	<td>
                                            		<div class="msg-row">
                                            		
                                            		
                                            			<img class="avatar" src=<?php echo e($msg->picture); ?>></div>
                                            
                                            			<div class="message">
                                            				<span class="user-label">
                                            				<?php echo e($msg->user_name); ?>

                                            				
                                            				<span class="msg-time">
                                            				<?php echo e($msg->created_at); ?>

                                            				</span>
                                            				</span>
                                            				<br/>
                                            				<?php echo e($msg->message); ?>

                                            			</div>
                                            	</td>
                                            </tr>	
                                            
                                        	
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </table>
                                        
                                        
                                      
                                        </div>
                                       
                                    </div>
                                </div>
                                <?php endif; ?>
                                
                            </div>
                             
                            <?php if(count($receptorUser)): ?> 
                                <div class="msg-wgt-footer" style="margin-left: 70px;width: 96%;">
                                    <textarea class="chatMsg" id="chatMsg_<?php echo e($receptorUser[0]->conv_id); ?>_<?php echo e($receptorUser[0]->type_id); ?>" placeholder="Type your message. Press shift + Enter to send"></textarea>
                                    <button style="bottom: 140px; !important" onclick="sendmsg_all()" id="<?php echo e($receptorUser[0]->conv_id); ?>_<?php echo e($receptorUser[0]->type_id); ?>" class="chat_send">Send</button>
                                </div>
                            <?php endif; ?>            
                                      
                            </div><!--thirteen coloumn -->
                        </div> <!-- row -->
                    </div><!-- ui grid -->
    

                </div> <!-- app -->
                        
            </div><!-- tab_all_chat -->
            
            <div id="tab_bc_chat" class="tab-pane fade">
                
                <div id="app" class="ui main container" style="margin-top:65px;">
                    <div class="ui grid">
                        <div class="row">
                            <div class="three wide column">
                                <div class="ui vertical pointing menu">
                                    <h4 class="item ui header">
                                        Chat List  
                                    </h4>
                                    
                                    <?php $__currentLoopData = $chat_lists_bc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat_list_all): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($receptorUser == ""): ?>
                                       
                                        
                                            
                                          <img style="width:  70px;height: 70px;" src=<?php echo e($chat_list_all->picture); ?>>   
                                          <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo e($chat_list_all->user_name); ?></b></span>
                                        
                                        
                                         
                                        <?php else: ?>
                                       
                                            <?php if($chat_list_all->conv_id == 1): ?>
                                                 <a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/messages/<?php echo e($chat_list_all->conv_id); ?>" class="active item">
                                        <img style="width:  70px;height: 70px;" src=<?php echo e($chat_list_all->picture); ?>>  
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo e($chat_list_all->user_name); ?></b></span>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/messages/<?php echo e($chat_list_all->conv_id); ?>" class="item">
                                                    <img style="width:  70px;height: 70px;" src=<?php echo e($chat_list_all->picture); ?>>  
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo e($chat_list_all->user_name); ?></b></span>
                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
            
                            <div class="thirteen wide column">
                                <div class="ui segment" style="margin-left: 70px;padding: 1.5em 1.5em;min-height: 400px;">
                                    <?php if(count($receptorUser) == 0): ?>
                                            Select one from the chat list
                                            <?php else: ?>
                                    <div class="ui comments" style="max-width: 100%; overflow-y: auto;overflow-x: hidden;max-height: 390px;">
                                        
                                        
                                        <div id="'.$conv_id.'_'.$type_id.'" style="background:white;border: 1px solid lightgray;">
                                            
                                            <div id="msg-wgt-body_bc" class="msg-wgt-body_bc" style="height:310px !important;"> 
                                            
                                            
                                           <table style="width:100%;max-height: 390px;">
                                            <?php $__currentLoopData = $receptorUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="msg-row-container">
                                            	<td>
                                            		<div class="msg-row">
                                            		
                                            		
                                            			<img class="avatar" src=<?php echo e($msg->picture); ?>></div>
                                            
                                            			<div class="message">
                                            				<span class="user-label">
                                            				<?php echo e($msg->user_name); ?>

                                            				
                                            				<span class="msg-time">
                                            				<?php echo e($msg->created_at); ?>

                                            				</span>
                                            				</span>
                                            				<br/>
                                            				<?php echo e($msg->message); ?>

                                            			</div>
                                            	</td>
                                            </tr>	
                                            
                                        	
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </table>
                                        
                                        
                                      
                                        </div>
                                       
                                    </div>
                                </div>
                                <?php endif; ?>
                                
                            </div>
                             
                            <?php if(count($receptorUser)): ?> 
                                <div class="msg-wgt-footer" style="margin-left: 70px;width: 96%;">
                                    <textarea class="chatMsg" id="chatMsg_<?php echo e($receptorUser[0]->conv_id); ?>_<?php echo e($receptorUser[0]->type_id); ?>" placeholder="Type your message. Press shift + Enter to send"></textarea>
                                    <button style="bottom: 140px; !important" onclick="sendmsg_bc()" id="<?php echo e($receptorUser[0]->conv_id); ?>_<?php echo e($receptorUser[0]->type_id); ?>" class="chat_send">Send</button>
                                </div>
                            <?php endif; ?>            
                                      
                            </div><!--thirteen coloumn -->
                        </div> <!-- row -->
                    </div><!-- ui grid -->
    

                </div> <!-- app -->
                        
            </div><!-- tab_all_chat -->
            
            <div id="tab_sw_chat" class="tab-pane fade">
                
                <div id="app" class="ui main container" style="margin-top:65px;">
                    <div class="ui grid">
                        <div class="row">
                            <div class="three wide column">
                                <div class="ui vertical pointing menu">
                                    <h4 class="item ui header">
                                        Chat List  
                                    </h4>
                                    
                                    <?php $__currentLoopData = $chat_lists_sw; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat_list_all): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($receptorUser == ""): ?>
                                       
                                        
                                            
                                          <img style="width:  70px;height: 70px;" src=<?php echo e($chat_list_all->picture); ?>>   
                                          <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo e($chat_list_all->user_name); ?></b></span>
                                        
                                        
                                         
                                        <?php else: ?>
                                       
                                            <?php if($chat_list_all->conv_id == 1): ?>
                                                 <a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/messages/<?php echo e($chat_list_all->conv_id); ?>" class="active item">
                                        <img style="width:  70px;height: 70px;" src=<?php echo e($chat_list_all->picture); ?>>  
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo e($chat_list_all->user_name); ?></b></span>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo e((new \App\Http\Controllers\Helper)->get_url()); ?>/messages/<?php echo e($chat_list_all->conv_id); ?>" class="item">
                                                    <img style="width:  70px;height: 70px;" src=<?php echo e($chat_list_all->picture); ?>>  
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo e($chat_list_all->user_name); ?></b></span>
                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
            
                            <div class="thirteen wide column">
                                <div class="ui segment" style="margin-left: 70px;padding: 1.5em 1.5em;min-height: 400px;">
                                    <?php if(count($receptorUser) == 0): ?>
                                            Select one from the chat list
                                            <?php else: ?>
                                    <div class="ui comments" style="max-width: 100%; overflow-y: auto;overflow-x: hidden;max-height: 390px;">
                                        
                                        
                                        <div id="'.$conv_id.'_'.$type_id.'" style="background:white;border: 1px solid lightgray;">
                                            
                                            <div id="msg-wgt-body_sw" class="msg-wgt-body_sw" style="height:310px !important;"> 
                                            
                                            
                                           <table style="width:100%;max-height: 390px;">
                                            <?php $__currentLoopData = $receptorUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="msg-row-container">
                                            	<td>
                                            		<div class="msg-row">
                                            		
                                            		
                                            			<img class="avatar" src=<?php echo e($msg->picture); ?>></div>
                                            
                                            			<div class="message">
                                            				<span class="user-label">
                                            				<?php echo e($msg->user_name); ?>

                                            				
                                            				<span class="msg-time">
                                            				<?php echo e($msg->created_at); ?>

                                            				</span>
                                            				</span>
                                            				<br/>
                                            				<?php echo e($msg->message); ?>

                                            			</div>
                                            	</td>
                                            </tr>	
                                            
                                        	
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </table>
                                        
                                        
                                      
                                        </div>
                                       
                                    </div>
                                </div>
                                <?php endif; ?>
                                
                            </div>
                             
                            <?php if(count($receptorUser)): ?> 
                                <div class="msg-wgt-footer" style="margin-left: 70px;width: 96%;">
                                    <textarea class="chatMsg" id="chatMsg_<?php echo e($receptorUser[0]->conv_id); ?>_<?php echo e($receptorUser[0]->type_id); ?>" placeholder="Type your message. Press shift + Enter to send"></textarea>
                                    <button style="bottom: 140px; !important" onclick="sendmsg_sw()" id="<?php echo e($receptorUser[0]->conv_id); ?>_<?php echo e($receptorUser[0]->type_id); ?>" class="chat_send">Send</button>
                                </div>
                            <?php endif; ?>            
                                      
                            </div><!--thirteen coloumn -->
                        </div> <!-- row -->
                    </div><!-- ui grid -->
    

                </div> <!-- app -->
                        
            </div><!-- tab_all_chat -->
            
        </div> <!--tab_content -->
                
    </div>
</div>
<script>


</script>

    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>