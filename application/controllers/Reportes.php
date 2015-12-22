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

    public function __construct() {
        parent::__construct();
         $this->load->model('Portafolios_Model', '', TRUE);
         $this->load->model('Resultados_Model', '', TRUE);
         $this->load->model('Operaciones_Model', '', TRUE);
    }
    
    public function index() {

        $data['titlederecha'] = "Datos";
        $data['titleizquierda'] = "Grafica";
        $data['portafolios'] = $this->get_portafolios();
        $data['dropdownactions'] =  array(
                                     /*   'onChange' => 'drawChart()',*/
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
         
          
        if ($p_portafolios == 0) {
           
            $results = $this->Portafolios_Model->get_parent_Portafolios_Model_fields('idportafolios');
            $portafolios = array();
            foreach ($results as $result) {
                array_push($portafolios, $result->idportafolios);
            }
            $p_portafolios = $portafolios;
        }else{
            $portafolios = array();
            array_push($portafolios, $p_portafolios);
            $p_portafolios = $portafolios;
        }
         $var_valid_date = $this->get_valid_date($p_fechainicial, $p_fechafinal);
         $candel_data['valores']      = $this->collect_data_candel($p_field, $p_fechainicial, $p_fechafinal, $p_portafolios);
         $candel_data['aportaciones'] = number_format($this->get_operaciones($p_portafolios, $p_fechafinal,'AP'),2);
         $candel_data['retiros']      = number_format($this->get_operaciones($p_portafolios, $p_fechafinal,'RT'),2);
         $candel_data['profit']       = number_format($this->get_close('profit', date("m",strtotime($var_valid_date)), date("Y",strtotime($var_valid_date)), $p_portafolios),2);
         $var_performance             = $this->get_close('rendimiento', date("m",strtotime($var_valid_date)), date("Y",strtotime($var_valid_date)),$p_portafolios) * 100;
         $candel_data['perform']      = number_format($var_performance, 2);
         $candel_data['valor']        = number_format($this->get_close('valor', date("m",strtotime($var_valid_date)), date("Y",strtotime($var_valid_date)), $p_portafolios),2);
         $candel_data['initialvalue'] = number_format($this->get_portafolios_initial_value($p_portafolios),2);
         
         echo json_encode($candel_data, JSON_NUMERIC_CHECK);
    
       
    }

    private function get_open($p_field, $p_month, $p_year, $p_portafolios) {
        
        
        $this->load->library(array('calendar'));
        $var_fechainicial = $p_year . '-' . $p_month . '-' . '01';
        $var_fechafinal = $p_year . '-' . $p_month . '-' . $this->calendar->get_total_days($p_month, $p_year);
        $valoropen = 0.0;
        
        if (count($p_portafolios) > 1) {
            foreach ($p_portafolios as $portafolio) {

                $resultado = $this->Resultados_Model->get_value_open($p_field, $var_fechainicial, $var_fechafinal, $portafolio);
                if (count($resultado) > 0) {
                    $valoropen = $valoropen + $resultado[0]->valueopen;
                }
            }
        } else {
            $resultado = $this->Resultados_Model->get_value_open($p_field, $var_fechainicial, $var_fechafinal, $p_portafolios);
            $valoropen = $resultado[0]->valueopen;
        }

        return $valoropen;
    }

    private function get_close($p_field, $p_month, $p_year, $p_portafolios) {
      
        $this->load->library(array('calendar'));
        $var_fechainicial = $p_year . '-' . $p_month . '-' . '01';
        $var_fechafinal   = $p_year . '-' . $p_month . '-' . $this->calendar->get_total_days($p_month, $p_year);
       
        $valorclose = 0.0;
        
        if (count($p_portafolios) > 1) {
            foreach ($p_portafolios as $portafolio) {
                $resultado = $this->Resultados_Model->get_value_close($p_field, $var_fechainicial, $var_fechafinal, $portafolio);
                if (count($resultado) > 0) {
                $valorclose = $valorclose + $resultado[0]->valueclose;  
                }
            }
        } else {
            $resultado = $this->Resultados_Model->get_value_close($p_field, $var_fechainicial, $var_fechafinal, $p_portafolios);
            $valorclose = $resultado[0]->valueclose;
        }
        
        return $valorclose;
    }

    private function get_portafolios() {
        $var_portafolios_list = array();
   
        $results = $this->Portafolios_Model->get_Portafolios_Model_fields('idportafolios,nombre');
        $var_portafolios_list[] = "Todos";
        foreach ($results as $portafolios) {
            $var_portafolios_list[$portafolios->idportafolios] = $portafolios->nombre;
        }

        return $var_portafolios_list;
    }

    private function collect_data_candel($p_field, $p_fechainicial, $p_fechafinal, $p_portafolios) {
   
        $candel_data = array();
        $var_open = 0.0;
        $var_close = 0.0;
        $results = null;
        if (count($p_portafolios) == 1) {
            $results = $this->Resultados_Model->get_max_min($p_field, $p_fechainicial, $p_fechafinal, $p_portafolios);
        } elseif (count($p_portafolios) > 1) {
            
            foreach($p_portafolios as $portafolio){
                $p_portalio_result = $this->Resultados_Model->get_max_min($p_field, $p_fechainicial, $p_fechafinal, $portafolio);
                $results = $this->sum_data($p_portalio_result, $results);
            }
            
//            $results = $this->Resultados_Model->get_max_min_total($p_field, $p_fechainicial, $p_fechafinal,  implode(" ,", $p_portafolios) );
        }
        foreach ($results as $result) {
            $var_open  = $this->get_open($p_field,  $result->month, $result->year, $p_portafolios);
            $var_close = $this->get_close($p_field, $result->month, $result->year, $p_portafolios);
            $row = array($result->month . "/" . $result->year,$result->min,$var_open,$var_close,$result->max,);
            array_push($candel_data, $row);
        }
        return $candel_data;
    }
    
    private function sum_data($p_portafolios_result, $p_total_results = null) {
        if ($p_total_results != null) {

            for ($i = 0; $i < count($p_portafolios_result); $i++) {
                
                if ($p_portafolios_result[$i]->month == $p_total_results[$i]->month &&
                    $p_portafolios_result[$i]->year  == $p_total_results[$i]->year
                ) {
                    $p_total_results[$i]->max = $p_total_results[$i]->max + $p_portafolios_result[$i]->max;
                    $p_total_results[$i]->min = $p_total_results[$i]->min + $p_portafolios_result[$i]->min;
                }
            }
        } else {
            $p_total_results = array();
            foreach ($p_portafolios_result as $portafolio_result) {
                array_push($p_total_results, $portafolio_result);
            }
        }

        return $p_total_results;
    }

    private function get_operaciones($p_portafolios, $p_fecha,$p_operacion){
      $var_total = 0.0;      
      
      
      foreach ($p_portafolios as $portafolio){
          $var_portafolios_ap = $this->Operaciones_Model->get_sum_operacion($p_operacion, $portafolio, $p_fecha);
          $var_total= $var_total + $var_portafolios_ap[0]->total;
      }
      
      return  $var_total;

    }
    
    private function get_portafolios_initial_value($p_portafolios){
       
        $var_valorinicial = 0.0;
  
            foreach ($p_portafolios as $portafolio){
              $result = $this->Portafolios_Model->find_by_id($portafolio);
              $var_valorinicial = $var_valorinicial + $result[0]->valorinicial;
            } 

            return $var_valorinicial;
    }
   
    
    private function get_valid_date($p_fechaini,$p_fechafinal){
       
       $result = $this->Resultados_Model->get_max_date($p_fechaini,$p_fechafinal);
       if(count($result)>0){
           return $result[0]->fecha;
       }else{
          return 0; 
       }
    }
}
