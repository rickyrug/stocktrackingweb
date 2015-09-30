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
class Reportes extends CI_Controller{
   
    public function index() {
       
        $data['titlederecha']   = "Datos";
        $data['titleizquierda'] = "Grafica";

        $this->load->helper(array('form', 'url', 'html'));
       
        $this->load->library('table');
        $this->call_views('reportes/reporte',$data);
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
        
        $this->load->model('Resultados_Model', '', TRUE);
        $candel_data = array();
        $var_open = 0.0;
        $var_close = 0.0;
        $results = $this->Resultados_Model->get_max_min($p_field, $p_fechainicial, $p_fechafinal, $p_portafolios);
        foreach ($results as $result) {
            $var_open = $this->get_open($p_field, $result->month, $result->year, $p_portafolios);
            $var_close = $this->get_close($p_field, $result->month, $result->year, $p_portafolios);
            $row = array(
                $result->month."/".$result->year,
                $result->min,
                $var_open,
                $var_close,
                $result->max,

            );
            array_push($candel_data, $row);
        }
        echo json_encode($candel_data,JSON_NUMERIC_CHECK);
//        var_dump($results);
    }
    
    private function get_open($p_field, $p_month, $p_year, $p_portafolios){
        $this->load->model('Resultados_Model', '', TRUE);
        $this->load->library(array('calendar'));
        $var_fechainicial = $p_year.'-'.$p_month.'-'.'01';
        $var_fechafinal   = $p_year.'-'.$p_month.'-'.$this->calendar->get_total_days($p_month, $p_year);
        $resultado = $this->Resultados_Model->get_value_open($p_field,$var_fechainicial,
                                                            $var_fechafinal,$p_portafolios);
        
        return $resultado[0]->valueopen;
    }
    
    private function get_close($p_field, $p_month, $p_year, $p_portafolios){
        $this->load->model('Resultados_Model', '', TRUE);
        $this->load->library(array('calendar'));
        $var_fechainicial = $p_year.'-'.$p_month.'-'.'01';
        $var_fechafinal   = $p_year.'-'.$p_month.'-'.$this->calendar->get_total_days($p_month, $p_year);
        $resultado = $this->Resultados_Model->get_value_close($p_field,$var_fechainicial,
                                                            $var_fechafinal,$p_portafolios);
        
        return $resultado[0]->valueclose;
    }
}
