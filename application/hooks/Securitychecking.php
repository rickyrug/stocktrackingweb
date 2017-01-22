<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Security
 *
 * @author 60044723
 */
class Securitychecking {

    public function __construct() {
        
    }

    public function security_check() {
        $this->check_user_data();
    }

    public function check_user_data() {
        if (isset($this->session)) {
             $usedata = $this->session->has_userdata();
             if($usedata){
                  $username =$this->session->userdata('name');
                  $logged_in = $this->session->userdata('logged_in'); 
                  
                  if(!$logged_in){
                      redirect('main', 'refresh');
                  }
                  
             }else{
                 redirect('main', 'refresh');
             }
        } else {
            
            $uri = uri_string();
            echo $uri;
            
            if(!$uri === "" || !$uri === 'main'){
                redirect('main', 'refresh');
            }
            
            // redirect('main');
        }
       
//        $newdata = array(
//            'username' => 'johndoe',
//            'email' => 'johndoe@some-site.com',
//            'logged_in' => TRUE
//        );
//        $this->CI->session->set_userdata($newdata);
    }

}
