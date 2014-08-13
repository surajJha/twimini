<?php

class CreateTweet extends CI_Controller {
    public $status_code;

    public function __construct()
    {
       parent:: __construct();
       
       $this->load->library('status');
       $this->status_code = $this->status->get();
    }
    
    public function index(){
        echo $this->createTweet('uMANG','Umang Tweet 2');
    }

    public function createTweet($handle,$tweet){
        if(!isset($handle)||$handle === false){
                   return $this->status_code['1'];   
        }
        else if(!isset($tweet)|| strlen($tweet)<=0 || strlen($tweet)>140){
            return $this->status_code['2'];
            
        }
        else{
            $this->load->model('basemodel');
            $res = $this->basemodel->createTweet($handle,$tweet);
            return $res?  $this->status_code['1']:  $this->status_code['0'];
        }
    }
}
