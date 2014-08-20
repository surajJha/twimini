<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserProfileController extends CI_Controller {

    public function index() {
        $this->load->view('user_profile');
    }

// php function to update the user profile 
// data is coming through the ajax call made
// by pressing the save changes button

    public function updateProfile() {
        $name = $_POST['name'];
        $handle = $_POST['handle'];
        $password = $_POST['passwordinput'];

        $gender = $_POST['gender'];
        $bio = $_POST['bio'];

        $user_data = array('name' => $name, 'gender' => $gender, 'bio' => $bio);
        if (!empty($password))
            $user_data['password'] = sha1($password);
        $this->load->model('editprofile');
        $updated = $this->editprofile->updateProfile($handle, $user_data);
       
        echo $updated; 
         
    }

    public function uploadPic() {
        $this->config = array(
            'upload_path' => "/home/suraj/NetBeansProjects/twimini/profilepics/",
            'upload_url' => base_url() . "files/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|xml",
            'overwrite' => TRUE,
            'max_size' => "1000KB",
            'max_height' => "768",
            'max_width' => "1024"
        );

        $this->load->library('upload', $this->config);
        if($this->upload->do_upload()){
            echo "success";
        }
        else{
            echo $this->data['error'] = $this->upload->display_errors();
        }
        
        
    }

}
