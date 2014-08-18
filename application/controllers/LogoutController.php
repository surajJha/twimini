<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LogoutController extends CI_Controller{
    public function index(){
        $this->session->sess_destroy();
        redirect('index.php/homeController');
    }
}