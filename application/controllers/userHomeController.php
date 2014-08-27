<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserHomeController extends CI_Controller {

    public function index() {
        if ($this->session->userdata('userid'))
            $this->load->view('user_home');
        else
            $this->load->view('home');
    }

    public function user($handle) {
        // $current_handle = $this->session->userdata('handle');
        // $data = array($handle);
        $user=$this->session->userdata('userid');
        $sql = "select * from user where handle = '{$handle}'";
        $query = $this->db->query($sql);
        $user_info['user_info'] = $query->result_array();
        // print_r($user_info['user_info'][0]['userid']);
        $userid = $user_info['user_info'][0]['userid'];

        
        // get tweet count 
        $sql = "select count(*) as tweet_count from tweet where userid = '{$userid}'";
        $query = $this->db->query($sql);
        $user_info['tweet'] = $query->result_array();
        // no of followers
        $sql = "SELECT count(follower) as follower_count FROM follow WHERE followed = '{$userid}' and end_time = '0000-00-00 00:00:00';";
        $query = $this->db->query($sql);
        $user_info['follower_count'] = $query->result_array();
        // no of peoplse being followed
        $sql = "select count(followed) as following_count from follow where follower = '{$userid}' and end_time = '0000-00-00 00:00:00';";
        $query = $this->db->query($sql);
        $user_info['following_count'] = $query->result_array();
        $sql = "select * from follow where follower = '{$user}' and followed='{$userid}' and end_time = '0000-00-00 00:00:00';";
        $query = $this->db->query($sql);
        $user_info['follows'] = ($query->num_rows() > 0)?true:false;
        
        if ($handle === $this->session->userdata('handle'))
            $this->load->view('user_home');
        else
            $this->load->view('visit_home', $user_info);

    }

}
