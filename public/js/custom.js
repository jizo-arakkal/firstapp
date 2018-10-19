$(document).ready(function(){

	var deviceWidth = $(window).width();  
	if(deviceWidth>=200 && deviceWidth<350)
	{	  	 	
		$('.home_slider').css({'height':'305px'});
		$('.slider_content_bottom_content').css({'width':'100%','left':'0%','right':'0%'});
	}
	else if(deviceWidth>=350 && deviceWidth<400)
	{	  	 	
		$('.home_slider').css({'height':'305px'});
		$('.slider_content_bottom_content').css({'width':'100%','left':'0%','right':'0%'});
	}
	else if(deviceWidth>=400 && deviceWidth<500)
	{	  	 	
		$('.home_slider').css({'height':'395px'});
		$('.slider_content_bottom_content').css({'width':'100%','left':'0%','right':'0%'});
	}
	else if(deviceWidth>=500 && deviceWidth<650)
	{	  	 	
		$('.home_slider').css({'height':'445px'});
		$('.slider_content_bottom_content').css({'width':'100%','left':'0%','right':'0%'});
	}
	else if(deviceWidth>=650 && deviceWidth<850)
	{	  	 	
		$('.home_slider').css({'height':'545px'});
		$('.slider_content_bottom_content').css({'width':'100%','left':'0%','right':'0%'});
	}
	else
	{	  	 	
		$('.home_slider').css({'height':'545px'}); 
		$('.slider_content_bottom_content').css({'width':'80%','left':'10%','right':'10%'});
	}	

	//Open & Close top location selector
	$('#open_location_selector').click(function(){
		$('#top_location_selector').slideDown();
	});
	$('#close_location_selector').click(function(){
		$('#top_location_selector').slideUp();
	});
	$('.top_location_selector_bottom').click(function(){
		$('#top_location_selector').slideUp();
	});	

	//Category scroller script 
	$('#cat_scroll_arrow_left').click(function() {	 
      event.preventDefault();
      $('.category_scroller_wrap').animate({
        scrollLeft: "-=350px"
      },'slow');
    });
   
    $('#cat_scroll_arrow_right').click(function() {
      event.preventDefault();    
      $('.category_scroller_wrap').animate({
        scrollLeft: "+=350px"
      },'slow');
    });
    
    
    	$('#cat_scroll_arrow_left_bc').click(function() {	 
      event.preventDefault();
      $('.category_scroller_wrap_bc').animate({
        scrollLeft: "-=350px"
      },'slow');
    });
   
    $('#cat_scroll_arrow_right_bc').click(function() {
      event.preventDefault();    
      $('.category_scroller_wrap_bc').animate({
        scrollLeft: "+=350px"
      },'slow');
    });
    
    	$('#cat_scroll_arrow_left_sw').click(function() {	 
      event.preventDefault();
      $('.category_scroller_wrap_sw').animate({
        scrollLeft: "-=350px"
      },'slow');
    });
   
    $('#cat_scroll_arrow_right_sw').click(function() {
      event.preventDefault();    
      $('.category_scroller_wrap_sw').animate({
        scrollLeft: "+=350px"
      },'slow');
    });


    	$('#cat_scroll_arrow_left_lv').click(function() {	 
      event.preventDefault();
      $('.category_scroller_wrap_lv').animate({
        scrollLeft: "-=350px"
      },'slow');
    });
   
    $('#cat_scroll_arrow_right_lv').click(function() {
      event.preventDefault();    
      $('.category_scroller_wrap_lv').animate({
        scrollLeft: "+=350px"
      },'slow');
    });
    
    	$('#cat_scroll_arrow_left_bc_edit').click(function() {	 
      event.preventDefault();
      $('.category_scroller_wrap_bc_edit').animate({
        scrollLeft: "-=350px"
      },'slow');
    });
   
    $('#cat_scroll_arrow_right_bc_edit').click(function() {
      event.preventDefault();    
      $('.category_scroller_wrap_bc_edit').animate({
        scrollLeft: "+=350px"
      },'slow');
    });
    
    	$('#cat_scroll_arrow_left_sw_edit').click(function() {	 
      event.preventDefault();
      $('.category_scroller_wrap_sw_edit').animate({
        scrollLeft: "-=350px"
      },'slow');
    });
   
    $('#cat_scroll_arrow_right_sw_edit').click(function() {
      event.preventDefault();    
      $('.category_scroller_wrap_sw_edit').animate({
        scrollLeft: "+=350px"
      },'slow');
    });
    
    	$('#cat_scroll_arrow_left_lv_edit').click(function() {	 
      event.preventDefault();
      $('.category_scroller_wrap_lv_edit').animate({
        scrollLeft: "-=350px"
      },'slow');
    });
   
    $('#cat_scroll_arrow_right_lv_edit').click(function() {
      event.preventDefault();    
      $('.category_scroller_wrap_lv_edit').animate({
        scrollLeft: "+=350px"
      },'slow');
    });

    $(window).scroll(function(e){ 
	  var $el = $('.slider_category_wrap'); 	 
	  var isPositionFixed = ($el.css('position') == 'fixed');
	  var deviceWidth = $(window).width();  

	  if ($(this).scrollTop() > 370 && !isPositionFixed){ 
	     $('.slider_category_wrap').css({'position': 'fixed', 'top': '35px','opacity':'1'});
	  }
	  if ($(this).scrollTop() < 370 && isPositionFixed)
	  {
	  	 //alert(deviceWidth);
	  	 if(deviceWidth>=200 && deviceWidth<350)
	  	 {
	  	 	$('.slider_category_wrap').css({'position': 'absolute', 'top': '130px'});
	  	 }
	  	 else if(deviceWidth>=350 && deviceWidth<400)
	  	 {
	  	 	$('.slider_category_wrap').css({'position': 'absolute', 'top': '139px'});
	  	 }
	  	 else if(deviceWidth>=400 && deviceWidth<500)
	  	 {
	  	 	$('.slider_category_wrap').css({'position': 'absolute', 'top': '202px'});
	  	 }
	  	 else if(deviceWidth>=500 && deviceWidth<650)
	  	 {
	  	 	$('.slider_category_wrap').css({'position': 'absolute', 'top': '296px'});
	  	 }
	  	 else if(deviceWidth>=650 && deviceWidth<850)
	  	 {
	  	 	$('.slider_category_wrap').css({'position': 'absolute', 'top': '390px'});
	  	 }
	  	 else
	  	 {
	  	 	$('.slider_category_wrap').css({'position': 'absolute', 'top': '390px'});
	  	 }	     
	  } 
	});



});

