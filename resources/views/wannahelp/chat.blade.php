@extends('layouts.app')
@section('content')
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
                                    
                                    @foreach($chat_lists_all as $chat_list_all)
                                        @if($receptorUser == "")
                                       
                                         <a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/chat/{{$chat_list_all->conv_id}}" class="item">
                                            
                                          <img style="width:  70px;height: 70px;" src={{ $chat_list_all->picture }}>   
                                          <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{{ $chat_list_all->user_name }}</b></span>
                                        
                                        
                                         </a>
                                        @else
                                       
                                            @if($chat_list_all->conv_id == $receptorUser->conv_id)
                                                 <a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/chat/{{$chat_list_all->conv_id}}" class="active item">
                                        <img style="width:  70px;height: 70px;" src={{ $chat_list_all->picture }}>  
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{{ $chat_list_all->user_name }}</b></span>
                                                </a>
                                            @else
                                                <a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/chat/{{$chat_list_all->conv_id}}" class="item">
                                                    <img style="width:  70px;height: 70px;" src={{ $chat_list_all->picture }}>  
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{{ $chat_list_all->user_name }}</b></span>
                                                </a>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
            
                            <div class="thirteen wide column">
                                <div class="ui segment" style="padding: 1.5em 1.5em;">
                                    <div class="ui comments" style="max-width: 100%;">
                                        
                                        <h4 class="ui dividing header">
                                        
                                           
                                             @if($chat == "")
                                             <i class="talk outline icon"></i> 
                                             Please select a conversation
                                             @endif
                                             @if($chat!="")
                                            {{ $receptorUser->title }}</h4>
                                        <firebase-messages user-id="{{ Auth::user()->user_id }}" conv-id="{{ $chat->conv_id }}" receptor-name="{{ $receptorUser->name }}"></firebase-messages>
                                        @endif
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
                                    
                                    @foreach($chat_lists_bc as $chat_list_bc)
                                        @if($receptorUser == "")
                                       
                                          <a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/chat/{{$chat_list_bc->conv_id}}" class="item"><img style="width:  70px;height: 70px;" src={{ $chat_list_bc->picture }}>   
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{{ $chat_list_bc->user_name }}</b></span>
                                         </a>
                                        @else
                                       
                                            @if($chat_list_bc->conv_id == $receptorUser->conv_id)
                                                 <a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/chat/{{$chat_list_bc->conv_id}}" class="active item">
                                            <img style="width:  70px;height: 70px;" src={{ $chat_list_bc->picture }}>   
                                            
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{{ $chat_list_bc->user_name }}</b></span>
                                                </a>
                                            @else
                                                <a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/chat/{{$chat_list_bc->conv_id}}" class="item">
                                           <img style="width:  70px;height: 70px;" src={{ $chat_list_bc->picture }}>             
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{{ $chat_list_bc->user_name }}</b></span>
                                                </a>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
            
                            <div class="thirteen wide column">
                                <div class="ui segment" style="padding: 1.5em 1.5em;">
                                    <div class="ui comments" style="max-width: 100%;">
                                        
                                        <h4 class="ui dividing header">
                                        
                                           
                                             @if($chat == "")
                                             <i class="talk outline icon"></i> 
                                             Please select a conversation
                                             @endif
                                             @if($chat!="")
                                              {{ $receptorUser->title }}</h4>
                                        <firebase-messages user-id="{{ Auth::user()->user_id }}" conv-id="{{ $chat->conv_id }}" receptor-name="{{ $receptorUser->name }}"></firebase-messages>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
    

            </div>
            
            
            <div id="tab_sw_chat" class="tab-pane fade in">
                
                <div id="app" class="ui main container" style="margin-top:65px;">
                    @if(count($chat_lists_sw)==0)
                                   <center><span> No chat history found </span></center>
                                    @else
                    <div class="ui grid">
                        <div class="row">
                            <div class="three wide column">
                                <div class="ui vertical pointing menu">
                                    
                                    <h4 class="item ui header">
                                        Chat List
                                    </h4>
                                    
                                    @foreach($chat_lists_sw as $chat_list_sw)
                                        @if($receptorUser == "")
                                       
                                         <a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/chat/{{$chat_list_sw->conv_id}}" class="item">
                                             <img style="width:  70px;height: 70px;" src={{ $chat_list_bc->picture }}> 
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{{ $chat_list_sw->user_name }}</b></span>
                                         </a>
                                        @else
                                       
                                            @if($chat_list_sw->conv_id == $receptorUser->conv_id)
                                                 <a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/chat/{{$chat_list_sw->conv_id}}" class="active item">
                                                     <img style="width:  70px;height: 70px;" src={{ $chat_list_bc->picture }}> 
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{{ $chat_list_sw->user_name }}</b></span>
                                                </a>
                                            @else
                                                <a href="{{(new \App\Http\Controllers\Helper)->get_url()}}/chat/{{$chat_list_sw->conv_id}}" class="item">  <img style="width:  70px;height: 70px;" src={{ $chat_list_bc->picture }}> 
                                           <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{{ $chat_list_sw->user_name }}
                                                </a>
                                            @endif
                                        @endif
                                    @endforeach
                                    
                                </div>
                            </div>
            
                            <div class="thirteen wide column">
                                <div class="ui segment" style="padding: 1.5em 1.5em;">
                                    <div class="ui comments" style="max-width: 100%;">
                                        
                                        <h4 class="ui dividing header">
                                        
                                           
                                             @if($chat == "")
                                             <i class="talk outline icon"></i> 
                                             Please select a conversation
                                             @endif
                                             @if($chat!="")
                                              {{ $receptorUser->title }}</h4>
                                        <firebase-messages user-id="{{ Auth::user()->user_id }}" conv-id="{{ $chat->conv_id }}" receptor-name="{{ $receptorUser->name }}"></firebase-messages>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
    

            </div>
            
            
                        
            </div>
        </div>
                
    </div>
</div>

    
@endsection

