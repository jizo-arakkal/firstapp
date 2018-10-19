<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Wannahelp extends REST_Controller 

{ 

public function __construct() {

        parent::__construct();

        $this->load->model('Wannahelp_model');

       $this->load->library('curl');

     

       $this->checkAuthKey();

       

    }



    public function test()

    {

    	echo $this->validation;exit;

    }

}  

