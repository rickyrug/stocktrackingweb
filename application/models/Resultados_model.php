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
class Resultados_model extends CI_Model{
   
    public $fecha;
    public $portafolios;
    public $valor;
    public $profit;
    public $rendimiento;
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_resultados_model($p_start = null, $p_limit = null){
        
         if ($p_limit != null && $p_start == null) {
            $this->db->limit($p_limit);
        } else if ($p_start != NULL && $p_limit != null) {
            $this->db->limit($p_limit, $p_start);
            //  $this->db->limit($p_start,$p_limit);
        }
        
        
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
    
    public function get_resultados_by_portafolios($p_idportafolios, $p_start = null, $p_limit = null){
        
        if ($p_limit != null && $p_start == null) {
            $this->db->limit($p_limit);
        } else if ($p_start != NULL && $p_limit != null) {
            $this->db->limit($p_limit, $p_start);
            //  $this->db->limit($p_start,$p_limit);
        }

        
        $this->db->select('resultados.idresultados, resultados.fecha, portafolios.nombre as portafolios,
       resultados.valor,resultados.profit,resultados.rendimiento, portafolios.idportafolios');
        $this->db->from('resultados');
        $this->db->join('portafolios', 'resultados.portafolios = portafolios.idportafolios');
        $this->db->where('portafolios',$p_idportafolios);
        $this->db->order_by("fecha", "desc"); 
        $query = $this->db->get();
        return $query->result();
    }
    
    public function insert_resultados($p_fecha,$p_portafolios,$p_valor
                                   //  ,$p_profit,$p_rendimiento
                                        ){
        $this->fecha       = $p_fecha;
        $this->portafolios = $p_portafolios;
        //$this->profit      = $p_profit;
        //$this->rendimiento = $p_rendimiento;
        $this->valor       = $p_valor;
        
        $this->db->insert('resultados', $this);
        
    }
    
    public function update_resultados($p_idresultado,$p_fecha = null,
                                      $p_valor = null, 
                                     // $p_profit = null,$p_rendimiento = null, 
                                      $p_portafolios = null
                                      ){
        if($p_fecha != null){
            $this->fecha = $p_fecha;
        }
        if($p_valor != null){
            $this->valor = $p_valor;
        }
//        if($p_profit != null){
//            $this->profit = $p_profit;
//        }
//        if($p_rendimiento != null){
//            $this->rendimiento = $p_rendimiento;
//        }
        if($p_portafolios != null){
            $this->portafolios =$p_portafolios;
        }
        
        $this->db->update('resultados', $this, array('idresultados' => $p_idresultado));
    }
    
    public function get_max_min($field,$p_fechaini,$p_fechafinal,$p_portafolios){
//        $this->db->select("month(fecha) as month, year(fecha) as year, max(".$field.") as max,min(".$field.") as min");
//        $this->db->from('resultados');
//        $this->db->where_in('portafolios',$p_portafolios);
//        $this->db->where('fecha >=',$p_fechaini);
//        $this->db->where('fecha <=',$p_fechafinal);
//        $this->db->group_by(array("month(fecha)", "year(fecha)"));
//        $this->db->order_by("year(fecha)");
//        $this->db->order_by("month(fecha)");
        $sql = "year(fecha) year, month(fecha) month, sum(valorMax) max, sum(valorMin) min
                    FROM(
                        SELECT resultados.fecha,  max(valor) valorMax,min(valor) valorMin, portafolios
                        FROM trackingstocks.resultados resultados
                        INNER JOIN trackingstocks.portafolios portafolios
                    on resultados.portafolios = portafolios.idportafolios
                    where portafolios.active = 'X'
                    
                    and fecha between '%s' and '%s'
                    and portafolios.idportafolios in (%s)
                    group by year(resultados.fecha),
                                     month(resultados.fecha),
                                    resultados.portafolios
                    ) MAXVALUES
                    group by year(fecha),
                                     month(fecha)";
        $sql = sprintf($sql,$p_fechaini,$p_fechafinal,$p_portafolios);
        $this->db->select($sql);
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
//        $this->db->select($field.' as valueopen');
//        $this->db->from('resultados');
//        $this->db->where_in('portafolios',$p_portafolios);
//        $this->db->where('fecha >=',$p_fechaini);
//        $this->db->where('fecha <=',$p_fechafinal);
////        $this->db->group_by("day(fecha)");
//        $this->db->order_by("fecha");
//        $this->db->limit(1);
//        $query = $this->db->get();
//        return $query->result();
        $sqlstring = "
                 results.fecha, sum(openvalue) valueopen
                from
                (

                SELECT trackingstocks.resultados.fecha,  avg(trackingstocks.resultados.valor) openvalue
                FROM trackingstocks.resultados
                INNER join
                (
                SELECT min(fecha) fechaOpen,portafolios
                FROM trackingstocks.resultados
                INNER JOIN portafolios
                on resultados.portafolios = portafolios.idportafolios
                where portafolios.active = 'X'
                
                and portafolios.idportafolios in (%s)
                group by year(fecha),month(fecha), portafolios

                ) firstdate
                on resultados.fecha = firstdate.fechaOpen  
                and resultados.portafolios = firstdate.portafolios
                group by year(trackingstocks.resultados.fecha),
                        month(trackingstocks.resultados.fecha),
                    trackingstocks.resultados.portafolios
                ) results
                where results.fecha between '%s' and '%s'
                group by year(results.fecha), month(results.fecha), day(results.fecha)";
        try {
            $sql = sprintf($sqlstring,$p_portafolios,$p_fechaini,$p_fechafinal);
                $this->db->select($sql);
                $query = $this->db->get();
                return $query->result();
            } catch (Exception $exc) {
                
                echo $exc->getTraceAsString();
             }   

        
    }
    
    public function get_value_close($field,$p_fechaini,$p_fechafinal,$p_portafolios){
//        $this->db->select($field.' as valueclose');
//        $this->db->from('resultados');
//        $this->db->where_in('portafolios',$p_portafolios);
//        $this->db->where('fecha >=',$p_fechaini);
//        $this->db->where('fecha <=',$p_fechafinal);
////        $this->db->group_by("day(fecha)");
//        $this->db->order_by("fecha",'desc');
//        $this->db->limit(1);
        
               $sqlstring = "
                 results.fecha, sum(closevalue) valueclose
                from
                (

                SELECT trackingstocks.resultados.fecha,  avg(trackingstocks.resultados.valor) closevalue
                FROM trackingstocks.resultados
                INNER join
                (
                SELECT max(fecha) fechaOpen,portafolios
                FROM trackingstocks.resultados
                INNER JOIN portafolios
                on resultados.portafolios = portafolios.idportafolios
                where portafolios.active = 'X'
                
                and portafolios.idportafolios in (%s)
                group by year(fecha),month(fecha), portafolios

                ) firstdate
                on resultados.fecha = firstdate.fechaOpen  
                and resultados.portafolios = firstdate.portafolios
                group by year(trackingstocks.resultados.fecha),
                        month(trackingstocks.resultados.fecha),
                    trackingstocks.resultados.portafolios
                ) results
                where results.fecha between '%s' and '%s'
                group by year(results.fecha), month(results.fecha), day(results.fecha)";
        try {
            $sql = sprintf($sqlstring,$p_portafolios,$p_fechaini,$p_fechafinal);
                $this->db->select($sql);
                $query = $this->db->get();
                return $query->result();
            } catch (Exception $exc) {
                
                echo $exc->getTraceAsString();
             }   
        
//        $query = $this->db->get();
//        return $query->result();
    }
    
    public function get_max_date($p_fechaini,$p_fechafinal){
        $this->db->select('max(fecha) as fecha' );
        $this->db->from('resultados');
        $this->db->where('fecha >=',$p_fechaini);
        $this->db->where('fecha <=',$p_fechafinal);
        $query = $this->db->get();
        return $query->result();
    }
    
       public function count_result($p_portafolios = null) {
        $this->db->select('*');
        $this->db->from('resultados');

        if ($p_portafolios != NULL) {
            $this->db->where('portafolios', $p_portafolios);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function get_last_results($p_portafolios,$p_order, $p_resultnumber=null){
        
        $this->db->select('portafolios.nombre,resultados.valor,resultados.fecha');
        $this->db->from('resultados');
        $this->db->join('portafolios', 'resultados.portafolios = portafolios.idportafolios');
        if ($p_portafolios != NULL) {
            $this->db->where('portafolios', $p_portafolios);
        }
        
        $this->db->order_by("fecha",$p_order);
        if($p_resultnumber != NULL){
            $this->db->limit($p_resultnumber);
        }else{
            $this->db->limit(2);
        }
        
        
        $query = $this->db->get();
        return $query->result();
        
    }
    
    
    public function get_last_result_bydateasc($p_portafolios,$p_resultnumber){
        $stringwithportafolios = '* 
            from 
                    (select * 
                            from resultados 
                    inner join portafolios
                    on resultados.portafolios = portafolios.idportafolios
                    where portafolios = %d 
                    order by fecha desc limit %d
                 ) 
            resultados 
            order by resultados.fecha asc ';
        
        $stringwithoutportafolios = '* 
            from 
                    (select resultados.fecha, sum(resultados.valor) valor
                            from resultados 
                    inner join portafolios
                    on resultados.portafolios = portafolios.idportafolios
                    where portafolios.portafoliospadre is null
                    group by day(resultados.fecha),month(resultados.fecha), year(resultados.fecha)
                    order by fecha desc limit %d
                 ) 
            resultados 
            order by resultados.fecha asc ';
        
        if($p_portafolios != 'ZZ'){
            $querystring = sprintf($stringwithportafolios, $p_portafolios,$p_resultnumber);
        }else{
            $querystring = sprintf($stringwithoutportafolios, $p_resultnumber);
        }
        
        
        $this->db->select($querystring);
        $query = $this->db->get();
        return $query->result();
    }

}
