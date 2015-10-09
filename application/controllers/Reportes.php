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
class Reportes extends CI_Controller {

    public function index() {

        $data['titlederecha'] = "Datos";
        $data['titleizquierda'] = "Grafica";
        $data['portafolios'] = $this->get_portafolios();
        $data['dropdownactions'] =  array(
                                        'onChange' => 'drawChart()',
                                        'class'    => 'form-control'
                                         );
        $this->load->helper(array('form', 'url', 'html'));
        
        $this->load->library('table');
        $this->call_views('reportes/reporte', $data);
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

    public function generate_data_candel($p_field, $p_fechainicial, $p_fechafinal, $p_portafolios) {
         
        if($p_portafolios == 0){
        $this->load->model('Portafolios_Model', '', TRUE);
        $results = $this->Portafolios_Model->get_parent_Portafolios_Model_fields('idportafolios');
        $portafolios = array();
        foreach ($results as $result){
            array_push($portafolios, $result->idportafolios);
        }
        $p_portafolios = $portafolios;
        }
        
         $candel_data['valores'] = $this->collect_data_candel($p_field, $p_fechainicial, $p_fechafinal, $p_portafolios);
         
         
         echo json_encode($candel_data, JSON_NUMERIC_CHECK);
    
       
    }

    private function get_open($p_field, $p_month, $p_year, $p_portafolios) {
        $this->load->model('Resultados_Model', '', TRUE);
        $this->load->library(array('calendar'));
        $var_fechainicial = $p_year . '-' . $p_month . '-' . '01';
        $var_fechafinal = $p_year . '-' . $p_month . '-' . $this->calendar->get_total_days($p_month, $p_year);
        
        if(count($p_portafolios)>1){
            $temp = 'SUM('.$p_field.')';
            $p_field = $temp;
        }
        
        $resultado = $this->Resultados_Model->get_value_open($p_field, $var_fechainicial, $var_fechafinal, $p_portafolios);
        
        return $resultado[0]->valueopen;
    }

    private function get_close($p_field, $p_month, $p_year, $p_portafolios) {
        $this->load->model('Resultados_Model', '', TRUE);
        $this->load->library(array('calendar'));
        $var_fechainicial = $p_year . '-' . $p_month . '-' . '01';
        $var_fechafinal = $p_year . '-' . $p_month . '-' . $this->calendar->get_total_days($p_month, $p_year);

        if (count($p_portafolios) > 1) {
            $temp = 'SUM(' . $p_field . ')';
            $p_field = $temp;
        }

        $resultado = $this->Resultados_Model->get_value_close($p_field, $var_fechainicial, $var_fechafinal, $p_portafolios);

        return $resultado[0]->valueclose;
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

    private function collect_data_candel($p_field, $p_fechainicial, $p_fechafinal, $p_portafolios) {
        $this->load->model('Resultados_Model', '', TRUE);
        $candel_data = array();
        $var_open = 0.0;
        $var_close = 0.0;
        if (count($p_portafolios) == 1) {
            $results = $this->Resultados_Model->get_max_min($p_field, $p_fechainicial, $p_fechafinal, $p_portafolios);
        } elseif (count($p_portafolios) > 1) {
            $results = $this->Resultados_Model->get_max_min_total($p_field, $p_fechainicial, $p_fechafinal,  implode(" ,", $p_portafolios) );
        }
        foreach ($results as $result) {
            $var_open = $this->get_open($p_field, $result->month, $result->year, $p_portafolios);
            $var_close = $this->get_close($p_field, $result->month, $result->year, $p_portafolios);
            $row = array(
                $result->month . "/" . $result->year,
                $result->min,
                $var_open,
                $var_close,
                $result->max,
            );
            array_push($candel_data, $row);
        }
        return $candel_data;
    }
    
//    private function get_profit_todate($p_portafolios, $){
//        
//    }
    

}
