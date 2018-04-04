<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @author rickyrug
 */
class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->CheckSecurity();
    }

    public function CheckSecurity() {
        if (isset($this->session)) {
           // $usedata = $this->session->userdata();
           // $username = $this->session->userdata('name');
            $logged_in = $this->session->userdata('logged_in');

            if (!$logged_in) {
                redirect('Login', 'refresh');
            }
        } else {
            redirect('Login', 'refresh');
        }
    }

    public function call_views($p_view, $p_data = null) {

        $this->load->view('header',$this->getUserData());
        if ($p_data == null) {
            $this->load->view($p_view);
        } else {
            
            $this->parser->parse($p_view, $p_data);
        }

        $this->load->view('footer');
    }
    
    private function getUserData(){
        
        $p_data['username'] = $this->session->userdata('username');
        return $p_data;
    }

}
