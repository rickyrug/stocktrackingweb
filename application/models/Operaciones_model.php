<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aportaciones_Model
 *
 * @author rickyrug
 */
class Operaciones_model extends CI_Model {

    public $cantidad;
    public $fecha;
    public $portafolios;
    public $tipooperacion;

    function __construct() {
        parent::__construct();
    }

    public function get_Operaciones_Model($p_tipo) {

        $this->db->select('operaciones.idaportaciones, operaciones.cantidad, operaciones.fecha,
                           portafolios.nombre as portafolios,portafolios.idportafolios');
        $this->db->from('operaciones');
        $this->db->join('portafolios', 'operaciones.portafolios = portafolios.idportafolios');
        $this->db->where('tipooperacion',$p_tipo);
        $query = $this->db->get();
        return $query->result();
    }

    public function delete_Operaciones_Model($p_idAportacion) {
        $this->db->where_in('idaportaciones', $p_idAportacion);
        $this->db->delete('operaciones');
    }

    public function get_Operaciones_Model_fields($p_fields, $p_idportafolios) {
        $this->db->select($p_fields);
        $this->db->from('aportaciones');
        $this->db->where('portafolios', $p_idportafolios);
        $query = $this->db->get();
        return $query->result();
    }

    public function find_by_id($p_idaportacion) {

        $this->db->from('operaciones');
        $this->db->where('idaportaciones', $p_idaportacion);
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_Operaciones_Model($p_cantidad, $p_fecha, $p_portafolios,$p_tipooperacion) {
        $this->cantidad      = $p_cantidad;
        $this->fecha         = $p_fecha;
        $this->portafolios   = $p_portafolios;
        $this->tipooperacion = $p_tipooperacion;

        $this->db->insert('operaciones', $this);
    }

    public function update_Operaciones_Model($p_idaportacion, $p_tipooperacion,$p_cantidad = null, 
                                             $p_fecha = null, $p_portafolios = null
                                             
    ) {
        if ($p_cantidad != null) {
            $this->cantidad = $p_cantidad;
        }

        if ($p_fecha != null) {
            $this->fecha = $p_fecha;
        }

        if ($p_portafolios != null) {
            $this->portafolios = $p_portafolios;
        }
        $this->tipooperacion = $p_tipooperacion;
        $this->db->update('operaciones', $this, array('idaportaciones' => $p_idaportacion));
    }

    public function get_sum_operacion($p_tipo, $p_idportafolios,$p_fecha){
        $this->db->select("SUM(cantidad) as total");
        $this->db->from('operaciones');
        $this->db->where('portafolios', $p_idportafolios);
        $this->db->where('tipooperacion', $p_tipo);
        $this->db->where('fecha <=',$p_fecha);
        $query = $this->db->get();
        return $query->result();
    }
}
