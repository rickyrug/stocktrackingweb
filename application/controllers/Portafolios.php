<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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
class Portafolios extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Portafolios_Model', '', TRUE);
        $this->load->helper('paginationconfig');
    }

    public function show_list($p_items = null) {
        $per_page = 10;
        if ($p_items == null) {
            $results = $this->Portafolios_Model->get_Portafolios_Model(null, $per_page);
            $number_items = $this->Portafolios_Model->count_result('AP');
        } else {

            $results = $this->Portafolios_Model->get_Portafolios_Model($p_items, $per_page);
            $number_items = $this->Portafolios_Model->count_result('AP');
        }


        $base_url = base_url();
        $base_url = $base_url . 'index.php?/aportacion/show_list/';


        $this->pagination->initialize(generate_setup_pagination($base_url, $number_items, $per_page));

        $data = array(
            'title' => 'Portafolios',
            'portafolios_list' => $results,
            'paginacion' => $this->pagination->create_links(),
            'resultados' => count($results) . ' of ' . $number_items,
        );

        $this->call_views('portafolios/list', $data);
    }

    public function index() {

        redirect('portafolios/show_list', 'refresh');
    }

    public function show_addform() {


        $time = now('America/Mexico_City');

        //se agregan reglas a la forma
        $this->form_validation->set_rules('nombre', 'Nombre de portafolios', 'required');
        $this->form_validation->set_rules('valorinicial', 'Valor inicial', 'required');
        $this->form_validation->set_rules('fechacreacion', 'Fecha creacion', 'required');

        if ($this->form_validation->run() == FALSE) {

            //Array con los datos que se le van a enviar a la vista.
            $data = array(
                'accion' => 'portafolios/show_addform',
                'title' => 'Agregar portafolios',
                'nombre' => $this->form_validation->set_value('nombre'),
                'valorinicial' => $this->form_validation->set_value('valorinicial'),
                'portafolios' => $this->get_portafolios(),
                'selectedPortafolios' => $this->form_validation->set_value('portafolios'),
                'fechacreacion' => unix_to_human($time, TRUE, 'EU'),
                'active' => TRUE
            );

            $this->call_views('portafolios/form', $data);
        } else {

            $p_nombre           = $this->input->post('nombre');
            $p_valorinicial     = $this->input->post('valorinicial');
            $p_fechacreacion    = $this->input->post('fechacreacion');
            $p_portafoliospadre = $this->input->post('portafolios');
            $p_active           = $this->input->post('inputEstatus');
            
            if ($p_portafoliospadre == 0) {
                $p_portafoliospadre = null;
            }


            $this->Portafolios_Model->insert_Portafolios_Model($p_nombre, $p_valorinicial, $p_fechacreacion,$p_active, $p_portafoliospadre);

            redirect('portafolios', 'refresh');
        }
    }

    public function show_editform($p_idportafolios=NULL) {
       
        //se agregan reglas a la forma
        $this->form_validation->set_rules('nombre', 'Nombre de portafolios', 'required');
        $this->form_validation->set_rules('valorinicial', 'Valor inicial', 'required');
        $this->form_validation->set_rules('fechacreacion', 'Fecha creacion', 'required');

        if ($this->form_validation->run() == FALSE) {
            if ($p_idportafolios != NULL) {
                $result = $this->Portafolios_Model->find_by_id($p_idportafolios);
                
                if($result[0]->active == 'X'){
                    $active = TRUE;
                }else{
                    $active = FALSE;
                }
                
                $data = array(
                    'accion' => 'portafolios/show_editform',
                    'title' => 'Editar portafolios',
                    'idportafolios'=> $result[0]->idportafolios,
                    'nombre' => $result[0]->nombre,
                    'valorinicial' => $result[0]->valorinicial,
                    'portafolios' => $this->get_portafolios(),
                    'selectedPortafolios' => $result[0]->portafoliospadre,
                    'fechacreacion' => $result[0]->fechacreacion,
                    'inputEstatus' => $result[0]->active,
                    'active' => $active
                        
                );
            } else {

                //Array con los datos que se le van a enviar a la vista.
                $data = array(
                    'accion'              => 'portafolios/show_editform',
                    'title'               => 'Editar portafolios',
                    'nombre'              => $this->form_validation->set_value('nombre'),
                    'idportafolios'       => $this->form_validation->set_value('idportafolios'),
                    'valorinicial'        => $this->form_validation->set_value('valorinicial'),
                    'portafolios'         => $this->get_portafolios('idportafolios'),
                    'selectedPortafolios' => $this->form_validation->set_value('portafolios'),
                    'fechacreacion'       => $this->form_validation->set_value('fechacreacion'),
                    'inputEstatus'        => $this->form_validation->set_value('inputEstatus')
                );
            }
            $this->call_views('portafolios/form', $data);
        } else {
            $p_idportafolios    = $this->input->post('idportafolios');
            $p_nombre           = $this->input->post('nombre'); 
            $p_valorinicial     = $this->input->post('valorinicial'); 
            $p_fechacreacion    = $this->input->post('fechacreacion'); 
            $p_portafoliospadre = $this->input->post('portafolios');  
            $p_active           = $this->input->post('inputEstatus');
            if ($p_portafoliospadre == 0) {
                $p_portafoliospadre = null;
            }
           
            $this->Portafolios_Model->update_Portafolios_Model($p_idportafolios, 
                    $p_nombre, $p_valorinicial, $p_fechacreacion, $p_portafoliospadre,$p_active);

            redirect('portafolios', 'refresh');
        }

    }


    public function delete($p_Portafolios) {

        $this->Portafolios_Model->delete_Portafolios_Model($p_Portafolios);
        redirect('portafolios', 'refresh');
    }

//    private function call_views($p_view, $p_data = null) {
//        $this->load->view('header');
//        if ($p_data == null) {
//            $this->load->view($p_view);
//        } else {
//
//            $this->parser->parse($p_view, $p_data);
//        }
//
//        $this->load->view('footer');
//    }

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
