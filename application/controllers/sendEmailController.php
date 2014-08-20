<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SendEmailController extends CI_Controller {

    public function sendEmail() {
        $email=$_POST['email'];
        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user'] = 'hexagraph69@gmail.com';
        $config['smtp_pass'] = 'shaktiman';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'text'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not      

        $this->email->initialize($config);

        $this->email->from('hexagraph69@gmail.com.com', 'WebMaster Twimini');
        $this->email->to($email);
        // $this->email->cc('another@another-example.com');
        // $this->email->bcc('them@their-example.com');
        $sql = " select handle,name,password from user where email = '$email'";
        $query = $this->db->query($sql);
        $user_exists = $query->result_array();
        if ($user_exists) {
            $user_exists = $user_exists[0];
            $name = $user_exists['name'];            
            // email exists in the database i.e. a valid user
            // then send the email with a link to the ne
            $url = base_url() . "index.php/changePasswordController/index/{$user_exists['handle']}/{$user_exists['password']}";
            $email_body = "Hey {$name}, "
                    . "It seems that you have forgotten your password."
                    . "Please click this link {$url} "
                    . "to go to a new page and change your new password"
                    . "Please ignore this mail if you do not want to change your password"
                    . "Thank you With best Regards - Twimini team";
            $this->email->subject('Request for password change');
            $this->email->message($email_body);
            // sending the email finally
            $this->email->send();
            //uncomment this for getting debugging messages for email
           // echo $this->email->print_debugger();
            
            
            
            // return the success message to the ajax function
            echo "success";
        } else {
            echo 'failure';
        }
    }

}
