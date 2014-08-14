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

class basemodel extends CI_Model {

    public function createTweet($handle, $tweet) {
        $sql = "select userid from user where handle='{$handle}'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            $id = $row[0]->userid;
            $this->db->insert('tweet', array("userid" => $id, "tweet" => $tweet));
            return '0';
        } else {
            return '1';
        }

        //$this->db->query then ->result() returns array of object. Each object is one row. 
    }

    public function fetchTweets($handle, $count, $tid) {
        $handle = $this->db->escape($handle);

        $sql = "select userid from user where handle={$handle}";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            $id = $row[0]->userid;

            $sql = "select tid, handle, tweet, t.time_created from tweet t inner join user u on t.userid = u.userid where (t.userid={$id} or tid in (select tid from retweet where user_id={$id})) " . (($tid == 0) ? "" : "and tid < $tid ") . " order by tid DESC limit $count";
            $query = $this->db->query($sql);
            $result = $query->result_array();
            return !empty($result) ? $result : array();
        } else
            return NULL;
        //$this->db->query then ->result() returns array of object. Each object is one row. 
    }

    public function fetchFollowers($handle) {
        $handle = $this->db->escape($handle);

        $sql = "select userid from user where handle={$handle}";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            $id = $row[0]->userid;

            $sql = "select userid, handle, name, bio from user where userid in (select follower from follow where followed = $id and end_time = '0000-00-00 00:00:00')";
            $query = $this->db->query($sql);
            $result = $query->result_array();
            return !empty($result) ? $result : array();
        } else
            return NULL;
        //$this->db->query then ->result() returns array of object. Each object is one row. 
    }

    public function fetchFollowing($handle) {
        $handle = $this->db->escape($handle);

        $sql = "select userid from user where handle={$handle}";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            $id = $row[0]->userid;

            $sql = "select userid, handle, name, bio from user where userid in (select followed from follow where follower = $id and end_time = '0000-00-00 00:00:00')";
            $query = $this->db->query($sql);
            $result = $query->result_array();
            return !empty($result) ? $result : array();
        } else
            return NULL;
        //$this->db->query then ->result() returns array of object. Each object is one row. 
    }

    public function fetchUserFeed($handle, $count, $tid) {
        $handle = $this->db->escape($handle);

        $sql = "select userid from user where handle={$handle}";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            $id = $row[0]->userid;

            $sql = "select * from 
                    (select t.tid,t.userid,handle,'' as retweeter_id,tweet, t.time_created from tweet t inner join follow f on (f.followed=t.userid and time_created>start_time and (end_time='0000-00-00 00:00:00' or time_created < end_time)) inner join user u on u.userid=t.userid where follower= $id
                    UNION 
                    select tid, t.userid,handle,'' as retweeter_id, tweet, t.time_created from tweet t inner join user u on u.userid=t.userid where t.userid={$id}
                    UNION
                    select t.tid,t.userid,handle,user_id as retweeter_id,tweet, time_retweeted from tweet t inner join retweet r on r.tid=t.tid inner join user u on u.userid=t.userid where user_id={$id}
                    UNION
                    select t.tid,t.userid,handle,user_id as retweeter_id,tweet, time_retweeted from tweet t inner join retweet r on r.tid=t.tid inner join follow f on (r.user_id=f.followed and time_retweeted > start_time and (end_time='0000-00-00 00:00:00' or time_retweeted < end_time)) inner join user u on u.userid=t.userid where follower= $id) as P " .
                    (($tid == 0) ? "" : "where tid < $tid ")
                    . "order by tid DESC
                    limit $count";
            //echo $sql;
            $query = $this->db->query($sql);
            $result = $query->result_array();
            return !empty($result) ? $result : array();
        } else
            return NULL;
        //$this->db->query then ->result() returns array of object. Each object is one row. 
    }

    /*
     *  Funtion to fetch and return the user data
     */

    public function getUserData($email) {
        $email = $this->db->escape($email);
        $sql = "select * from user where email = {$email}";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            $user_data['userid'] = $row[0]->userid;
            $user_data['handle'] = $row[0]->handle;
            $user_data['email'] = $row[0]->email;
            $user_data['name'] = $row[0]->name;
            $user_data['bio'] = $row[0]->bio;
            return $user_data;
        } else
            return false;
    }

}
