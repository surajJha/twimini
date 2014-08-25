<?php

class UserFollow extends CI_Controller {
    public $status_code;

    public function __construct()
    {
       parent:: __construct();
       
       $this->load->library('status');
       $this->status_code = $this->status->get();
    }
    
    public function index(){
        echo $this->getFollowers('kirit');
    }
    
    public function getFollowers(){
        $handle=$_POST['handle'];
        if (!isset($handle) || $handle === false) {
            return $this->status_code['1'];
        } else {
            $this->load->model('basemodel');
            $result = $this->basemodel->fetchFollowers($handle);
            $final_result = array(
                !isset($result) ? $this->status_code['1'] : $this->status_code['0']
                , $result);
            
                echo json_encode($final_result);
                //return json_encode($final_result, JSON_PRETTY_PRINT);
        }
    }
    
    public function getFollowing(){
        $handle=$_POST['handle'];
         if (!isset($handle) || $handle === false) {
            return $this->status_code['1'];
        } else {
            $this->load->model('basemodel');
            $result = $this->basemodel->fetchFollowing($handle);
            $final_result = array(
                !isset($result) ? $this->status_code['1'] : $this->status_code['0']
                , $result);
            
                echo json_encode($final_result);
                //return json_encode($final_result, JSON_PRETTY_PRINT);
        }
    }
    
    public function Follow(){
        $handle=$_POST['handle'];
        $to_follow=$_POST['follow'];
         if (!isset($handle) || $handle === false) {
            return $this->status_code['1'];
        } else {
            $this->load->model('basemodel');
            if($this->basemodel->follow($handle,$to_follow))echo "success";
        }
    }
    
    public function Unfollow(){
        $handle=$_POST['handle'];
        $to_unfollow=$_POST['follow'];
         if (!isset($handle) || $handle === false) {
            return $this->status_code['1'];
        } else {
            $this->load->model('basemodel');
            if($this->basemodel->unfollow($handle,$to_unfollow))echo "success";
        }
    }
}
