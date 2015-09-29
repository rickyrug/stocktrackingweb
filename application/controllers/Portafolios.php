<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Portafolios_Controller
 *
 * @author 60044723
 */
class Portafolios extends CI_Controller {

    public function index() {
        $this->load->model('Portafolios_Model', '', TRUE);
        $results = $this->Portafolios_Model->get_Portafolios_Model();
        $data['results'] = $results;

        $this->load->helper(array('form', 'url', 'html'));
        $this->load->library('form_validation');
        $this->load->library('table');
        $this->call_views('portafolios/list', $data);
    }

    public function add() {

        $this->load->helper(array('form', 'url', 'html'));
        $this->load->library('form_validation');
        $this->load->library('calendar');

        $this->form_validation->set_rules('nombre', 'Nombre de portafolios', 'required');
        $this->form_validation->set_rules('valorinicial', 'Valor inicial', 'required');
        $this->form_validation->set_rules('fechacreacion', 'Fecha creacion', 'required');
        $this->form_validation->set_rules('portafolios', 'Portafolios', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['error'] = $this->form_validation->error_array();
            $data['accion'] = 'portafolios/add';
            $data['labelnombre'] = 'Nombre: ';
            $data['nombre'] = array('name' => 'nombre', 'value' => $this->form_validation->set_value('nombre'));
            $data['labelvalorinicial'] = 'Valor inicial: ';
            $data['valorinicial'] = array('name' => 'valorinicial', 'value' => $this->form_validation->set_value('valorinicial'));
            $data['labelfechacreacion'] = 'Fecha creación: ';
            $data['fechacreacion'] = array('name' => 'fechacreacion', 'value' => $this->form_validation->set_value('fechacreacion'));
            $data['btnguardar'] = array('guardar' => 'Guardar');
            $data['labelportafoliospadre'] = 'Portafolios Padre: ';
            $data['portafolios'] = $this->get_portafolios();
            $data['selectedPortafolios'] = $this->form_validation->set_value('portafolios');

            $this->call_views('portafolios/form', $data);
        } else {

            $p_nombre           = $_POST['nombre'];
            $p_valorinicial     = $_POST['valorinicial'];
            $p_fechacreacion    = $_POST['fechacreacion'];
            $p_portafoliospadre = $_POST['portafolios'];
            
            if($p_portafoliospadre == 0){
                $p_portafoliospadre = null;
            }
            
            $this->load->model('Portafolios_Model', '', TRUE);
            $this->Portafolios_Model->insert_Portafolios_Model($p_nombre, $p_valorinicial, 
                                                               $p_fechacreacion,$p_portafoliospadre);

            redirect('portafolios', 'refresh');
        }
    }

    public function show_addform() {
        $this->load->helper(array('form', 'url', 'date','html'));
        $this->load->library('form_validation');

        $time = now('America/Mexico_City');

        $data['accion'] = 'portafolios/add';
        $data['labelnombre'] = 'Nombre: ';
        $data['nombre'] = array('name' => 'nombre');
        $data['labelvalorinicial'] = 'Valor inicial: ';
        $data['valorinicial'] = array('name' => 'valorinicial');
        $data['labelfechacreacion'] = 'Fecha creación: ';
        $data['fechacreacion'] = array('name' => 'fechacreacion', 'value' => unix_to_human($time, TRUE, 'EU'));
        $data['portafolios'] = $this->get_portafolios();
        $data['labelportafoliospadre'] = 'Portafolios Padre: ';
        $data['btnguardar'] = array('guardar' => 'Guardar');

        $this->call_views('portafolios/form', $data);
    }

    public function show_editform($p_idportafolios) {

        $this->load->helper(array('form', 'url', 'date','html'));
        $this->load->library('form_validation');

        $this->load->model('Portafolios_Model', '', TRUE);
        $selected_portafolios = $this->Portafolios_Model->find_by_id($p_idportafolios);

        $time = now('America/Mexico_City');

        $data['accion'] = 'portafolios/edit';
        $data['labelnombre'] = 'Nombre: ';
        $data['nombre'] = array('name' => 'nombre', 'value' => $selected_portafolios[0]->nombre);
        $data['labelvalorinicial'] = 'Valor inicial: ';
        $data['valorinicial'] = array('name' => 'valorinicial', 'value' => $selected_portafolios[0]->valorinicial);
        $data['labelfechacreacion'] = 'Fecha creación: ';
        $data['fechacreacion'] = array('name' => 'fechacreacion', 'value' => $selected_portafolios[0]->fechacreacion);
        $data['btnguardar'] = array('guardar' => 'Guardar');
        $data['idportafolios'] = array('idportafolios' => $selected_portafolios[0]->idportafolios);
        $data['idportafolios_delete'] = $selected_portafolios[0]->idportafolios;
        $data['labelportafoliospadre'] = 'Portafolios Padre: ';
        $data['portafolios'] = $this->get_portafolios();
        $data['selectedPortafolios'] = $selected_portafolios[0]->portafoliospadre;
        $this->call_views('portafolios/form', $data);
    }

    public function edit() {

        $this->load->helper(array('form', 'url','html'));
        $this->load->library('form_validation');
        $this->load->library('calendar');

        $this->form_validation->set_rules('nombre', 'Nombre de portafolios', 'required');
        $this->form_validation->set_rules('valorinicial', 'Valor inicial', 'required');
        $this->form_validation->set_rules('fechacreacion', 'Fecha creacion', 'required');
        $this->form_validation->set_rules('idportafolios', 'idportafolios', 'required');
        $this->form_validation->set_rules('portafolios', 'Portafolios', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['error'] = $this->form_validation->error_array();
            $data['accion'] = 'portafolios/edit';
            $data['labelnombre'] = 'Nombre: ';
            $data['nombre'] = array('name' => 'nombre', 'value' => $this->form_validation->set_value('nombre'));
            $data['labelvalorinicial'] = 'Valor inicial: ';
            $data['valorinicial'] = array('name' => 'valorinicial', 'value' => $this->form_validation->set_value('valorinicial'));
            $data['labelfechacreacion'] = 'Fecha creación: ';
            $data['fechacreacion'] = array('name' => 'fechacreacion', 'value' => $this->form_validation->set_value('fechacreacion'));
            $data['btnguardar'] = array('guardar' => 'Guardar');
            $data['idportafolios'] = array('idportafolios' => $this->form_validation->set_value('idportafolios'));
             $data['labelportafoliospadre'] = 'Portafolios Padre: ';
            $data['portafolios'] = $this->get_portafolios();
            $data['selectedPortafolios'] = $this->form_validation->set_value('portafolios');
            $this->call_views('portafolios/form', $data);
        } else {
            $p_idportafolios = $_POST['idportafolios'];
            $p_nombre = $_POST['nombre'];
            $p_valorinicial = $_POST['valorinicial'];
            $p_fechacreacion = $_POST['fechacreacion'];
            $p_portafoliospadre = $_POST['portafolios'];
            
            if($p_portafoliospadre == 0){
                $p_portafoliospadre = null;
            }
            $this->load->model('Portafolios_Model', '', TRUE);
            $this->Portafolios_Model->update_Portafolios_Model($p_idportafolios, $p_nombre, 
                                                               $p_valorinicial, $p_fechacreacion,
                                                               $p_portafoliospadre
            );

            redirect('portafolios', 'refresh');
        }
    }

    public function delete($p_Portafolios) {
        $this->load->helper(array('form', 'url'));
        $this->load->model('Portafolios_Model','',TRUE);
        $this->Portafolios_Model->delete_Portafolios_Model($p_Portafolios);
        redirect('portafolios', 'refresh');
        
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
