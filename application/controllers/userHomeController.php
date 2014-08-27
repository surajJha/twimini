<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserHomeController extends CI_Controller{
    public function index(){
       if($this->session->userdata('userid'))
        $this->load->view('user_home');
       else $this->load->view('home');
    }
    
    public function userSearch($handle){
       // $current_handle = $this->session->userdata('handle');
        $data = array($handle);
        $this->load->view('user_home',$data);
    }
}

