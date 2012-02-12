<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User
{

  public function __construct()
  {
    $CI =& get_instance();
    
    $CI->load->helper('user');
  }

}