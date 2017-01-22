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
    public $password;
    public $active;
    protected $dbname = 'usuarios';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_Users_Model($p_start = null, $p_limit = null){
      
         $this->db->select('*');
       //  $this->db->from($this->dbname);
         $this->db->where('active', 'x');
         
        if ($p_limit != null && $p_start == null) {
            $this->db->limit($p_limit);
        } else if ($p_start != NULL && $p_limit != null) {
            $this->db->limit($p_limit, $p_start);
            //  $this->db->limit($p_start,$p_limit);
        }
        
        $query = $this->db->get($this->dbname);
        return $query->result();
 
    }
    
    public function get_Users_Model_fields($p_fields) {
         $this->db->select($p_fields);
         $query = $this->db->get($this->dbname);
         return $query->result();
    }
    
    public function find_by_id($p_User_Modelid) {

        $this->db->from($this->dbname);
        $this->db->where('id_usuario', $p_User_Modelid);
        $this->db->where('active', 'x');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function find_by_name($p_username){
        $this->db->from($this->dbname);
        $this->db->where('username', $p_username);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function insert_User_Model($p_username, $p_password,$p_active){
        $this->username = $p_username;
        $this->password = $this->encryptPassword($p_password);
        $this->active   = $p_active;

       if( $this->db->insert($this->dbname,$this) ){
           return true;
       }
    }
    
    public function update_User_Model($p_iduser,$p_password = null, $p_active = null){
        $data = array();
        
        if($p_password != NULL){
            //$this->password = $p_password;
            $data['password'] = $this->encryptPassword($p_password);
        }
        
        if($p_active != NULL){
            //$this->active = $p_active;
            $data['active'] = $p_active;
        }
        
        // $this->db->update($this->dbname,$this,array('id_usuario'=>$p_iduser));
        $this->db->update($this->dbname,$data,array('id_usuario'=>$p_iduser));
    }
    
    public function delete_User_Model($p_iduser){
        $this->db->where_in('id_usuario', $p_iduser);
        $this->db->delete($this->dbname);
    }
    
    public function count_result() {
        $this->db->select('*');
        $this->db->from($this->dbname);

        $query = $this->db->get();
        return $query->num_rows();
    }
    
    private function encryptPassword($p_password){
        return $this->encryption->encrypt($p_password);
    }
    
}
