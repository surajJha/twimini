<?php
//header('Content-Type: application/json');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserSearchController extends CI_Controller{
    
    public function searchUsers(){
        $input = $_POST['search_users'];
       
        $this->load->model('usersearch');
        $result = $this->usersearch->searchUsers($input);
        echo json_encode($result);
        
    }
    
    
    
}

