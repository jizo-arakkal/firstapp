@extends('layouts.app')
@section('content')

<div class="create_post" style="text-align:  center;">
    <br><br><br><br>
<h3>Submit a Post</h3>
<br>
  <div class="row">
     <center>
 <label><input type="radio" name="type" value="Broadcast">&nbsp;&nbsp;Broadcast</label>
  <label><input type="radio" name="type" value="Swap">&nbsp;&nbsp;Swap</label>
   <label><input type="radio" name="type" value="LocalVocal">&nbsp;&nbsp;LocalVocal</label></center>
</div>
		   <br><br><br>
		   <div id="broadcast" style="display: none;">
			<span>Enter the broadcast details</span>
			
			   <span style="float:  inherit;">Description&nbsp;&nbsp;&nbsp;</span>
			   <textarea style="resize: none;height:50px;width:440px"></textarea>
		
			<br><br>
			Category <input type="text" hidden="true"/>
			Location <input type="text" hidden="true"/> 
		    </div>
 <br><br><br><br>    
</div>



@endsection
