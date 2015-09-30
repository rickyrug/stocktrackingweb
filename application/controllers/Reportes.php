<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportes
 *
 * @author rickyrug
 */
class Reportes extends CI_Controller{
   
    public function index() {
       
        $data['titlederecha']   = "Datos";
        $data['titleizquierda'] = "Grafica";

        $this->load->helper(array('form', 'url', 'html'));
        $this->load->library('form_validation');
        $this->load->library('table');
        $this->call_views('reportes/reporte',$data);
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
