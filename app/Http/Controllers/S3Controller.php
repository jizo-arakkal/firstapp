<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RestController;
use config;
use Response;
use Image;
use FFMpeg;

//require_once(base_path().'/vendor/aws/aws-sdk-php/vendor/autoload.php');

use Aws\S3\S3Client;
use Aws\Credentials\CredentialProvider;
use Aws\S3\Exception\S3Exception;

class S3Controller extends Controller {	

	function __construct()
	{	
		$this->tbl_config_values = config('constants.table.config_values');	
		$this->acl_private = 'private';
		$this->acl_public_read = 'public-read';
		$this->acl_public_read_write = 'public-read-write';
		$this->acl_authenticated_read = 'authenticated-read';
		$this->region = 'ap-south-1';
		$this->version = 'latest';
		$this->signature_version = 'v4';		
		$this->default_bucket = 'wannahelp-new';		
		$keys = $this->get_aws_credential();		
		$this->s3 =$this->set_configuration($keys);	
		$this->rest = new RestController();		
	}
	public function get_aws_credential()
	{
		$keys = array();
		// Get access key from database		
		$result = DB::table($this->tbl_config_values)->select('*')->whereIn('key_term',array('aws_access_key','aws_secret_key'))->get();
		foreach ($result as $row)
		{
			if($row->key_term=='aws_access_key')
			{
				$keys['access_key']= $row->value;
			}
			if($row->key_term=='aws_secret_key')
			{
				$keys['secret_key']= $row->value;
			}
		}	
		return $keys;

	}
	public function set_configuration($keys)
	{		
	    
	    if(is_array($keys) AND array_key_exists('access_key', $keys) AND array_key_exists('secret_key', $keys))
	    {
	    	$options = [
		    'region'            => $this->region,
		    'version'           => $this->version,
		    'signature_version' => $this->signature_version,
		    'debug'   => false ,
		    'credentials' => [
		        'key'    => $keys['access_key'],
		        'secret' => $keys['secret_key']
		    			]
			];	
	    }
	    else
	    {
	    	$options = [
		    'region'            => $this->region,
		    'version'           => $this->version,
		    'signature_version' => $this->signature_version,
		    'debug'   => false ,
		    'credentials' => CredentialProvider::env()
			];   	
	    }

		$s3 = new S3Client($options);
		return $s3;
	}
	public function upload_file($bucket = '',$filename, $path='',  $formated_file_name ='')
	{			
		if($bucket=='')
				$bucket = $this->default_bucket;
		$param = array();
		if($formated_file_name=='')
		{
			$ext = pathinfo($_FILES[$filename]['name'], PATHINFO_EXTENSION);
			//$formated_file_name = 'wh_'.date('Ymdhisa').'_'.rand(1000,9999999).'.'.$ext;
			$formated_file_name = date('Ymdhis').rand(1000,99999999999).'.'.$ext;     		    	
		}
		$formated_file_path = $path.'/'.$formated_file_name;	
		$param['filename'] = $formated_file_name;						
		$upload = $this->s3->upload($bucket, $formated_file_path, fopen($_FILES[$filename]['tmp_name'], 'rb'), $this->acl_public_read);			
		$param['fullpath'] = $upload->get('ObjectURL');
		$param['error'] = $upload->get('error');
		return $param;	
	}

