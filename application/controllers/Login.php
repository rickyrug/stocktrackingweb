<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author rickyrug
 */
class Login extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('security/User_model', '', TRUE);
    }

    public function index() {
                $data = array('accion' => 'Login');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
          
        } else {
          
           $user = $this->input->post('username');
           $psw  = $this->input->post('password');
       //    $encpassdb = "8302302f643bd38450d8df45b9506e18dfda291d2b38b3ff4593ed537ca3cb6a2dc52664920a6bd943b59308f0d94cde10f27e13551dbab617f64dd1982b4d65WXRav8iOVthGCWKlifqSDlTrItf0OuXo6TjM711gV+c=";
       //    $encpass = $this->encryption->decrypt($encpassdb);
           
           if ($this->login($user, $psw)){
//               echo 'login auth';
                redirect('main/main_page', 'refresh');
           }
           
        }

        $this->load->view('index/login', $data);
    }

    private function login($p_username,$p_pass){
       $login = false;
        $user = $this->User_model->find_by_name($p_username);
       
       if(count($user) > 0){
           $decriptedpass = $this->encryption->decrypt($user[0]->password);
           
           if($p_pass === $decriptedpass){
               
               $newdata = array(
                    'username' => $user[0]->username,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($newdata);
               
               $login = true;
           }
           
       }
       
     return $login;
    }
    
}
