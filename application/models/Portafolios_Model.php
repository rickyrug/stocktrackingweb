<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of Portafolios_Model
 *
 * @author 60044723
 */
class Portafolios_Model extends CI_Model{
   
    public $nombre;
    public $valorinicial;
    public $fechacreacion;
    public $portafoliospadre;
    
    function __construct() {
        parent::__construct();
    }

    public function get_Portafolios_Model(){
      
        $query = $this->db->get('portafolios');
        return $query->result();
        
        
    }
    
    public function get_Portafolios_Model_fields($p_fields) {
         $this->db->select($p_fields);
         $query = $this->db->get('portafolios');
         return $query->result();
    }
    
     public function get_parent_Portafolios_Model_fields($p_fields) {
         $this->db->select($p_fields);
         $this->db->where('portafoliospadre', null);
         $query = $this->db->get('portafolios');
         return $query->result();
    }
    
    public function find_by_id($p_Portafolios_Modelid) {

        $this->db->from('portafolios');
        $this->db->where('idportafolios', $p_Portafolios_Modelid);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function find_by_name($p_portafoliosname){
        $this->db->from('portafolios');
        $this->db->where('nombre', $p_portafoliosname);
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_Portafolios_Model($p_nombre, $p_valorinicial,
                                             $p_fechainicial,$p_portafolios_padre = null){
        $this->nombre = $p_nombre;
        $this->fechacreacion = $p_fechainicial;
        $this->valorinicial  = $p_valorinicial;
        
        if($p_portafolios_padre != null){
            $this->portafoliospadre = $p_portafolios_padre;
        }
        
       if( $this->db->insert('portafolios',$this)){
           return true;
       }
    }
    
    public function update_Portafolios_Model($p_idportafolios,$p_nombre=null, 
                                          $p_valorinicial=null,$p_fechainicial=null,
                                          $p_portafolios_padre = null
            ){
        
        if($p_nombre != null){
            $this->nombre = $p_nombre;
        }
        if($p_valorinicial != null){
            $this->valorinicial = $p_valorinicial;
        }
        if($p_fechainicial != null){
            $this->fechacreacion = $p_fechainicial;
        }
        
        if($p_portafolios_padre != null){
            $this->portafoliospadre = $p_portafolios_padre;
        }
        
         $this->db->update('portafolios',$this,array('idportafolios'=>$p_idportafolios));
    }
    
    public function delete_Portafolios_Model($p_idPortafolios_Model){
        $this->db->where_in('idportafolios', $p_idPortafolios_Model);
        $this->db->delete('portafolios');
    }
}