	public function upload_multiple_files($bucket = '',$filename, $path='',$thumb_path='')
	{
			
		if(($path=='swap')||($path=='profile_pic')||($path=='cover_pic'))
		{
		    
    			
    			if($bucket=='')
    				$bucket = $this->default_bucket;		
    		$total_files = count($_FILES[$filename]['name']);	
    		$valid_files = $this->check_file_formats($filename);		
    		$param = array();		
    		if($valid_files['type']=='image')
    		{
    			$param = array('error'=>'NO','message'=>'Valid File Formats','type'=>'image','files'=>array());
    			for($i=0; $i<$total_files; $i++)
    			{  
    				$temp = array();				
    				$ext = pathinfo($_FILES[$filename]['name'][$i], PATHINFO_EXTENSION);			
    				$formated_file_name = date('Ymdhis').rand(1000,99999999999).'.'.$ext;
    				$formated_file_path = $path.'/'.$formated_file_name;	
    				$temp['filename'] = $formated_file_name;						
    				$upload = $this->s3->upload($bucket, $formated_file_path, fopen($_FILES[$filename]['tmp_name'][$i], 'rb'), $this->acl_public_read);					
    				$temp['fullpath'] = $upload->get('ObjectURL');
    				$temp['error'] = $upload->get('error');
    				$param['files'][] = $temp; 
    				if(!empty($thumb_path))
    				{					
    					$formated_thumb_path = $path.'/'.$thumb_path.'/'.$formated_file_name;
    			        $img = Image::make($_FILES[$filename]['tmp_name'][$i]);
    			        $image_normal = $img->resize(null, 100, function ($constraint) {
    					    $constraint->aspectRatio();
    					    $constraint->upsize();
    					});					
    					$image_thumb = $image_normal->stream();
    					$thumb_upload = $this->s3->upload($bucket, $formated_thumb_path, $image_thumb->__toString(), $this->acl_public_read);
    
    				}		    				
    			}
    		}
    		elseif($valid_files['type']=='video')
    		{
    			$param = array('error'=>'NO','message'=>'Valid File Formats');
    			// Upload video file implement later
    		}
    		else
    		{
    			$param = array('error'=>'YES','message'=>'Invalid File Formats');			
    		}		
    		return $param;
		}
		if($path=='lv')
		{
		    
		    		if($bucket=='')
    				$bucket = $this->default_bucket;
    				
    		$total_files = count($_FILES[$filename]['name']);
    		
    		 $param = array('error'=>'NO','message'=>'Valid File Formats','type'=>'image','files'=>array());
    		 
    		 
    		for($i=0; $i<$total_files; $i++)
    		{
    		    
            		    	$accepted_image_formats = array('png','PNG','jpg','JPG','jpeg','JPEG','gif','GIF');
                		$accepted_video_formats = array('mp4','MP4','3gp','3GP','FLV','flv','WMV','wmv','AVI','avi');
                		$is_valid_image = array(); // 1 means available , 0 means not available
                		$is_valid_video = array();
        			$ext = pathinfo($_FILES[$filename]['name'][$i],PATHINFO_EXTENSION );
        			if(in_array($ext, $accepted_image_formats))
        			{
        				$is_valid_image[] = 1;
        			}
        			else
        			{
        				$is_valid_image[] = 0;				
        			}
        			if(in_array($ext, $accepted_video_formats))
        			{
        				$is_valid_video[] = 1;
        			}
        			else
        			{
        				$is_valid_video[] = 0;				
        			}
        			
                    if(!in_array(0,$is_valid_image))
            		{
            			$return_values['type'] = 'image';
            		}
            		else if(!in_array(0,$is_valid_video))
            		{
            			$return_values['type'] = 'video';	
            		}
            		else
            		{
            			$return_values['type'] = 'invalid';	
            		}
            		//dd($return_values);
            		if(($return_values['type']=='image'))
    		        {
    		               
            		            $temp = array();				
            				$ext = pathinfo($_FILES[$filename]['name'][$i], PATHINFO_EXTENSION);			
            				$formated_file_name = date('Ymdhis').rand(1000,99999999999).'.'.$ext;
            				$formated_file_path = $path.'/'.$formated_file_name;	
            				$temp['filename'] = $formated_file_name;						
            				$upload = $this->s3->upload($bucket, $formated_file_path, fopen($_FILES[$filename]['tmp_name'][$i], 'rb'), $this->acl_public_read);					
            				//dd($upload);
            				$temp['fullpath'] = $upload->get('ObjectURL');
            				$temp['error'] = $upload->get('error');
            				$param['files'][] = $temp; 
            				if(!empty($thumb_path))
            				{					
            					$formated_thumb_path = $path.'/'.$thumb_path.'/'.$formated_file_name;
            			        $img = Image::make($_FILES[$filename]['tmp_name'][$i]);
            			        $image_normal = $img->resize(null, 100, function ($constraint) {
            					    $constraint->aspectRatio();
            					    $constraint->upsize();
            					});					
            					$image_thumb = $image_normal->stream();
            					$thumb_upload = $this->s3->upload($bucket, $formated_thumb_path, $image_thumb->__toString(), $this->acl_public_read);
                                
            				}
            		         
    		         
    		            
    		        }
    		        elseif($return_values['type']=='video')
    		        {
    		                 //$param = array('error'=>'NO','message'=>'Valid File Formats','type'=>'image','files'=>array());
            		            $temp = array();				
            				$ext = pathinfo($_FILES[$filename]['name'][$i], PATHINFO_EXTENSION);			
            				$formated_file_name = date('Ymdhis').rand(1000,99999999999).'.'.$ext;
            				$formated_file_path = $path.'/'.$formated_file_name;	
            				$temp['filename'] = $formated_file_name;	
            				
            				
            				$upload = $this->s3->upload($bucket, $formated_file_path, fopen($_FILES[$filename]['tmp_name'][$i], 'rb'), $this->acl_public_read);
            				
            					$temp['fullpath'] = $upload->get('ObjectURL');
            				$temp['error'] = null;
            				$param['files'][] = $temp; 
    		        }
    		    
    		}
    		return $param;
		}
	}

