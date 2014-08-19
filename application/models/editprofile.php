<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EditProfile extends CI_Model {

    public function updateProfile($handle, $user_data) {
        $this->db->where('handle', $handle);
        $this->db->update('user', $user_data);
        $this->session->set_userdata('name', $user_data['name']);
        $this->session->set_userdata('bio', $user_data['bio']);
        $this->session->set_userdata('gender', $user_data['gender']);
        return 'success';
    }

}
