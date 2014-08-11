<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



/*
 *  This file contains most CRUD functions
 * 
 */

class basemodel extends CI_Model{
    
    public function createTweet($handle,$tweet){
        $handle = $this->db->escape($handle);
        $tweet = $this->db->escape($tweet);
        $sql = "select userid from user where handle={$handle}";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            $id=$row[0]->userid;
            $this->db->insert('tweet',array("userid"=>$id,"tweet"=>$tweet));
            return '0';
        } else {
            return '1';
        }
        
        //$this->db->query then ->result() returns array of object. Each object is one row. 
    }
    
    public function fetchTweets($handle,$count){
        $handle = $this->db->escape($handle);
        
        $sql = "select userid from user where handle={$handle}";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            $id=$row[0]->userid;
            
            $sql = "select tid, handle, tweet, t.time_created from tweet t inner join user u on t.userid = u.userid where t.userid={$id} or tid in (select tid from retweet where user_id={$id}) order by tid DESC limit $count";
            $query = $this->db->query($sql);
            $result=$query->result();
            return !empty($result)?$result:array();
        }
        else return NULL;
        //$this->db->query then ->result() returns array of object. Each object is one row. 
    }
    
     public function fetchFollowers($handle){
        $handle = $this->db->escape($handle);
        
        $sql = "select userid from user where handle={$handle}";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            $id=$row[0]->userid;
            
            $sql = "select userid, handle, name, bio from user where userid in (select follower from follow where followed = $id and end_time = '0000-00-00 00:00:00')";
            $query = $this->db->query($sql);
            $result=$query->result();
            return !empty($result)?$result:array();
        }
        else return NULL;
        //$this->db->query then ->result() returns array of object. Each object is one row. 
    }
    
    
    
    public function fetchFollowing($handle){
        $handle = $this->db->escape($handle);
        
        $sql = "select userid from user where handle={$handle}";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            $id=$row[0]->userid;
            
            $sql = "select userid, handle, name, bio from user where userid in (select followed from follow where follower = $id and end_time = '0000-00-00 00:00:00')";
            $query = $this->db->query($sql);
            $result=$query->result();
            return !empty($result)?$result:array();
        }
        else return NULL;
        //$this->db->query then ->result() returns array of object. Each object is one row. 
    }
    
    
    public function fetchUserFeed($handle, $count){
        $handle = $this->db->escape($handle);
        
        $sql = "select userid from user where handle={$handle}";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            $id=$row[0]->userid;
            
            $sql = "select tid, handle, tweet, t.time_created from tweet t inner join user u on t.userid = u.userid where t.userid={$id} or tid in (select tid from retweet where user_id={$id}) order by tid DESC limit $count";
            $query = $this->db->query($sql);
            $result=$query->result();
            return !empty($result)?$result:array();
        }
        else return NULL;
        //$this->db->query then ->result() returns array of object. Each object is one row. 
    }
    
    
}

