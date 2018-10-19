<?php


namespace App\Http\Controllers;


class Helper
{
    /**
     * Prettify error message output.
     *
     * @return string 
     */
    public static function get_swap_image_loc()
    {
        return "https://s3.ap-south-1.amazonaws.com/wannahelp-new/swap/";
    }
    
    
    public static function get_lv_image_loc()
    {
        return "https://s3.ap-south-1.amazonaws.com/wannahelp-new/lv/";
    }
    
    public static function get_url()
    {
        return "http://localhost:8000";
    }
    
     public static function get_profile_pic_image_loc()
    {
        return "https://s3.ap-south-1.amazonaws.com/wannahelp-new/profile_pic/";
    }
    
    public static function get_cover_pic_image_loc()
    {
        return "https://s3.ap-south-1.amazonaws.com/wannahelp-new/cover_pic/";
    }
    
    
}