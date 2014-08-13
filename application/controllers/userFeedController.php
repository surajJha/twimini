<?php

class UserFeedController extends CI_Controller {
    public $status_code;

    public function __construct()
    {
       parent:: __construct();
       
       $this->load->library('status');
       $this->status_code = $this->status->get();
    }
    
    public function index(){
        //echo $this->getUserFeed('suraj','JSON',15,0);
    }
    
    public function getUserFeed($handle,$type,$count,$tid) {
        if (!isset($count)|| $count == 0 )$count = DEFAULT_COUNT;
        if (!isset($tid))$tid=0;
    
        if(!isset($handle)||$handle === false){
                   return $this->status_code['1'];   
        }
        
        else{
            $this->load->model('basemodel');
            $result = $this->basemodel->fetchUserFeed($handle,$count,$tid);
            $final_result=array(
                !isset($result)?$this->status_code['1']:$this->status_code['0']
                    ,$result);
            if($type == 'xml'){
               // xml encode here
            }
            else{
                return json_encode($final_result);
                //return json_encode($final_result, JSON_PRETTY_PRINT);
            }           
        }
    }
}
    