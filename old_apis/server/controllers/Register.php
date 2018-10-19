<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Register extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Register_model');
        $this->load->library('curl'); 
        $this->checkAuthKey();
    }
    public function test_sms()
    {
        echo $this->validation;exit;
        $sms=$this->get_sms_credintials();
        $msg=$this->input->post('msg');
        $mobile=$this->input->post('mobile');
        $ret=$this->curl->send_sms($sms,$msg,$mobile);
        if($ret)
        {
          $this->json_response(array("status"=>"1","msg"=>"sms has been sent successfully"));
        }
        else
        {
          $this->json_response(array("status"=>"0","msg"=>"sms sending failed"));
        }
    }

    public function do_facebook_login()
    {
        $facebook_user_id=$this->input->post('id');
        $name=$this->input->post('name');
        $email=$this->input->post('email');
        $gender=$this->input->post('gender');
        $facebook_cover_pic=$this->input->post('coverPic');
        $age=$this->input->post('age');
        $facebook_profile_dp=$this->input->post('profileDp');
        $ostype=$this->input->post('ostype');
        $device_id=$this->input->post('device_id');
        $device_model=$this->input->post('device_model');
        if($facebook_user_id=='NA' || $name=='NA')
        {
          $this->json_response(array("status"=>"0","msg"=>"All Required Inputs are not given"));
        }
        $auth=$this->Register_model->do_facebook_login($facebook_user_id,$name,$email,$gender,$facebook_cover_pic,$age,$facebook_profile_dp,$ostype,$device_id,$device_model);
        $this->json_response(array("status"=>"1","msg"=>"Facebook Login Successfull","data"=>array("AWSAccessKeyId"=>$auth)));
    }

    public function do_google_login()
    {
        $google_user_id=$this->input->post('userID');
        $name=$this->input->post('name');
        $email=$this->input->post('email');
        $ostype=$this->input->post('ostype');
        $device_id=$this->input->post('device_id');
        $device_model=$this->input->post('device_model');  
        if($google_user_id=='NA' || $name=='NA')
        {
          $this->json_response(array("status"=>"0","msg"=>"All Required Inputs are not given"));
        }
        $auth=$this->Register_model->do_google_login($google_user_id,$name,$email,$ostype,$device_id,$device_model);
        $this->json_response(array("status"=>"1","msg"=>"Google Login Successfull","data"=>array("AWSAccessKeyId"=>$auth)));
    }

    public function otp_verification()
    {

      $ostype=$this->input->post('ostype');
      $device_id=$this->input->post('device_id');
      $device_model=$this->input->post('device_model');
      $mobile=$this->input->post('mobilenumber');
      $otp=$this->input->post('otp');
      $country_code=$this->input->post('country_code');
      //$tokenfornotification=$this->input->post('tokenfornotification');
      if($ostype=='NA' || $device_id=='NA' || $device_model=='NA' || $mobile=='NA' || $otp=='NA' || $country_code=='NA')
      {
           $this->json_response(array("status"=>"0","msg"=>"All Inputs are not given"));

      }
      $ret=$this->Register_model->otp_verification($ostype,$device_id,$device_model,$mobile,$otp,$country_code);
      if($ret==false)
      {
        $this->json_response(array("status"=>"0","msg"=>"OTP verification failed"));
      }
      else
      {
        $this->json_response(array("status"=>"1","msg"=>"OTP verification Successfull","data"=>array("AWSAccessKeyId"=>$ret)));
      }
    }

    public function mobile_verification()
    {  
      $ostype=$this->input->post('ostype');
      $device_id=$this->input->post('device_id');
      $device_model=$this->input->post('device_model');
      $country_code=$this->input->post('country_code');
      $mobile=$this->input->post('mobilenumber');
      if($ostype=='NA' || $device_id=='NA' || $device_model=='NA' || $mobile=='NA' || $country_code=='NA')
      {
           $this->json_response(array("status"=>"0","msg"=>"All Inputs are not given"));
      }
      else
      {
        $otp=$this->generate_otp();
        $insert_result=$this->Register_model->register_by_mobile($ostype,$device_id,$device_model,$mobile,$otp,$country_code,$this->current_authkey);    

        if($insert_result=='autherror')
        {
            $this->json_response(array("status"=>"1","msg"=>"Mobile verification Failed"));
        }
        else if($insert_result=='exists')
        {
            $this->json_response(array("status"=>"1","msg"=>"Mobile verification Successfull"));
        }
        else if($insert_result=='failed')
        {
            $this->json_response(array("status"=>"0","msg"=>"Mobile verification Failed"));
        }
        else 
        {
            $authKey=$this->generateAuthKey($insert_result);
            $sms=$this->get_sms_credintials();
            $ret=$this->curl->send_sms($sms,$otp,$mobile,$country_code);
            if($ret)
            {  
              $this->json_response(array("status"=>"1","msg"=>"OTP successfully sent"));  
            }
            else
            {
               $this->json_response(array("status"=>"0","msg"=>"OTP sending failed"));
            }

        }      

      }
    }
    public function do_login()
    {
       $username=$this->input->post('email');
       $password=$this->input->post('password');
       //$facebook_profile_dp=$this->input->post('profileDp');
       $ostype=$this->input->post('ostype');
       $device_id=$this->input->post('device_id');
       $device_model=$this->input->post('device_model'); 
       if($username=='NA' || $password=='NA' || $username=='' || $password=='')
       {
          $this->json_response(array("status"=>"0","msg"=>"Login Failed gg"));
       }
       $ret=$this->Register_model->do_login($username,$password,$ostype,$device_id,$device_model);
       if($ret=='link')
       {
          $this->json_response(array("status"=>"0","msg"=>"link not verified"));
       }
       else if($ret=='link1')
       {
          $key=$this->Register_model->get_key($username,$password);
          $this->json_response(array("status"=>"1","msg"=>"Login Successfull","data"=>array("AWSAccessKeyId"=>$key)));
       }
       else if($ret=='link2')
       {
          $this->json_response(array("status"=>"0","msg"=>"Login Failed"));
       }
    }
    public function verify_registration_link()
    {
      if(!isset($_GET['key']) || !isset($_GET['id']))
      {
         $this->json_response(array("status"=>"0","msg"=>"Registration is Failed"));
      }
      else
      {
         $key=$_GET['key'];
         $id=$_GET['id'];
         $ret=$this->Register_model->verify_registration_link($key,$id);
         if($ret)
         {
            $this->json_response(array("msg"=>"Email verification successful"));
         }
         else
         {
            $this->json_response(array("status"=>"0","msg"=>"Registration is failed"));
         }
      }
    }

    public function do_register()
    {
      $email=$this->input->post('email');
      $username=$this->input->post('username'); 
      $password=$this->input->post('password');
      $ostype=$this->input->post('ostype');
      $device_id=$this->input->post('device_id');
      $device_model=$this->input->post('device_model');
      if( $username=='NA' || $password=='NA' || $ostype=='NA' || $device_id=='NA' || $device_model=='NA')
      {
        $this->json_response(array("status"=>"0","msg"=>"All Inputs are not given"));
      }
      //$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
      /*if (!preg_match($regex, $email)) {
      $this->json_response(array("status"=>"0","msg"=>"Invalid Email Id"));
      }*/
      if ($email=='')
      {
        $this->json_response(array("status"=>"0","msg"=>"Invalid Email Id"));
      }
      if(strlen(trim($password))<6)
      {
        $this->json_response(array("status"=>"0","msg"=>"Password must be minimum of 6 character"));
      }
      $key=md5(uniqid());
      $check=$this->Register_model->check_existing_users($email,$username);
      if($check=='username')
      {
        $this->json_response(array("status"=>"0","msg"=>"user already registered"));
      }
      else if($check=='email')
      {
        $this->json_response(array("status"=>"0","msg"=>"user already registered"));
      }
      $ret=$this->Register_model->do_register($email,$username,$device_id,$device_model,$password,$ostype,$key);

      if($ret>0)
      {
          $authKey=$this->generateAuthKey($ret);
          $link=base_url()."server/Register/verify_registration_link?key=".$key."&id=".$ret."&takebakeauth=123456";
          $msg = '<html>
                <head></head>
                <body> 
                  <div>
                    <h3>WannaHelp</h3>
                    <div style="color:#8D8686;">
                    <h4>Pls Click the Following Link to Complete Your registration in WannHelp</h4>
                    <div id="adders_text_">
                       <a href="'.$link.'">'.$link.'</a>
                  </div>  
                </body>
                </html>'; 

          $email_sending_ret=$this->email_sending($email,$msg);
          if($email_sending_ret)
          {
             $this->json_response(array("status"=>"1","msg"=>"A link has been sent to the email to verify"));
          }
          else
          {
            $this->json_response(array("status"=>"0","msg"=>"Email sending Failed"));
          } 
      }
      else
      {
           $this->json_response(array("status"=>"0","msg"=>"Registration is Failed"));
      }
  }


}


?>