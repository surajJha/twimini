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

    public function createTweet(){
        $handle=$_POST['handle'];
        $tweet=$_POST['tweet'];
        if(!isset($handle)||$handle === false){
            echo $this->status_code['1'];   
        }
        else if(!isset($tweet)|| strlen($tweet)<=0 || strlen($tweet)>140){
            echo $this->status_code['2'];
            
        }
        else{
            $this->load->model('basemodel');
            $res = $this->basemodel->createTweet($handle,$tweet);
            echo $res?  $this->status_code['1']:  $this->status_code['0'];
        }
    }
}
