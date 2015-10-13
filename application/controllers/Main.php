<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of Main
 *
 * @author 60044723
 */
class Main extends CI_Controller{
   
    public function index() {
        $this->load->helper(array('form', 'url', 'html'));
        $this->call_views('index/index');
    }
     
    private function call_views($p_view, $p_data = null) {
        $this->load->view('header');
        if ($p_data == null) {
            $this->load->view($p_view);
        } else {
            $this->load->view($p_view, $p_data);
        }

        $this->load->view('footer');
    }
}
