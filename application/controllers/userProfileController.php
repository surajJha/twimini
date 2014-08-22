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
        //print_r($_FILES['userfile']['name']);
        //echo "    ";
        //print_r($_POST);
        $name = $_POST['name'];
        $handle = $_POST['handle'];
        $password = $_POST['passwordinput'];

        $gender = $_POST['gender'];
        $bio = $_POST['bio'];

        $user_data = array('name' => $name, 'gender' => $gender, 'bio' => $bio);

        if (!empty($_FILES['userfile']['name'])) {
            $raw_name = explode('.', $_FILES['userfile']['name']);
            $extension = $raw_name[1];
            $user_data['profile_pic'] = $this->uploadPic($handle . '.' . $extension);
        }
        if (!empty($password))
            $user_data['password'] = sha1($password);
        $this->load->model('editprofile');
        $updated = $this->editprofile->updateProfile($handle, $user_data);

        echo $updated;
        
    }

    public function uploadPic($name) {

        $config = array(
            'upload_path' => (PHP_OS == 'Linux') ? "/home/suraj/NetBeansProjects/twimini/profilepics/" : "C:/wamp/www/twimini/profilepics/",
            'upload_url' => base_url() . "files/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf|doc|xml",
            'overwrite' => TRUE,
            'max_size' => "1000KB",
            'max_height' => "768",
            'max_width' => "1024",
            'file_name' => $name
        );

        $this->load->library('upload', $config);
        if ($this->upload->do_upload()) {

            return $name;
        } else {
            
        }
    }

}
