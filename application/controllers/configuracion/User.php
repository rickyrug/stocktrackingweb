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
       $results = $this->User_Model->get_users();
        $data = array(
                    'title'=>'Lista usuarios',
                    'user_list' => $results
            );
        
        $this->call_views('configuracion/users/index',$data);
    }

    public function show_addform() {

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[12]');
        $this->form_validation->set_rules('copassword', 'Con - Password', 'required|callback_validate_password');


        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'accion' => 'configuracion/user/show_addform',
                'title' => 'Add user',
                'username' => $this->form_validation->set_value('username'),
                'checked' => FALSE
            );


            $this->call_views('configuracion/users/form', $data);
        } else {
            
            $activo   = $this->input->post('activo');
            $password = $this->encrypt_password($this->input->post('password'));
            $username = $this->input->post('username');
            
             $this->User_Model->insert_user($username,$password,$activo);
             redirect('configuracion/user','refresh');
        }
    }

    public function show_editform($p_iduser = NULL) {

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[12]');
        $this->form_validation->set_rules('copassword', 'Con - Password', 'required|callback_validate_password');

        if ($this->form_validation->run() == FALSE) {

            if (is_null($p_iduser)) {
                $data = array(
                    'accion' => 'configuracion/user/show_editform',
                    'title' => 'Add user',
                    'username' => $this->form_validation->set_value('username'),
                    'checked' => FALSE
                );
            } else {
                $result = $this->User_Model->find_user_by_id($p_iduser);
                if (count($result) > 0) {
                    
                    if($result[0]->acive === 'x'){
                        $active = TRUE;
                    }else{
                        $active = FALSE;
                    }
                    $data = array(
                        'accion' => 'configuracion/user/show_editform',
                        'title' => 'Add user',
                        'username' => $result[0]->username,
                        'checked' => $active
                    );
                }
            }
            $this->call_views('configuracion/users/form', $data);
        } else {
            
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

    public function validate_password($p_copassword){
        
        if($p_copassword === $this->input->post('password')){
            return TRUE;
        }else{
            $this->form_validation->set_message('validate_password', 'Los passwords deben ser iguales.');
            return FALSE;
        }
        
       
    }
    
    private function encrypt_password($p_password){
        
       return $this->encryption->encrypt($p_password);
        
    }
}
