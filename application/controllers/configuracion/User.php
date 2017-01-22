<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author 60044723
 */
class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('security/User_Model', '', TRUE);
        $this->load->helper('paginationconfig');
    }

    public function index() {
        
        redirect('configuracion/user/show_list', 'refresh');
    }
    
    public function show_list($p_items = null) {
        $per_page = 10;
        if ($p_items == null) {
            $results = $this->User_Model->get_Users_Model(null, $per_page);
            $number_items = $this->User_Model->count_result();
        } else {

            $results = $this->User_model->get_Users_Model($p_items, $per_page);
            $number_items = $this->User_model->count_result();
        }


        $base_url = base_url();
        $base_url = $base_url . 'index.php?/configuracion/user/show_list/';


        $this->pagination->initialize(generate_setup_pagination($base_url, $number_items, $per_page));

        $data = array(
            'title' => 'Usuarios',
            'user_list' => $results,
            'paginacion' => $this->pagination->create_links(),
            'resultados' => count($results) . ' of ' . $number_items,
            'accionchpass'=> 'index.php?/configuracion/user/change_password',
            'acciondlpass'=> 'index.php?/configuracion/user/delete_user'
        );

        $this->call_views('configuracion/users/index', $data);
    }

    public function show_addform() {
        
        $time = now('America/Mexico_City');
        
         //se agregan reglas a la forma
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('copassword', 'Confirm password', 'required|matches[password]');
        
        if ($this->form_validation->run() == FALSE){
            $data = array(
            'accion'=>'configuracion/user/show_addform',
            'title' =>'Usuario',
            'checked'=>TRUE,
            'username'=>$this->form_validation->set_value('username')
            );
        }else{
            $p_username = $this->input->post('username');
            $p_password = $this->input->post('password');
            $p_active =  $this->input->post('activo');
            
            if(is_null($p_active)){
                $p_active = ' ';
            }
            
            $this->User_Model->insert_User_Model($p_username,$p_password,$p_active);
            
            redirect('configuracion/user', 'refresh');
        }
        
        
        $this->call_views('configuracion/users/form',$data);
        
    }

    public function change_password($p_id){
       
       // $this->form_validation->set_rules('oldpassword', 'Password', 'required|callback_validate_password');
        $this->form_validation->set_rules('newpassword', 'Confirm password', 'required');
        $this->form_validation->set_rules('copassword', 'Confirm password', 'required|matches[newpassword]');
        
        if ($this->form_validation->run() == FALSE){
            $result = $this->User_Model->find_by_id($p_id);
            if (count($result) > 0) {
                $data = array(
                    'accion' => 'configuracion/user/change_password/'.$p_id,
                    'title' => 'Usuario',
                    'checked' => TRUE,
                    'iduser' => $result[0]->id_usuario,
                    'username' => $result[0]->username,
                );
                
                
            }
            $this->call_views('configuracion/users/formchangepassword',$data);
        }else{
          //  $p_username = $this->input->post('username');
            $p_password = $this->input->post('newpassword');
            $p_iduser   = $this->input->post('iduser');
            
            
            $this->User_Model->update_User_Model($p_iduser,$p_password,NULL);
            
            redirect('configuracion/user', 'refresh');
        }
        
        
        
    }
    
    private function call_views($p_view, $p_data = null) {
        $this->load->view('header');
        if ($p_data == null) {
            $this->load->view($p_view);
        } else {
            $this->parser->parse($p_view, $p_data);
        }

          $this->load->view('footer');
    }
    
    public function validate_password($p_password){
        
        $encpass = $this->encryption->decrypt($p_password);
    }
    
    public function delete_user($p_iduser){
        $this->User_Model->update_User_Model($p_iduser,null,' ');
        redirect('configuracion/user', 'refresh');
    }

}
