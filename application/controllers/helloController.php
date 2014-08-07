<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class HelloController extends CI_Controller{
    
    function index(){
        $this->load->view('welcome_message');
    }
    
    
    
}

