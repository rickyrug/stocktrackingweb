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
      // $this->load->model('security/User_model', '', TRUE);
    }

    public function security_check() {
        if (isset($this->CI->session)) 
            {
                $usedata = $this->CI->session->userdata();
                $username = $this->CI->session->userdata('name');
                $logged_in = $this->CI->session->userdata('logged_in');

                if (!$logged_in) {
                  //  $this->CI->load->view('header');
                    $this->CI->load->view('index/login');
                 //   $this->CI->load->view('footer');
                }
            }
            else
            {
                    //$this->CI->load->view('header');
                    $this->CI->load->view('index/login');
                    //$this->load->view('footer');
            }
    }

    public function check_user_data() {
        security_check() ;
//        if (isset($this->CI->session)) {
//            $usedata = $this->CI->session->userdata();
//            if ($usedata == NULL) {
//                
//            } else {
//                $username = $this->CI->session->userdata('name');
//                $logged_in = $this->CI->session->userdata('logged_in');
//
//                if (!$logged_in) {
//                   //$this->loadLoginForm();
//                    redirect('main/notLoggedIn');
//                }
//            }
//        } else {
//
//            $uri = uri_string();
//            echo $uri;
//
//            if (!$uri === "" || !$uri === 'main') {
//                redirect('main/notLoggedIn', 'refresh');
//            }
//
//            // redirect('main');
//        }
    }


}
