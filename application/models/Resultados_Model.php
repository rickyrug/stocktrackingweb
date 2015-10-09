<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Resultados_Model
 *
 * @author rickyrug
 */
class Resultados_Model extends CI_Model{
   
    public $fecha;
    public $portafolios;
    public $valor;
    public $profit;
    public $rendimiento;
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_resultados_model(){
        $this->db->select('resultados.idresultados, resultados.fecha, portafolios.nombre as portafolios,
       resultados.valor,resultados.profit,resultados.rendimiento, portafolios.idportafolios');
        $this->db->from('resultados');
        $this->db->join('portafolios', 'resultados.portafolios = portafolios.idportafolios');
//        $this->db->where('portafolios',$p_portafolios);
        $this->db->order_by("fecha", "desc"); 
        $query = $this->db->get();
        return $query->result();
        
    }
    
    public function delete_resultados_model($p_idresultados){
        $this->db->where_in('idresultados', $p_idresultados);
        $this->db->delete('resultados');
        
    }
    
    public function find_by_id($p_idresultado){
        $this->db->select('resultados.idresultados, resultados.fecha, portafolios.nombre as portafolios,
       resultados.valor,resultados.profit,resultados.rendimiento, portafolios.idportafolios');
        $this->db->from('resultados');
        $this->db->join('portafolios', 'resultados.portafolios = portafolios.idportafolios');
        $this->db->where('idresultados',$p_idresultado);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_Operaciones_Model_fields($p_fields, $p_idportafolios){
        $this->db->select($p_fields);
        $this->db->from('resultados');
        $this->db->join('portafolios', 'resultados.protafolios = portafolios.idportafolios');
        $this->db->where('portafolios',$p_idportafolios);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function insert_resultados($p_fecha,$p_portafolios,$p_valor,
                                     $p_profit,$p_rendimiento){
        $this->fecha       = $p_fecha;
        $this->portafolios = $p_portafolios;
        $this->profit      = $p_profit;
        $this->rendimiento = $p_rendimiento;
        $this->valor       = $p_valor;
        
        $this->db->insert('resultados', $this);
        
    }
    
    public function update_resultados($p_idresultado,$p_fecha = null,
                                      $p_valor = nul, $p_profit = null,
                                      $p_rendimiento = null, $p_portafolios = null
            ){
        if($p_fecha != null){
            $this->fecha = $p_fecha;
        }
        if($p_valor != null){
            $this->valor = $p_valor;
        }
        if($p_profit != null){
            $this->profit = $p_profit;
        }
        if($p_rendimiento != null){
            $this->rendimiento = $p_rendimiento;
        }
        if($p_portafolios != null){
            $this->portafolios =$p_portafolios;
        }
        
        $this->db->update('resultados', $this, array('idresultados' => $p_idresultado));
    }
    
    public function get_max_min($field,$p_fechaini,$p_fechafinal,$p_portafolios){
        $this->db->select("month(fecha) as month, year(fecha) as year, max(".$field.") as max,min(".$field.") as min");
        $this->db->from('resultados');
        $this->db->where_in('portafolios',$p_portafolios);
        $this->db->where('fecha >=',$p_fechaini);
        $this->db->where('fecha <=',$p_fechafinal);
        $this->db->group_by(array("month(fecha)", "year(fecha)"));
        $this->db->order_by("year(fecha)");
        $this->db->order_by("month(fecha)");
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_max_min_total($field,$p_fechaini,$p_fechafinal,$p_portafolios){
        $this->db->select('month(res.fecha) as month, 
                          year(res.fecha) as year, max(res.valor) as max, min(res.valor) as min
                       from (
                          select  fecha, sum('.$field.') as valor
                          from resultados 
                          where portafolios in ('.$p_portafolios.') and
                          fecha >= "'.$p_fechaini.'" and fecha <= "'.$p_fechafinal.'"
                          group by day(fecha),month(fecha),year(fecha)
                          order by year(fecha),month(fecha),day(fecha)
                       ) as res
                       group by month(res.fecha),year(res.fecha)
                       order by year(res.fecha),month(res.fecha)');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_value_open($field,$p_fechaini,$p_fechafinal,$p_portafolios){
        $this->db->select($field.' as valueopen');
        $this->db->from('resultados');
        $this->db->where_in('portafolios',$p_portafolios);
        $this->db->where('fecha >=',$p_fechaini);
        $this->db->where('fecha <=',$p_fechafinal);
        $this->db->group_by("day(fecha)");
        $this->db->order_by("fecha");
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_value_close($field,$p_fechaini,$p_fechafinal,$p_portafolios){
        $this->db->select($field.' as valueclose');
        $this->db->from('resultados');
        $this->db->where_in('portafolios',$p_portafolios);
        $this->db->where('fecha >=',$p_fechaini);
        $this->db->where('fecha <=',$p_fechafinal);
        $this->db->group_by("day(fecha)");
        $this->db->order_by("fecha",'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }
}
