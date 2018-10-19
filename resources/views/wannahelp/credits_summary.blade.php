@extends('layouts.app')
@section('content')
<div class="container page_content_wrap">  
        
    <div class="page_data_wrap">
               
        <br>     
        <h3>Credits Summary</h3>
        <br/>
        
        @if(count($credits)==0)
        
        <span><center> You havn't purchased any Credits yet. </center></span>
        
        @else
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="line-height: 45px;">
           
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> <b>Tx ID</b></div>
             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><b>Plan Name</b></div>
             
             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><b>Total Credits</b></div>
             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"><b>Remaining Credits</b></div>
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><b>Purchased on</b></div>
            <br>
             <hr/>
              @foreach($credits as $credit)
              @if($credit->status == "failure")
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><span style="color:red">FAILED&nbsp;&nbsp;</span>{{$credit->txn_id}}</div>
              @else
               <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">{{$credit->txn_id}}</div>
              @endif
             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">{{$credit->plan_name}}</div>

             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">{{$credit->total_credits}}</div>
             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">{{$credit->rem_credits}}</div>
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">{{$credit->created_at}}</div>
             
             @endforeach
                
        </div>
           @endif 
            <br/>
         
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="line-height: 45px;">
                 <br/>
             <h3>Transaction Summary</h3>
             @if(count($transactions)==0)
    
            <span><center> You havn't boosted any of the posts yet. <br>
            <small>To Boost, go to View Profile -> Select the Post -> Select Boost </small></center></span>
    
            @else
              
             <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"> <b>Tx ID</b></div>
             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><b>Post Title</b></div>
             
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><b>Valid From</b></div>
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><b>Valid Until</b></div>
             
             <br>
             <hr/>
              @foreach($transactions as $transaction)
              
               <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">{{$transaction->txn_id}}</div>
             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">{{$transaction->title}}</div>

             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">{{$transaction->valid_from}}</div>
             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">{{$transaction->valid_until}}</div>
           
             @endforeach
                <br/><br/>
                @endif
            </div>
            
           
            
            
            
            
            
                <div class="clearfix"></div>
      

    </div>
</div>










@endsection