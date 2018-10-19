<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use DB;
use Config;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\PHPMailer;
use App\Libraries\Exception;

class MailController extends Controller {

   public function __construct()
   {
      $this->tbl_config_values = config('constants.table.config_values');
      $smtp_details = DB::table($this->tbl_config_values)->where('key_term','smtp_secure')->first();     
      $this->smtp_secure = $smtp_details->value;
      $smtp_details = DB::table($this->tbl_config_values)->where('key_term','smtp_host')->first();
      $this->smtp_host = $smtp_details->value;
      $smtp_details = DB::table($this->tbl_config_values)->where('key_term','smtp_port')->first();
      $this->smtp_port = $smtp_details->value;
      $smtp_details = DB::table($this->tbl_config_values)->where('key_term','smtp_username')->first();
      $this->smtp_username = $smtp_details->value;
      $smtp_details = DB::table($this->tbl_config_values)->where('key_term','smtp_password')->first();
      $this->smtp_password = $smtp_details->value;
      $smtp_details = DB::table($this->tbl_config_values)->where('key_term','smtp_setfrom')->first();
      $this->smtp_setfrom = $smtp_details->value;
   }
	
   public function basic_email(){
      $data = array('name'=>"Virat Gandhi");
   
      Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
         $message->from('xyz@gmail.com','Virat Gandhi');
      });
      echo "Basic Email Sent. Check your inbox.";
   }

   public function sendCustomMail($data)
   {
      $to = $data['email'];
      $subject = 'WannaHelp Registration';
      $headers = "From: " . strip_tags($this->smtp_username) . "\r\n";        
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
      $url = url('/verify_email/'.base64_encode($data['email']).'/'.base64_encode($data['email_token']));
      $message = '<h4>Hi ,</h4><br>';
      $message .= '<p>Thanks for registering with WannaHelp.</p>';
      $message .= '<p>Kindly confirm your email : <a href="'.$url.'">Click here</a> </p>';

      if(mail($to, $subject, $message, $headers))
      {
         return true;
      }
      else
      {
         return false;
      }
   }

   public function html_email($data)
   {         
      $mail = new PHPMailer(true);
      try 
      {          
          $mail->SMTPDebug = 2;                               
          $mail->isSMTP();                                   
          $mail->Host = $this->smtp_host; 
          $mail->SMTPAuth = true;                              
          $mail->Username = $this->smtp_username;               
          $mail->Password = $this->smtp_password;                          
          $mail->SMTPSecure = $this->smtp_secure;                           
          $mail->Port = $this->smtp_port;                                 

          //Recipients
          $mail->setFrom($this->smtp_username, 'WannaHelp Team');
          $mail->addAddress($data['email'], $data['name']);

          //Content
          $mail->isHTML(true);                                  // Set email format to HTML
          $mail->Subject = 'WannaHelp Registration';
          $mail->Body    = 'Hi';         
          if($mail->send())
          {
            return true;
          }
          else
          {
            return false;
          }
          
      }
      catch (Exception $e)
      {
          //return false;
          echo 'Message could not be sent.';
          echo 'Mailer Error: ' . $mail->ErrorInfo;
      }
   }
   
   public function attachment_email(){
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
         $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
         $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
         $message->from('xyz@gmail.com','Virat Gandhi');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }
}
