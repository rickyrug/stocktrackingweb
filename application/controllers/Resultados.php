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
class Resultados extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Resultados_Model', '', TRUE);
        $this->load->model('Operaciones_Model', '', TRUE);
        $this->load->model('Portafolios_Model', '', TRUE);
        $this->load->helper('paginationconfig');
    }
    
    /* Desplagar lista de resultados */

    public function show_list($p_items = null) {
        
         $per_page = 10;
        if ($p_items == null) {
            $results = $this->Resultados_Model->get_resultados_model(null,$per_page);
            $number_items = $this->Resultados_Model->count_result();
        } else {
            
            $results      = $this->Resultados_Model->get_resultados_model($p_items,$per_page);
            $number_items =  $this->Resultados_Model->count_result();
        }

        $base_url = base_url();
        $base_url = $base_url .'index.php?/resultados/show_list/';
        

        $this->pagination->initialize(generate_setup_pagination($base_url, $number_items, $per_page));

        $data = array(
            'title' => 'Resultados',
            'resultados_list' => $results,
            'paginacion' => $this->pagination->create_links(),
            'resultados' => count($results) .' of '.$number_items,
        );

        $this->call_views('resultados/list', $data);
        
    }
    
    public function index() {

        redirect('resultados/show_list', 'refresh');
    }
    
    public function find_portafolios_results($p_portafolios = null, $p_items = null) {

        $p_nameportafolios = $this->input->post('nombreportafolios');

        if (!empty($p_nameportafolios)) {
            $var_result_portafolios = $this->Portafolios_Model->find_by_name($p_nameportafolios);
            if (count($var_result_portafolios) > 0) {
                $var_portafolios = $var_result_portafolios[0]->idportafolios;
            }
        } elseif ($p_portafolios != null) {

            $var_portafolios = $p_portafolios;
        } else {
            redirect('resultados/show_list', 'refresh');
        }

        $per_page = 10;
        if ($p_items == null) {
            $results = $this->Resultados_Model-> get_resultados_by_portafolios($var_portafolios,null, $per_page);
            $number_items = $this->Resultados_Model->count_result($var_portafolios);
        } else {

            $results = $this->Resultados_Model-> get_resultados_by_portafolios($var_portafolios,$p_items, $per_page);
            $number_items = $this->Resultados_Model->count_result($var_portafolios);
        }

        $base_url = base_url();
        $base_url = $base_url . 'index.php?/resultados/find_portafolios_results/' . $var_portafolios . '/';


        $this->pagination->initialize(generate_setup_pagination($base_url, $number_items, $per_page));

        $data = array(
            'title' => 'Resultados',
            'resultados_list' => $results,
            'paginacion' => $this->pagination->create_links(),
            'resultados' => count($results) . ' of ' . $number_items,
        );

        $this->call_views('resultados/list', $data);

//       
    }

