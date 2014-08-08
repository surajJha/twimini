<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Helloctrl extends CI_Controller{
   function index(){
       $this->showQuery();
   }
   
   function showQuery(){
       $this->load->model('temp_database');
       $res = $this->temp_database->getAll();
       print_r($res);
   }
}