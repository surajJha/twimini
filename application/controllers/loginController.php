<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LoginController extends CI_Controller {

    function index() {
        $this->load->view('home');
    }

    /*
     * Function will take the input from the user and call the appropriate
     * model for further calidation and redirection
     */

    public function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashed_password = $this->hashPassword($password);
        $this->load->model('login');
        $user_exists = $this->login->loginValidate($email, $hashed_password);
           
        if ($user_exists) {
            // set all required session variables here and
            // redirect the user to his/her home page
            $this->load->model('basemodel');
            // fetching the user data from the model to set in session
            // passing email id as param to fetch the user data
            $user_data = $this->basemodel->getUserData($email);
         
            if ($user_data) {
                $this->session->set_userdata('userid', $user_data['userid']);
                $this->session->set_userdata('handle', $user_data['handle']);
                $this->session->set_userdata('email', $user_data['email']);
                $this->session->set_userdata('name', $user_data['name']);
                $this->session->set_userdata('bio', $user_data['bio']);
                $this->load->helper('url');
                redirect('index.php/userHomeController');
            } else {
                echo "databse error";
            }
        } else {
            $error_message['error'] = " username/password is incorrect";
            $this->load->view('home', $error_message);
        }
    }

    public function hashPassword($raw_password) {
        // using SHA1 ENCRYPTION to encrypt the password
        // encryption method can be changed anytime
        $hash = sha1($raw_password);
        return $hash;
    }
    
    
    public function register(){
        $handle =  $_POST['handle'] ;
        $password = $this->hashPassword($_POST['password']);
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $bio = $_POST['bio'];
        $name = $_POST['name'];        
        
        $data = array(
            "handle" => $handle,
            "password"  => $password,
            "email" => $email,
            "name"  => $gender,
            "gender" => $bio,
            "bio"  => $name
        );
        $this->load->model('login');
        $res = $this->login->register($data);
        echo $res;       
        
    }

}
