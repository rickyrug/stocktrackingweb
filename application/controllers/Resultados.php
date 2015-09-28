<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Resultados
 *
 * @author rickyrug
 */
class Resultados extends CI_Controller{
    
    public function index(){
        
        $this->load->model('Resultados_Model', '', TRUE);
        $results = $this->Resultados_Model->get_resultados_model();
        $data['results'] = $results;

        $this->load->helper(array('form', 'url', 'html'));
        $this->load->library(array('form_validation','table'));
        
        $this->call_views('resultados/list', $data);
    }
    
    public function add(){
        
    }
    
    private function call_views($p_view, $p_data){
        $this->load->view('header');
        if ($p_data == null) {
            $this->load->view($p_view);
        } else {
            $this->load->view($p_view, $p_data);
        }

        $this->load->view('footer');
    }
    
    public function delete($p_idresultado){
        
    }
    
    public function edit(){
        
    }
    
    private function get_portafolios(){
        
    }
    
    public function show_addform(){
        
    }
    
    public function show_editform(){
        
    }
}
