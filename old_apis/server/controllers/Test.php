<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Test extends CI_Controller
{
  public function __construct()
  {

  }

  public function index()
  {
  	 
  }

  protected function _detect_method()
  {
        // Declare a variable to store the method
        $method = NULL;
        $method = $this->input->post('_method');
        if ($method === NULL)
        {
            $method = $this->input->server('HTTP_X_HTTP_METHOD_OVERRIDE');
        }
        $method = strtolower($method);
        if (empty($method))
        {
            // Get the request method as a lowercase string
            $method = $this->input->method();
        }
        echo $method;
      //  return strtolower($method);
  }

}