//    private function call_views($p_view, $p_data) {
//        $this->load->view('header');
//        if ($p_data == null) {
//            $this->load->view($p_view);
//        } else {
//           $this->parser->parse($p_view, $p_data);
//        }
//        $this->load->view('footer');
//    }

    public function delete($p_idresultado) {
       
        $this->Resultados_Model->delete_resultados_model($p_idresultado);
        redirect('resultados/show_list', 'refresh');
    }

    private function get_portafolios() {
        $var_portafolios_list = array();

        $results = $this->Portafolios_Model->get_Portafolios_Model_fields('idportafolios,nombre');
        $var_portafolios_list[] = "";
        foreach ($results as $portafolios) {
            $var_portafolios_list[$portafolios->idportafolios] = $portafolios->nombre;
        }

        return $var_portafolios_list;
    }

    public function show_addform() {


        $time = now('America/Mexico_City');

        /* Reglas para la forma */
        $this->form_validation->set_rules('portafolios', 'Portafolios', 'required|callback_validate_portafolios');
        $this->form_validation->set_rules('fecha', 'Fecha', 'required');
        $this->form_validation->set_rules('valor', 'Valor', 'required');
       // $this->form_validation->set_rules('profit', 'Profit', 'required');
       // $this->form_validation->set_rules('rendimiento', 'Rendimiento', 'required');

        if ($this->form_validation->run() == FALSE) {

            $data = array(
                'accion' => 'resultados/show_addform',
                'title' => 'Agregar resultado',
                'fecha' => unix_to_human($time, TRUE, 'EU'),
                'valor' => $this->form_validation->set_value('valor'),
                'portafolios' => $this->get_portafolios(),
                'selectedPortafolios' => $this->form_validation->set_value('portafolios'),
                //'profit' => $this->form_validation->set_value('profit'),
                //'rendimiento' => $this->form_validation->set_value('rendimiento'),
                'base_url' => base_url()
            );

            $this->call_views('resultados/form', $data);
        } else {
            $p_fecha = $this->input->post('fecha');
            $p_portafolios = $this->input->post('portafolios');
            $p_valor = $this->input->post('valor');
           // $p_profit = $this->input->post('profit');
           // $p_rendimiento = $this->input->post('rendimiento');

            //$this->Resultados_Model->insert_resultados($p_fecha, $p_portafolios, $p_valor, $p_profit, $p_rendimiento);
            $this->Resultados_Model->insert_resultados($p_fecha, $p_portafolios, $p_valor);
            redirect('resultados/show_addform', 'refresh');
        }

    }

    public function show_editform($p_idresultado = NULL) {

        $this->form_validation->set_rules('portafolios', 'Portafolios', 'required|callback_validate_portafolios');
        $this->form_validation->set_rules('fecha', 'Fecha', 'required');
        $this->form_validation->set_rules('valor', 'Valor', 'required');
       // $this->form_validation->set_rules('profit', 'Profit', 'required');
       // $this->form_validation->set_rules('rendimiento', 'Rendimiento', 'required');
        $this->form_validation->set_rules('idresultado', 'ID resultados', 'required');
        
         if ($this->form_validation->run() == FALSE) {
            if ($p_idresultado != NULL) {
                $result = $this->Resultados_Model->find_by_id($p_idresultado);
                $data = array(
                    'accion'              => 'resultados/show_editform',
                    'title'               => 'Editar resultado',
                    'idresultado'         => $result[0]->idresultados,
                    'fecha'               => $result[0]->fecha,
                    'valor'               => $result[0]->valor,
                    'portafolios'         => $this->get_portafolios(),
                    'selectedPortafolios' => $result[0]->idportafolios,
                  //  'profit'              => $result[0]->profit,
                  //  'rendimiento'         => $result[0]->rendimiento,
                    'base_url' => base_url()
                );
            } else {
                $data = array(
                'accion'              => 'resultados/show_editform',
                'title'               => 'Editar resultado',
                'idresultado'         => $this->form_validation->set_value('idresultado'),
                'fecha'               => $this->form_validation->set_value('fecha'),
                'valor'               => $this->form_validation->set_value('valor'),
                'portafolios'         => $this->get_portafolios(),
                'selectedPortafolios' => $this->form_validation->set_value('portafolios'),
               // 'profit'              => $this->form_validation->set_value('profit'),
                //'rendimiento'         => $this->form_validation->set_value('rendimiento'),
                'base_url' => base_url()
            );
            }
            $this->call_views('resultados/form', $data);
        }else {
           
            $p_fecha = $this->input->post('fecha');
            $p_portafolios = $this->input->post('portafolios');
            $p_valor = $this->input->post('valor');
           // $p_profit = $this->input->post('profit');
           // $p_rendimiento = $this->input->post('rendimiento');
            $p_idresultados = $this->input->post('idresultado');
            

              
            //    $this->Resultados_Model->update_resultados($p_idresultados, $p_fecha, $p_valor, $p_profit, $p_rendimiento, $p_portafolios);
            $this->Resultados_Model->update_resultados($p_idresultados, $p_fecha, $p_valor, $p_portafolios);    
            redirect('resultados/show_list', 'refresh');
            
        }
        
    }

    public function calculate_profit($p_portafolios, $p_valor, $p_fecha) {
        echo $this->create_profit($p_portafolios, $p_valor, $p_fecha);
    }

    public function calculate_rendimiento($p_portafolios, $p_valor, $p_fecha) {
       echo $this->create_rendimiento($p_portafolios, $p_valor, $p_fecha);
    }

    private function calculate_valorinicial($p_valorinicialportafolios, $p_aportaciones, $p_retiros) {
        return $p_valorinicialportafolios + $p_aportaciones - $p_retiros;
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

    private function create_profit($p_portafolios, $p_valor, $p_fecha) {

        $var_portafolios = $this->Portafolios_Model->find_by_id($p_portafolios);
        $var_sum_aportaciones = $this->Operaciones_Model->get_sum_operacion('AP', $p_portafolios, $p_fecha);
        $var_sum_retiros = $this->Operaciones_Model->get_sum_operacion('RT', $p_portafolios, $p_fecha);

        $var_profit = $p_valor - $this->calculate_valorinicial($var_portafolios[0]->valorinicial, $var_sum_aportaciones[0]->total, $var_sum_retiros[0]->total);

        return $var_profit;
    }

    private function create_rendimiento($p_portafolios, $p_valor, $p_fecha) {

        $var_portafolios = $this->Portafolios_Model->find_by_id($p_portafolios);
        $var_sum_aportaciones = $this->Operaciones_Model->get_sum_operacion('AP', $p_portafolios, $p_fecha);
        $var_sum_retiros = $this->Operaciones_Model->get_sum_operacion('RT', $p_portafolios, $p_fecha);
        $var_valorinicial = $this->calculate_valorinicial($var_portafolios[0]->valorinicial, $var_sum_aportaciones[0]->total, $var_sum_retiros[0]->total);

        $var_rendimiento = ($p_valor - $var_valorinicial) / $var_valorinicial;

        return $var_rendimiento;
    }

}
