<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class FormValidationController extends CI_Controller{
    public function checkHandle(){
        $handle = $_POST['handle'];
        $sql = "select handle from user where handle = '{$handle}'";
         $query = $this->db->query($sql);
         if($query->result()){
             echo "success";
         }
         else{
             echo "failure";
         }
    }
    public function checkEmail(){;
        $email = $_POST['email'];
        $sql = "select email from user where email = '{$email}'";
         $query = $this->db->query($sql);
         if($query->result()){
             echo "success";
         }
         else{
             echo "failure";
         }
    }
}

