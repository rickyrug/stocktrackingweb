<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author 60044723
 */
class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
        $data = array(
            'user_list'=> array( 
                array('id_usuario'=>1, 'username'  =>'rickyrug','active'    =>'1')
          )
            );
        
        $this->call_views('configuracion/users/index',$data);
    }

    public function show_addform() {
        
    }

    private function call_views($p_view, $p_data = null) {
        $this->load->view('header');
        if ($p_data == null) {
            $this->load->view($p_view);
        } else {
            $this->parser->parse($p_view, $p_data);
        }

          $this->load->view('footer');
    }

}
