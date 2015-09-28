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
    
    public function index($p_portafolios){
        
        $this->load->model('Resultados_Model', '', TRUE);
        $results = $this->Resultados_Model->get_resultados_model($p_portafolios);
        $data['results'] = $results;

        $this->load->helper(array('form', 'url', 'html'));
        $this->load->library('form_validation');
        $this->load->library('table');
        $this->call_views('resultados/list', $data);
    }
    
    public function add(){
        
    }
    
    private function call_views($p_views, $p_data){
        
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
