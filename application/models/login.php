<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// validate the user input for login
// return true if valid user else return false
class Login extends CI_Model{
  
    
    public function loginValidate($email,$hashed_password){
       $email = $this->db->escape($email);
       $hashed_password = $this->db->escape($hashed_password);
        $sql = "select userid from user where email = {$email} and password = {$hashed_password}";
        $query = $this->db->query($sql);
        
            return $query->result();
  
    }  
    
    public function register($data){
        
        $this->db->insert('user',$data);
        return "success";
       // return "";
           
    }
}


