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
        $this->CI = & get_instance();
    }

    public function security_check() {        
        $this->check_user_data();
    }

    public function check_user_data() {
        if (!isset($this->CI->session)) {
            /* no ha cargado la libreria de session */
            
        } else {
            /* si ha cargado la libreria de session */
        }


        $newdata = array(
            'username' => 'johndoe',
            'email' => 'johndoe@some-site.com',
            'logged_in' => TRUE
        );
        $this->CI->session->set_userdata($newdata);
    }

}
