<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Status
{
    public $status_code = array(
       
       "0" => "success",
       "1" => "Invalid Handle",
       "2" => "Invalid Tweet Length",
    );
    
    public function get()
    {
        return $this->status_code;
    }
}