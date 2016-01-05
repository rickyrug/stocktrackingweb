<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User_model
 *
 * @author 60044723
 */
class User_model extends CI_Model{
    
    public $username;
    public $active;
    
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_users($p_start = null, $p_limit = null){
        
          if ($p_limit != null && $p_start == null) {
            $this->db->limit($p_limit);
        } else if ($p_start != NULL && $p_limit != null) {
            $this->db->limit($p_limit, $p_start);
            //  $this->db->limit($p_start,$p_limit);
        }
        
        $this->db->select('id_usuario, username, active');
        $this->db->from('usuarios');
      
        $query = $this->db->get();
        return $query->result();
        
    }
    
    public function find_user_by_id($p_id_user){
        
        $this->db->select('id_usuario, username, active');
        $this->db->from('usuarios');
        $this->db->where('id_usuario',$p_id_user);
        $query = $this->db->get();
        return $query->result();
        
    }
    
    public function insert_user($username, $password, $active){
        
        $data = array(
            'username'=>$username,
            'password'=>$password,
            'active'  =>$active
        );
        $this->db->insert('usuarios', $data);
    }
    
    public function count_result(){
        $this->db->select('id_usuario');
        $this->db->from('usuarios');
       
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    
}
