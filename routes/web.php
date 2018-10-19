<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| 
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'success';
    // return what you want
});

Route::get('/img', function()
{
    $img = Image::make('https://pi.tedcdn.com/r/tedideas.files.wordpress.com/2017/05/featured_art_heal_forests.jpg');
    $img->resize(null, 100, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    });
   // $img->save('https://s3.ap-south-1.amazonaws.com/wannahelp-new/swap/thumb/2017110804103433598932961.jpg');
    $image_thumb = $img->stream();
    echo $image_thumb->__toString();
    //echo '<img src="'.$i.'"/>';
});


Route::get('/verify_email/{email}/{token}', function ($email,$token){
    $email = base64_decode($email);
    $token = base64_decode($token);
    try{
    	$result = DB::table('users')->where('email',$email)->where('email_verification_code',$token)->first();
        DB::table('users')->where('email',$email)->update(array('email_verify'=>1));
    }
    catch(Exception $e)
    {
    	return 'Invalid arguments';
    }   
    
    if(!empty($result))
    {    	
    	return view('email.email_verify',['status'=>'success']);
    }
    else
    {    	
    	return view('email.email_verify',['status'=>'fail']);
    }

});

// Users who are authenticated can use the following functionalities
// Check App\Http\Middleware\Authenticate.php for Redirect URL

Route::group( ['middleware' => 'auth' ], function()
{
    Route::get('/','HomeController@index');
   //  Route::post('/','HomeController@index');
    Route::post('/create_post','HomeController@create_post');
    Route::get('/createpost','HomeController@show_create_post');
    //Route::post('login', [ 'as' => 'login', 'uses' => 'HomeController@login']);
    //Route::get('/swap_detail','HomeController@swap_detail');
    Route::get('/swap/{item}/{messaged_user_id?}/{id?}','HomeController@swap_detail');
    Route::get('/lv/{item}/{itemf}','HomeController@localvocal_detail');
    Route::get('/user/{id}/{name}','HomeController@show_user_profile');
    Route::get('/google', 'HomeController@loginWithGoogle');
    Route::get('/fb', 'HomeController@loginWithFacebook');
    Route::get('/show_selected_category', 'HomeController@show_selected_category');
    Route::get('/show_selected_location', 'HomeController@show_selected_location');
    
    Route::get('/check_noti', 'HomeController@check_noti');
    Route::get('/notifications', 'HomeController@show_noti');
  
   
    Route::get('/follow_unfollow_user', 'HomeController@follow_unfollow_user');
   
    Route::get('/make_bc_current', 'HomeController@make_bc_current');
     
    Route::get('/following_followers_list', 'HomeController@following_followers_list');
    
    Route::post('/boost_post', 'HomeController@boost_post');
    
     Route::get('/get_credits_count', 'HomeController@get_credits_count');
    
    Route::get('/edit_post', 'HomeController@edit_post');
    Route::post('/editsave_post', 'HomeController@editsave_post');
    Route::post('/report_post', 'HomeController@report_post');
    
    Route::get('/save_comment', 'HomeController@save_comment');
    Route::get('/like_unlike_lv', 'HomeController@like_unlike_lv');
      
    Route::get('/new_chat', 'ChatsController@new_chat');
    Route::get('/chat/', 'ChatsController@usersChat');
    
    Route::get('/messages', 'HomeController@usersChat');
    Route::get('/messages/{conv_id}', 'HomeController@usersChat');
    
    Route::get('/chat/{conv_id}', 'ChatsController@usersChat');
    
    Route::get('/profile', 'HomeController@getprofiledetails');
    
     Route::get('/pay', 'HomeController@payment');
     Route::post('/pay', 'HomeController@payment');
     Route::get('/transaction', 'HomeController@transaction_summary');
     //Route::post('/transaction', 'HomeController@transaction_summary');
     Route::post('/save_transaction', 'HomeController@save_transaction');
     Route::post('/navigate_payment', 'HomeController@navigate_payment'); 
     Route::get('/validate_coupon', 'HomeController@validate_coupon');
    Route::get('/followers', 'HomeController@following_followers_list');
    Route::get('/payment', 'HomeController@payment');
    
    Route::get('/use_credit', 'HomeController@use_credit');
    
    Route::get('/credits', 'HomeController@credits_summary');
    
    
    Route::get('/open_chat1', 'HomeController@open_chat1');
     Route::get('/open_chat_latest', 'HomeController@open_chat_latest');
    Route::get('/send_messages', 'HomeController@send_messages');
Route::get('/get_messages', 'HomeController@get_messages');
   
    
    Route::get('/saveprofile', 'HomeController@setprofiledetails');
    Route::post('/savedp', 'HomeController@savedp');
    Route::post('/savecover', 'HomeController@savecover');
    Route::post('/savebasicbio', 'HomeController@savebasicbio');
    Route::post('/saveupdatepassword', 'HomeController@saveupdatepassword');
    Route::get('/dummy', 'HomeController@dummy');
    Route::get('/locate', 'HomeController@locate');
    Route::get('logout', array('uses' => 'HomeController@doLogout'));
});

// Users who are NOT authenticated can use the following functionalities: 
// Check App\Http\Middleware\Authenticate.php for Redirect URL
 Route::get('/fb', 'HomeController@loginWithFacebook');
  Route::get('/google', 'HomeController@loginWithGoogle');
Route::post('/create_post','HomeController@create_post');
Route::get('/createpost','HomeController@show_create_post');
Route::get('/','HomeController@index');
 //Route::post('/','HomeController@index');
Route::get('/test','HomeController@test');
Route::get('/register','HomeController@register');
Route::post('/send_otp','HomeController@send_otp');
Route::post('/verify_otp','HomeController@verify_otp');
//Route::get('/register_mobile','HomeController@register_mobile');
Route::get('/login','HomeController@login');
Route::get('/swap/{item}','HomeController@swap_detail');
Route::get('/lv/{item}','HomeController@localvocal_detail');
Route::get('/user/{id}','HomeController@show_user_profile');
Route::get('/show_selected_category', 'HomeController@show_selected_category');
Route::get('/following_followers_list', 'HomeController@following_followers_list'); 

    
    
 
   
   
   
 Route::get('/locate', 'HomeController@locate');   
/*
Route::get('/','HomeController@index');
Route::post('/create_post','HomeController@create_post');
Route::get('/login','HomeController@login');
//Route::get('/swap_detail','HomeController@swap_detail');

Route::get('/swap/{item}','HomeController@swap_detail');
Route::get('/lv/{item}','HomeController@localvocal_detail');

Route::get('/user/{id}','HomeController@show_user_profile');


Route::get('/google', 'HomeController@loginWithGoogle');

Route::get('/fb', 'HomeController@loginWithFacebook');

Route::get('/show_selected_category', 'HomeController@show_selected_category');
Route::get('/show_selected_location', 'HomeController@show_selected_location');

Route::get('/save_post', 'HomeController@save_post');

Route::get('/profile', 'HomeController@getprofiledetails');

Route::get('/saveprofile', 'HomeController@setprofiledetails');

Route::post('/savedp', 'HomeController@savedp');

Route::post('/savebasicbio', 'HomeController@savebasicbio');

Route::get('/dummy', 'HomeController@dummy');

Route::get('logout', array('uses' => 'HomeController@doLogout'));
*/

