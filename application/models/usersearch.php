<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserSearch extends CI_Model{
    
    
    public function searchUsers($input){
        
        $sql = " select name,handle,userid from user where name like '{$input}%' ";
        $query = $this->db->query($sql);
        $x = array();
        //if ($query->num_rows() > 0) {
            $x =  $query->result_array();
            return $x;
        //}
        //else{
            
        //}
       
    }
}

