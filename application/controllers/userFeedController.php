<?php

class UserFeedController extends CI_Controller {

    public $status_code;

    public function __construct() {
        parent:: __construct();

        $this->load->library('status');
        $this->status_code = $this->status->get();
    }

    public function index() {
        echo $this->getUserFeed('suraj', 15, 0);
    }

    public function getUserFeed() {
        $handle = $_POST['handle'];
        $count = $_POST['count'];
        $tid = $_POST['tid'];
        if (!isset($count) || $count == 0)
            $count = DEFAULT_COUNT;
        if (!isset($tid))
            $tid = 0;

        if (!isset($handle) || $handle === false) {
            return $this->status_code['1'];
        } else {
            $this->load->model('basemodel');
            $result = $this->basemodel->fetchUserFeed($handle, $count, $tid);
            $final_result = array(
                !isset($result) ? $this->status_code['1'] : $this->status_code['0']
                , $result);

            echo json_encode($final_result);
//return json_encode($final_result, JSON_PRETTY_PRINT);
        }
    }

    public function retweet() {
        $handle = $_POST['handle'];
        $tid = $_POST['tid'];

        if (!isset($handle) || $handle === false) {
            echo $this->status_code['1'];
        } else {
            $this->load->model('basemodel');
            $res = $this->basemodel->retweet($handle, $tid);
            echo $res ? $this->status_code['1'] : $this->status_code['0'];
        }
    }

}
