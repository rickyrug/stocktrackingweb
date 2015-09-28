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
class Resultados extends CI_Controller {

    public function index() {

        $this->load->model('Resultados_Model', '', TRUE);
        $results = $this->Resultados_Model->get_resultados_model();
        $data['results'] = $results;
        $this->load->helper(array('form', 'url', 'html'));
        $this->load->library(array('form_validation', 'table'));
        $this->call_views('resultados/list', $data);
    }

    public function add() {

        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library(array('form_validation', 'table'));

        $this->form_validation->set_rules('portafolios', 'Portafolios', 'required');
        $this->form_validation->set_rules('fecha', 'Fecha', 'required');
        $this->form_validation->set_rules('valor', 'Valor', 'required');
        $this->form_validation->set_rules('profit', 'Profit', 'required');
        $this->form_validation->set_rules('rendimiento', 'Rendimiento', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['error'] = $this->form_validation->error_array();
            $data['accion'] = 'resultados/add';
            $data['labelfecha'] = 'Fecha: ';
            $data['fecha'] = array('name' => 'fecha', 'value' => $this->form_validation->set_value('fecha'));
            $data['labelportafolios'] = "Portafolios: ";
            $data['portafolios'] = $this->get_portafolios();
            $data['selectedPortafolios'] = $this->form_validation->set_value('portafolios');
            $data['labelvalor'] = 'Valor: ';
            $data['valor'] = array('name' => 'valor','id'=>'valor','value' => $this->form_validation->set_value('valor'));
            $data['labelprofit'] = 'Profit: ';
            $data['profit'] = array('name' => 'profit','value' => $this->form_validation->set_value('profit'));
            $data['labelrendimiento'] = 'Rendimiento: ';
            $data['rendimiento'] = array('name' => 'rendimiento','value' => $this->form_validation->set_value('rendimiento'));
            $data['btnguardar'] = array('guardar' => 'Guardar');

            $this->call_views('resultados/form', $data);
        } else {
            $p_fecha       = $_POST['fecha'];
            $p_portafolios = $_POST['portafolios'];
            $p_valor       = $_POST['valor'];
            $p_profit      = $_POST['profit'];
            $p_rendimiento = $_POST['rendimiento'];
            
            if($p_portafolios == 0){
                echo 'Portafolios field is required';
            }else{
                
            $this->load->model('Resultados_Model', '', TRUE);
            $this->Resultados_Model->insert_resultados($p_fecha,$p_portafolios,
                                                       $p_valor,$p_profit,$p_rendimiento);
            redirect('resultados','refresh');
            }
            
            
        }
    }

    private function call_views($p_view, $p_data) {
        $this->load->view('header');
        if ($p_data == null) {
            $this->load->view($p_view);
        } else {
            $this->load->view($p_view, $p_data);
        }

        $this->load->view('footer');
    }

    public function delete($p_idresultado) {
         $this->load->helper(array('url'));
         $this->load->model('Resultados_Model', '', TRUE);
         $this->Resultados_Model->delete_resultados_model($p_idresultado);
         redirect('resultados', 'refresh');
    }

    public function edit() {
        
    }

    private function get_portafolios() {
        $var_portafolios_list = array();
        $this->load->model('Portafolios_Model', '', TRUE);
        $results = $this->Portafolios_Model->get_Portafolios_Model_fields('idportafolios,nombre');
        $var_portafolios_list[] = "";
        foreach ($results as $portafolios) {
            $var_portafolios_list[$portafolios->idportafolios] = $portafolios->nombre;
        }

        return $var_portafolios_list;
    }

    public function show_addform() {
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library('form_validation');

        $time = now('America/Mexico_City');

        $data['accion'] = 'resultados/add';
        $data['labelfecha'] = 'Fecha: ';
        $data['fecha'] = array('name' => 'fecha', 'value' => unix_to_human($time, TRUE, 'EU'));
        $data['labelportafolios'] = "Portafolios: ";
        $data['portafolios'] = $this->get_portafolios();
        $data['labelvalor'] = 'Valor: ';
        $data['valor'] = array('name' => 'valor','id'=>'valor');
        $data['labelprofit'] = 'Profit: ';
        $data['profit'] = array('name' => 'profit','id'=>'profit');
        $data['labelrendimiento'] = 'Rendimiento: ';
        $data['rendimiento'] = array('name' => 'rendimiento','id'=>'rendimiento');
        $data['btnguardar'] = array('guardar' => 'Guardar');

        $this->call_views('resultados/form', $data);
    }

    public function show_editform($p_idresultado) {
        
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library('form_validation');
        $this->load->model('Resultados_Model', '', TRUE);
        $result = $this->Resultados_Model->find_by_id($p_idresultado);
        
        $data['accion'] = 'resultados/edit';
        $data['labelfecha'] = 'Fecha: ';
        $data['fecha'] = array('name' => 'fecha', 'value' => $result[0]->fecha);
        $data['labelportafolios'] = "Portafolios: ";
        $data['portafolios'] = $this->get_portafolios();
        $data['selectedPortafolios'] = $result[0]->idportafolios;
        $data['labelvalor'] = 'Valor: ';
        $data['valor'] = array('name' => 'valor','id'=>'valor','value'=>$result[0]->valor);
        $data['labelprofit'] = 'Profit: ';
        $data['profit'] = array('name' => 'profit','id'=>'profit','value'=>$result[0]->profit);
        $data['labelrendimiento'] = 'Rendimiento: ';
        $data['rendimiento'] = array('name' => 'rendimiento','id'=>'rendimiento','value'=>$result[0]->rendimiento);
        $data['btnguardar'] = array('guardar' => 'Guardar');

        $this->call_views('resultados/form', $data);
        
       
    }

}
