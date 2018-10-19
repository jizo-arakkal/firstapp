<?php

use Illuminate\Http\Request;
//Register API 
Route::post('/register_email', 'UserController@register_email');
Route::post('/register_mobile', 'UserController@register_mobile');
Route::post('/register_gmail', 'UserController@register_gmail');
Route::post('/register_facebook', 'UserController@register_facebook');
Route::post('/login_email', 'UserController@login_email');
Route::post('/verify_otp', 'UserController@verify_otp');
Route::post('/insert_users', 'UserController@insert_users');
//Remaining all api
Route::group(['middleware' => ['verifyrequest']], function () {	
	Route::get('/get_categories', 'UserController@get_categories');  
	Route::post('/insert_categories', 'UserController@insert_categories');
	Route::post('/delete_categories', 'UserController@delete_categories');
	Route::post('/insert_location', 'UserController@insert_location');
	Route::post('/edit_profile', 'UserController@edit_profile');
	Route::post('/savedp', 'UserController@savedp');
	Route::post('/savecover', 'UserController@savecover');
	Route::post('/follow_unfollow_user', 'UserController@follow_unfollow_user');
	
	Route::post('/following_followers_list', 'UserController@following_followers_list');
	
	    Route::post('/new_chat', 'UserController@new_chat');
    Route::post('/chat/', 'UserController@usersChat');
    Route::post('/chat/{conv_id}', 'UserController@usersChat');
	
	
	Route::post('/savebasicbio', 'UserController@savebasicbio');
	Route::post('/getprofiledetails', 'UserController@getprofiledetails');
	Route::post('/fetch_users', 'WhController@fetch_users');
	Route::post('/search_users', 'WhController@search_users');


    Route::post('/add_bc', 'BroadcastController@add_bc');
   // Route::post('/add_bc1', 'BroadcastController@add_bc1');
    Route::post('/get_bc', 'BroadcastController@get_bc');
    Route::post('/get_bc1', 'BroadcastController@get_bc1');
    Route::post('/get_bc_user', 'BroadcastController@get_bc_user');
    

	Route::post('/add_swap', 'SwapController@add_swap');
	Route::post('/get_swap', 'SwapController@get_swap');
	
	Route::post('/get_swap_user', 'SwapController@get_swap_user');
	Route::post('/get_swap_detail', 'SwapController@get_swap_detail');
	Route::post('/report_swap', 'SwapController@report_swap');
	Route::post('/get_swap_feedback_types', 'SwapController@get_swap_feedback_types');
	Route::post('/get_swap_suggestion', 'SwapController@get_swap_suggestion');	

	Route::post('/add_lv', 'LvController@add_lv');
	Route::post('/get_lv', 'LvController@get_lv');
	Route::post('/get_lv_detail', 'LvController@get_lv_detail');
	Route::post('/like_lv', 'LvController@like_lv');
	Route::post('/share_lv', 'LvController@share_lv');
	Route::post('/view_lv', 'LvController@view_lv');
	Route::post('/comment_lv', 'LvController@comment_lv');
	Route::post('/get_lv_comment', 'LvController@get_lv_comment');
	Route::post('/delete_lv_comment', 'LvController@delete_lv_comment');
	Route::post('/get_lv_user', 'LvController@get_lv_user');
	
});


