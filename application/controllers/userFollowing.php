<?php

class UserFollowing extends CI_Controller {
    public $status_code;

    public function __construct()
    {
       parent:: __construct();
       
       $this->load->library('status');
       $this->status_code = $this->status->get();
    }
    
    public function index(){
        echo $this->getFollowing('kirit','JSON');
    }
    
    public function getFollowing($handle, $type){
         if (!isset($handle) || $handle === false) {
            return $this->status_code['1'];
        } else {
            $this->load->model('basemodel');
            $result = $this->basemodel->fetchFollowing($handle);
            $final_result = array(
                !isset($result) ? $this->status_code['1'] : $this->status_code['0']
                , $result);
            if ($type == 'xml') {
                // xml encode here
            } else {
                return json_encode($final_result);
                //return json_encode($final_result, JSON_PRETTY_PRINT);
            }
        }
    }
}
