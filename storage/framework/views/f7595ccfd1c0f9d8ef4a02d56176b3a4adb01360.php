<?php $__env->startSection('content'); ?>
<div class="container page_content_wrap">  
        
    <div class="page_data_wrap">
               
        <br>     
        <h3>Credits Summary</h3>
        <br/>
        
        <?php if(count($credits)==0): ?>
        
        <span><center> You havn't purchased any Credits yet. </center></span>
        
        <?php else: ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="line-height: 45px;">
           
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> <b>Tx ID</b></div>
             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><b>Plan Name</b></div>
             
             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><b>Total Credits</b></div>
             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><b>Remaining Credits</b></div>
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><b>Purchased on</b></div>
            <br>
             <hr/>
              <?php $__currentLoopData = $credits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $credit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($credit->status == "failure"): ?>
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><span style="color:red">FAILED&nbsp;&nbsp;</span><?php echo e($credit->txn_id); ?></div>
              <?php else: ?>
               <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><?php echo e($credit->txn_id); ?></div>
              <?php endif; ?>
             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><?php echo e($credit->plan_name); ?></div>

             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><?php echo e($credit->total_credits); ?></div>
             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><?php echo e($credit->rem_credits); ?></div>
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><?php echo e($credit->created_at); ?></div>
             
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
        </div>
           <?php endif; ?> 
            <br/>
         
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="line-height: 45px;">
                 <br/>
             <h3>Transaction Summary</h3>
             <?php if(count($transactions)==0): ?>
    
            <span><center> You havn't boosted any of the posts yet. <br>
            <small>To Boost, go to View Profile -> Select the Post -> Select Boost </small></center></span>
    
            <?php else: ?>
              
             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"> <b>Tx ID</b></div>
             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><b>Post Title</b></div>
             
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><b>Valid From</b></div>
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><b>Valid Until</b></div>
             
             <br>
             <hr/>
              <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              
               <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><?php echo e($transaction->txn_id); ?></div>
             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><?php echo e($transaction->title); ?></div>

             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><?php echo e($transaction->valid_from); ?></div>
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><?php echo e($transaction->valid_until); ?></div>
           
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <br/><br/>
                <?php endif; ?>
            </div>
            
           
            
            
            
            
            
                <div class="clearfix"></div>
      

    </div>
</div>










<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>