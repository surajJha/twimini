<?php

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
    
    public function retweet($handle, $tid) {
        $sql = "select userid from user where handle='{$handle}'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            $id = $row[0]->userid;
            $this->db->insert('retweet', array("user_id" => $id, "tid" => $tid));
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

            $sql = "select tid, name, handle, tweet, t.time_created, profile_pic from tweet t inner join user u on t.userid = u.userid where (t.userid={$id} or tid in (select tid from retweet where user_id={$id})) " . (($tid == 0) ? "" : "and tid < $tid ") . " order by tid DESC limit $count";
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

            $sql = "select * from (select userid, handle, name, bio, profile_pic from user u inner join follow f on f.follower=u.userid where followed = $id and end_time = '0000-00-00 00:00:00' order by start_time DESC) as main
                    left join (select followed, 'true' as status
                    from follow where follower=$id) as userf
                    on main.userid=userf.followed;";
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

            $sql = "select userid, handle, name, bio, profile_pic from user u inner join follow f on f.followed=u.userid where follower = $id and end_time = '0000-00-00 00:00:00' order by start_time DESC";
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

            $sql = "select tid,userid,handle,name,retweeter_id,retweeter_handle,tweet,min(time_created) as time_created, profile_pic from 
                    (select t.tid,t.userid,handle,name,'' as retweeter_id,'' as retweeter_handle,tweet, t.time_created, profile_pic from tweet t inner join follow f on (f.followed=t.userid and time_created>start_time and (end_time='0000-00-00 00:00:00' or time_created < end_time)) inner join user u on u.userid=t.userid where follower= $id
                    UNION 
                    select tid, t.userid,handle,name,'' as retweeter_id,'' as retweeter_handle, tweet, t.time_created, profile_pic from tweet t inner join user u on u.userid=t.userid where t.userid={$id}
                    UNION
                    select t.tid,t.userid,u.handle,u.name,user_id as retweeter_id,u1.handle as retweeter_handle,tweet, time_retweeted, u.profile_pic from tweet t inner join retweet r on r.tid=t.tid inner join user u on u.userid=t.userid inner join user u1 on u1.userid=r.user_id where user_id={$id}
                    UNION
                    select t.tid,t.userid,u.handle,u.name,user_id as retweeter_id,u1.handle as retweeter_handle,tweet, time_retweeted, u.profile_pic from tweet t inner join retweet r on r.tid=t.tid inner join follow f on (r.user_id=f.followed and time_retweeted > start_time and (end_time='0000-00-00 00:00:00' or time_retweeted < end_time)) inner join user u on u.userid=t.userid inner join user u1 on u1.userid=r.user_id where follower= $id) as P " .
                    (($tid == 0) ? "" : "where tid < $tid ")
                    . "group by tid order by tid DESC
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
            $user_data['gender'] = $row[0]->gender;
            return $user_data;
        } else
            return false;
    }

}
