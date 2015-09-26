<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aportacion
 *
 * @author rickyrug
 */
class Aportacion extends CI_Controller {
    
    public function index(){
        $this->load->model('Aportaciones_Model', '', TRUE);
        $results = $this->Aportaciones_Model->get_Aportaciones_Model();
        $data['results'] = $results;

        $this->load->helper(array('form', 'url', 'html'));
        $this->load->library('form_validation');
        $this->load->library('table');
        $this->call_views('aportaciones/list', $data);
    }
    
    public function add(){}
    
    private function call_views($p_view, $p_data = null){}
    
    public function delete($p_idaportacion){}
    
    public function edit(){}
    
    public function show_addform(){}
    public function show_editform(){}
}