	public function check_file_formats($filename)
	{
		$total_files = count($_FILES[$filename]['name']);
		$accepted_image_formats = array('png','PNG','jpg','JPG','jpeg','JPEG','gif','GIF');
		$accepted_video_formats = array('mp4','MP4','3gp','3GP','FLV','flv','WMV','wmv','AVI','avi');
		$is_valid_image = array(); // 1 means available , 0 means not available
		$is_valid_video = array();
		for($i=0; $i<$total_files; $i++)
		{						
			$ext = pathinfo($_FILES[$filename]['name'][$i],PATHINFO_EXTENSION );
			if(in_array($ext, $accepted_image_formats))
			{
				$is_valid_image[] = 1;
			}
			else
			{
				$is_valid_image[] = 0;				
			}
			if(in_array($ext, $accepted_video_formats))
			{
				$is_valid_video[] = 1;
			}
			else
			{
				$is_valid_video[] = 0;				
			}
		}
		$return_values = array();
		
		if(!in_array(0,$is_valid_image))
		{
			$return_values['type'] = 'image';
		}
		else if(!in_array(0,$is_valid_video))
		{
			$return_values['type'] = 'video';	
		}
		else
		{
			$return_values['type'] = 'invalid';	
		}
		return $return_values;		

	}
	
	
		public function check_file_formatsnew($filename)
	{
	//	$total_files = count($_FILES[$filename]['name']);
		$accepted_image_formats = array('png','PNG','jpg','JPG','jpeg','JPEG','gif','GIF');
		$accepted_video_formats = array('mp4','MP4','3gp','3GP','FLV','flv','WMV','wmv','AVI','avi');
		$is_valid_image = array(); // 1 means available , 0 means not available
		$is_valid_video = array();
		//for($i=0; $i<$total_files; $i++)
		//{						
		
		    	$accepted_image_formats = array('png','PNG','jpg','JPG','jpeg','JPEG','gif','GIF');
        		$accepted_video_formats = array('mp4','MP4','3gp','3GP','FLV','flv','WMV','wmv','AVI','avi');
        		$is_valid_image = array(); // 1 means available , 0 means not available
        		$is_valid_video = array();
			$ext = pathinfo($_FILES[$filename]['name'][$i],PATHINFO_EXTENSION );
			if(in_array($ext, $accepted_image_formats))
			{
				$is_valid_image[] = 1;
			}
			else
			{
				$is_valid_image[] = 0;				
			}
			if(in_array($ext, $accepted_video_formats))
			{
				$is_valid_video[] = 1;
			}
			else
			{
				$is_valid_video[] = 0;				
			}
	//	}
		$return_values = array();
		
		if(!in_array(0,$is_valid_image))
		{
			$return_values['type'] = 'image';
		}
		else if(!in_array(0,$is_valid_video))
		{
			$return_values['type'] = 'video';	
		}
		else
		{
			$return_values['type'] = 'invalid';	
		}
		return $return_values;		

	}
   public function media_storage($bucket,$field_name,$path,$file_name)
   {

    	$final_path = $path.'/'.$file_name;
     	$media_upload = $this->s3->upload($bucket,$final_path,fopen($_FILES[$field_name]['tmp_name'], 'rb'),$this->acl_public_read);
	   	$media_path = $media_upload->get('ObjectURL');
	   	if($media_path != '')
	   	{
	   		return $media_path;
	   	}else
	   	{
	   		return false;
	   	}
   }

   function multi_media_storage($bucket,$field_name,$path,$file_name,$tmp_file)
   {
   		$final_path = $path.'/'.$file_name;
	   	$media_upload = $this->s3->upload($bucket,$final_path,fopen($tmp_file, 'rb'),$this->acl_public_read);
	   	$media_path = $media_upload->get('ObjectURL');
	   	if($media_path != '')
	   	{
	   		return $media_path;
	   	}else
	   	{
	   		return false;
	   	}
		 
   }

   public function delete_media($bucket,$file_name)
   {
   	$result = $this->s3->deleteObject(array(
	    'Bucket' => $bucket,
	    'Key'    => $file_name
	));  
	// return $result->get('error');     

   }


   public function largeuploads($tmpfile_name)
   {
   	$bucket = 'wannahelp-assets';
   	$file_path = 'LvClubs/';
   	  $this->s3->putObject([
        'Bucket' => $bucket,
        'Key'    => $tmpfile_name,
        'Body'   => fopen($file_path, 'r'),
        'ACL'    => 'public-read',
    ]);
   } 
   public function temp_to_thumb($bucket,$source,$path,$file_name)
   {
   		$final_path = $path.'/'.$file_name;
	  // 	$media_upload = $this->s3->upload($bucket,$final_path,$source,$this->acl_public_read);
	  // 	$media_upload = $this->s3->copyObject($bucket,$final_path,$source,$this->acl_public_read);

	    	$result =  $this->s3->putObject(array(
						    'Bucket'     => $bucket,
						    'Key'        => $final_path,
						    'SourceFile' => $source,
						    'ACL'    => 'public-read',
						));
	    	/*print_r($result);
    exit;*/
	   	$media_path = $result->get('ObjectURL');
	   	if($media_path != '')
	   	{
	   		return $media_path;
	   	}else
	   	{
	   		return false;
	   	}

   }



   function copyfile_from_another_folder($bucket,$destination_folder_with_file_name,$source_folder_with_file_name)
   {
 
 	  $result = 	$this->s3->copyObject(array(
		    'Bucket'     => $bucket,
		    'Key'        => $destination_folder_with_file_name,
		    'CopySource' => "{$bucket}/{$source_folder_with_file_name}",
		    'ACL'        => 'public-read',
		));
  	 		/*print_r($result);
  	 		exit;*/
   }


}
?>