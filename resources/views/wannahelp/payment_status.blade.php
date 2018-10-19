@extends('layouts.app')
@section('content')
<div class="container page_content_wrap">  
        
    <div class="page_data_wrap">
        
    <br><br><br><br><br>
    @if($status == 0)
        <center><span style="font-weight: 600;font-size: 22px;">OOPS, </span>Payment was not Successful, Please try again!</span></center>
    @else    
    <center><span style="font-weight: 600;font-size: 22px;">Payment was Successful!</span></center>
    @endif
    <br><br>    
    <center><i class="fa fa-check-circle" style="color: #51a351;animation: check-circle 3s linear infinite;font-size: 40px;"></i></center>
    
</div>
</div>

<div id="new_form" name="new_form"></div>

@endsection