<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/*
 * this api controller wil contain most of the api functions and modules
 * 
 */
class MainApiController extends CI_Controller {

    public $status_code;

    public function __construct() {
        parent:: __construct();
        define('DEFAULT_COUNT', 10);
        $this->load->library('status');
        $this->status_code = $this->status->get();
    }

    /*
     * 
     * CREATE POST
     * Description: Creates post on behalf of a particular user. 
     * It will accept a user handle, from which the user_id will be fetched from the database;
     *  alongwith the tweet to be stored and return a success status code. 
     * If post submission is unsuccesful it will return the appropriate error 
     * status code Status codes will be included in the API docs.
     */

    public function index() {
        //echo str_replace('&gt;','&gt;<br>',htmlspecialchars($this->fetchFollowing('kirit', 'XML', 50, 0)));
    }

    public function createTweet($handle, $tweet) {
        if (!isset($handle) || $handle === false) {
            return $this->status_code['1'];
        } else if (!isset($tweet) || strlen($tweet) <= 0 || strlen($tweet) > 140) {
            return $this->status_code['2'];
        } else {
            $this->load->model('basemodel');
            $res = $this->basemodel->createTweet($handle, $tweet);
            return $res ? $this->status_code['1'] : $this->status_code['0'];
        }
    }

    /* FETCH USER'S TWEETS
     * Description: Fetches a particular user's posts from the database sorted by 
     * time in the desired result form (JSON or XML).
     */

    public function fetchTweets($handle, $type, $count, $tid) {
        if (!isset($count) || $count == 0)
            $count = DEFAULT_COUNT;
        if (!isset($tid))
            $tid = 0;

        if (!isset($handle) || $handle === false) {
            return $this->status_code['1'];
        } else {
            $this->load->model('basemodel');
            $result = $this->basemodel->fetchTweets($handle, $count, $tid);
            $final_result = array("status_code" => 
                !isset($result) ? $this->status_code['1'] : $this->status_code['0']
                , "resultset" => $result);
            if ($type == 'XML') {
               return $this->array2xml($final_result);
            } else {
                return json_encode($final_result);
                //return json_encode($final_result, JSON_PRETTY_PRINT);
            }
        }
    }

    /*
     * Fetching followers
     *  Description: Fetches the followers of a particular user.
     */

    public function fetchFollowers($handle, $type) {
        if (!isset($handle) || $handle === false) {
            return $this->status_code['1'];
        } else {
            $this->load->model('basemodel');
            $result = $this->basemodel->fetchFollowers($handle);
            $final_result = array("status_code" => 
                !isset($result) ? $this->status_code['1'] : $this->status_code['0']
                , "resultset" => $result);
            if ($type == 'XML') {
               return $this->array2xml($final_result);
            } else {
                return json_encode($final_result);
                //return json_encode($final_result, JSON_PRETTY_PRINT);
            }
        }
    }

    /*
     *  Fetching following
     *  Description: Fetches the list of users a particular user follows.
     */

    public function fetchFollowing($handle, $type) {
        if (!isset($handle) || $handle === false) {
            return $this->status_code['1'];
        } else {
            $this->load->model('basemodel');
            $result = $this->basemodel->fetchFollowing($handle);
            $final_result = array("status_code" => 
                !isset($result) ? $this->status_code['1'] : $this->status_code['0']
                , "resultset" => $result);
            if ($type == 'XML') {
               return $this->array2xml($final_result);
            } else {
                return json_encode($final_result);
                //return json_encode($final_result, JSON_PRETTY_PRINT);
            }
        }
    }

    /*
     *  Fetch users news feed
     *  Description: Fetches the posts of every user followed by a particular user and the posts of the user sorted by time in the desired result form (JSON or XML).
     */

    public function fetchUserFeed($handle, $type, $count, $tid) {
        if (!isset($count) || $count == 0)
            $count = DEFAULT_COUNT;
        if (!isset($tid))
            $tid = 0;

        if (!isset($handle) || $handle === false) {
            return $this->status_code['1'];
        } else {
            $this->load->model('basemodel');
            $result = $this->basemodel->fetchUserFeed($handle, $count, $tid);
            $final_result = array("status_code" => !isset($result) ? $this->status_code['1'] : $this->status_code['0']
                                , "resultset" => $result);
            if ($type == 'XML') {
               return $this->array2xml($final_result);
            } else {
                return json_encode($final_result);
                //return json_encode($final_result, JSON_PRETTY_PRINT);
            }
        }
    }
    
    //Converts array into xml string
    function array2xml($array, $xml = false) {
        if ($xml === false) {
            $xml = new SimpleXMLElement('<root/>');
        }
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->array2xml($value, $xml->addChild($key));
            } else {
                //print_r($value);
                $xml->addChild($key, $value);
            }
        }
        return $xml->saveXML();
    }

}
