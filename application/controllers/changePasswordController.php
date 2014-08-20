<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ChangePasswordController extends CI_Controller {

    public function index($handle,$password) {
        $result=$this->db->query("select * from user where handle='$handle' and password='$password'");
        $result = $result->result_array();
        if($result){
            $this->load->view('changepassword');
        }
        else{
            // redirect to the home page if user tries to change someone
            //else's password through the url
            $this->load->view('home');
        }
        
    }
// not using model , directly updating the database
    // from the controller
    public function change() {
        $handle = $_POST['handle'];
        $new_password = $_POST['password'];
        $hashed_password = sha1($new_password);
        $this->db->where('handle', $handle);
        $this->db->update('password', $hashed_password);
        echo "success";
    }

}
