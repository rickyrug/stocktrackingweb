<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aportacion
 *
 * @author Ricardo Rugerio
 */
class Aportacion extends CI_Controller {

    public function index() {
        $this->load->model('Operaciones_Model', '', TRUE);
        $results = $this->Operaciones_Model->get_Operaciones_Model('AP');
        $data['results'] = $results;

        $this->load->helper(array('form', 'url', 'html'));
        $this->load->library('form_validation');
        $this->load->library('table');
        $this->call_views('aportaciones/list', $data);
    }

    public function add() {
        
        $this->load->helper(array('form', 'url', 'date','html'));
        $this->load->library('form_validation');
        $this->load->library('calendar');

        $this->form_validation->set_rules('portafolios', 'Portafolios', 'required');
        $this->form_validation->set_rules('fecha', 'Fecha', 'required');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['error'] = $this->form_validation->error_array();
            $data['accion'] = 'aportacion/add';
            $data['labelcantidad'] = 'Cantidad: ';
            $data['cantidad'] = array('name' => 'cantidad', 'value' => $this->form_validation->set_value('cantidad'));
            $data['labelfecha'] = 'Fecha: ';
            $data['fecha'] = array('name' => 'fecha', 'value' => $this->form_validation->set_value('fecha'));
            $data['labelportafolios'] = "Portafolios: ";
            $data['portafolios'] = $this->get_portafolios();
            $data['selectedPortafolios'] = $this->form_validation->set_value('portafolios');
            $data['btnguardar'] = array('guardar' => 'Guardar');

            $this->call_views('aportaciones/form', $data);
        } else {

            $p_fecha         = $_POST['fecha'];
            $p_cantidad      = $_POST['cantidad'];
            $p_portafolios   = $_POST['portafolios'];
            
            if($p_portafolios === 0){
                
            }else{
            
            $this->load->model('Operaciones_Model', '', TRUE);
            $this->Operaciones_Model->insert_Operaciones_Model($p_cantidad,$p_fecha, $p_portafolios, 
                                                               'AP');

            }
            
            
            redirect('aportacion', 'refresh');
        }
        
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

    public function delete($p_idaportacion) {
        $this->load->helper(array('url'));
        $this->load->model('Operaciones_Model', '', TRUE);
        $this->Operaciones_Model->delete_Operaciones_Model($p_idaportacion);
        redirect('aportacion', 'refresh');
    }

    public function edit() {
        
        $this->load->helper(array('form', 'url', 'date','html'));
        $this->load->library('form_validation');
        $this->load->library('calendar');

        $this->form_validation->set_rules('portafolios', 'Portafolios', 'required');
        $this->form_validation->set_rules('fecha', 'Fecha', 'required');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'required');
        $this->form_validation->set_rules('idoperacion', 'ID operacion', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['error'] = $this->form_validation->error_array();
            $data['accion'] = 'aportacion/edit';
            $data['labelcantidad'] = 'Cantidad: ';
            $data['idoperacion'] = array('idoperacion'=>$this->form_validation->set_value('idoperacion'));
            $data['cantidad'] = array('name' => 'cantidad', 'value' => $this->form_validation->set_value('cantidad'));
            $data['labelfecha'] = 'Fecha: ';
            $data['fecha'] = array('name' => 'fecha', 'value' => $this->form_validation->set_value('fecha'));
            $data['labelportafolios'] = "Portafolios: ";
            $data['portafolios'] = $this->get_portafolios();
            $data['selectedPortafolios'] = $this->form_validation->set_value('portafolios');
            $data['btnguardar'] = array('guardar' => 'Guardar');

            $this->call_views('aportaciones/form', $data);
        } else {
            
           $p_fecha         = $_POST['fecha'];
           $p_cantidad      = $_POST['cantidad'];
           $p_portafolios   = $_POST['portafolios'];
           $p_idoperacion   = $_POST['idoperacion'];
            if($p_portafolios === 0){
                
            }else{
            $this->load->model('Operaciones_Model', '', TRUE);
            $this->Operaciones_Model->update_Operaciones_Model($p_idoperacion,'AP',$p_cantidad,
                                                               $p_fecha,$p_portafolios);
            }   
            redirect('aportacion', 'refresh');
        }
    }

    public function show_addform() {
        $this->load->helper(array('form', 'url', 'date','html'));
        $this->load->library('form_validation');

        $time = now('America/Mexico_City');

        $data['accion'] = 'aportacion/add';
        $data['labelcantidad'] = 'Cantidad: ';
        $data['cantidad'] = array('name' => 'cantidad');
        $data['labelfecha'] = 'Fecha: ';
        $data['fecha'] = array('name' => 'fecha', 'value' => unix_to_human($time, TRUE, 'EU'));
        $data['labelportafolios'] = "Portafolios: ";
        $data['portafolios'] = $this->get_portafolios();
        $data['btnguardar'] = array('guardar' => 'Guardar');
       
        $this->call_views('aportaciones/form', $data);
    }

    public function show_editform($p_idoperacion) {
        
        $this->load->helper(array('form', 'url', 'date','html'));
        $this->load->library('form_validation');
        
        $this->load->model('Operaciones_Model', '', TRUE);
        $result = $this->Operaciones_Model->find_by_id($p_idoperacion);

        $time = now('America/Mexico_City');
        
        $data['idoperacion'] = array('idoperacion'=>$result[0]->idaportaciones);
        $data['accion'] = 'aportacion/edit';
        $data['labelcantidad'] = 'Cantidad: ';
        $data['cantidad'] = array('name' => 'cantidad','value'=>$result[0]->cantidad);
        $data['labelfecha'] = 'Fecha: ';
        $data['fecha'] = array('name' => 'fecha', 'value' => $result[0]->fecha);
        $data['labelportafolios'] = "Portafolios: ";
        $data['portafolios'] = $this->get_portafolios();
        $data['selectedPortafolios'] =$result[0]->portafolios;
        $data['btnguardar'] = array('guardar' => 'Guardar');
       
        $this->call_views('aportaciones/form', $data);
        
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

}
