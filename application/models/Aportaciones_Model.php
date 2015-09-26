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
class Aportaciones_Model extends CI_Model {

    public $monto;
    public $fecha;
    public $portafolios;

    function __construct() {
        parent::__construct();
    }

    public function get_Aportaciones_Model() {

     //   $this->db->select('aportaciones.idaportaciones, aportaciones.monto, aportaciones.fecha,
     //                      portafolios.nombre as portafolios,portafolios.idportafolios');
        $this->db->from('aportaciones');
  //      $this->db->join('portafolios', 'aportaciones.portafolios = portafolios.idportafolios');
        $query = $this->db->get();
        return $query->result();
    }

    public function delete_Aportaciones_Model($p_idAportacion) {
        $this->db->where_in('idaportaciones', $p_idAportacion);
        $this->db->delete('aportaciones');
    }

    public function get_Portafolios_Model_fields($p_fields, $p_idportafolios) {
        $this->db->select($p_fields);
        $this->db->from('aportaciones');
        $this->db->where('portafolios', $p_idportafolios);
        $query = $this->db->get();
        return $query->result();
    }

    public function find_by_id($p_idaportacion) {

        $this->db->from('aportaciones');
        $this->db->where('idaportaciones', $p_idaportacion);
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_aportaciones_Model($p_monto, $p_fecha, $p_portafolios) {
        $this->monto = $p_monto;
        $this->fecha = $p_fecha;
        $this->portafolios = $p_portafolios;

        if ($this->db->insert('aportaciones', $this)) {
            return true;
        }
    }

    public function update_aportaciones_Model($p_idaportacion, $p_monto = null, $p_fecha = null, $p_portafolios = null
    ) {
        if ($p_monto != null) {
            $this->monto = $p_monto;
        }

        if ($p_fecha != null) {
            $this->fecha = $p_fecha;
        }

        if ($p_portafolios != null) {
            $this->portafolios = $p_portafolios;
        }

        $this->db->update('aportaciones', $this, array('idaportaciones' => $p_idaportacion));
    }

}
