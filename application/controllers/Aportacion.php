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

    public function __construct() {
        parent::__construct();
         $this->load->model('Operaciones_Model', '', TRUE);
         $this->load->model('Portafolios_Model', '', TRUE);
         $this->load->helper('paginationconfig');
    }
 
   /* Desplagar lista de resultados */

    public function show_list($p_items = null) {
        $per_page = 10;
        if ($p_items == null) {
            $results = $this->Operaciones_Model->get_Operaciones_Model('AP',null,$per_page);
            $number_items = $this->Operaciones_Model->count_result('AP');
        } else {
            
            $results = $this->Operaciones_Model->get_Operaciones_Model('AP',$p_items,$per_page);
            $number_items =  $this->Operaciones_Model->count_result('AP');
        }

        $base_url = base_url();
        $base_url = $base_url .'index.php?/aportacion/show_list/';
        

        $this->pagination->initialize(generate_setup_pagination($base_url, $number_items, $per_page));

        $data = array(
            'title' => 'Aportaciones',
            'aportaciones_list' => $results,
            'paginacion' => $this->pagination->create_links(),
            'resultados' => count($results) .' of '.$number_items,
        );

        $this->call_views('aportaciones/list', $data);
    }
/* Metodo que se llama por default y despliega la lista de registros que hay en la tabla operaciones */   
    public function index() {
       redirect('aportacion/show_list', 'refresh');
    }

   
/*metodo utilitario que despliga las vistas completas, con header y foorter*/
    private function call_views($p_view, $p_data = null) {
     $this->load->view('header');
        if ($p_data == null) {
            $this->load->view($p_view);
        } else {
           
           $this->parser->parse($p_view, $p_data);
        }

     $this->load->view('footer');
    }

        /*Metodo para eliminar operación por id*/
    public function delete($p_idaportacion) {
//        $this->load->helper(array('url'));
       
        $this->Operaciones_Model->delete_Operaciones_Model($p_idaportacion);
        redirect('aportacion', 'refresh');
    }

    /*Metodo encargado de mostrar y agregar operaciones de tipo "AP" */
    public function show_addform() {

        $time = now('America/Mexico_City');


        /* Reglas para la forma */
        $this->form_validation->set_rules('portafolios', 'Portafolios', 'required|callback_validate_portafolios');
        $this->form_validation->set_rules('fecha', 'Fecha', 'required');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'required');


        if ($this->form_validation->run() == FALSE) { // se corre validación de reglas definidas 
            //Array con los datos que se le van a enviar a la vista.
            $data = array(
                'accion' => 'aportacion/show_addform',
                'title'  => 'Agregar aportacion',
                'cantidad' => $this->form_validation->set_value('cantidad'),
                'portafolios' => $this->get_portafolios(),
                'selectedPortafolios' => $this->form_validation->set_value('portafolios'),
                'fecha' => unix_to_human($time, TRUE, 'EU')
            );


            $this->call_views('aportaciones/form', $data);
        } else {

            $p_fecha = $this->input->post('fecha');
            $p_cantidad = $this->input->post('cantidad');
            $p_portafolios = $this->input->post('portafolios');

         
            $this->Operaciones_Model->insert_Operaciones_Model($p_cantidad, $p_fecha, $p_portafolios, 'AP');


            redirect('aportacion/show_list', 'refresh');
        }
    }

    public function show_editform($p_idoperacion = null) {

        $this->form_validation->set_rules('portafolios', 'Portafolios', 'required|callback_validate_portafolios');
        $this->form_validation->set_rules('fecha', 'Fecha', 'required');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'required');
        $this->form_validation->set_rules('idoperacion', 'ID operacion', 'required');

        if ($this->form_validation->run() == FALSE) {
            if ($p_idoperacion != null) {

                $result = $this->Operaciones_Model->find_by_id($p_idoperacion);
                $data = array(
                    'idoperacion' => $result[0]->idaportaciones,
                    'accion' => 'aportacion/show_editform',
                    'title'  => 'Editar aportacion',
                    'cantidad' => $result[0]->cantidad,
                    'portafolios' => $this->get_portafolios(),
                    'selectedPortafolios' => $result[0]->portafolios,
                    'fecha' => $result[0]->fecha
                );
            } else {

                $data = array(
                    'idoperacion' => $this->form_validation->set_value('idoperacion'),
                    'accion' => 'aportacion/show_editform',
                     'title'  => 'Editar aportacion',
                    'cantidad' => $this->form_validation->set_value('cantidad'),
                    'portafolios' => $this->get_portafolios(),
                    'selectedPortafolios' => $this->form_validation->set_value('portafolios'),
                    'fecha' => $this->form_validation->set_value('fecha')
                );
            }
             $this->call_views('aportaciones/form', $data);
        } else {

            $p_fecha = $this->input->post('fecha');
            $p_cantidad = $this->input->post('cantidad');
            $p_portafolios = $this->input->post('portafolios');
            $p_idoperacion = $this->input->post('idoperacion');

            if ($p_portafolios == 0) {
                
            } else {
               
                $this->Operaciones_Model->update_Operaciones_Model($p_idoperacion, 'AP', $p_cantidad, $p_fecha, $p_portafolios);
            }
            redirect('aportacion/show_list', 'refresh');
        }

    }
    
 /*Metdo para obtener toda la lista de portafolios*/
    private function get_portafolios() {
        $var_portafolios_list = array();
        
        $results = $this->Portafolios_Model->get_Portafolios_Model_fields('idportafolios,nombre');
        $var_portafolios_list[] = "";
        foreach ($results as $portafolios) {
            $var_portafolios_list[$portafolios->idportafolios] = $portafolios->nombre;
        }

        return $var_portafolios_list;
    }
    
/*Metodo para validar que el portafolios no se vacio*/
    public function validate_portafolios($p_portafolios) {        
        
        if ($p_portafolios == 0) {
            $this->form_validation->set_message('validate_portafolios', 'The {field} field is required.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
